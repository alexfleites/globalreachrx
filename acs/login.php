<?php $basePath="http://".$_SERVER['SERVER_NAME']."/AwesomeConversionScript/"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Awesome Conversion Script</title>
<link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo $basePath;?>css/bootstrap.min.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo $basePath;?>css/bootstrap-responsive.min.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo $basePath;?>css/style.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo $basePath;?>css/styleButton.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo $basePath;?>css/styletable.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo $basePath;?>themes/obsidian.css" type="text/css" media="screen" title="default" />
<script src="<?php echo $basePath;?>js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="<?php echo $basePath;?>js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $basePath;?>js/ajax.js" type="text/javascript"></script>
<script src="<?php echo $basePath;?>js/common.js" type="text/javascript"></script>
<script src="<?php echo $basePath;?>js/validation.js" type="text/javascript"></script>
<script src="<?php echo $basePath;?>js/rainbow.min.js" type="text/javascript"></script>
<script src="<?php echo $basePath;?>language/generic.js" type="text/javascript"></script>
<script src="<?php echo $basePath;?>language/php.js" type="text/javascript"></script>
</head>
<body>
<div id="main">
<header>
  <h1><strong>Awesome Conversion Script</strong></h1>
  <h2>Import/Export <strong>CSV, Excel, PDF, Database , Array, HTML, SQL, XML</strong> </h2>
</header>
<div id="main-container">
<div id="login" style="margin-top:85px;">
  <form method="post" action="checklogin.php">
    <div class="formRow rowmargin">
      <div class="formLabel" style="margin-right:25px; margin-left:50px;">Username</div>
      <div class="formField">
        <input type="text" name="username" />
      </div>
    </div>
    <div class="formRow rowmargin">
      <div class="formLabel" style="margin-right:25px; margin-left:50px;">Password</div>
      <div class="formField">
        <input type="password" name="password" />
      </div>
    </div>
    <div class="formRow rowmargin">
      <div class="formLabel"></div>
      <div class="formField submit" style="margin-left:30px;">
        <input type="submit" id="submit" name="loginsubmit" value="Login"/>
      </div>
    </div>
  </form>
</div>
