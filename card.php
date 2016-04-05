<?php

	$conn = mysql_connect("localhost", "lobalre3_printrx", "TI46Tl8@EP0{") or die("Can not connect to the server");
	$db = mysql_select_db("lobalre3_printrxcard") or die("Can not connect to the database");
	
	include($_SERVER['DOCUMENT_ROOT'] . "/printrxcard/functions.php");
	
	$site = $_REQUEST['site']; //get from which site comes from
	$id = $_REQUEST['pid'];

?>

<link href="css/form.css" rel="stylesheet">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">


<!-- Custom styles for this template -->
<link href="css/grid.css" rel="stylesheet">


<!-- Font core CSS -->
<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<!--[if IE 7]>
	<link rel="stylesheet" href="/printrxcard/css/font-awesome-ie7.min.css">
<![endif]-->


<script type="text/javascript" src="js/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/jQuery.print.js"></script>
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
        $('#'+elem).print({
	       styleshhet: 'form/css/style.css'
        });
 	}
 	
 	function mailcard(id){
	 	$('#pleaseWaitDialog').modal('show');
	 	$.ajax({
		 	type: 'GET',
		 	url: 'mailcard.php',
		 	data: {pid:id,site:'<?php echo $site?>'},
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

 	function print_card(){
 		window.open('printcard.php?pid=<?php echo $id?>&site=<?php echo $site?>', 'Print', 'width=800,height=700');
 	}

 	function download_card(card_file){
	 	window.location.replace("download.php?f=<?php echo $_SERVER['DOCUMENT_ROOT']?>/printrxcards/cards/" + card_file);
 	}

</script>

<style>

	a:link, a:active, a:hover{
		color: white;
		text-decoration: none;
	}

</style>

<div class="container">
	<div class="row">
		<div id="mail_success" class="alert alert-success alert-dismissible" role="alert" style="display: none;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>
		<div id="mail_error" class="alert alert-danger" style="width: 60%; margin:0 auto; display: none;">
		</div>
	</div>
	<?php if(!isMobile()){?>
	<div class="row" style="margin-bottom: 10px;">
		<h2>Print Your Discount Card Now</h2>
		<p style="font-size:16px; color: gray;">
			Bellow is your discount pharmacy card. Save up to 75% on hundreds of prescription drugs.
			Simply print this page immediately, and bring it to your favorite pharmacist and start saving!
		</p>
	</div>
	<?php } //end is Mobile ?>
	<div class="row" style="margin-bottom: 0px;">
		<?php
			$html = null;
			if($id > 0){
				$query = mysql_query("SELECT * FROM patients WHERE id = {$id}");
				if($row = mysql_fetch_array($query)){
					$full_name = $row['first_name'] . ' ' . $row['last_name'];
					$query = mysql_query("SELECT * FROM cards WHERE id_patient = {$id}");
					if($row = mysql_fetch_array($query)){
						$card_file = $row['card'];
						if($site == 'globalreachhealth'){
							$htmlFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/GlobalReach.html";
						}else{
							$htmlFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/printrxcard/card.html";
						}
						$html = file_get_contents($htmlFileLocation); 
						$html = fill_card($html, $site);
						$html = str_replace("{full_name}", $full_name, $html); //ful_name 
					}
					echo $html;
					?>
					<div class="clear"></div>
					<div class="card-buttons" style="margin-top: 30px;">
						<center><a class="print-btn" onmouseover="return false;" href="javascript:print_card();" style="margin-bottom: 20px; text-decoration: none;">Print</a>
						<a class="email-btn" onmouseover="return false;" onclick="mailcard('<?php echo $id?>');" style="margin-bottom: 20px; text-decoration: none;">Email</a>
						<a class="save-pdf-btn" onmouseover="return false;" href="downloadcard.php?pid=<?php echo $id?>&site=<?php echo $site?>" style="margin-bottom: 20px; text-decoration: none;">Save to pdf </a></center>
					</div>
	<?php		}
			}
		?>
	</div>
	<?php include('card_footer.php'); ?>
</div>
<?php include('footer.php'); ?>