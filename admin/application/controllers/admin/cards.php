
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        cards.php
	* DATE CREATED:  	28-12-2015
	* FOR TABLE:  		cards
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/cards.php');
	
	class cards_controller {
	public $cards_model;
	
	public function __construct()  
    {  
        $this->cards_model = new cards_model();
    } 
	
	public function invoke_cards()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->cards_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->cards_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=cards&do=viewall');
	}else{
	$result = $this->cards_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/cards/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->cards_model->SelectAll();
	include(APP_FOLDER.'/views/admin/cards/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->cards_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/cards/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->cards_model->AutoSearch(trim($qstring),10,'id_patient');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=cards&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->id_patient.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/cards/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('id_patient')==''){
	json_error('The field id patient cannot be empty!');
	}
	elseif (post('card')==''){
	json_error('The field card cannot be empty!');
	}
	elseif (post('date')==''){
	json_error('The field date cannot be empty!');
	}
	else{
	$this->cards_model->Insert(post('id_patient'),post('card'),post('date'));
	json_send(''.H_ADMIN.'&view=cards&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->cards_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/cards/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('id_patient')==''){
	json_error('The field id patient cannot be empty!');
	}
	elseif (post('card')==''){
	json_error('The field card cannot be empty!');
	}
	elseif (post('date')==''){
	json_error('The field date cannot be empty!');
	}
	else{
	$this->cards_model->Update(post('id_patient'),post('card'),post('date'),post('id'));
	json_send(''.H_ADMIN.'&view=cards&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->cards_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/cards/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->cards_model->TruncateTable(''.H_ADMIN.'&view=cards&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/cards/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->cards_model->Delete(get('id'),''.H_ADMIN.'&view=cards&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->cards_model->Delete(get('id'),''.H_ADMIN.'&view=cards&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=cards&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	