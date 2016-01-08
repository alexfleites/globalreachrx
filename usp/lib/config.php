<?php
	/*
	HEZECOM UltimateSpeed PHP CODE GENERATOR
	Author: Hezecom Technologies (http://hezecom.com) info@hezecom.net
	COPYRIGHT 2013 ALL RIGHTS RESERVED
	Configuration File
	FILE NAME config.php 
	
	You must have purchased a valid license from CodeCanyon.com in order to have 
	access this file.

	You may only use this file according to the respective licensing terms 
	you agreed to when purchasing this item.
	*/
	

$path=dirname(__FILE__);  
$npath = str_replace('\\', '/', $path); 
$npath= str_replace($_SERVER['DOCUMENT_ROOT'], '', $npath); 
$absolutep= str_replace('config','',$npath);

define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','pass');
define('DB_NAME','db');
define('DB_TYPE','mysql');
define('H_TITLE','Hezecom PHP Code Generator');
define('VIEW_DISPLAY','6');
define('RECORD_PER_PAGE','20');
define('JQUERY_VALIDATE','');
define('CLASS_TYPE','default');
define('UPLOAD_TYPE','imgonly');
define('EDITOR_TYPE','html5');
define('ADMIN_USERNAME','admin');
define('ADMIN_PASSWORD','hezecom');
define('BIG_IMAGE_WIDTH','300');

define('H_DIV','span12');

define('THUMB_IMAGE_WIDTH','150');

//File Upload Table
define('UPLOAD_TABLE','hfiles');
define('FILE_ID','fid');
define('RELATE_ID','relateid');
define('H_FILE','gfile');
define('H_DATE','gdate');

define('FORM_TEMPLATE','Normal');
define('FORM_STYLE','styler');

define('FORMS_PROCESSING','Ajax');
define('PHP_VALIDATION','Enable');
define('PAGINATION_TYPE','Normal');

//Exemption for access
define('H_SYSTEM_ACCESS','system_users');
define('H_USER_SESSION','hezecom_users');
?>