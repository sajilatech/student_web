<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Branch MGT</a></li>
                 <li><a href="branches.php">Branches Listing</a></li>
				  <li class="active">Branch Form</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="branches.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
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
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="branches.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;">
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
             
              <div class="form-group">
                <label class="col-sm-3 control-label">Name  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="brnch_name" id="brnch_name" required title="Name" value="<?php echo $brnch_name; ?>" class="form-control">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Address <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <textarea id="brnch_address" name="brnch_address" required title="Address" class="form-control"><?php echo $brnch_address; ?></textarea>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Branch Code <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <input type="text" name="brnch_code" id="brnch_code" required title="Branch Code" value="<?php echo $brnch_code; ?>" class="form-control">
                </div>
              </div>
              
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Phone <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <input type="text" name="brnch_phone" id="brnch_phone" required title="Phone" value="<?php echo $brnch_phone; ?>" class="form-control">
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Email <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <input type="email" name="brnch_email" id="brnch_email" required title="Email" value="<?php echo $brnch_email; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">PAN No <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="brnch_panno" id="brnch_panno" required title="PAN No" value="<?php echo $brnch_panno; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">GSTIN/UIN <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="brnch_gstin" id="brnch_gstin" required title="GSTIN/UIN" value="<?php echo $brnch_gstin; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">HSN/SAC <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="brnch_gstcode" id="brnch_gstcode" required title="HSN/SAC" value="<?php echo $brnch_gstcode; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Central Tax <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="brnch_central_tax" id="brnch_central_tax" required title="Central Tax" value="<?php echo $brnch_central_tax; ?>" class="form-control">
                  <span style="color:#908f8f; font-size:12px;">Do not add % symbol</span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">State Tax <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="brnch_state_tax" id="brnch_state_tax" required title="State Tax" value="<?php echo $brnch_state_tax; ?>" class="form-control">
                  <span style="color:#908f8f; font-size:12px;">Do not add % symbol</span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Location <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <input type="text" name="brnch_location" id="brnch_location" required title="Location" value="<?php echo $brnch_location; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Pin <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <input type="text" name="brnch_pin" id="brnch_pin" required title="Pin" value="<?php echo $brnch_pin; ?>" class="form-control">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Status</label>
                <div class="col-sm-6">
                   <select name="brnch_status" id="brnch_status" class="form-control">
                     <?php 
   foreach($status_list as $key=>$status_lists)
   {
	   echo '<option value="'.$key.'" '.(($key==$brnch_status)?'selected="selected"':'').'>'.$status_lists.'</option>';
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