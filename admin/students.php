<?php
require('../application_top.php');
define('MODULEID','6');
define('MODULE_TITLE','Students');
require(DIR_ADMIN_INCLUDE.'session.php');
define('TABLE',MTABLE.'students');
define('USER_TBL',MTABLE.'users');
define('FAMILYTBL',MTABLE.'family');
define('RELATIONSTBL',MTABLE.'student_relations');
define('QUALITYTBL',MTABLE.'student_qualities');
define('INTERESTTBL',MTABLE.'student_interests');
define('EXAM_RESULT_TBL', MTABLE.'exam_results');
define('EXAMTBL', MTABLE.'exams');
define('VP_TBL', MTABLE.'vp');
define('QUES_ANS_TBL', MTABLE.'questions_answers');
define('TEACHER_COMMENT_TBL', MTABLE.'teacher_comments');
define('PREV_SCHOOL_HISTORY', MTABLE.'previous_school_history');
define('MEDICAL_TBL', MTABLE.'medical_reports');
define('CONFIDENTIALTBL', MTABLE.'confidential_reports');
define('STATE_TBL', MTABLE.'state');
define('CHECKBOX_TBL', MTABLE.'checkbox_values');
define('STUDENT_ANSWER_TBL', MTABLE.'student_answers');

/*--------------Select box tables----------------*/
define('NAME_TITLE_TBL', MTABLE.'name_title_list');
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
define('FAMILY_PRAYER_TBL', MTABLE.'family_prayer_list');
define('KURBANA_ATTEND_TBL', MTABLE.'kurbana_attend_list');
define('CONTINUE_TBL', MTABLE.'continue_status_list');

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
					if($_FILES['file']['name'] !=""){
						$file_name=upload_files('file','../uploads/profile/');
					}
						if($file_name ==''){
							$file_name=0;
						}
						if($_FILES['file2']['name'] !=""){
							$signature=upload_files('file2','../uploads/signature/');
						}
						if($signature ==''){
							$signature=0;
						}
						 $sql_data_array = array(
						 'name' => $name,
						  'baptism_name' => $baptism_name,
						  'nick_name' =>$nick_name,
						 'name_title' => $name_title,
						 'mst_id' => $mst_id,
						 'house_name' => $house_name,
						 'age' =>$age,
						 'surname' =>$surname,
						 'forane'=>$forane, 
						 'school' => $school,
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
						  'school_place'=> $school_place,
						 'parish_ID' => $parish_id, 
						 'teacher_ID' => $parish_teacher_id, 
						 'description' => $description, 
						 'kurbana_attend'=> $kurbana_attend,
						 'family_prayer'=> $family_prayer,
						 'church_going'=>$church_going,
						 'altara_boy'=>$altara_boy,
						 'catechism_class'=>$catechism_class,
						 'from_class'=>$from_class,
						 'interest_to_be_priest' => $interest_to_be_priest,
						 'study_status_id'=>$study_status_id,
						 'first_memory'=>$first_memory,
						 'school_syllabus' => $school_syllabus,
						 'class'=>$class,
						 'student_category_id'=>$student_category,
						 'awards_received'=> $awards_received,
						 'date'=>strtotime($date),
						 'nuns_family'=>$nuns_family,
						 'priests_family'=>$priests_family,
						 'camp_attended' => $c, 
						 'profile_image'=>$file_name,
						 'signature'=>$signature,
						 'no_sibling' => $siblings_no, 
						 'continue_status'=> $continue_status,
						  'instagram'=>$instagram,
						 'student_added_date' =>time(), 
						 'student_updated_date' => time());
						$db->insert_from_array($sql_data_array,TABLE);	 
						$insert_id = $db->insert_id();
						
						
						/*----------------------------STUDENT QUESTIONS AND ANSWERS-------------------------*/
					$questions_section_array=getResultArray("SELECT * FROM ".QUES_ANS_TBL." WHERE status = 1  AND section=2  AND question_type_ID='4' ORDER BY question_answer_ID asc ");
						
						foreach($questions_section_array as $row){
								if($row['question_struct']=='checkbox'){
									$checkbox_values_array=getResultArray("SELECT * FROM ".CHECKBOX_TBL." WHERE question_answer_ID = ".$row['question_answer_ID']." ORDER BY checkbox_values_ID asc ");
										foreach($checkbox_values_array as $values){
											if($_POST['checkbox_'.$row['question_answer_ID'].'_'.$values['checkbox_values_ID']]=='on'){
												$sql_data=array(
													'answers' =>$values['checkbox_values_ID'] ,
													'question_answer_ID'=>$row['question_answer_ID'], 
													'student_ID' => $select_id	
												);
												$db->insert_from_array($sql_data,STUDENT_ANSWER_TBL);
											}
										
										}
										
								
								}
								
								if($row['question_struct']=='textbox'){
									if($_POST['answer_'.$row['question_answer_ID']]==""){
									$sql_data=array(
									'answers' => $_POST['answer_'.$row['question_answer_ID']],
									'question_answer_ID'=>$row['question_answer_ID'], 
									'student_ID' => $select_id
									);
									$db->insert_from_array($sql_data,STUDENT_ANSWER_TBL);
									}
								}
								
								if($row['question_struct']=='radio'){
									$sql_data=array(
									'answers' => $_POST['radio_'.$row['question_answer_ID']],
									'question_answer_ID'=>$row['question_answer_ID'], 
									'student_ID' => $select_id
									);
									$db->insert_from_array($sql_data,STUDENT_ANSWER_TBL);
								}
									
								
								
						}
						
						/*----------------------PREVIOUS SCHOOL HISTORY----------------------*/
						if(!empty($_POST['previous_school_name']) ){ 
						
							$counter=count($_POST['previous_school_name']);
							for($i=0; $i<$counter; $i++){
								
							if($_POST['previous_syllabus'][$i] !="" && $_POST['previous_school_name'][$i] !="" ){
								$sql_prev_history_data_array = array(
								'previous_title' => $_POST['prev_title'][$i],
								 'previous_school_name' => $_POST['previous_school_name'][$i],
								 'previous_syllabus' => $_POST['previous_syllabus'][$i],
								  'previous_school_place' => $_POST['previous_school_place'][$i],
								 'student_ID' => $select_id
								  );
							  
							$db->insert_from_array($sql_prev_history_data_array,PREV_SCHOOL_HISTORY);
							}
							}
						}

					/*------------------------MEDICAL REPORT-----------------------------*/	
						if(!empty($_POST['height'])|| !empty($_POST['weight']) || !empty($_POST['blood_pressure']) || !empty($_POST['diabetes']) || !empty($_POST['blood_group']) ){
						 $sql_medical_data_array = array(
						  'height' => addslashes($height),
						 'weight' => $weight,
						 'blood_pressure' => $blood_pressure,
						 'diabetes' => $diabetes,
						  'blood_group' => $blood_group,
						  'others'=>$others,
						 'student_ID'=> $insert_id);
						 
						$db->insert_from_array($sql_medical_data_array,MEDICAL_TBL);
						}
						
						/*-----------------------FAMILY DETAILS------------------------*/
						
						if(!empty($_POST['family_name']) || !empty($_POST['family_financial_status']) || !empty($_POST['reputation']) || !empty($_POST['relation_with_parish_id'])){
						 $sql_family_data_array = array(
						 'family_name' => $family_name,
						 'family_financial_status' => $family_financial_status,
						 'reputation' => $reputation,
						 'relation_with_parish_id' => $relation_with_parish,
						 'student_ID'=> $insert_id);
						$db->insert_from_array($sql_family_data_array,FAMILYTBL);
						}
						 
						 if($father_name !=''){	
						  $sql_father_data_array = array(
						 'relation_name' => $father_name,
						 'relation_nickname' =>$father_nickname,
						 'relation_occupation' => $father_occupation,
						 'relation_phone'=>$father_mobile,
						 'relation_with_student' => 'father',
						 'student_ID'=> $insert_id); 
						$db->insert_from_array($sql_father_data_array,RELATIONSTBL);
						 }
						
						
						if($mother_name !=''){
						$sql_mother_data_array = array(
						 'relation_name' => $mother_name,
						 'relation_nickname' =>$mother_nickname,
						 'relation_occupation' => $mother_occupation,
						 'relation_phone'=>$mother_mobile,
						 'relation_with_student' => 'mother',
						 'student_ID'=> $insert_id); 
						$db->insert_from_array($sql_mother_data_array,RELATIONSTBL);
						}
						
						if($guardian_father != '')	{
							  $sql_guardian_parent_data_array = array(
						 'relation_name' => $guardian_father,
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
						
						/*------------------------------STREGTH AND WEEKNESS---------------------------*/
						
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
							/*--------------------------------EXAM MODEL SUBJECTS-----------------------*/
							if($final_exam_date ==''){ $final_exam_date = date('d-m-Y', time());}
								$sql_exam_array = array(
									'exam_type'=>'Academic', 
									 'exam_model' =>'1',
									 'exam_date'=>$final_exam_date,
									  'description'=>'',
									 'student_ID' => $insert_id
								);
								 $db->insert_from_array($sql_exam_array,EXAMTBL);
							$f_exam_pri_id = $db->insert_id(); 
								if($f_exam_pri_id !=''){ 
									$f_total_marks=0;
									$f_total_outof=0;
									for($i=1;$i<=$no_subjects;$i++){ 	
										if($_POST['f_subjects_'.$i] !=''){
											$f_total_marks= $f_total_marks + $_POST['f_marks_'.$i]; 
											$f_total_outof= $f_total_outof + $_POST['f_outof_'.$i];
											$f_sql_exam_result_array = array(
												'exam_ID' =>$f_exam_pri_id,
												 'subjects' => $_POST['f_subjects_'.$i],
												 'marks'=> $_POST['f_marks_'.$i],
												 'outof'=> $_POST['f_outof_'.$i]
												 ); 
												  $db->insert_from_array($f_sql_exam_result_array,EXAM_RESULT_TBL); 
										}
									}
									$f_total_percentage=($f_total_marks / $f_total_outof) * 100;
									$f_sql_percentage_array=array('percentage'=>$f_total_percentage);
									
									$condition=" student_ID= ".$insert_id." AND exam_ID = ".$f_exam_pri_id;
						 		$db->insert_from_array($f_sql_percentage_array,EXAMTBL);
								}
							//}
							/*--------------------------------ONAM---------------------------*/
							if($onam_exam_date ==''){ $onam_exam_date = date('d-m-Y', time());}
							
								$sql_exam_array = array(
									'exam_type'=>'Academic', 
									 'exam_model' =>'3',
									 'exam_date'=>$onam_exam_date,
									  'description'=>'',
									 'student_ID' => $insert_id
								);
								 $db->insert_from_array($sql_exam_array,EXAMTBL);
							$on_exam_pri_id = $db->insert_id(); 
								if($on_exam_pri_id !=''){ 
									$on_total_marks=0;
									$on_total_outof=0;
									for($i=1;$i<=$no_subjects;$i++){ 	
										if($_POST['onam_subjects_'.$i] !=''){
											$on_total_marks= $on_total_marks + $_POST['onam_marks_'.$i]; 
											$on_total_outof= $on_total_outof + $_POST['onam_outof_'.$i];
											$on_sql_exam_result_array = array(
												'exam_ID' =>$on_exam_pri_id,
												 'subjects' => $_POST['onam_subjects_'.$i],
												 'marks'=> $_POST['onam_marks_'.$i],
												 'outof'=> $_POST['onam_outof_'.$i]
												 ); 
												  $db->insert_from_array($on_sql_exam_result_array,EXAM_RESULT_TBL); 
										}
									}
									$on_total_percentage=($on_total_marks / $on_total_outof) * 100;
									$on_sql_percentage_array=array('percentage'=>$on_total_percentage);
									
									$condition=" student_ID= ".$insert_id." AND exam_ID = ".$on_exam_pri_id;
						 		$db->insert_from_array($on_sql_percentage_array,EXAMTBL);
								}
							
							
							
							/*--------------------------------REPORTS--------------------------*/
					if(!empty($_POST['vicar_report']) || !empty($_POST['interview_comments']) || !empty($_POST['vicar_premotor_report']) || !empty($_POST['interviewed_by']) || !empty($_POST['psychological_results'])){ 
							$db->query("delete from ".CONFIDENTIALTBL." where student_ID='".$select_id."' ");
							$sql_confidential_data_array = array(
									 'vicar_report' => $vicar_report,
									 'interview_comments'=>$interview_comments,
									 'interviewed_by' =>$interviewed_by,
									 'psychological_results' => $psychological_results,
									 'vicar_premotor_report' => $vicar_premotor_report,
									 'student_ID' => $select_id
									 );
									  $db->insert_from_array($sql_confidential_data_array,CONFIDENTIALTBL);
					}
						  
						
						 redirect('students.php','');
				  		 break;

	case 'update':
					  if((int)$select_id == 0) redirect();
					  if($_FILES['file']['name'] !=''){ 
					  	$file_name=upload_files('file','../uploads/profile/');
					  }
					  else{
						  $file_name=$old_file;
					  }
					 
					  if($_FILES['file2']['name'] !=''){ 
					  	$signature=upload_files('file2','../uploads/signature/');
					  }
					  else{
						  $signature=$old_signature;
					  }
					if($camp_attended =='on'){
						$c='1';
					}
					else {
						$c='0';
						}
						
					
						 $sql_data_array = array(
							 'name' => $name,
							  'name_title' => $name_title,
							 'baptism_name' => $baptism_name,
							  'nick_name' =>$nick_name,
							 'mst_id' => $mst_id,
							  'house_name' => $house_name,
							   'school' => $school,
							    'age' =>$age,
								 'surname' =>$surname,
								 'forane'=>$forane,
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
							 'first_memory'=>$first_memory,
							 'whats_up' => $whats_up, 
							 'school_teacher_name' => $school_teacher_name, 
							 'school_teacher_phone' => $school_teacher_phone,
							 'school_place'=> $school_place,
							 'school_name' => $sunday_school, 
							 'parish_ID' => $parish_id, 
							 'teacher_ID' => $parish_teacher_id, 
							 'description' => $description, 
							  'kurbana_attend'=> $kurbana_attend,
							 'family_prayer'=> $family_prayer,
							 'church_going' => $church_going,
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
							  'signature'=>$signature,
							  'no_sibling' => $siblings_no,
							   'continue_status'=> $continue_status,
							   'instagram'=>$instagram,
							 'student_added_date' =>time(), 
							 'student_updated_date' => time());
					 	//print_r($sql_data_array);exit;
					  	$db->update_from_array($sql_data_array,TABLE,'student_ID', $select_id);
						
						
			/*----------------------------STUDENT QUESTIONS AND ANSWERS---------------------*/			
						$questions_section_array=getResultArray("SELECT * FROM ".QUES_ANS_TBL." WHERE status = 1  AND section=2  AND question_type_ID='4' ORDER BY question_answer_ID asc ");
						 $db->query("DELETE FROM ".STUDENT_ANSWER_TBL." WHERE student_ID= ".$select_id);
						foreach($questions_section_array as $row){ 
							/*if($_POST['answer_'.$row['question_answer_ID']] !="" || $_POST['checkbox_'.$row['question_answer_ID']]=='on' ){*/
						
							 
								if($row['question_struct']=='checkbox'){
									$checkbox_values_array=getResultArray("SELECT * FROM ".CHECKBOX_TBL." WHERE question_answer_ID = ".$row['question_answer_ID']." ORDER BY checkbox_values_ID asc ");
									
										foreach($checkbox_values_array as $values){
											if($_POST['checkbox_'.$row['question_answer_ID'].'_'.$values['checkbox_values_ID']]=='on'){
												$sql_data=array(
													'answers' =>$values['checkbox_values_ID'] ,
													'question_answer_ID'=>$row['question_answer_ID'], 
													'student_ID' => $select_id	
												);
												$db->insert_from_array($sql_data,STUDENT_ANSWER_TBL);
											}// if checkbox
										
										}//checkbox foreach close
										
								}// check checkbox
								
								if($row['question_struct']=='textbox'){
									if($_POST['answer_'.$row['question_answer_ID']]!=""){
									$sql_data=array(
									'answers' => $_POST['answer_'.$row['question_answer_ID']],
									'question_answer_ID'=>$row['question_answer_ID'], 
									'student_ID' => $select_id
									);
									$db->insert_from_array($sql_data,STUDENT_ANSWER_TBL);
									}
								}// check texbox
								
								if($row['question_struct']=='radio'){
									$sql_data=array(
									'answers' => $_POST['radio_'.$row['question_answer_ID']],
									'question_answer_ID'=>$row['question_answer_ID'], 
									'student_ID' => $select_id
									);
									$db->insert_from_array($sql_data,STUDENT_ANSWER_TBL);
								}// check radio
									
							//}
								
						}// student answer array
						/*----------------------PREVIOUS SCHOOL HISTORY----------------------*/
						if(!empty($_POST['previous_school_name']) ){ 
						
						 $db->query("DELETE FROM ".PREV_SCHOOL_HISTORY." WHERE student_ID= ".$select_id);
						
							$counter=count($_POST['previous_school_name']);
							
							for($i=0; $i<$counter; $i++){
								
							if($_POST['previous_syllabus'][$i] !="" && $_POST['previous_school_name'][$i] !="" ){
								$sql_prev_history_data_array = array(
								'previous_title' => $_POST['prev_title'][$i],
								 'previous_school_name' => $_POST['previous_school_name'][$i],
								 'previous_syllabus' => $_POST['previous_syllabus'][$i],
								  'previous_school_place' => $_POST['previous_school_place'][$i],
								 'student_ID' => $select_id
								  );
							  
							$db->insert_from_array($sql_prev_history_data_array,PREV_SCHOOL_HISTORY);
							}
							}
						}
						
						/*------------------------------MEDICAL REPORT-------------------------------------*/
							if(!empty($_POST['height'])|| !empty($_POST['weight']) || !empty($_POST['blood_pressure']) || !empty($_POST['diabetes']) || !empty($_POST['blood_group']) ){
								 $db->query("DELETE FROM ".MEDICAL_TBL." WHERE student_ID= ".$select_id);
						 $sql_medical_data_array = array(
						 'height' => addslashes($height),
						 'weight' => $weight,
						 'blood_pressure' => $blood_pressure,
						 'diabetes' => $diabetes,
						  'blood_group' => $blood_group,
						  'others'=>$others,
						  'student_ID' => $select_id
						  );
						$db->insert_from_array($sql_medical_data_array,MEDICAL_TBL);
							}
						/*-------------------------FAMILY DEAILS---------------------------*/
						if(!empty($_POST['family_name']) || !empty($_POST['family_financial_status']) || !empty($_POST['reputation']) || !empty($_POST['relation_with_parish_id'])){
							 $db->query("DELETE FROM ".FAMILYTBL." WHERE student_ID= ".$select_id);
						$sql_family_data_array = array(
						 'family_name' => $family_name,
						 'family_financial_status' => $family_financial_status,
						 'reputation' => $reputation,
						 'relation_with_parish_id' => $relation_with_parish,
						 'student_ID' => $select_id, 
						 );
						 $db->insert_from_array($sql_family_data_array,FAMILYTBL);	
						}
						 
						  if($father_name !='' || $father_mobile !=""){
						 
							$condi="  student_ID = ".$select_id." AND relation_with_student = 'father'";				
						 	$ct=$db->get_count(RELATIONSTBL, $condi);
						 	if($ct=='0'){
							  $sql_father_data_array = array(
								 'relation_name' => $father_name,
								 'relation_nickname' =>$father_nickname,
								 'relation_occupation' => $father_occupation,
								 'relation_phone'=>$father_mobile, 
								  'relation_with_student' => 'father',
								 'student_ID'=> $select_id);
						
							 $db->insert_from_array($sql_father_data_array,RELATIONSTBL);
							 }
							 else{
								$sql_father_data_array = array(
								 'relation_name' => $father_name,
								 'relation_nickname' =>$father_nickname,
								 'relation_occupation' => $father_occupation,
								 'relation_phone'=>$father_mobile
														);	
						 		$condition=" student_ID= ".$select_id." AND relation_with_student = 'father'";
						 		$db->UpdateQuery(RELATIONSTBL,$sql_father_data_array,$condition);
							}
						  }
						 
						
						  if($mother_name !='' || $mother_mobile !=''){
							  	  $condi="  student_ID = ".$select_id." AND relation_with_student = 'mother'";				
								$ct=$db->get_count(RELATIONSTBL, $condi);
								if($ct=='0'){
									$sql_mother_data_array = array(
									 'relation_name' => $mother_name,
									 'relation_nickname' =>$mother_nickname,
									 'relation_occupation' => $mother_occupation,
									 'relation_phone'=>$mother_mobile,
									 'relation_with_student' => 'mother',
									 'student_ID'=> $select_id); 
									$db->insert_from_array($sql_mother_data_array,RELATIONSTBL);
								}
								else{
									 $sql_mother_data_array = array(
									 'relation_name' => $mother_name,
									 'relation_nickname' =>$mother_nickname,
									 'relation_occupation' => $mother_occupation,
									 'relation_phone'=>$mother_mobile
									
									);
									 $condition=" student_ID= ".$select_id." AND relation_with_student = 'mother'";
									 $db->UpdateQuery(RELATIONSTBL,$sql_mother_data_array,$condition); 
								}
						  }
						
						  if(!$guardian_father !=''){
							    $condi="  student_ID = ".$select_id." AND relation_with_student = 'mother'";				
						 		$ct=$db->get_count(RELATIONSTBL, $condi);
							if($ct=='0'){ 
						   		$sql_guardian_parent_data_array = array(
								 'relation_name' => $guardian_father,
								 'relation_occupation' => $guardian_father_occupation,
								  'relation_with_student' => 'grand_father',
								  'student_ID'=>$select_id,
								 'relation_phone'=>'0'); 
							 	$db->insert_from_array($sql_guardian_parent_data_array,RELATIONSTBL);
							  }
							  else{
							  	$condition=" student_ID= ".$select_id." AND relation_with_student = 'grand_father'";
							 	$db->UpdateQuery(RELATIONSTBL,$sql_guardian_parent_data_array,$condition); 
							
							  }
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
					/*----------------------------STREGTH AND SHORTCOMINGS---------------------------------*/ 
						
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
							
							/*--------------------------------EXAM MODEL SUBJECTS MARKS-------------------------------*/
							if($final_exam_date ==''){ $final_exam_date = date('d-m-Y', time());} 
								$sql_final_exam_array = array(
									'exam_type'=>'Academic', 
									 'exam_model' =>'1',
									 'exam_date' => $final_exam_date,
									  'description'=>'',
									 'student_ID' => $select_id
								);
								
								if($final_exam_id !=''){
									$condition=" exam_ID= ".$final_exam_id;
									$db->UpdateQuery(EXAMTBL,$sql_final_exam_array,$condition);
									$final_exam_pri_id=$final_exam_id;
									
								}
								else{
								
								 $db->insert_from_array($sql_final_exam_array,EXAMTBL);
								 $final_exam_pri_id = $db->insert_id(); 
								}
							
								if($final_exam_pri_id !=''){ 
								$db->query("delete from ".EXAM_RESULT_TBL." where exam_ID='".$final_exam_pri_id."' ");
									$final_total_marks=0;
									$final_total_outof=0;
									//print_r($_POST['final_marks_1']); exit;
									for($i=0;$i<=$no_subjects;$i++){ 	
										if($_POST['final_marks_'.$i] !=''){ 
											$final_total_marks= $final_total_marks + $_POST['final_marks_'.$i]; 
											$final_total_outof= $final_total_outof + $_POST['final_outof_'.$i];
											$final_sql_exam_result_array = array(
												'exam_ID' =>$final_exam_pri_id,
												 'subjects' => $_POST['final_subjects_'.$i],
												 'marks'=> $_POST['final_marks_'.$i],
												 'outof'=> $_POST['final_outof_'.$i]
												 );
												// print_r($final_sql_exam_result_array);  exit;
												  $db->insert_from_array($final_sql_exam_result_array,EXAM_RESULT_TBL); 
										}
										
									}
									$final_total_percentage=($final_total_marks / $final_total_outof) * 100;
									$final_sql_percentage_array=array('percentage'=>$final_total_percentage);
									
									$condition2=" student_ID= ".$insert_id." AND exam_ID = ".$final_exam_pri_id;
									$db->UpdateQuery(EXAMTBL,$final_sql_percentage_array,$condition2);
								}
							//}
							/*--------------------------------ONAM---------------------------*/
							if($onam_exam_date ==''){ $onam_exam_date = date('d-m-Y', time());} 
							
								$sql_onamexam_array = array(
									'exam_type'=>'Academic', 
									 'exam_model' =>'3',
									 'exam_date' => $onam_exam_date,
									  'description'=>'',
									 'student_ID' => $select_id
								);
								if($onam_exam_id !=''){
									$condition=" exam_ID= ".$onam_exam_id;
									$db->UpdateQuery(EXAMTBL,$sql_onamexam_array,$condition);
									$on_exam_pri_id=$onam_exam_id;
									
								}
								else{
								
								 $db->insert_from_array($sql_onamexam_array,EXAMTBL);
								 $on_exam_pri_id = $db->insert_id(); 
								}
							
								if($on_exam_pri_id !=''){ 
								$db->query("delete from ".EXAM_RESULT_TBL." where exam_ID='".$on_exam_pri_id."' ");
									$on_total_marks=0;
									$on_total_outof=0;
									for($i=0;$i<=$no_subjects;$i++){ 	
										if($_POST['onam_marks_'.$i] !=''){
											$on_total_marks= $on_total_marks + $_POST['onam_marks_'.$i]; 
											$on_total_outof= $on_total_outof + $_POST['onam_outof_'.$i];
											$on_sql_exam_result_array = array(
												'exam_ID' =>$on_exam_pri_id,
												 'subjects' => $_POST['onam_subjects_'.$i],
												 'marks'=> $_POST['onam_marks_'.$i],
												 'outof'=> $_POST['onam_outof_'.$i]
												 );
												// print_r($on_sql_exam_result_array);  exit;
												  $db->insert_from_array($on_sql_exam_result_array,EXAM_RESULT_TBL); 
										}
										
									}
									$on_total_percentage=($on_total_marks / $on_total_outof) * 100;
									$on_sql_percentage_array=array('percentage'=>$on_total_percentage);
									
									$condition2=" student_ID= ".$insert_id." AND exam_ID = ".$on_exam_pri_id;
									$db->UpdateQuery(EXAMTBL,$on_sql_percentage_array,$condition2);
								}
							//}
					/*--------------------------------REPORTS--------------------------*/
					if(!empty($_POST['vicar_report']) || !empty($_POST['interview_comments']) || !empty($_POST['vicar_premotor_report'])|| !empty($_POST['interviewed_by']) || !empty($_POST['psychological_results'])){ 
							$db->query("delete from ".CONFIDENTIALTBL." where student_ID='".$select_id."' ");
							$sql_confidential_data_array = array(
									 'vicar_report' => $vicar_report,
									 'interview_comments'=>$interview_comments,
									 'interviewed_by' =>$interviewed_by,
									 'psychological_results' => $psychological_results,
									 'vicar_premotor_report' => $vicar_premotor_report,
									 'student_ID' => $select_id
									 );
									  $db->insert_from_array($sql_confidential_data_array,CONFIDENTIALTBL);
					}
									 
						
						 redirect('students.php','');
						 break;
				
	case 'delete':
							$db->query("delete from ".TABLE." where student_ID='".$select_id."'");
							$db->query("delete from ".RELATIONSTBL." where student_ID='".$select_id."'");
							$db->query("delete from ".FAMILYTBL." where student_ID='".$select_id."'");
							//$db->query("delete from ".QUALITYTBL." where student_ID='".$select_id."'");
							//$db->query("delete from ".INTERESTTBL." where student_ID='".$select_id."'");
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
							  // $db->query("delete from ".QUALITYTBL." where student_ID='".$list[$i]."'");
							   //$db->query("delete from ".INTERESTTBL." where student_ID='".$list[$i]."'");
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
		
		  list($student_id, $name,  $baptism_name, $nick_name, $school, $name_title, $mst_id, $house_name, $forane, $age, $surname, $place, $post_code, $post_box, $post_office, $district, $state, $country, $route_to_house, $dob, $land_phone, $cell_phone, $email,  $fb, $whats_up, $school_teacher_name, $school_teacher_phone, $school_name, $school_place, $school_syllabus, $parish_id, $parish_teacher_id, $d, $study_status_id, $student_category, $altara_boy, $catechism_class, $from_class, $kurbana_attend, $family_prayer, $church_going, $camp_attended, $interest_to_be_priest, $awards_received,  $percentage,  $siblings_no, $date, $nuns_family, $priests_family, $class, $profile_image, $signature, $veda_class, $continue_status, $first_memory, $instagram) = $db->fetch_one_row("SELECT student_ID, name, baptism_name, nick_name, school, name_title,  mst_id, house_name, forane, age, surname, place, post_code, post_box, post_office, district, state, country, route_to_house, dob, land_phone, cell_phone, email,  fb, whats_up, school_teacher_name, school_teacher_phone,  school_name, school_place, school_syllabus, parish_ID, teacher_ID, description, study_status_id, student_category_id, altara_boy, catechism_class, from_class, kurbana_attend, family_prayer, church_going, camp_attended, interest_to_be_priest, awards_received, percentage , no_sibling, date, nuns_family, priests_family, class, profile_image, signature, veda_class, continue_status, first_memory, instagram  FROM ".TABLE." WHERE student_ID='".$select_id."'"); 
		 
	  list($family_name, $family_financial_status, $family_id, $reputation, $relation_with_parish_id)=$db->fetch_one_row("SELECT family_name, family_financial_status, family_id, reputation, relation_with_parish_id	FROM ".FAMILYTBL." WHERE student_ID='".$select_id."'"); 
	
		  list($father_relation_id, $father_name, $father_nickname, $father_occupation, $relation_with_student, $father_mobile)=$db->fetch_one_row("SELECT student_relation_ID, relation_name, relation_nickname relation_occupation, relation_with_student, relation_phone, relation_phone	FROM ".RELATIONSTBL." WHERE student_ID='".$select_id."' AND relation_with_student='father'"); 
		   
		   list($mother_relation_id, $mother_name, $mother_nickname, $mother_occupation, $relation_with_student, $mother_mobile)=$db->fetch_one_row("SELECT student_relation_ID, relation_name, relation_nickname, relation_occupation, relation_with_student, relation_phone	FROM ".RELATIONSTBL." WHERE student_ID='".$select_id."' AND relation_with_student='mother'");
		   
		
		   
		    list($guardian_relation_id, $guardian_father, $guardian_father_occupation, $relation_with_student, $grand_parent_phone)=$db->fetch_one_row("SELECT student_relation_ID, relation_name, relation_occupation, relation_with_student	FROM ".RELATIONSTBL." WHERE student_ID='".$select_id."' AND relation_with_student='grand parent'");
		      
			 list($height, $weight, $blood_group, $blood_pressure, $diabetes, $others)=$db->fetch_one_row("SELECT height, weight, blood_group, blood_pressure, diabetes, others	FROM ".MEDICAL_TBL." WHERE student_ID='".$select_id."'");
			
			 
		   list($creport_id, $student_id, $vicar_report, $interview_comments, $interview_results, $interviewed_by, $psychological_results, $vicar_premotor_report ) = $db->fetch_one_row("SELECT creport_ID, student_ID, vicar_report, interview_comments,  interview_results, interviewed_by, psychological_results, vicar_premotor_report FROM ".CONFIDENTIALTBL." WHERE student_ID='".$select_id."'");
		   
		 
		   
		    $certificates_arr = getResultArray("SELECT * FROM ".MTABLE."student_certificates WHERE  student_ID = $select_id  ORDER BY certificate_ID");
			 
			 
		    list($final_exam_id, $student_id, $final_exam_model, $final_exam_date) = $db->fetch_one_row("SELECT exam_ID, student_ID, exam_model, exam_date FROM ".EXAMTBL." WHERE student_ID='".$select_id."' AND exam_model = '1' ");
			
			/*print_r("SELECT exam_ID, student_ID, exam_model, exam_date FROM ".EXAMTBL." WHERE student_ID='".$select_id."' AND exam_model = '3' ");exit;*/
			
			  list($onam_exam_id, $student_id, $onam_exam_model, $onam_exam_date) = $db->fetch_one_row("SELECT exam_ID, student_ID, exam_model, exam_date FROM ".EXAMTBL." WHERE student_ID='".$select_id."' AND exam_model = '3' ");
			
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
			 
			  list($vp_ID, $vp_name, $vp_phone, $vp_address, $vp_whatsup, $vp_fb)=$db->fetch_one_row("SELECT vp_id, vp_name, vp_phone, vp_address, vp_whatsup, vp_fb	FROM ".VP_TBL." WHERE student_ID='".$select_id."'");  
	  list($teacher_comment_id, $teacher_id, $teacher_comment)=$db->fetch_one_row("SELECT teacher_comment_ID, teacher_ID, comments	FROM ".TEACHER_COMMENT_TBL." WHERE student_ID='".$select_id."'"); 
	 
	  $student_answer_arr = getResultArray("SELECT * FROM ".STUDENT_ANSWER_TBL." WHERE  student_ID = $select_id ORDER BY question_answer_ID");
	  
	    $previous_school_arr = getResultArray("SELECT * FROM ".PREV_SCHOOL_HISTORY." WHERE  student_ID = ".$select_id);
		
	}
	
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