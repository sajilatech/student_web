<?php
require('../application_top.php');

$id=$_POST['by_id'];
if($id=='student_cat'){
define('STUDENT_CATEGORY_TBL', MTABLE.'student_category_list');
	$cat_name=$_POST['name'];
 	$sql_data_array = array(
						 'category_name' => $cat_name,
						 'status' => '1');

						 $db->insert_from_array($sql_data_array,STUDENT_CATEGORY_TBL);	
?>
<select name="student_category" id="student_category" class="form-control" required>
     <option value="">Select Student Category</option>
                     <?php  $student_category_list=getResultArray("SELECT * FROM ".STUDENT_CATEGORY_TBL."  WHERE status = 1  ORDER BY student_category_ID asc "); 
				 foreach($student_category_list as $row){
				  ?>
				  <option value="<?php echo $row['student_category_ID'] ;?>" <?php echo (($row['student_category_ID']==$student_category)?'selected="selected"':'') ?> ><?php echo $row['category_name']; ?></option>
				     <?php } ?>
    </select>
<?php
}
else if($id=='class'){
	define('CLASS_TBL', MTABLE.'class_list');
	$class_name=$_POST['name'];
 	$sql_data_array = array(
						 'name' => $class_name,
						 'status' => '1');

						 $db->insert_from_array($sql_data_array,CLASS_TBL);	
?>
<select name="class"  id="class" class="form-control" style="width:85%">
     <option value="">--Select Class--</option>
                     <?php $class_list=getResultArray("SELECT * FROM ".CLASS_TBL." WHERE status = 1  ORDER BY class_ID asc ");
				 foreach($class_list as $row){
				  ?>
				  <option value="<?php echo $row['class_ID'] ;?>" <?php echo (($row['class_ID']==$class)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
    </select>

<?php
}
else if($id=='family_financial'){
	define('FAMILY_FINANCIAL_STATUS_TBL', MTABLE.'family_financial_status');
	$family_financial_status=$_POST['name'];
	$sql_data_array = array(
						 'status_name' => $family_financial_status,
						 'status' => '1');

						 $db->insert_from_array($sql_data_array,FAMILY_FINANCIAL_STATUS_TBL);	
?>
<select name="family_financial_status" id="family_financial_status" class="form-control" required >
                  <option value="">--Select Family Financial Status--</option>
                  <?php 
				   $family_financial_status_list=getResultArray("SELECT * FROM ".FAMILY_FINANCIAL_STATUS_TBL." WHERE status = 1  ORDER BY family_financial_status_ID asc ");
				  foreach($family_financial_status_list as $row){?>
                   <option value="<?php echo $row['family_financial_status_ID'] ;?>" <?php echo (($row['family_financial_status_ID']==$family_financial_status)?'selected="selected"':'') ?> ><?php echo $row['status_name']; ?></option>
				     <?php } ?>
                  </select>
<?php
}
else if($id=='reputation_in_parish'){
	define('REPUTATION_TBL', MTABLE.'reputation_list');
	$reputation=$_POST['name'];
	$sql_data_array = array(
						 'name' => $reputation,
						 'status' => '1');
						 $db->insert_from_array($sql_data_array,REPUTATION_TBL);	
?>
<select name="reputation" id="reputation" class="form-control"  >
                  <option value="">--Select Family Reputation in Parish--</option>
                  <?php 
				   $reputation_list=getResultArray("SELECT * FROM ".REPUTATION_TBL." WHERE status = 1  ORDER BY reputation_list_ID asc ");
				  foreach($reputation_list as $row){?>
                   <option value="<?php echo $row['reputation_list_ID'] ;?>" <?php echo (($row['reputation_list_ID']==$reputation)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select>
<?php
}else if($id=='relation_with_p'){
	define('RELATION_WITH_PARISH_TBL', MTABLE.'relation_with_parish');
	$relation=$_POST['name'];
	$sql_data_array = array(
						 'name' => $relation,
						 'status' => '1');
						 $db->insert_from_array($sql_data_array,RELATION_WITH_PARISH_TBL);	
?>
<select name="relation_with_parish" id="relation_with_parish" class="form-control" required >
                  <option value="">Select Relation with Parish</option>
                     <?php 
					 $relation_with_parish_list=getResultArray("SELECT * FROM ".RELATION_WITH_PARISH_TBL." WHERE status = 1  ORDER BY relation_with_parish_ID asc "); 
				 foreach($relation_with_parish_list as $row){
				  ?>
				  <option value="<?php echo $row['relation_list_ID'] ;?>" <?php echo (($row['relation_list_ID']==$relation_with_parish_id)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select>
<?php
} else if($id=='church_g'){
	define('CHURCH_GOING_TBL', MTABLE.'church_going_list');
	$church_going_field=$_POST['name'];
	$sql_data_array = array(
						 'status_name' => $church_going_field,
						 'status' => '1');
						  $db->insert_from_array($sql_data_array,CHURCH_GOING_TBL);	
?>
<select name="church_going" id="church_going" class="form-control" required>
                  <option value="">Select Church Going </option>
                     <?php 
					  $church_going_list=getResultArray("SELECT * FROM ".CHURCH_GOING_TBL." WHERE status = 1  ORDER BY church_going_ID asc "); 
				 foreach($church_going_list as $row){
				  ?>
				  <option value="<?php echo $row['church_going_ID'] ;?>" <?php echo (($row['church_going_ID']==$church_going)?'selected="selected"':'') ?> ><?php echo $row['status_name']; ?></option>
				     <?php } ?>
                  </select>
<?php
} else if($id=='quality'){
	define('QUALITIES_LIST_TBL', MTABLE.'qualities_list');
	$quality_field=$_POST['name'];
	$sql_data_array = array(
						 'name' => $quality_field,
						 'status' => '1');
						  $db->insert_from_array($sql_data_array,QUALITIES_LIST_TBL);	
?>
<?php
	 $qualities_list=getResultArray("SELECT * FROM ".QUALITIES_LIST_TBL." WHERE status = 1  ORDER BY qualities_list_ID asc ");  
				$j=0;
				  foreach($qualities_list as $row){  
					  if($row['qualities_list_ID']==$qualities_arr[$j]['questions']){
							 $selected='checked="checked"';?>
                              <label> <input type="checkbox"  name="checkbox_<?php echo $row['qualities_list_ID'];?>" <?php echo $selected;?> id="checkbox_<?php echo $row['qualities_list_ID'];?>" > <?php echo $row['name'];?></label> 
                              
                      <?php
					   $j++;
						 }
						 else{  $selected="";?>
                          <label> <input type="checkbox"  name="checkbox_<?php echo $row['qualities_list_ID'];?>" <?php echo $selected;?> id="checkbox_<?php echo $row['qualities_list_ID'];?>" > <?php echo $row['name'];?></label> 
						<?php 	 
							}
					  
					  ?>
					 
					
							 
					<?php		
					
					}
}
else if($id=='s_syllabus'){
	define('SCHOOL_SYLLABUS_TBL', MTABLE.'school_syllabus_list');
	$syllabus_field=$_POST['name'];
	$sql_data_array = array(
						 'name' => $syllabus_field,
						 'status' => '1');
						  $db->insert_from_array($sql_data_array,SCHOOL_SYLLABUS_TBL);	
					?>
                    <select name="school_syllabus" id="school_syllabus" class="form-control" required>
      <option value="">--Select Syllabus--</option>
                     <?php $school_syllabus_list=getResultArray("SELECT * FROM ".SCHOOL_SYLLABUS_TBL." WHERE status = 1  ORDER BY school_syllabus_ID asc ");
				 foreach($school_syllabus_list as $row){
				  ?>
				  <option value="<?php echo $row['school_syllabus_ID'];?> ;?>" <?php echo (($row['school_syllabus_ID']==$school_syllabus)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
    </select>
 <?php
}
else if($id=='name_title'){ 
	define('NAME_TITLE_TBL', MTABLE.'name_title_list');
	$name_title=$_POST['name'];
	$sql_data_array = array(
						 'name' => $name_title,
						 'status' => '1');
						  $db->insert_from_array($sql_data_array,NAME_TITLE_TBL);
					 $title_list=getResultArray("SELECT * FROM ".NAME_TITLE_TBL." WHERE status = 1  ORDER BY name_title_ID asc ");
?>
  <select name="name_title" id="name_title" class="form-control" style="width:85%">
      <option value="">--Select Title--</option>
                     <?php 
					
				 foreach($title_list as $title){ 
				  ?>
				  <option value="<?php echo $title['name_title_ID'];?> ;?>" <?php echo (($title['name_title_ID']==$name_title)?'selected="selected"':'') ?> ><?php echo $title['name']; ?></option>
				     <?php } ?>
    </select>
<?php
}
else if($id=='exam_model'){
	define('EXAM_MODEL_TBL', MTABLE.'exam_model_list');
	$model_field=$_POST['name'];
	$sql_data_array = array(
						 'name' => $model_field,
						 'status' => '1');
						  $db->insert_from_array($sql_data_array,EXAM_MODEL_TBL);
?>
<select name="exam_model" id="exam_model" class="form-control">
                      <option value="">----Select Model----</option>
                      <?php  $exam_model_list=getResultArray("SELECT * FROM ".EXAM_MODEL_TBL." WHERE status = 1  ORDER BY exam_model_list_ID asc ");  
					  foreach($exam_model_list as $row){?>
                      <option value="<?php echo $row['exam_model_list_ID'];?>" <?php if($exam_model == $row['exam_model_list_ID']){?>selected="selected" <?php }?>><?php echo $row['name'];?></option>
                       <?php }?>
                       </select>
<?php
}else if($id=='study_status'){
	define('STUDY_STATUS_TBL', MTABLE.'study_status_list');
	$study_status=$_POST['name'];
	$sql_data_array = array(
						 'status_name' => $study_status,
						 'status' => '1');
						  $db->insert_from_array($sql_data_array,STUDY_STATUS_TBL);
?>
<select name="study_status_id" id="study_status_id" class="form-control"  >
                  <option value="">Select Study Status</option>
                     <?php 
					  $study_status_list=getResultArray("SELECT * FROM ".STUDY_STATUS_TBL." WHERE status = 1  ORDER BY study_status_ID asc "); 
				 foreach($study_status_list as $row){
					 
				  ?>
				  <option value="<?php echo $row['study_status_ID'] ;?>" <?php echo (($row['study_status_ID']==$study_status_id)?'selected="selected"':'') ?> ><?php echo $row['status_name']; ?></option>
				     <?php } ?>
                  </select>
<?php
}else if($id=='diocese_add'){
	define('DIOCESE_TBL', MTABLE.'diocese');
	$diocese_field=$_POST['name'];
	$sql_data_array = array(
						 'diocese_name' => $diocese_field,
						  'added_date' => time(), 
						 'diocese_status' => '1');
						  $db->insert_from_array($sql_data_array,DIOCESE_TBL);
?>
<select name="study_status_id" id="study_status_id" class="form-control" style=" width:85px;"  >
                  <option value="">Select Diocese</option>
                     <?php 
					  $diocese_arr=getResultArray("SELECT * FROM ".DIOCESE_TBL." WHERE diocese_status = 1  ORDER BY diocese_ID asc "); 
				 foreach($diocese_arr as $row){
					 
				  ?>
				  <option value="<?php echo $row['diocese_ID'] ;?>" <?php echo (($row['diocese_ID']==$diocese_id)?'selected="selected"':'') ?> ><?php echo $row['diocese_name']; ?></option>
				     <?php } ?>
                  </select>
<?php
}
else if($id=='interest_to_priest'){
	define('INTEREST_TO_BE_PRIEST_TBL', MTABLE.'interest_to_be_priest');
	$interest_to_field=$_POST['name'];
	$sql_data_array = array(
						 'name' => $interest_to_field,
						 'status' => '1');
						  $db->insert_from_array($sql_data_array,INTEREST_TO_BE_PRIEST_TBL);
?>
<select name="interest_to_be_priest"  id="interest_to_be_priest" class="form-control " >
    <option value="">Select Interest Status</option>
                     <?php 
					  $interest_to_be_priest_list=getResultArray("SELECT * FROM ".INTEREST_TO_BE_PRIEST_TBL." WHERE status = 1  ORDER BY interest_to_be_priest_ID asc ");  
				 foreach($interest_to_be_priest_list as $row){
				  ?>
				  <option value="<?php echo $row['interest_to_be_priest_ID'] ;?>" <?php echo (($row['interest_to_be_priest_ID']==$interest_to_be_priest)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select>

<?php
}
else if($id=='question_type'){
	define('QUESTION_TYPE_TBL', MTABLE.'question_type_list');
	$question_type=$_POST['name'];
	$sql_data_array = array(
						 'name' => $question_type,
						 'status' => '1');
						  $db->insert_from_array($sql_data_array,QUESTION_TYPE_TBL);
						   $question_type_list=getResultArray("SELECT * FROM ".QUESTION_TYPE_TBL." WHERE status = 1  ORDER BY question_type_ID asc ");
		   
				 foreach($question_type_list as $row){
					 
?>
 <h3> <?php echo $row['name']; ?></h3>
<?php }?>
<?php /*?><select name="question_type" id="question_type" class="form-control"  >
                  <option value="">Select Type</option>
                     <?php 
					 $question_type_list=getResultArray("SELECT * FROM ".QUESTION_TYPE_TBL." WHERE status = 1  ORDER BY question_type_ID asc "); 
					 
				 foreach($question_type_list as $row){
				  ?>
				  <option value="<?php echo $row['question_type_ID'] ;?>" <?php echo (($row['question_type_ID']==$question_type_id)?'selected="selected"':'') ?> ><?php echo $row['name'];; ?></option>
				     <?php } ?>
                  </select><?php */?>
<?php
}
else if($id=='family_prayer_conduct'){
	define('FAMILY_PRAYER_TBL', MTABLE.'family_prayer_list');

$family_prayer_field=$_POST['name'];
	$sql_data_array = array(
						 'name' => $family_prayer_field,
						 'status' => '1');
						  $db->insert_from_array($sql_data_array,FAMILY_PRAYER_TBL);
?>
<select name="family_prayer" id="family_prayer" class="form-control"  >
                  <option value="">Select Status</option>
                     <?php 
					 $family_prayer_list=getResultArray("SELECT * FROM ".FAMILY_PRAYER_TBL." WHERE status = 1  ORDER BY family_prayer_ID asc "); 
					 
				 foreach($family_prayer_list as $row){
				  ?>
				  <option value="<?php echo $row['family_prayer_ID'] ;?>" <?php echo (($row['family_prayer_ID']==$family_prayer)?'selected="selected"':'') ?> ><?php echo $row['name'];; ?></option>
				     <?php } ?>
                  </select>
<?php
}
else if($id=='kurbana_attend'){
	define('KURBANA_ATTEND_TBL', MTABLE.'kurbana_attend_list');

$kurbana_attend_field=$_POST['name'];
	$sql_data_array = array(
						 'name' => $kurbana_attend_field,
						 'status' => '1');
						  $db->insert_from_array($sql_data_array,KURBANA_ATTEND_TBL);
?>
<select name="kurbana_attend" id="kurbana_attend" class="form-control"  >
                  <option value="">Select Status</option>
                     <?php 
					 $kurbana_attend_list=getResultArray("SELECT * FROM ".KURBANA_ATTEND_TBL." WHERE status = 1  ORDER BY kurbana_attend_ID asc "); 
					 
				 foreach($kurbana_attend_list as $row){
				  ?>
				  <option value="<?php echo $row['kurbana_attend_ID'] ;?>" <?php echo (($row['kurbana_attend_ID']==$kurbana_attend)?'selected="selected"':'') ?> ><?php echo $row['name'];; ?></option>
				     <?php } ?>
                  </select>
<?php
}
?>