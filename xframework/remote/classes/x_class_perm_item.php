<?php
	/* 	__________ ____ ___  ___________________.___  _________ ___ ___  
		\______   \    |   \/  _____/\_   _____/|   |/   _____//   |   \ 
		 |    |  _/    |   /   \  ___ |    __)  |   |\_____  \/    ~    \
		 |    |   \    |  /\    \_\  \|     \   |   |/        \    Y    /
		 |______  /______/  \______  /\___  /   |___/_______  /\___|_  / 
				\/                 \/     \/                \/       \/  	
							www.bugfish.eu
							
	    Bugfish Framework
		Copyright (C) 2024 Jan Maurice Dahlmanns [Bugfish]

		This program is free software: you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation, either version 3 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program.  If not, see <https://www.gnu.org/licenses/>.
	*/
	class x_class_perm_item {
		// Class Variables
		private $mysql     				= false;
		private $tablename 				= false;
		private $section   				= false;
		private $ref 	   			    = false;
		private $permissions 	    	= array(); 
		// Constructor
		function __construct($mysql, $tablename, $section, $ref, $permissions = array()) {
			$this->mysql	= $mysql;
			$this->tablename = $tablename;
			$this->section = @substr(trim($section), 0, 127);
			$this->ref = $ref;
			$this->permissions = $permissions; }	

		// Get Permissions to Local Array
		public function refresh() {
				$ar = $this->mysql->select("SELECT * FROM `".$this->tablename."` WHERE ref = \"".$this->ref."\" AND section = '".$this->section."'", false);
				if(is_array($ar)) {
					$newar	= unserialize($ar["content"]);
					if(is_array($newar)) { $this->permissions = $newar; } else {$this->permissions =  array();}
				} $this->permissions =  array(); } 

		// Check if Ref has Perm		
		public function has_perm($permname) {
			$current_perm	=	$this->permissions;
			if(is_array($current_perm)) {
				foreach($current_perm AS $key => $value) {
					if($value == $permname) { return true; }
				}
			} return false;	}	

		// Add Permission to Ref	
		public function add_perm($permname) {
			$current_perm	=	$this->permissions;
			$hasperm = false;
			if(is_array($current_perm)) {
				foreach($current_perm AS $key => $value) {
					if($value == $permname) { $hasperm = true; }
				}
			} else { $current_perm = array(); }
			if(!$hasperm) {array_push($current_perm, $permname);}		
			$this->set_perm($this->ref, $current_perm);		
			return true;}	

		// Check if Ref has multiple Perms at Once and True/False		
		public function check_perm($array, $or = false) {
			$current_perm	=	$this->permissions;
			$perms_and = false;
			$perms_andra = array();
			$perms_or = false;
			if(is_array($current_perm) AND is_array($array)) {
				foreach($current_perm AS $key => $value) {
					foreach($array AS $keyc => $valuec) {
						if($value == $valuec) { $perms_or = true; }
					}
				}
				foreach($array AS $key => $value) {
					foreach($current_perm AS $keyc => $valuec) {
						if($value == $valuec) { $perms_andra[$key] = true; }
					}
					if(!isset($perms_andra[$key])) { $perms_andra[$key] = false; }
				}				
				$perms_and = true;
				foreach($perms_andra AS $keyc => $valuec) {
					if($valuec == false) { $perms_and = false; }
				}
				if(!$or) { return $perms_and;}
				else { return $perms_or;}
			} return false;}

		// Remove Single Permissions
		public function remove_perm($permname) {
			$current_perm = $this->permissions;
			$newperm	=	array();
			if(is_array($current_perm)) {
				foreach($current_perm AS $key => $value) {
					if($value != $permname) { array_push($newperm, $value); }
				}
			} return $this->set_perm($ref, $newperm);}	

		// Set Ref Permissions		
		private function set_perm($ref, $array) { 	
			$query = $this->mysql->select("SELECT * FROM `".$this->tablename."` WHERE ref = \"".$this->ref."\" AND section = '".$this->section."'", false);
			if ($query) { 
				$this->mysql->update("UPDATE `".$this->tablename."` SET content = '".$this->mysql->escape(serialize($array))."' WHERE ref = '".$ref."' AND section = '".$this->section."'  ");
			} else { 
				$this->mysql->query("INSERT INTO `".$this->tablename."` (ref, content, section) VALUES('".$this->ref."', '".$this->mysql->escape(serialize($array))."', '".$this->section."')"); 
			} return true;}
		
		// Remove Ref Permissions	
		public function remove_perms() { return $this->set_perm(array()); }
		// Delete a Ref from Permission Table	
		public function delete_ref() { return $this->mysql->query("DELETE FROM `".$this->tablename."` WHERE ref = \"".$this->ref."\" AND section = '".$this->section."'");}
	}
