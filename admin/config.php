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
define('DB_USERNAME','lobalre3_printrx');
define('DB_PASSWORD','TI46Tl8@EP0{');
define('DB_NAME','lobalre3_printrxcard');
define('DB_TYPE','mysql');
define('H_TITLE','Global Reach Admin');

define('PAGINATION_TYPE','Normal');//Normal|Jquery

define('RECORD_PER_PAGE','20');

define('BIG_IMAGE_WIDTH','300');
define('THUMB_IMAGE_WIDTH','150');

//Admin Login Info
define('ADMIN_USERNAME','admin');
define('ADMIN_PASSWORD','hezecom');

//Upload Directory
define('UPLOAD_FOLDER','public/uploads/');
define('THUMB_FOLDER','public/uploads/thumbs/');
$base = str_replace('config','',dirname(__FILE__).DIRECTORY_SEPARATOR.'/');
define('UPLOAD_PATH',$base.UPLOAD_FOLDER);
define('THUMB_PATH',$base.THUMB_FOLDER);
define('NO_IMAGE','public/themes/default/images/user_avatar.png');

define('VALID_DIR',1);
define('APP_PATH',$base);
define('APP_FOLDER',APP_PATH.'application');
define('DEFAULT_THEME','public/themes/default');
define('H_THEME',DEFAULT_THEME);
define('H_ADMIN','index.php?pg=admin');
define('H_LOGIN','index.php?pg=login');
define('H_CLIENT','index.php?pg=public');
define('H_ADMIN_MAIN','main.php?pg=admin');
define('H_CLIENT_MAIN','main.php?pg=public');

//Backup Dir 
define('H_BACKUP_DIR','public/backups/');
define('H_EDITOR_FILES',$absolutep.'public/uploads/editor');

//Multiple File Upload
define('UPLOAD_TABLE','hfiles');
define('FILE_ID','fid');
define('RELATE_ID','relateid');
define('H_FILE','gfile');
define('H_DATE','gdate');

//System Access
define('H_SYSTEM_ACCESS','system_users');
define('H_USER_SESSION','hezecom_users');
?>