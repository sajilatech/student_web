<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Teachers</a></li>
                 <li><a href="teachers.php">Teachers Listing</a></li>
				  <li class="active">Teachers Form</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="teachers.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
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
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="teachers.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;">
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
             
              <div class="form-group">
                <label class="col-sm-3 control-label">Name  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="name" id="name" required title="Name" value="<?php echo $name; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Email  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="email" id="email" required title="email" value="<?php echo $email; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Address  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="address" id="address" required title="Address" value="<?php echo $address; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Phone  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="phone" id="phone" required title="Phone" value="<?php echo $phone; ?>" class="form-control">
                </div>
              </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Parish<span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                   <select name="parish_id" id="parish_id" class="form-control" required>
                   <option value="">--Select Parish--</option>
                     <?php
					 $parish_arr=getResultArray("SELECT parish_ID, name FROM ".MTABLE."parish WHERE parish_status = 1  ORDER BY parish_ID asc "); 
   foreach($parish_arr as $row)
   {
	  ?><option value="<?php echo $row['parish_ID'];?>" <?php if($row['parish_ID']==$parish_id){ echo 'selected="selected"'; }?>><?php echo $row['name'];?></option>
      <?php
   }
   ?>
                  </select>									
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Description  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <textarea name="description" id="description" required title="Description"  class="ckeditor form-control"><?php echo $description; ?></textarea>
                </div>
              </div>
           
              <!--<div class="form-group">
                <label class="col-sm-3 control-label">Courses  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <select name="course_id" id="course_id" class="form-control" required>
                   <option value="">--Select Courses--</option>
                     <?php
					 $course_arr=getResultArray("SELECT course_ID, course_name FROM ".MTABLE."courses WHERE course_status = 1  ORDER BY course_ID asc "); 
   foreach($course_arr as $row)
   {
	  ?><option value="<?php echo $row['course_ID'];?>" <?php if($row['course_ID']==$course_id){ echo 'selected="selected"'; }?>><?php echo $row['course_name'];?></option>
      <?php
   }
   ?>
                  </select>				
                </div>
              </div>
                </div>-->
               <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
               <!-- <button type="reset" class="btn btn-default">Reset</button>-->
              </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    </div>
  </div>