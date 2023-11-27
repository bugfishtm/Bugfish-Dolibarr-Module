<?php 
	/* 	
		@@@@@@@   @@@  @@@   @@@@@@@@  @@@@@@@@  @@@   @@@@@@   @@@  @@@  
		@@@@@@@@  @@@  @@@  @@@@@@@@@  @@@@@@@@  @@@  @@@@@@@   @@@  @@@  
		@@!  @@@  @@!  @@@  !@@        @@!       @@!  !@@       @@!  @@@  
		!@   @!@  !@!  @!@  !@!        !@!       !@!  !@!       !@!  @!@  
		@!@!@!@   @!@  !@!  !@! @!@!@  @!!!:!    !!@  !!@@!!    @!@!@!@!  
		!!!@!!!!  !@!  !!!  !!! !!@!!  !!!!!:    !!!   !!@!!!   !!!@!!!!  
		!!:  !!!  !!:  !!!  :!!   !!:  !!:       !!:       !:!  !!:  !!!  
		:!:  !:!  :!:  !:!  :!:   !::  :!:       :!:      !:!   :!:  !:!  
		 :: ::::  ::::: ::   ::: ::::   ::        ::  :::: ::   ::   :::  
		:: : ::    : :  :    :: :: :    :        :    :: : :     :   : :  
			  __                                   _   		Autor: Jan-Maurice Dahlmanns (Bugfish)
			 / _|_ _ __ _ _ __  _____ __ _____ _ _| |__		Bugfish Framework Codebase
			|  _| '_/ _` | '  \/ -_) V  V / _ \ '_| / /		https://github.com/bugfishtm
			|_| |_| \__,_|_|_|_\___|\_/\_/\___/_| |_\_\       */
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
