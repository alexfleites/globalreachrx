	<?php
	/*
	* =======================================================================
	* CLASSNAME:        database.php
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>

 <div class="col-lg-12">
 <div class="panel panel-default">
  <div class="panel-heading"><h3 class="panel-title"><i class="icon-reorder"></i> <?php echo LANG_UPLOAD_CSV_TO_TABLE;?></h3></div>
  <div class="panel-body">
<p>
<?php if($haccess->UserAccess()->user_position==1){?>
      <form action="<?php echo H_ADMIN;?>&view=hezedata&do=database" method="post" name="hezedata" id="hezecomform" enctype="multipart/form-data">
        
    <div <div class="form-group">
    <label for="selsear" class="control-label"><?php echo LANG_CSV_TO;?></label>
    <select name="tablename" id="tablename"  class="form-control choz" required>
    <option value="<?php echo get('himport');?>"><?php echo get('himport');?></option>
    <?php
    foreach (HDB::hus()->query("SHOW TABLES") as $row)
        { 
	?>
    <option value="<?php echo $row[0];?>"><?php echo $row[0];?></option>
    <?php }?>
    </select>
    </div>
    
        
        <div class="form-group">
          <label class="control-label" for="uploadfile"><?php echo LANG_CSV_SELECT_FILE;?></label>
            <input type="file" id="uploadfile" name="uploadfile"  required/>
            </div>
          
     <div class="controls">
	 <div class="col-md-2" style="padding:0;">
	  <input type="submit" name="button" class="btn btn-primary"  value="<?php echo LANG_UPLOAD;?>" />
	 </div>
	 <div class="col-md-3" style="padding:0;">
	 <div id="output"></div>
	 </div>
	 </div>
        
      </form> 
      <?php }else{echo'<div class="alert alert-danger">You have limited access to this page!</div>';}?>  
      </p>
</div>
 </div>
 </div><!--/col-12-->

<?php if($haccess->UserAccess()->user_position==1){?>
<div class="col-lg-12">
<div class="panel panel-default">
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_BACKUP_MANAGEMENT;?></h3></div>
  <div class="panel-body">
  
  <a href="<?php echo H_ADMIN;?>&view=hezedata&do=database&dbm=backup" class="btn btn-success tip" title="<?php echo LANG_CREATE_BACKUP;?>"> <i class="fa fa-cloud"></i> <?php echo LANG_CREATE_BACKUP;?></a><br />

  
  <?php $dbm->ManageDB(H_BACKUP_DIR);?>

</div><!--/col-12-->
</div>
</div>
<?php }?>
</div>
