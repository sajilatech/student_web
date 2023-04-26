<?php  
require('../application_top.php');
define('MODULEID','6');
require(DIR_ADMIN_INCLUDE.'session.php');
define('TABLE',MTABLE.'students');
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
define('FAMILY_PRAYER_TBL', MTABLE.'family_prayer_list');
define('KURBANA_ATTEND_TBL', MTABLE.'kurbana_attend_list');
 $GrpPage = 3;
    list($student_id, $name,  $baptism_name, $nick_name, $name_title, $mst_id, $house_name, $place, $post_code, $post_box, $post_office, $district, $state, $country, $route_to_house, $dob, $land_phone, $cell_phone, $email,  $fb, $whats_up, $school_teacher_name, $school_teacher_phone, $school_name, $school_syllabus, $parish_id, $parish_teacher_id, $d, $study_status_id, $student_category, $altara_boy, $catechism_class, $from_class, $kurbana_attend, $family_prayer, $church_going, $camp_attended, $interest_to_be_priest, $awards_received,  $percentage,  $siblings_no, $date, $nuns_family, $priests_family, $class, $profile_image ) = $db->fetch_one_row("SELECT student_ID, name, baptism_name, nick_name, name_title,  mst_id, house_name, place, post_code, post_box, post_office, district, state, country, route_to_house, dob, land_phone, cell_phone, email,  fb, whats_up, school_teacher_name, school_teacher_phone,  school_name, school_syllabus, parish_ID, teacher_ID, description, study_status_id, student_category_id, altara_boy, catechism_class, from_class, kurbana_attend, family_prayer, church_going, camp_attended, interest_to_be_priest, awards_received, percentage , siblings_no, date, nuns_family, priests_family, class, profile_image  FROM ".TABLE." WHERE student_ID='".$select_id."'"); 
		 
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
						//print_r($lik['name']);
						if($count < count($likes_arr)) {
							//print_r(',');
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
						//print_r($lik['name']);
						if($count < count($hobbies_arr)) {
							//print_r(',');
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
			 $certificates_arr = getResultArray("SELECT * FROM ".MTABLE."student_certificates WHERE  student_ID = $select_id  ORDER BY certificate_ID");
			  list($diocese_id, $parish_name, $vicari, $vicari_phone) = $db->fetch_one_row("SELECT diocese_ID, name, vicari, phone FROM ".PARISHTBL." WHERE parish_ID='".$parish_id."'");
			   list($diocese_name) = $db->fetch_one_row("SELECT diocese_name FROM ".DIOCESE_TBL." WHERE diocese_ID='".$dioese_id."'");
			  
			   list($vp_ID, $vp_name, $vp_phone, $vp_address, $vp_whatsup, $vp_fb)=$db->fetch_one_row("SELECT vp_id, vp_name, vp_phone, vp_address, vp_whatsup, vp_fb	FROM ".VP_TBL." WHERE student_ID='".$select_id."'"); 
			 //  print_r("SELECT * FROM ".MTABLE."questions_answers WHERE  student_ID = ".$select_id);exit;
			    $question_answer_arr = getResultArray("SELECT * FROM ".MTABLE."questions_answers WHERE  student_ID = ".$select_id );
			 // require_once("header.php"); 
			 ?>

  <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>St Thomas the Apostle</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="normalize.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="css/paper.css">
  <link rel="stylesheet" type="text/css" href="css/font.css">
  
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan" rel="stylesheet"> 

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: A4 }</style>
   <style>
  body   { font-family:Arial, Helvetica, sans-serif; color:#000; }
  h1      { margin: 0px 0px 15px 0px; font-size:24px; color:#000;font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center;
  line-height:25px; }
  h3{ font-size: 18px;    font-weight: bold; margin:20px 0px 10px 0px;    padding-left: 0px;}
  
  .item{
	  margin-top:10px;
  }
   .item td{
	   padding:7px;
	   font-size:12pt; 
	   font-weight:normal; 
	   line-height:17px;
	   border-bottom:2px solid #000;
  }
    .item th{
	   padding:7px;
	   font-size:11pt; 
	   font-weight:bold; 
	   line-height:17px;
	   border-bottom:3px solid #000;
	   border-top:3px solid #000;
  }
    .gst{
	  margin-top:10px;
  }
   .gst td{
	   padding:7px;
	   font-size:12pt; 
	   font-weight:normal; 
	   line-height:17px;
	   border-top:2px solid #000;
  }
    .gst th{
	   padding:7px;
	   font-size:13pt; 
	   font-weight:normal; 
	   line-height:17px;
  }
      .order{
	  margin-top:0px;
  }
   .order td{
	   padding:7px;
	   font-size:13pt; 
	   font-weight:normal; 
	   line-height:17px;
  }
  .order td b{
	  font-weight:bold;
	  font-size:14pt;
  }
  .tlist{
	  font-family: 'Baloo Chettan', cursive; margin:0px 0px 0px 0px; font-size:12px; border-top:#000 1px solid; border-left:#000 1px solid; 
  }
    .tlist td{
		border-bottom:#000 1px solid;
		border-right:#000 1px solid;
		padding:5px;
  }
  
  </style>
  </head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
  
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

   <article>
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <td style="font-size:12pt; font-weight:normal; text-align:center;"><img src="images/printlogo.png" alt="" align="left" ><h4 style="padding:0px; margin:0px; font-family:'Times New Roman', Times, serif; font-size:27px; font-weight:bold;">Vocation Promotion Centre</h4>
<b><span style="color:#00b050;">The Missionary Society of St Thomas the Apostle (MST)</span><br>
Deepti Mount, Melampara – 686578, Kottayam
 </b><br>
<h3 style="color:#0070c0; font-size:19px; font-weight:bold; padding:0px; margin:10px 0px 0px 0px;font-family:'Times New Roman', Times, serif;">PERSONAL DETAILS</h3></td>
  </tr>
</table>

   <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: 'Baloo Chettan', cursive; margin:20px 0px 0px 0px; font-size:13px;">
     <tr>
    <td width="19%" align="left" valign="top">Candidae name is </td>
    <td width="25%" align="left" valign="top">:<?php echo $name;?></td>
    <td width="27%" align="left" valign="top">Candidate's Babtismal name is </td>
    <td width="29%" align="left" valign="top">:<?php echo $baptism_name;?></td>
     </tr>
  <tr>
    <td align="left" valign="top" colspan="2">He is called <?php echo $nick_name;?>at home </td></tr>
    <tr><td align="left" valign="top" colspan="2">His sir name is &nbsp;<?php echo $name_title;?> </td></tr>
    <td align="left" valign="top">:<?php echo $house_name;?></td>
    <td align="left" valign="top">സ്കൂള്‍ </td>
    <td align="left" valign="top">:<?php echo $school_name;?></td>
  </tr>
  <tr>
    <td align="left" valign="top">ക്ലാസ്സ്‌</td>
    <td align="left" valign="top">:<?php echo $class;?></td>
    <td align="left" valign="top">ഇടവക</td>
    <td align="left" valign="top">:<?php echo $diocese_name;?></td>
  </tr>
  <tr>
    <td align="left" valign="top">സ്ഥലം</td>
    <td align="left" valign="top">:<?php echo $place;?></td>
    <td align="left" valign="top">അള്‍ത്താര ബാലനാണോ</td>
    <td align="left" valign="top">: <?php if($altara_boy=='1'){ echo 'Y';}else{ echo 'N';}?></td>
  </tr>
  <tr>
    <td align="left" valign="top">ഏതു ക്ലാസ്സ്‌ മുതല്‍ </td>
    <td align="left" valign="top">:<?php echo $from_class;?></td>
    <td align="left" valign="top">വേദപാഠം ക്ലാസ്സ്‌</td>
    <td align="left" valign="top">: <?php echo $catechism_class;?> </td>
  </tr>
  <tr>
    <td align="left" valign="top">പിതാവിന്‍റെ പേര് </td>
    <td align="left" valign="top">:<?php echo $father_name;?></td>
    <td align="left" valign="top">വിളി പേര്</td>
    <td align="left" valign="top">: <?php echo $father_nickname;?></td>
  </tr>
  <tr>
    <td align="left" valign="top">മാതാവിന്‍റെ പേര് </td>
    <td align="left" valign="top">:<?php echo $mother_name;?></td>
    <td align="left" valign="top">തൊഴില്‍</td>
    <td align="left" valign="top">:<?php echo $mother_occupation;?></td>
  </tr>
  <tr>
    <td colspan="4" align="left" valign="top">സഹോദരന്മാര്‍ / സഹോദരിമാര്‍ ( മൂത്തവര്‍ തുടങ്ങി താഴോട്ട് )</td>
    </tr>
</table>
<?php if(!empty($siblings_arr)){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tlist" >
  <tr>
    <td width="34%">പേര് </td>
    <td width="10%">വയസ്സ്</td>
    <td width="35%">വിദ്യാഭ്യാസം</td>
    <td width="21%"> പദവി</td>
  </tr>
 <?php $count=1;
 foreach($siblings_arr as $row){?>
  <tr>
    <td><?php echo $count;?></td>
    <td><?php echo $row['relation_name'];?></td>
    <td><?php echo $row['relation_age'];?></td>
    <td><?php echo $row['relation_education'];?></td>
    <?php echo $row['relation_occupation'];?>
  </tr>
  <?php 
 }?>
</table>
<?php }
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: 'Baloo Chettan', cursive; margin:0px 0px 0px 0px; font-size:13px;">
 <?php if(!empty($question_answer_arr)){
	  $c=1;
	  foreach($question_answer_arr as $ro){ ?>
	<tr>
    <td width="22%" align="left" valign="top"> <?php echo $ro['questions'];?></td>
    <td width="22%" align="left" valign="top">:</td>
    <td width="27%" align="left" valign="top"><?php echo $ro['answers'];?></td>
    
     </tr>
<?php
	  }
 }
	  ?>
   <?php 
   $last_exam_arr=getResultArray("SELECT * FROM ".MTABLE."exams WHERE  student_ID = ".$select_id." ORDER BY exam_ID DESC LIMIT 1");
   if(!empty($last_exam_arr)){ 
	   foreach($last_exam_arr as $row){
		   $last_exam_id=$row['exam_ID'];
		  }
		  
		
		 $last_exam_result_arr=getResultArray("SELECT * FROM ".MTABLE."exam_results WHERE  exam_ID = ".$last_exam_id." ORDER BY exam_ID ASC"); 
	  } 
	  if(!empty($last_exam_result_arr)){
   ?>
  <tr>
    <td colspan="4" align="left" valign="top">അവസാന പരീക്ഷക്ക്‌ ലഭിച്ച മാര്‍ക്ക്, 
      Subject with Total Marks:<br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tlist" >
      <?php 
	  $tr_count=1;
	  foreach($last_exam_result_arr as $arr){
		  if($tr_count=='1'){ echo '<tr>';}
		  ?>
  
    <td><?php echo $arr['subjects'];?></td><td><?php echo $arr['marks'];?></td>
   <?php 
   $tr_count++;
   
   		if($tr_count=='5'){ echo '</tr>'; $tr_count=1;}
	  }?>
  </tr>
  
  </table></td>
    </tr>
    <?php }?>
    <tr>
    <td colspan="4" align="left" valign="top">പരി. കുര്‍ബാനയില്‍ സംബന്ധിക്കുന്നത് ?<br>
    <?php 	$kurbana_attend_arr=getResultArray("SELECT * FROM ".KURBANA_ATTEND_TBL." WHERE status = 1  ORDER BY kurbana_attend_ID asc ");?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tlist" >
  <tr><?php $a=1;
   foreach($kurbana_attend_arr as $row){?>
    <td><?php echo $a;?>) <?php echo $row['name'];?>&nbsp;<?php if($row['kurbana_attend_ID']==$kurbana_attend){ echo '<img src="images/tick.png"  height="20" width="20">';}?></td>
    <?php $a++;}?>
  </tr>
  </table></td>
    </tr>
    <?php  if(!empty($question_answer_arr)){ print_r("questions");
	foreach($question_answer_arr as $row){?>
    <tr>
    <td colspan="4" align="left" valign="top">
  </td>
    </tr>
  <tr>
    <td align="left" valign="top"><?php $row['questions'];?></td>
    <td align="left" valign="top">:<?php $row['answers'];?></td>
  </tr>
  <?php 
	}
	}
	else{
		print_r("no questions");
		}
	?>
      <tr>
    <td colspan="4" align="left" valign="top">വീട്ടില്‍ കുടുംബ പ്രാര്‍ത്ഥന ചെല്ലുന്നത് <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tlist" >
      <?php   $family_prayer_array=getResultArray("SELECT * FROM ".FAMILY_PRAYER_TBL." WHERE status = 1  ORDER BY family_prayer_ID asc "); 
	  ?>
<tr><?php $a=1;
   foreach($family_prayer_array as $row){?>
    <td><?php echo $a;?>) <?php echo $row['name'];?>&nbsp;<?php if($row['family_prayer_ID']==$family_prayer){ echo '<img src="images/tick.png"  height="20" width="20">';}?></td>
    <?php $a++;}?>
  </tr>
  </table></td>
    </tr>
         
    
    <tr>
    <td colspan="4" align="left" valign="top">ഏതൊക്കെ സ്കൂളില്‍ ആണ് പഠിച്ചിട്ടുള്ളത് ? (താഴെ എഴുതുക )  <br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tlist" >
  <tr>
    <td>School</td>
    <td>Syllabus</td>
    <td>place</td>
    </tr>
  <tr>
    <td>L.P.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>U.P.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>H.S.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>H.S.S.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table></td>
    </tr>
    
  
<table width="486">
       <tr>
    <td align="left" valign="top">Personal E-mail</td>
    <td align="left" valign="top"><?php echo $email;?></td>
    
    <td align="left" valign="top">Whatsapp</td>
    <td align="left" valign="top"><?php echo $whats_up;?></td>
  </tr> 
  
        <tr>
    <td align="left" valign="top">Facebook</td>
    <td align="left" valign="top"><?php echo $fb;?></td>
    <td align="left" valign="top">Instagram</td>
    <td align="left" valign="top"><?php echo $instagram;?></td>
  </tr> 
  
        <tr>
    <td align="left" valign="top">Contact No: Father</td>
    <td align="left" valign="top"><?php echo $father_mobile;?></td>
    <td align="left" valign="top">Mother</td>
    <td align="left" valign="top"><?php echo $mother_mobile;?></td>
  </tr> 
  
        <tr>
    <td align="left" valign="top">Brother</td>
    <td align="left" valign="top"></td>
    <td align="left" valign="top">Personal</td>
    <td align="left" valign="top"></td>
  </tr> 
  
    </table>
        <tr>
    <td colspan="4" align="left" valign="top">രക്ഷകര്തവിന്റെ മേല്‍വിലാസം <br>
<br>
<br>
<br>
</td>
  </tr>
       <tr>
    <td align="left" valign="top">സ്ഥലം:<br>
തിയ്യതി : </td>
    <td align="left" valign="top"></td>
    <td align="left" valign="top">അപേക്ഷകന്റെ പേര് :<br>
അപേക്ഷകന്റെ ഒപ്പ് :</td>
    <td align="left" valign="top"></td>
  </tr> 
  
  
  
</table>

</article>
</section>

</body>
</html>