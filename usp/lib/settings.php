<?php
/*
	HEZECOM UltimateSpeed PHP CODE GENERATOR
	Author: Hezecom Technologies (http://hezecom.com) info@hezecom.net
	COPYRIGHT 2014 ALL RIGHTS RESERVED
	FILE NAME settings.php 
	
	You must have purchased a valid license from CodeCanyon.com in order to have 
	access this file.

	You may only use this file according to the respective licensing terms 
	you agreed to when purchasing this item.
*/

	include('functions.php');
	$base = str_replace('lib','',dirname(__FILE__));
	$mbase = str_replace('\\','/',$base);

	if(isset($_GET['setn'])){
	$phpopen = "<?php
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
	"."\n
"."$"."path=dirname(__FILE__);  
"."$"."npath = str_replace('\\\', '/', "."$"."path); 
"."$"."npath= str_replace("."$"."_SERVER['DOCUMENT_ROOT'], '', "."$"."npath); 
"."$"."absolutep= str_replace('config','',"."$"."npath);

";
	
	$dir = "".$mbase."lib/config.php";
	$dir2 = "".$mbase."CodeOutput/config/config.php";
	if($dir){
	$file = fopen($dir, 'w') or die("can't open file");
	$file2 = fopen($dir2, 'w') or die("can't open file");
	
	//Output
	fwrite($file, $phpopen);
	fwrite($file, "define('LOCALHOST',"."'".$_POST['host'].''."'".')'.';'."\n");
	fwrite($file, "define('DB_USERNAME',"."'".$_POST['username'].''."'".')'.';'."\n");
	fwrite($file, "define('DB_PASSWORD',"."'".$_POST['password'].''."'".')'.';'."\n");
	fwrite($file, "define('DB_NAME',"."'".$_POST['dbname'].''."'".')'.';'."\n");
	fwrite($file, "define('DB_TYPE',"."'".$_POST['dbtype'].''."'".')'.';'."\n");
	fwrite($file, "define('H_TITLE',"."'".$_POST['ptitle'].''."'".')'.';'."\n");
	fwrite($file, "define('VIEW_DISPLAY',"."'".$_POST['display'].''."'".')'.';'."\n");
	fwrite($file, "define('RECORD_PER_PAGE',"."'".$_POST['recordsp'].''."'".')'.';'."\n");
	fwrite($file, "define('JQUERY_VALIDATE',"."'".$_POST['jval'].''."'".')'.';'."\n");
	fwrite($file, "define('CLASS_TYPE',"."'".$_POST['ctype'].''."'".')'.';'."\n");
	fwrite($file, "define('UPLOAD_TYPE',"."'".$_POST['uploadtype'].''."'".')'.';'."\n");
	fwrite($file, "define('EDITOR_TYPE',"."'".$_POST['editortype'].''."'".')'.';'."\n");
	fwrite($file, "define('ADMIN_USERNAME',"."'".$_POST['adminuser'].''."'".')'.';'."\n");
	fwrite($file, "define('ADMIN_PASSWORD',"."'".$_POST['adminpwd'].''."'".')'.';'."\n");
	fwrite($file, "define('BIG_IMAGE_WIDTH',"."'".$_POST['bigsize'].''."'".')'.';'."\n\n");
	fwrite($file, "define('H_DIV',"."'".'span12'.''."'".')'.';'."\n\n");
	fwrite($file, "define('THUMB_IMAGE_WIDTH',"."'".$_POST['thumbsize'].''."'".')'.';'."\n\n//File Upload Table\n");
	
	//MULTIPLE UPLOAD TABLE
	fwrite($file, "define('UPLOAD_TABLE',"."'".'hfiles'.''."'".')'.';'."\n");
	fwrite($file, "define('FILE_ID',"."'".'fid'.''."'".')'.';'."\n");
	fwrite($file, "define('RELATE_ID',"."'".'relateid'.''."'".')'.';'."\n");
	fwrite($file, "define('H_FILE',"."'".'gfile'.''."'".')'.';'."\n");
	fwrite($file, "define('H_DATE',"."'".'gdate'.''."'".')'.';'."\n\n");
	fwrite($file, "define('FORM_TEMPLATE',"."'".$_POST['form_temp'].''."'".')'.';'."\n");
	fwrite($file, "define('FORM_STYLE',"."'".$_POST['form_style'].''."'".')'.';'."\n\n");
	fwrite($file, "define('FORMS_PROCESSING',"."'".$_POST['formpro'].''."'".')'.';'."\n");
	fwrite($file, "define('PHP_VALIDATION',"."'".$_POST['phpval'].''."'".')'.';'."\n");
	fwrite($file, "define('PAGINATION_TYPE',"."'".$_POST['pgtype'].''."'".')'.';'."\n\n//Exemption for access\n");
	fwrite($file, "define('H_SYSTEM_ACCESS',"."'".$_POST['system_access'].''."'".')'.';'."\n");
	fwrite($file, "define('H_USER_SESSION',"."'".$_POST['user_session'].''."'".')'.';'."\n");
	//fwrite($file, "define('UPLOAD_TABLE',"."'".'hfiles'.''."'".')'.';'."\n");

	fwrite($file, "?>");

	fwrite($file2, $phpopen);
	fwrite($file2, "define('LOCALHOST',"."'".$_POST['host'].''."'".')'.';'."\n");
	fwrite($file2, "define('DB_USERNAME',"."'".$_POST['username'].''."'".')'.';'."\n");
	fwrite($file2, "define('DB_PASSWORD',"."'".$_POST['password'].''."'".')'.';'."\n");
	fwrite($file2, "define('DB_NAME',"."'".$_POST['dbname'].''."'".')'.';'."\n");
	fwrite($file2, "define('DB_TYPE',"."'".$_POST['dbtype'].''."'".')'.';'."\n");
	fwrite($file2, "define('H_TITLE',"."'".$_POST['ptitle'].''."'".')'.';'."\n\n");
	
	fwrite($file2, "define('PAGINATION_TYPE',"."'".$_POST['pgtype'].''."'".')'.';'."//Normal|Jquery\n\n");
	fwrite($file2, "define('RECORD_PER_PAGE',"."'".$_POST['recordsp'].''."'".')'.';'."\n\n");
	
	fwrite($file2, "define('BIG_IMAGE_WIDTH',"."'".$_POST['bigsize'].''."'".')'.';'."\n");
	fwrite($file2, "define('THUMB_IMAGE_WIDTH',"."'".$_POST['thumbsize'].''."'".')'.';'."\n\n//Admin Login Info\n");
	
	fwrite($file2, "define('ADMIN_USERNAME',"."'".$_POST['adminuser'].''."'".')'.';'."\n");
	fwrite($file2, "define('ADMIN_PASSWORD',"."'".$_POST['adminpwd'].''."'".')'.';'."\n\n//Upload Directory\n");
	
	fwrite($file2, "define('UPLOAD_FOLDER',"."'".'public/uploads/'.''."'".')'.';'."\n");
	fwrite($file2, "define('THUMB_FOLDER',"."'".'public/uploads/thumbs/'.''."'".')'.';'."\n");
	fwrite($file2, "$"."base = str_replace('config','',dirname(__FILE__).DIRECTORY_SEPARATOR.'/');\n");
	fwrite($file2, "define('UPLOAD_PATH',"."$"."base."."UPLOAD_FOLDER".''."".')'.';'."\n");
	fwrite($file2, "define('THUMB_PATH',"."$"."base."."THUMB_FOLDER".''."".')'.';'."\n");
	fwrite($file2, "define('NO_IMAGE',"."'".'public/themes/default/images/user_avatar.png'.''."'".')'.';'."\n\n");
	
	//app dir
	fwrite($file2, "define('VALID_DIR',".'1'.''.')'.';'."\n");
	fwrite($file2, "define('APP_PATH',"."$"."base"."".''."".')'.';'."\n");
	fwrite($file2, "define('APP_FOLDER',APP_PATH."."'".'application'.''."'".')'.';'."\n");
	fwrite($file2, "define('DEFAULT_THEME',"."'".'public/themes/default'.''."'".')'.';'."\n");
	fwrite($file2, "define('H_THEME',".'DEFAULT_THEME'.''.')'.';'."\n");
	fwrite($file2, "define('H_ADMIN',"."'".'index.php?pg=admin'.''."'".')'.';'."\n");
	fwrite($file2, "define('H_LOGIN',"."'".'index.php?pg=login'.''."'".')'.';'."\n");
	fwrite($file2, "define('H_CLIENT',"."'".'index.php?pg=public'.''."'".')'.';'."\n");
	fwrite($file2, "define('H_ADMIN_MAIN',"."'".'main.php?pg=admin'.''."'".')'.';'."\n");
	fwrite($file2, "define('H_CLIENT_MAIN',"."'".'main.php?pg=public'.''."'".')'.';'."\n\n//Backup Dir \n");
	//backup dir
	fwrite($file2, "define('H_BACKUP_DIR',"."'".'public/backups/'.''."'".')'.';'."\n");
	fwrite($file2, "define('H_EDITOR_FILES',"."$"."absolutep".".'".'public/uploads/editor'."'".')'.';'."\n\n//Multiple File Upload\n");
	//MULTIPLE UPLOAD TABLE
	fwrite($file2, "define('UPLOAD_TABLE',"."'".'hfiles'.''."'".')'.';'."\n");
	fwrite($file2, "define('FILE_ID',"."'".'fid'.''."'".')'.';'."\n");
	fwrite($file2, "define('RELATE_ID',"."'".'relateid'.''."'".')'.';'."\n");
	fwrite($file2, "define('H_FILE',"."'".'gfile'.''."'".')'.';'."\n");
	fwrite($file2, "define('H_DATE',"."'".'gdate'.''."'".')'.';'."\n\n//System Access\n");
	
	fwrite($file2, "define('H_SYSTEM_ACCESS',"."'".$_POST['system_access'].''."'".')'.';'."\n");
	fwrite($file2, "define('H_USER_SESSION',"."'".$_POST['user_session'].''."'".')'.';'."\n");
	
	fwrite($file2, "?>");
	
	include('config.php');
	include_once('class_dbcon.php');
	$db=DB::getInstance();
	$pass="$2a$08";$pass.="$";$pass.="kUH3Ko5akg0aO1BWP37C5eLzO2f0QqxsED9r8yLsJAbgJpXSS2JTKkUH3Ko5akg0aO1BWP37C5e";
	$sql =" CREATE TABLE IF NOT EXISTS `".H_SYSTEM_ACCESS."` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `membership` varchar(30) DEFAULT NULL,
  `user_status` int(11) DEFAULT '0',
  `user_position` int(11) DEFAULT '0',
  `user_avarta` varbinary(100) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `last_updated` date DEFAULT NULL,
  `last_login_date` date DEFAULT NULL,
  `last_login_ip` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO `".H_SYSTEM_ACCESS."` (`userid`, `name`, `email`, `phone`, `username`, `password`, `membership`, `user_status`, `user_position`, `user_avarta`, `date_created`, `last_updated`, `last_login_date`, `last_login_ip`) VALUES
(1, NULL, NULL, NULL, 'admin','".$pass."', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL);

	   ";
	$db->exec($sql); 
	//menu build
	header('Location:../index.php?do=msg');
	fclose($file);
	fclose($file2);
	}
	//Empty Folders
	empty_folder(glob($base.'CodeOutput/application/controllers/admin/*'));
	empty_folder(glob($base.'CodeOutput/application/controllers/public/*'));
	empty_folder(glob($base.'CodeOutput/application/models/classes/*'));
	empty_folder(glob($base.'CodeOutput/application/models/objects/*'));
	RemoveDir($base.'CodeOutput/application/views');
	}
	elseif(isset($_GET['appclear'])){
	//Empty Folders when clear link is clicked
	empty_folder(glob($base.'CodeOutput/application/controllers/admin/*'));
	empty_folder(glob($base.'CodeOutput/application/controllers/public/*'));
	empty_folder(glob($base.'CodeOutput/application/models/classes/*'));
	empty_folder(glob($base.'CodeOutput/application/models/objects/*'));
	RemoveDir($base.'CodeOutput/application/views');

	header('Location:../index.php?cleared=msg');
	}
?>

