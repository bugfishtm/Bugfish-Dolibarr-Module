<?php
	/* 
		 ____  __  __  ___  ____  ____  ___  _   _ 
		(  _ \(  )(  )/ __)( ___)(_  _)/ __)( )_( )
		 ) _ < )(__)(( (_-. )__)  _)(_ \__ \ ) _ ( 
		(____/(______)\___/(__)  (____)(___/(_) (_) www.bugfish.eu
			  ___                                         _     
			 / __)                                       | |    
			| |__ ____ ____ ____   ____ _ _ _  ___   ____| |  _ 
			|  __) ___) _  |    \ / _  ) | | |/ _ \ / ___) | / )
			| | | |  ( ( | | | | ( (/ /| | | | |_| | |   | |< ( 
			|_| |_|   \_||_|_|_|_|\____)\____|\___/|_|   |_| \_)
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
	class x_class_api {		
		// Class Variables
		private $mysql   = false; 
		private $table   = false; 	
		private $section = "";
	
		// Table Initialization
		private function create_table() {
			return $this->mysql->query("CREATE TABLE IF NOT EXISTS `".$this->table."` (
												  `id` int(9) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID',
												  `direction` varchar(12) NOT NULL COMMENT 'Token Type',
												  `api_token` varchar(512) NOT NULL COMMENT 'Token for API Requests',
												  `section` varchar(128) NOT NULL COMMENT 'Value for Constant',
												  `last_use` datetime NULL COMMENT 'Last Use Date in Check',
												  `creation` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Creation Date of Entry | Will be Auto-Set',
												  `modification` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Modification Date of Entry with Auto-Update on Change',
												  PRIMARY KEY (`id`),
												  UNIQUE KEY `x_class_api` (`direction`,`api_token`,`section`) USING BTREE);");}
	
		// Constructor Functions
		function __construct($mysql, $table, $section = "") {
			if(!$section) { $section = "undefined"; }
			$this->mysql = $mysql;
			$this->table = $table;
			$this->section = $section;
			if(!$this->mysql->table_exists($table)) { $this->create_table(); $this->mysql->free_all();  }}
		
		// Request Function
		function request($url, $payload, $token = false, $section = false) {
			if(!$section) { $section = $this->section; }
			if(!$token) { 
				$bind[0]["type"]	=	"s";
				$bind[0]["value"]	=	$section;	
				$res = $this->mysql->select("SELECT * FROM `".$this->table."` WHERE direction = 'out' AND section = ?", false, $bind);
				if(is_array($res)) {
					$token = $res["api_token"];
				} else { return "local-error:notokenprovided-noautotokenfound"; }		
			}
			
			// Set Field Data for Post Request
			if(is_string($payload) OR is_numeric($payload)) {
			  $fields = array(
				'token'=>$token,
				'section'=>$section,
				'data'=>@$payload);	
			} elseif(is_array($payload) OR is_object($payload)) {
				$fields = array();
				$fields["data"] = serialize($payload);
				$fields["token"] = $token;
				$fields["section"] = $section;
			} else { return "local-error:payload-data-error"; }
	
		  //url-ify the data for the POST
		  $fields_string = "";
		  foreach($fields as $key=>$value) { @$fields_string .= $key.'='.$value.'&'; }
		  rtrim($fields_string,'&');
		 
		  // Initialize curl
		  $ch = curl_init();
		  //set the url, number of POST vars, POST data
		  curl_setopt($ch,CURLOPT_URL,$url);
		  if(is_string($token)) {curl_setopt($ch,CURLOPT_POST,count($fields));}
		  if(is_string($token)) {curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);}
		  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
		  curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);				
		  //execute post
		  $result = curl_exec($ch);
		  return $result; }
	
		// Token Functions
		public function token_add_incoming($token, $section = false) {
			if(!$section) { $section = $this->section; }
			$b[0]["type"]	=	"s";
			$b[0]["value"]	=	trim($token ?? '');	
			$bind[1]["type"]	=	"s";
			$bind[1]["value"]	=	$section;			
			return @$this->mysql->query("INSERT INTO `".$this->table."`(api_token, section, direction) VALUES(?, ?, 'in');", $b);}
			
		public function token_add_outgoing($token, $section = false) {
			if(!$section) { $section = $this->section; }
			$b[0]["type"]	=	"s";
			$b[0]["value"]	=	trim($token ?? '');	
			$bind[1]["type"]	=	"s";
			$bind[1]["value"]	=	$section;			
			return @$this->mysql->query("INSERT INTO `".$this->table."`(api_token, section, direction) VALUES(?, ?, 'out');", $b);}
	
		public function token_generate_incoming($section = false, $len = 32, $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890') {
			$pass = array(); $combLen = strlen($comb) - 1; for ($i = 0; $i < $len; $i++) { $n = mt_rand(0, $combLen); $pass[] = $comb[$n]; } $newtoken = implode($pass);
			if(!$section) { $section = $this->section; }
			$this->token_add_incoming($newtoken, $section);return $newtoken;}		

		public function token_delete_incoming($token, $section = false) {
			if(!$section) { $section = $this->section; }
			$bind[0]["type"]	=	"s";
			$bind[0]["value"]	=	trim($token ?? '');
			$bind[1]["type"]	=	"s";
			$bind[1]["value"]	=	$section;
			return $this->mysql->query("DELETE FROM `".$this->table."` WHERE direction = 'in' AND api_token = ? AND section = ?", $bind);}	
			
		public function token_delete_outgoing($token, $section = false) {
			if(!$section) { $section = $this->section; }
			$bind[0]["type"]	=	"s";
			$bind[0]["value"]	=	trim($token ?? '');
			$bind[1]["type"]	=	"s";
			$bind[1]["value"]	=	$section;
			return $this->mysql->query("DELETE FROM `".$this->table."` WHERE direction = 'out' AND api_token = ? AND section = ?", $bind);}	

		public function token_check_incoming($token, $section = false) {
			// Only checking incoming tokens, External cant be checked
			if(!$section) { $section = $this->section; }
			$bind[0]["type"]	=	"s";
			$bind[0]["value"]	=	trim($token ?? '');
			$bind[1]["type"]	=	"s";
			$bind[1]["value"]	=	$section;
			$res = $this->mysql->select("SELECT * FROM `".$this->table."` WHERE direction = 'in' AND api_token = ? AND section = ?", false, $bind);
			if(is_array($res)) {
				@$this->mysql->query("UPDATE `".$this->table."` SET last_use = CURRENT_TIMESTAMP() WHERE id = '".$res["id"]."'");
				return true;
			} return false;}
	}