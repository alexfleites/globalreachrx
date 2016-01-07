<?php
if($_POST['operation']=="getColumns")
{	
	require_once('classes/ACS.php');
	$acs=new ACS();
	$table=$_POST['tables'];
	$coulmns=$acs->getColumnName($table);
	echo "<select name='column_name[]' multiple='multiple'>";
	foreach($coulmns as $coulmn)
	{
		echo "<option selected='selected' value=".$coulmn.">".$coulmn."</option>";
	}
	echo "</select>";
}