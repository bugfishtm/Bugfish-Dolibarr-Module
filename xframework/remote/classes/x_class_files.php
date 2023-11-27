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