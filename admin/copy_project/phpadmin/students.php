<?php
require('../application_top.php');
define('MODULEID','6');
define('MODULE_TITLE','Students');
require(DIR_ADMIN_INCLUDE.'session.php');
define('TABLE',MTABLE.'students');
define('FAMILYTBL',MTABLE.'family');
define('RELATIONSTBL',MTABLE.'student_relations');
define('QUALITYTBL',MTABLE.'student_qualities');
define('INTERESTTBL',MTABLE.'student_interests');
define('CONFI_TBL', MTABLE.'confidential_reports');
define('EXAM_RESULT_TBL', MTABLE.'exam_results');
define('EXAMTBL', MTABLE.'exams');
define('VP_TBL', MTABLE.'vp');
define('QUES_ANS_TBL', MTABLE.'questions_answers');
define('TEACHER_COMMENT_TBL', MTABLE.'teacher_comments');

/*--------------Select box tables----------------*/
define('QUESTION_TYPE_TBL', MTABLE.'question_type_list');
define('RELATION_WITH_PARISH_TBL', MTABLE.'relation_with_parish');
define('CHURCH_GOING_TBL', MTABLE.'church_going_list');
define('STUDY_STATUS_TBL', MTABLE.'study_status_list');
define('QUALITIES_LIST_TBL', MTABLE.'qualities_list');
define('INTEREST_TO_BE_PRIEST_TBL', MTABLE.'interest_to_be_priest');
define('EXAM_MODEL_TBL', MTABLE.'exam_model_list');
define('SCHOOL_SYLLABUS_TBL', MTABLE.'school_syllabus_list');
define('CLASS_TBL', MTABLE.'class_list');
define('STUDENT_CATEGORY_TBL', MTABLE.'student_category_list');
define('REPUTATION_TBL', MTABLE.'reputation_list');
define('FAMILY_FINANCIAL_STATUS_TBL', MTABLE.'family_financial_status');

$GrpPage = 3;

#################### 
# Actions

switch($doaction)
{
	case 'insert':
		
	
		
		if($altara_boy == ''){
			$altara_boy=0;
		}
		if($camp_attended =='on'){
						$c='1';
		}
		else {
			$c='0';
			}
						$file_name=upload_files('file','../uploads/profile/');
						if($file_name ==''){
							$file_name=0;
						}
						
						 $sql_data_array = array(
						 'name' => $name,
						  'baptism_name' => $baptism_name,
						  'nick_name' =>$nick_name,
						 'name_title' => $name_title,
						 'mst_id' => $mst_id,
						 'house_name' => $house_name,
						 'place' => $place,
						 'post_code' => $post_code,
						 'post_box'=>$post_box,
						 'post_office'=>$post_office, 
						 'district' => $district,
						 'state' => $state,
						 'country' => $country,
						 'post_code' => $post_code,
						 'route_to_house' => $route_to_house, 
						 'dob' => strtotime($dob) ,
						 'land_phone' => $land_phone, 
						 'cell_phone' => $cell_phone,
						 'email' => $email, 
						 'fb' => $fb, 
						 'whats_up' => $whats_up, 
						 'school_teacher_name' => $school_teacher_name, 
						 'school_teacher_phone' => $school_teacher_phone,
						 'school_name' => $sunday_school, 
						 'parish_ID' => $parish_id, 
						 'teacher_ID' => $parish_teacher_id, 
						 'description' => $description, 
						 'altara_boy'=>$altara_boy,
						 'catechism_class'=>$catechism_class,
						 'from_class'=>$from_class,
						 'interest_to_be_priest' => $interest_to_be_priest,
						 'study_status_id'=>$study_status_id,
						 'percentage'=>$percentage,
						 'school_syllabus' => $school_syllabus,
						 'class'=>$class,
						 'student_category_id'=>$student_category,
						 'awards_received'=> $awards_received,
						 'date'=>strtotime($date),
						 'nuns_family'=>$nuns_family,
						 'priests_family'=>$priests_family,
						 'camp_attended' => $c, 
						 'profile_image'=>$file_name,
						 'student_added_date' =>time(), 
						 'student_updated_date' => time());
						$db->insert_from_array($sql_data_array,TABLE);	 
						$insert_id = $db->insert_id();
						//$insert_id=10;
						
						 $sql_vp_data_array = array(
						 'vp_name' => $vp_name,
						 'vp_phone' => $vp_phone,
						 'vp_address' => $vp_address,
						 'vp_whatsup' => $vp_whatsup,
						  'vp_fb' => $vp_fb,
						 'student_ID'=> $insert_id);
						 
						$db->insert_from_array($sql_vp_data_array,VP_TBL);
						
						 $sql_data_array = array(
						 'teacher_ID' => $parish_teacher_id,
						 'student_ID'=> $insert_id,
						 'comments'=>$teacher_comment,
						 'added_date' => time());

						 $db->insert_from_array($sql_data_array,TEACHER_COMMENT_TBL);	 
						 
						 $sql_family_data_array = array(
						 'family_name' => $family_name,
						 'family_financial_status' => $family_financial_status,
						 'reputation' => $reputation,
						 'relation_with_parish_id' => $relation_with_parish,
						 'student_ID'=> $insert_id);
						$db->insert_from_array($sql_family_data_array,FAMILYTBL);
						
						 
						 if($father_name !=''){	
						  $sql_father_data_array = array(
						 'relation_name' => $father_name,
						 'nick_name' =>$nick_name,
						 'relation_occupation' => $father_occupation,
						 'relation_phone'=>$father_mobile,
						 'relation_with_student' => 'father',
						 'student_ID'=> $insert_id); 
						$db->insert_from_array($sql_father_data_array,RELATIONSTBL);
						 }
						
						if($mother_name !=''){
						$sql_mother_data_array = array(
						 'relation_name' => $mother_name,
						 'nick_name' =>$nick_name,
						 'relation_occupation' => $mother_occupation,
						 'relation_phone'=>$mother_mobile,
						 'relation_with_student' => 'mother',
						 'student_ID'=> $insert_id); 
						$db->insert_from_array($sql_mother_data_array,RELATIONSTBL);
						}
						
						if($guardian_father != '')	{
							  $sql_guardian_parent_data_array = array(
						 'relation_name' => $guardian_father,
						 'nick_name' =>$nick_name,
						 'relation_occupation' => $guardian_father_occupation,
						 'relation_phone'=>'0',
						 'relation_with_student' => 'grand parent',
						 'student_ID'=> $insert_id); 
						$db->insert_from_array($sql_guardian_parent_data_array,RELATIONSTBL);
						}
						
						if($siblings_no >0 ){ 
						for($i=1; $i<= $siblings_no; $i++){ 
							if($_POST['sibling_name_'.$i] !=''){
							 $sql_siblings_data_array = array(
							 'relation_name' => $_POST['sibling_name_'.$i],
							  'relation_age' => $_POST['age_'.$i],
							 'relation_education' => $_POST['education_'.$i],
							 'relation_occupation' => $_POST['occupation_'.$i],
							 'relation_phone'=>'0',
							 'relation_with_student' => $_POST['relation_with_student'.$i],
							 'sibling'=>'1', 
							 'student_ID'=> $insert_id
							 );
							 $db->insert_from_array($sql_siblings_data_array,RELATIONSTBL); 
							}
						}
						}
						
						 
						 if(!empty($qualities_list)){
						 foreach($qualities_list as $key=>$value){
							 if($_POST['checkbox_'.$key]=='on'){
								   $sql_qualities_data_array = array(
						 			'questions' => $key,
									 'answers' => '1',
						 			'status' => 1,
									 'student_ID'=> $insert_id);
									 $db->insert_from_array($sql_qualities_data_array,QUALITYTBL);
								}
							 
						  } 
						 } 
						 $like_arr= array();
						$likes = $_POST['likes'];
	 					$like_arr=explode(',',$likes,4);
						  $like_count=count($like_arr); 
							for($i=0;$i<=$like_count;$i++){ 
						  	if($like_arr[$i] !=""){ 
							   $sql_likes_data_array = array(
						 			'type' =>'likes',
									 'name' => $like_arr[$i],
									 'student_ID'=> $insert_id);
									 $db->insert_from_array($sql_likes_data_array,INTERESTTBL);
							}
							}
							$dislike_arr= array();
						$dislikes = $_POST['dislikes']; 
	 					$dislike_arr=explode(',',$dislikes,4);
						  $dislike_count=count($dislike_arr); 
							 for($i=0;$i<=$dislike_count;$i++){ 
							  if($dislike_arr[$i] !=""){
							   $sql_dislikes_data_array = array(
						 			'type' =>'dislikes',
									 'name' => $dislike_arr[$i],
									 'student_ID'=> $insert_id);
									  $db->insert_from_array($sql_dislikes_data_array,INTERESTTBL);
							  }
							} 
							$hobbies_arr= array();
						$hobbies = $_POST['hobbies'];
	 					$hobbies_arr=explode(',',$hobbies,4);
						$hobbies_count=count($hobbies_arr); 
							 for($i=0;$i<=$hobbies_count;$i++){ 
							  if($hobbies_arr[$i] !=""){
							   $sql_hobbies_data_array = array(
						 			'type' =>'hobbies',
									 'name' => $hobbies_arr[$i],
									 'student_ID'=> $insert_id);
									  $db->insert_from_array($sql_hobbies_data_array,INTERESTTBL);
							  }
							}
							
							if($exam_model !=''){
								$sql_exam_array = array(
									'exam_type'=>'Academic', 
									 'exam_model' =>$exam_model,
									 'exam_date'=>$exam_date,
									  'description'=>'',
									 'student_ID' => $insert_id
								);
								 $db->insert_from_array($sql_exam_array,EXAMTBL);
							$exam_pri_id = $db->insert_id(); 
								if($exam_pri_id !=''){ 
							
									for($i=1;$i<=$no_subjects;$i++){ 	
										if($_POST['subjects_'.$i] !=''){
											$sql_exam_result_array = array(
												'exam_ID' =>$exam_pri_id,
												 'subjects' => $_POST['subjects_'.$i],
												 'marks'=> $_POST['marks_'.$i]); 
												  $db->insert_from_array($sql_exam_result_array,EXAM_RESULT_TBL); 
										}
									}
								}
							}
							
							  $sql_confidential_data_array = array(
						 			 'student_ID' => $insert_id,
									 'title' => $title,
									 'interview_comments'=>$interview_comments,
									 'interviewed_by' =>$interviewed_by,
									 'psychological_results' => $psychological_results,
									 ); 
						   $db->insert_from_array($sql_confidential_data_array,CONFI_TBL);
						   
						   $counter=count($_POST['question']); 
						for($i=0; $i<$counter; $i++){
							
							$sql_ques_ans_data_array = array(
							 'questions' => $_POST['question'][$i],
							 'answers' => $_POST['answer'][$i],
							 'student_ID' => $select_id,
							 'question_type_ID' => $question_type
							  );
							  
							$db->insert_from_array($sql_ques_ans_data_array,QUES_ANS_TBL);
						}
						 redirect('students.php','');
				  		 break;

	case 'update':
				      if((int)$select_id == 0) redirect();
					  if($_FILES['file']['name'] !=''){ 
					  	$file_name=upload_files('file','../uploads/profile/');
					  }
					  else{
						  $file_name=0;
					  }
					 
					if($camp_attended =='on'){
						$c='1';
					}
					else {
						$c='0';
						}
						
					
						 $sql_data_array = array(
						 'name' => $name,
						 'baptism_name' => $baptism_name,
						  'nick_name' =>$nick_name,
						 'mst_id' => $mst_id,
						  'house_name' => $house_name,
						 'place' => $place,
						 'post_code' => $post_code,
						 'post_box'=>$post_box,
						 'post_office'=>$post_office, 
						 'district' => $district,
						 'state' => $state,
						 'country' => $country,
						 'post_code' => $post_code,
						 'route_to_house' => $route_to_house, 
						 'dob' => strtotime($dob) ,
						 'land_phone' => $land_phone, 
						 'cell_phone' => $cell_phone,
						 'email' => $email, 
						 'fb' => $fb, 
						 'whats_up' => $whats_up, 
						 'school_teacher_name' => $school_teacher_name, 
						 'school_teacher_phone' => $school_teacher_phone,
						 'school_name' => $sunday_school, 
						 'parish_ID' => $parish_id, 
						 'teacher_ID' => $parish_teacher_id, 
						 'description' => $description, 
						 'altara_boy'=>$altara_boy,
						  'catechism_class'=>$catechism_class,
						 'from_class'=>$from_class,
						 'interest_to_be_priest' => $interest_to_be_priest,
						 'study_status_id'=>$study_status_id,
						 'percentage'=>$percentage,
						 'school_syllabus' => $school_syllabus,
						 'class'=>$class,
						 'student_category_id'=>$student_category,
						 'awards_received'=> $awards_received,
						 'date'=>strtotime($date),
						 'nuns_family'=>$nuns_family,
						 'priests_family'=>$priests_family,
						 'camp_attended' => $c, 
						 'profile_image'=>$file_name,
						 'student_added_date' =>time(), 
						 'student_updated_date' => time());
					 
					  	//$db->update_from_array($sql_data_array,TABLE,'student_ID', $select_id);
						
						if($_POST['question'] >0 ){ 
						 $db->query("DELETE FROM ".QUES_ANS_TBL." WHERE student_ID='".$select_id."' AND question_type_ID = ".$question_type);
							$counter=count($_POST['question']); 
							for($i=0; $i<$counter; $i++){
							
								$sql_ques_ans_data_array = array(
								 'questions' => $_POST['question'][$i],
								 'answers' => $_POST['answer'][$i],
								 'student_ID' => $select_id,
								 'question_type_ID' => $question_type
								  );
							  
							$db->insert_from_array($sql_ques_ans_data_array,QUES_ANS_TBL);
							}
						}
						
						 $sql_vp_data_array = array(
						 'vp_name' => $vp_name,
						 'vp_phone' => $vp_phone,
						 'vp_address' => $vp_address,
						 'vp_whatsup' => $vp_whatsup,
						  'vp_fb' => $vp_fb);
						//$db->update_from_array($sql_vp_data_array,VP_TBL,'student_ID', $select_id);
						
						$sql_teacher_comment_array = array(
						 'teacher_ID' => $parish_teacher_id,
						 'comments'=> $teacher_comment,
						 'student_ID'=>$select_id,
						 'added_date' => time());
						  $db->update_from_array($sql_teacher_comment_array,TEACHER_COMMENT_TBL,'teacher_comment_ID', $teacher_comment_id);
						
						$sql_family_data_array = array(
						 'family_name' => $family_name,
						 'family_financial_status' => $family_financial_status,
						 'reputation' => $reputation,
						 'relation_with_parish_id' => $relation_with_parish);
						 $db->update_from_array($sql_family_data_array,FAMILYTBL,'student_ID',$select_id);	
						 
						  if($father_name !=''){
						  $sql_father_data_array = array(
						 'relation_name' => $father_name,
						 'relation_occupation' => $father_occupation,
						 'relation_phone'=>$father_mobile,
						 'relation_with_student' => 'father',
						 'student_ID'=> $select_id);
						 $db->update_from_array($sql_father_data_array,RELATIONSTBL,'student_relation_ID',$father_relation_id);
						  }
						  
						  if($mother_name !=''){
						 $sql_mother_data_array = array(
						 'relation_name' => $mother_name,
						 'relation_occupation' => $mother_occupation,
						 'relation_phone'=>$mother_mobile,
						 'relation_with_student' => 'mother',
						 'student_ID'=> $select_id); 
						 $db->update_from_array($sql_mother_data_array,RELATIONSTBL,'student_relation_ID',$mother_relation_id);
						  }
						  
						  if(!empty($sql_guardian_parent_data_array)){ 
						   $sql_guardian_parent_data_array = array(
						 'relation_name' => $guardian_father,
						 'relation_occupation' => $guardian_father_occupation,
						 'relation_phone'=>'0',
						 'relation_with_student' => 'grand parent',
						 'student_ID'=> $select_id); 
						 $db->update_from_array($sql_guardian_parent_data_array,RELATIONSTBL,'student_relation_ID',$guardian_relation_id);
						  }
						  
						if($siblings_no >0 ){ 
						 $db->query("delete from ".RELATIONSTBL." where student_ID='".$select_id."' AND sibling = 1");
						for($i=1; $i<= $siblings_no; $i++){ 
							if($_POST['sibling_name_'.$i] !=''){
							 $sql_siblings_data_array = array(
							 'relation_name' => $_POST['sibling_name_'.$i],
							 'relation_age' => $_POST['age_'.$i],
							 'relation_occupation' => $_POST['occupation_'.$i],
							  'relation_education' => $_POST['education_'.$i],
							 'relation_phone'=>'0',
							 'relation_with_student' => $_POST['relation_with_student'.$i],
							 'sibling'=>'1', 
							 'student_ID'=> $select_id
							 );
							 $db->insert_from_array($sql_siblings_data_array,RELATIONSTBL); 
							}
						}
						}
						 
						
						if(!empty($$qualities_list)){
						 $db->query("delete from ".QUALITYTBL." where student_ID='".$select_id."'");
						
						  foreach($qualities_list as $key=>$value){
							 if($_POST['checkbox_'.$key]=='on'){
								   $sql_qualities_data_array = array(
						 			'questions' => $key,
									 'answers' => '1',
						 			'status' => 1,
									 'student_ID'=> $select_id);
									 $db->insert_from_array($sql_qualities_data_array,QUALITYTBL);
								}
							 
						  } 
						}
						
						 $like_arr= array();
						$likes = $_POST['likes'];
						if(!empty($likes)){
							 $db->query("delete from ".INTERESTTBL." where student_ID='".$select_id."' AND type='likes' ");
							$like_arr=explode(',',$likes,4);
							  $like_count=count($like_arr); 
								for($i=0;$i<=$like_count;$i++){ 
								if($like_arr[$i] !=""){ 
								   $sql_likes_data_array = array(
										'type' =>'likes',
										 'name' => $like_arr[$i],
										 'student_ID'=> $select_id);
										  $db->insert_from_array($sql_likes_data_array,INTERESTTBL);
								}
								}
						}
						
						
							 
							 $dislike_arr= array();
						$dislikes = $_POST['dislikes'];
					 if(!empty($dislikes)){
						  $db->query("delete from ".INTERESTTBL." where student_ID='".$select_id."' AND type='dislikes' ");
	 					$dislike_arr=explode(',',$dislikes,4);
						  $dislike_count=count($dislike_arr); 
							 for($i=0;$i<=$dislike_count;$i++){ 
							  if($dislike_arr[$i] !=""){
							   $sql_dislikes_data_array = array(
						 			'type' =>'dislikes',
									 'name' => $dislike_arr[$i],
									 'student_ID'=> $select_id);
									  $db->insert_from_array($sql_dislikes_data_array,INTERESTTBL);
							  }
							}
							 
						 }
						  $hobbies_arr= array();
						$hobbies = $_POST['hobbies'];
							 if(!empty($hobbies)){
								  $db->query("delete from ".INTERESTTBL." where student_ID='".$select_id."' AND type='hobbies' ");
								$hobbies_arr=explode(',',$hobbies,4); 
								$hobbies_count=count($hobbies_arr); 
									 for($i=0;$i<=$hobbies_count;$i++){ 
									  if($hobbies_arr[$i] !=""){
									   $sql_hobbies_data_array = array(
											'type' =>'hobbies',
											 'name' => $hobbies_arr[$i],
											 'student_ID'=> $select_id);
											  $db->insert_from_array($sql_hobbies_data_array,INTERESTTBL);
									  }
									}
							 }
								if($exam_model !=''){
								$sql_exam_array = array(
									'exam_type'=>'Academic', 
									'exam_date'=>$exam_date,
									 'exam_model' =>$exam_model,
									  'description'=>'',
									 'student_ID' => $select_id
								);
								$db->update_from_array($sql_exam_array,EXAMTBL,'student_ID', $select_id);
							 		$db->query("delete from ".EXAM_RESULT_TBL." where exam_ID='".$exam_id."' ");
									
									for($i=1;$i<=$no_subjects;$i++){ 
										if($_POST['subjects_'.$i] !=''){
											$sql_exam_result_array = array(
												'exam_ID' =>$exam_id,
												 'subjects' => $_POST['subjects_'.$i],
												 'marks'=> $_POST['marks_'.$i]); 
												  $db->insert_from_array($sql_exam_result_array,EXAM_RESULT_TBL); 
										}
									}
							}
							$sql_confidential_data_array = array(
						 			 'student_ID' => $student_id,
									 'title' => $title,
									 'interview_comments'=>$interview_comments,
									 'interviewed_by' =>$interviewed_by,
									 'psychological_results' => $psychological_results,
									 'description' => $description);
									  $db->update_from_array($sql_confidential_data_array,CONFIDENTIALTBL,'student_ID',$select_id);
									 
									 
						 redirect('students.php','');
						 break;
				
	case 'delete':
							$db->query("delete from ".TABLE." where student_ID='".$select_id."'");
							$db->query("delete from ".RELATIONSTBL." where student_ID='".$select_id."'");
							$db->query("delete from ".FAMILYTBL." where student_ID='".$select_id."'");
							$db->query("delete from ".QUALITYTBL." where student_ID='".$select_id."'");
							$db->query("delete from ".INTERESTTBL." where student_ID='".$select_id."'");
							$db->query("delete from ".EXAMTBL." where student_ID='".$select_id."'");
							$db->query("delete from ".EXAM_RESULT_TBL." where student_ID='".$select_id."'");
							$db->query("delete from ".CONFIDENTIALTBL." where student_ID='".$select_id."'");
							redirect('','del=1&sort=student_ID desc ');
							break;
							
							
			
			
	case 'deleterecord' :	
	                   $count=count($list);

			           if($count > 0)
			            {
				           for($i=0;$i<$count;$i++)
				          {
					       $db->query("delete from ".TABLE." where student_ID='".$list[$i]."'");
						     $db->query("delete from ".FAMILYTBL." where student_ID='".$list[$i]."'");
							   $db->query("delete from ".RELATIONSTBL." where student_ID='".$list[$i]."'");
							   $db->query("delete from ".QUALITYTBL." where student_ID='".$list[$i]."'");
							   $db->query("delete from ".INTERESTTBL." where student_ID='".$list[$i]."'");
							    $db->query("delete from ".EXAMTBL." where student_ID='".$list[$i]."'");
							    $db->query("delete from ".EXAM_RESULT_TBL." where student_ID='".$list[$i]."'");
								 $db->query("delete from ".CONFIDENTIALTBL." where student_ID='".$list[$i]."'");
				          }
						   
				        redirect('','dels=1&sort=student_ID desc ');
			             }
			        break;	
					
					
	/*case 'deletemodule':
							$db->query("delete from ".TABLE." where student_ID='".$select_id."'");
							 
							redirect('','del=1&lmod=1&select_id='.$stdid);
						
							break;	*/																		
			
			
			
	
} // END SWITCH


		if($ins) $alert = " Students Added successfully ";
		if($upd) $alert = " Students Updated successfully ";
		if($del) $alert = " Record deleted successfully ";
        if($dels) $alert = " Records deleted successfully ";
		

if($add || $edit)
{
   $action = 'insert';
   $TDHEADING = 'Add Student';
	if($select_id)
	{ 
		 $action = 'update';
		 $TDHEADING = 'Edit Student';
		
		  list($student_id, $name,  $baptism_name, $nick_name, $name_title, $mst_id, $house_name, $place, $post_code, $post_box, $post_office, $district, $state, $country, $route_to_house, $dob, $land_phone, $cell_phone, $email,  $fb, $whats_up, $school_teacher_name, $school_teacher_phone, $school_name, $school_syllabus, $parish_id, $parish_teacher_id, $d, $study_status_id, $student_category, $altara_boy, $catechism_class, $from_class, $church_going, $camp_attended, $interest_to_be_priest, $awards_received,  $percentage,  $siblings_no, $date, $nuns_family, $priests_family, $class, $profile_image ) = $db->fetch_one_row("SELECT student_ID, name, baptism_name, nick_name, name_title,  mst_id, house_name, place, post_code, post_box, post_office, district, state, country, route_to_house, dob, land_phone, cell_phone, email,  fb, whats_up, school_teacher_name, school_teacher_phone,  school_name, school_syllabus, parish_ID, teacher_ID, description, study_status_id, student_category_id, altara_boy, catechism_class, from_class, church_going, camp_attended, interest_to_be_priest, awards_received, percentage , siblings_no, date, nuns_family, priests_family, class, profile_image  FROM ".TABLE." WHERE student_ID='".$select_id."'"); 
		 
	  list($family_name, $family_financial_status, $family_id, $reputation, $relation_with_parish_id)=$db->fetch_one_row("SELECT family_name, family_financial_status, family_id, reputation, relation_with_parish_id	FROM ".FAMILYTBL." WHERE student_ID='".$select_id."'"); 
	  
		  list($father_relation_id, $father_name, $father_nickname, $father_occupation, $relation_with_student, $father_mobile)=$db->fetch_one_row("SELECT student_relation_ID, relation_name, relation_nickname relation_occupation, relation_with_student, relation_phone, relation_phone	FROM ".RELATIONSTBL." WHERE student_ID='".$select_id."' AND relation_with_student='father'"); 
		 
		   list($mother_relation_id, $mother_name, $mother_nickname, $mother_occupation, $relation_with_student, $mother_mobile)=$db->fetch_one_row("SELECT student_relation_ID, relation_name, relation_nickname, relation_occupation, relation_with_student, relation_phone	FROM ".RELATIONSTBL." WHERE student_ID='".$select_id."' AND relation_with_student='mother'");
		   
		    list($guardian_relation_id, $guardian_father, $guardian_father_occupation, $relation_with_student, $grand_parent_phone)=$db->fetch_one_row("SELECT student_relation_ID, relation_name, relation_occupation, relation_with_student	FROM ".RELATIONSTBL." WHERE student_ID='".$select_id."' AND relation_with_student='grand parent'");
		    
		   list($creport_id, $student_id, $title, $interview_comments, $interview_results, $interviewed_by, $psychological_results, $description ) = $db->fetch_one_row("SELECT creport_ID, student_ID, title, interview_comments,  interview_results, interviewed_by, psychological_results, description FROM ".CONFI_TBL." WHERE student_ID='".$select_id."'");
		   
		  
		   
		    $certificates_arr = getResultArray("SELECT * FROM ".MTABLE."student_certificates WHERE  student_ID = $select_id  ORDER BY certificate_ID");
			
		    list($exam_id, $student_id, $exam_model, $exam_date) = $db->fetch_one_row("SELECT exam_ID, student_ID, exam_model, exam_date FROM ".EXAMTBL." WHERE student_ID='".$select_id."' ORDER BY exam_ID DESC");
			
		   $siblings_arr = getResultArray("SELECT * FROM ".RELATIONSTBL."  WHERE  student_ID = $select_id  AND sibling=1 ORDER BY student_relation_ID");
		   
		    $qualities_arr = getResultArray("SELECT * FROM ".MTABLE."student_qualities WHERE  student_ID = $select_id  ORDER BY quality_ID");
			
			 $likes_arr = getResultArray("SELECT * FROM ".MTABLE."student_interests WHERE  student_ID = $select_id  AND type= 'likes' ORDER BY interests_ID");
			 if(!empty($likes_arr)){
				 $count=1;
				 $likes='';
				 foreach($likes_arr as $lik){ 
				 		$likes .=$lik['name'];
						if($count < count($likes_arr)) {
							$likes .= ',';
					 }
					
					 $count++;
				 
				 }
			 }
			 
			 $hobbies_arr = getResultArray("SELECT * FROM ".MTABLE."student_interests WHERE  student_ID = $select_id AND type= 'hobbies' ORDER BY interests_ID");
		  
		  if(!empty($hobbies_arr)){
				 $count=1;
				 $hobbies='';
				 foreach($hobbies_arr as $hobi){ 
				 		$hobbies .=$hobi['name'];
						if($count < count($hobbies_arr)) {
							$hobbies .= ',';
					 }
					
					 $count++;
				 
				 }
			 }
		    $dislikes_arr = getResultArray("SELECT * FROM ".MTABLE."student_interests WHERE  student_ID = $select_id AND type= 'dislikes' ORDER BY interests_ID");
			
			 if(!empty($dislikes_arr)){
				 $count=1;
				 $dislikes='';
				 foreach($dislikes_arr as $dis){ 
				 		$dislikes .=$dis['name'];
						//print_r($lik['name']);
						if($count < count($dislikes_arr)) {
							//print_r(',');
							$dislikes .= ',';
					 }
					
					 $count++;
				 
				 }
			 }
	}
	 list($vp_ID, $vp_name, $vp_phone, $vp_address, $vp_whatsup, $vp_fb)=$db->fetch_one_row("SELECT vp_id, vp_name, vp_phone, vp_address, vp_whatsup, vp_fb	FROM ".VP_TBL." WHERE student_ID='".$select_id."'"); 
	  list($teacher_comment_id, $teacher_id, $teacher_comment)=$db->fetch_one_row("SELECT teacher_comment_ID, teacher_ID, comments	FROM ".TEACHER_COMMENT_TBL." WHERE student_ID='".$select_id."'"); 
	  $question_answer_arr = getResultArray("SELECT * FROM ".QUES_ANS_TBL." WHERE  student_ID = $select_id ORDER BY question_answer_ID");
	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));
}
else
{
	$TDHEADING = 'Student Listing';
	if(!$sort) $sort ='student_ID desc';  
		  if($search_txt != '' || $student_category_id !="" || $from_date != '' || $to_date != '')
		  {
			
 		    if($search_txt != '')
	
				{ 
	
				   $condition= " CONCAT(name,email,mst_id,place, cell_phone, land_phone, district, state, country) like lower('%".$search_txt."%')";
	
				}
			if($student_category_id != ''){
	
				if($condition != '' )
	
				$condition.= " AND student_category_id=".$student_category_id;
	
				else  
	
				$condition= " student_category_id=".$student_category_id;
	
			}
			
			if($from_date != '' && $to_date != '' ){
			 	
				$from = strtotime($from_date);
			 	$to = strtotime($to_date);
				
				if($condition!='')
					$condition.= " AND ".TABLE.".student_added_date BETWEEN ".$from." AND ".$to;
				
				else
					$condition = " ".TABLE.".student_added_date BETWEEN ".$from." AND ".$to;
			}
			
				$sql_res = $db->query("SELECT * FROM ".TABLE." WHERE ".$condition);
		
					$no_of_rows = mysql_num_rows($sql_res);
		
				if($no_of_rows > '0') 
				
				{
				
						if(!$sort) $sort ='student_ID desc'; 
				
				
				
					 $query = "SELECT * FROM ".TABLE." WHERE ".$condition." ORDER BY ".$sort;
					
				
					$result1 = mysql_query($query) or die(mysql_error());
				
				 $no_of_rows = mysql_num_rows($result1);				 
				
				}
				
				else
				
				{
				
						$alert2 = "No Records !!";
				
				}
		
	}// end search close

		else

		{ 
		

			/*$no_of_rows = $db->get_count(TABLE);

			if($no_of_rows > '0')

			{*/

				if(!$sort) $sort ='student_ID DESC' ;
				
				

		$query = "SELECT * FROM ".TABLE."  ORDER BY ".$sort; 

		$result1 = mysql_query($query) or die(mysql_error());

		$no_of_rows = mysql_num_rows($result1);		 

			/*}

			else

			{

					 $alert2 = "No Records !!";

			}*/

		}
		define('MAIN_TEMPLATE', DIR_LIST.basename($_SERVER['PHP_SELF']));
}// else
#######################
require(DIR_ADMIN_TPL.'main.php');  /* Iclude Tempate*/
exit; 
 ?>