<div class="row">
				<div class="col-md-3 splpadding">
					<div class="block-flat2">
                    <h3><?php echo $TDHEADING; ?></h3>
                    
        
           <form class="form-horizontal group-border-dashed" >
           
           
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
 <tr>
    <td>MST ID</td>
    <td><?php echo $mst_id; ?></td>
  </tr>
  <tr>
    <td>Date </td>
    <td>
    <?php  echo date('d-m-Y',$date); ?>
    </td>
  </tr>
  <tr>
    <td>Title </td>
    <td> <?php if($name_title=='Mr'){ ?>Mr<?php }?>
      <?php if($name_title=='Rev'){ ?>Rev<?php }?>
   </td>
  </tr>
  <tr>
    <td>Category </td> 
    <td>
                     <?php 
				 foreach($student_category_list as $key=> $value){
				 if($key==$student_category){  echo $value; } } ?>
   </td>
  </tr>
  <tr>
    <td>Name</td>
    <td><?php echo $name; ?></td>
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
    <td> 
                  
                  <?php  echo date('d-m-Y',$dob);  ?>
   
    </td>
  </tr>
</table>

           <h3>Telephone & Email</h3>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td>Land Phone</td>
    <td><?php echo $land_phone; ?></td>
  </tr>
  <tr>
    <td>Cell</td>
    <td><?php echo $land_phone; ?></td></tr>
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
    <td>Email</td>
    <td><?php echo $fb;?></td>
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
    <td><?php echo $post_office;?>
  </tr>
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
    <td>
               <?php  foreach($country_array as $key=>$value){
				  
				  if($key==$country){  echo $value;  } 
			   }?>
                  </td>
  </tr>
</table>

       <h3>Diocese & Parish</h3>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  
  <tr>
    <td>Parish</td>
    <td> 
                     <?php 
					  $parish_arr=getResultArray("SELECT parish_ID, name FROM ".MTABLE."parish WHERE parish_status = 1  ORDER BY parish_ID asc "); 
				 foreach($parish_arr as $row){
				 
				 if($row['parish_ID']==$parish_id){ echo $row['name'];  } 
				 }?>
                 
  </tr>
 
</table>

       <h3>Contacted Through</h3>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td>VP</td>
    <td><?php echo $vp_phone;?></td>
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
    <td>
                     <?php 
				 foreach($class_list as $key=> $value){
				 if($key==$class){  echo $value;  }
				 }?>
</td>
  </tr>
  <tr>
    <td>School Syllabus</td>
    <td>
                     <?php 
				 foreach($school_syllabus_list as $key=> $value){
				  if($key==$school_syllabus){  echo $value;  }
				 }?>
   </td>
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
    <td><br />
School Teacher Phone</td>
    <td><?php echo $school_teacher_phone;?> </td>
  </tr>
  <tr>
    <td>Sunday School Teacher</td>
    <td> 
                     <?php $teachers_arr=getResultArray("SELECT teacher_ID, name FROM ".MTABLE."teachers WHERE teacher_status = 1  ORDER BY teacher_ID asc "); 
				 foreach($teachers_arr as $row){
				 	if($row['teacher_ID']==$parish_teacher_id){ echo $row['name']; } 
				 }?>
                  </td>
  </tr>
  
 </table>	
 
 <h3>Members of the Family</h3>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td>Father of Guardian</td>
    <td>
   <?php echo $guardian_father;?></td>
  </tr>
  <tr>
    <td>Occupation</td>
    <td><?php echo $guardian_father_occupation ;?></td>
  </tr>
  <!--<tr>
    <td>No. Of Siblings </td>
    <td> <!--required onkeyup="display_input('../ajax/ajax_display_input.php','display_input', this.value)"  </td>
  </tr>-->
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
    <td>Priests in Family</td>
    <td><?php echo $priests_family;?></td>
  </tr>
   <tr>
    <td>Nuns in Family</td>
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
    <td colspan="2" class="block">
    <?php if(!empty($certificates_arr)){ ?>
    <div class="content no-padding ">
    
							<ul class="items" >
                          <?php foreach($certificates_arr as $row){  ?>
								<li style="padding-left:0px;"><a href="<?php echo '../'.UPLOADS."/certificates/".$row['file_name']?>" target="_blank"><i class="fa fa-file-text" style="line-height:10px;"></i><?php echo $row['file_name'];?></a> </li>
                                <?php
						  }
						  ?>
                               
                                </ul></div>
                                <?php
	}
	?>
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
    <td>
                  <?php foreach($family_financial_status_list as $key=>$value){
					  if($key==$family_financial_status){ echo $value;  }
				  }?>
                 </td>
  </tr>
  <tr>
    <td>Reputation in Parish</td>
    <td>
                  <?php foreach($reputation_list as $key=>$value){
					  if($key==$reputation){ echo $value;  }
				  }?>
                 </td>
  </tr>
 
    <tr>
    <td>Relation with Parish</td>
    <td> 
                     <?php 
				 foreach($relation_with_parish_list as $key=> $value){
				  
				 if($key==$relation_with_parish_id){ echo $value;  } 
				 }?>
                 </td>
  </tr>
                    </table>	
                   
                   <h3>Qualities of Candidate</h3>
                   
                   		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td>Alter Boy</td>
    <td> <label>  <?php if($altara_boy=='1'){ ?>> Yes  <?php }if($altara_boy=='0' || $altara_boy='' ){ ?> > No<?php }?>  </td>
  </tr>
  <tr>
    <td>Church Going</td>
    <td><?php
				 foreach($church_going_list as $key=> $value){
				  
				 if($key==$church_going){ echo $value;  }
				 }?>
                 </td>
  </tr>
  
    <tr>
    <td>Study</td>
    <td><?php foreach($study_status_list as $key=> $value){
					 
				 if($key==$study_status_id){ echo $value;  }
	}?>
                  </td>
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
  <table border="0">
   <tr>
    <tr>Likes</tr>
    <td><?php echo $likes;?></td>
  </tr>
  
   <tr>
    <tr>Dislikes</tr>
    <td><?php echo $dislikes;?></td>
  </tr>
  
   <tr>
    <tr>Hobbies </tr>
    <td><?php echo $hobbies;?></td>
  </tr>
  </table>
   <tr>
    <td>Excellence Awards Received </td>
    <td><?php echo $awards_received;?></td>
  </tr>
                    </table>	
                    
                    
					</div>				
				</div>
                <?php if($profile_image != "" || $profile_image=='0'){?>
				<img src="../uploads/profile/<?php echo $profile_image;?>" style="width:200px; height:200px;">
                <?php
				}
				else{?>
                <img src="images/no_profile_image.jpg" style="width:200px; height:200px;">
                <?php
				}?>
				<div class="col-md-3 splpadding">
					<div class="block-flat2">
                    <h3>Contacts to MST</h3>
					  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">

  <tr>
    <td>Degree of Interest to be priest</td>
    <td>
                     <?php 
				 foreach($interest_to_be_priest_list as $key=> $value){
				  if($key==$interest_to_be_priest){ echo $value;  }
				 }?>
                 </td>
  </tr>
  <tr>
    <td>Camp Attended </td>
    <td><?php if($camp_attended=='1'){  $selected='Yes';}else{$selected='No';} echo $selected;?>
    </td>
  </tr>
    
   <tr>
    <td colspan="2">Exam Results</td>
    </tr>
    <tr>
    <td colspan="2"><div style="width:100%; height:300px;  overflow-y: scroll;">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
       <tr>
        <td colspan="2" class="headviewbg">
                      
                      <?php foreach($exam_model_list as $key=> $value){
                       		 if($exam_model == $key){ echo $value; }
					  }?>
                       </td>
        </tr>
      
      
<?php 
	 $exam_results_arr = getResultArray("SELECT * FROM ".EXAM_RESULT_TBL." WHERE  exam_ID = '".$exam_id."'  ORDER BY result_ID asc");
	 if(!empty($exam_results_arr)){ 
	 ?>
     <tr><td>Subjects</td><td>Marks</td></tr>
     <?php
		 foreach($exam_results_arr as $row){
	 ?>
     <tr>
    <td><?php echo $row['subjects'];?></td>
    <td><?php echo $row['marks'];?></td>
     </tr>
    <?php }
	 }?>
 
</table></div>
 </td> </tr>

                          <tr>
    <th colspan="2">Confidential Report of Viacar</th>
    </tr>
   <tr>
    <td colspan="2"><?php echo $title;?></td>
    </tr>
      <tr>
    <th colspan="2">Interview Comments & Result</th>
    </tr>
   <tr>
    <td colspan="2"><?php echo $interview_comments;?></td>
    </tr>
      <tr>
    <th colspan="2">Interviewed By Fathers</th>
    </tr>
   <tr>
    <td colspan="2"><?php echo $interviewed_by;?></td>
    </tr>
     <tr> <th colspan="2">Psychological Results</th></tr>
     <tr>
    <td colspan="2"><?php echo $psychological_results;?></td>
    </tr>
  
                    </table>
                     <div class="form-group">
              <div class="col-sm-offset-2 ">
             <?php if(isset($retur)){?>
				   <a class="btn btn-primary" href="students.php?edit=1&select_id=<?php echo $student_id;?>">Back</a>
                 <?php
			 }
			 else{
			 ?>
              <a class="btn btn-primary"  href="students.php">Back</a>
              <?php
			 }?>
 </div></div>
     </form>
						
					</div>