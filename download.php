<?
	
	if(isset($_REQUEST['F'])){
		$file = $_REQUEST["f"];
	}else{
		//get file by patient_id
		
		$conn = mysql_connect("localhost", "lobalre3_printrx", "TI46Tl8@EP0{") or die("Can not connect to the server");
		$db = mysql_select_db("lobalre3_printrxcard") or die("Can not connect to the database");
		
		$id = $_REQUEST['pid'];
		if($id > 0){
			$query = mysql_query("SELECT * FROM patients WHERE id = {$id}");
			if($row = mysql_fetch_array($query)){
				$query = mysql_query("SELECT * FROM cards WHERE id_patient = {$id}");
				if($row = mysql_fetch_array($query)){
					$file = $row['card'];
				}
			}
		}
	}
	//echo $file; die;
	
	//do download
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private",false);
	header("Content-type: application/force-download");
	header("Content-Disposition: attachment; filename=\"".basename($file)."\";" );
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".filesize($file));
	readfile("$file");
?>