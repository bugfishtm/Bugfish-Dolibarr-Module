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
		   ____         _     __                      __  __         __           __  __
		  /  _/ _    __(_)__ / /    __ _____  __ __  / /_/ /  ___   / /  ___ ___ / /_/ /
		 _/ /  | |/|/ / (_-</ _ \  / // / _ \/ // / / __/ _ \/ -_) / _ \/ -_|_-</ __/_/ 
		/___/  |__,__/_/___/_//_/  \_, /\___/\_,_/  \__/_//_/\__/ /_.__/\__/___/\__(_)  
								  /___/                           
		Bugfish Framework Codebase // All rights Reserved
		// Autor: Jan-Maurice Dahlmanns (Bugfish)
		// Website: www.bugfish.eu 
	*/
	// Add a Default Button Linked to another Page
	function m_button_link($name, $url, $break = false, $style = "", $reacttourl = true){ if($reacttourl AND strpos($url."&", $_SERVER["REQUEST_URI"]."&") > -1) {$style .= ";background: grey !important;";} print "<a href='".$url."' class='butAction' style='".$style."'>".$name."</a>"; if($break) {echo "<br />";}}
		
	// Add a Button Able to Execute a Simple SQL Function
	function m_button_sql($db, $name, $url, $query, $get, $msgerr = "Fehler!", $msgok = "Erfolgreich!", $break = false, $style = ""){
		if(strpos(trim($url), "?") > 2) { $xurl = trim($url)."&".$get."=x"; } else {$xurl = trim($url)."?".$get."=x";}
		print "<a href='".$xurl."' class='butAction' style='".$style."'>".$name."</a>";if($break) {echo "<br />";}
		if(@$_GET[$get] == "x") {
			if($db->query($query)) { setEventMessage($msgok, "mesgs"); } else { setEventMessage($msgerr, "mesgs"); } 
			$url = str_replace("?".$get."=x&", "?", $url); $url = str_replace("&".$get."=x", "", $url); 
			print '<meta http-equiv="refresh" content="0; url='.$url.'">';exit();}}	

	// Print a Simple Table
	function m_table_simple($title, $array, $titlelist, $tableid = "", $alignarray = false, $imgeforlist = 'generic'){
		$colspan	=	count($titlelist);
		print_barre_liste($title, NULL, $_SERVER["PHP_SELF"], NULL, NULL, NULL, NULL, NULL, NULL, $imgeforlist);
		print '<table class="tagtable liste" id="mtsimple_'.$tableid.'"><tr class="liste_titre">';
		$t_r_count	=	0;
		foreach( $titlelist as $key => $value ){
				if($t_r_count == 0) {	if(!$alignarray) { $t_align	=	"left"; } else {$t_align	=	$alignarray[$t_r_count]; }}
				elseif($t_r_count == count($titlelist)-1) {	if(!$alignarray) { $t_align	=	"right"; } else {$t_align	=	$alignarray[$t_r_count]; }}
				else {	if(!$alignarray) { $t_align	=	"center"; } else {$t_align	=	$alignarray[$t_r_count]; }}
				//print '<th class="liste_titre" style="text-align: '.$t_align.';">'.$value.'</th>';
				print_liste_field_titre($value, $_SERVER["PHP_SELF"], NULL, NULL, NULL, "style='text-align: ".$t_align.";'");
				$t_r_count	=	$t_r_count	+ 1;}
		print '</tr>';
		if(empty($array)) {print '<tr class="oddeven"><td colspan="'.$colspan.'" style="text-align: center"><i>Keine Daten vorhanden...</i></td></tr>';} else {
			foreach( $array as $key => $value ){
				print '<tr class="oddeven">';
				$t_r_count	=	0;
				foreach( $array[$key] as $key1 => $value1 ){
				if($t_r_count == 0) {	if(!$alignarray) { $t_align	=	"left"; } else {$t_align	=	$alignarray[$t_r_count]; }}
				elseif($t_r_count == count($titlelist)-1) {	if(!$alignarray) { $t_align	=	"right"; } else {$t_align	=	$alignarray[$t_r_count]; }}
				else {	if(!$alignarray) { $t_align	=	"center"; } else {$t_align	=	$alignarray[$t_r_count]; }}
				print '<td style="text-align: '.$t_align.';">'.$value1.'</td>';
				$t_r_count	=	$t_r_count	+ 1;}				
			print '</tr>';}}
		print '</table>';}
		
		
	// Table with Search Function
	function m_table_complex($title, $array, $titlelist, $formid = "", $alignarray = false, $imgeforlist = "generic"){
		$colspan	=	count($titlelist);
		print '<form method="post"  id="mtcomplex_'.$formid.'"><input type="submit" style="display:none;">';
		print_barre_liste($title, NULL, $_SERVER["PHP_SELF"], NULL, NULL, NULL, NULL, NULL, NULL, $imgeforlist);
		print '<table class="tagtable liste">';
			if(!empty($array)) {
				print '<tr class="liste_titre">';$tcount	=	0;
				foreach( $array[0] as $key => $value ){
					$tmp_placeholder = $titlelist[$tcount];$tcount = $tcount + 1;
					$tmp_value = @htmlspecialchars($_POST['mtc_'.$key]);
					print '<th><input type="text" name="mtc_'.$key.'" value="'.@$tmp_value.'" placeholder="'.$tmp_placeholder.'">';
						if(!empty($tmp_value)) { echo '<br />Active Search:<br /><font size="-1">'.$tmp_value.'</font>'; }
						print '</th>';					
					}
				print '</tr>';}
						print '<tr class="liste_titre">';$t_r_count	= 0 ;
			foreach( $titlelist as $key => $value ){
				if($t_r_count == 0) {	if(!$alignarray) { $t_align	=	"left"; } else {$t_align	=	$alignarray[$t_r_count]; }}
				elseif($t_r_count == count($titlelist)-1) {	if(!$alignarray) { $t_align	=	"right"; } else {$t_align	=	$alignarray[$t_r_count]; }}
				else {	if(!$alignarray) { $t_align	=	"center"; } else {$t_align	=	$alignarray[$t_r_count]; }}
				//print '<th class="liste_titre" style="text-align: '.$t_align.';">'.$value.'</th>';
				print_liste_field_titre($value, $_SERVER["PHP_SELF"], NULL, NULL, NULL, "style='text-align: ".$t_align.";'");
				$t_r_count	=	$t_r_count	+ 1;}print '</tr>';
		if(empty($array)) {print '<tr class="oddeven"><td colspan="'.$colspan.'" style="text-align: center"><i>Keine Daten vorhanden...</i></td></tr>'; } else {
			$didfound = false;
			foreach( $array as $key => $value ){
					$search_relevant	=	true;
					foreach( $array[$key] as $key1 => $value1 ){
						if(isset($_POST["mtc_".$key1]) AND @trim($_POST["mtc_".$key1]) != "") {if(strpos($value1, $_POST["mtc_".$key1]) <= -1) {$search_relevant	=	false;}}}							
				if($search_relevant) {
					print '<tr class="oddeven">';
					$t_r_count	=	0;
					foreach( $array[$key] as $key1 => $value1 ){
						if($t_r_count == 0) {	if(!$alignarray) { $t_align	=	"left"; } else {$t_align	=	$alignarray[$t_r_count]; }}
						elseif($t_r_count == count($titlelist)-1) {	if(!$alignarray) { $t_align	=	"right"; } else {$t_align	=	$alignarray[$t_r_count]; }}
						else {	if(!$alignarray) { $t_align	=	"center"; } else {$t_align	=	$alignarray[$t_r_count]; }}
						print '<td style="text-align: '.$t_align.';">'.$value1.'</td>';
						$t_r_count	=	$t_r_count	+ 1;$didfound = true;}print '</tr>';}}
			if(!$didfound) {print '<tr class="oddeven"><td colspan="'.$colspan.'" style="text-align: center"><i>Keine Daten vorhanden...</i></td></tr>';}}
		print '</table></form>';}	


	// Get a Multiple Array with $array[COUNT]["fieldname"] = $value back.
	function m_db_rows($db, $query){ $sql_res = $db->query($query); if ($sql_res) { if ($db->num_rows($sql_res) > 0) { $count = $db->num_rows($sql_res); $row = array(); for ($i=0; $i<$count; $i++){$tmpnow = get_object_vars($db->fetch_object($sql_res)); $row[$i] = $tmpnow;} return $row; } else { return false; }} else { return false; }}	
	// Get a Single Array with $array["fieldname"] = $value back.
	function m_db_row($db, $query){ $sql_res = $db->query($query); if ($sql_res) { if ($db->num_rows($sql_res) > 0) { $tmpnow = get_object_vars($db->fetch_object($sql_res));  $row = $tmpnow; return $row; } else { return false; }} else { return false; }}		
	// Insert into a Database with array ["fieldname"] = $value;
	function m_db_row_insert($db, $table, $array, $filter = true){ if(!is_array($array)) {return false;} $build_first	=	""; $build_second	=	""; $firstrun = true; foreach( $array as $key => $value ){ if(!$firstrun) {$build_first .= ", ";} if(!$firstrun) {$build_second .= ", ";} $build_first .= $key; $valuex = $value; if($filter) {$valuex = str_replace("\\", "\\\\", htmlspecialchars($valuex));} else {$valuex = str_replace("\\", "\\\\", $valuex);} $valuex = str_replace("'", "\\'", $valuex); $build_second .= "'".$valuex."'"; $firstrun = false;} $db->query('INSERT INTO '.$table.'('.$build_first.') VALUES('.$build_second.');');}
	/* Get Array by provising a finished result */
	function m_db_rowsbycleanresult($db, $sql_res){ if ($sql_res) { if ($db->num_rows($sql_res) > 0) { $count = $db->num_rows($sql_res); $row = array(); for ($i=0; $i<$count; $i++){$tmpnow = get_object_vars($db->fetch_object($sql_res)); $row[$i] = $tmpnow;} return $row; } else { return false; }} else { return false; }}

				   
	class m_class_mastertable {
		// Class Vars Default in Constructor
		private $db				=   false; // Dolibarr DB Object
		private $table_id		=   false; // This Tables ID for Get Requests
		private $table_title	=   false; // This Tables ID for Get Requests
		// Class Vars Default in addColumn
		private $column_array	=	false; // This Tables Array with all Columns available
		// Class Vars Default in init		
		private $query			=	false; // Query for Executions
		private $conf_sort_order 		= false; // default_sort_order
		private $conf_paramsadd  		= false; // default_sort_order
		private $conf_sort_field 		= false; // default_sort_field
		private $conf_limit	     		= false; // default_limit
		private $conf_page 	     		= false; // default_page
		private $result_all_rows		= false; // After Init to save all fetched rows
		private $result_fetched_rows	= false; // After Init to save result fetched rows

		// Construct the Class
		function __construct($db, $tabletitle, $tableid = "") {	$this->db = $db; $this->column_array = array(); $this->table_id = $tableid; $this->table_title = $tabletitle; }
		
		// Add a Column for the Table with parameters
		public function addColumn($field_name, $view_name, $style = "left", $enabled = true, $search = true, $sort = true, $sqlexec = false, $orderexec = false)  {  
			$tmp = array();
			$tmp["fieldname"]	=	$field_name;   // Array Key Name of Column
			$tmp["sqlexec"]		=	$sqlexec;   // Array Key Name of Column
			$tmp["orderexec"]	=	$orderexec;   // Array Key Name of Column
			$tmp["viewname"]	=	$view_name;   // Display Name of Column
			$tmp["style"]		=	$style;	  // Style of Column
			$tmp["search"]		=	$search;  // Does this Column support Search Function
			$tmp["sort"]		=	$sort;	  // Does this Column support Sorting Function		
			if($enabled == true OR $enabled == 1) { array_push($this->column_array ,$tmp); } 
		}		
		
		// Init the Data and Init Table Preperations
		public function init($query, $default_limit = 50, $default_sort_order = "DESC", $default_sort_field = "rowid", $default_page = 1, $conf_paramsadd = "") {
			// Sorting Field Preperations
			if( GETPOST('sortfield', 'alpha') ) { 
				$this->conf_sort_field = GETPOST("sortfield", 'alpha'); 
			} else { $this->conf_sort_field = $default_sort_field; }
			if(trim(@$this->conf_sort_field) == "" OR !@$this->conf_sort_field) { $this->conf_sort_field = $default_sort_field; }
			$_GET["sortfield"] = $this->conf_sort_field; 
			$_POST["sortfield"] = $this->conf_sort_field;		
		
			// Sort Order Preperations
			$this->conf_sort_order 		= GETPOST("sortorder", 'alpha') ? GETPOST('sortorder', 'alpha') : $default_sort_order; 
			if(trim(@$this->conf_sort_order) != "asc" AND trim(@$this->conf_sort_order) != "desc") {$this->conf_sort_order = "desc";}
			$_GET["sortorder"] = $this->conf_sort_order; $_POST["sortorder"] = $this->conf_sort_order;			
			  
			// Limit Preperations
			$this->conf_limit = GETPOST('limit', 'int') ? GETPOST('limit', 'int') : $default_limit;	
			if(trim(@$this->conf_limit) == "" OR !@$this->conf_limit) {$this->conf_limit = $default_limit;}
			if(is_numeric(trim(@$_POST["limit"]))) {$this->conf_limit = trim($_POST["limit"]);}
			$_GET["limit"] = $this->conf_limit; $_POST["limit"] = $this->conf_limit;	
			
			// Extend Query with Search Variables from top if there are some // Add Params
			$this->conf_paramsadd = "";
			
			// Columns and Sort / Execs / Search
			$orderstring = $this->conf_sort_field; 
			foreach($this->column_array as $key => $value) {
				if(!$value["orderexec"]) {}
				elseif($value["fieldname"] == $this->conf_sort_field) { $orderstring = $value["orderexec"]; }
				if((is_string($_POST["mct_".$this->table_id.$value["fieldname"]]) OR is_numeric($_POST["mct_".$this->table_id.$value["fieldname"]])) AND trim(@$_POST["mct_".$this->table_id.$value["fieldname"]]) != "") {
					if(!$value["sqlexec"]) { $query .= " AND `".$value["fieldname"]."` LIKE \"%".$this->db->escape(urldecode($_POST["mct_".$this->table_id.$value["fieldname"]]))."%\" "; }
					else { $query .= " AND ".$value["sqlexec"]." LIKE \"%".$this->db->escape(urldecode($_POST["mct_".$this->table_id.$value["fieldname"]]))."%\" "; }
					$_POST["mct_".$this->table_id.$value["fieldname"]] = urldecode($_POST["mct_".$this->table_id.$value["fieldname"]]);
					$_GET["mct_".$this->table_id.$value["fieldname"]] = urldecode($_POST["mct_".$this->table_id.$value["fieldname"]]);
				} elseif((is_string($_GET["mct_".$this->table_id.$value["fieldname"]]) OR is_numeric($_GET["mct_".$this->table_id.$value["fieldname"]])) AND trim(@$_GET["mct_".$this->table_id.$value["fieldname"]]) != "" AND @$_POST["direct"] != "true") {
					if(!$value["sqlexec"]) { $query .= " AND `".$value["fieldname"]."` LIKE \"%".$this->db->escape(urldecode($_GET["mct_".$this->table_id.$value["fieldname"]]))."%\" ";}
					else { $query .= " AND ".$value["sqlexec"]." LIKE \"%".$this->db->escape(urldecode($_GET["mct_".$this->table_id.$value["fieldname"]]))."%\" "; }
					$_POST["mct_".$this->table_id.$value["fieldname"]] = urldecode($_GET["mct_".$this->table_id.$value["fieldname"]]);
					$_GET["mct_".$this->table_id.$value["fieldname"]] = urldecode($_GET["mct_".$this->table_id.$value["fieldname"]]);
				}
			}
			
			// Pages Preperations
			if(is_numeric(GETPOST("page", 'int'))) {$this->conf_page		= GETPOST("page", 'int') + 1; }
			$this->conf_page		= @GETPOSTISSET('pageplusone', 'int') ? (@GETPOST('pageplusone', 'int')) : $this->conf_page;
			if (empty($this->conf_page) || $this->conf_page == -1 || GETPOST('button_search', 'alpha') || GETPOST('button_removefilter', 'alpha')) {$this->conf_page = 1;}	
			$this->conf_page = $this->conf_page - 1;$_GET["page"] = $this->conf_page; $_POST["page"] = $this->conf_page;
			
			// Get Offset From Limit and Current Page
			$offset = $this->conf_limit * $this->conf_page;
			$qnew	 = $query;
			//$qnew 	.= $this->db->order($this->conf_sort_field, $this->conf_sort_order);
			$qnew 	.= "ORDER BY ".$orderstring." ".$this->conf_sort_order;
			$ewnrs = $this->db->query($qnew);
			$curcount = $this->db->num_rows($qnew);
			if($curcount < $offset) { $offset = 0;}
			$qnew 	.= $this->db->plimit($this->conf_limit, $offset);
			//$ewnrs = $this->db->query($qnew);
			$curcount1 = $this->db->num_rows($qnew);			

			// Save Query
			$this->query = $qnew;
			
			// Save Result Counters
			$this->result_all_rows  	= $curcount;
			$this->result_fetched_rows 	= $curcount1;
			
			// Add Needed Params
			$this->conf_paramsadd .= '&limit='.$this->conf_limit;	
			//$this->conf_paramsadd .= '&page='.urlencode($this->conf_page);
			$this->conf_paramsadd .= $conf_paramsadd;
		}							

		// Get the Results array to work with!
		public function prepareArray() {
			$array = array();
			$sql_res = $this->db->query($this->query);
			if ($sql_res) { if ($this->db->num_rows($sql_res) > 0) { $count = $this->db->num_rows($sql_res);  for ($i=0; $i<$count; $i++){
				array_push($array, get_object_vars($this->db->fetch_object($sql_res))); 
			}}} return $array;}

		// Show the Table	
		public function printTable($array, $tableimage = "", $cursiteurl = false, $hidelimit = 0, $hidetools = 0, $morecss = "", $donotsuggestlistofpages = 1, $extraparam = array()) {
			if(!is_string($cursiteurl)) { $cursiteurl = $_SERVER["PHP_SELF"]; }
			print '<div id="div-table-responsive" id="m_cmfull_'.@$this->table_id.'">';
			print '<form method="get"><input type="submit" style="display: none;">';		
			print '<input type="hidden" name="token" value="'.newToken().'">';
			print '<input type="hidden" name="action" value="list">';
			print '<input type="hidden" name="direct" value="true">';
			print '<input type="hidden" name="sortfield" value="'.@$this->conf_sort_field.'">';
			print '<input type="hidden" name="sortorder" value="'.@$this->conf_sort_order.'">';
			print '<input type="hidden" name="limit" value="'.@$this->conf_limit.'">';
			print '<input type="hidden" name="page" value="'.@$this->conf_page.'">';

			foreach($extraparam as $key => $value) {
				print '<input type="hidden" name="'.$key.'" value="'.$value.'">';
			}
			
			foreach($this->column_array as $key => $value) {
				$this->conf_paramsadd .= '&mct_'.$this->table_id.$value["fieldname"].'='.urlencode($_POST["mct_".$this->table_id.$value["fieldname"]]);	
			}

			# Dolibarr Table Head
			print_barre_liste($this->table_title, // Title of the Table
								@$this->conf_page, // Current Page
								@$cursiteurl, // Current Site URL
								@$this->conf_paramsadd, // Current Params for URL on titles for Sort
								@$this->conf_sort_field,
								@$this->conf_sort_order,
								"", // more HTML center
								@$this->result_fetched_rows, // Records found by Select
								@$this->result_all_rows, // All Found by Select Number
								@$tableimage, // Image for List
								0, // 1 Is Fullpathimage 0 if not
								"", // more html right
								$morecss, // more CSS
								$this->conf_limit, // Limits for Rows
								$hidelimit,  // Hide Limit Selection
								$hidetools,  // Hide Navigation Tools 
								$donotsuggestlistofpages); // Do not suggest list of pages

			# Print Table Start Div
			print '<table class="tagtable liste">';

			// Print Search Fields
			print '<tr class="liste_titre">';	
				foreach( $this->column_array as $keyc => $valuec ){							
					if($valuec["search"] == 1) {
						$tmp_placeholder = $valuec["viewname"];
						$tmp_value = @htmlspecialchars($_POST['mct_'.$this->table_id.$valuec["fieldname"]]);
						print '<th style="'.$valuec["style"].'"><input type="text" name="mct_'.$this->table_id.$valuec["fieldname"].'" value=\''.@$tmp_value.'\' placeholder="'.$tmp_placeholder.'">';
					} else {
						print '<th style="'.$valuec["style"].'"><input type="text" name="mct_'.$this->table_id.$valuec["fieldname"].'" value=\''.@$tmp_value.'\' placeholder="'.$tmp_placeholder.'" readonly style="background: lightgrey;">';
					}
					if(is_string($_POST['mct_'.$this->table_id.$valuec["fieldname"]]) AND $_POST['mct_'.$this->table_id.$valuec["fieldname"]] != "") {
						echo '<br /><font size="-2"><b>Suche:</b> '.htmlspecialchars($_POST['mct_'.$this->table_id.$valuec["fieldname"]]).'</font>';
					}
					echo '</th>';
				}
			print '</tr>';

			// Print Titles
			if(is_array($this->column_array)) {
				print '<tr class="liste_titre">';
					foreach( $this->column_array as $key => $value ){
						if($value["sort"] == 1) {$tmpgetsort	=	$value["fieldname"];} else{$tmpgetsort	=	NULL;}
						print_liste_field_titre($value["viewname"], $cursiteurl, $tmpgetsort, $this->conf_paramsadd, "", "style='".$value["style"]."d'", @$this->conf_sort_field, @$this->conf_sort_order);
					}
				print '</tr>';
			}

			// Print Data //////////////////////////////////////////////////////////////////////////////////////////////////////////
			$didfound = false;
			if(is_array($array)) {
				foreach( $array as $key => $value ){
					print '<tr class="oddeven">';
					foreach( $array[$key] as $key1 => $value1 ){
						foreach( $this->column_array as $keycc => $valuecc ){
							if($valuecc["fieldname"] == $key1) {
								print '<td style="'.$valuecc["style"].'">'.$value1.'</td>';		
							} 						
						}
					}
					print '</tr>'; $didfound = true;
				}
			}

			# Print info if nothing found
			if(!$didfound) {print '<tr class="oddeven"><td colspan="'.count($this->column_array).'" style="text-align: center"><i>Keine Daten vorhanden...</i></td></tr>';}
			
			# Finish
			print '</table></form></div>';
		}				
		
		/////////////////////////////////////////////////
		// Enable Filters
		/*public function enableFilters($table, $user_id, $show = true, $adds = true, $filterid = false) {
			if(!$table_id) { $table_id = $this->table_id;  }
			// Set the Needed Variables
			$this->filter_active 	 = true;
			$this->filter_table 	 = $table;
			$this->filter_user_id 	 = $user_id;
			
			$this->filter_show 		 = $show;
			$this->filter_adds 		 = $adds;
			
			if(!$filterid) { if(is_numeric($_GET[$this->table_id."filterid"])) { $this->filter_current_id = $_GET[$this->table_id."filter"]; } else { $this->filter_current_id = false;  }  }
			else { if(is_numeric($_GET[$this->table_id."filterid"])) { $this->filter_current_id = $_GET[$this->table_id."filter"]; } else { $this->filter_current_id = $filterid; }  }
			// Get the Filters Array
			$this->filter_array 	= is_array();
			$sql_res = $this->db->query("SELECT * FROM ".$this->filter_table." WHERE table_id = '".$this->filter_current_id."' AND user_id = '".$this->filter_user_id."' ORDER BY is_default DESC");
			if ($sql_res) { if ($this->db->num_rows($sql_res) > 0) { $count = $this->db->num_rows($sql_res);  for ($i=0; $i<$count; $i++){
				array_push($this->filter_array, get_object_vars($this->db->fetch_object($sql_res))); 
			}}}}*/
		/////////////////////////////////////////////////
		// Show the Filters
		/* public function printFilters($formlocations) {
			if($this->filter_show) {
				echo '<div id="m_mtf_'.$this->table_id.'" class="m_masterTable_filter"><select onchange="window.location.href = \''.$formlocations.'\'">'; 
				$tmpdisplay = ""; foreach( $this->filter_array as $key => $value ){
					if( $value["is_default"] == 1 ) { $tmpdisplay = "<option value='".$value["id"]."'>".$value["filter_name"]."</option>"; } else { $tmpdisplay = '<option value="0">Aktuell: Kein Filter</option>'; }
				} echo $tmpdisplay;
				foreach( $this->filter_array as $key => $value ){ if( $value["is_default"] != 1 ) { echo "<option value='".$value["id"]."'>".$value["filter_name"]."</option>"; } } echo '</select>'; 
				if($this->filter_adds) {
					echo '<button onclick=\'$( "#m_mtfs_'.$this->table_id.'" ).toggle();\'>Filtereinstellungen</a>';
					echo '<div id="m_mtfs_'.$this->table_id.'" style="display: none;width: 100%; text-align: right; position: absolute; background: yellow; max-width: 250px;z-index: 1000 !important;right: 2%;">';	
					echo '<form method="post" action="'.$formlocations.'">';
					$isediting  = false; foreach( $this->filter_array as $keyx => $value1 ){ if($value1["id"] == $this->filter_current_id) {$isediting = $value1;} }
					foreach( $this->column_array as $key => $value ){
						if(is_array($isediting)) {
							if (in_array($value["fieldname"],  unserialize($isediting["ar_fields"]))) {
								 echo "<div style='float: left;text-align: left;'><input type='checkbox' name='m_mtc_".$this->table_id."_".$value["fieldname"]."' checked>".$value["viewname"]."</div>";
							} else { echo "<div style='float: left;;text-align: left;'><input type='checkbox' name='m_mtc_".$this->table_id."_".$value["fieldname"]."'>".$value["viewname"]."</div>";	}
						} else { echo "<div style='float: left;;text-align: left;'><input type='checkbox' name='m_mtc_".$this->table_id."_".$value["fieldname"]."'>".$value["viewname"]."</div>";	}	
					}	
					if(is_array($isediting)) { echo '<input type="submit" name="m_mtcse_'.$this->table_id.'" value="Filter Bearbeiten"><input type="hidden" name="m_mtch_'.$this->table_id.'" value="'.$this->filter_current_id.'">';} 
					else {echo '<input type="submit" name="m_mtcsa_'.$this->table_id.'" value="Filter Erstellen"><input type="text" name="m_mtcsn_'.$this->table_id.'" value="'.$isediting["filter_name"].'" placeholder="Filter-Name">';}
					echo '</form></div>';
				} echo '</div>';	
			}
		}*/		
	}		

	// Check if a Var is Set
	function m_isset($var){if(!empty($var) AND $var != NULL AND trim($var) != "") {return true;}return false;}
	// Get the current rowID of logged in User, if error than false
	function m_login_id($db){ $result = m_db_row($db, 'SELECT * FROM ' . MAIN_DB_PREFIX . 'user WHERE login = "' . @$_SESSION["dol_login"] . '"'); if(!$result) {return false;}return $result["rowid"];}	
	// Get the current name of User by UserID, if error than false
	function m_login_name_from_id($db, $userid){ $result = m_db_row($db, 'SELECT * FROM ' . MAIN_DB_PREFIX . 'user WHERE rowid = "' . $userid . '"'); if(!$result) {return false;} return $result["login"];}
	// Month Number to Name
	function m_month_num_to_name($number) {
		if($number == 1) { return "Januar";}
		if($number == 2) { return "Februar";}
		if($number == 3) { return "März";}
		if($number == 4) { return "April";}
		if($number == 5) { return "Mai";}
		if($number == 6) { return "Juni";}
		if($number == 7) { return "Juli";}
		if($number == 8) { return "August";}
		if($number == 9) { return "September";}
		if($number == 10) { return "Oktober";}
		if($number == 11) { return "November";}
		if($number == 12) { return "Dezember";}
		return "Error !";
	};
