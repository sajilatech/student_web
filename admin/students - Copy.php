<?php
require('../application_top.php');
define('MODULEID','6');
define('MODULE_TITLE','Students');
require(DIR_ADMIN_INCLUDE.'session.php');
define('TABLE',MTABLE.'students');
define('FAMILYTBL',MTABLE.'family');
define('SIBLINGSTBL',MTABLE.'student_siblings');
define('QUALITYTBL',MTABLE.'student_qualities');
define('INTERESTTBL',MTABLE.'student_interests');
$GrpPage = 3;

#################### 
# Actions

switch($doaction)
{
	case 'insert':
	
						 $sql_data_array = array(
						 'name' => $_SESSION['personal']['name'],
						 'mst_id' => $_SESSION['personal']['mst_id'],
						 'place' => $_SESSION['personal']['place'],
						 'post_code' => $_SESSION['personal']['post_code'],
						 'district' => $_SESSION['personal']['district'],
						 'state' => $_SESSION['personal']['state'],
						 'country' => $_SESSION['personal']['country'],
						  'post_code' => $_SESSION['personal']['post_code'],
						 'route_to_house' => $_SESSION['personal']['route_to_house'], 
						 'dob' => $_SESSION['personal']['dob'],
						 'land_phone' => $_SESSION['personal']['land_phone'], 
						 'cell_phone' => $_SESSION['personal']['cell_phone'], 
						 'email' => $_SESSION['personal']['email'], 
						 'fb' => $_SESSION['personal']['fb'], 
						 'whats_up' => $_SESSION['personal']['whats_up'], 
						 'school_teacher_name' => $_SESSION['personal']['school_teacher_name'], 
						 'school_name' => $_SESSION['personal']['school_name'], 
						 'parish_ID' => $_SESSION['personal']['parish_id'], 
						 'teacher_ID' => $_SESSION['personal']['parish_teacher_id'], 
						 'description' => $_SESSION['personal']['description'], 
						/* 'study_status_id' => $_SESSION['study_status_id,*/
						 'student_category_id'=>$_SESSION['personal']['student_category'],
						 'student_added_date' =>time(), 
						 'student_updated_date' => time());
			
						 $db->insert_from_array($sql_data_array,TABLE);	
						 $insert_id = $db->insert_id();	
						 
						// $insert_id=1;
						 $sql_family_data_array = array(
						 'family_name' => $_SESSION['family']['family_name'],
						 'family_financial_status' => $_SESSION['family']['family_financial_status'],
						 'reputation' => $_SESSION['family']['reputation'],
						 'relation_with_parish_id' => $_SESSION['family']['relation_with_parish'],
						 'student_ID'=> $insert_id);
						$db->insert_from_array($sql_family_data_array,FAMILYTBL);	
						 
						  $sql_siblings_data_array = array(
						 'siblings_name' => $_SESSION['family']['siblings_name'],
						 'siblings_occupation' => $_SESSION['family']['siblings_occupation'],
						 'relation_with_student' => $_SESSION['family']['relation_with_student'],
						 'student_ID'=> $insert_id); 
						$db->insert_from_array($sql_siblings_data_array,SIBLINGSTBL);
							
						 $sql_student_data=array('church_going'=> $church_going,
						 'altara_boy'=>$altara_boy,
						 'study_status_id'=>$study_status_id,
						 'percentage'=>$percentage
						 );
						$db->update_from_array($sql_student_data,TABLE,'student_ID', $insert_id);
						 
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
						  for($i=1;$i<=3;$i++){ 
						  	if($_POST['likes_'.$i] !=""){
							   $sql_likes_data_array = array(
						 			'type' =>'likes',
									 'name' => $_POST['likes_'.$i],
									 'student_ID'=> $insert_id);
									  $db->insert_from_array($sql_likes_data_array,INTERESTTBL);
							}
							}
							 for($i=1;$i<=3;$i++){ 
							  if($_POST['dislikes_'.$i] !=""){
							   $sql_dislikes_data_array = array(
						 			'type' =>'dislikes',
									 'name' => $_POST['dislikes_'.$i],
									 'student_ID'=> $insert_id);
									  $db->insert_from_array($sql_dislikes_data_array,INTERESTTBL);
							  }
							}
							 for($i=1;$i<=3;$i++){ 
							  if($_POST['hobbies_'.$i] !=""){
							   $sql_hobbies_data_array = array(
						 			'type' =>'hobbies',
									 'name' => $_POST['hobbies_'.$i],
									 'student_ID'=> $insert_id);
									  $db->insert_from_array($sql_hobbies_data_array,INTERESTTBL);
							  }
							}
							
						 
						 redirect('students.php','student_ID='.$student_ID);
				  		 break;

	case 'update':
				    if((int)$select_id == 0) redirect();
					
						 $sql_data_array = array(
						 'name' => $_SESSION['personal']['name'],
						 'mst_id' => $_SESSION['personal']['mst_id'],
						 'place' => $_SESSION['personal']['place'],
						 'post_code' => $_SESSION['personal']['post_code'],
						 'district' => $_SESSION['personal']['district'],
						 'state' => $_SESSION['personal']['state'],
						 'country' => $_SESSION['personal']['country'],
						  'post_code' => $_SESSION['personal']['post_code'],
						 'route_to_house' => $_SESSION['personal']['route_to_house'], 
						 'dob' => $_SESSION['personal']['dob'],
						 'land_phone' => $_SESSION['personal']['land_phone'], 
						 'cell_phone' => $_SESSION['personal']['cell_phone'], 
						 'email' => $_SESSION['personal']['email'], 
						 'fb' => $_SESSION['personal']['fb'], 
						 'whats_up' => $_SESSION['personal']['whats_up'], 
						 'school_teacher_name' => $_SESSION['personal']['school_teacher_name'], 
						 'school_name' => $_SESSION['personal']['school_name'], 
						 'parish_ID' => $_SESSION['personal']['parish_id'], 
						 'teacher_ID' => $_SESSION['personal']['parish_teacher_id'], 
						 'description' => $_SESSION['personal']['description'], 
						/* 'study_status_id' => $_SESSION['study_status_id,*/
						 'student_category_id'=>$_SESSION['personal']['student_category'],
						 'student_updated_date' => time());
					 
					  	$db->update_from_array($sql_data_array,TABLE,'student_ID', $select_id);
						 
						$sql_family_data_array = array(
						 'family_name' => $_SESSION['family']['family_name'],
						 'family_financial_status' => $_SESSION['family']['family_financial_status'],
						 'reputation' => $_SESSION['family']['reputation'],
						 'relation_with_parish_id' => $_SESSION['family']['relation_with_parish']);
						 $db->update_from_array($sql_family_data_array,FAMILYTBL,'student_ID',$select_id);	
						 
						  $sql_siblings_data_array = array(
						 'siblings_name' => $_SESSION['family']['siblings_name'],
						 'siblings_occupation' => $_SESSION['family']['siblings_occupation'],
						 'relation_with_student' => $_SESSION['family']['relation_with_student']); 
						 $db->update_from_array($sql_siblings_data_array,SIBLINGSTBL,'student_ID',$select_id);
						 
						  $sql_student_data=array('church_going'=> $church_going,
						 'altara_boy'=>$altara_boy,
						 'study_status_id'=>$study_status_id,
						 'percentage'=>$percentage
						 );
						$db->update_from_array($sql_student_data,TABLE,'student_ID', $select_id);
						
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
						  
						   $db->query("delete from ".INTERESTTBL." where student_ID='".$select_id."' AND type='likes' ");
						  for($i=1;$i<=3;$i++){ 
						  	if($_POST['likes_'.$i] !=""){
							   $sql_likes_data_array = array(
						 			'type' =>'likes',
									 'name' => $_POST['likes_'.$i],
									 'student_ID'=> $select_id);
									  $db->insert_from_array($sql_likes_data_array,INTERESTTBL);
							}
							}
							
							 $db->query("delete from ".INTERESTTBL." where student_ID='".$select_id."' AND type='dislikes' ");
							 for($i=1;$i<=3;$i++){ 
							 if($_POST['dislikes_'.$i] !=""){
							   $sql_dislikes_data_array = array(
						 			'type' =>'dislikes',
									 'name' => $_POST['dislikes_'.$i],
									 'student_ID'=> $select_id);
									  $db->insert_from_array($sql_dislikes_data_array,INTERESTTBL);
							 }
							}
							
							 $db->query("delete from ".INTERESTTBL." where student_ID='".$select_id."' AND type='hobbies' ");
							 for($i=1;$i<=3;$i++){ 
							 if($_POST['hobbies_'.$i] !=""){
							   $sql_hobbies_data_array = array(
						 			'type' =>'hobbies',
									 'name' => $_POST['hobbies_'.$i],
									 'student_ID'=> $select_id);
									  $db->insert_from_array($sql_hobbies_data_array,INTERESTTBL);
							 }
							}	
						 redirect('','upd=1&sort=student_ID desc ');
						 break;
				
	case 'delete':
							$db->query("delete from ".TABLE." where student_ID='".$select_id."'");
							$db->query("delete from ".SIBLINGSTBL." where student_ID='".$select_id."'");
							$db->query("delete from ".FAMILYTBL." where student_ID='".$select_id."'");
							$db->query("delete from ".QUALITYTBL." where student_ID='".$select_id."'");
							$db->query("delete from ".INTERESTTBL." where student_ID='".$select_id."'");
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
							   $db->query("delete from ".SIBLINGSTBL." where student_ID='".$list[$i]."'");
							   $db->query("delete from ".QUALITYTBL." where student_ID='".$list[$i]."'");
							   $db->query("delete from ".INTERESTTBL." where student_ID='".$list[$i]."'");
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
		  list($student_id, $name, $mst_id, $place, $post_code, $district, $state, $country, $route_to_house, $dob, $land_phone, $cell_phone, $email,  $fb, $whats_up, $school_teacher_name, $school_name, $parish_id, $parish_teacher_id, $description, $study_status_id, $student_category) = $db->fetch_one_row("SELECT student_ID, name, mst_id, place, post_code, district, state, country, route_to_house, dob, land_phone, cell_phone, email,  fb, whats_up, school_teacher_name, school_name, parish_ID, teacher_ID, description, study_status_id, student_category_id FROM ".TABLE." WHERE student_ID='".$select_id."'");
		  
	  list($family_name, $family_financial_status, $family_id, $reputation, $relation_with_parish_id)=$db->fetch_one_row("SELECT family_name, family_financial_status, family_id, reputation, relation_with_parish_id	FROM ".FAMILYTBL." WHERE student_ID='".$select_id."'"); 
	  
		 list($siblings_name, $siblings_occupation, $relation_with_student)=$db->fetch_one_row("SELECT siblings_name, siblings_occupation, relation_with_student	FROM ".SIBLINGSTBL." WHERE student_ID='".$select_id."'"); 
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