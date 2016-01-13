
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        patients.php
	* DATE CREATED:  	28-12-2015
	* FOR TABLE:  		patients
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/patients.php');
	
	class patients_controller {
	public $patients_model;
	
	public function __construct()  
    {  
        $this->patients_model = new patients_model();
    } 
	
	public function invoke_patients()
	{
	$active = (isset($_GET['active']) ? $_GET['active'] : "1");
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->patients_model->SelectAll(RECORD_PER_PAGE, $active);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->patients_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=patients&do=viewall&active='.$active);
	}else{
	$result = $this->patients_model->SelectAll(NULL, $active);	
	}
	include(APP_FOLDER.'/views/admin/patients/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->patients_model->SelectAll(NULL, $active);
	include(APP_FOLDER.'/views/admin/patients/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->patients_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/patients/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->patients_model->AutoSearch(trim($qstring),10,'first_name');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=patients&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->first_name.' '.$srow->last_name.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/patients/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('first_name')==''){
	json_error('Pleas enter First Name!');
	}
	elseif (post('last_name')==''){
	json_error('Please enter Last Name!');
	}
	elseif (post('phone')==''){
	json_error('Please enter Phone!');
	}
	elseif (post('email')==''){
	json_error('Please enter Email!');
	}
	elseif (post('source')==''){
	json_error('Please select Source!');
	}
	else{
	$this->patients_model->Insert(post('first_name'),post('last_name'),post('phone'),post('email'),post('source'),post('notes'));
	json_send(''.H_ADMIN.'&view=patients&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->patients_model->SelectOne(get('id'));
	//check if patient have card
	$have_card = patient_have_card(get('id'));	
	include(APP_FOLDER.'/views/admin/patients/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('first_name')==''){
	json_error('Please enter First Name!');
	}
	elseif (post('last_name')==''){
	json_error('Please enter Last Name!');
	}
	elseif (post('phone')==''){
	json_error('Please enter Phone!');
	}
	elseif (post('email')==''){
	json_error('Please enter Email!');
	}
	elseif (post('source')==''){
	json_error('Please select Source!');
	}
	else{
	$this->patients_model->Update(post('first_name'),post('last_name'),post('phone'),post('email'),post('source'),post('notes'),post('active'),post('id'));
	json_send(''.H_ADMIN.'&view=patients&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->patients_model->SelectOne(get('id'));
	//check if patient have card
	$have_card = patient_have_card(get('id'));	
	include(APP_FOLDER.'/views/admin/patients/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->patients_model->TruncateTable(''.H_ADMIN.'&view=patients&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/patients/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->patients_model->Delete(get('id'),''.H_ADMIN.'&view=patients&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->patients_model->Delete(get('id'),''.H_ADMIN.'&view=patients&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=patients&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	