   <body class="login-page">
<form action="<?php echo H_ADMIN_MAIN.'&view=hsys_users&do=loginpro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo H_CLIENT;?>"><b>Ultimate</b>Speed</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg"><?php echo LANG_ADMIN_LOGIN;?></p>
        
        <div class="output"></div>
        
		<div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="<?php echo LANG_ADMIN_USERNAME;?>"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="<?php echo LANG_ADMIN_PASSWORD;?>"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
               <!-- <label>
                  <input type="checkbox"> Remember Me
                </label>-->
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
           <input name="Logme" class="btn btn-primary btn-block btn-flat " type="submit" value="<?php echo LANG_ADMIN_BUTTON;?>">
            </div><!-- /.col -->
          </div>
               
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
</form> 
