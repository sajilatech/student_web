<link href="css/style.css" rel="stylesheet" />	
<?php
require('../application_top.php');
define('MODULEID','6');
require(DIR_ADMIN_INCLUDE.'session.php');
define('TABLE',MTABLE.'students');
define('FAMILYTBL',MTABLE.'family');
define('SIBLINGSTBL',MTABLE.'student_siblings');
define('QUALITYTBL',MTABLE.'student_qualities');
define('INTERESTTBL',MTABLE.'student_interests');
?>

<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#"> Students MGT</a></li>
                 <li><a href="students.php">Students Listing</a></li>
				  <li class="active">Student Form</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3>Student Details</h3><span style="float:right; margin-top:5px"><a class="label label-default" href="students.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
          </div>
          <div class="content">
          <?php   list($student_id, $name, $mst_id, $place, $post_code, $district, $state, $country, $route_to_house, $dob, $land_phone, $cell_phone, $email,  $fb, $whats_up, $school_teacher_name, $school_name, $parish_id, $parish_teacher_id, $description, $study_status_id, $student_category) = $db->fetch_one_row("SELECT student_ID, name, mst_id, place, post_code, district, state, country, route_to_house, dob, land_phone, cell_phone, email,  fb, whats_up, school_teacher_name, school_name, parish_ID, teacher_ID, description, study_status_id, student_category_id FROM ".TABLE." WHERE student_ID='".$select_id."'");
		  
	  list($family_name, $family_financial_status, $family_id, $reputation, $relation_with_parish_id)=$db->fetch_one_row("SELECT family_name, family_financial_status, family_id, reputation, relation_with_parish_id	FROM ".FAMILYTBL." WHERE student_ID='".$select_id."'"); 
	  
		 list($siblings_name, $siblings_occupation, $relation_with_student)=$db->fetch_one_row("SELECT siblings_name, siblings_occupation, relation_with_student	FROM ".SIBLINGSTBL." WHERE student_ID='".$select_id."'"); ?>
          
            
             <div id="display_type">
<a   class="studtabactive">Personal</a>
<a onclick="display_type('../ajax/ajax_display_type.php','display_type','family')" class="studtab">Family</a>
<a onclick="display_type('../ajax/ajax_display_type.php','display_type','interests')" class="studtab">Interests</a>
</br>

             <input type="hidden" name="select_id"  id="select_id" value="<?php echo $select_id; ?>">
			
             
              <div class="form-group">
                <label class="col-sm-3 control-label">Name  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <?php echo $name; ?>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Email <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <?php echo $email; ?>
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Cell Phone <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <?php echo $cell_phone; ?>
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Land Phone <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <?php echo $land_phone; ?>
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">MST ID <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <?php echo $mst_id; ?>
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">DOB <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <?php echo $dob; ?>
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Place <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <?php echo $place; ?>
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">District <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                <?php echo $district; ?>
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">State <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                <?php echo $state; ?>
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
                <label class="col-sm-3 control-label">Post Code <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <?php echo $post_code; ?>
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Route to House <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                <?php echo $route_to_house; ?>
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Face Book Name <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                <?php echo $fb; ?>
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Whats Up No. <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <?php echo $whats_up; ?>
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">School Teacher Name <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                <?php echo $school_teacher_name; ?>
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">School Name <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
               <?php echo $school_name; ?>
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Parish <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                   <select name="parish_id" id="parish_id" class="form-control" >
                  <option value="">--Select Parish--</option>
                     <?php 
					  $parish_arr=getResultArray("SELECT parish_ID, name FROM ".MTABLE."parish WHERE parish_status = 1  ORDER BY parish_ID asc "); 
				 foreach($parish_arr as $row){
				  ?>
				  <option value="<?php echo $row['parish_ID'] ;?>" <?php echo (($row['parish_ID']==$parish_id)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Parish Teacher Name<span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <select name="parish_teacher_id" id="parish_teacher_id" class="form-control" >
                  <option value="">--Select Parish Teacher--</option>
                     <?php $teachers_arr=getResultArray("SELECT teacher_ID, name FROM ".MTABLE."teachers WHERE teacher_status = 1  ORDER BY teacher_ID asc "); 
				 foreach($teachers_arr as $row){
				  ?>
				  <option value="<?php echo $row['teacher_ID'] ;?>" <?php echo (($row['teacher_ID']==$parish_teacher_id)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
               
                <div class="form-group">
                <label class="col-sm-3 control-label">Descriptions</label>
                <div class="col-sm-6">
              ><?php echo $description; ?>
                 
                </div>
              </div>
            
               <div class="form-group">
                <label class="col-sm-3 control-label">Student Category <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <select name="student_category" id="student_category" class="form-control" >
                  <option value="">Select Student Category</option>
                     <?php 
				 foreach($student_category_list as $key=> $value){
				  ?>
				  <option value="<?php echo $key ;?>" <?php echo (($key==$student_category)?'selected="selected"':'') ?> ><?php echo $value; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
               <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
              <input type="hidden" name="doaction" id="doaction" value="<?php echo $action; ?>">
               <!--<button type="button" class="btn btn-primary" onclick="display_type('../ajax/ajax_display_type.php','display_type','family')">Next</button>-->
               <a onclick="display_type('../ajax/ajax_display_type.php','display_type','family')" class="btn btn-primary">Next</a>
              <!--<button type="submit" class="btn btn-primary">Submit</button>-->
                
               <!-- <button type="reset" class="btn btn-default">Reset</button>-->
              </div>
              </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    </div>
  </div>