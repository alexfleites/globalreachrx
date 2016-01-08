<?php
	/*
	* =======================================================================
	* FILE NAME:        main.php
	* DATE CREATED:  	28-12-2015
	* FOR TABLE:  		patients
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	//_users	
	if(get('view')=='_users'){
	include(APP_FOLDER.'/controllers/admin/_users.php');
	$patients_controller = new _users_controller();
	$patients_controller->invoke__users();
	}
	//cards	
	if(get('view')=='cards'){
	include(APP_FOLDER.'/controllers/admin/cards.php');
	$patients_controller = new cards_controller();
	$patients_controller->invoke_cards();
	}
	//country	
	if(get('view')=='country'){
	include(APP_FOLDER.'/controllers/admin/country.php');
	$patients_controller = new country_controller();
	$patients_controller->invoke_country();
	}
	//hfiles	
	if(get('view')=='hfiles'){
	include(APP_FOLDER.'/controllers/admin/hfiles.php');
	$patients_controller = new hfiles_controller();
	$patients_controller->invoke_hfiles();
	}
	//patients	
	if(get('view')=='patients'){
	include(APP_FOLDER.'/controllers/admin/patients.php');
	$patients_controller = new patients_controller();
	$patients_controller->invoke_patients();
	}
	//system_users	
	if(get('view')=='system_users'){
	include(APP_FOLDER.'/controllers/admin/system_users.php');
	$patients_controller = new system_users_controller();
	$patients_controller->invoke_system_users();
	}
	?>