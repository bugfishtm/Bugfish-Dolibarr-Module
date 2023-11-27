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
	function x_eventBoxPrep($text, $type = "x", $precookie = "", $morecss = "", $buttontext = "X", $imgok = false, $imgfail = false, $imgwarn = false, $imgelse = false) {
		if($type == "ok"|| $type == "success") {if($imgok) {$img = "<img src='".$imgok."'>";} else {$img = "";} $morecss = '<div class="x_eventBox" id="x_eventBox_ok_outer"><div id="x_eventBox_ok" class="x_eventBox_inner" style="'.$morecss.'" >'.$img.$text;}
		elseif($type == "warning" || $type == "warn" || $type == "warns") {if($imgwarn) { $img = "<img src='".$imgwarn."'>";}else {$img = "";}$morecss = '<div class="x_eventBox" id="x_eventBox_warning_outer"><div id="x_eventBox_warning" class="x_eventBox_inner" style="'.$morecss.'" >'.$img.$text;}
		elseif($type == "error" || $type == "errors" || $type == "fail") {if($imgfail) {$img = "<img src='".$imgfail."'>";}else {$img = "";}$morecss = '<div class="x_eventBox" id="x_eventBox_error_outer"><div id="x_eventBox_error" class="x_eventBox_inner" style="'.$morecss.'" >'.$img.$text;}
		else {if($imgelse) {$img = "<img src='".$imgelse."'>";}else {$img = "";} $morecss = '<div id="x_eventBox_'.$type.'" class="x_eventBox" style="'.$morecss.'" >'.$img.$text;}				
		$morecss = $morecss."<button class='x_eventBoxButton' onclick='this.parentNode.parentNode.remove()'>".$buttontext."</button></div></div>";
		$_SESSION[$precookie."x_eventbox"] = $morecss;}

	function x_eventBoxShow($precookie = "") { if(@$_SESSION[$precookie."x_eventbox_skip"]) { $_SESSION[$precookie."x_eventbox_skip"] = false; return true; } echo @$_SESSION[$precookie."x_eventbox"]; unset( $_SESSION[$precookie."x_eventbox"] );   }
	function x_eventBoxSet($precookie = "") { if(isset($_SESSION[$precookie."x_eventbox"])) { return true; } else { return false; } }
	function x_eventBoxSkip($precookie = "") { $_SESSION[$precookie."x_eventbox_skip"] = true; }
