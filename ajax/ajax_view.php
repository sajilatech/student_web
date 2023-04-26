<?php 
require('../application_top.php');
define('TABLE',MTABLE.'students');
define('FAMILYTBL',MTABLE.'family'); 
define('SIBLINGSTBL',MTABLE.'student_siblings');
define('QUALITYTBL',MTABLE.'student_qualities');
define('INTERESTTBL',MTABLE.'student_interests');
 $by_type = $_POST['by_id'];

 if($by_type=='family'){
	  
		 $student_id=$_POST['student_id']; 
		   list($family_name, $family_financial_status, $family_id, $reputation, $relation_with_parish_id)=$db->fetch_one_row("SELECT family_name, family_financial_status, family_id, reputation, relation_with_parish_id	FROM ".FAMILYTBL." WHERE student_ID='".$student_id."'");
		  
		    list($siblings_name, $siblings_occupation, $relation_with_student)=$db->fetch_one_row("SELECT siblings_name, siblings_occupation, relation_with_student	FROM ".SIBLINGSTBL." WHERE student_ID='".$student_id."'");
			 
 ?><a  onclick="display_type('../ajax/ajax_view.php','display_view','personal')"  class="studtab">Personal</a>
<a  onclick="display_type('../ajax/ajax_view.php','display_view','family')" class="studtabactive">Family</a>
<a onclick="display_type('../ajax/ajax_view.php','display_view','interests')" class="studtab">Interests</a>
</br>


 <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Family Name</label>
                <div class="col-sm-6"><?php echo $family_name; ?></div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Family Financial State</label>
                <div class="col-sm-6"> <?php foreach($family_financial_status_list as $key=>$value){ if($family_financial_status==$key){ echo $key; } }?></div>
              </div>



				<div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Family Reputation in Parish</label>
                <div class="col-sm-6"> <?php foreach($reputation_list as $key=>$value){ if($reputation == $key){ echo $value; } }?></div>
              	</div>
                
                     <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Relation With Parish</label>
                <div class="col-sm-6"> <?php foreach($relation_with_parish_list as $key=>$value){ if($key==$relation_with_parish_id){ echo $value; } }?></div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Sibling's  Name</label>
                <div class="col-sm-6"><?php echo $siblings_name; ?></div>
              </div>



				<div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Sibling's Occupation</label>
                <div class="col-sm-6"><?php echo $siblings_occupation; ?></div>
              	</div>
                
                <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Relation with the student</label>
                <div class="col-sm-6"><?php echo $relation_with_student; ?></div>
              	</div>
                
                <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
              <input type="hidden" name="student_id" id="student_id" value="<?php echo $student_id;?>">
               <div class="col-sm-offset-2 col-sm-10"><a  onclick="display_type('../ajax/ajax_view.php','display_view','personal')" class="btn btn-primary wizard-next">Back</a></div>
                </div>
              </div>  
   
               
 <?php
 }
 else if($by_type=='interests'){ 
		 $student_id=$_POST['student_id'];
		   list($church_going, $altara_boy, $study_status_id, $percentage)=$db->fetch_one_row("SELECT church_going, altara_boy, study_status_id, percentage	FROM ".TABLE." WHERE student_ID='".$student_id."'"); 
		   
		  $hobbies_arr = getResultArray("SELECT * FROM ".MTABLE."student_interests WHERE  student_ID = $student_id AND type= 'hobbies' ORDER BY interests_ID");
		   $likes_arr = getResultArray("SELECT * FROM ".MTABLE."student_interests WHERE  student_ID = $student_id  AND type= 'likes' ORDER BY interests_ID");
		    $dislikes_arr = getResultArray("SELECT * FROM ".MTABLE."student_interests WHERE  student_ID = $student_id AND type= 'dislikes' ORDER BY interests_ID");
			 $qualities_arr = getResultArray("SELECT * FROM ".MTABLE."student_qualities WHERE  student_ID = $student_id  ORDER BY quality_ID");
 ?>
<a  onclick="display_type('../ajax/ajax_view.php','display_view','personal')"  class="studtab">Personal</a>
<a  onclick="display_type('../ajax/ajax_view.php','display_view','family')" class="studtabactive">Family</a>
<a onclick="display_type('../ajax/ajax_view.php','display_view','interests')" class="studtab">Interests</a>
</br>

<div class="col-sm-6 col-md-6">
					<div class="block">
						<div class="header no-border">
							<h2>Qualities And Hobbies</h2>
						</div>
						
                        <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Church Going</label>
                <div class="col-sm-6"><?php 
				 foreach($church_going_list as $key=> $value){ if($key==$church_going){ echo $value;}}
				  ?></div>
              	</div>
                
                
                 <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Altara Boy</label>
                <div class="col-sm-6"> <?php if($altara_boy=='1'){ echo 'Yes';} else { echo 'No'; }?></div>
              	</div>
                
                <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Church Going</label>
                <div class="col-sm-6"> <?php 
				 foreach($study_status_list as $key=> $value){
					 
				   if($key==$study_status_id){ echo $value;}}
				  ?></div>
              	</div>
                 <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Percentage of Marks</label>
                <div class="col-sm-6"> <?php echo $percentage; ?></div>
              	</div>
						<div class="content no-padding">
							<table class="red">
								<thead>
									
								</thead>
								<tbody class="no-border-x">
									<tr>
										<td style="width:40%;"><i class="fa fa-sitemap"></i> Qualities</td>
                                         <?php 
				$j=0;
				  foreach($qualities_list as $key=>$value){  
					  if($key==$qualities_arr[$j]['questions']){
							?>
										<td class="text-right"><?php echo $value;?></td>
									<?php
					  }
				  }?>
									</tr>
									<tr>
										<td><i class="fa fa-tasks"></i> Likes</td>
                                        <?php  foreach($likes_arr as $likes){ ?>
										<td class="text-right"><?php echo $likes['name'];?></td>
										<?php }?>
									</tr>
									<tr>
										<td><i class="fa fa-signal"></i> Hobbies</td>
                                        <?php  foreach($hobbies_arr as $hoby){?>
										<td class="text-right"><?php echo $hoby['name'];?></td>
										<?php }?>
									</tr>
									<tr>
										<td><i class="fa fa-tasks"></i>Dislikes</td>
                                        <?php  foreach($dislikes_arr as $dis){
					  ?>
										<td class="text-right"><?php echo $dis['name'];?></td>
                                        <?php
										}
										?>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
            
          <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
              <input type="hidden" name="student_id" id="student_id" value="<?php echo $student_id;?>">
               <div class="col-sm-offset-2 col-sm-10"><a  onclick="display_type('../ajax/ajax_view.php','display_view','family')" class="btn btn-primary wizard-next">Back</a></div>
                </div>
              </div>  
 <?php 
 }
 else if($by_type=='personal'){
	  list($student_id, $name, $mst_id, $place, $post_code, $district, $state, $country, $route_to_house, $dob, $land_phone, $cell_phone, $email,  $fb, $whats_up, $school_teacher_name, $school_name, $parish_id, $parish_teacher_id, $description, $study_status_id, $student_category) = $db->fetch_one_row("SELECT student_ID, name, mst_id, place, post_code, district, state, country, route_to_house, dob, land_phone, cell_phone, email,  fb, whats_up, school_teacher_name, school_name, parish_ID, teacher_ID, description, study_status_id, student_category_id FROM ".TABLE." WHERE student_ID='".$student_id."'");
 ?>
   <a   class="studtabactive">Personal</a>
<a onclick="display_type('../ajax/ajax_view.php','display_view','family')" class="studtab">Family</a>
<a onclick="display_type('ajax/ajax_view.php','display_view','interests')" class="studtab">Interests</a>
          
          <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Name</label>
                <div class="col-sm-6">  <?php echo $name; ?></div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Email</label>
                <div class="col-sm-6"> <?php echo $email; ?></div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Cell Phone</label>
                <div class="col-sm-6"> <?php echo $cell_phone; ?></div>
              </div>



				<div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Land Phone</label>
                <div class="col-sm-6"><?php echo $land_phone; ?></div>
              	</div>
                
                   
              
              <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">MST ID</label>
                <div class="col-sm-6">  <?php echo $mst_id; ?></div>
              </div>



				<div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">DOB</label>
                <div class="col-sm-6"> <?php echo $dob; ?></div>
              	</div>
                
                 <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">MST ID</label>
                <div class="col-sm-6">  <?php echo $place; ?></div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Parish</label>
                <div class="col-sm-6"> <?php 
					  $parish_arr=getResultArray("SELECT parish_ID, name FROM ".MTABLE."parish WHERE parish_status = 1  ORDER BY parish_ID asc "); 
				 foreach($parish_arr as $row){
				 if($row['parish_ID']==$parish_id){ echo $row['name']; } } ?></div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Parish Teacher Name</label>
                <div class="col-sm-6">   <?php $teachers_arr=getResultArray("SELECT teacher_ID, name FROM ".MTABLE."teachers WHERE teacher_status = 1  ORDER BY teacher_ID asc "); 
				 foreach($teachers_arr as $row){
				  ?>
				   <?php if($row['teacher_ID']==$parish_teacher_id){ echo $row['name']; } }?></div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">District</label>
                <div class="col-sm-6">   <?php echo $district; ?></div>
              </div>
              
                <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">State</label>
                <div class="col-sm-6">   <?php echo $state; ?></div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Country</label>
                <div class="col-sm-6">   <?php echo $state; ?></div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Post Code</label>
                <div class="col-sm-6">  <?php echo $post_code; ?></div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Route To House</label>
                <div class="col-sm-6">    <?php echo $route_to_house; ?></div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Face Book</label>
                <div class="col-sm-6">  <?php echo $fb; ?></div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Whats Up</label>
                <div class="col-sm-6">  <?php echo $whats_up; ?></div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">School Name</label>
                <div class="col-sm-6">  <?php echo $school_name; ?></div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">School Teacher Name</label>
                <div class="col-sm-6">  <?php echo $school_teacher_name; ?></div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">School Name</label>
                <div class="col-sm-6">  <?php echo $school_name; ?></div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Descriptions</label>
                <div class="col-sm-6">  <?php echo $description; ?></div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Student Category</label>
               <?php 
				 foreach($student_category_list as $key=> $value){
				  ?>
				  <?php if($key==$student_category){ echo $value;}
				 }?></div>
       <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
              <input type="hidden" name="student_id" id="student_id" value="<?php echo $student_id;?>">
               <div class="col-sm-offset-2 col-sm-10"><a  href="students.php" class="btn btn-primary wizard-next">Back</a></div>
                </div>
              </div>   
 
 <?php }
 ?>