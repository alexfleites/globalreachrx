
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        patients_model
	* DATE CREATED:  	28-12-2015
	* FOR TABLE:  		patients
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_patients.php');
	
	class patients_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL, $active=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("patients " . ($active !== NULL && $active != 'all' ? "WHERE active = {$active} " : "") . "LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("patients " . ($active !== NULL && $active != 'all' ? "WHERE active = {$active} " : "") );	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("patients");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("patients","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
		$bind = array(":svalue" =>"%$qstring%");
		$result = HDB::hus()->Hselect("patients","$where LIKE :svalue LIMIT $limit",$bind);	
		if(!$result){
			$result = HDB::hus()->Hselect("patients","last_name LIKE :svalue LIMIT $limit",$bind);
		}
		return $result;	
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE patients");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	//$bind = array(":id" =>$id);
	//HDB::hus()->Hdelete("patients","id=:id",$bind);
	$sql = "  active =:active WHERE id = :id ";
	$data = array(':active'=>0,':id'=>$id);
	HDB::hus()->Hupdate('patients',$sql,$data);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($first_name,$last_name,$phone,$email,$source,$notes)
	{
		$first_name = ucwords($first_name);
		$last_name = ucwords($last_name);
		$email = strtolower($email);
		$date = date("Y-m-d");
		$values = array(array( 'first_name'=>$first_name,'last_name'=>$last_name,'phone'=>$phone,'email'=>$email,'source'=>$source,'notes'=>$notes,'date'=>$date ));
		HDB::hus()->Hinsert('patients', $values);
	}
	
	// UPDATE
	public function Update($first_name,$last_name,$phone,$email,$source,$notes,$active,$id)
	{
		$first_name = ucwords($first_name);
		$last_name = ucwords($last_name);
		$email = strtolower($email);
		$date = date("Y-m-d");
		$sql = "  first_name =:first_name,last_name =:last_name,phone =:phone,email =:email,source =:source,notes =:notes,date =:date, active =:active WHERE id = :id ";
		$data = array(':first_name'=>$first_name,':last_name'=>$last_name,':phone'=>$phone,':email'=>$email,':source'=>$source,':notes'=>$notes,':date'=>$date,':active'=>$active,':id'=>$id);
		HDB::hus()->Hupdate('patients',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	