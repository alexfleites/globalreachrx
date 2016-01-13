
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	28-12-2015
	* FOR TABLE:  		patients
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=patients&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
<!--
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
-->
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=patients&id=<?php echo $rows->id;?>&do=details" title="View Details" class="btn btn-default btn-md tip"><i class="fa fa-th-list"></i> <?php echo LANG_CANCEL;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=patients&id=<?php echo $rows->id;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-md tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=patients&do=viewall" class="btn btn-default btn-md tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> Patient</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" id="pid" name="id" value="<?php echo $rows->id;?>">
	<div class="form-group">
    <label class="control-label" for="first_name">First Name</label>
	<input id="first_name" name="first_name" type="text" maxlength="60"  value="<?php echo $rows->first_name;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="last_name">Last Name</label>
	<input id="last_name" name="last_name" type="text" maxlength="60"  value="<?php echo $rows->last_name;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="phone">Phone</label>
	<input id="phone" name="phone" type="text" maxlength="25"  value="<?php echo $rows->phone;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="email">Email</label>
	<input id="email" name="email" type="text" maxlength="255"  value="<?php echo $rows->email;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="source">Source</label>
	<select name="source" id="source" class=" form-control styler choz">
	<option value="<?php echo $rows->source;?>"><?php echo $rows->source;?></option>
	<?php if($rows->source !== "Global Reach Health"){?>
		<option value="Global Reach Health">Global Reach Health</option>
	<?php } ?>
	<?php if($rows->source !== "GlobalReach Rx"){?>
		<option value="GlobalReach Rx">GlobalReach Rx</option>
	<?php } ?>
	</select>
	</div>

	<div class="form-group">
    <label class="control-label" for="source">Status</label>
	<select name="active" id="active" class=" form-control styler choz">
	<option value="<?php echo $rows->active;?>"><?php echo ($rows->active == 1 ? "Active" : "Inactive");?></option>
	<?php if($rows->active != 1){?>
		<option value="1">Active</option>
	<?php } ?>
	<?php if($rows->active != 0){?>
		<option value="0">Inactive</option>
	<?php } ?>
	</select>
	</div>

	<div class="form-group">
    <label class="control-label" for="notes">Notes</label>
	<textarea rows="5" id="notes" name="notes" class="form-control editor2 styler" /><?php echo $rows->notes;?></textarea>
	</div>

	<!-- <div class="form-group">
    <label class="control-label" for="date">Date</label>
	<input id="date" name="date" type="text" maxlength="255"  value="<?php echo $rows->date;?>" class="form-control styler" />
	</div> -->

<!-- 	 <div class="output"></div> -->
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_SAVE_CHANGES;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_SAVE_CHANGES;?>" />
	 <?php if($rows->active == 1 && $have_card){?>
	 <label for="hDownloadButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-download"></i> <?php echo LANG_DOWNLOAD_CARD;?></label>
	 <input type="button" name="button" id="hDownloadButton" class="hidden" value="<?php echo LANG_DOWNLOAD_CARD;?>" />
	 <label for="hEmailButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-envelope-o"></i> <?php echo LANG_EMAIL_CARD;?></label>
	 <input type="button" name="button" id="hEmailButton" class="hidden" value="<?php echo LANG_EMAIL_CARD;?>" />
	 <?php } //end if ?>
	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 