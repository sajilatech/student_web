<?php
$user_type=$_SESSION['usertype'];
if($user_type=='1'){
	$h='Super Admin';
}
else{
	$h='Moderator';
	}
?>
<div class="container-fluid" id="pcont">
    <div class="page-head">
      <ol class="breadcrumb" id="showlinks">
        <li><a href="home.php">Home</a></li>
        <li><a href="admin.php"><?php echo $h;?></a></li>
        <li class="active"><?php echo $h;?> Form</li>
      </ol>
    </div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="admin.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
          </div>
          <div class="content">
           <?php if($alert != '') { ?> 
           <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $alert; ?>
							 </div>
          <?php } if($mssg != '') { ?>
           <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-info-circle"></i></div>
								<strong>Info!</strong> <?php echo $mssg; ?>
							 </div>
          <?php } ?>
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="admin.php" method="post" style="border-radius: 0px;">
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
              <div class="form-group">
                <label class="col-sm-3 control-label">Username  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="username" id="username" required title="Username" value="<?php echo $username; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Password  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="password" id="password" <?php if($edit != '') { echo 'value="******"'; } ?> name="password" required class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Confirm Password  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="password" parsley-equalto="#password" <?php if($edit != '') { echo 'value="******"'; } ?> required name="password2" id="password2" class="form-control">
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Email Address  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="email" name="email" id="email" required title="Email Address" value="<?php echo $email; ?>" class="form-control">
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Mobile  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="mobile" id="mobile" required title="Email Mobile" value="<?php echo $mobile; ?>" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">First Name  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="firstname" id="firstname" required title="First Name" value="<?php echo $firstname; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Last Name</label>
                <div class="col-sm-6">
                  <input type="text" name="lastname" id="lastname" title="Last Name" value="<?php echo $lastname; ?>" class="form-control">
                </div>
              </div>
              
            
              <!--
              <div class="form-group">
                <label class="col-sm-3 control-label">Terms & Conditions <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <textarea id="TERMS" name="TERMS" required title="TERMS" class="form-control"><?php echo $TERMS; ?></textarea>
                </div>
              </div>-->

               <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
              </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    </div>
  </div>