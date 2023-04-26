<script type="text/javascript" src="../../js/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type = "text/javascript" language = "javascript">
         function ajax_education_type(path,container){
			 var by_id = $('#education_type').val(); 
			  $.ajax({
								type:'POST',
								url:path,
								data:{'by_id':by_id},
								success: function(option_tags) {
									
									$('#'+container).html(option_tags);
								}
						});
				 }
			 
			 
			 </script>
<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Educations</a></li>
                 <li><a href="educations.php">Educations Listing</a></li>
				  <li class="active">Educations Form</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="appointments.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
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
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="educations.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;">
             
              <?php if(isset($retur)){?>
				 <input type="hidden" name="retur" value="<?php echo $retur; ?>">
                 <?php
			 }
			 ?>
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
             
              <div class="form-group">
                <label class="col-sm-3 control-label">Name of Institution  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="institution_name" id="institution_name" required title="Institution Name" value="<?php echo $institution_name; ?>" class="form-control">
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Type of Education <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 
               <select name="education_type" id="education_type" class="form-control" required onchange="ajax_education_type('../ajax/education_type.php','displayEducation')">
                  <option value="">--Select Publication Type--</option>
               <?php  foreach($type_of_education_list as $key=>$value){
				  ?>
				  <option value="<?php echo $key ;?>" <?php echo (($key==$education_type)?'selected="selected"':'') ?> ><?php echo $value; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
               <div class="form-group" >
               <div id="displayEducation">
               <?php if($education_type=='3'){?>
                <label class="col-sm-3 control-label">Degree </label>
                <div class="col-sm-6">
                  <input type="text" name="degree" id="degree"  title="Degree"  value="<?php echo $degree;?>" class="form-control">
                </div>
                
               <?php
			   }
			   ?>
               </div>
              </div>
             <div class="form-group">
                <label class="col-sm-3 control-label">Place  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="place" id="place" required title="Place" value="<?php echo $place; ?>" class="form-control">
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Start Year  <span style="color:#F00;">*</span></label>
                 <div class="col-sm-6">
                  <input type="text" name="start_year" id="start_year" required title="Start Year" value="<?php echo $start_year; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">End Year  <span style="color:#F00;">*</span></label>
                 <div class="col-sm-6">
                  <input type="text" name="end_year" id="end_year" required title="End Year" value="<?php echo $end_year; ?>" class="form-control">
                </div>
              </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Student Name</label>
                <div class="col-sm-6">
                   <select name="student_id" id="student_id" class="form-control" required>
                   <option value="">--Select Student--</option>
									 <?php
                                     $student_arr=getResultArray("SELECT student_ID, name FROM ".MTABLE."students WHERE student_status = 1  ORDER BY student_ID asc "); 
                   foreach($student_arr as $row)
                   {
                      ?><option value="<?php echo $row['student_ID'];?>" <?php if($row['student_ID']==$student_id){ echo 'selected="selected"'; }?>><?php echo $row['name'];?></option>
                      <?php
                   }
                   ?>
                  </select>									
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Level  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="level_of" id="level_of" required title="Level" value="<?php echo $level_of; ?>" class="form-control">
                </div>
              </div>
              
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Country <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 
                   <select name="country" id="country" class="form-control" >
                  <option value="">--Select Country--</option>
               <?php  foreach($country_array as $key=>$value){
				  ?>
				  <option value="<?php echo $key ;?>" <?php echo (($key==$country)?'selected="selected"':'') ?> ><?php echo $value; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Description  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <textarea class="ckeditor form-control" name="description" id="description"><?php echo $description; ?></textarea>
                </div>
              </div>
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