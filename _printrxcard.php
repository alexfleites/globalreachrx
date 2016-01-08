<?php

	//require_once($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/acs/classes/ACS.php");

	$conn = mysql_connect("localhost", "lobalre3_printrx", "TI46Tl8@EP0{") or die("Can not connect to the server");
	$db = mysql_select_db("lobalre3_printrxcard") or die("Can not connect to the database");
	
	include($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/functions.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/mpdf/mpdf.php");
	$mpdf = new mPDF('utf-8', 'A3');
	$mpdf->SetDisplayMode('fullpage');
?>

<link href="/printrxcard/css/form.css" rel="stylesheet">
<!-- Bootstrap core CSS -->
<link href="/printrxcard/css/bootstrap.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="/printrxcard/css/grid.css" rel="stylesheet">


<!-- Font core CSS -->
<link rel="stylesheet" href="/printrxcard/css/font-awesome.css">
<link rel="stylesheet" href="/printrxcard/css/font-awesome.min.css">
<!--[if IE 7]>
	<link rel="stylesheet" href="/printrxcard/css/font-awesome-ie7.min.css">
<![endif]-->


<script type="text/javascript" src="/printrxcard/js/jquery.js"></script>

<script type="text/javascript">
	
	$(document).ready(function(){
		//
	});

</script>


<div class="container">

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
			array_push($error, "First Name is a required field");
		}
		if($last_name == ''){
			array_push($error, "Last Name is a required field");
		}
		if($email == ''){
			array_push($error, "Email Address is a required field");
		}else{
			if(!is_valid_email($email)){
				array_push($error, "Enter a valid Email Address");
			}
		}
		if($phone_number == ''){
			array_push($error, "Phone Number is a required field");
		}
		if($country == ''){
			array_push($error, "Country is a required field");
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
				array_push($error, "Email already registered in our system");
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

	<div class="row">
		<div class="panel panel-primary" style="width: 60%; margin:0 auto;">
			<div class="panel-heading">
				<h3 class="panel-title" style="color: white; margin-top: 0px; font-size: 22px; text-align: center;">PRINT RX CARD</h3>
			</div>
			<div class="panel-body">	
				<div class="well"> <!--  col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 -->
					<form id="printrxcard" role="form" method="post" action="">
						<p class="help-block" style="color:gray; font-style: italic; font-size: 11px;">All the information is required</p>
						<hr class="colorgraph2" style="margin:0;">
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
			                        <input type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1" value="<?php echo $_POST['first_name']?>">
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2" value="<?php echo $_POST['last_name']?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="3" value="<?php echo $_POST['email']?>">
						</div>
						<div class="form-group">
							<input type="text" name="phone_number" id="phone_number" class="form-control input-lg" placeholder="Phone Number" tabindex="4" value="<?php echo $_POST['phone_number']?>">
						</div>
						<div class="form-group">
							<select name="country" id="country" class="form-control" tabindex="5">
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
						
						<hr class="colorgraph2" style="margin:0;">
						<div class="row">
							<div class="col-xs-12 col-md-12"><center><input type="submit" value="Create RX Card" class="btn btn-success btn-block btn-lg" tabindex="6"></center></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
