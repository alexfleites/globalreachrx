<?php
	/*
	HEZECOM UltimateSpeed PHP CODE GENERATOR
	Author: Hezecom Technologies (http://hezecom.com) info@hezecom.net
	COPYRIGHT 2015 ALL RIGHTS RESERVED.
	FILE NAME Generator.php 
	
	You must have purchased a valid license from CodeCanyon.com in order to have 
	access this file.

	You may only use this file according to the respective licensing terms 
	you agreed to when purchasing this item.
	http://codecanyon.net/licenses
	*/
	$table = lowercase((post('tablename')));
	$class = post('classname');
	$primkey = post('keyname');
	if(FORMS_PROCESSING=='Ajax'){
	$faction = "<?php echo H_ADMIN_MAIN.'&view=$table&do=addpro';?>";
	$faction2 = "<?php echo H_CLIENT_MAIN.'&view=$table&do=addpro';?>";
	$factionUpdate1 = "<?php echo H_ADMIN_MAIN.'&view=$table&do=updatepro';?>";
	$factionUpdate2 = "<?php echo H_CLIENT_MAIN.'&view=$table&do=updatepro';?>";
	}else{
	$faction = str_replace('\\','',post('faction'));
	$faction2 = str_replace('\\','',post('faction'));
	$factionUpdate1 = str_replace('\\','',post('faction'));
	$factionUpdate2 = str_replace('\\','',post('faction'));
	}
	$fbutton = post('fbutton');
	$sqlcode = post('sqlcode');
	$sqlcode2 = post('sqlcode2');
	$sqlcode3 = post('sqlcode3');
	$sqlcustom = post('sqlcustom');

	if($table!=''){
	$dir = str_replace('lib','',dirname(__FILE__));
	if(!$sqlcustom){
	$filename = $dir . "/CodeOutput/application/models/classes/". "class_" . $table.".php";
	$fileindex = $dir . "/CodeOutput/application/models/classes/index.html";
	$fileindex2 = $dir . "/CodeOutput/application/models/objects/index.html";
	$fileindex3 = $dir . "/CodeOutput/application/models/index.html";
	$fileindex4 = $dir . "/CodeOutput/application/index.html";
	}
	$filenameb = $dir . "/CodeOutput/application/models/objects/".$table.".php";
	$filenamedir = $dir . "/CodeOutput/";
	if(file_exists($filename)){unlink($filename);}
	
	if(!$sqlcustom){
	CreateDir('CodeOutput/application/views/admin/'.$table);
	}
	//OPEN classes and objects
	$file = fopen($filename, "w+");
	$fileb = fopen($filenameb, "w+");
	$fid = fopen($fileindex, "w+");
	$fid2 = fopen($fileindex2, "w+");
	$fid3 = fopen($fileindex3, "w+");
	$fid4 = fopen($fileindex4, "w+");
	
	$filedate = date("d-m-Y");
	$dset = "";
	$fieldsnormal="";
	$updfull="";
	$dpost= "";
	$pinsert="";
	$pupdate="";
	$forms_post="";
	$qu='"'; 
	$updfull2="";
	$input_fields="";
	$check_open="";

	$dset.= "
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        $class
	* DATE CREATED:  	$filedate
	* FOR TABLE:  		$table
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	";
	$dset.="
	class $class
	{
	public $$primkey;";
	$sql = "SHOW COLUMNS FROM $table;";
	foreach ($db->query($sql) as $row)
    {	
	$colname=$row[0];
	if($colname!=$primkey){
	$dset.= "
	public $$colname; ";
	
	};
	}
	if(CLASS_TYPE=='default'){
	$dset.="
	
	//Constructor
	public function __construct()
	{";	
	foreach ($db->query($sql) as $row)
    {	
	$colname=$row[0];
	$mfield = "$" . "this->" . $colname. " = "."isset("."$".$colname.")";
	$dset.="
	$mfield;";
	}
	$dset.="
	}
	}";
	}else{
	//use get and set
	$dset.="
	
	//Get Methods
	";
	// GETTER
	foreach ($db->query($sql) as $row){
	$colname=$row[0];
	$mname = "get" . $colname . "()";
	$mthis = "$" . "this->" . $colname;
	$dset.="
	public function $mname
	{
	return $mthis;
	}
	";
	}
	$dset.="
	// Set Methods
	";
	// SETTER
	foreach ($db->query($sql) as $row){
	$colname=$row[0];
	$val = "$" . "val";
	$mname = "set" . $colname . "($" . "val)";
	$mthis = "$" . "this->" . $colname . " = ";
	$dset.="
	public function $mname
	{
	$mthis $val;
	}
	";
	}
	$dset.="}";
	}
	
	//GET OBJECTS////////////////////////////
	
	if($sqlcustom){
		$hezeSQL="return HDB::hus()->Hselect(".$sqlcode.")";
		$hezeSQL_Pager="return HDB::hus()->Hselect(".$sqlcode3.")";
		$hezeSQL2="return HDB::hus()->Hone(".$sqlcode2.")";
	}else{
		$hezeSQL="return HDB::hus()->Hselect($qu$table$qu)";
		$hezeSQL_Pager="return HDB::hus()->Hselect($qu$table LIMIT {"."$"."startpg} , {"."$"."limit}$qu)";
		$hezeSQL2="return HDB::hus()->Hone($qu$table$qu, $qu$primkey=:id$qu,"."$"."bind)";
	}
	
	//File Checker
	$myc = $db->query("SHOW COLUMNS FROM $table WHERE TYPE LIKE 'varbinary%'");
	$doutrow=$myc->fetch(PDO::FETCH_OBJ);
	
	//get objects
	$dset2="";
	$dset2.="
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        $class"."_"."model
	* DATE CREATED:  	$filedate
	* FOR TABLE:  		$table
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	";
	//Selectall
	$dset2.="
	include_once(APP_FOLDER.'/models/classes/class_"."$table".".php');
	
	class $table"."_"."model{
	
	// SELECT ALL
	public function SelectAll("."$"."limit=NULL)
	{
	if("."$"."limit){
	"."$"."startpg = pageparam("."$"."limit);
	$hezeSQL_Pager;
	}else{
	$hezeSQL;	
	}
	}
	";
	$dset2.="
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount($qu$table$qu);
	}
	";
	if(isset($doutrow->Field) and strpos(UPLOAD_TYPE,'multiple') !== false){
	$dset2.="
	// SELECT FILES
	public function SelectAllFiles("."$"."id)
	{
	"."$"."bind = array($qu:id$qu =>"."$"."id);
	return HDB::hus()->Hselect(".$qu.UPLOAD_TABLE.$qu.",".$qu.RELATE_ID."=:id".$qu.","."$"."bind);
	}
	";
	}
	//Selectone
	$dset2.="
	// SELECT ONE
	public function SelectOne("."$"."id)
	{
	"."$"."bind = array($qu:id$qu =>"."$"."id);
	return HDB::hus()->Hone($qu$table$qu,$qu$primkey=:id$qu,"."$"."bind);
	}
	";
	$locaton="$"."redirect_to";
	$dirto="send_to("."$"."redirect_to);";
	$cl='"';
	
	//autocomplete search
	$dset2.="
	// QUICK SEARCH
	public function AutoSearch("."$"."qstring,"."$"."limit,"."$"."where)
	{
	"."$"."bind = array($qu:svalue$qu =>".$cl.""."%"."$"."q"."string%"."".$cl.");
	return HDB::hus()->Hselect(".$cl."".$table."".$cl.",".$cl.""."$"."where LIKE :svalue LIMIT "."$"."limit"."".$cl.","."$"."bind".");		
	}
	";
	//truncate
	$dset2.="
	// TRUNCATE TABLE
	public function TruncateTable($locaton)
	{
   	"."$"."sql="."HDB::hus()->prepare(".'"TRUNCATE '.$table.'");'."
	"."$"."sql->execute();
	$dirto
	}
	";
	
	//Start Delete
	function HDelete($table,$primkey,$redirect=NULL){
	$qu='"';
	$del="$"."bind = array($qu:id$qu =>"."$"."id);
	HDB::hus()->Hdelete($qu$table$qu,$qu$primkey=:id$qu,"."$"."bind);
	";
	$redirect;
	return $del.$redirect;
	}
	
	$dset2.="
	// DELETE
	public function Delete("."$"."id,$locaton)
	{
	".HDelete($table,$primkey,$dirto)."
	}
	";
	//multi files delete
	if(isset($doutrow->Field) and strpos(UPLOAD_TYPE,'multiple') !== false){
	$dset2.="
	// DELETE FILES
	public function DeleteFile("."$"."id)
	{
	".HDelete(UPLOAD_TABLE,RELATE_ID)."
	}
	";
	//Delete one file
	$dset2.="
	// DELETE ONE
	public function DeleteFileOne("."$"."id)
	{
	".HDelete(UPLOAD_TABLE,FILE_ID)."
	}
	";
	}
	//end delete
	
	$addnew1 = "$" . "this->$primkey = \"\"";
	$addnew2 = "array(array(";
	$addnew5= "))"; 
	$sql = "SHOW COLUMNS FROM $table;";
	$file_field='';
	//File Uplaod
	if($myc->columnCount()>0 and isset($doutrow->Field)){
	$file_field.=$doutrow->Field;
	$hefile="$"."newupload = new UploadControl;
	";
	$hefile2="$"."newupload = new UploadControl;
	";
	if(UPLOAD_TYPE=='fileonly'){
	$hefile.="$"."uploadname="."$"."newupload->SingleFilesUpload('".$doutrow->Field."',UPLOAD_PATH);";
	}
	elseif(UPLOAD_TYPE=='imgonly'){
	$hefile.="$"."uploadname="."$"."newupload->ImageUplaodResize('".$doutrow->Field."',THUMB_IMAGE_WIDTH,BIG_IMAGE_WIDTH,UPLOAD_PATH,THUMB_PATH,90);";
	}
	elseif(UPLOAD_TYPE=='multipleimage'){
	$lastid="if(HDB::hus()->lastInsertId()){";
	$hefile.="$"."uploadname="."$"."newupload->MultiImageUplaodResize(HDB::hus()->lastInsertId(),THUMB_IMAGE_WIDTH,BIG_IMAGE_WIDTH,UPLOAD_PATH,THUMB_PATH,90);";
	$hefile2.="$"."uploadname="."$"."newupload->MultiImageUplaodResize(post('$primkey'),THUMB_IMAGE_WIDTH,BIG_IMAGE_WIDTH,UPLOAD_PATH,THUMB_PATH,90);";
	}
	elseif(UPLOAD_TYPE=='multiplefile'){
	$lastid="if(HDB::hus()->lastInsertId()){";
	$hefile.="$"."uploadname="."$"."newupload->MultiFilesUpload(HDB::hus()->lastInsertId(),UPLOAD_PATH);";
	$hefile2.="$"."uploadname="."$"."newupload->MultiFilesUpload(post('$primkey'),UPLOAD_PATH);";
	}
	}
	//list columns
	$rec1="";
	$upd1="";
	$upd2="";
	$sqlrows = $db->query("SHOW COLUMNS FROM $table;");
	$outer=$sqlrows->fetchAll(PDO::FETCH_OBJ);
	foreach ($outer as $cols)
    {	
	$colname=$cols->Field;
	if($colname!=$primkey){
	$dpost.= "$" . "$colname" ."=" ."post('" . "$colname" ."');" . "
	";
	if(strpos($cols->Type,'varbinary') !== false){
	//file field
	$rec1.= "'$colname'=>" . "$"."uploadname" . ","; // file insert
	$upd1.= "$colname=" . ":".$file_field. ","; // file update
	$upd2.= "':$colname'=>" ."$"."uploadname" . ","; // file update
	}else{	
	//other fields
	$semi_field=":".$colname;
	$fieldsnormal.= "'$colname'=>" . "$" . "$colname". ",";
	$updfull.="$colname =". ":" . "$colname" . ",";
	$updfull2.= "'$semi_field'=>" . "$" . "$colname". ",";
	$input_fields.= "$" . "$colname". ",";
	$forms_post.= "post('" . "$colname" ."')" . ",";
	}
	}}
	
	$if1="if("."$"."uploadname==''){";
	$nouploadfd = substr($fieldsnormal,0,-1);  //insert
	$noupdfull = substr($updfull,0,-1);  //update
	$build_fields = substr($input_fields,0,-1);  //table fields
	$post_forms_post = substr($forms_post,0,-1);  //post form files
	$els1="}else{";
	$final_insert= substr($rec1.$fieldsnormal,0,-1);  //insert with file
	$final_update= substr($upd1.$updfull,0,-1);  //update with file
	$final_update2= substr($rec1.$updfull2,0,-1).",':id'=>"."$"."id";  //insert with file
	$final_update3= substr($updfull2,0,-1).",':id'=>"."$"."id";  //update with no file
	$final_update4= substr($upd2.$updfull2,0,-1).",':id'=>"."$"."id";  //update with no file
	$els1close="}";
	
	$dbcon1= "$" . "dbc" ."=" ."new dboptions();" . "\n";
	$sql = "$" . "values =";
	$final = "HDB::hus()->Hinsert('"."$table', "."$"."values".");";
	$final_fieldsnormal = substr($fieldsnormal, 0, -1);//normal without upoad
	
	//INSERT CHECKER
	//if(strpos(UPLOAD_TYPE,'multiple') !== false)
	if(isset($doutrow->Field) and $doutrow->Field!='' and strpos(UPLOAD_TYPE,'multiple') === false){
	$dset2.="
	// INSERT
	public function Insert($build_fields)
	{
	$hefile
	$if1
	$sql $addnew2 $nouploadfd $addnew5;
	$els1
	$sql $addnew2 $final_insert $addnew5;
	$els1close
	$final
	}
	";
	}
	elseif(isset($doutrow->Field) and $doutrow->Field!='' and strpos(UPLOAD_TYPE,'multiple') !== false){
	$dset2.="
	// INSERT
	public function Insert($build_fields)
	{
	$sql $addnew2 $nouploadfd $addnew5;
	$final
	$lastid
	$hefile
	$els1close
	}
	";
	}
	else{
	$dset2.="
	// INSERT
	public function Insert($build_fields)
	{
	$check_open
	$sql $addnew2 $final_fieldsnormal $addnew5;
	$final
	}
	";
	}
	
	// UPDATE 
	$addnew1 = "$" . "this->$primkey = \"\"";
	$addnew2 = "";
	$addnew5= ")"; 
	$addnew3 = "";
	$addnew4 = "";
	$addnew6 = "VALUES (";
	$upd = "";
	$sql = "SHOW COLUMNS FROM $table;";
	foreach ($db->query($sql) as $row)
    {	
	$colname=$row[0];
	if($colname!=$primkey){
	$q1='".';
	$q2='."';
	$addnew3.= "$colname" . ",";
	$addnew4.= "$" . "this->$colname" . ",";
	$upd.= "" . "$colname =". ":" ."$colname" . ",";}}
	$upd = substr($upd, 0, -1);
	$sql = "$" . "sql = \"";
	$id = "$" . "id";
	$where = "WHERE " . "$primkey = " . ":id";
	//$prikey ="$" . "id" ."=" ."post('" . "$primkey" ."');";
	
	if(isset($doutrow->Field) and $doutrow->Field!='' and strpos(UPLOAD_TYPE,'multiple') === false){
	$dset2.="
	// UPDATE
	public function Update($build_fields,$id)
	{
	$hefile
	$if1
	$sql $addnew2 $noupdfull $where \";
	"."$"."data = array($final_update3);
	$els1
	$sql $addnew2 $final_update $where \";
	"."$"."data = array($final_update4);
	$els1close
	HDB::hus()->Hupdate('$table',"."$"."sql,"."$"."data);
	";
	}
	elseif(isset($doutrow->Field) and $doutrow->Field!='' and strpos(UPLOAD_TYPE,'multiple') !== false){
	$dset2.="
	// UPDATE
	public function Update($build_fields,$id)
	{
	$sql $addnew2 $noupdfull $where \";
	"."$"."data = array($final_update3);
	HDB::hus()->Hupdate('$table',"."$"."sql,"."$"."data);
	$hefile2
	";	
	}else{
	$dset2.="
	// UPDATE
	public function Update($build_fields,$id)
	{
	$sql $addnew2 $noupdfull $where \";
	"."$"."data = array($final_update3);
	HDB::hus()->Hupdate('$table',"."$"."sql,"."$"."data);
	";
	}
	$dset2.="
	}
	";
	$dset2.= "
	
	} // end class
	
	?>
	
	";
	fwrite($file, $dset);
	fwrite($fileb, $dset2);
	include 'lib/forms_class.php';
    //create
	$form = new HezecomForm;
    $htmlformA = $form->HezecomFormCreator($table,$faction,EDITOR_TYPE,FORM_STYLE,JQUERY_VALIDATE,$primkey,H_FILE,'<?php echo LANG_CREATE_RECORD;?>','H_ADMIN');
	//update
    $htmlformB = $form->HezecomFormCreatorUpdate($table,$factionUpdate1,EDITOR_TYPE,FORM_STYLE,JQUERY_VALIDATE,$primkey,'<?php echo LANG_UPDATE_RECORD;?>','H_ADMIN');
	
	
	include('lib/interface_class.php');
	include('lib/controllers_class.php');
	$pgadmin="'.H_ADMIN.'";
	$pgpublic="'.H_CLIENT.'";
	//INTERFACE
	$hezecom_Interface = new Hezecom_Interface;
	//view
	$dview=$hezecom_Interface->View_Interface('admin',$table,$primkey,'H_ADMIN','H_ADMIN_MAIN'); //admin
	//export
	$excelprint=$hezecom_Interface->Export_Interface('admin',$table,$primkey,'H_ADMIN'); //admin
	//export details
	$excelprintB=$hezecom_Interface->Export_Details_Interface('admin',$table,$primkey,'H_ADMIN'); //admin
	//details
	$ddetail=$hezecom_Interface->Details_Interface('admin',$table,$primkey,'H_ADMIN','H_ADMIN_MAIN'); //admin
	//listmenu
	$listmenu=$hezecom_Interface->Menu_Interface('admin','H_ADMIN'); //admin
	
	//CONTROLLERS
	$hezecom_Controller = new Hezecom_Controller;
	//table controllers
	$controllers=$hezecom_Controller->Table_Controller('admin',$table,$primkey,$pgadmin,$post_forms_post); //admin
	//main controllers
	$mainget=$hezecom_Controller->Main_Controller('admin',$table); //admin

	if(!$sqlcustom){//IF NOT CUSTOM SQL
	$filename2 = $dir . '/CodeOutput/application/views/admin/'.$table.'/Add.php';
	$filename22 = $dir . '/CodeOutput/application/views/admin/'.$table.'/Update.php';
	$filename23 = $dir . '/CodeOutput/application/views/admin/'.$table.'/View.php';
	$filename24 = $dir . '/CodeOutput/application/views/admin/'.$table.'/Details.php';
	$filename25 = $dir . "/CodeOutput/application/views/admin/menu.php";
	$filename26 = $dir . "/CodeOutput/application/controllers/admin/$table.php";
	$filename27 = $dir . '/CodeOutput/application/views/admin/'.$table.'/Export.php';
	$filename272 = $dir . '/CodeOutput/application/views/admin/'.$table.'/Export2.php';
	$filename28 = $dir . "/CodeOutput/application/controllers/admin/main.php";
	//index.html
	$filename29 = $dir . "/CodeOutput/application/views/admin/index.html";
	$filename30 = $dir . "/CodeOutput/application/controllers/admin/index.html";
	$filename31 = $dir . "/CodeOutput/application/views/index.html";
	$filename32 = $dir . "/CodeOutput/application/controllers/index.html";
	$filename33 = $dir . '/CodeOutput/application/views/public/'.$table.'/index.html';
	
	
	$file2 = fopen($filename2, "w+");
	$file22 = fopen($filename22, "w+");
	$file23 = fopen($filename23, "w+");
	$file24 = fopen($filename24, "w+");
	$file25 = fopen($filename25, "w+");
	$file26 = fopen($filename26, "w+");
	$file27 = fopen($filename27, "w+");
	$file272 = fopen($filename272, "w+");
	$file28 = fopen($filename28, "w+");
	$file29 = fopen($filename29, "w+");
	$file30 = fopen($filename30, "w+");
	$file31 = fopen($filename31, "w+");
	$file32 = fopen($filename32, "w+");
	$file33 = fopen($filename33, "w+");
	
	fwrite($file2, $htmlformA);
	fwrite($file22, $htmlformB);
	fwrite($file23, $dview);
	fwrite($file24, $ddetail);
	fwrite($file25, $listmenu);
	fwrite($file26, $controllers);
	fwrite($file27, $excelprint);
	fwrite($file272, $excelprintB);
	fwrite($file28, $mainget);
	fwrite($file29, 'Restricted Directory');
	fwrite($file30, 'Restricted Directory');
	fwrite($file31, 'Restricted Directory');
	fwrite($file32, 'Restricted Directory');
	fwrite($file33, 'Restricted Directory');
	}
	send_to('index.php?scode=1');
	
	}
	?>
	