<?php

	//require_once($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/acs/classes/ACS.php");

	$conn = mysql_connect("localhost", "lobalre3_printrx", "TI46Tl8@EP0{") or die("Can not connect to the server");
	$db = mysql_select_db("lobalre3_printrxcard") or die("Can not connect to the database");
	
	include($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/functions.php");

?>

<link href="/printrxcard/css/form.css" rel="stylesheet">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">


<!-- Custom styles for this template -->
<link href="/printrxcard/css/grid.css" rel="stylesheet">


<!-- Font core CSS -->
<link rel="stylesheet" href="/printrxcard/css/font-awesome.css">
<link rel="stylesheet" href="/printrxcard/css/font-awesome.min.css">
<!--[if IE 7]>
	<link rel="stylesheet" href="/printrxcard/css/font-awesome-ie7.min.css">
<![endif]-->


<script type="text/javascript" src="/printrxcard/js/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript" src="/printrxcard/js/jQuery.print.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		
		$('div#mail_success').click(function(){
			$('div#mail_success').hide();
		});
		$('div#mail_error').click(function(){
			$('div#mail_error').hide();
		});
		
	});

	//print any html element
	function printElement(elem) { 
        $.print("#"+elem);
 	}
 	
 	function mailcard(id){
	 	$('#pleaseWaitDialog').modal('show');
	 	$.ajax({
		 	type: 'POST',
		 	url: 'mailcard.php',
		 	data: {pid:id},
		 	success: function(data){
			 	$('#pleaseWaitDialog').modal('hide');
			 	if(data.indexOf('success') != -1){
				 	$('div#mail_error').hide();
				 	$('div#mail_success').html('<center>Your new card was emailed to your address successfully!</center>');
				 	$('div#mail_success').show();
			 	}else{
				 	$('div#mail_success').hide();
				 	$('div#mail_error').html(data);
				 	$('div#mail_error').show();
			 	}
		 	}
	 	});
	 	return false;
 	}

</script>


<div class="container">
	<div class="row">
		<div id="mail_success" class="alert alert-success alert-dismissible" role="alert" style="display: none;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>
		<div id="mail_error" class="alert alert-danger" style="width: 60%; margin:0 auto; display: none;">
		</div>
	</div>
	<div class="row" style="width: 930px;">
		<?php
			$id = $_GET['pid'];
			$html = null;
			if($id > 0){
				$query = mysql_query("SELECT * FROM patients WHERE id = {$id}");
				if($row = mysql_fetch_array($query)){
					$full_name = $row['first_name'] . ' ' . $row['last_name'];
					$query = mysql_query("SELECT * FROM cards WHERE id_patient = {$id}");
					if($row = mysql_fetch_array($query)){
						$card_file = $row['card'];
						$htmlFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/cards/card.html";
						$html = file_get_contents($htmlFileLocation); 
						$html = str_replace("{full_name}", "<fotn style='font-weight:normal'>".$full_name."</font>", $html); //ful_name 
						$html = str_replace("{card_id}", "<fotn style='font-weight:normal'>".$row['card_id']."</font>", $html); //card_id
						$html = str_replace("{card_bin}", "<fotn style='font-weight:normal'>XXXXXX</font>", $html); //card_bin
						$html = str_replace("{group_number}", "<fotn style='font-weight:normal'>XXXXXXXXX</font>", $html); //group_number
						$html = str_replace("{pharmacy_help}", "<fotn style='font-weight:normal'>"."(877) 459-8474"."</font>", $html); //pharmacy_help	
					}
					echo $html; ?>
					<p></p>
					<div style="text-align: center; width: 875px; margin: 5px auto;">
						<a class="btn btn-primary" href="javascript:void(0);" onclick="printElement('printContent');">PRINT CARD</a>&nbsp;
						<a class="btn btn-primary" href="javascript:void(0);" onclick="mailcard('<?php echo $id?>')">EMAIL CARD</a>&nbsp;
						<a class="btn btn-primary" href="download.php?f=<?php echo $card_file?>">SAVE TO PDF</a>&nbsp;
					</div>
	<?php		}
			}
		?>
	</div>
	<div class="row" style="width: 930px;">
		<center><h2>Questions? Call us at XXX-XXX-XXXX</h2></center>
		<h2>Instructions:</h2>
		<p style="font-size: 12px;">Print and take this card to your nearest pharmacy and start saving now!</p>
		<h2>Frequently Asked Questions</h2>
		<p style="margin-bottom: 60px;"></p>
		<h2>What if my pharmacy cannot process this discount card?</h2>
		<p style="font-size: 12px;">If your pharmacy is unable or unwilling to process your discount card, please call XXX-XXX-XXXX. Most issues can be resolved quickly.</p>
		<p></p>
		<h2>Can I use the discount card with my health insurance?</h2>
		<p style="font-size: 12px;">This discount card price may be lower than your health insurance co-pay, it cannot be used to lower your co-pay. Ask your pharmacist to help you find the best possible price.</p>
	</div>
</div>
<?php include('footer.php'); ?>