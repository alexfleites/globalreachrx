<?php
/*
	HEZECOM UltimateSpeed PHP CODE GENERATOR
	Author: Hezecom Technologies (http://hezecom.com) info@hezecom.net
	COPYRIGHT 2014-2015 ALL RIGHTS RESERVED
	FILE NAME forms_class.php 
	
	You must have purchased a valid license from CodeCanyon.com in order to have 
	access this file.

	You may only use this file according to the respective licensing terms 
	you agreed to when purchasing this item.
*/

	class HezecomForm {
	private $createform;
	private $updateform;
	

	private function formheaderdiv($htitle,$menu,$dpg,$table=NULL,$primkey=NULL,$submit){
	
	$storefileLink="";
	$db=DB::getInstance();
	$sqlr = $db->query("SHOW COLUMNS FROM $table");
	$outr=$sqlr->fetchAll(PDO::FETCH_OBJ);
	foreach ($outr as $colink)
    {	
	$colname=$colink->Field;
	$ftitle=str_replace('_',' ',$table);
	if(strpos($colink->Type,'varbinary') !== false){
	$storefileLink.="<?php echo "."$"."rows->$colname;?>";
	}}

	$mydiv= '
	<div class="col-12">';
	if($menu=='yes'){
	$mydiv.='
	<ul class="nav pull-right" style="margin-top:5px;">';
	$mydiv.= $this->setSubmit($submit);
	$mydiv.='<a href="<?php echo '.$dpg.';?>&view='.$table.'&'.$primkey.'=<?php echo '.'$'.'rows->'.$primkey.';?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo '.$dpg.';?>&view='.$table.'&'.$primkey.'=<?php echo '.'$'.'rows->'.$primkey.';?>&do=delete&dfile='.$storefileLink.'" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo '.$dpg.';?>&view='.$table.'&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>';
	}else{
	$mydiv.='
	<ul class="nav pull-right" style="margin-top:5px;">';
	$mydiv.= $this->setSubmit($submit);
	$mydiv.='<a href="<?php echo '.$dpg.';?>&view='.$table.'&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>';
	}
	$mydiv.='
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> '.$htitle.'</h3></div>
  <div class="panel-body">
	';
	return $mydiv;	
	}
	
	private function formfooterdiv(){
	return '
	
 </div><!--/col-12-->
	';	
	}
	
	public function formlabel($fieldname,$fieldinput){
    return'
	<div class="form-group">
    <label class="control-label" for="'.$fieldinput.'">'.$fieldname.'</label>
	';
	}
	
	public function formlabelgroup($fieldname,$fieldinput){
    return'
	<div class="form-group">
    <label class="control-label sr-only" for="'.$fieldinput.'">'.$fieldname.'</label>
	<div class="input-group-addon left">'.$fieldname.'</div>
	';
	}
	
	private function formlabelend(){
    return'
	</div>'."\n";
	}
	
	private function general_field($fieldname,$maxlength,$value=null,$style=null,$required=null){
    return'<input id="'.$fieldname.'" name="'.$fieldname.'" type="text" maxlength="'.$maxlength.'"  value="'.$value.'" class="form-control '.$style.'" '.$required.'/>';
	}
	private function email_field($fieldname,$maxlength,$value=null,$style=null,$required=null){
    return'<input id="'.$fieldname.'" name="'.$fieldname.'" type="email" maxlength="'.$maxlength.'"  value="'.$value.'" class="form-control '.$style.'" '.$required.'/>';
	}
	private function date_year($fieldname,$maxlength,$date=null,$value=null,$style=null,$required=null){
    return'<input name="'.$fieldname.'" class="datepicker form-control '.$style.'" type="text" maxlength="'.$maxlength.'" value="'.$date.$value.'" '.$required.'/>';
	}
	//textarea
	private function textarea($fieldname,$value=null,$style=null,$required=null){
	if(EDITOR_TYPE=='tinymce'){
    return'<textarea rows="5" id="'.$fieldname.'" name="'.$fieldname.'" class="form-control editor1 '.$style.'" '.$required.'/>'.$value.'</textarea>';
	}
	elseif(EDITOR_TYPE=='html5'){
    return'<textarea rows="5" id="'.$fieldname.'" name="'.$fieldname.'" class="form-control editor2 '.$style.'" '.$required.'/>'.$value.'</textarea>';
	}else{
	 return'<textarea rows="5" id="'.$fieldname.'" name="'.$fieldname.'" class="form-control '.$style.'" '.$required.'/>'.$value.'</textarea>';
	}
	}
	//editor
	/*private function textEditor($fieldname,$value=null,$required=null){
    return '<div id="'.$fieldname.'">'.$value.'</div>
	';
	}*/
	//enum 
	public function enum_list($fieldname){
    return'<option value="'.$fieldname.'">' . $fieldname . '</option>
	';	
	}
	private function enum_select($fieldname,$value=null,$style=null,$required=null){
    return'<select name="'.$fieldname.'" id="'.$fieldname.'" class="'.$required.' form-control '.$style.' choz">
	<option value="'.$value.'">' . $value . '</option>';	
	}
	private function hiddenField($fieldname){
	return'
	<input type="hidden" name="'.$fieldname.'" value="<?php echo $rows->'.$fieldname.';?>">';
	}
	//FILE
	private function fileField($fieldname,$hfilename=null,$value=null,$style=null,$required=null){
	return'
	<input id="'.$fieldname.'" name="'.$fieldname.'"type="file" class="form-control styler"/>
	';
	}
	private function fileFieldMultiple($fieldname){
	return'<div class="hezefield">
    <input type="file" id="file" value="" name="gfile[]" class="heze_item styler" style="padding:0px; width:220px; margin-bottom:20px;" />
    </div>    
     <p> <span id="addVar" class="btn btn-xs btn-success"><?php echo LANG_ADD_FIELD;?></span></p>
	';	
	}
	private function fileField2($fieldname,$dpg,$value=null,$valueb=null,$table=null,$required=null,$key=null){
	$dfd='<input id="'.$fieldname.'" name="'.$fieldname.'"type="file" class="styler"/><br>';
	if(UPLOAD_TYPE=='imgonly'){
	$dfd.='<?php if(is_file(UPLOAD_FOLDER.'.'$'.'rows->'.$fieldname.')){?><a href="#"><img src="'.$value.'"></a><br><?php }?>';
	}if(UPLOAD_TYPE=='fileonly'){
	$dfd.='<?php if(is_file(UPLOAD_FOLDER.'.'$'.'rows->'.$fieldname.')){?><a href="#" class="btn">'.$valueb.'</a><br><?php }?>';
	}
	$dfd.='
	<?php if(is_file(UPLOAD_FOLDER.'.'$'.'rows->'.$fieldname.')){?>
	<a href="<?php echo '.$dpg.';?>&view='.$table.'&'.$key.'=<?php echo '.'$'.'rows->'.$key.';?>&dfile='.$valueb.'&do=delete&fdel=file" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><span class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> <?php echo LANG_DELETE;?></span></a><br><?php }?>
	';
	return $dfd;
	}
	private function fileListing($table,$primkey,$dpg){
	if(UPLOAD_TYPE=='imgonly' or UPLOAD_TYPE=='multipleimage'){
		$hezebox='hezebox';
	}else{
		$hezebox='';	
	}
	$ddetail.='<tr>
	<td colspan="2">
    <div class="row">
    <div class="col-lg-12 gallery">
	<?php';
   $ddetail.=" foreach("."$"."upld as "."$"."frows)
			{
	if(strlen("."$"."frows->gfile)>1){
	?>";
	$ddetail.='
    <div class="col-md-2" style="padding-top:10px;">';
	if(UPLOAD_TYPE=='multipleimage'){
	$ddetail.="
	<a href='<?php echo UPLOAD_FOLDER."."$"."frows->".H_FILE.";?>' data-rel='".$hezebox."'><img src='<?php echo THUMB_FOLDER."."$"."frows->".H_FILE.";?>' class='img-responsive img-thumbnail'></a>";
	}else{
		$ddetail.="
	<a href='<?php echo UPLOAD_FOLDER."."$"."frows->".H_FILE.";?>' class='btn btn-success btn-xs' data-rel='".$hezebox."'><?php echo"."$"."frows->".H_FILE.";?></a> ";
	}
    $ddetail.="
	<a href='<?php echo ".$dpg.";?>&view=".$table."&".$primkey."=<?php echo get('".$primkey."');?>&".FILE_ID."=<?php echo "."$"."frows->".FILE_ID.";?>&do=delete&onedel=del&dfile=<?php echo "."$"."frows->".H_FILE.";?>' title='<?php echo LANG_TIP_DELETE;?>' class='btn btn-xs btn-danger tip' data-confirm='<?php echo LANG_DELETE_AUTH;?>'>
    <span class='fa fa-times'></span> <?php echo LANG_REMOVE;?></a>
     </div>	
    <?php }}?>
    </div></div>
    </td>
	</tr>
	";
	return $ddetail;
	}
	//start form
	private function formBegin($action,$formId){
	 return '
	 
	 <form action="'.$action.'" method="post" name="hezecomform" id="'.$formId.'" enctype="multipart/form-data">';
	}
	
	private function formEnd(){
	 return '
	</form>
	 ';
	}
	private function setSubmit($submit){
	  return'
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> '.$submit.'</label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="'.$submit.'" />
	 	 
	  ';
	}
	private function setSubmit2($submit){
	  return'
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> '.$submit.'</label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="'.$submit.'" />
	 	 </div>
	 	 
	  ';
	}
	
	private function activityLoader(){
	  return'
	 <div class="output"></div>
	  ';
	}
	function credit_header($filen,$table){
	return"
	<?php
	/*
	* =======================================================================
	* FILE NAME:        $filen
	* DATE CREATED:  	".date('d-m-Y')."
	* FOR TABLE:  		$table
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	";	
	}
	private function getTable($table){
	$db=DB::getInstance();
	$mynew = $db->prepare("SHOW COLUMNS FROM $table");
	$mynew->execute();
	return $mynew->fetchAll(PDO::FETCH_OBJ);	
	}
	//Create form fields - Add
	public function HezecomFormCreator($table,$action,$editor,$style,$required,$key,$hfilename,$submit,$dpg){
	
	$hezeform= $this->credit_header('Add.php',$table);
	if(FORMS_PROCESSING=='Ajax'){
		$formId='hezecomform';
	}else{
		$formId='hezecomform2';
	}
	$rname = str_replace('_',' ',ucwords($table));
	$rename=ucwords($rname);
	$hezeform.=$this->formBegin($action,$formId);
	$hezeform.=$this->formheaderdiv('<?php echo LANG_CREATE_NEW;?> '.$rename.'','no',$dpg,$table,$key,$submit);
	$hezeform.=$this->activityLoader();
	$valuetx="";
	if(FORMS_PROCESSING!='Ajax'){
	$hezeform.="
	
	<?php if(isset("."$"."errors))form_errors("."$"."errors);?>
	";
	}
	$outrow=$this->getTable($table);
		
	foreach ($outrow as $col) {
		
		$fname = str_replace('_',' ',ucfirst($col->Field));
		$fieldname = ucwords($fname);
		$fieldinput = $col->Field;
		
    	preg_match_all('/\(([0-9 ]+?)\)/', $col->Type, $out);
		foreach($out as $lenout){
		if(isset($lenout[0])) $lenn = $lenout[0];
		}
		//ENUM		
		if(strpos($col->Type,'enum') !== false){
		$enumList = explode(",", str_replace("'", "", substr($col->Type, 5, (strlen($col->Type)-6))));
		if(FORM_TEMPLATE=='Grouped'){
		$hezeform.=$this->formlabelgroup($fieldname,$fieldinput);
		}else{
		$hezeform.=$this->formlabel($fieldname,$fieldinput);
		}
		$hezeform.= $this->enum_select($fieldinput,$valuetx,$style,$required); 
		foreach($enumList as $value){
		$hezeform.= $this->enum_list($value);
		}
		$hezeform.='</select>';	
		$hezeform.= $this->formlabelend(); 
		}
		//TEXTAREA
		elseif(strpos($col->Type,'text') !== false or strpos($col->Type,'blob') !== false){
		if($editor!= 'wysiwyg_txt'){
		if(FORM_TEMPLATE=='Grouped'){
		$hezeform.=$this->formlabelgroup($fieldname,$fieldinput);
		}else{
		$hezeform.=$this->formlabel($fieldname,$fieldinput);
		}
		$hezeform.= $this->textarea($fieldinput,'',$style,$required); 
		$hezeform.= $this->formlabelend();
		}else{
		//TEXT EDITOR
		if(FORM_TEMPLATE=='Grouped'){
		$hezeform.=$this->formlabelgroup($fieldname,$fieldinput);
		}else{
		$hezeform.=$this->formlabel($fieldname,$fieldinput);
		}
		$hezeform.="<?php HezecomEditor('".$fieldinput."'); ?>
		";
		$hezeform.= $this->textarea($fieldinput,"");
		$hezeform.= $this->formlabelend();
		}
		}
		//DATE
		elseif(strpos($col->Type,'date') !== false){
		if(FORM_TEMPLATE=='Grouped'){
		$hezeform.=$this->formlabelgroup($fieldname,$fieldinput);
		}else{
		$hezeform.=$this->formlabel($fieldname,$fieldinput);
		}
		$date="<?php echo date('Y-m-d');?>";
		$hezeform.= $this->date_year($fieldinput,$lenn,$valuet,$date,$style,$required);
		$hezeform.= $this->formlabelend();
		}
		//FILE
		elseif(strpos($col->Type,'varbinary') !== false){
		if(FORM_TEMPLATE=='Grouped'){
		$hezeform.=$this->formlabelgroup($fieldname,$fieldinput);
		}else{
		$hezeform.=$this->formlabel($fieldname,$fieldinput);
		}
		if(UPLOAD_TYPE=='multipleimage' or UPLOAD_TYPE=='multiplefile'){
		$hezeform.= $this->fileFieldMultiple($fieldinput);
		}else{
		$hezeform.= $this->fileField($fieldinput,$hfilename,'',$style,$required); 
		}
		$hezeform.= $this->formlabelend();
		}
		else {
		//TEXTINPUT 
		if($key!=$col->Field){
		if(FORM_TEMPLATE=='Grouped'){
		$hezeform.=$this->formlabelgroup($fieldname,$fieldinput);
		}else{
		$hezeform.=$this->formlabel($fieldname,$fieldinput);
		}
		$hezeform.= $this->general_field($fieldinput,$lenn,'',$style,$required);
		$hezeform.= $this->formlabelend();
		}
		}	
	}
	$hezeform.=$this->activityLoader();
	$hezeform.= '</div>'.$this->setSubmit2($submit);
	$hezeform.= $this->formfooterdiv();
	$hezeform.= $this->formEnd();
	return $hezeform;
}//end

	//get update fields
	public function HezecomFormCreatorUpdate($table,$action,$editor,$style,$required,$key,$submit,$dpg){
	
	$hezeform= $this->credit_header('Update.php',$table);
	if(FORMS_PROCESSING=='Ajax'){
		$formId='hezecomform';
	}else{
		$formId='hezecomform2';
	}
	$rname = str_replace('_',' ',ucwords($table));
	$rename=ucwords($rname);
	$hezeform.= $this->formBegin($action,$formId);
	$hezeform.=$this->formheaderdiv('<?php echo LANG_UPDATE;?> '.$rename.'','yes',$dpg,$table,$key,$submit);
	$hezeform.=$this->activityLoader();
	if(FORMS_PROCESSING!='Ajax'){
	$hezeform.="
	
	<?php if(isset("."$"."errors))form_errors("."$"."errors);?>
	";
	}
	$hezeform.= $this->hiddenField($key);
	$outrow=$this->getTable($table);
		
	foreach ($outrow as $col) {
		$fname = str_replace('_',' ',ucfirst($col->Field));
		$fieldname = ucwords($fname);
		$fieldinput = $col->Field;
		$updatevalue="<?php echo ";$updatevalue.="$";$updatevalue.="rows->$fieldinput;?>";

    	preg_match_all('/\(([0-9 ]+?)\)/', $col->Type, $out);
		foreach($out as $lenout){
		if(isset($lenout[0])) $lenn = $lenout[0];
		}
		//ENUM		
		if(strpos($col->Type,'enum') !== false){
		$enumList = explode(",", str_replace("'", "", substr($col->Type, 5, (strlen($col->Type)-6))));
		if(FORM_TEMPLATE=='Grouped'){
		$hezeform.=$this->formlabelgroup($fieldname,$fieldinput);
		}else{
		$hezeform.=$this->formlabel($fieldname,$fieldinput);
		}
		$hezeform.= $this->enum_select($fieldinput,$updatevalue,$style,$required);
		foreach($enumList as $enumvalue){
		$hezeform.= $this->enum_list($enumvalue);	
		}
		$hezeform.='</select>';	
		$hezeform.= $this->formlabelend(); 
		}
		//TEXTAREA
		elseif(strpos($col->Type,'text') !== false or strpos($col->Type,'blob') !== false){
		if($editor!= 'wysiwyg_txt'){
		if(FORM_TEMPLATE=='Grouped'){
		$hezeform.=$this->formlabelgroup($fieldname,$fieldinput);
		}else{
		$hezeform.=$this->formlabel($fieldname,$fieldinput);
		}
		$hezeform.= $this->textarea($fieldinput,$updatevalue,$style,$required);
		$hezeform.= $this->formlabelend();
		
		}else{
		if(FORM_TEMPLATE=='Grouped'){
		$hezeform.=$this->formlabelgroup($fieldname,$fieldinput);
		}else{
		$hezeform.=$this->formlabel($fieldname,$fieldinput);
		}
		$hezeform.="<?php HezecomEditor('".$fieldinput."'); ?>
		";
		$hezeform.= $this->textarea($fieldinput,$updatevalue,$style); 
		$hezeform.= $this->formlabelend();
		}
		}
		//DATE
		elseif(strpos($col->Type,'date') !== false){
		if(FORM_TEMPLATE=='Grouped'){
		$hezeform.=$this->formlabelgroup($fieldname,$fieldinput);
		}else{
		$hezeform.=$this->formlabel($fieldname,$fieldinput);
		}
		$hezeform.= $this->date_year($fieldinput,$lenn,$date,$updatevalue,$style,$required);
		$hezeform.= $this->formlabelend();
		}
		//FILE
		elseif(strpos($col->Type,'varbinary') !== false){
		$upefile="<?php echo THUMB_FOLDER.";$upefile.="$";$upefile.="rows->$fieldinput;?>";
		$upefile2="<?php echo ";$upefile2.="$";$upefile2.="rows->$fieldinput;?>";
		//mul-listing
		if(FORM_TEMPLATE=='Grouped'){
		$hezeform.=$this->formlabelgroup($fieldname,$fieldinput);
		}else{
		$hezeform.=$this->formlabel($fieldname,$fieldinput);
		}
		if(UPLOAD_TYPE=='multipleimage' or UPLOAD_TYPE=='multiplefile'){
		$hezeform.= $this->fileFieldMultiple($fieldinput);
		$hezeform.=$this->fileListing($table,$key,$dpg); 
		}else{
		$hezeform.= $this->fileField2($fieldinput,$dpg,$upefile,$upefile2,$table,$required,$key);
		}
		$hezeform.= $this->formlabelend();
		}
		else {
		//TEXTINPUT
		if($key!=$col->Field){
		if(FORM_TEMPLATE=='Grouped'){
		$hezeform.=$this->formlabelgroup($fieldname,$fieldinput);
		}else{
		$hezeform.=$this->formlabel($fieldname,$fieldinput);
		}
		$hezeform.= $this->general_field($fieldinput,$lenn,$updatevalue,$style,$required);
		$hezeform.= $this->formlabelend();
		}
		}
	}
	$hezeform.=$this->activityLoader();
	$hezeform.= '</div>'.$this->setSubmit2($submit);
	$hezeform.= $this->formfooterdiv();
	$hezeform.= $this->formEnd();
	
	return $hezeform;
}

}//end class

?>