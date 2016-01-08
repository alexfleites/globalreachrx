<?php
	$site = $_REQUEST['site'];

	$conn = mysql_connect("localhost", "lobalre3_printrx", "TI46Tl8@EP0{") or die("Can not connect to the server");
	$db = mysql_select_db("lobalre3_printrxcard") or die("Can not connect to the database");
	
	include($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/functions.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/mpdf/mpdf.php");
	$mpdf = new mPDF('utf-8', 'A3');
	$mpdf->SetDisplayMode('fullpage');
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta charset="utf-8">
<!-- Mobile-friendly viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<title><?php echo ($site == "globalreachhealth" ? "GlobalReachHealth" : "GlobalReachRX")?></title>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.css" rel="stylesheet">
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
			$sql = "SELECT * FROM patients WHERE email = '$email'";
			$res = mysql_query($sql);
			if(mysql_num_rows($res) > 0){
				array_push($error, "Email already registered, try different!");
			}else{
				//insert new patient
				$sql = "INSERT INTO patients (first_name, last_name, phone, email, source, notes, date)
					VALUES('{$first_name}', '{$last_name}', '{$phone_number}', '{$email}', 'Global Reach Health', '', NOW())";
				mysql_query($sql);
				$id = mysql_insert_id();
				if($id > 0){
					//create card
					$card_id = get_last_id("card_id", "cards");
					$card_file =  $card_id . ".pdf";
					//replace information on html
					$htmlFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/cards/card.html";
					$html = file_get_contents($htmlFileLocation);
					$html = str_replace("{full_name}", $first_name . ' ' . $last_name, $html); //ful_name
					$html = str_replace("{card_id}", $card_id, $html); //card_id
					$html = str_replace("{card_bin}", uniqid(), $html); //card_bin
					$html = str_replace("{group_number}", uniqid(), $html); //group_number
					$html = str_replace("{pharmacy_help}", "(877) 459-8474", $html); //pharmacy_help

					$mpdf->WriteHTML($html);
					$outputFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/cards/files/{$card_file}";
					//output pdf file
					$mpdf->Output($outputFileLocation, 'F');
					//save card
					mysql_query("INSERT INTO cards (card_id, id_patient, card, date)
						VALUES('{$card_id}', '{$id}', '{$outputFileLocation}', NOW())");					
					//clear POST
				}
				$location = "card.php?pid=" . $id;
				header("Location: {$location}");
			}?>
<?php	} //end count(error) == 0?>
<?php 
	} //end $_POST ?>

<form id="printrxcard" role="form" method="post" action="">
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
    <div class="logo-sec"> <img src="form/images/logo.png" alt=""/> </div>
    <div class="discount-card">
      <h1>pharmacy discount card</h1>
    </div>
    <div class="inpt-flds">
      <h1> Enter your information</h1>
           <div class="info">
          <input type="text" id="first_name" name="first_name" class="form-control" id="exampleInputEmail3" placeholder="First Name" value="<?php echo $_POST['first_name']?>">
        </div>
        <div class="info">
          <input type="text" id="last_name" name="last_name" class="form-control" id="exampleInputPassword3" placeholder="Last Name"<?php echo $_POST['last_name']?>>
        </div>
     
        <div class="info">
          <input type="text" id="phone_number" name="phone_number" class="form-control" id="exampleInputPassword3" placeholder="Phone Number" value="<?php echo $_POST['phone_number']?>">
        </div>
        <div class="info">
          <input type="text" id="email" name="email" class="form-control" id="exampleInputEmail3" placeholder="Email" value="<?php echo $_POST['email']?>">
        </div>
        <div class="slct">
           <select id="country" name="country" class='css-select'>
				<option value="">Select One</option>
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
          <h1>ID # <span>Create your card to generate Member ID</span></h1>
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
    Save up to 75% on 50,000 drugs at over 60,000 pharmacies
    </div>
    <ul class="terms">
	    <li>This card is not insurance.  </li>
		<li>You will not be denied medication(s) due to pre-existing condition(s).</li>
		<li>Present this card to your local pharmacy to save on your prescriptions.</li>
    </ul>
    <div class="clear"></div>
  </div>
  <div class="card-bottom">
  <p>By submitting this form, I confirm that I am at least 18 years old.  
  I agree to the privacy policy and terms and conditions.  I also agree to be contacted
   via phone and/or email by Global Reach Rx in case I need help in obtaining medication(s).</p>
   <button type="submit" class="create-btn">create my card</button>
  </div>
</div>
</form>

<?php include('footer.php'); ?>
<script src="form/js/jquery-2.1.4.min.js" type="text/javascript"></script> 
</body>
</html>
