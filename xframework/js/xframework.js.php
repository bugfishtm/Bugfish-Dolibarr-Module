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
	// Default Top Settings for JS File
	if (!defined('NOCSRFCHECK'))    define('NOCSRFCHECK',    1);
	if (!defined('NOTOKENRENEWAL')) define('NOTOKENRENEWAL', 1);
	if (!defined('NOREQUIREMENU'))  define('NOREQUIREMENU',  1);
	if (!defined('NOREQUIREHTML'))  define('NOREQUIREHTML',  1);
	
	// Include the Configuration File out of Dolibarrs Folder Structure
	// Maybe check if JS File is not in Default Folder!
	require_once("../../../main.inc.php");
	
	// Include to get Constants (for above dolibarr_get_const() )
	require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';
	
	// No Caching on this File for faster Changes
	header('Cache-Control: no-cache');
	header('Content-Type: application/javascript');
	
	// Check if errors should be fetched, otherwhise exit
	if(!dolibarr_get_const($db, "XMOD_XF_JSLOG", 1) OR dolibarr_get_const($db, "XMOD_XF_JSLOG", 1) != "on") { exit(); }
?>

	// Fetch Errors and Write to Database, if activated.
	window.onerror = function(error, url, line) {
		$.post("<?php print DOL_URL_ROOT; ?>/custom/xframework/action/action.php", 
		{ action: 'logjserror', urlstring: window.location.href, errortext: 'File: '+url+' Line: '+line+' Error: '+error }, function (data) {});	
	}
	