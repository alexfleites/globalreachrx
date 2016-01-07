<?php 
/*
	HEZECOM PHP CODE GENERATOR ULTIMATE (UltimateSpeed)
	Author: Hezecom Technologies (http://hezecom.com) info@hezecom.net
	COPYRIGHT 2014 ALL RIGHTS RESERVED
	FILE NAME functions.php 
	
	You must have purchased a valid license from CodeCanyon.com in order to have 
	access this file.

	You may only use this file according to the respective licensing terms 
	you agreed to when purchasing this item.
*/
	//post
  function post($var)
  {
      if (isset($_POST[$var]))
          return $_POST[$var];
  }
  //get
  function get($var)
  {
      if (isset($_GET[$var]))
          return $_GET[$var];
  }
  function send_to($direction)
  	{
      if (!headers_sent()) {
          header('Location: ' . $direction);
		  exit;
	  } else
          print '<script type="text/javascript">';
          print 'window.location.href="' . $direction . '";';
          print '</script>';
          print '<noscript>';
          print '<meta http-equiv="refresh" content="0;url=' . $direction . '" />';
          print '</noscript>';
  	}
	//seure sql injection can be improved
	function sanitize($value) {
	$sanitz = mysql_real_escape_string(filter_var($value,FILTER_SANITIZE_STRING));
	return $sanitz;
	}

	function empty_folder($folder){
		foreach($folder as $folder){
	  if(is_file($folder))
	unlink($folder);
	}
	}
	function lowercase($table){
	return strtolower($table);	
	}
	//Directory
	function CreateDir($dirName, $rights=0777){
    $dirs = explode('/', $dirName);
    $dir='';
    foreach ($dirs as $part) {
        $dir.=$part.'/';
        if (!is_dir($dir) && strlen($dir)>0)
            mkdir($dir, $rights);
    }
	}
	//Delete Dir
	function RemoveDir($dir) { 
  foreach(glob($dir . '/*') as $file) { 
    if(is_dir($file)) RemoveDir($file); else unlink($file); 
  } rmdir($dir); 
}
	//dir
	function app_dir($folder=NULL){
	$base = str_replace($folder,'',dirname(__FILE__));
	return str_replace('\\','/',$base);
	}

?>
