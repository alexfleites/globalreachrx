<?php
/* include the ACS class page */
require_once("classes/ACS.php");
$ACS=new ACS();
if(isset($_POST['loginsubmit']))
{
	$username=$_POST['username'];	
	$password=$_POST['password'];
	print_r($_POST);
	/* You can check login details from database and set the session'username' if login is valid */
	if($username==$ACS->logusername && $password==$ACS->logpassword)
	{
		session_start();
		$_SESSION['username']=$username;
		header("Location:index.php");
	}
	else
	{
		header("Location:login.php");
		
	}
	
}
?>