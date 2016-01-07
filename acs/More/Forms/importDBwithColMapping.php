<?php
/* include the ACS class page */
require_once("../../classes/ACS.php");
/******* Code For reading the CSV format and inserting data in database ******************/

/* Step 1: create object of the ACS class */
$ACS=new ACS();

$columns=array();

if(isset($_POST["uploadCsvSubmit"]))//first submission, get the csv file path
{   
	$ACS->replaceOlderFile=true;//replace old file if already exists there
	
	if($ACS->fileUpload($_FILES['uploadCsv'],$ACS->fileUploadPath,$ACS->maxSize,array("csv")))
	{  
		//get the path of the uploaded file	
		$path=$ACS->uploadedFileName;
	} 
	else
	{
		$message="<div class='error'>There is error in operation. Please check error message: ".$ACS->error."</div>";	
		$path=$_FILES['uploadCsv']['name'];
	}	
	$csvData=$ACS->csvToArray($path);
    $columns=$ACS->getDBTableColumns($_POST['dbTable']);
}
else if(isset($_POST["uploadCsvDB"]))//map columns and insert it into database
{
	$uploadFile=$_POST['uploadCsvPost'];
	$table=$_POST['dbTable'];
	$dbColumn=$_POST['dbColumn'];
	$col=array();
	for($columnCount=0;$columnCount<$dbColumn;$columnCount++)
	{
		$col[]=$_POST['dbColumn'.$columnCount];
	}
	//set tablename of the database
	$ACS->dbTableName=$table;

	//set columns of the database table name
	$ACS->columns=$col;
	
	// set whether first row is header or not (true or false)	
	$ACS->isFirstRowHeader=true;
	
	/* Step 3: call the convert method to reading the csv Format and inserting data in database */			
	$ACS->convert("csv","db",$uploadFile);
	
	if(!isset($ACS->error))
	{
		$message="<div class='success'>Operation done successfully</div>";
	}
	else
	{
		$message="<div class='error'>There is error in operation. Please check error message: ".$ACS->error."</div>";	
	}
}
$getTables=$ACS->getDBTables();
include("../../header.php");
include("../../leftsidebar.php");
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>

<h4>Convert CSV to DB With ColMapping</h4>
<hr />
<div class="from">
  <?php if(isset($message)) echo $message;?>
  <form method="post" enctype="multipart/form-data">
    <div class="formRow">
      <div class="formLabel">Select Table</div>
      <div class="formField">
        <select name="dbTable" class="imported_table">
          <option>--select--</option>
          <?php foreach($getTables as $table) { ?>
          <option value="<?php echo $table;?>" <?php if($_POST['dbTable']==$table) echo "selected=selected";?>><?php echo $table;?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="formRow">
      <div class="formLabel">Upload CSV</div>
      <div class="formField">
        <input type="file" name="uploadCsv" value="<?php echo $_POST['uploadCsv'];?>"/>
      </div>
    </div>
    <?php if(!$csvData) { ?>
    <div class="formRow">
      <div class="formLabel"></div>
      <div class="formField submit">
        <input type="submit" name="uploadCsvSubmit" value="submit"/>
      </div>
    </div>
    <?php } else {?>
    <div class="formRowTable">
      <div class="formLabel">Showing Top 3 Rows</div>
      <div class="formFieldTable">
        <table style="border:1px solid black; padding:2px;">
          <?php 
			$row=count($csvData);
			$col=count($csvData[0]);
			for($csvRow=0;$csvRow<4;$csvRow++) { ?>
          <tr style="border:1px solid black; padding:2px">
            <?php for($csvCol=0;$csvCol<$col;$csvCol++) { ?>
            <td style="border:1px solid black; padding:10px"><?php echo $csvData[$csvRow][$csvCol];?></td>
            <?php } ?>
          </tr>
          <?php } ?>
          <tr>
            <?php 
			for($selectCol=0;$selectCol<$col;$selectCol++) { ?>
            <td><select class="tbselect" name="dbColumn<?php echo $selectCol;?>">
                <?php foreach($columns as $colmn) { ?>
                <option><?php echo $colmn;?></option>
                <?php } ?>
              </select></td>
            <?php } ?>
          </tr>
        </table>
      </div>
    </div>
    <input type="hidden" name="uploadCsvPost" value="<?php echo  $path;?>" />
    <input name="dbColumn" type="hidden" value="<?php echo $col;?>" />
    <div class="formRow" style="margin-top:15px;">
      <div class="formLabel"></div>
      <div class="formField submit">
        <input type="submit" name="uploadCsvDB" value="save"/>
      </div>
    </div>
    <?php } ?>
  </form>
</div>
</div>
</body></html>