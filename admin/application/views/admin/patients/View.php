
	<?php
	/*
	* =======================================================================
	* FILE NAME:        View.php
	* DATE CREATED:  	28-12-2015
	* FOR TABLE:  		patients
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	<?php AjaxSearchSuggest(''.H_ADMIN_MAIN.'&view=patients&do=autosearch');?>
	
	<div class="row">
            <div class="col-xs-12">
              <div class="box">
              
               <div class="box-header with-border">
               <h3 class="box-title">Patients</h3>
                <ul class="nav pull-right">

	<a href="<?php echo H_ADMIN;?>&view=patients&do=add" class="btn btn-default btn-md tip" title="<?php echo LANG_TIP_ADD;?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD;?> New Patient</a>
	<a href="<?php echo H_ADMIN_MAIN;?>&view=patients&do=export&hexport=yes&etype=printer" target="_blank" class="btn btn-default btn-md tip" title="<?php echo LANG_TIP_PRINT;?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT;?></a>
	<a href="<?php echo H_ADMIN_MAIN;?>&view=patients&do=export&hexport=yes&etype=EMAIL" data-email="<?php echo LANG_EMAIL_LIST;?>" class="btn btn-default btn-md tip" title="<?php echo LANG_TIP_EMAIL;?>"><i class="fa fa-envelope"></i> <?php echo LANG_EMAIL;?></a>
	<!-- <a href="<?php echo H_ADMIN_MAIN;?>&view=patients&do=export&hexport=yes&etype=excel" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_EXCEL;?>"><i class="fa fa-table"></i> <?php echo LANG_EXCEL;?></a>
	 <a href="<?php echo H_ADMIN_MAIN;?>&view=patients&do=export&hexport=yes&etype=word" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_WORD;?>"><i class="fa fa-file-o"></i> <?php echo LANG_WORD;?></a>
	<a href="<?php echo H_ADMIN;?>&view=patients&do=truncate" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_TRUNCATE;?>" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_TRUNCATE;?></a> -->
	</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
<script type="text/javascript">

$(document).ready(function(){
	
	$('#btn_search').css('pointer-events', 'none');

});

</script>   

   <!--AUTO COMPLETE-->
  	<div class="col-md-3 autosearch">
    	<div class=" s-absolute">
            <div class="input-group">
              <input type="text" class="form-control input-sm styler" id="inputString" onkeyup="lookup(this.value);"  placeholder="search by name" autocomplete="off">
              <span class="input-group-btn">
                <button id="btn_search" class="btn btn-sm" type="button" style="background:#f7f7f7; border: solid 1px #d3d3d3; cursor: default;" onclick="javascript:return false;"><span class="fa fa-search"></span></button>
              </span>
            </div><!-- /input-group -->
            <div id="suggestions"></div>
      	</div>
     </div><!--/col-lg-3--> 
     <div class="col-md-4">Filter:&nbsp;
     	<a class="btn btn-primary" href="<?php echo H_ADMIN;?>&view=patients&do=viewall&active=all">View All</a>
     	<a class="btn btn-success" href="<?php echo H_ADMIN;?>&view=patients&do=viewall&active=1">Active</a>
     	<a class="btn btn-danger" href="<?php echo H_ADMIN;?>&view=patients&do=viewall&active=0">Inactive</a>
     </div>
	 <!--/AUTO COMPLETE-->
	 
	<table data-page="false" class="table table-bordered table-hover table-striped" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE;?>" data-page-previous-text="<?php echo LANG_PREVIOUS;?>" data-page-next-text="<?php echo LANG_NEXT;?>">
	<thead>
    <tr>
	  <th data-sort-ignore="true"><?php echo LANG_ACTIONS;?></th>
      <th>First Name</th>
	  <th data-hide="phone,tablet">Last Name</th>
	  <th data-hide="phone,tablet">Phone</th>
	  <th data-hide="phone,tablet">Email</th>
	  <th data-hide="phone,tablet">Source</th>
	  <th data-hide="phone,tablet">Status</th>
	  <th data-sort-ignore="true"><?php echo LANG_DELETE;?></th>
	</tr>
  </thead>
  <tbody>
  
   <?php
	foreach($result as $rows)
			{
	?>
	<tr>
	<td class="table-actions">
	 <div class="btn-group">
	 <a href="<?php echo H_ADMIN;?>&view=patients&id=<?php echo $rows->id;?>&do=details"  class="btn btn-info btn-sm" style="margin-right: 5px;"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS;?>"></span></a>
	<a href="<?php echo H_ADMIN;?>&view=patients&id=<?php echo $rows->id;?>&do=update" class="btn btn-primary btn-sm" style="margin-right: 5px;"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE;?>"></span></a>
	 </div>
	</td>
	<td><a href="<?php echo H_ADMIN;?>&view=patients&id=<?php echo $rows->id;?>&do=details"><?php echo $rows->first_name;?></a></td>
	<td><a href="<?php echo H_ADMIN;?>&view=patients&id=<?php echo $rows->id;?>&do=details"><?php echo $rows->last_name;?></a></td>
	<td><?php echo $rows->phone;?></td>
	<td><?php echo $rows->email;?></td>
	<td><?php echo $rows->source;?></td>
	<td><?php echo check_status($rows->active);?></td>
	<td class="table-actions">
	 <div class="btn-group">
	 <a href="<?php echo H_ADMIN;?>&view=patients&id=<?php echo $rows->id;?>&do=delete" class="btn btn-danger btn-sm" data-confirm="<?php echo LANG_DELETE_AUTH;?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE;?>"></span></a>
	 </div>
	 </td>
    </tr>
	<?php }?>
  </tbody>
  <tfoot>
    <tr>
    <td colspan="6">
    <div class="pagination"><?php echo $paging;?></div>
    </td>
    </tr>
</tfoot>
</table>
  </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->