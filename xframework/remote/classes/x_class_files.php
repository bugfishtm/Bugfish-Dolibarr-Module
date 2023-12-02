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
	class x_class_files {
		/* Class Variables */
		private $mysql = false;
		private $tablefile = false;
		private $tablefolder = false;
		private $foldercache = false;
		private $folderfile = false;
		private $section = "";
		
		/* Construct and Create Table */
		function __construct($mysql, $file_table, $folder_table, $section, $filefolder, $cachefolder) {
			$this->mysql = $mysql;
			$this->tablefile = $file_table;
			$this->tablefolder = $folder_table;
			$this->foldercache = $cachefolder;
			$this->folderfile = $filefolder;
			$this->section = $section; 
			
			
			
			}
			
		/* Table SQL Creations */
		
		/* Table Editing */
		
		function delete() {
		}
		function create() {
		}
		function edit() {
		}	
		function get() {
		}		
		function field_delete() {
		}	
		function field_create() {
		}
		function folder_field_delete() {
		}	
		function folder_field_create() {
		}
		function folder_delete() {
		}
		function folder_create() {
		}
		function folder_edit() {
		}
		function folder_get() {
		}
		function folder_get_array() {
		}
		function api_upload() {
		}
		function api_download() {
		}
	}