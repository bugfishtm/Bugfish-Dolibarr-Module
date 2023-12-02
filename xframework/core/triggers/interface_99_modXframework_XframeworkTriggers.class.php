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
	// Required Files
	require_once DOL_DOCUMENT_ROOT.'/core/triggers/dolibarrtriggers.class.php';
	require_once DOL_DOCUMENT_ROOT . '/core/lib/admin.lib.php';
	
	// The Actual Trigger Function
	// The Integer in the Files Name 10-99 Determines the Priotity - 99 is last trigger file to run!
	class InterfaceXframeworkTriggers extends DolibarrTriggers {
		/// Class Creation
		protected $db;
		public function __construct($db) {
			$this->db = $db;
			$this->name = preg_replace('/^Interface/i', '', get_class($this));
			$this->family = "demo";
			$this->description = "xframework triggers.";
			$this->version = 'development';
			$this->picto = 'xframework@xframework'; }

		/// Actual Trigger Function and Work
		public function runTrigger($action, $object, User $user, Translate $langs, Conf $conf)	{
			// Stop is Mod not Enabled
			if (empty($conf->xframework->enabled)) return 0;
			
			// If Activated, log Triggers
			if(dolibarr_get_const($this->db, "XMOD_XF_TRGLOG", 1) == "on") { 
				d_trigger_triggers($this->db, @$action, @$object);
			}
			
			// If Activated, log Changes
			if(dolibarr_get_const($this->db, "XMOD_XF_CNGLOG", 1) == "on") { 
				d_trigger_changelog($this->db, @$action, @$object);
			}
			return 1;
		}
	}
