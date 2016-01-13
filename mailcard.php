<?php

	require_once $_SERVER['DOCUMENT_ROOT']."/printrxcard/vendor/autoload.php";

	$conn = mysql_connect("localhost", "lobalre3_printrx", "TI46Tl8@EP0{") or die("Can not connect to the server");
	$db = mysql_select_db("lobalre3_printrxcard") or die("Can not connect to the database");
	
	include($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/mpdf/mpdf.php");

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
				$card_file = $row['card'];
			}else{
				$card_not_exists = true;
				$card_id = get_last_id("card_id", "cards");
				$card_file =  $card_id . ".pdf";
				mysql_query("INSERT INTO cards (card_id, id_patient, card, date)
					VALUES('{$card_id}', '{$id}', '{$outputFileLocation}', NOW())");
				//save card
				$htmlFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/card.html";
				$html = file_get_contents($htmlFileLocation); 
				$html = fill_card($html, $site);
				$html = str_replace("{full_name}", $full_name, $html); //ful_name 
				$mpdf->WriteHTML($html);
				$outputFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/cards/{$card_file}";
				$mpdf->Output($outputFileLocation, 'F');
			}
			//To address and name
			$mail->addAddress($email, $full_name);
			
			$mail->addAttachment($card_file);
			
			//Send HTML or Plain Text email
			$mail->isHTML(true);
			if($site == 'globalreachhealth'){
				$mail->Subject = "Your Global Reach Health Benefit Card";
				$mail->Body = "Welcome to the Global Reach Health family!<br><br>Your personal Global Reach Health Card is here attached.<br>The Global Reach Health Card is more than just a benefit card.  It affords you the Global Reach Health Advantage, a concierge approach to your needs and insurance benefits.<br><br>Feel free to contact us with any question, whether it is a clinical, medical supply, or insurance benefit issue or concern. As a courtesy, if we are not a provider of your insurance and cannot service your needs, we will find a provider who can.<br><br>Present your card to your health services provider and pharmacist today to start saving, thanks to the Global Reach Health advantage!<br><br><br>- The Global Reach Health Team.";
			}else{
				$mail->Subject = "Your Global Reach Rx Benefit Card";
				$mail->Body = "Welcome to the Global Reach Rx family!<br><br>Your personal Global Reach Rx Card is here attached.<br><br>The Global Reach Rx Card is more than just a benefit card.  It affords you the Global Reach Rx Advantage, a concierge approach to your needs and insurance benefits.<br><br>Feel free to contact us with any question, whether it is a clinical, medical supply, or insurance benefit issue or concern. As a courtesy, if we are not a provider of your insurance and cannot service your needs, we will find a provider who can.<br><br>Present your card to your health services provider and pharmacist today to start saving, thanks to the Global Reach Rx advantage!<br><br><br>- The Global Reach Rx Team.";
			}	
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