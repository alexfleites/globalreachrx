<?php

	require_once $_SERVER['DOCUMENT_ROOT']."/printrxcard/vendor/autoload.php";

	$conn = mysql_connect("localhost", "lobalre3_printrx", "TI46Tl8@EP0{") or die("Can not connect to the server");
	$db = mysql_select_db("lobalre3_printrxcard") or die("Can not connect to the database");
	
	include($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/mpdf/mpdf.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/functions.php");

	$mpdf = new mPDF('utf-8', 'A4');
	$mpdf->restrictColorSpace = 3;
	$mpdf->SetDisplayMode('fullpage');

	$id = $_REQUEST['pid'];
	$site = $_REQUEST['site'];
	
	//PHPMailer Object
	$mail = new PHPMailer;
	
	//From email address and name
	if($site == 'globalreachhealth'){
		$mail->From = "info@globalreachhealth.com";
		$mail->FromName = "Global Reach Health";
	}else{
		$mail->From = "info@globalreachrx.com";
		$mail->FromName = "Global Reach RX";
	}
	if($id > 0){
		$query = mysql_query("SELECT * FROM patients WHERE id = {$id}"); // AND active = 1
		if($row = mysql_fetch_array($query)){
			$full_name = $row['first_name'] . ' ' . $row['last_name'];
			$email = $row['email'];
			$query = mysql_query("SELECT * FROM cards WHERE id_patient = {$id}");
			$card_not_exists = false;
			if($row = mysql_fetch_array($query)){
				$card_id = $row['card_id'];
				$card_file = $card_id . ".pdf";
			}else{
				$card_not_exists = true;
				$card_id = get_last_id("card_id", "cards");
				$card_file =  $card_id . ".pdf";
				mysql_query("INSERT INTO cards (card_id, id_patient, card, date)
					VALUES('{$card_id}', '{$id}', '{$outputFileLocation}', NOW())");
			}

			$outputFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/cards/{$card_file}";
			if(!$card_not_exists){
				unlink($outputFileLocation);
			}
			//save card
			if($site == 'globalreachhealth'){
				$htmlFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/GlobalReach.html";
			}else{
				$htmlFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/card.html";
			}
			$html = file_get_contents($htmlFileLocation); 
			$html = fill_card($html, $site);
			$html = str_replace("{full_name}", $full_name, $html); //ful_name 
			$mpdf->WriteHTML($html);
			$mpdf->Output($outputFileLocation, 'F');

			//To address and name
			$mail->addAddress($email, $full_name);
			
			$mail->addAttachment($outputFileLocation);
			
			//Send HTML or Plain Text email
			$mail->isHTML(true);
			switch($site){
				case 'globalreachhealth':
				{
					$mail->Subject = "Your Global Reach Health Discuount Card";
					$mail->Body = "Welcome to the Global Reach Health family!<br><br>Your personal Global Reach Health Card is attached.<br>The Global Reach Health Discount Card is more than just a discount card. It affords you the Global Reach Health Advantage, a concierge approach to your medical needs.<br><br>Feel free to contact us with any question, whether it is a clinical, medical supply, or pharmacy issue or concern. Present your card to your pharmacist today to start saving now.<br><br>Prior to seeking medical services, please contact Global Reach Health at (305) 431-5350 to start the savings process.<br><br>Feel free to contact us with any questions or concerns.<br><br><br>- Your Global Reach Health Team.";
					break;
				}
				case 'globalreachrx':
				{
					$mail->Subject = "Your Global Reach Rx Discount Card";
					$mail->Body = "Welcome to the Global Reach Rx family!<br><br>Your personal Global Reach Rx Discount Card is attached.<br><br>The Global Reach Rx Discount Card is more than just a discount card. It affords you the Global Reach Rx Advantage, a concierge approach to your pharmacy needs.<br><br>Feel free to contact us with any pharmacy question or concern.<br><br>Present your card to your pharmacist today to start saving now.<br><br><br>- Your Global Reach Rx Team.";
					break;
				}
				case 'belizerx':
				{
					$mail->Subject = "Your Belize Rx Discount Card";
					$mail->Body = "Welcome to the Belize Rx family!<br><br>Your personal Belize Rx Discount Card is attached.<br><br>The Belize Rx Discount Card is more than just a discount card. It affords you the Belize Rx Advantage, a concierge approach to your pharmacy needs.<br><br>Feel free to contact us with any pharmacy question or concern.<br><br>Present your card to your pharmacist today to start saving now.<br><br><br>- Your Belize Rx Team.";
					break;
				}
			} //end switch 
			//$mail->AltBody = "This is the plain text version of the email content";
			
			if(!$mail->send()) 
			{
			    echo $mail->ErrorInfo;
			} 
			else 
			{
			    echo "success";
			}
		}
	}
?>