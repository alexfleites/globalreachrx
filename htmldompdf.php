<?php

	set_include_path(get_include_path() . PATH_SEPARATOR . "/printrxcard/dompdf");
	require_once("dompdf/dompdf_config.inc.php");

	$htmlFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/card/card.html";
	$outputFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/card/card.pdf";
	$html = file_get_contents($htmlFileLocation);
	
	$dompdf = new DOMPDF();
	$dompdf->set_paper("A4", "portrait");
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream("card.pdf");	
?>