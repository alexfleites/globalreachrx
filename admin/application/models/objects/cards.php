
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        cards_model
	* DATE CREATED:  	28-12-2015
	* FOR TABLE:  		cards
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_cards.php');
	
	class cards_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("cards LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("cards");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("cards");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("cards","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("cards","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE cards");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("cards","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($id_patient,$card,$date)
	{
	
	$values = array(array( 'id_patient'=>$id_patient,'card'=>$card,'date'=>$date ));
	HDB::hus()->Hinsert('cards', $values);
	}
	
	// UPDATE
	public function Update($id_patient,$card,$date,$id)
	{
	$sql = "  id_patient =:id_patient,card =:card,date =:date WHERE id = :id ";
	$data = array(':id_patient'=>$id_patient,':card'=>$card,':date'=>$date,':id'=>$id);
	HDB::hus()->Hupdate('cards',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	