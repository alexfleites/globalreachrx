<?php
/* include the ACS class page */
require_once("../../classes/ACS.php");

/*******Code for reading file from xlsx file and writing it into csv file format******************/

/* Step 1: create object of the ACS class */
$ACS=new ACS();

if(isset($_POST['import']))
{
	/* Step 2: set values of required parameters */
	//set tablename of the database
	$ACS->dbTableName="student";

	//set 2 dimensional associative array
	$data=array(array("studentNo"=>$_POST["studentNo"], "title"=>$_POST["title"], "firstName"=>$_POST["firstName"], "lastName"=>$_POST["lastName"], "gender"=>$_POST["gender"], "address"=>$_POST["address"], "mobileNumber"=>$_POST["mobileNo"], "homeNumber"=>$_POST["homeNo"], 
	"email"=>$_POST["email"], "institute"=>$_POST["institute"], "grade"=>$_POST["grade"]));
	
	if($ACS->arrayToDB($data))
	{
		$message="<div class='success'>Operation done successfully</div>";
	}
	else
	{
		$message="<div class='error'>There is error in operation. Please check error message: ".$ACS->error."</div>";	
	}
	
	

}
require_once("../../header.php");
?>
<h4>Insert records to database</h4><hr />
<div class="from">
  <?php if(isset($message)) echo $message; ?>
  <form method="post" enctype="multipart/form-data">
    <div class="formRow">
      <div class="formLabel">Student No</div>
      <div class="formField">
        <input type="text" name="studentNo" id="studentNo"  required="required"/>
      </div>
    </div>
    <div class="formRow">
      <div class="formLabel">Title</div>
      <div class="formField">
        <input type="text" name="title" id="title"  required="required"/>
      </div>
    </div>
    <div class="formRow">
      <div class="formLabel">First Name</div>
      <div class="formField">
        <input type="text" name="firstName" id="firstName"  required="required"/>
      </div>
    </div>
    <div class="formRow">
      <div class="formLabel">Last Name</div>
      <div class="formField">
        <input type="text" name="lastName" id="lastName"  required="required"/>
      </div>
    </div>
    <div class="formRow">
      <div class="formLabel">Gender</div>
      <div class="formField">
       	<input type="radio" name="gender" value="Male"> Male
        <input type="radio" name="gender" value="female"> Female
      </div>
    </div>
     <div class="formRow">
      <div class="formLabel">Home No</div>
      <div class="formField">
        <input type="text" name="homeNo" id="homeNo"  required="required"/>
      </div>
    </div>
    <div class="formRow">
      <div class="formLabel">Address</div>
      <div class="formField">
        <input type="text" name="address" id="address"  required="required"/>
      </div>
    </div>
    <div class="formRow">
      <div class="formLabel">Mobile No</div>
      <div class="formField">
        <input type="text" name="mobileNo" id="mobileNo"  required="required"/>
      </div>
    </div>   
    <div class="formRow">
      <div class="formLabel">Email</div>
      <div class="formField">
        <input type="text" name="email" id="email"  required="required"/>
      </div>
    </div>
    <div class="formRow">
      <div class="formLabel">Institute</div>
      <div class="formField">
        <input type="text" name="institute" id="institute"  required="required"/>
      </div>
    </div>
     <div class="formRow">
      <div class="formLabel">Grade</div>
      <div class="formField">
      	<select name="grade" id="grade">
        	<option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="F">F</option>
        </select>
      </div>
    </div>
    <div class="formRow">
      <div class="formLabel"></div>
      <div class="formField submit">
        <input type="submit" id="save" name="import" value="Save"/>
        <input type="reset" name="reset" />
      </div>
    </div>
  </form>
</div>
<div class="code">
<h5 class="head5">Code For Database</h5>
<pre>
<code data-language="php">&lt;?php
/* include the ACS class page */
   require_once("../../classes/ACS.php");

/* Step 1: create object of the ACS class */
   $ACS=new ACS();
   
/* Step 2: set values of required parameters */   
//set tablename of the database
	$ACS->dbTableName="student";

//set 2 dimensional associative array
$data=array(array("studentNo"=>$_POST["studentNo"], "title"=>$_POST["title"], "firstName"=>$_POST["firstName"], "lastName"=>$_POST["lastName"], "gender"=>$_POST["gender"], "address"=>$_POST["address"], "mobileNumber"=>$_POST["mobileNo"], "homeNumber"=>$_POST["homeNo"], 
"email"=>$_POST["email"], "institute"=>$_POST["institute"], "grade"=>$_POST["grade"]));

$ACS->arrayToDB($data); //insert array to database

?&gt;    
</code>
</pre>
</div>