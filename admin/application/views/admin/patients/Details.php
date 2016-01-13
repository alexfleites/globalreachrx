
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Details.php
	* DATE CREATED:  	28-12-2015
	* FOR TABLE:  		patients
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	<div class="row">
    <div class="col-xs-12">
    <div class="box">
    <div class="box-header">
    <h3 class="box-title">Patients</h3>
   <ul class="nav pull-right">
	<input type="hidden" id="pid" value="<?php echo $rows->id;?>">		
	<input type="hidden" id="site" value="<?php echo ($rows->source == "Global Reach Health" ? "globalreachhealth" : "");?>">		
<!-- 	<a href="<?php echo H_ADMIN;?>&view=patients&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?></a> -->
	
	<a href="<?php echo H_ADMIN;?>&view=patients&id=<?php echo $rows->id;?>&do=update" title="<?php echo LANG_TIP_UPDATE;?> Record" class="btn btn-default btn-md tip"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE;?></a>
		
	<!-- <a href="<?php echo H_ADMIN_MAIN;?>&view=patients&id=<?php echo $rows->id;?>&do=export2&hexport=yes&etype=word" title="<?php echo LANG_TIP_WORD;?>" class="btn btn-default btn-xs tip"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a> -->
	
	<a href="<?php echo H_ADMIN_MAIN;?>&view=patients&id=<?php echo $rows->id;?>&do=export2&hexport=yes&etype=printer" title="<?php echo LANG_TIP_PRINT;?>" target="_blank" class="btn btn-default btn-md tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=patients&id=<?php echo $rows->id;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE_ALL;?>" class="btn btn-default btn-md tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	<a href="<?php echo H_ADMIN;?>&view=patients&do=viewall" class="btn btn-default btn-md tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
	   <div class="output"></div>
	<table data-page="false" class="table table-striped table-bordered">
	 <tbody>
		  	
	<tr>
	<th>First Name</th><td><?php echo $rows->first_name;?></td>
	</tr>
		
	<tr>
	<th>Last Name</th><td><?php echo $rows->last_name;?></td>
	</tr>
		
	<tr>
	<th>Phone</th><td><?php echo format_phone_number($rows->phone);?></td>
	</tr>
		
	<tr>
	<th>Email</th><td><?php echo $rows->email;?></td>
	</tr>
		
	<tr>
	<th>Source</th><td><?php echo $rows->source;?></td>
	</tr>

	<tr>
	<th>Status</th><td><?php echo check_status($rows->active);?></td>
	</tr>
		
	<tr>
	<th>Notes</th><td><?php echo $rows->notes;?></td>
	</tr>
		
	<tr>
	  <?php $date = new DateTime($rows->date); ?>
	  <th>Date Created</th><td><?php echo $date->format('m/d/Y');?></td>
	  </tr>
	</tbody>
	</table>
	 </div><!-- /.box-body -->
	 <?php if($rows->active == 1){?>
	 <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
	 <label for="hDownloadButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-download"></i> <?php echo LANG_DOWNLOAD_CARD;?></label>
	 <input type="button" name="button" id="hDownloadButton" class="hidden" value="<?php echo LANG_DOWNLOAD_CARD;?>" />
	 <label for="hEmailButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-envelope-o"></i> <?php echo LANG_EMAIL_CARD;?></label>
	 <input type="button" name="button" id="hEmailButton" class="hidden" value="<?php echo LANG_EMAIL_CARD;?>" />
	 </div>
	 <?php } //end if ?>
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->
	