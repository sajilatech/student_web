<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Branch MGT</a></li>
                 <li><a href="staffs.php">Staffs Listing</a></li>
				  <li class="active">Staffs Form</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="staffs.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
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
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="staffs.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;">
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
             <div class="form-group">
                <label class="col-sm-3 control-label">Branch <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <select name="brnch_id" id="brnch_id" required class="form-control">
                  <option value="">Select Branch</option>
                     <?php 
    $query=mysql_query("select brnch_id, brnch_name, brnch_location from ".TABLE2." where brnch_status = 1");
				  while($row=mysql_fetch_array($query)){
				  ?>
				  <option value="<?php echo $row['brnch_id'] ;?>" <?php echo (($row['brnch_id']==$brnch_id)?'selected="selected"':'') ?>><?php echo $row['brnch_name'].' - '.$row['brnch_location']; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Username  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="staff_username" id="staff_username" required title="Username" value="<?php echo $staff_username; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Password  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="password" id="password" <?php if($edit != '') { echo 'value="******"'; } ?> name="staff_password" required class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Confirm Password  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="password" parsley-equalto="#password" <?php if($edit != '') { echo 'value="******"'; } ?> required name="staff_password2" id="staff_password2" class="form-control">
                </div>
              </div>
              
              
              
              
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Name  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="staff_name" id="staff_name" required title="Name" value="<?php echo $staff_name; ?>" class="form-control">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Status</label>
                <div class="col-sm-6">
                   <select name="staff_status" id="staff_status" class="form-control">
                     <?php 
   foreach($status_list as $key=>$status_lists)
   {
	   echo '<option value="'.$key.'" '.(($key==$staff_status)?'selected="selected"':'').'>'.$status_lists.'</option>';
   }
   ?>
                  </select>									
                </div>
              </div>
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