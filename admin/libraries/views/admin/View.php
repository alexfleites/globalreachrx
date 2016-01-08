
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
	
	AjaxSearchSuggest(''.H_ADMIN_MAIN.'&view=hsys_users&do=autosearch');
	?>
	
	<div class="row">
            <div class="col-xs-12">
              <div class="box">
              
               <div class="box-header with-border">
               <h3 class="box-title">System Users</h3>
                <ul class="nav pull-right">
                
	<ul class="nav nav-tabs pull-right">
	<a href="<?php echo H_ADMIN;?>&view=hsys_users&do=add" class="btn btn-success btn-sm tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> Create User</a>
	</ul>
	
  </div><!-- /.box-header -->
   <div class="box-body">
	
     <!--AUTO COMPLETE-->
    <div class="col-md-3 autosearch">
    <div class=" s-absolute">
            <div class="input-group">
              <input type="text" class="form-control input-sm styler" id="inputString" onkeyup="lookup(this.value);"  placeholder="search" autocomplete="off">
              <span class="input-group-btn">
                <button class="btn btn-default btn-sm" type="button"><span class="fa fa-search"></span></button>
              </span>
            </div><!-- /input-group -->
            <div id="suggestions"></div>
      </div>
      </div><!--/col-lg-3-->
       <!--/AUTO COMPLETE-->    
          
	<table  data-page="false" class="table table-bordered table-hover table-striped" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE;?>" data-page-previous-text="<?php echo LANG_PREVIOUS;?>" data-page-next-text="<?php echo LANG_NEXT;?>">
	<thead>
    <tr>
      <th width="291">Name</th>
	  <th width="226">Email</th>
	  <th width="198" data-hide="phone,tablet">Phone</th>
	  <th width="156" data-hide="phone,tablet">Username</th>
	  <th width="107"><?php echo LANG_ACTIONS;?></th>
	</tr>
  </thead>
  <tbody>
  
   <?php
	foreach($result as $rows)
			{
	?>
	<tr>
	<td><?php echo $rows->name;?></td>
	<td><?php echo $rows->email;?></td>
	<td><?php echo $rows->phone;?></td>
	<td><?php echo $rows->username;?></td>
	<td class="table-actions">
	 <div class="btn-group">
     <a href="<?php echo H_ADMIN;?>&view=hsys_users&userid=<?php echo $rows->userid;?>&do=updatepwd"  class="btn btn-info btn-xs"><span class="fa fa-lock tip" title="Change Password"></span></a>
	 <a href="<?php echo H_ADMIN;?>&view=hsys_users&userid=<?php echo $rows->userid;?>&do=details"  class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS;?>"></span></a>
	<a href="<?php echo H_ADMIN;?>&view=hsys_users&userid=<?php echo $rows->userid;?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE;?>"></span></a>
	 <a href="<?php echo H_ADMIN;?>&view=hsys_users&userid=<?php echo $rows->userid;?>&do=delete&dfile=<?php echo $rows->user_avarta;?>" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE;?>"></span></a>
     
	 </div>
	 </td>
    </tr>
	<?php }?>
  </tbody>
<tfoot>
    <tr>
    <td colspan="5">
    <div class="pagination"><?php echo $paging;?></div>
    </td>
    </tr>
</tfoot>
</table>
  </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->