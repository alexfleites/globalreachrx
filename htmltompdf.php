<?php

	error_reporting(E_ALL);

	include($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/functions.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/mpdf/mpdf.php");

	$htmlFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/card/card.html";
	$outputFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/card/card.pdf";
	
	$html = file_get_contents($htmlFileLocation);
	$mpdf = new mPDF('utf-8', 'A3');
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->shrink_tables_to_fit = true;
	$mpdf->WriteHTML($html);
	$mpdf->Output();
	
?>