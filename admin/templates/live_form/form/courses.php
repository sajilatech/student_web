<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Course MGT</a></li>
                 <li><a href="courses.php">Courses Lisitng</a></li>
				  <li class="active">Course Form</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="courses.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
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
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="courses.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;" onsubmit="return validate();">
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
             
              <div class="form-group">
                <label class="col-sm-3 control-label">Course Code  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="crs_code" id="crs_code" required title="Course Code" value="<?php echo $crs_code; ?>" class="form-control">
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Course Name  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="crs_name" id="crs_name" required title="Course Name" value="<?php echo $crs_name; ?>" class="form-control">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Status</label>
                <div class="col-sm-6">
                   <select name="crs_status" id="crs_status" class="form-control">
                     <?php 
   foreach($status_list as $key=>$status_lists)
   {
	   echo '<option value="'.$key.'" '.(($key==$crs_status)?'selected="selected"':'').'>'.$status_lists.'</option>';
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