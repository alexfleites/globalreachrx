<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/acs/classes/ACS.php");

	$htmlFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/card/card.html";
	$outputFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/card/card.pdf";
	
	//echo $htmlFileLocation . " to " . $outputFileLocation . "<br>"; 
	$ACS = new ACS();
	$ACS->convert("html", "pdf", $htmlFileLocation, $outputFileLocation);
?>

<embed src="<?php echo $outputFileLocation?>" width="800px" height="2100px">

