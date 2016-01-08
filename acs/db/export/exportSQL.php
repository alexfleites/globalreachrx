<?php
/* include the ACS class page */
require_once("../../classes/ACS.php");

/******* Code For reading the sql format and insert data in database ********/

/* Step 1: create object of the ACS class */

$ACS=new ACS();
//get all table name form database
$tables=$ACS->getDBTables();
if(isset($_POST['import']))
{
	$sql=$_POST['sql'];
	// save the file on Specific location or display in browser (browser or save)
	$ACS->fileOutputMode=$_POST['browserMode'];
	
	//set tablename of the database
	$ACS->dbTableName=$_POST['dbTable'];
	
	//set columns of the database table name
	$ACS->columns=$_POST['column_name'];
	
	// set the output path where file want to save converted file format
	$outputFile=$_POST['outputPath'];
	/* Step 3: call the convert method to reading the sql query and inserting into database*/			
	$ACS->convert("sql","db",$sql,$outputFile);
	
	if(!isset($ACS->error))
	{
		$message="<div class='success'>Operation done successfully</div>";
	}
	else
	{
		$message="<div class='error'>There is error in operation. Please check error message: ".$ACS->error."</div>";	
	}
	
	/*Debug Operations - Uncomment below code lines to debug values */
	/*echo $ACS->error; //To display any error occured
	echo $ACS->messages; //It displays various messages at various points to check where code breaks
	print_r($ACS->inputDataArray);// To print the array of data generated after reading the csv file
	print_r($ACS->formattedDataArray);// To print the formatted array of data generated by code before final operation*/
	
}
require_once("../../header.php");
?>
<h4>DB Generate From SQL</h4><hr />
<div class="from">
  <?php if(isset($message)) echo $message; ?>
  <form method="post" enctype="multipart/form-data">
    <div class="formRow">
      <div class="formLabel">Select Table</div>
      <div class="formField">
        <select name="dbTable" class="imported_table" onchange="show()">
          <option>--select--</option><?php foreach($tables as $table) { ?>
          <option value="<?php echo $table;?>"><?php echo $table;?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div id="hiddenContent">
      <div style="height:95px">
        <div class="formLabel">Select Coulmns</div>
        <div class="formField result-table"></div>
      </div>
    <div class="formRow" style="height:180px">
      <div class="formLabel">Sql Query</div>
      <div class="formField">
        <textarea name="sql" id="query" style="height:150px; width:350px;" required="required"></textarea>
      </div>
    </div>
    <div class="formRow">
      <div class="formLabel"></div>
      <div class="formField submit">
        <input type="submit" id="save" name="import" value="Save"/>
        <input type="reset" name="reset" /></div>
      </div>
    </div>
  </form>
</div>
<div id="code1" class="code" style="visibility:hidden;">
<h5 class="head5">Code For DB</h5>
<pre>
<code data-language="php">&lt;?php
/* include the ACS class page */
   require_once("../../classes/ACS.php");

/* Step 1: create object of the ACS class */
   $ACS=new ACS();
   
/* Step 2: set values of required parameters */
//set tablename of the database
   $ACS->dbTableName=$_POST['dbTable'];

//set columns of the database table name
   $ACS->columns=$_POST['column_name'];

/* Step 3: call the convert method for reading the csv Format and inserting data in database  */
/* $sql                = Write sql query for input  */
/* $outputFileLocation = location of the output file (i.e. complete path of the output file)  */	
   $ACS->convert("sql","db",$sql,$outputFileLocation);
?&gt;    
</code>
</pre>
</div>