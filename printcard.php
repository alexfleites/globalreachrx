<?php

	$conn = mysql_connect("localhost", "lobalre3_printrx", "TI46Tl8@EP0{") or die("Can not connect to the server");
	$db = mysql_select_db("lobalre3_printrxcard") or die("Can not connect to the database");
	
	include($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/functions.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/mpdf/mpdf.php");

	$mpdf = new mPDF('utf-8', 'A4');
	$mpdf->restrictColorSpace = 3;
	$mpdf->SetDisplayMode('fullpage');
	
	$site = $_REQUEST['site']; //get from which site comes from
	$id = $_REQUEST['pid'];

	$html = null;
	if($id > 0){
		$query = mysql_query("SELECT * FROM patients WHERE id = {$id}");
		if($row = mysql_fetch_array($query)){
			$full_name = $row['first_name'] . ' ' . $row['last_name'];
			$query = mysql_query("SELECT * FROM cards WHERE id_patient = {$id}");
			if($row = mysql_fetch_array($query)){
				$htmlFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/card.html";
				$html = file_get_contents($htmlFileLocation); 
				$html = fill_card($html, $site);
				$html = str_replace("{full_name}", $full_name, $html); //ful_name 
				$html = str_replace("{card_id}", $row['card_id'], $html); //card_id
				
				//output pdf file
				$mpdf->WriteHTML($html);
				$mpdf->Output();
			}
		}
	}
?>