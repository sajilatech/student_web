<?php require('../application_top.php');
define('TABLE',MTABLE.'students');
define('FAMILYTBL',MTABLE.'family'); 
define('SIBLINGSTBL',MTABLE.'student_siblings');
define('QUALITYTBL',MTABLE.'student_qualities');
define('INTERESTTBL',MTABLE.'student_interests');
 $by_type = $_POST['by_id'];
 $action=$_POST['doaction'];
 if($by_type=='family'){
	  $name=$_POST['name'];
		 $email=$_POST['email'];
		 $cell_phone=$_POST['cell_phone'];
		 $land_phone=$_POST['land_phone'];
		 $mst_id=$_POST['mst_id'];
		 $dob=$_POST['dob'];
		 $place=$_POST['place'];
		 $district=$_POST['district'];
		 $state=$_POST['state'];
		 $country=$_POST['country'];
		 $whats_up=$_POST['whats_up'];
		 $fb=$_POST['fb'];
		 $route_to_house=$_POST['route_to_house'];
		 $school_teacher_name=$_POST['school_teacher_name'];
		 $school_name=$_POST['school_name'];
		 $parish_id=$_POST['parish_id'];
		  $parish_teacher=$_POST['parish_teacher'];
		 $description=$_POST['description'];
		 $student_category=$_POST['student_category'];
		 $post_code=$_POST['post_code'];
 
		$_SESSION['personal'] = array('name'=>$name,
		'email' => $email,
		'cell_phone' =>$cell_phone,
		'land_phone'=>$land_phone,
		 'land_phone' =>$land_phone,
		 'mst_id'=>$mst_id,
		'dob'=>$dob,
		'place'=>$place,
		'district'=>$district,
		'state'=>$state,
		'country'=>$country,
		'whats_up'=>$whats_up,
		'fb'=>$fb,
		'route_to_house'=>$route_to_house,
		'school_teacher_name'=>$school_teacher_name,
		'school_name'=>$school_name,
		'parish_id'=>$parish_id,
		'parish_teacher_id'=>$parish_teacher,
		'description'=>$description,
		'student_category'=>$student_category,'post_code'=>$post_code
		 );
	 if($action == 'update'){
		
	/* }
	 else{*/
		 $student_id=$_POST['student_id']; 
		   list($family_name, $family_financial_status, $family_id, $reputation, $relation_with_parish_id)=$db->fetch_one_row("SELECT family_name, family_financial_status, family_id, reputation, relation_with_parish_id	FROM ".FAMILYTBL." WHERE student_ID='".$student_id."'");
		    list($siblings_name, $siblings_occupation, $relation_with_student)=$db->fetch_one_row("SELECT siblings_name, siblings_occupation, relation_with_student	FROM ".SIBLINGSTBL." WHERE student_ID='".$student_id."'");
			 
		 }
 ?><a    class="studtab">Personal</a>
<a  class="studtabactive">Family</a>
<a onclick="display_type('../ajax/ajax_display_type.php','display_type','interests')" class="studtab">Interests</a>
</br>
     <div class="form-group">
                <label class="col-sm-3 control-label">Family Name <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="family_name" id="family_name"  title="Family Name" value="<?php echo $family_name; ?>" class="form-control" >
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Famly Financial Status <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                
                   <select name="family_financial_status" id="family_financial_status" class="form-control" >
                  <option value="">--Select Family Financial Status--</option>
                  <?php foreach($family_financial_status_list as $key=>$value){?>
                   <option value="<?php echo $key ;?>" <?php echo (($key==$family_financial_status)?'selected="selected"':'') ?> ><?php echo $value; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Family Reputation in Parish<span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                    <select name="reputation" id="reputation" class="form-control" >
                  <option value="">--Select Family Reputation in Parish--</option>
                  <?php foreach($reputation_list as $key=>$value){?>
                   <option value="<?php echo $key ;?>" <?php echo (($key==$reputation)?'selected="selected"':'') ?> ><?php echo $value; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Relation with parish <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 
                   <select name="relation_with_parish" id="relation_with_parish" class="form-control" >
                  <option value="">Select Relation with Parish</option>
                     <?php 
				 foreach($relation_with_parish_list as $key=> $value){
				  ?>
				  <option value="<?php echo $key ;?>" <?php echo (($key==$relation_with_parish_id)?'selected="selected"':'') ?> ><?php echo $value; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Sibling's  Name </label>
                <div class="col-sm-6">
                  <input type="text" name="siblings_name" id="siblings_name"  title="Siblings" value="<?php echo $siblings_name; ?>" class="form-control">
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Sibling's Occupation </label>
                <div class="col-sm-6">
                  <input type="text" name="siblings_occupation" id="siblings_occupation"  title="Occupation" value="<?php echo $siblings_occupation; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Relation with the student</label>
                <div class="col-sm-6">
                  <input type="text" name="relation_with_student" id="relation_with_student"  title="Relation" value="<?php echo $relation_with_student; ?>" class="form-control">
                </div>
              </div>
               <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
               <input type="hidden" name="select_id"  id="select_id" value="<?php echo $student_id; ?>">
                <input type="hidden" name="doaction" id="doaction" value="<?php echo $action; ?>">
               <!-- <button type="button" class="btn btn-primary" onClick="display_type('../ajax/ajax_display_type.php','display_type','interests')">Next</button>-->
                 <a onclick="display_type('../ajax/ajax_display_type.php','display_type','interests')" class="btn btn-primary">Next</a>
                <!--  <button type="submit" class="btn btn-default">Submit</button>-->
               <!-- <button type="reset" class="btn btn-default">Reset</button>-->
              </div>
              </div>
 <?php
 }
 else if($by_type=='interests'){ 
	// if($action == 'insert'){
		 $family_name=$_POST['family_name'];
		$family_financial_status=$_POST['family_financial_status'];
		$reputation=$_POST['reputation'];
		$relation_with_parish=$_POST['relation_with_parish'];
		$siblings_name=$_POST['siblings_name'];
		$siblings_occupation=$_POST['siblings_occupation'];
		$relation_with_student=$_POST['relation_with_student'];
		
		$_SESSION['family'] = array('family_name'=>$family_name,
		'family_financial_status' => $family_financial_status,
		'reputation' =>$reputation,
		'relation_with_parish'=>$relation_with_parish,
		 'siblings_name' =>$siblings_name,
		 'siblings_occupation'=>$siblings_occupation,
		'relation_with_student'=>$relation_with_student
		);
	 /*}
	 else*/  if($action == 'update'){
		 $student_id=$_POST['student_id'];
		   list($church_going, $altara_boy, $study_status_id, $percentage)=$db->fetch_one_row("SELECT church_going, altara_boy, study_status_id, percentage	FROM ".TABLE." WHERE student_ID='".$student_id."'"); 
		   
		  $hobbies_arr = getResultArray("SELECT * FROM ".MTABLE."student_interests WHERE  student_ID = $student_id AND type= 'hobbies' ORDER BY interests_ID");
		   $likes_arr = getResultArray("SELECT * FROM ".MTABLE."student_interests WHERE  student_ID = $student_id  AND type= 'likes' ORDER BY interests_ID");
		    $dislikes_arr = getResultArray("SELECT * FROM ".MTABLE."student_interests WHERE  student_ID = $student_id AND type= 'dislikes' ORDER BY interests_ID");
			 $qualities_arr = getResultArray("SELECT * FROM ".MTABLE."student_qualities WHERE  student_ID = $student_id  ORDER BY quality_ID");
		 }
 ?>
 <a    class="studtab">Personal</a>
<a  class="studtab">Family</a>
<a  class="studtabactive">Interests</a>
</br>
  <div class="form-group">
                <label class="col-sm-3 control-label">Church Going </label>
                <div class="col-sm-6">
                 <select name="church_going" id="church_going" class="form-control">
                  <option value="">Select Church Going </option>
                     <?php 
				 foreach($church_going_list as $key=> $value){
				  ?>
				  <option value="<?php echo $key ;?>" <?php echo (($key==$church_going)?'selected="selected"':'') ?> ><?php echo $value; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Altara Boy</label>
                <div class="col-sm-6">
                 
                  <div class="radio"> 
                    <label> <input type="radio" value="1" name="altara_boy" <?php if($altara_boy=='1'){ echo 'checked="checked"';}?>> Yes </label> 
                  </div>
                  <div class="radio"> 
                    <label> <input type="radio" value="0"  name="altara_boy"  <?php if($altara_boy=='0'){ echo 'checked="checked"';}?>> No</label> 
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Study Status <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <select name="study_status_id" id="study_status_id" class="form-control" >
                  <option value="">Select Study Status</option>
                     <?php 
				 foreach($study_status_list as $key=> $value){
					 
				  ?>
				  <option value="<?php echo $key ;?>" <?php echo (($key==$study_status_id)?'selected="selected"':'') ?> ><?php echo $value; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Marks Percentage</label>
                <div class="col-sm-6">
                  <input type="text" name="percentage" id="percentage"  title="Percentages" value="<?php echo $percentage; ?>" class="form-control" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Qualities</label>
                <div class="col-sm-6">
                  <div class="radio"> 
                  <?php 
				$j=0;
				  foreach($qualities_list as $key=>$value){  
					  if($key==$qualities_arr[$j]['questions']){
							 $selected='checked="checked"';?>
                              <label> <input type="checkbox"  name="checkbox_<?php echo $key;?>" <?php echo $selected;?> id="checkbox_<?php echo $key;?>" > <?php echo $value;?></label> 
                              
                      <?php
					   $j++;
						 }
						 else{  $selected="";?>
                          <label> <input type="checkbox"  name="checkbox_<?php echo $key;?>" <?php echo $selected;?> id="checkbox_<?php echo $key;?>" > <?php echo $value;?></label> 
						<?php 	 
							}
					  
					  ?>
					 
					
							 
					<?php		
					
					}
					?>
                  </div>
                 
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Other Likes </label>
                
                 <?php 
				  if($action == 'insert'){
				 for($i=1;$i<=3;$i++){
					 ?>
                <div class="col-sm-2">
                  <input type="text" name="likes_<?php echo $i;?>" id="likes_<?php echo $i;?>"  title="Likes"  class="form-control"  style="width:100px;"> </div>
                  
                   <?php
				}
				  }
				  else  if($action == 'update'){
					  $i=1; 
					  foreach($likes_arr as $likes){
					  ?>
                  <div class="col-sm-2">
                  <input type="text" name="likes_<?php echo $i;?>" id="likes_<?php echo $i;?>"  title="Likes"  class="form-control"  value="<?php echo $likes['name'];?>" style="width:100px;"> </div>
                  <?php
				   $i++;
					  }
					  
					    if(count($likes_arr)< 3){
							
							?>
                         <div class="col-sm-2">
                  <input type="text" name="likes_<?php echo $i;?>" id="likes_<?php echo $i;?>"  title="Likes"  class="form-control"  style="width:100px;"> </div>
                  <?php
						}
				  }
				?>
               <!-- </div>-->
                
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Dislikes </label>
                <?php 
				 if($action == 'insert'){
				for($i=1;$i<=3;$i++){?>
                <div class="col-sm-2">
                  <input type="text" name="dislikes_<?php echo $i;?>" id="dislikes_<?php echo $i;?>"  title="Dislikes"  class="form-control" style="width:100px;">
              </div>
               <?php
				}
				}
				else  if($action == 'update'){
					 $i=1; 
					  foreach($dislikes_arr as $dis){
					  ?>
                  <div class="col-sm-2">
                  <input type="text" name="dislikes_<?php echo $i;?>" id="dislikes_<?php echo $i;?>"  title="Dislikes"  class="form-control"  value="<?php echo $dis['name'];?>" style="width:100px;">
               </div>
                <?php
				 $i++;
				 
					  }
					    if(count($dislikes_arr)< 3){?>
                         <div class="col-sm-2">
                  <input type="text" name="dislikes_<?php echo $i;?>" id="dislikes_<?php echo $i;?>"  title="Dislikes"  class="form-control" style="width:100px;">
            </div>
                <?php
						}
				  }
				?>
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Hobbies </label>
                  <?php 
				   if($action == 'insert'){
				  for($i=1;$i<=3;$i++){?>
                <div class="col-sm-2">
                  <input type="text" name="hobbies_<?php echo $i;?>" id="hobbies_<?php echo $i;?>"  title="Hobby"  class="form-control"  style="width:100px;">
                </div>
                 <?php
				}
				   }
				 else  if($action == 'update'){
					 $i=1; 
					  foreach($hobbies_arr as $hoby){
					    
				?>
               <div class="col-sm-2">
                  <input type="text" name="hobbies_<?php echo $i;?>" id="hobbies_<?php echo $i;?>"  title="Hobby"  class="form-control"  value="<?php echo $hoby['name'];?>" style="width:100px;">
              </div>
                
                 <?php 
				 $i++;
					  }
					  if(count($hobbies_arr)< 3){?>
                       <input type="text" name="hobbies_<?php echo $i;?>" id="hobbies_<?php echo $i;?>"  title="Hobby"  class="form-control"  style="width:100px;">
                      <?php
					  }
				  }
				?>
                </div>
              </div>
            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <input type="hidden" name="select_id"  id="select_id" value="<?php echo $student_id; ?>">
               <input type="hidden" name="doaction" id="doaction" value="<?php echo $action; ?>">
               <button type="submit"  class="btn btn-primary">Submit</button>
              </div>
              </div>     
 <?php 
 }
 ?>
 