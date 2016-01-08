<?php
		//For Handling Ajax Call and Exports
		ob_start();
		session_start();
		include('config/config.php');
		include('language/eng.php');
		include('libraries/functions.php');
		include_once('libraries/class_dbcon.php');
		include_once('libraries/upload_class.php');
		include_once('libraries/system_users.php');
		$haccess = new admin_users_model();
		$acc=$haccess->UserAccess();
	
		if(get('view') and get('pg')=='admin'){
		
		include(APP_FOLDER.'/controllers/admin/main.php');
		include('libraries/controllers/system_users.php');
		}
		
		ob_end_flush();
	
?>