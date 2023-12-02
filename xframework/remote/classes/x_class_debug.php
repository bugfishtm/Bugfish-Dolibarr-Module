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
	class x_class_debug {
		private $microtime_start = false;
		
		function __construct() {
			$this->microtime_start = microtime(true);
		}

		public function error_screen($text) {
			http_response_code(503);
			echo '<!DOCTYPE html><html lang="en"><head><!-- Bugfish x_class_debug Error Page --><meta charset="utf-8" /><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="viewport" content="width=device-width, initial-scale=1" /><meta name="robots" content="noindex,nofollow" /><title>Maintenance</title>
    <style type="text/css">/*! normalize.css v5.0.0 | MIT License | github.com/necolas/normalize.css */html{font-family:sans-serif;line-height:1.15;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}body{margin:0}article,aside,footer,header,nav,section{display:block}h1{font-size:2em;margin:.67em 0}figcaption,figure,main{display:block}figure{margin:1em 40px}hr{box-sizing:content-box;height:0;overflow:visible}pre{font-family:monospace,monospace;font-size:1em}a{background-color:transparent;-webkit-text-decoration-skip:objects}a:active,a:hover{outline-width:0}abbr[title]{border-bottom:none;text-decoration:underline;text-decoration:underline dotted}b,strong{font-weight:inherit}b,strong{font-weight:bolder}code,kbd,samp{font-family:monospace,monospace;font-size:1em}dfn{font-style:italic}mark{background-color:#ff0;color:#000}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}audio,video{display:inline-block}audio:not([controls]){display:none;height:0}img{border-style:none}svg:not(:root){overflow:hidden}button,input,optgroup,select,textarea{font-family:sans-serif;font-size:100%;line-height:1.15;margin:0}button,input{overflow:visible}button,select{text-transform:none}[type=reset],[type=submit],button,html [type=button]{-webkit-appearance:button}[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner,button::-moz-focus-inner{border-style:none;padding:0}[type=button]:-moz-focusring,[type=reset]:-moz-focusring,[type=submit]:-moz-focusring,button:-moz-focusring{outline:1px dotted ButtonText}fieldset{border:1px solid silver;margin:0 2px;padding:.35em .625em .75em}legend{box-sizing:border-box;color:inherit;display:table;max-width:100%;padding:0;white-space:normal}progress{display:inline-block;vertical-align:baseline}textarea{overflow:auto}[type=checkbox],[type=radio]{box-sizing:border-box;padding:0}[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}[type=search]::-webkit-search-cancel-button,[type=search]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}details,menu{display:block}summary{display:list-item}canvas{display:inline-block}template{display:none}[hidden]{display:none}body,html{width:100%;height:100%;background-color:#21232a}body{color:#FF0000;text-align:center;text-shadow:0 2px 4px rgba(0,0,0,.5);padding:0;min-height:100%;-webkit-box-shadow:inset 0 0 100px rgba(0,0,0,.8);box-shadow:inset 0 0 100px rgba(0,0,0,.8);display:table;font-family:"Open Sans",Arial,sans-serif}h1{font-family:inherit;font-weight:500;line-height:1.1;color:inherit;font-size:36px}h1 small{font-size:68%;font-weight:400;line-height:1;color:#777}a{text-decoration:none;color:#fff;font-size:inherit;border-bottom:dotted 1px #707070}.lead{color:silver;font-size:21px;line-height:1.4}.cover{display:table-cell;vertical-align:middle;padding:0 20px}footer{position:fixed;width:100%;height:40px;left:0;bottom:0;color:#a0a0a0;font-size:14px}</style>
</head><body><div class="cover"><h1>Missing PHP Module <small>Critical Error</small></h1><p class="lead">'.htmlspecialchars($text).'</p></div><footer>Powered by <a href="https://github.com/bugfishtm" rel="noopener" target="_blank">Bugfish</a> Framework!</footer></body></html>';}
				
		public function required_php_modules($array = array(), $errorscreen = false) {
			$ar = $this->php_modules();
			$notfoundarray = array();
			foreach($array AS $key => $value) {
				$found = false;
				foreach($ar AS $keyx => $valuex) {
					if($value == $valuex) { $found = true;}
				}
				if(!$found) { array_push($notfoundarray, $value); } 
			}
			
			if($errorscreen AND count($notfoundarray) > 0) { $this->error_screen("Missing PHP Module: <br />".@serialize(@$notfoundarray)); exit(); } else { return $notfoundarray;}
		}
		public function required_php_module($name, $errorscreen = false) {
			$ar = $this->php_modules();
			foreach($ar AS $key => $value) {
				if($value == $name) { return true;}
			} 
			
			if($errorscreen) { $this->error_screen("Missing Module: ".$name); exit(); } else { return false;}
		}
		public function php_modules() { return get_loaded_extensions(); }
		public function memory_usage() { return round(memory_get_usage() / 1000)."KB"; }
		public function memory_limit() { return ini_get('memory_limit'); }
		public function cpu_load() { if(function_exists("sys_getloadavg")) { return sys_getloadavg()[0]; } else { return "intl-mod-missing"; } }
		public function upload_max_filesize() { return ini_get('upload_max_filesize'); }
		public function timer() { $endtime = microtime(true); $newstart = $endtime - $this->microtime_start; $newstart = round($newstart, 3); return $newstart; }
		
		
		public function js_error_script($action_url) { 
			echo '
				window.onerror = function(error, url, line) {
					$.post("'.$action_url.'", 
					{ urlstring: window.location.href, errortext: \'File: \'+url+\' Line: \'+line+\' Error: \'+error }, function (data) {});	
				}
				';
		}
		
		public function js_error_action($x_class_mysql, $table, $current_user_id = 0, $section = "") { 
			if(!$x_class_mysql->table_exists($table)) { $this->js_error_create_db($x_class_mysql, $table); $x_class_mysql->free_all(); }
			$into_array = array();
			$into_array["fk_user"] 		= $current_user_id;
			$into_array["errormsg"] 	= @$_POST["errortext"];
			$into_array["urlstring"] 	= @$_POST["urlstring"];
			$bind[0]["value"] = $into_array["urlstring"];
			$bind[0]["type"] = "s"; 
			$bind[1]["value"] = $into_array["errormsg"];
			$bind[1]["type"] = "s";	
			$x_class_mysql->query("INSERT INTO ".$table."(urlstring, fk_user, errormsg, section) VALUES(?, '".$into_array["fk_user"]."', ?, '".$section."');", $bind);
		}
		
		private function js_error_create_db($x_class_mysql, $table) {
			return $x_class_mysql->query("CREATE TABLE IF NOT EXISTS `".$table."` (
										  `id` int(11) NOT NULL AUTO_INCREMENT,
										  `fk_user` int(11) NOT NULL DEFAULT 0,
										  `creation` datetime DEFAULT current_timestamp(),
										  `errormsg` longtext DEFAULT NULL,
										  `urlstring` varchar(512) DEFAULT NULL,
										  `section` varchar(512) DEFAULT NULL,
										  PRIMARY KEY (`id`)
										);");
		}
	}