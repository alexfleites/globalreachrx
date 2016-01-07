
	<?php
	/*
	Hezecom Responsive Gallery, Portfolio and Slider Manager
	Author: Hezecom Technologies (http://hezecom.com) info@hezecom.net
	COPYRIGHT 2014 ALL RIGHTS RESERVED
	
	You must have purchased a valid license from CodeCanyon.com in order to have 
	access this file.

	You may only use this file according to the respective licensing terms 
	you agreed to when purchasing this item.
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	<div class="row">
    <div class="col-xs-12">
    <div class="box">
    <div class="box-header">
    <h3 class="box-title"><i class="fa fa-share"></i> Profile Details</h3>
   <ul class="nav pull-right">
   
	<a href="<?php echo H_ADMIN;?>&view=hsys_users2&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-sm tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
    
    <a href="<?php echo H_ADMIN;?>&view=hsys_users2&do=updatepwd" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-sm tip"><i class="fa fa-lock"></i> Change Password</a>
	
	
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
  
  <div class="panel-body text-right gallery">
    <?php if(is_file(UPLOAD_FOLDER.$rows->user_avarta)){?>
	  <a href='<?php echo UPLOAD_FOLDER.$rows->user_avarta;?>' data-rel='hezebox' class="img-responsive"><img src='<?php echo THUMB_FOLDER.$rows->user_avarta;?>'  /></a>
	  <?php }else{?>
       <span class="fa fa-user" style="color:#CCC; font-size:150px;"></span>
       <?php }?>
  </div>
	<table class="table table-striped table-bordered" data-page-size="200">
	 <tbody>
		  	
	<tr>
	<th width="86">Name</th><td colspan="2"><?php echo $rows->name;?>
	  </td>
	</tr>
		
	<tr>
	<th>Email</th><td colspan="2"><?php echo $rows->email;?></td>
	</tr>

	<tr>
	<th>Username</th><td colspan="2"><?php echo $rows->username;?></td>
	</tr>

	<tr>
	<th>User Status</th><td colspan="2"><?php echo check_status($rows->user_status);?></td>
	</tr>
		
	<tr>
	<th>User Position</th><td width="197"><?php echo check_position($rows->user_position);?></td>
	</tr>
		
	</tbody>
	</table>
	</div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->
	