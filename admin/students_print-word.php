<?php
require('../application_top.php');
define('MODULEID','6');
require(DIR_ADMIN_INCLUDE.'session.php');
define('TABLE',MTABLE.'students');
define('CLASS_TBL',MTABLE.'class_list');
define('FAMILYTBL',MTABLE.'family');
define('RELATIONSTBL',MTABLE.'student_relations');
define('QUALITYTBL',MTABLE.'student_qualities');
define('INTERESTTBL',MTABLE.'student_interests');
define('CONFI_TBL', MTABLE.'confidential_reports');
define('EXAM_RESULT_TBL', MTABLE.'exam_results');
define('EXAMTBL', MTABLE.'exams');
define('PARISHTBL', MTABLE.'parish');
define('DIOCESE_TBL', MTABLE.'diocese');
define('EXAM_MODEL_TBL', MTABLE.'exam_model_list');
define('VP_TBL', MTABLE.'vp');
 $GrpPage = 3;
  list($student_id, $name, $name_title, $mst_id, $place, $post_code, $post_box, $post_office, $district, $state, $country, $route_to_house, $dob, $land_phone, $cell_phone, $email,  $fb, $whats_up, $school_teacher_name, $school_teacher_phone, $school_name, $school_syllabus, $parish_id, $parish_teacher_id, $d, $study_status_id, $student_category, $altara_boy, $church_going, $camp_attended, $interest_to_be_priest, $awards_received,  $percentage,  $siblings_no, $date, $nuns_family, $priests_family, $class, $profile_image ) = $db->fetch_one_row("SELECT student_ID, name, name_title,  mst_id, place, post_code, post_box, post_office, district, state, country, route_to_house, dob, land_phone, cell_phone, email,  fb, whats_up, school_teacher_name, school_teacher_phone,  school_name, school_syllabus, parish_ID, teacher_ID, description, study_status_id, student_category_id, altara_boy, church_going, camp_attended, interest_to_be_priest, awards_received, percentage , siblings_no, date, nuns_family, priests_family, class, profile_image  FROM ".TABLE." WHERE student_ID='".$select_id."'"); 

	 list($family_name, $family_financial_status, $family_id, $reputation, $relation_with_parish_id)=$db->fetch_one_row("SELECT family_name, family_financial_status, family_id, reputation, relation_with_parish_id	FROM ".FAMILYTBL." WHERE student_ID='".$select_id."'"); 
	  
		  list($father_relation_id, $father_name, $father_occupation, $relation_with_student, $father_mobile)=$db->fetch_one_row("SELECT student_relation_ID, relation_name, relation_occupation, relation_with_student, relation_phone, relation_phone	FROM ".RELATIONSTBL." WHERE student_ID='".$select_id."' AND relation_with_student='father'"); 
		 
		   list($mother_relation_id, $mother_name, $mother_occupation, $relation_with_student, $mother_mobile)=$db->fetch_one_row("SELECT student_relation_ID, relation_name, relation_occupation, relation_with_student, relation_phone	FROM ".RELATIONSTBL." WHERE student_ID='".$select_id."' AND relation_with_student='mother'");
		   
		    list($guardian_relation_id, $guardian_father, $guardian_father_occupation, $relation_with_student, $grand_parent_phone)=$db->fetch_one_row("SELECT student_relation_ID, relation_name, relation_occupation, relation_with_student	FROM ".RELATIONSTBL." WHERE student_ID='".$select_id."' AND relation_with_student='grand parent'");
		    
		   list($creport_id, $student_id, $title, $interview_comments, $interview_results, $interviewed_by, $psychological_results, $description ) = $db->fetch_one_row("SELECT creport_ID, student_ID, title, interview_comments,  interview_results, interviewed_by, psychological_results, description FROM ".CONFI_TBL." WHERE student_ID='".$select_id."'");
		    list($exam_id, $student_id, $exam_model) = $db->fetch_one_row("SELECT exam_ID, student_ID, exam_model FROM ".EXAMTBL." WHERE student_ID='".$select_id."'");
		   $siblings_arr = getResultArray("SELECT * FROM ".RELATIONSTBL."  WHERE  student_ID = $select_id  AND sibling=1 ORDER BY student_relation_ID");
//if(isset($_POST['word'])){

header("Content-type: application/vnd.ms-word"); 

# replace Wordfile.doc with whatever you want the filename to default to

header("Content-Disposition: attachment;Filename=Wordfile.doc");

header("Pragma: no-cache");

header("Expires: 0");

$current_date = date('d-m-Y');
//$heading = $name;
$class_list=getResultArray("SELECT * FROM ".CLASS_TBL." WHERE status = 1  ORDER BY class_ID asc ");


$content = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ordrtablelist" >
     <tr>
    <td width="19%" align="left" valign="top">Name</td>
    <td width="25%" align="left" valign="top">'.$name.'</td>
    <td width="27%" align="left" valign="top">Baptismal Name</td>
    <td width="29%" align="left" valign="top">'.$baptism_name.'</td>
     </tr>
  <tr>
    <td align="left" valign="top">Nick name</td>
    <td align="left" valign="top">'.$nick_name.'</td>
    <td align="left" valign="top">Surname</td>
    <td align="left" valign="top">'.$surname.'</td>
  </tr>
  <tr>
    <td align="left" valign="top">School   </td>
    <td align="left" valign="top">'.$school.'</td>
    <td align="left" valign="top">Age</td>
    <td align="left" valign="top">'.$age.'</td>
  </tr>
  <tr>
    <td align="left" valign="top">Class</td>
    <td align="left" valign="top">'.$class.'</td>
    <td align="left" valign="top">Parish</td>
    <td align="left" valign="top">'.$class.'</td>
  </tr>
  <tr>
    <td align="left" valign="top">Place</td>
    <td align="left" valign="top">'.$place.'</td>
    <td align="left" valign="top">Diocese </td>
    <td align="left" valign="top">'.$diocese.'</td>
  </tr>
  <tr>
    <td align="left" valign="top">Forane	</td>
    <td align="left" valign="top">'.$forane.'</td>
    <td align="left" valign="top">Place</td>
    <td align="left" valign="top">'.$place.'</td>
  </tr>
  <tr>
    <td align="left" valign="top">DOB</td>
    <td align="left" valign="top">'.$dob.'</td>
    <td align="left" valign="top">Altar Boy   </td>
    <td align="left" valign="top">'.$altara_boy.'</td>
  </tr>
  
</table>';

echo $content;
//}

?>