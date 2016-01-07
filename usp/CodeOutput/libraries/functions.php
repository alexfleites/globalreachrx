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
if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
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
  //send headers
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
	 //msgs
	function success_msg($dmsg){
	print('<div class="heze-notify progress-bar-success">
  <p>'.$dmsg.'</p>
  </div>
	');	
	}
	function error_msg($dmsg){
	print('<div class="heze-notify progress-bar-danger">
  <p>'.$dmsg.'</p>
  </div>
	');	
	}

	//TinyMCE editor
	function HezecomEditor($txteditor){
	print('
<script>
tinymce.init({
    selector: "textarea.'.$txteditor.'",
    theme: "modern",
    width: "auto",
    height: 200,
    plugins: [
         "advlist autolink link image lists charmap  preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality   paste textcolor jbimages"
   ],
   toolbar: "styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink  jbimages | print preview ", 
  
		relative_urls: false
 }); 
</script>
	');	
	}
	
	//File
	function delete_files($folder){
	  if(is_file($folder))
	unlink($folder);
		}
	//dir
	function app_dir($folder=NULL){
	$base = str_replace($folder,'',dirname(__FILE__));
	return str_replace('\\','/',$base);
	}

	//paging
	function pagination($query,$per_page = 10,$url=NULL,$page = 1){ 
		$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    	$total = $query;
        $splitter = "2";
		$url1=$url."&page=";
    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;
		
		$firstPage = 1;
		$prev = ($page == 1)? 1:$page - 1;
								
    	$prev = $page - 1;							
    	$next = $page + 1;
        $lastpage = ceil($total/$per_page);
    	$lpm1 = $lastpage - 1;
    	$hezpaging = "";
    	if($lastpage > 1)
    	{	
    	$hezpaging .= "<ul class='hezpaging'>";
        $hezpaging .= "<li class='details'>".LANG_PAGE." $page of $lastpage</li>";

		if ($page == 1)
		{
		$hezpaging.= "<li><a class='current'>".LANG_FIRST."</a></li>";
		$hezpaging.= "<li><a class='current'>".LANG_PREVIOUS."</a></li>";
		}
		else
		{
		$hezpaging.= "<li><a href='".$url1."$firstPage'>".LANG_FIRST."</a></li>";
		$hezpaging.= "<li><a href='".$url1."$prev'>".LANG_PREVIOUS."</a></li>"; 
		}

    		if ($lastpage < 7 + ($splitter * 2)){	
    		for ($counter = 1; $counter <= $lastpage; $counter++){
    		if ($counter == $page)
    		$hezpaging.= "<li><a class='current'>$counter</a></li>";
    		else
    		$hezpaging.= "<li><a href='".$url1."$counter'>$counter</a></li>";					
    		}}
    		elseif($lastpage > 5 + ($splitter * 2)){
    		if($page < 1 + ($splitter * 2)){
    		for ($counter = 1; $counter < 4 + ($splitter * 2); $counter++){
    		if ($counter == $page)
    		$hezpaging.= "<li><a class='current'>$counter</a></li>";
    		else
    		$hezpaging.= "<li><a href='".$url1."$counter'>$counter</a></li>";					
    		}
    		$hezpaging.= "<li class='dot'>...</li>";
    		$hezpaging.= "<li><a href='".$url1."$lpm1'>$lpm1</a></li>";
    		$hezpaging.= "<li><a href='".$url1."$lastpage'>$lastpage</a></li>";		
    		}
    		elseif($lastpage - ($splitter * 2) > $page && $page > ($splitter * 2)){
    		$hezpaging.= "<li><a href='".$url1."1'>1</a></li>";
    		$hezpaging.= "<li><a href='".$url1."2'>2</a></li>";
    		$hezpaging.= "<li class='dot'>...</li>";
    		for ($counter = $page - $splitter; $counter <= $page + $splitter; $counter++){
    		if ($counter == $page)
    		$hezpaging.= "<li><a class='current'>$counter</a></li>";
    		else
    		$hezpaging.= "<li><a href='".$url1."$counter'>$counter</a></li>";					
    		}
    		$hezpaging.= "<li class='dot'>..</li>";
    		$hezpaging.= "<li><a href='".$url1."$lpm1'>$lpm1</a></li>";
    		$hezpaging.= "<li><a href='".$url1."$lastpage'>$lastpage</a></li>";		
    		}else{
    		$hezpaging.= "<li><a href='".$url1."1'>1</a></li>";
    		$hezpaging.= "<li><a href='".$url1."2'>2</a></li>";
    		$hezpaging.= "<li class='dot'>..</li>";
    		for ($counter = $lastpage - (2 + ($splitter * 2)); $counter <= $lastpage; $counter++){
    		if ($counter == $page)
    		$hezpaging.= "<li><a class='current'>$counter</a></li>";
    		else
    		$hezpaging.= "<li><a href='".$url1."$counter'>$counter</a></li>";					
    		}}}
    		if ($page < $counter - 1){ 
    		$hezpaging.= "<li><a href='".$url1."$next'>".LANG_NEXT."</a></li>";
            $hezpaging.= "<li><a href='".$url1."$lastpage'>".LANG_LAST."</a></li>";
    		}else{
    		$hezpaging.= "<li><a class='current'>".LANG_NEXT."</a></li>";
            $hezpaging.= "<li><a class='current'>".LANG_NEXT."</a></li>";
            }
    		$hezpaging.= "</ul>\n";		
    	}
        return $hezpaging;
    }
	function pageparam($limit){
	$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    return ($page * $limit) - $limit;
	}
	
	//Form Messages
	function form_errors($errors){
	if(empty($errors) === false){
	echo '<div class="alert alert-danger">'.implode($errors).'</div>';	
	}	
	}
	
	//Password Hashing
	function hezecom_crypt($info,$encdata=false) 
	{ 
	$strength = "08"; 
  	if ($encdata) { 
    if (substr($encdata, 0, 60) == crypt($info, "$2a$".$strength."$".substr($encdata, 60))) { 
      return true; 
    } else { 
	return false; 
    } 
	} else { 
	$salt = ""; 
	for ($i = 0; $i < 22; $i++) { 
    $salt .= substr("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789", mt_rand(0, 63), 1); 
	} 
	return crypt($info, "$2a$".$strength."$".$salt).$salt; 
	} 
	}
	//user position
	function check_position($val){
	$result='';
	if($val==1){$result.='Super Administrator';}
	elseif($val==2){$result.='Administrator';}
	return $result;
	}
	//status
	function check_status($val){
	$result='';
	if($val==1){$result.='<a class="btn btn-success btn-sm">Active</a>';}
	elseif($val==0){$result.='<a class="btn btn-danger btn-sm">Inactive</a>';}
	return $result;
	}
	
	//CSV EXPORT
	/*
	USAGE
	DownloadSentHeaders('filename.csv');
	echo SendRecord2CSV($array);
	die();
	*/
	function SendRecord2CSV(array &$array)
	{
   if (count($array) == 0) {
     return null;
   }
   ob_start();
   $hezfile = fopen("php://output", 'w');
   fputcsv($hezfile, array_keys(reset($array)));
   foreach ($array as $row) {
      fputcsv($hezfile, $row);
   }
   fclose($hezfile);
   return ob_get_clean();
}

	function DownloadSentHeaders($filename) {
		// disable caching
		$now = gmdate("D, d M Y H:i:s");
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");
		// force download  
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		// disposition / encoding on response body
		header("Content-Disposition: attachment;filename={$filename}");
		header("Content-Transfer-Encoding: binary");
	}
	
	//MESSAGES
	function json_error($errors){
	die('<div class="alert alert-danger">'.$errors.'</div>');	
	}
	function json_success($success){
	die('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$success.'</div>');	
	}
	
	function json_send($success){
	echo'<script>window.location.replace("'.$success.'");</script>';
	}
	
	//QUICK SEARCH
function AjaxSearchSuggest($url){
	$jss="
	<script>
	asearch.load();
	asearch.setOnLoadCallback(function()
	{
		// Fade out the suggestions box when not active
		 $('input').blur(function(){
			$('#suggestions').fadeOut();
		 });
	});";
	$jss.="
	function lookup(inputString) {
		if(inputString.length == 0) {
			$('#suggestions').fadeOut(); // Hide the suggestions box
	} else {
		
	$.post('".$url."', {qstring:";$jss.=' ""+inputString+""}, function(data) { 
		';$jss.="$('#suggestions').fadeIn();
		$('#suggestions').html(data);
			});
		}
	}
	</script>
    ";
	print($jss);
	}
	//pass generator
	function Password_Generator($limit=6) 
	{
	 $generator = ""; 
	for ($i = 0; $i < $limit; $i++) { 
    $generator .= substr("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789", mt_rand(0, 63), 1); 
	} 
	return $generator;
	}
?>


