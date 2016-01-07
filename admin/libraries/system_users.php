
	<?php
	/*
	HEZECOM UltimateSpeed PHP CODE GENERATOR
	Author: Hezecom Technologies (http://hezecom.com) info@hezecom.net
	COPYRIGHT 2014 ALL RIGHTS RESERVED
	
	You must have purchased a valid license from CodeCanyon.com in order to have 
	access this file.

	You may only use this file according to the respective licensing terms 
	you agreed to when purchasing this item.
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	class admin_users_model{
	
	public $userid;
	public $name; 
	public $email; 
	public $phone; 
	public $username; 
	public $password; 
	public $membership; 
	public $user_status; 
	public $user_position; 
	public $user_avarta; 
	public $access_level; 
	public $date_created; 
	
	//Constructor
	public function __construct()
	{
	$this->userid = isset($userid);
	$this->name = isset($name);
	$this->email = isset($email);
	$this->phone = isset($phone);
	$this->username = isset($username);
	$this->password = isset($password);
	$this->membership = isset($membership);
	$this->user_status = isset($user_status);
	$this->user_position = isset($user_position);
	$this->user_avarta = isset($user_avarta);
	$this->date_created = isset($date_created);
	}
	
	// SELECT ALL
	public function SelectAll($limit=null)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect(H_SYSTEM_ACCESS." LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect(H_SYSTEM_ACCESS." category");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount(H_SYSTEM_ACCESS);	
	}
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone(H_SYSTEM_ACCESS,"userid=:id",$bind);
	}
	
	// SELECT ONE
	public function SelectUserID($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone(H_SYSTEM_ACCESS,"username=:id",$bind);
	}
	
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete(H_SYSTEM_ACCESS," userid=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($name,$email,$phone,$username,$password,$membership,$user_status,$user_position,$date_created)
	{
	$newupload = new UploadControl;
	$uploadname=$newupload->ImageUplaodResize('user_avarta',THUMB_IMAGE_WIDTH,BIG_IMAGE_WIDTH,UPLOAD_PATH,THUMB_PATH,90);
	if($uploadname==''){
	$values = array(array( 'name'=>$name,'email'=>$email,'phone'=>$phone,'username'=>$username,'password'=>$password,'membership'=>$membership,'user_status'=>$user_status,'user_position'=>$user_position,'date_created'=>$date_created));
	}else{
	$values = array(array( 'user_avarta'=>$uploadname,'name'=>$name,'email'=>$email,'phone'=>$phone,'username'=>$username,'password'=>$password,'membership'=>$membership,'user_status'=>$user_status,'user_position'=>$user_position,'date_created'=>$date_created));
	}
	HDB::hus()->Hinsert(H_SYSTEM_ACCESS, $values);
	}
	
	// UPDATE
	public function Update($name,$email,$phone,$membership,$user_status,$user_position,$date,$id)
	{
	$newupload = new UploadControl;
	$uploadname=$newupload->ImageUplaodResize('user_avarta',THUMB_IMAGE_WIDTH,BIG_IMAGE_WIDTH,UPLOAD_PATH,THUMB_PATH,90);
	if($uploadname==''){
		$sql = " UPDATE ".H_SYSTEM_ACCESS." SET  name ='$name',email ='$email',phone ='$phone',membership ='$membership',user_status ='$user_status',user_position ='$user_position',last_updated ='$date' WHERE userid = :id ";
	}else{
	$sql = " UPDATE ".H_SYSTEM_ACCESS." SET  user_avarta='$uploadname',name ='$name',email ='$email',phone ='$phone',membership ='$membership',user_status ='$user_status',user_position ='$user_position',last_updated ='$date' WHERE userid = :id ";	
	}
	$stmt=HDB::hus()->prepare($sql);
	$stmt->bindParam(':id',$id, PDO::PARAM_INT);
	$stmt->execute();
	}
	
	// UPDATE
	public function UpdatePassword($password,$date,$id)
	{
	$sql = " UPDATE ".H_SYSTEM_ACCESS." SET  password ='$password', last_updated ='$date' WHERE email = :email ";
	$stmt=HDB::hus()->prepare($sql);
	$stmt->bindParam(':email',$id);
	try{
	if($stmt->execute()){;
	return true;
	}
	}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	// LAST LOGIN
	public function UpdateLastLogin($date,$ip,$id)
	{
	$sql = " UPDATE ".H_SYSTEM_ACCESS." SET  last_login_date ='$date', last_login_ip ='$ip' WHERE userid = :id ";
	$stmt=HDB::hus()->prepare($sql);
	$stmt->bindParam(':id',$id, PDO::PARAM_INT);
	try{
	$stmt->execute();
	}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	
	
	// UPDATE EXEMPT
	public function UpdateExempt($name,$email,$phone,$date,$id)
	{
	$newupload = new UploadControl;
	$uploadname=$newupload->ImageUplaodResize('user_avarta',THUMB_IMAGE_WIDTH,BIG_IMAGE_WIDTH,UPLOAD_PATH,THUMB_PATH,90);
	if($uploadname==''){
	$sql = " UPDATE ".H_SYSTEM_ACCESS." SET  name ='$name',email ='$email',phone ='$phone',last_updated ='$date' WHERE userid = :id ";
	}
	else{
	$sql = " UPDATE ".H_SYSTEM_ACCESS." SET  user_avarta='$uploadname',name ='$name',email ='$email',phone ='$phone' ,last_updated ='$date' WHERE userid = :id ";	
	}
	try{
	$stmt=HDB::hus()->prepare($sql);
	$stmt->bindParam(':id',$id, PDO::PARAM_INT);
	$stmt->execute();
	} catch (PDOException $e) {
			$this->error = $e->getMessage();	
		}
	}
	
	
	//LOGIN
	public function HezeLogin($username,$password,$table) {
		
		$query = HDB::hus()->prepare("SELECT `password`, `username` FROM `$table` WHERE `username` = ?");
		$query->bindValue(1, $username);
		
		try{
			$query->execute();
			$data 			= $query->fetch();
			$my_password 	= $data['password'];
			$username   	= $data['username'];
			
			$hash = hezecom_crypt($password);
			if ($hash == hezecom_crypt($password, $my_password)) {
				return $username;	
			}else{
				return false;	
			}

		}catch(PDOException $e){
			die($e->getMessage());
		}
	
	}

//USER CHECK
	public function user_exist_checker($username,$table) {
		$query = HDB::hus()->prepare("SELECT COUNT(`username`) FROM `$table` WHERE `username`= ?");
		$query->bindValue(1, $username);
	
		try{
			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}
	
		
	public function account_activation($username,$table) {
		$query = HDB::hus()->prepare("SELECT COUNT(`username`) FROM `$table` WHERE `username`= ? AND `user_status`= ?");
		$query->bindValue(1, $username);
		$query->bindValue(2, 1);
		try{
			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch(PDOException $e){
			die($e->getMessage());
		}

	}
	
	//CHANGE PASSWORD
	public function current_password($password,$table,$field,$value) {
		$query = HDB::hus()->prepare("SELECT `password` FROM `$table` WHERE `$field` = ?");
		$query->bindValue(1, $value);
		try{
			$query->execute();
			$data 			= $query->fetch();
			$my_password   	= $data['password'];
			$hash = hezecom_crypt($password);
			if ($hash == hezecom_crypt($password, $my_password)) {
				return true;	
			}else{
				return false;	
			}
		}catch(PDOException $e){
			die($e->getMessage());
		}
	
	}
	
	//UserID
	function UserID()
	{
	$id=$_SESSION[H_USER_SESSION];
	$stmt=HDB::hus()->prepare("SELECT userid FROM ".H_SYSTEM_ACCESS." WHERE username=:id");
	$stmt->bindParam(':id',$id);
	$stmt->execute();
	$row= $stmt->fetch(PDO::FETCH_OBJ);
	return $row->userid;
	}
	//access level
	function UserAccess()
	{
	if(isset($_SESSION[H_USER_SESSION]))
	$id=$_SESSION[H_USER_SESSION];
	$stmt=HDB::hus()->prepare("SELECT * FROM ".H_SYSTEM_ACCESS." WHERE username=:id");
	$stmt->bindParam(':id',$id);
	$stmt->execute();
	return $stmt->fetch(PDO::FETCH_OBJ);
	}
	
	//Login Checker
	public function logged_in_user () {
		return(isset($_SESSION[H_USER_SESSION]) and $this->UserAccess()->user_status==1) ? true : false;
	}

	public function logged_in_protect($login) {
		if ($this->logged_in_user() === false) {
			send_to($login);
			exit();		
		}
	}
	//logout
	public function log_out_access($url) {
		if ($this->logged_in_user() === true) {
		unset($_SESSION[H_USER_SESSION]);
		session_destroy();
		send_to($url);
		exit();
		}		
	}
	
	//RETRIEVE PASSWORD
	public function LostPassword($table,$username) {
		$query = HDB::hus()->prepare("SELECT `email` FROM `$table` WHERE `email` = ?");
		$query->bindValue(1, $username);
		try{
			$query->execute();
			$data 		= $query->fetch();
			$email   	= $data['email'];
			if ($email == $username) {
				return $email;	
			}else{
				return false;	
			}
		}catch(PDOException $e){
			die($e->getMessage());
		}
	
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$stmt=HDB::hus()->prepare("SELECT * FROM ".H_SYSTEM_ACCESS." WHERE $where LIKE :svalue LIMIT $limit");	
	$stmt->bindValue(':svalue',"%{$qstring}");
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	
	} // end class
	
	?>
	
	