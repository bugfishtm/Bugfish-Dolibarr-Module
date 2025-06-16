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
// Needed Includes
include_once DOL_DOCUMENT_ROOT . "/core/boxes/modules_boxes.php";

// Actual Class for the Widget
class testwidget1 extends ModeleBoxes {
	// Alphanumeric ID
	public $boxcode = "xframeworkbox";
	// Icon for Box
	public $boximg = "xframework@xframework";
	// Box Label
	public $boxlabel;
	// Module Dependencies
	public $depends = array('xframework');
	// DB Object
	public $db;
	// Parameters
	public $param;
	// Array Header Informations
	public $info_box_head = array();
	// Array Content Informations
	public $info_box_contents = array();

	// The Constructor
	public function __construct(DoliDB $db, $param = '') {
		global $user, $conf, $langs;
		$langs->load("boxes");
		$langs->load('xframework@xframework');
		parent::__construct($db, $param);
		$this->boxlabel = $langs->transnoentitiesnoconv("xFrameworkBox");
		$this->param = $param;
		
		// Condition when module is enabled or not
		//$this->enabled = $conf->global->FEATURES_LEVEL > 0;	
		// Condition when module is visible by user (test on permission)
		//$this->hidden = ! ($user->rights->xframework->XXXX);   
	}

	// Function to Load the Box
	public function loadBox($max = 5) {
		global $langs, $db;

		//  Prepare Info Box Head
		$this->info_box_head = array(
			// Title text
			'text' => 'SOME TEXT',
			// Add a link
			'sublink' => 'SUBLINKURL',
			// Sublink icon placed after the text
			'subpicto' => 'object_xframework@xframework',
			// Sublink icon HTML alt text
			'subtext' => '',
			// Sublink HTML target
			'target' => '',
			// HTML class attached to the picto and link
			'subclass' => 'center',
			// Limit and truncate with "…" the displayed text lenght, 0 = disabled
			'limit' => 0,
			// Adds translated " (Graph)" to a hidden form value's input (?)
			'graph' => false
		);

		// Prepare Info Box Content
		$this->info_box_contents = array();
	}

	// Method to show the box
	public function showBox($head = null, $contents = null, $nooutput = 0){
		parent::showBox($this->info_box_head, $this->info_box_contents); }
}
