
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        patients
	* DATE CREATED:  	28-12-2015
	* FOR TABLE:  		patients
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class patients
	{
	public $id;
	public $first_name; 
	public $last_name; 
	public $phone; 
	public $email; 
	public $source; 
	public $notes; 
	public $date;
	public $active; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->first_name = isset($first_name);
	$this->last_name = isset($last_name);
	$this->phone = isset($phone);
	$this->email = isset($email);
	$this->source = isset($source);
	$this->notes = isset($notes);
	$this->active = isset($active);
	//$this->date = isset($date);
	}
	}