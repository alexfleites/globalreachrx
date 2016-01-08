
	<?php
	
	/*
	Hezecom Responsive Gallery, Portfolio and Slider Manager
	Author: Hezecom Technologies (http://hezecom.com) info@hezecom.net
	COPYRIGHT 2014 ALL RIGHTS RESERVED
	
	You must have purchased a valid license from CodeCanyon.com in order to have 
	access this file.

	You may only use this file according to the respective licensing terms 
	you agreed to when purchasing this item.
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	if(get('view')=='hsys_users'){
	//Select	
	if(get('do')=='viewall'){
	if($haccess->UserAccess()->user_position==1){
	$result = $haccess->SelectAll(RECORD_PER_PAGE);
	$paging = pagination($haccess->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=hsys_users&do=viewall');
	include('libraries/views/admin/View.php');
	}else{
	send_to(''.H_ADMIN.'&view=hsys_users2&do=details');
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	if($haccess->UserAccess()->user_position==1){
	if(post('button')){
	//validation 
	 if ($haccess->user_exist_checker(post('username'),H_SYSTEM_ACCESS) === true) {
            $errors[] = 'That username already exists';
        }
        elseif(!ctype_alnum(post('username'))){
            $errors[] = 'Please enter a username with only alphabets and numbers';	
        }
		elseif ((strlen(post('username'))>15)){
			$errors[] ='Your username is too long!';
			}
        elseif (strlen(post('password')) <5){
            $errors[] = 'Your password must be atleast 5 characters';
        } elseif (strlen(post('password')) >30){
            $errors[] = 'Your password is too long';
        }
		elseif (post('password')!=post('password2')){
            $errors[] = 'Your passwords are not the same.';
        }
        elseif (filter_var(post('email'), FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'Please enter a valid email address';
        }
		elseif(empty($errors) === true){
		$username 	= htmlentities(post('username'));
		$password= hezecom_crypt(post('password'));
		
		
	$haccess->Insert(post('name'),post('email'),post('phone'),post('username'),$password,post('membership'),post('user_status'),post('user_position'),date('Y-m-d'),$haccess->UserID());
	send_to(''.H_ADMIN.'&view=hsys_users&do=viewall&msg=add');
	}
	}
	include('libraries/views/admin/Add.php');
	}
	}

	//UPDATE ////////////////////////////////////////////////
	elseif(get('do')=='update'){
	if(post('button')){
	
        if (filter_var(post('email'), FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'Please enter a valid email address';
        }
		elseif(empty($errors) === true){
		
	$haccess->Update(post('name'),post('email'),post('phone'),post('membership'),post('user_status'),post('user_position'),date('Y-m-d'),post('userid'));
	send_to(''.H_ADMIN.'&view=hsys_users&userid='.get('userid').'&do=details&msg=update');
	}
	}
	$rows = $haccess->SelectOne(get('userid'));
	include('libraries/views/admin/Update.php');
	}
	
	//CHANGE PASSWORD
	elseif(get('do')=='updatepwd'){
	if(post('button')){
	
	 	  if (post('password')==''){
            $errors[] = 'Your password cannot be empty';
        } 
		 elseif (post('password')!='' and strlen(post('password')) <5){
            $errors[] = 'Your password must be atleast 5 characters';
        } 
		elseif (strlen(post('password')) >30){
            $errors[] = 'Your password cannot be more than 30 characters long';
        }
		elseif (post('password')!=post('password2')){
            $errors[] = 'Your passwords are not the same.';
        }
       
		elseif(empty($errors) === true){
		$password= hezecom_crypt(post('password'));
	
	$haccess->UpdatePassword($password,date('Y-m-d'),post('userid'));
	send_to(''.H_ADMIN.'&view=hsys_users&userid='.get('userid').'&do=details&msg=update');
	}
	}
	$rows = $haccess->SelectOne(get('userid'));
	include('libraries/views/admin/ChangePwd.php');
	}
	
	//Details
	elseif(get('do')=='details'){
	$rows = $haccess->SelectOne(get('userid'));
	include('libraries/views/admin/Details.php');
	}
	
	//LOGIN ////////////////////////////////////////////////
	elseif(get('do')=='loginpro'){

	if($_POST){
	$username = trim(post('username'));
	$password = trim(post('password'));

	if (empty($username) === true || empty($password) === true) {
		json_error(LANG_ADMIN_INVALID_PASSWORD);
	} else if ($haccess->user_exist_checker($username,H_SYSTEM_ACCESS) === false) {
		json_error(LANG_ADMIN_INVALID_USERNAME);
	} else if ($haccess->account_activation($username,H_SYSTEM_ACCESS) === false) {
		json_error(LANG_ADMIN_INVALID_ACTIVATION);
	} else {
		
		$login = $haccess->HezeLogin($username, $password,H_SYSTEM_ACCESS);
		if ($login === false) {
			json_error(LANG_ADMIN_ERROR);
		}else {
			$_SESSION[H_USER_SESSION] =  $login;
			$haccess->UpdateLastLogin(date('Y-m-d'),$_SERVER['REMOTE_ADDR'],$haccess->UserID());
			json_send(H_ADMIN);
			json_success('Loggin in');
			exit();
		}
	}
} 
	}
	//logout
	elseif(get('do')=='logout'){
	$haccess->log_out_access(H_LOGIN);
	}

	//Delete
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('userid') and $dfile==''){
	$del = $haccess->Delete(get('userid'),''.H_ADMIN.'&view=hsys_users&do=viewall&msg=delete');
	}
	elseif(get('userid') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $haccess->Delete(get('userid'),''.H_ADMIN.'&view=hsys_users&do=viewall&msg=delete');
	}
	elseif(get('userid') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=hsys_users&userid='.get('userid').'&do=update&msg=delete');
	}
	}
	}//end get
	
	
	
	//LIMITED ACCESS////////////////////////////////////////////
	if(get('view')=='hsys_users2'){
	//Select	
	if(get('do')=='viewall'){
	$result = $haccess->SelectAll(RECORD_PER_PAGE);
	$paging = pagination($haccess->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=hsys_users2&do=viewall');
	include('libraries/views/admin/View.php');
	}
	
	//UPDATE 
	elseif(get('do')=='update'){
	if(post('button')){
		
        if (filter_var(post('email'), FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'Please enter a valid email address';
        }
		elseif(empty($errors) === true){
		
	$haccess->UpdateExempt(post('name'),post('email'),post('phone'),date('Y-m-d'),$haccess->UserID());
	send_to(''.H_ADMIN.'&view=hsys_users2&do=details&msg=update');
	}
	}
	$rows = $haccess->SelectOne($haccess->UserID());
	//$mytable=$haccess->CustomShow();
	include('libraries/views/admin/Update2.php');
	}
	
	//CHANGE PASSWORD
	elseif(get('do')=='updatepwd'){

	if(post('button')){
		
	 if (post('password')==''){
            $errors[] = 'Your password cannot be empty';
        } 
	
	elseif ($haccess->current_password(post('oldpassword'),H_SYSTEM_ACCESS,'userid',$haccess->UserID()) === false) {
		$errors[] = 'Your old password is not correct!';
	}
	 	elseif (post('password')!='' and strlen(post('password')) <5){
            $errors[] = 'Your password must be atleast 5 characters';
        } 
		elseif (strlen(post('password')) >30){
            $errors[] = 'Your password cannot be more than 30 characters long';
        }
		elseif (post('password')!=post('password2')){
            $errors[] = 'Your passwords are not the same.';
        }
       
		elseif(empty($errors) === true){
		$password= hezecom_crypt(post('password'));
	
	$haccess->UpdatePassword($password,date('Y-m-d'),post('userid'));
	send_to(''.H_ADMIN.'&view=hsys_users2&do=details&msg=update');
	}
	}
	include('libraries/views/admin/ChangePwd2.php');
	}
	
	//Details
	elseif(get('do')=='details'){
	$rows = $haccess->SelectOne($haccess->UserID());
	include('libraries/views/admin/Details2.php');
	}
	}
	
	
	
	//SEARCH SUGGEST//////////////////////////////////////////////
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $haccess->AutoSearch(trim($qstring),10,'name');
	echo' <div class="widget"><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading">
	<a href="'.H_ADMIN.'&view=hsys_users&userid='.$srow->userid.'&do=details"><li class="list-group-item">'. $srow->name.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	?>
	