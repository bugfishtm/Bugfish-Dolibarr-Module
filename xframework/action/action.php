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
	// Default Presettings
	if (!defined('NOCSRFCHECK'))    define('NOCSRFCHECK', 1);
	if (!defined('NOTOKENRENEWAL')) define('NOTOKENRENEWAL', 1);
	if (!defined('NOREQUIREMENU'))  define('NOREQUIREMENU', 1);
	if (!defined('NOREQUIREHTML'))  define('NOREQUIREHTML', 1);
	
	// Include the Configuration File out of Dolibarrs Folder Structure
	// Maybe check if Trigger File is not in Default Folder!
	require_once("../../../main.inc.php");
	
	// Log JS Error if one is appearing
	if(@GETPOST("action", "alpha") == "logjserror") {		
		$into_array = array();
		$into_array["userid"] 		= @m_login_id($db);
		$into_array["errormsg"] 	= $db->escape(@GETPOST("errortext", "alpha"));
		$into_array["urlstring"]	= $db->escape(@GETPOST("urlstring", "alpha"));	
		@m_db_row_insert($db, "dolibarr_xframework_jserrors", @$into_array);		
		exit();
	}
?>