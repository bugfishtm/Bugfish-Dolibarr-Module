<?php
	/* 	
		__________ ____ ___  ___________________.___  _________ ___ ___  
		\______   \    |   \/  _____/\_   _____/|   |/   _____//   |   \ 
		 |    |  _/    |   /   \  ___ |    __)  |   |\_____  \/    ~    \
		 |    |   \    |  /\    \_\  \|     \   |   |/        \    Y    /
		 |______  /______/  \______  /\___  /   |___/_______  /\___|_  / 
				\/                 \/     \/                \/       \/  	
							www.bugfish.eu
							
		Bugfish Dolibarr Framework Module
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
	// Include the Configuration File out of Dolibarrs Folder Structure
	// Maybe check if JS File is not in Default Folder!
	require_once("../../../main.inc.php");				
	
	// Include to get Constants (for above dolibarr_get_const() )
	require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';	
	
	// Check for Permissions
	if (!$user->admin AND !$user->rights->xframework->readmysql) { accessforbidden(); }
	
	// Show the Dolibarr Header
	llxHeader("","xMySQL Errors - xFramework");
	
	// Show Button to Clear Table
	m_button_sql($db, "Tabelle Leeren", DOL_URL_ROOT."/custom/xframework/views/mysql.php?mainmenu=tools", "DELETE FROM dolibarr_xframework_sqlerrors", "delop");	
	
	// Prepare and show Complex Table
	$titlelist	=	array("Datum", "Link", "Fehlercodes");
	$alignlist	=	array("left", "center", "left", "left");
	$array = m_db_rows($db, "SELECT creation, url, errtext FROM dolibarr_xframework_sqlerrors ORDER BY rowid DESC LIMIT 300");
	if(!empty($array)) {
		for($i = 0; $i < count($array); $i++) {
			foreach($array[$i] as $key => $value) {
				if($key == "url") {$array[$i]["url"] = mitec_f($value);}
				if($key == "errtext") {$array[$i]["errtext"] = mitec_f($value);}
			}
		}
	} echo "<h2>Demo of m_table_complex!</h2>";
	m_table_complex("Letzte verzeichnete MySQL Fehler", $array, $titlelist, "table", $alignlist);
	
	// Close the Dolibarr Footer
	llxFooter();
	
	// Close the Database Connection
	$db->close();
?>