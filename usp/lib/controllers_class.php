	<?php
/*
	HEZECOM UltimateSpeed PHP CODE GENERATOR
	Author: Hezecom Technologies (http://hezecom.com) info@hezecom.net
	COPYRIGHT 2014 ALL RIGHTS RESERVED
	FILE NAME controllers_class.php 
	
	You must have purchased a valid license from CodeCanyon.com in order to have 
	access this file.

	You may only use this file according to the respective licensing terms 
	you agreed to when purchasing this item.
	http://codecanyon.net/licenses
*/
 
	class Hezecom_Controller {
		
	function Table_Controller($dfolder,$table,$primkey,$dpg,$post_forms_post){
	//File Checker
	$db=DB::getInstance();
	$myc = $db->query("SHOW COLUMNS FROM $table WHERE TYPE LIKE 'varbinary%'");
	$doutrow=$myc->fetch(PDO::FETCH_OBJ);
	
	//validation
	$validd = $db->query("SHOW COLUMNS FROM $table WHERE Type NOT LIKE 'varbinary%'");
	$validation=$validd->fetchAll(PDO::FETCH_OBJ);
	
	
	$dladd = ''.$dpg.'&view='.$table.'&do=viewall&msg=add';
	$trunc = ''.$dpg.'&view='.$table.'&do=viewall&msg=truncate';
	$dlupdate = "$dpg&view=".$table."&".$primkey."='.post('".$primkey."').'&do=details&msg=update";
	$dldelete1 = "$dpg&view=".$table."&".$primkey."='.get('".$primkey."').'&do=update&msg=delete";
	$dldelete = ''.$dpg.'&view='.$table.'&do=viewall&msg=delete';
	$const="$"."result = "."$"."this->"."$table"."_model";
	$const2="$"."rows = "."$"."this->"."$table"."_model";
	$const3="$"."this->"."$table"."_model";
	$controllers="
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        $table".".php
	* DATE CREATED:  	".date('d-m-Y')."
	* FOR TABLE:  		$table
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/".$table.".php');
	
	class $table"."_controller {
	public "."$"."$table"."_model;
	
	public function __construct()  
    {  
        "."$"."this->"."$table"."_model = new $table"."_model();
    } 
	
	public function invoke"."_"."$table()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	"
	.$const."->SelectAll(RECORD_PER_PAGE);
	"."//Accept get url  e.g (index.php?id=1&cat=2...)
	$"."paging = pagination(".$const3."->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=".$table."&do=viewall');
	}else{
	"
	.$const."->SelectAll();	
	}
	include(APP_FOLDER.'/views/".$dfolder."/".$table."/View.php');
	}
	";
	//export
	$controllers.="
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	"
	.$const."->SelectAll();
	include(APP_FOLDER.'/views/".$dfolder."/".$table."/Export.php');
	}
	";
	
	//EXPORT2
	$controllers.="
	//Expeort2
	elseif(get('do')=='export2'){
	".
	$const2."->SelectOne(";$controllers.="get('$primkey'));
	";
	
	if(isset($doutrow->Field) and $doutrow->Field!='' and strpos(UPLOAD_TYPE,'multiple') !== false){
	$controllers.="$"."upld = "."$"."this->"."$table"."_model"."->SelectAllFiles(get('".$primkey."'));
	";
	}
	$controllers.="include(APP_FOLDER.'/views/".$dfolder."/".$table."/Export2.php');
	}";
	
	//autoearch
	$sval='';
	$sqls = "SHOW COLUMNS FROM $table WHERE Type NOT LIKE 'text' AND Type NOT LIKE 'varbinary%'";
	foreach ($db->query($sqls) as $rowsv)
    {	
	$recordv[] = $rowsv[0];
	}
	$numsv='';
	$outputs = array_slice($recordv, 0,2);   
	foreach($outputs as $rowsv[0])
			{
	$numsv++;
	$colname=$rowsv[0];
	if($colname!=$primkey){
	$rname=str_replace('_',' ',$colname);

	$cl2='"';
	$controllers.="
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	"."$"."qstring = post('qstring');
	if(strlen("."$"."qstring) >0) {
	"."$"."autosearch = ".$const3."->AutoSearch(trim("."$"."qstring),10,'".$colname."');
	echo' <div class=".'widget'."><ul class=".$cl2."".'list-group'."".$cl2.">';
	"
	."foreach ("."$"."autosearch as "."$"."srow) {
	";
	$controllers.="echo '<span class=".$cl2."".'searchheading'."".$cl2.">"
	."<a href=".$cl2.""."'".'.H_ADMIN.'."'"."&view=".$table."&".$primkey."="."'."."$"."srow->".$primkey.".'"."&do=details"."".$cl2."><li class=".$cl2."".'list-group-item'."".$cl2.">"."'. "."$"."srow->".$colname.".'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	";
	}
	}
	
	if(FORMS_PROCESSING=='Ajax'){
	//AJAX FORMS
	//add with ajax
	$controllers.="
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/".$dfolder."/".$table."/Add.php');
	}";
	
	//add process with ajax
	$controllers.="
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if("."$"."_POST){
	";
	if(PHP_VALIDATION=='Enable'){
	$controllers.="//form validation";
	//validation
	$numv='';
	foreach ($validation as $vrow)
    {
	$numv++;
	if($vrow->Field!=$primkey){
	if($numv>2){	
	$controllers.="
	elseif (post('".$vrow->Field."')==''){
	json_error('The field ".str_replace('_',' ',$vrow->Field)." cannot be empty!');
	}";
	}
	else{	
	$controllers.="
	if (post('".$vrow->Field."')==''){
	json_error('The field ".str_replace('_',' ',$vrow->Field)." cannot be empty!');
	}";
	}
	
	}
	}
	}
	if(PHP_VALIDATION=='Enable'){
	$controllers.="
	else{
	";
	}
	$controllers.=$const3."->Insert($post_forms_post);
	json_send('$dladd');
	json_success('Process Completed');
	}
	}";
	if(PHP_VALIDATION=='Enable'){
	$controllers.="
	}";
	}
	//update with ajax
	$controllers.="
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){";
	$controllers.=
	$const2."->SelectOne(get('$primkey'));
	";
	if(isset($doutrow->Field) and $doutrow->Field!='' and strpos(UPLOAD_TYPE,'multiple') !== false){
	$controllers.="$"."upld = "."$"."this->"."$table"."_model"."->SelectAllFiles(get('".$primkey."'));
	";
	}
	$controllers.="include(APP_FOLDER.'/views/".$dfolder."/".$table."/Update.php');
	}";
	
	//update process with ajax
	$controllers.="
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if("."$"."_POST){
	";
	if(PHP_VALIDATION=='Enable'){
	$controllers.="//form validation";
	//validation
	$controllers.="
	if (post('".$primkey."')==''){
	json_error('The field ".$primkey." cannot be empty!');
	}";
	foreach ($validation as $vrow)
    {
	if($vrow->Field!=$primkey){
	$controllers.="
	elseif (post('".$vrow->Field."')==''){
	json_error('The field ".str_replace('_',' ',$vrow->Field)." cannot be empty!');
	}";
	}
	}
	}
	if(PHP_VALIDATION=='Enable'){
	$controllers.="
	else{
	";
	}
	$controllers.=$const3."->Update($post_forms_post,post('$primkey'));
	json_send('$dlupdate');
	json_success('Process Completed');
	}
	}";
	if(PHP_VALIDATION=='Enable'){
	$controllers.="
	}";
	}
	}
	//end ajax forms
	else{
		
	//NORMAL FORMS
	//add
	$controllers.="
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	if(post('button')){
	";
	if(PHP_VALIDATION=='Enable'){
	$controllers.="//form validation";
	//validation
	$controllers.="
	if (post('".$primkey."')!=''){
	"."$"."errors[] = 'The field ".$primkey." cannot be empty!';
	}";
	foreach ($validation as $vrow)
    {
	if($vrow->Field!=$primkey){
	$controllers.="
	elseif (post('".$vrow->Field."')==''){
	"."$"."errors[] = 'The field ".str_replace('_',' ',$vrow->Field)." cannot be empty!';
	}";
	}
	}
	$controllers.="
	else{
	";
	}
	$controllers.=$const3."->Insert($post_forms_post,post('$primkey'));
	send_to('$dladd');
	}";
	if(PHP_VALIDATION=='Enable'){
	$controllers.="
	}";
	}
	$controllers.="include(APP_FOLDER.'/views/".$dfolder."/".$table."/Add.php');
	}";
	
	//UPDATE
	$controllers.="
	
	//UPDATE ////////////////////////////////////////////////
	elseif(get('do')=='update'){
	if(post('button')){
	";
	if(PHP_VALIDATION=='Enable'){
	$controllers.="//form validation";
	//validation
	$controllers.="
	if (post('".$primkey."')==''){
	"."$"."errors[] = 'The field ".$primkey." cannot be empty!';
	}";
	foreach ($validation as $vrow)
    {
	if($vrow->Field!=$primkey){
	$controllers.="
	elseif (post('".$vrow->Field."')==''){
	"."$"."errors[] = 'The field ".str_replace('_',' ',$vrow->Field)." cannot be empty!';
	}";
	}
	}
	$controllers.="
	else{
	";
	}
	$controllers.=$const3."->Update($post_forms_post,post('$primkey'));
	send_to('$dlupdate');
	}
	";
	if(PHP_VALIDATION=='Enable'){
	$controllers.="}";
	}
	$controllers.=
	$const2."->SelectOne(get('$primkey'));
	";
	if(isset($doutrow->Field) and $doutrow->Field!='' and strpos(UPLOAD_TYPE,'multiple') !== false){
	$controllers.="$"."upld = "."$"."this->"."$table"."_model"."->SelectAllFiles(get('".$primkey."'));
	";
	}
	$controllers.="include(APP_FOLDER.'/views/".$dfolder."/".$table."/Update.php');
	}";
	
	}//end else
	
	//details
	$controllers.="
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	".
	$const2."->SelectOne(";$controllers.="get('$primkey'));
	";
	
	if(isset($doutrow->Field) and $doutrow->Field!='' and strpos(UPLOAD_TYPE,'multiple') !== false){
	$controllers.="$"."upld = "."$"."this->"."$table"."_model"."->SelectAllFiles(get('".$primkey."'));
	";
	}
	$controllers.="include(APP_FOLDER.'/views/".$dfolder."/".$table."/Details.php');
	}";
	
	//truncate
	$controllers.="
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	".
	$const3."->TruncateTable('$trunc');
	";
	$controllers.="include(APP_FOLDER.'/views/".$dfolder."/".$table."/View.php');
	}";
	
	//delete
	$controllers.="
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	";
$controllers.=
	"$"."dfile=get('dfile');
	";
	//start file
	if(isset($doutrow->Field) and $doutrow->Field!='' and strpos(UPLOAD_TYPE,'multiple') !== false){
	$controllers.="
	//FLES FROM NEW TABLE
	if(get('".$primkey."') and get('dfile')=='' and get('fdel')=='' and get('onedel')==''){
	"."$"."rowfile = "."$"."this->"."$table"."_model"."->SelectAllFiles(get('".$primkey."'));
	foreach("."$"."rowfile as "."$"."drows)
	{
	delete_files(UPLOAD_PATH."."$"."drows->".H_FILE.");
	delete_files(THUMB_PATH."."$"."drows->".H_FILE.");
	}
	".$const3."->DeleteFile(get('".$primkey."'));
	".$const3."->Delete(get('".$primkey."'),'".$dpg."&view=".$table."&do=viewall&msg=delete');
	}
	
	elseif(get('".$primkey."') and get('fid') and get('fdel')=='' and get('onedel') and  get('dfile')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	".$const3."->DeleteFileOne(get('".FILE_ID."'));
	send_to('".$dpg."&view=".$table."&".$primkey."='.get('".$primkey."').'&do=details&dmsg=delete');	
	}";
	}//end file
	else{
	$controllers.="	if(get('$primkey') and "."$"."dfile==''){
	".
	"$"."del = "."$"."this->"."$table"."_model"."->Delete(get('$primkey'),'$dldelete');
	}";
	}
	$controllers.="
	elseif(get('$primkey') and "."$"."dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	"."$"."del = "."$"."this->"."$table"."_model"."->Delete(get('$primkey'),'$dldelete');
	}
	elseif(get('$primkey') and "."$"."dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to('$dldelete1');
	}
	}
	}//end invoke
	}//end class
	?>
	";
	return $controllers;
	}
	
	//Main Controller
	function Main_Controller($dfolder,$table){
	$mainget ="<?php
	/*
	* =======================================================================
	* FILE NAME:        main.php
	* DATE CREATED:  	".date('d-m-Y')."
	* FOR TABLE:  		$table
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	";
	$db=DB::getInstance();
	$sqlm = "SHOW TABLES";
    foreach ($db->query($sqlm) as $rowm)
    {
	$recordm[] = $rowm[0];
	}
	foreach($recordm as $key => $valuecont[0])
	{
	$maincont="
	//$valuecont[0]	
	if(get('view')=='".$valuecont[0]."'){
	include(APP_FOLDER.'/controllers/".$dfolder."/".$valuecont[0].".php');
	"."$"."$table"."_controller = new ".$valuecont[0].""."_controller();
	"."$"."$table"."_controller->"."invoke_"."".$valuecont[0]."();
	}";
    $mainget .= $maincont;
	}
	$mainget .='
	?>';
	return $mainget;
	}
	}//end class
?>