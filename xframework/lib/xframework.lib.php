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
	
	// Prepare Head for Tabs and Make Adjustable by dolibarr Functions
	function xframeworkPrepareHead($object) {
		global $db, $langs, $conf;
		$langs->load("xframework@xframework");
		$h = 0;
		$head = array();
		//$head[$h][0] = dol_buildpath("/xframework/views/card.php", 1).'?id='.$object->id;
		//$head[$h][1] = $langs->trans("Card");
		//$head[$h++][2] = 'card';
		complete_head_from_modules($conf, $langs, $object, $head, $h, 'xframework');
		return $head;
}