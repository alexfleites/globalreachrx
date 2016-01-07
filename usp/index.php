<?php
/*
	HEZECOM PHP CODE GENERATOR ULTIMATE (UltimateSpeed)
	Author: Hezecom Technologies (http://hezecom.com) info@hezecom.net
	COPYRIGHT 2015 ALL RIGHTS RESERVED
	FILE NAME index.php 
	
	You must have purchased a valid license from CodeCanyon.com in order to have 
	access this file.

	You may only use this file according to the respective licensing terms 
	you agreed to when purchasing this item.
*/

	include('lib/config.php');
	include('lib/functions.php');
	include("lib/class_dbcon.php");
	$db=DB::getInstance();
	$fom="<?php htmlspecialchars(";$fom.="$";$fom.="_SERVER['PHP_SELF']);?>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hezecom PHP Code Generator Pro</title>
<link rel="stylesheet" href="CodeOutput/public/themes/default/css/bootstrap.min.css">
<link rel="stylesheet" href="CodeOutput/public/themes/default/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/admin.css">
</head>

<body>


	<?php if(isset($_GET['cleared'])){?>
    <div class="heze-notify progress-bar-success"><p>All Generated Codes Were Deleted Successfully</p></div>
    
	<?php } elseif(isset($_GET['do'])){?>
	<div class="heze-notify progress-bar-success"><p>Database Settings Updated Successfully</p></div>
    <?php }?>
  
    <div id="hezewraper">
      <div class="navbar navbar-static-top navbar-fixed-top navbar-inverse">
          <button type="button" class="navbar-toggle pull-left" data-toggle="collapse" id="showLeft" style="border:0;">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
      <a class="navbar-brand" href="index.php" style="color:#FFF;"> Hezecom PHP Code Generator Pro</a>
          <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav pull-right">
      <li><a href="index.php" style="color:#FFF;">Generator</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#FFF;">View Code Output <b class="caret"></b></a>
        <ul class="dropdown-menu" style="background:#689CD7;">
          <li><a href="CodeOutput/index.php" target="_blank">Admin Login</a></li>
        </ul>
      </li>
    </ul>
   </div><!--/.nav-collapse -->
</div>
      
    
     
<div id="hezewraper">    
<!-- BODY CONTENTS -->
<div class="heze-container">
<div class="container">

<div class="headbread">
 <div class="col-12">
  <h3><i class="fa fa-dashboard"></i> Application Setup Area</h3>
  </div>
</div>
<div class="row"> 
<div class="col-md-6">
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> General Settings</h3></div>
  <div class="panel-body">
   <p>
    <?php if(isset($_GET['do'])){
		if(UPLOAD_TYPE=='multiplefile' or UPLOAD_TYPE=='multipleimage'){
		$sql =" CREATE TABLE IF NOT EXISTS `hfiles` (
	  `fid` int(11) NOT NULL AUTO_INCREMENT,
	  `relateid` int(11) DEFAULT NULL,
	  `gfile` varchar(50) DEFAULT NULL,
	  `gdate` date DEFAULT NULL,
	   PRIMARY KEY (`fid`)
	   ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
	   ";
		$db->exec($sql); 
		}
		}?>
        <form action="lib/settings.php?setn=yes" method="post" name="setting" id="setting" role="codeform">
        
        <div class="row">
        
        <div class="col-md-6">
        <div class="form-group">
          <label class="control-label sr-only" for="host">HOST</label>
          <div class="input-group">
          <div class="input-group-addon left">HOST</div>
          <input id="host" name="host" class="form-control input-sm" type="text" value="<?php echo LOCALHOST;?>" required />
          </div>
        </div>
        </div>
        
        <div class="col-md-6">
        <div class="form-group">
          <label class="control-label sr-only" for="dbname">DATABASE NAME</label>
          <div class="input-group">
          <div class="input-group-addon left">DATABASE NAME</div>
          <input id="dbname" name="dbname" class="form-control input-sm" type="text" value="<?php echo DB_NAME;?>" />
        </div>
        </div>
        </div>
        </div><!--/row-->

		<div class="row">
        <div class="col-md-6">
        <div class="form-group">
        <label class="control-label sr-only" for="username">USERNAME</label>
        <div class="input-group">
        <div class="input-group-addon left">USERNAME</div>
        <input id="username" class="form-control input-sm" name="username" placeholder="username" type="text" value="<?php echo DB_USERNAME;?>" />
        </div>
        </div>
        </div>
        
        <div class="col-md-6">
        <div class="form-group">
          <label class="control-label sr-only" for="password">PASSWORD</label>
          <div class="input-group">
          <div class="input-group-addon left">PASSWORD</div>
          <input id="password" name="password" class="form-control input-sm" type="text" value="<?php echo DB_PASSWORD;?>" />
          </div>
          </div>
          </div>
          </div><!--/row-->

          <div class="form-group">
          <label class="control-labe sr-only" for="dbtype">CONNECTION TYPE</label>
          <div class="input-group">
          <div class="input-group-addon left">CONNECTION TYPE</div>
          <input name="dbtype" type="text" class="form-control input-sm" id="dbtype" value="mysql" readonly />
          </div>
          </div>
          
          <div class="form-group">
          <label class="control-label sr-only" for="ptitle">PROJECT TITLE</label>
          <div class="input-group">
          <div class="input-group-addon left">PROJECT TITLE</div>
          <input id="ptitle" name="ptitle" class="form-control input-sm" type="text" value="<?php echo H_TITLE;?>" />
          </div>
          </div>
          
        <div class="form-group">
        <label class="control-label sr-only" for="pgtype">PAGINATION TYPE</label>
        <div class="input-group">
        <div class="input-group-addon left">PAGINATION TYPE</div>
        <select name="pgtype" id="pgtype" class="form-control input-sm">
        <option value="<?php echo PAGINATION_TYPE;?>"><?php echo PAGINATION_TYPE;?></option>
        <option value="Normal">Normal</option>
        </select>
        </div>
        <span class="help-block"><small><em>These can also be changed at <strong>config/config.php</strong></em></small></span>
        </div>
        
        <div class="form-group">
        <label class="control-label sr-only" for="formpro">FORMS PROCESSING</label>
        <div class="input-group">
        <div class="input-group-addon left">FORMS PROCESSING</div>
        <select name="formpro" id="formpro" class="form-control input-sm">
        <option value="<?php echo FORMS_PROCESSING;?>"><?php echo FORMS_PROCESSING;?></option>
        <option value="Normal">Normal</option>
        <option value="Ajax">Ajax</option>
        </select>
        </div>
        </div>
        
         <div class="form-group">
        <label class="control-label sr-only" for="phpval">PHP FORMS VALIDATION</label>
        <div class="input-group">
        <div class="input-group-addon left">PHP FORMS VALIDATION</div>
        <select name="phpval" id="phpval" class="form-control input-sm">
        <option value="<?php echo PHP_VALIDATION;?>"><?php echo PHP_VALIDATION;?></option>
        <option value="Enable">Enable</option>
        <option value="Disable">Disable</option>
        </select>
        </div>
        </div>
        
        
          <div class="form-group">
          <label class="control-label sr-only" for="display">RECORDS DISPLAY PER ROW</label>
          <div class="input-group">
          <div class="input-group-addon left">RECORDS DISPLAY PER ROW</div>
          <input id="display" name="display" class="form-control input-sm" type="text" value="<?php echo VIEW_DISPLAY;?>" />
          </div>
          </div>
          
          <div class="form-group">
          <label class="control-label sr-only" for="recordsp">RECORDS TO DISPLAY PER PAGE</label>
          <div class="input-group">
          <div class="input-group-addon left">RECORDS TO DISPLAY PER PAGE</div>
          <input id="recordsp" name="recordsp" class="form-control input-sm" type="text" value="<?php echo RECORD_PER_PAGE;?>" />
          </div>
          </div>
        
        <div class="form-group">
        <label class="control-label sr-only" for="form_temp">FORM TEMPLATE</label>
        <div class="input-group">
        <div class="input-group-addon left">FORM TEMPLATE</div>
        <select name="form_temp" id="form_temp" class="form-control input-sm">
        <option value="<?php echo FORM_TEMPLATE;?>"><?php echo FORM_TEMPLATE;?></option>
        <option value="Normal">Normal</option>
        <option value="Grouped">Grouped</option>
        </select>
		</div>
        </div>
        
        <div class="form-group">
        <label class="control-label sr-only" for="form_style">FORM INPUTS STYLING</label>
        <div class="input-group">
        <div class="input-group-addon left">FORM INPUTS STYLING</div>
        <select name="form_style" id="form_style" class="form-control input-sm">
        <option value="<?php echo FORM_STYLE;?>"><?php if(FORM_STYLE=='styler') echo 'Gradient Background';else echo'Normal'?></option>
        <option value="">Normal</option>
        <option value="styler">Gradient Background</option>
        </select>
		</div>
        </div>
          
		<div class="form-group">
        <label class="control-label sr-only" for="jval">HTML5 VALIDATION</label>
        <div class="input-group">
        <div class="input-group-addon left">HTML5 VALIDATION</div>
        <select name="jval" id="jval" class="form-control input-sm">
        <option value="<?php echo JQUERY_VALIDATE;?>"><?php if(JQUERY_VALIDATE=='required') echo 'Enabled';else echo'Disabbled'?></option>
        <option value="required">Enabled</option>
        <option value="">Disabbled</option>
        </select>
		</div>
        </div>
        
        <div class="form-group">
        <label class="control-label sr-only" for="ctype">CLASS TYPE</label>
        <div class="input-group">
        <div class="input-group-addon left">CLASS TYPE</div>
        <select name="ctype" id="ctype" class="form-control input-sm">
        <option value="<?php echo CLASS_TYPE;?>"><?php if(CLASS_TYPE=='default') echo 'Default Constructor Class';else echo'Get and Set Class'?></option>
        <option value="default">Default Construct Class</option>
        <option value="getset">Get and Set Class</option>
        </select>
		</div>
        </div>
        
         <div class="form-group">
        <label class="control-label sr-only" for="uploadtype">UPLOAD HANDLING TYPE</label>
        <div class="input-group">
        <div class="input-group-addon left">UPLOAD HANDLING TYPE</div>
        <select name="uploadtype" id="uploadtype" class="form-control input-sm">
        <option value="<?php echo UPLOAD_TYPE;?>"><?php if(UPLOAD_TYPE=='imgonly') echo 'Image Upload and Resize';elseif(UPLOAD_TYPE=='fileonly') echo'File and Image Upload'; elseif(UPLOAD_TYPE=='multipleimage') echo 'Multiple Image Upload and Resize'; elseif(UPLOAD_TYPE=='multiplefile') echo 'Multiple File Upload'?></option>
        <option value="fileonly">File and Image Upload</option>
        <option value="imgonly">Image Upload and Resize</option>
        <option value="multipleimage">Multiple Image Upload and Resize</option>
        <option value="multiplefile">Multiple File Upload</option>
        </select></div>
         <span class="help-block"><small><em>Only detect file upload when field type is set to VARBINARY in your Database.</em></small></span>
		</div>
        
        
         <div class="form-group">
          <label class="control-label sr-only" for="adminuser">IMAGE SIZE </label>
         
          <div class="input-group-addon left">IMAGE SIZE</div> 
          <div class="row">
  <div class="col-lg-4">
  <div class="input-group">
        <div class="input-group-addon left">BIG</div>
   <input id="bigsize" name="bigsize" class="form-control input-sm" type="text" value="<?php echo BIG_IMAGE_WIDTH;?>" />
   </div>
   </div>
   
   <div class="col-lg-4">
   <div class="input-group">
   <div class="input-group-addon left">THUMB</div>
   <input id="thumbsize" name="thumbsize" class="form-control  input-sm" type="text" value="<?php echo THUMB_IMAGE_WIDTH;?>" />
          </div>
          </div>
          </div>
   </div>
          
        <div class="form-group">
        <label class="control-label sr-only" for="editortype">TEXT AREA HANDLING</label>
        <div class="input-group">
        <div class="input-group-addon left">TEXT AREA HANDLING</div>
        <select name="editortype" id="editortype" class="form-control input-sm">
        <option value="<?php echo EDITOR_TYPE;?>"><?php if(EDITOR_TYPE=='tinymce') echo 'TinyMCE Text Editor';elseif(EDITOR_TYPE=='html5') echo 'HTML5 Text Editor';else echo'Normal Text Area'?></option>
        <option value="html5">HTML5 Text Editor</option>
        <option value="tinymce">TinyMCE Text Editor</option>
        <option value="normal_txt">Normal Text Area</option>
        </select>
		</div>
        </div>

          
           <div class="form-group">
          <label class="control-label sr-only" for="adminuser">DEFAULT LOGIN DETAILS </label>
         
          <div class="input-group-addon left">DEFAULT LOGIN DETAILS</div> 
          <div class="row">
  <div class="col-lg-6">
  <div class="input-group">
        <div class="input-group-addon left">USERNAME </div>
   <input name="adminuser" type="text" class="form-control input-sm" id="adminuser" value="<?php echo ADMIN_USERNAME;?>" readonly />
   </div>
   </div>
   
   <div class="col-lg-6">
   <div class="input-group">
   <div class="input-group-addon left">PASSWORD</div>
   <input name="adminpwd" type="text" class="form-control  input-sm" id="adminpwd" value="<?php echo ADMIN_PASSWORD;?>" readonly />
          </div>
          </div>
          </div>
   </div>
          
           <div class="form-group">
          <label class="control-label sr-only" for="system_access">USERS ACCESS SETTINGS </label>
          <div class="input-group-addon left">USERS ACCESS SETTINGS</div> 
          <div class="row">
  <div class="col-lg-6">
  <div class="input-group">
        <div class="input-group-addon left">TABLE NAME</div>
   <input id="system_access" name="system_access" class="form-control input-sm" type="text" value="<?php echo H_SYSTEM_ACCESS;?>" />
   </div>
   </div>
   
   <div class="col-lg-6">
   <div class="input-group">
   <div class="input-group-addon left">SESSION NAME</div>
   <input id="user_session" name="user_session" class="form-control  input-sm" type="text" value="<?php echo H_USER_SESSION;?>" />
          </div>
          </div>
          </div>
   </div>
          
		<div class="form-group">
          <input name="button" type="submit" class="btn btn-info btn-lg" value="Update Settings" id="button" />
        </div>
      </form>
      
   </p>
  </div>
</div>
 </div><!--/col-md-6-->
 
 <div class="col-md-6">
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Table(s) for database <?php echo DB_NAME;?></h3></div>
  <div class="panel-body">
   <p>
    <?php
	$sql = "SHOW TABLES";
	$n='';
    foreach ($db->query($sql) as $row)
     {
	if($row[0]!=H_SYSTEM_ACCESS){
	if($row[0]!=UPLOAD_TABLE){
	if(isset($n)) $n=$n++;
	?>
    <form action="index.php" method="post" name="form<?php echo $n;?>" id="form<?php echo $n;?>" class="form-horizontal">
    <?php     
	print'
	<span class="btn btn-default btn-sm"><input name="tablename" type="checkbox" value="'.$row[0].'"  checked="CHECKED" /></span>
	<span class="btn btn-primary btn-sm">'.$row[0].'</span> ';
	?>
    <input type="hidden" name="classname" value="<?php echo $row[0];?>" />
	<?php
    $sql = "SHOW COLUMNS FROM ".$row[0]." WHERE Extra='AUTO_INCREMENT'";
	 foreach ($db->query($sql) as $row)
        {	
	$colname=$row[0];
	?>
    <input type="hidden" name="keyname" value="<?php echo $colname;?>" />
    <?php //}?>
    <input name="faction" type="hidden" id="faction" value="<?php echo ($fom);?>">
    <input type="hidden" name="fbutton" value="Submit" id="fbutton" />
	<input type="hidden" name="dform" value="dform" />
    
     </form>
     <?php }}}}
	 include('lib/Generator.php');
	?> 
  <br><br>   
 <input type="submit" id="submit_all" class="btn btn-info btn-lg " value="Generate Codes For Selected Table(s)"  />
  
 <button  id="loader" class="btn btn-success"><i class="fa fa-refresh fa-spin fa-2x"></i> Processing results please wait...</button>
 <br><br>
 <small>Please wait a while after you click on the Generate button. You will get a success notification  message.</small>
		</p>
        </div></div>
        
       
        <a href="lib/settings.php?appclear=clear" class="btn btn-danger" >Clear Generated Code</a>
       
   </p>
  </div>
</div>
 </div><!--/col-md-6-->
 </div>
 
  </div><!--contaner-->    
 </div><!--/heze-container-->       
</div><!--hezewraper-->

<?php if(get('scode')==1){?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Application Creation Success:</h4>
      </div>
      <div class="modal-body">
        - All required codes where generated successfully.<br>
        - Admin creation successful.<br><br>
        <a href='CodeOutput/admin.php' target='_blank' class='btn btn-info'>Preview App</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Go Back to app maker</button>
        
      </div>
    </div>
  </div>
</div>
<!--/end modal-->
<?php }?>

 <div id="footer" class="navbar-fixed-bottom">
      <div class="container">
        <p class="text-muted credit">&copy; 2015 <a href="http://hezecom.com">Hezecom Technologies</a></p>
      </div>
    </div>
    
    
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.box.js"></script>
<script src="assets/js/hezecom.custom.js"></script>

  </body>
  </html>
