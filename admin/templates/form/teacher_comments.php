<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Teacher Comments</a></li>
                 <li><a href="teacher_comments.php">Teacher Comments Listing</a></li>
				  <li class="active">Teacher Comments Form</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="teacher_comments.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
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
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="teacher_comments.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;">
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
              <div class="form-group">
                <label class="col-sm-3 control-label">Parish Teacher Name<span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <select name="teacher_id" id="teacher_id" class="form-control" >
                  <option value="">--Select Parish Teacher--</option>
                     <?php $teachers_arr=getResultArray("SELECT teacher_ID, name FROM ".MTABLE."teachers WHERE teacher_status = 1  ORDER BY teacher_ID asc "); 
				 foreach($teachers_arr as $row){
				  ?>
				  <option value="<?php echo $row['teacher_ID'] ;?>" <?php echo (($row['teacher_ID']==$teacher_id)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label"> Student Name<span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <select name="student_id" id="student_id" class="form-control" >
                  <option value="">--Select Student--</option>
                     <?php $student_arr=getResultArray("SELECT student_ID, name FROM ".MTABLE."students WHERE student_status = 1  ORDER BY student_ID asc "); 
				 foreach($student_arr as $row){
				  ?>
				  <option value="<?php echo $row['student_ID'] ;?>" <?php echo (($row['student_ID']==$student_id)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Comments  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <textarea name="comments" id="comments"   class="ckeditor form-control"><?php echo $comments; ?></textarea>
                </div>
              </div>
              
            
              
              
              
             <!-- <div class="form-group">
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