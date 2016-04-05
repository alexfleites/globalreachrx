<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/printrxcard/vendor/autoload.php";

	$site = $_REQUEST['site']; //get from which site comes from
	$lang = (isset($_REQUEST['lang']) ? $_REQUEST['lang'] : 'en');
	
	switch($site){
		case 'globalreachhealth':{ $source = "Global Reach Health"; break; }
		case 'globalreachrx':{ $source = "GlobalReach Rx"; break; }
		case 'belizerx':{ $source = "Belize Rx"; break; }
	}

	$conn = mysql_connect("localhost", "lobalre3_printrx", "TI46Tl8@EP0{") or die("Can not connect to the server");
	$db = mysql_select_db("lobalre3_printrxcard") or die("Can not connect to the database");
	
	include($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/functions.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/mpdf/mpdf.php");
	$mpdf = new mPDF('utf-8', 'A4');
	$mpdf->restrictColorSpace = 3;
	$mpdf->SetDisplayMode('fullpage');
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- Mobile-friendly viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<title><?php echo ($site == "globalreachhealth" ? "GlobalReachHealth" : ($site == 'globalreachrx' ? "GlobalReachRX" : "BelizeRX"))?></title>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href="form/css/bootstrap.min.css" rel="stylesheet">
<link href="form/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
	if($_POST){

		//var_dump($_POST);

		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$phone_number = $_POST['phone_number'];
		$country = $_POST['country'];
		$source = $_POST['source'];

		$error = array();

		if($first_name == ''){
			array_push($error, "Please enter First Name!");
		}
		if($last_name == ''){
			array_push($error, "Please enter Last Name!");
		}
		if($email == ''){
			array_push($error, "Please enter Email Address!");
		}else{
			if(!is_valid_email($email)){
				array_push($error, "Please enter a valid Email Address!");
			}
		}
		if($phone_number == ''){
			array_push($error, "Please enter Phone Number!");
		}
		if($country == ''){
			array_push($error, "Please select Country!");
		}

		if(count($error) == 0){

			//get post data
			$first_name = ucwords($first_name);
			$last_name = ucwords($last_name);
			$email = strtolower($email);

			//check if email is already registered
			$sql = "SELECT * FROM patients WHERE email = '$email' AND active=1";
			$res = mysql_query($sql);
			if(mysql_num_rows($res) > 0){
				array_push($error, "Email already registered, try different email!");
			}else{
				//insert new patient
				$sql = "INSERT INTO patients (first_name, last_name, phone, email, source, notes, date)
					VALUES('{$first_name}', '{$last_name}', '{$phone_number}', '{$email}', '{$source}', '', NOW())";
				mysql_query($sql);
				$id = mysql_insert_id();
				if($id > 0){
					//create card
					$card_id = get_last_id("card_id", "cards");
					$card_file =  $card_id . ".pdf";
					//replace information on html
					$htmlFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/card.html";
					$html = file_get_contents($htmlFileLocation);
					$html = fill_card($html, $site);
					$html = str_replace("{full_name}", $first_name . ' ' . $last_name, $html); //ful_name
					$html = str_replace("{card_id}", $card_id, $html); //card_id

					//output pdf file
					$mpdf->WriteHTML($html);
					$outputFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/cards/{$card_file}";
					$mpdf->Output($outputFileLocation, 'F');
					//save card
					mysql_query("INSERT INTO cards (card_id, id_patient, card, date)
						VALUES('{$card_id}', '{$id}', '{$outputFileLocation}', NOW())");					
					//clear POST
					
					//Send notification to the customer
					$mail = new PHPMailer;
					if($site == 'globalreachhealth'){
						$mail->From = "info@globalreachhealth.com";
						$mail->FromName = "Global Reach Health";
					}else{
						$mail->From = "info@globalreachrx.com";
						$mail->FromName = "Global Reach RX";
					}
					//To address and name
					$mail->addAddress($email, $full_name);
					$mail->addAttachment($outputFileLocation);
					//Send HTML or Plain Text email
					$mail->isHTML(true);
					$mail->Subject = "";
					$mail->Body = "";
					$mail->send();
				}
				$location = "card.php?pid=" . $id . "&site=" . $site;
				header("Location: {$location}");
			}?>
<?php	} //end count(error) == 0?>
<?php 
	} //end $_POST ?>

<form id="printrxcard" role="form" method="post" action="">
<input type="hidden" name="source" value="<?php echo $source ?>">
<div class="healthcard_Sec">

	<?php
		if(count($error) > 0){?>
		<div class="row">
	        <div class="alert alert-danger" style="width: 60%; margin:0 auto;">
	            <p>
	            	<?php echo implode("<br>", $error); ?>
	            </p>
	        </div>
		</div>
	<?php 
		}
	?>
  <div class="H-card">
	<div class="logo-sec">
	<?php 
		switch($site){
			case 'globalreachhealth':{
				echo "<img src='http://www.globalreachhealth.com/wp-content/uploads/2016/01/GlobalReachHealth__RGB.png' width='370' alt=''/>";
				break;
			}
			case 'globalreachrx':{
				echo "<img src='form/images/logo.png' alt=''/>";
				break;
			}
			case 'belizerx':{
				echo "<img src='http://www.belizerx.com/wp-content/uploads/2016/01/logo-1.png' alt=''/>";
				break;
			}
		} //end switch 
	?>
	</div>
    <div class="discount-card">
	<h1>
	<?php 
		switch($site){
			case 'globalreachhealth':{
				switch ($lang) {
					case 'en':
					case 'zh':{
						echo "start saving now";
						break;
					}
					case 'es':{
						echo "empieze a ahorrar ahora";
						break;
					}					
				}
				break;
			}
			case 'globalreachrx':
			case 'belizerx':{
				switch($lang){
					case 'en':
					case 'zh':{
						echo "pharmacy discount card";
						break;
					}
					case 'es':{
						echo "tarjeta de descuento";
						break;
					}					
				}
				break;
			}
		} //end switch 
	?>
	</h1>
    </div>
    <div class="inpt-flds">
      <h1> <?php echo ($lang == 'en' || $lang == 'zh' ? "Enter your information" : ($lang=='es' ? "Entre su informacion" : ""))?></h1>
           <div class="info">
          <input type="text" id="first_name" name="first_name" class="form-control" placeholder="<?php echo ($lang == 'en' || $lang == 'zh' ? "First Name" : ($lang=='es' ? "Nombre" : ""))?>" value="<?php echo $_POST['first_name']?>">
        </div>
        <div class="info">
          <input type="text" id="last_name" name="last_name" class="form-control" placeholder="<?php echo ($lang == 'en' || $lang == 'zh' ? "Last Name" : ($lang=='es' ? "Apellido" : ""))?>" value="<?php echo $_POST['last_name']?>">
        </div>
     
        <div class="info">
          <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="<?php echo ($lang == 'en' || $lang == 'zh' ? "Phone Number" : ($lang=='es' ? "Telefono" : ""))?>" value="<?php echo $_POST['phone_number']?>">
        </div>
        <div class="info">
          <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo $_POST['email']?>">
        </div>
        <div class="slct">
           <select id="country" name="country" class='css-select'>
				<option value=""><?php echo ($lang == 'en' || $lang == 'zh' ? "Select One" : ($lang=='es' ? "Seleccione" : ""))?></option>
				<?php
					$res = mysql_query("SELECT * FROM country ORDER BY name");
					while($row = mysql_fetch_array($res)){?>
						<option value="<?php echo $row['iso']?>" <?php echo ($row['iso'] == $_POST['country'] ? "selected" : "")?>><?php echo $row['name']?></option>
				<?php
					}	
				?>
			</select> 
        </div>
        <div class="info info-detail">
          <h1>ID # <span><?php echo ($lang == 'en' || $lang == 'zh' ? "Create your card to generate Member ID" : ($lang=='es' ? "Crear tarjeta para obtener un ID de Miembro" : ""))?></span></h1>
        </div>
        <div class="info info-detailR">
          <div class="info-detailR-fst">
            <h1>Bin# <span>011867</span></h1>
          </div>
          <div class=" info-detailR-scnd">
            <h1>Group# <span>WBXXXXXXX</span></h1>
          </div>
        </div>
      
    </div>
    <div class="save-up">
	<?php 
		switch($site){
			case 'globalreachhealth':{
				switch ($lang) {
					case 'en':
					case 'zh':{
						echo "Save up to 75% on 50,000 drugs and medical services worldwide.";
						break;
					}
					case 'es':{
						echo "Ahorre hasta el 75% on 50,000 medicinas y servicios medicos.";
						break;
					}
				}
				break;
			}
			case 'globalreachrx':
			case 'belizerx':{
				switch ($lang) {
					case 'en':
					case 'zh':{
						echo "Save up to 75% on 50,000 drugs at over 60,000 pharmacies";
						break;
					}
					case 'es':{
						echo "Ahorre hasta el 75% on 50,000 en medicinas en 60,000 farmacias";
						break;
					}
				}
				break;
			}
		} //end switch 
	?>
    </div>
    <ul class="<?php echo ($site == 'globalreachhealth' ? "terms-gh" : ($site == 'globalreachrx' ? "terms" : "terms-bz") )?>">
		<?php switch ($lang) {
			case 'en':
			case 'zh':{
			    echo "<li>This card is not insurance.  </li>";
				echo "<li>You will not be denied medication(s) due to pre-existing condition(s).</li>";
				break;
			}
			case 'es':{
			    echo "<li>Esta tarjeta no es un seguro.  </li>";
				echo "<li>No se le negaran medicinas debido a condiciones persistentes.</li>";
				break;
			}
		}
		?>
		<?php 
			switch($site){
				case 'globalreachhealth':{
					switch ($lang) {
						case 'en':
						case 'zh':{
							echo "<li>Present this card to your local pharmacy and/or clinical to save on prescriptions<br>and medical services.</li>";
							break;
						}
						case 'es':{
							echo "<li>Presente esta tarjeta en su farmacia local o clinica y ahorre en sus recetas o servicios medicos.</li>";
							break;
						}
					}
					break;
				}
				case 'globalreachrx':
				case 'belizerx':{
					switch ($lang) {
						case 'en':
						case 'zh':{
							echo "<li>Present this card to your local pharmacy to save on your prescriptions.</li>";
							break;
						}
						case 'es':{
							echo "<li>Presente esta tarjeta en su farmacia local o clinica y ahorre en sus recetas.</li>";
							break;
						}
					}
					break;
				}
			} //end switch 
		?>
		
    </ul>
    <div class="clear"></div>
  </div>
  <div class="card-bottom">
  <?php if($lang == 'en' || $lang == 'zh'){?>
  <p>By submitting this form, I confirm that I am at least 18 years old.  
  I agree to the privacy policy and terms and conditions.  I also agree to be contacted
   via phone and/or email by <?php echo ($site == "globalreachhealth" ? "Global Reach Health" : ($site == 'globalreachrx' ? "Global Reach RX" : "Belize RX"))?> in case I need help in obtaining medication(s).</p>
   <button type="submit" class="create-btn" style="margin-bottom: 20px;">create my card</button>
   <p style="text-align: justify;"><b>Disclaimer:</b> 
This is NOT insurance.  It is a discount pharmacy and medical program for international patients.  Cardholders are responsible for paying the discounted cost at the time of service from participating providers.</p>
  </div>
  <?php }else if($lang == 'es'){?>
  <p>Al enviar este formulario, confirmo que tengo por lo menos 18 años de edad.
  Estoy de acuerdo con la política de privacidad y términos y condiciones . También me acuerdo en ser contactado
   por teléfono y / o correo electrónico por <?php echo ($site == "globalreachhealth" ? "Global Reach Health" : ($site == 'globalreachrx' ? "Global Reach RX" : "Belize RX"))?> en caso de que necesite ayuda en la obtención de medicamentos (s).</p>
   <button type="submit" class="create-btn" style="margin-bottom: 20px;">crear tarjeta</button>
   <p style="text-align: justify;"><b>Nota:</b> 
Este NO es un seguro . Es una farmacia de descuento y el programa médico para los pacientes internacionales . Los titulares de tarjetas son responsables de pagar el precio con descuento en el momento de servicio de los proveedores participantes.</p>
  </div>
  <?php } //end if ?>
  <?php include ('card_footer.php'); ?>
</div>
</form>
<?php include('footer.php'); ?>
<script src="form/js/jquery-2.1.4.min.js" type="text/javascript"></script> 
</body>
</html>
