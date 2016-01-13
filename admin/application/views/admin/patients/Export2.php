
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	28-12-2015
	* FOR TABLE:  		patients
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	<?php
	$date = new DateTime($rows->date);
	$etype=get('etype');
	$excel='';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>First Name</td>
	<td>'.$rows->first_name.'</td>
  	</tr>
    <tr>
	<td>Last Name</td>
	<td>'.$rows->last_name.'</td>
  	</tr>
    <tr>
	<td>Phone</td>
	<td>'.format_phone_number($rows->phone).'</td>
  	</tr>
    <tr>
	<td>Email</td>
	<td>'.$rows->email.'</td>
  	</tr>
    <tr>
	<td>Source</td>
	<td>'.$rows->source.'</td>
  	</tr>
    <tr>
	<td>Date</td>
	<td>'.$date->format('m/d/Y').'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 'patients_'.date('Y-m-d').'.doc';
	$filename2= 'patients_'.date('Y-m-d').'.xls';
	$pdf_output= 'patients_'.date('Y-m-d').'.pdf';
	if ($etype == 'word') {
	header("Content-type: application/msword");
	header("Content-Disposition: attachment; filename=$filename1");
	header("Pragma: no-cache");
	header("Expires: 0");
	print $excel;
	}
	elseif ($etype == 'excel') {
	header("Content-type: application/msexcel");
	header("Content-Disposition: attachment; filename=$filename2");
	header("Pragma: no-cache");
	header("Expires: 0");
	print $excel;
	}
	elseif ($etype == 'printer') {
	print'<title>'.H_TITLE.'</title>
	<script type="text/javascript">
	window.onload = function () {
		window.print();
	}
	</script>
	';
	print $excel;
	}
	