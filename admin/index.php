<?php
	session_start();
	include('config/config.php');
	include('language/eng.php');
	include('libraries/functions.php');
	include_once('libraries/class_dbcon.php');
	include_once('libraries/upload_class.php');
	include_once('libraries/system_users.php');
	$haccess = new admin_users_model();
	$acc=$haccess->UserAccess();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo H_TITLE;?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo H_THEME;?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo H_THEME;?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo H_THEME;?>/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo H_THEME;?>/css/footable.core.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo H_THEME;?>/css/skins.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo H_THEME;?>/css/jquery.lightbox.min.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="<?php echo H_THEME;?>/css/datepicker.css">
    <link href="<?php echo H_THEME;?>/css/chosen.min.css" rel="stylesheet">
<!--     <link href="<?php echo H_THEME;?>/css/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?php echo H_THEME;?>/css/admin.css" rel="stylesheet">
    <script src="<?php echo H_THEME;?>/js/modernizr.custom.js"></script>
<!--     <script type="text/javascript" src="libraries/tinymce/js/tinymce/tinymce.min.js"></script> -->
    <script src="<?php echo H_THEME;?>/js/jQuery-2.1.3.min.js"></script>

  </head>
  <?php 
  if(get('pg')=='login'){
	  include('libraries/views/admin/login.php');
  }else{
	  ?>
  <body class="skin-blue">
  <?php
  		if(get('msg')=='add'){success_msg(LANG_SUCCESS_ADD);}
		elseif(get('msg')=='update'){success_msg(LANG_SUCCESS_UPDATE);}
		elseif(get('msg')=='delete'){success_msg(LANG_SUCCESS_DELETE);}
		elseif(get('msg')=='truncate'){success_msg(LANG_SUCCESS_TRUNCATE);}
		elseif(get('msg')=='error'){error_msg(LANG_ERROR_MSG);}
		elseif(get('msg')=='backup'){success_msg(LANG_BACKUP_CREATED);}
		elseif(get('msg')=='emaillist'){success_msg(LANG_SUCCESS_EMAIL_LIST);}
		elseif(get('dbrestore')!=''){success_msg(LANG_BACKUP_RESTORED);}
		elseif(get('dbfile')!=''){success_msg(LANG_BACKUP_DELETED);}
		?>
    <div class="wrapper">
      
      <header class="main-header">
        <a href="<?php echo H_ADMIN;?>" class="logo"><b>Admin Portal</b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
               
               
            
              <!-- User Account-->
              <?php  if(isset($_SESSION[H_USER_SESSION])){?>
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <?php if(is_file(UPLOAD_FOLDER.$acc->user_avarta)){?>
      <img src='<?php echo THUMB_FOLDER.$acc->user_avarta;?>' class="user-image"  alt="User Image"/>
	  <?php }else{?>
      <img src="<?php echo NO_IMAGE;?>" class="user-image" alt="User Image" />
       <?php }?>
                  <span class="hidden-xs"><?php echo LANG_LOGIN_IN_AS.'  '.$_SESSION[H_USER_SESSION];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                  <?php if(is_file(UPLOAD_FOLDER.$acc->user_avarta)){?>
	  <img src='<?php echo THUMB_FOLDER.$acc->user_avarta;?>' class="img-circle" alt="User Image"  />
	  <?php }else{?>
       <img src="<?php echo NO_IMAGE;?>" class="img-circle" alt="User Image" />
       <?php }?>
                    <p>
                       
                       <?php echo $acc->name;?>
                       
                      <small>today <?php echo date('d/m/Y');?></small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo H_ADMIN;?>&view=hsys_users2&do=details" class="btn btn-success btn-flat"><?php echo LANG_PROFILE;?></a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo H_ADMIN;?>&view=hsys_users&do=logout" class="btn btn-success btn-flat"><?php echo LANG_LOGOUT;?></a>
                    </div>
                  </li>
                </ul>
              </li>
              <?php }?>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
            <?php if(is_file(UPLOAD_FOLDER.$acc->user_avarta)){?>
	  <img src='<?php echo THUMB_FOLDER.$acc->user_avarta;?>' class="img-circle" alt="User Image" />
	  <?php }else{?>
       <img src="<?php echo NO_IMAGE;?>" class="img-circle" alt="User Image" />
       <?php }?>
              
            </div>
            <div class="pull-left info">
              <p></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <hr style="border-color:#666;">
         
          <!-- sidebar menu-->
          <ul class="sidebar-menu">
            
             <?php if($acc->user_position==1){?>
		
        <li><a href="<?php echo H_ADMIN;?>&view=hsys_users&do=viewall">
         <i class="fa fa-user"></i> <span><?php echo LANG_SYSTEM_USERS;?></span> <small class="label pull-right bg-green">sys</small>
        </a></li>
        <?php }?>
            
            <?php include(APP_FOLDER.'/views/admin/menu.php');?>
            
            <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>more</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.html"><i class="fa fa-circle-o"></i> Menu 1</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o"></i> Menu 2</a></li>
              </ul>
            </li> -->
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Right side column-->
      <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
          <h1>
            <img src="images/logo.png" width="15%"><br>
            <!--<?php echo H_TITLE;?> <em>Pro</em> 
            <small>Version 3.0</small> -->
          </h1>
          <ol class="breadcrumb">
            <!--<li><a href="<?php echo H_ADMIN;?>" ><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Tables</a></li>-->
          </ol>
        </section>

               <!-- Main content -->
        <section class="content">
         <?php 
          $haccess->logged_in_protect(H_LOGIN);
          if(get('view')){
            include(APP_FOLDER.'/controllers/admin/main.php');
            include('libraries/controllers/system_users.php');
      		}else{
      		  send_to('index.php?pg=admin&view=patients&do=viewall&active=1'); ?>
		      <?php }?>
        <!-- /DESIGN AREA -->
        
        </section><!-- /.content -->
        
      </div><!-- /.content-wrapper -->
      <!-- <footer class="main-footer">
        <div class="pull-right hidden-xs">
          Pro Edition <b>v</b>  3.0
        </div>
        <strong>&copy; <?php echo date('Y')?> <a href="http://hezecom.com">Hezecom Technologies</a>.</strong> All rights reserved.
      </footer> -->
    </div><!-- ./wrapper -->
<?php }?>

    <script src="<?php echo H_THEME;?>/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo H_THEME;?>/js/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?php echo H_THEME;?>/js/footable.js" type="text/javascript"></script>
    <script src="<?php echo H_THEME;?>/js/jquery.lightbox.min.js" type="text/javascript"></script>
	<script src="<?php echo H_THEME;?>/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo H_THEME;?>/js/jquery.form.js"></script>
    <script src="<?php echo H_THEME;?>/js/chosen.jquery.min.js"></script>
    <script src="<?php echo H_THEME;?>/js/jquery.knob.js" type="text/javascript"></script>
<!--     <script src="<?php echo H_THEME;?>/js/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script> -->
    <script src="<?php echo H_THEME;?>/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo H_THEME;?>/js/hezecom.custom.js"></script>
   
  </body>
   
</html>
