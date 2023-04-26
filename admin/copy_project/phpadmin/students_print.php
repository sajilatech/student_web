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
 $GrpPage = 3;
  list($student_id, $name, $name_title, $mst_id, $place, $post_code, $post_box, $post_office, $district, $state, $country, $route_to_house, $dob, $land_phone, $cell_phone, $email,  $fb, $whats_up, $school_teacher_name, $school_teacher_phone, $school_name, $school_syllabus, $parish_id, $parish_teacher_id, $d, $study_status_id, $student_category, $altara_boy, $church_going, $camp_attended, $interest_to_be_priest, $awards_received,  $percentage,  $siblings_no, $date, $nuns_family, $priests_family, $class, $profile_image ) = $db->fetch_one_row("SELECT student_ID, name, name_title,  mst_id, place, post_code, post_box, post_office, district, state, country, route_to_house, dob, land_phone, cell_phone, email,  fb, whats_up, school_teacher_name, school_teacher_phone,  school_name, school_syllabus, parish_ID, teacher_ID, description, study_status_id, student_category_id, altara_boy, church_going, camp_attended, interest_to_be_priest, awards_received, percentage , siblings_no, date, nuns_family, priests_family, class, profile_image  FROM ".TABLE." WHERE student_ID='".$select_id."'"); 

	 list($family_name, $family_financial_status, $family_id, $reputation, $relation_with_parish_id)=$db->fetch_one_row("SELECT family_name, family_financial_status, family_id, reputation, relation_with_parish_id	FROM ".FAMILYTBL." WHERE student_ID='".$select_id."'"); 
	  
		  list($father_relation_id, $father_name, $father_occupation, $relation_with_student, $father_mobile)=$db->fetch_one_row("SELECT student_relation_ID, relation_name, relation_occupation, relation_with_student, relation_phone, relation_phone	FROM ".RELATIONSTBL." WHERE student_ID='".$select_id."' AND relation_with_student='father'"); 
		 
		   list($mother_relation_id, $mother_name, $mother_occupation, $relation_with_student, $mother_mobile)=$db->fetch_one_row("SELECT student_relation_ID, relation_name, relation_occupation, relation_with_student, relation_phone	FROM ".RELATIONSTBL." WHERE student_ID='".$select_id."' AND relation_with_student='mother'");
		   
		    list($guardian_relation_id, $guardian_father, $guardian_father_occupation, $relation_with_student, $grand_parent_phone)=$db->fetch_one_row("SELECT student_relation_ID, relation_name, relation_occupation, relation_with_student	FROM ".RELATIONSTBL." WHERE student_ID='".$select_id."' AND relation_with_student='grand parent'");
		    
		   list($creport_id, $student_id, $title, $interview_comments, $interview_results, $interviewed_by, $psychological_results, $description ) = $db->fetch_one_row("SELECT creport_ID, student_ID, title, interview_comments,  interview_results, interviewed_by, psychological_results, description FROM ".CONFI_TBL." WHERE student_ID='".$select_id."'");
		    list($exam_id, $student_id, $exam_model) = $db->fetch_one_row("SELECT exam_ID, student_ID, exam_model FROM ".EXAMTBL." WHERE student_ID='".$select_id."'");
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
			   list($vp_ID, $vp_name, $vp_phone, $vp_address, $vp_whatsup, $vp_fb)=$db->fetch_one_row("SELECT vp_id, vp_name, vp_phone, vp_address, vp_whatsup, vp_fb	FROM ".VP_TBL." WHERE student_ID='".$select_id."'"); 
			  require_once("header.php");?>
<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#"> Students MGT</a></li>
                 <li><a href="students.php">Students Listing</a></li>
				  <li class="active">Student View</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
            
				<div class="col-md-3 splpadding">
					<div class="block-flat2">
                    <h3>Personal Informations</h3>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="../uploads/profile/<?php echo $profile_image;?>" alt=""></td>
    </tr>
  <tr>
    <td>MST ID</td>
    <td><?php echo $mst_id; ?></td>
  </tr>
  <tr>
    <td>Date <span style="color:#F00;">*</span></td>
    <td>  <?php  echo date('d-m-Y',$date); ?> </td>
  </tr>
  <tr>
    <td>Title <span style="color:#F00;">*</span></td>
    <td> <?php if($name_title=='Mr'){ ?>Mr<?php }?>
      <?php if($name_title=='Rev'){ ?>Rev<?php }?></td>
  </tr>
  <tr>
    <td>Category <span style="color:#F00;">*</span></td>
    <td> <?php 
				 foreach($student_category_list as $key=> $value){
				 if($key==$student_category){  echo $value; } } ?> </td>
  </tr>
  <tr>
    <td>Name</td>
    <td>><?php echo $name; ?></td>
  </tr>
   <tr>
    <td>Baptism Name</td>
    <td><?php echo $bapti_name; ?></td>
  </tr>
  <tr>
    <td>Father's Name</td>
    <td><?php echo $father_name; ?></td>
  </tr>
  <tr>
    <td>Father's Occupation</td>
    <td><?php echo $father_occupation; ?></td>
  </tr>
   <tr>
    <td>Mother's Name</td>
    <td><?php echo $mother_name; ?></td>
  </tr>
  <tr>
    <td>Mother's Occupation</td>
    <td><?php echo $mother_occupation; ?></td>
  </tr>
  <tr>
    <td>Place</td>
    <td><?php echo $place; ?></td>
  </tr>
  <tr>
    <td>DOB</td>
    <td> <?php  echo date('d-m-Y',$dob);  ?> </td>
  </tr>
</table>

           <h3>Telephone & Email</h3>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td>Land Line 1</td>
    <td><?php echo $land_phone; ?></td>
  </tr>
  <tr>
    <td>Cell</td>
    <td><?php echo $mobile; ?></td>
  </tr>
   <tr><td>Father Mobile</td><td>
<?php echo $father_mobile; ?></td></tr>
<tr><td>Mother Mobile</td><td>
<?php echo $mother_mobile; ?></td>
  </tr>
  <tr>
    <td>Whatsapp</td>
    <td><?php echo $whats_up;?></td>
  </tr>
  <tr>
    <td>Email<span style="color:#F00;">*</span></td>
    <td><?php echo $email;?></td>
  </tr>
  <tr>
    <td>FB</td>
    <td><?php echo $fb;?></td>
  </tr>
</table>


           <h3>Postal Address</h3>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td>Post Box</td>
    <td><?php echo $post_box;?></td>
  </tr>
  <tr>
    <td>Post office</td>
    <td><?php echo $post_office;?></tr>
  <tr>
    <td>Pin Code</td>
    <td><?php echo $post_code;?></td>
  </tr>
  <tr>
    <td>District</td>
    <td><?php echo $district;?></td>
  </tr>
  <tr>
    <td>State</td>
    <td><?php echo $state;?></td>
  </tr>
   <tr>
    <td>Country</td>
    <td>  <?php  foreach($country_array as $key=>$value){
				  
				  if($key==$country){  echo $value;  } 
			   }?></td>
  </tr>
</table>

       <h3>Diocese & Parish</h3>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
                        <?php  list($diocese_name) = $db->fetch_one_row("SELECT diocese_name FROM ".DIOCESE_TBL." WHERE diocese_ID='".$diocese."'"); ?>
  <tr>
    <td>Diocese</td>
    <td><?php echo $diocese_name;?></td>
  </tr>
  <tr>
    <td>Parish</td>
    <td> <?php 
					  $parish_arr=getResultArray("SELECT parish_ID, name FROM ".MTABLE."parish WHERE parish_status = 1  ORDER BY parish_ID asc "); 
				 foreach($parish_arr as $row){
				 
				 if($row['parish_ID']==$parish_id){ echo $row['name'];  } 
				 }?></tr>
  <tr>
    <td>Parish Telephone</td>
    <td>234567788</td>
  </tr>
  <tr>
    <td>Vicar Address</td>
    <td><?php echo $vicari;?></td>
  </tr>
  <tr>
    <td>Contact Member</td>
    <td><?php echo $vicari_phone;?></td>
  </tr>
</table>

       <h3>Contacted Through</h3>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td>Name</td>
    <td>Daweds</td>
  </tr>
    <tr>
    <td>Phone Number</td>
    <td><?php echo $vp_phone;?></td>
  </tr>
    <tr>
    <td>Address</td>
    <td>swSWQDQ DCQDQ caefcwfd</td>
  </tr>
    <tr>
    <td>Whatsapp Number</td>
    <td>12345678</td>
  </tr>
    <tr>
    <td>Facebook ID</td>
    <td>sderwa</td>
  </tr>
                      </table>
						
					</div>				
				</div>
				
				<div class="col-md-3 splpadding">
					<div class="block-flat2">
                    <h3>Time</h3>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td>Class</td>
    <td>  <?php 
				 foreach($class_list as $key=> $value){
				 if($key==$class){  echo $value;  }
				 }?></td>
  </tr>
  <tr>
    <td>School Syllabus</td>
    <td>  <?php 
				 foreach($school_syllabus_list as $key=> $value){
				  if($key==$school_syllabus){  echo $value;  }
				 }?></td>
  </tr>
  <tr>
    <td>Place </td>
    <td><?php echo $place;?></td>
  </tr>
  <tr>
    <td>Sunday School</td>
    <td><?php echo $school_name;?></td>
  </tr>
  <tr>
    <td>Class Teacher</td>
    <td><?php echo $school_teacher_name; ?></td>
  </tr>
  <tr>
    <td>Contact No</td>
    <td><?php echo $school_teacher_phone;?></td>
  </tr>
  <tr>
    <td>Sunday School Teacher</td>
    <td>  <?php $teachers_arr=getResultArray("SELECT teacher_ID, name FROM ".MTABLE."teachers WHERE teacher_status = 1  ORDER BY teacher_ID asc "); 
				 foreach($teachers_arr as $row){
				 	if($row['teacher_ID']==$parish_teacher_id){ echo $row['name']; } 
				 }?></td>
  </tr>
  
 </table>	
 
 <h3>Members of the Family</h3>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td>Father of Gaurdian</td>
    <td><?php echo $guardian_father;?></td>
  </tr>
  <tr>
    <td>Occupation</td>
    <td><?php echo $guardian_father_occupation ;?> </td>
  </tr>
  <tr>
    <td>Wedding Day </td>
    <td>5th Dec</td>
  </tr>
  <?php

	 if(!empty($siblings_arr)){ 
		 $i=1;
		 foreach($siblings_arr as $row){?>
			 <tr><td>Sibling <?php echo $i;?> Name</td><td><?php echo $row['relation_name'];?></td></tr>
  <tr><td>Relation </td><td><?php if($row['relation_with_student'] =='brother'){ ?>Brother<?php }
  		 if($row['relation_with_student'] =='sister'){ ?>Sister<?php }?></td></tr>
                   <tr><td>Occupation</td><td><?php echo $row['relation_occupation'];?></td></tr>
<?php		 }
	}
 
 ?>
   <tr>
    <td>Preests in Fam</td>
    <td><?php echo $priests_family;?></td>
  </tr>
   <tr>
    <td>Nuns in Fam</td>
    <td><?php echo $nuns_family;?></td>
  </tr>
  
 </table>	
      
      <h3>Place</h3> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td colspan="2">House is Situated</td>
    </tr>
  <tr>
    <td colspan="2"><?php echo $route_to_house;?></td>
    </tr>
  <tr>
    <td colspan="2"><?php echo $d;?></td>
    </tr>
  
     <tr>
    <td colspan="2" class="block"> <?php if(!empty($certificates_arr)){ ?>
    <div class="content no-padding ">
							<ul class="items" > <?php foreach($certificates_arr as $row){  ?>
								<li style="padding-left:0px;"><a href="<?php echo '../'.UPLOADS."/certificates/".$row['file_name']?>" target="_blank"><i class="fa fa-file-text" style="line-height:10px;"></i><?php echo $row['file_name'];?></a> </li>
                                <?php
						  }
						  ?>
                                </ul></div><?php }?>
    </td>
    </tr>
  </table>
                 
                    

						
					</div>				
				</div>
                
                <div class="col-md-3 splpadding">
					<div class="block-flat2">
                    <h3>Family Status</h3>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td>Financial</td>
    <td>  <?php foreach($family_financial_status_list as $key=>$value){
					  if($key==$family_financial_status){ echo $value;  }
				  }?></td>
  </tr>
  <tr>
    <td>Reputation in Parish</td>
    <td> <?php foreach($reputation_list as $key=>$value){
					  if($key==$reputation){ echo $value;  }
				  }?></td>
  </tr>
  
    <tr>
    <td>Relation with Parish</td>
    <td>  <?php 
				 foreach($relation_with_parish_list as $key=> $value){
				  
				 if($key==$relation_with_parish_id){ echo $value;  } 
				 }?></td>
  </tr>
                    </table>	
                    
                          <h3>Family Related Details</h3> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
<?php $question_typ_arr = getResultArray("SELECT * FROM ".MTABLE."question_type_list WHERE  status = 1 ORDER BY question_type_ID");
if(!empty($question_typ_arr)){
	$inline_count=1;
	foreach($question_typ_arr as $row){
	?>
  <tr>
    <td colspan="2"><?php echo $row['name'];?><br>
<a class="fancybox" href="#inline<?php echo $inline_count;?>" title="Family Details"><span class="label label-danger" style="margin:5px 0px; padding:5px 5px; float:left;">View</span></a></td>
    </tr>
    <?php
	$inline_count++;
	}?>
      </table>
      <?php 
	  $in_count=1;
	  foreach($question_typ_arr as $row){
		  $question_type_id=$row['question_type_ID'];
		  ?>
     <div id="inline<?php echo $in_count;?>" style="width:500px;display: none;" class="inlinepopup">
		<h3><?php echo $row['name'];?></h3>
		<p>
         <?php $question_answer_arr = getResultArray("SELECT * FROM ".MTABLE."questions_answers WHERE  question_type_ID =  '".$question_type_id."' ORDER BY question_type_ID");
			if(!empty($question_answer_arr)){
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top:1px solid #dadada;">
        <?php foreach($question_answer_arr as $arr){?>   
  <tr>
    <td><?php echo $count;?>) <?php echo $arr['questions'];?>?<br>
Ans) <?php echo $arr['answers'];?></td>
  </tr>
 <?php }?>
</table>
<?php }?>

		</p>
	</div>
    <?php
	$in_count++;
	  }
}?>
  <!-- <tr>
    <td colspan="2">Intellactual<br>
<a class="fancybox" href="#inline3" title="Family Details"><span class="label label-danger" style="margin:5px 0px; padding:5px 5px; float:left;">View</span></a></td>
    </tr>
    
   <tr>
    <td colspan="2">Physical & Mental<br>
<a class="fancybox" href="#inline3" title="Family Details"><span class="label label-danger" style="margin:5px 0px; padding:5px 5px; float:left;">View</span></a></td>
    </tr>
       <tr>
    <td colspan="2">Talents<br>
<a class="fancybox" href="#inline3" title="Family Details"><span class="label label-danger" style="margin:5px 0px; padding:5px 5px; float:left;">View</span></a></td>
    </tr>-->

  
  
                   
                   <h3>Qualities of Candidate</h3>
                   
                   		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td>Alter Boy</td>
    <td> <?php if($altara_boy=='1'){ ?>> Yes  <?php }if($altara_boy=='0' || $altara_boy='' ){ ?> > No<?php }?>  </td>
  </tr>
  <tr>
    <td>Church Going</td>
    <td><?php
				 foreach($church_going_list as $key=> $value){
				  
				 if($key==$church_going){ echo $value;  }
				 }?></td>
  </tr>
 
    <tr>
    <td>Study</td>
    <td><?php foreach($study_status_list as $key=> $value){
					 
				 if($key==$study_status_id){ echo $value;  }
	}?></td>
  </tr>
   <tr>
    <td>Percentage % </td>
    <td><?php echo $percentage; ?></td>
  </tr>
   <tr>
    <td>Qualities </td>
    <td> <?php 
				$j=0;
				  foreach($qualities_list as $key=>$value){  
					  if($key==$qualities_arr[$j]['questions']){
							 echo $value;
						 }
						
					 
					}
					?></td>
  </tr>
   <tr>
    <td>Likes </td>
    <td><?php echo $likes;?></td>
  </tr>
   <tr>
    <td>Dislikes</td>
    <td><?php echo $dislikes;?></td>
  </tr>
   <tr>
    <td>Excellence Awards Received </td>
    <td><?php echo $awards_received;?></td>
  </tr>
   <tr>
    <td>Hobbies </td>
    <td><?php echo $hobbies;?></td>
  </tr>
                    </table>	
                    
                    
					</div>				
				</div>
                
                
				
				<div class="col-md-3 splpadding">
					<div class="block-flat2">
                    <h3>Contacts to MST</h3>
					  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">

  <tr>
    <td>Degree of Interest to be priest</td>
    <td> <?php 
				 foreach($interest_to_be_priest_list as $key=> $value){
				  if($key==$interest_to_be_priest){ echo $value;  }
				 }?></td>
  </tr>
  <tr>
    <td>Camp Attended </td>
    <td><?php if($camp_attended=='1'){  $selected='Yes';}else{$selected='No';} echo $selected;?></td>
  </tr>
    <tr>
    <td colspan="2">Detail Reminders in Calling</td>
    </tr>
   <tr>
    <td colspan="2">xsax dxwqdqwc efcwfcw</td>
    </tr>
    
    <tr>
    <td colspan="2">Exam Results</td>
    </tr>
    <tr>
    <td colspan="2"><div style="width:100%; height:300px;  overflow-y: scroll;">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
                        <?php  $exam_arr = getResultArray("SELECT * FROM ".EXAMTBL."  WHERE  student_ID = ".$student_id );
						
						if(!empty($exam_arr)){
							 foreach($exam_arr as $exam){
								 $exam_id=$exam['exam_ID'];
							$exam_model_row=getRowByID(EXAM_MODEL_TBL,'exam_model_list_ID',$exam['exam_model']," status='1'");?>
                            <tr>
                             <td colspan="2" class="headviewbg"><?php echo $exam_model_row['name'];?></td>
                            
   
    						</tr>
                         <tr>
                        <td class="headview">Subject</td>
                        <td class="headview">Mark</td>
                        </tr>
                        <?php  $exam_result_arr = getResultArray("SELECT * FROM ".EXAM_RESULT_TBL."  WHERE  exam_ID = ".$exam_id );
						foreach($exam_result_arr as $re){
						?>
                    <tr>
                    <td><?php echo $re['subjects'];?></td>
                    <td><?php echo $re['marks'];?></td>
                  </tr>
    <?php
						}}}?>
 


  
                        </table>
                      </div></td>
    </tr>
      <tr>
    <td colspan="2">Confidential Report of Viacar<br>
<a class="fancybox" href="#inline_creport" title="Confidential Report of Viacar"><span class="label label-danger" style="margin:5px 0px; padding:5px 5px; float:left;">View Report</span></a></td>
    </tr>
 
      <tr>
    <td colspan="2">Interview Comments & Result<br>
<a class="fancybox" href="#inline_interview" title="Interview Comments & Result"><span class="label label-danger" style="margin:5px 0px; padding:5px 5px; float:left;">View Result</span></a></td>
    </tr>
   
      <tr>
    <td colspan="2">Interviewed By Frs</td>
    </tr>
   <tr>
    <td colspan="2">And edsa kjskcj</td>
    </tr>
      <tr>
    <td colspan="2"><a class="btn btn-prev btn-default"  href="students.php"><i class="fa fa-long-arrow-left"></i> Back</a></td>
    </tr>
    <tr>
    <td colspan="2"><a class="btn btn-prev btn-default"  href="print_view.php?select_id=<?php echo $student_id;?>"><i class="fa fa-long-arrow-left"></i> Print</a></td>
    </tr>
    
 
    
 

                    </table>

     
						
					</div>				
				</div>
			</div>
    
    
			  </div>
		</div> 
	</div>

  <div id="inline_creport" style="width:500px;display: none;" class="inlinepopup">
		<h3>Confidential Report</h3>
		<p>
			<?php echo $title;?>
		</p>
	</div>
    
      <div id="inline_interview" style="width:500px;display: none;" class="inlinepopup">
		<h3>Interview Result</h3>
		<p>
			<?php echo $interview_comments;?>
		</p>
	</div>
    
      
  <!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="source/jquery.fancybox.pack.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />

<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
    
    
    
    <!-- Bootstrap core JavaScript
    ================================================== -->