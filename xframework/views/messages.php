<?php
	/*
		__________              _____.__       .__     
		\______   \__ __  _____/ ____\__| _____|  |__  
		 |    |  _/  |  \/ ___\   __\|  |/  ___/  |  \ 
		 |    |   \  |  / /_/  >  |  |  |\___ \|   Y  \
		 |______  /____/\___  /|__|  |__/____  >___|  /
				\/     /_____/               \/     \/  Doliabrr View File Example */
	// Include the Configuration File out of Dolibarrs Folder Structure
	// Maybe check if JS File is not in Default Folder!
	require_once("../../../main.inc.php");				
	
	// Include to get Constants (for above dolibarr_get_const() )
	require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';

	// Check for Permissions
	if (!$user->admin AND !$user->rights->xframework->readmsg) { accessforbidden(); }
	
	// Show the Dolibarr Header
	llxHeader("","Message System - xFramework");
	
	// Show buttons to switch areas
	m_button_link("Reset", DOL_URL_ROOT."/custom/xframework/views/messages.php?mainmenu=tools&ref=");
	$query = "SELECT module, createdate , username, notification FROM dolibarr_xframework_messages ORDER BY module DESC";
	$array = m_db_rows($db, $query);
	if(!empty($array)) {
		$lastmodule = "7a8sgfaeufiuasnfiuasfnkaifbuasdbasidnasiudasoidbasoifbges78bufieasbaisdasiudbasuidasoidabsfgbeutbaislamnfiubadfidsabfiafdaud";
		for($i = 0; $i < count($array); $i++) {

				if($lastmodule != $array[$i]["module"]) {
					m_button_link($array[$i]["module"], DOL_URL_ROOT."/custom/xframework/views/messages.php?mainmenu=tools&ref=".$array[$i]["module"]."");
				}
				$lastmodule = $array[$i]["module"];		

		}
	}
	
	// Prepare Complex Table Title
	$titlelist	=	array("Modul","Datum", "Nutzer", "Nachricht");
	$alignlist	=	array("left;vertical-align: top;", "left;vertical-align: top;", "left;vertical-align: top;", "left;white-space: wrap; word-break: break-all;");		
	$query = "SELECT module, createdate , username, notification FROM dolibarr_xframework_messages WHERE module = \"".$db->escape(@$_GET["ref"])."\" ORDER BY createdate DESC LIMIT 500";
	
	// Prepare Actual Table
	$array = m_db_rows($db, $query);
	if(!empty($array)) {
		for($i = 0; $i < count($array); $i++) {
			foreach($array[$i] as $key => $value) {
				if($key == "username") {$array[$i]["username"] = m_login_name_from_id($db, $value);}
				if($key == "notification") {$array[$i]["notification"] = htmlspecialchars_decode($array[$i]["notification"]);}
				if(!is_string($array[$i]["username"])) {$array[$i]["username"] = "Not Found";}
				//if($key == "changesstring") {$array[$i]["changesstring"] = str_replace("&amp;", "&", $value) ;}
			}
		}
	} echo "<h2>Demo of m_table_complex!</h2>";
	if(is_numeric(@$_GET["ref"]) OR is_string(@$_GET["ref"]) AND strlen(trim(@$_GET["ref"])) > 0) { m_table_complex("Modul-Nachrichten", $array, $titlelist, "table", $alignlist); } else { echo "Please choose an Area with an Button at the top!"; }
	
	// Close the Dolibarr Footer
	llxFooter();
	
	// Close the Database Connection
	$db->close();	
?>