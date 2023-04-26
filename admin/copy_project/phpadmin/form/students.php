 <script type="text/javascript" src="http://code.jquery.com/jquery-1.3.2.min.js"></script>
 <script type = "text/javascript" language = "javascript">
         function display_input(path,container,by_id){
			  $.ajax({
								type:'POST',
								url:path,
								data:{'by_id':by_id },
								success: function(option_tags) {
									
									$('#'+container).html(option_tags);
								}
						});
		 }
		
</script>
<script>
function check_file_type(){ 
	var x = document.getElementById("FileUploader");
	alert(x);
	var files = x.files;
	var file_type = files.type; 
	//var name = files[0].name; 
		if (!(file_type ==='application/jpeg' || file_type ==='application/jpg')) {
				alert("Please upload jpg or jpeg file only");
				$('#FilUploader').attr({ value: '' });
				return false;
           	
            }
			else{ return true;}
	
		//alert($('input[name="files[]"]').eq(0).val());
	}
	
	function display_input(id, container, path){
		 $.ajax({
							type:'POST',
							url:path,
							data:{'by_id':id },
							success: function(option_tags) {
								
								$('#'+container).html(option_tags);
							}
						});
		
	}
</script>
<script>	
function displayquestion(container){
  $("#"+container).show();
}


function add_array(by_id, container, path){
	var info = [];
	if(by_id=='parish'){
		info[0] = $('#parish_field').val();
		info[1] = $('#parish_vicari').val();
		info[2] = $('#parish_phone').val();
		info[3]= $('#vicari_address').val();
		var second_id = $('#diocese_id').val();
	}
	if(by_id=='parish_teacher'){
		info[0] = $('#teacher_name').val();
		info[1] = $('#teacher_email').val();
		info[2] = $('#teacher_phone').val();
		info[3]= $('#teacher_address').val();
		var second_id = $('#parish_id').val();
	}
	if(by_id=='vp_details'){
		info[0] = $('#vp_name').val();
		info[1] = $('#vp_phone').val();
		info[2] = $('#vp_address').val();
		info[3]= $('#vp_whatsup').val();
		info[4]= $('#vp_fb').val();
		var second_id='0'; 
	}
	$.ajax({
            type: "POST",
            url: path,
            data:  {'info' : info, 'by_id' : by_id, 'second_id' : second_id} ,
           	success: function(option_tags) { 
									
				$('#'+container).html(option_tags);
				alert("Successfully Added");
									 $("#main_"+container).hide();
            }
        });
	}

function add(id, container, path){ 
	
	if(id=='student_cat'){
		 var name = $('#cat_name').val(); 
	}
	else if(id=='class'){
		 var name = $('#class_name').val();
	}
	else if(id=='family_financial'){
		 var name = $('#financial_status').val();
	}
	else if(id=='reputation_in_parish'){ 
		 var name = $('#reputaion_parish_field').val();
	}
	else if(id=='relation_with_p'){ 
		 var name = $('#relation_field').val();
	}
	else if(id=='church_g'){ 
	 var name = $('#church_going_field').val();
	}
	else if(id=='quality'){ 
	 var name = $('#quality_field').val();
	}
	else if(id=='s_syllabus'){ 
	 var name = $('#syllabus_field').val();
	}
	else if(id=='name_title'){ 
	 var name = $('#title_field').val();
	}
	else if(id=='exam_model'){
		 var name = $('#model_field').val();
	}
	else if(id=='study_status'){
		 var name = $('#s_status_field').val();
	}
	else if(id=='diocese_add'){
		 var name = $('#diocese_field').val();
	}
	else if(id=='parish_add'){
		 var name = $('#parish_field').val();
	}
	else if(id=='interest_to_priest'){
		 var name = $('#interest_priest_field').val();
	}
	else if(id=='question_type'){
		var name = $('#questiontype_field').val();
	}
	
	
	$.ajax({
								type:'POST',
								url:path,
								data:{'name': name, 'by_id' : id},
								success: function(option_tags) {
									
									$('#'+container).html(option_tags);
									alert("Successfully Added");
									 $("#main_"+container).hide();
								}
						});
}


	</script>
    
    <script type="text/javascript">

$(document).ready(function(){

    var counter = $('#counter').val();;

    $("#addButton").click(function () {

    if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
    }   

    var newTextBoxDiv = $(document.createElement('div'))
         .attr("id", 'TextBoxDiv' + counter);

    newTextBoxDiv.after().html('Ques.'+ counter + ' : ' +
          '<input type="text" name="question[]" id="question' + counter + '" class="form-control" ><br>Ans.'+ counter + ' : ' +
          '<input type="text" name="answer[]" id="answer' + counter + '" class="form-control" >');

    newTextBoxDiv.appendTo("#TextBoxesGroup");


    counter++;
     });

     $("#removeButton").click(function () {
    if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   

    counter--;

        $("#TextBoxDiv" + counter).remove();

     });

     $("#getButtonValue").click(function () {

    var msg = '';
    for(i=1; i<counter; i++){
      msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
    }
          alert(msg);
     });
  });
</script>
<script type="text/javascript">
	function delete_by_id(by_id, path){
		var r = confirm("Do you want to delete this item?");
		if (r == true) {
			
			$.ajax({
					type:'POST',
					url:path,
					data:{ 'by_id' : by_id},
					success: function(option_tags) {alert("success");
						
						$('#'+container).html(option_tags);
						alert("Successfully Deleted");
					}
			});

			
		} else {
			return false;
		}
		
	}
</script>
<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#"> Students MGT</a></li>
                 <li><a href="students.php">Students Listing</a></li>
				  <li class="active">Student Form</li>
				</ol>
                <div style="float:right;"><a class="label label-warning" href="students_print.php?select_id=<?php echo $student_id;?>&retur=view"  title="View"><i class="fa fa-eye"></i></a></div>
			</div>
           
    <div class="cl-mcont"> <?php /*?><?php if($action=='update'){?>  
    <a  href="exams.php?add=1&student_id=<?php echo $select_id; ?>&retur=student"  class="studtabactive">Add more Exams</a>
    <a  href="certificates.php?add=1&student_id=<?php echo $select_id; ?>&retur=student"  class="studtabactive">Add Certificates</a>
     <a  href="educations.php?add=1&student_id=<?php echo $select_id; ?>&retur=student"  class="studtabactive">Add Educations</a>
     <?php }?><?php */?>
			<div class="row">
              <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="students.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;" ><!--onsubmit="return validate();"-->
				<div class="col-md-3 splpadding">
					<div class="block-flat2">
                    <h3><?php echo $TDHEADING; ?></h3>
                     <?php if($alert != '') { ?> 
           <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $alert; ?>
							 </div>
          <?php } if($mssg != '') { ?>
           <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-info-circle"></i></div>
								<strong>Info!</strong> <?php echo $mssg; ?>
							 </div>
          <?php } ?>
        
         
           
            <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
                        
 <tr>
    <td>MST ID</td>
    <td><input name="mst_id" id="mst_id" class="form-control parsley-validated"   title="MST ID" value="<?php echo $mst_id; ?>" type="text"></td>
  </tr>  
  <tr>
    <td>Date <span style="color:#F00;">*</span></td>
    <td>
    
    <input id="date" class="form-control" name="date"  title="Date"   value="<?php if($date != '') { echo date('d-m-Y',$date); } else{echo date("d/m/Y");} ?>" type="text">
   
    </td>
  </tr>
   <tr><td colspan="2"> <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" onclick="displayquestion('main_divNameTitle')" ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong> Title
							 </div></td></tr>
  <tr>
    <td>Title <span style="color:#F00;">*</span></td>
    
    <td><div class="questionholder" id="main_divNameTitle" style="display:none">
       
        <input name="title_field" id="title_field"  class="form-control"><br>
       <span class="badge badge-info" onclick="add('name_title','divNameTitle','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div><div id="divNameTitle"><select name="name_title" id="name_title" class="form-control" >
      <option>Select Title</option>
      <option value="Mr" <?php if($name_title=='Mr'){ echo 'selected="selected"';}?> >Mr</option>
      <option value="Rev" <?php if($name_title=='Rev'){ echo 'selected="selected"';}?>>Rev</option>
    </select></div></td>
  </tr>

   <tr><td colspan="2"> <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" onclick="displayquestion('main_disSms_category')" ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong> Category
							 </div></td></tr>
  <tr>
    <td>Category <span style="color:#F00;">*</span></td> 
    <td>  <div class="questionholder" id="main_disSms_category" style="display:none">
       
        <input name="cat_name" id="cat_name"><br>
       <span class="badge badge-info" onclick="add('student_cat','disSms_category','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div><div id="disSms_category"><select name="student_category" id="student_category" class="form-control" >
     <option value="">Select Student Category</option>
                     <?php  $student_category_list=getResultArray("SELECT * FROM ".STUDENT_CATEGORY_TBL."  WHERE status = 1  ORDER BY student_category_ID asc "); 
				 foreach($student_category_list as $row){
				  ?>
				  <option value="<?php echo $row['student_category_ID'] ;?>" <?php echo (($row['student_category_ID']==$student_category)?'selected="selected"':'') ?> ><?php echo $row['category_name']; ?></option>
				     <?php } ?>
    </select></div></br>
</td>
  </tr>
 
  <tr>
    <td>Name</td>
    <td><input id="name" class="form-control" name="name" required title="Name" value="<?php echo $name; ?>" type="text"></td>
  </tr> 
   <tr>
    <td>Baptism Name</td>
    <td><input id="baptism_name" class="form-control" name="baptism_name" required title="Baptism Name" value="<?php echo $baptism_name; ?>" type="text"></td>
  </tr> 
  <tr>
    <td>Nick Name</td>
    <td><input id="nick_name" class="form-control" name="nick_name" required title="Nick Name" value="<?php echo $nick_name; ?>" type="text"></td>
  </tr> 
  <tr><td>Upload Profile</td><td> <input type="file" name="file" multiple id="FilUploader" class="form-control" >
 
  <?php if($profile_image != ""){ ?>
				<img src="../uploads/profile/<?php echo $profile_image;?>" style="width:50px; height:50px;">
                 <input type="hidden" name="old_file" value="<?php echo $profile_image;?>"  />
                <?php
				}
				else{?>
                <img src="images/no_profile_image.jpg" style="width:50px; height:50px;">
                <?php
				}?></td></tr>
  <tr>
    <td>Father's Name</td>
    <td><input id="father_name" class="form-control" name="father_name"  title="Father" value="<?php echo $father_name; ?>" type="text"></td>
  </tr>
  <tr>
    <td>Father's Occupation</td>
    <td><input id="father_occupation" class="form-control" name="father_occupation"  title="Father Occupation" value="<?php echo $father_occupation; ?>" type="text"></td>
  </tr>
   <tr>
    <td>Mother's Name</td>
    <td><input id="mother_name" class="form-control" name="mother_name"  title="Mother" value="<?php echo $mother_name; ?>" type="text"></td>
  </tr>
  <tr>
    <td>Mother's Occupation</td>
    <td><input id="mother_occupation" class="form-control" name="mother_occupation"  title="Mother Occupation" value="<?php echo $mother_occupation; ?>" type="text"></td>
  </tr>
   <tr>
    <td>House Name</td>
    <td><input id="house_name" class="form-control " name="house_name" required title="House Name" value="<?php echo $house_name; ?>" type="text"></td>
  </tr>
  <tr>
    <td>Place</td>
    <td><input id="place" class="form-control " name="place" required title="Place" value="<?php echo $place; ?>" type="text"></td>
  </tr>
  <tr>
    <td>DOB</td>
    <td> 
                  
                  <div class="input-group date form_date " data-date-format="dd-mm-yyyy" data-link-field="dtp_input1" >
    <input id="dob" class="form-control" name="dob"  title="DoB" value="<?php if($dob != '') { echo date('d-m-Y',$dob); } ?>" type="text">
    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span></div>
    </td>
  </tr>
</table>

           <h3>Contact Details</h3>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td>Land Phone</td>
    <td><input id="land_phone" class="form-control" name="land_phone" required title="Land Phone" value="<?php echo $land_phone; ?>" type="text"></td>
  </tr>
  <tr>
    <td>Cell</td>
    <td><input id="cell_phone" class="form-control" name="cell_phone"  title="Cell Phone" value="<?php echo $land_phone; ?>" type="text" placeholder="Personal"></td></tr>
    <tr><td>Father Mobile</td><td>
<input id="father_mobile" class="form-control" name="father_mobile"  title="Father Mobile" value="<?php echo $father_mobile; ?>" type="text" ></td></tr>
<tr><td>Mother Mobile</td><td>
<input id="mother_mobile" class="form-control" name="mother_mobile"  title="Mother Phone" value="<?php echo $mother_mobile; ?>" type="text" ></td>
  </tr>
  <tr>
    <td>Whatsapp</td>
    <td><input id="whats_up" class="form-control" name="whats_up"  title="Whats Up" value="<?php echo $whats_up;?>" type="text" ></td>
  </tr>
  <tr>
    <td>Email<span style="color:#F00;">*</span></td>
    <td><input name="email" type="text"  class="form-control" id="email" title="Email" value="<?php echo $fb;?>"></td>
  </tr>
  <tr>
    <td>FB</td>
    <td><input id="fb" class="form-control" name="fb"  title="Facebook" value="<?php echo $fb;?>" type="text"></td>
  </tr>
</table>


           <h3>Postal Address</h3>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td>Post Box</td>
    <td><input id="post_box" class="form-control" name="post_box"  title="Post Box" value="<?php echo $post_box;?>" type="text" ></td>
  </tr>
  <tr>
    <td>Post office</td>
    <td><input id="post_office" class="form-control" name="post_office"  title="Post Office" value="<?php echo $post_office;?>" type="text"  >
  </tr>
  <tr>
    <td>Pin Code</td>
    <td><input id="post_code" class="form-control" name="post_code"  title="Pin Code" value="<?php echo $post_code;?>" type="text" ></td>
  </tr>
  <tr>
    <td>District</td>
    <td><input name="district" type="text"  class="form-control" id="district" title="District" value="<?php echo $district;?>" ></td>
  </tr>

  <tr>
    <td>State</td>
    <td><input id="state" class="form-control" name="state"  title="State" value="<?php echo $state;?>" type="text" ></td>
  </tr>
   <tr>
    <td>Country</td>
    <td> <select name="country" id="country" class="form-control" required >
                  <option value="">--Select Country--</option>
               <?php  foreach($country_array as $key=>$value){
				  ?>
				  <option value="<?php echo $key ;?>" <?php echo (($key==$country)?'selected="selected"':'') ?> ><?php echo $value; ?></option>
				     <?php } ?>
                  </select></td>
  </tr>
</table>

       <h3>Diocese & Parish</h3>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  
  <tr>
    <tr><td colspan="2"> <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" onclick="displayquestion('main_divDiocese')" ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong> Diocese
							 </div></td></tr>
  <tr id="divDiocese_select">
   <td>Diocese<span style="color:#F00;">*</span> </td>
    <td> <div class="questionholder" id="main_divDiocese" style="display:none">
        Name<br>
        <input name="diocese_field" id="diocese_field"  class="form-control"><br>
       <span class="badge badge-info" onclick="add('diocese_add','divDiocese','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div> <div id="divDiocese"><!--onchange="display_input(this.value,'divParish_select','../ajax/parish_select.php')"-->
    <select name="diocese_id" id="diocese_id" class="form-control" onchange="display_input(this.value,'divParish_select','../ajax/parish_select.php')"   >
                  <option value="">--Select Diocese--</option>
                     <?php 
					  $diocese_arr=getResultArray("SELECT * FROM ".MTABLE."diocese WHERE diocese_status = 1  ORDER BY diocese_ID asc "); 
				 foreach($diocese_arr as $row){
				  ?>
				  <option value="<?php echo $row['diocese_ID'] ;?>" <?php echo (($row['diocese_ID']==$diocese_id)?'selected="selected"':'') ?> ><?php echo $row['diocese_name']; ?></option>
				     <?php } ?>
                  </select></div></td>
  </tr>
    <tr><td colspan="2"> <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" onclick="displayquestion('main_divParish')" ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong> Parish
							 </div></td></tr>
  <tr id="divParish_select">
    <td>Parish &nbsp;</td>
    <td> <div id="divParish"><select name="parish_id" id="parish_id" class="form-control"  onchange="display_input(this.value,'divParishTeacher_select','../ajax/parish_teacher_select.php')" >
                  <option value="">--Select Parish--</option>
                     <?php 
					  $parish_arr=getResultArray("SELECT parish_ID, name FROM ".MTABLE."parish WHERE parish_status = 1  ORDER BY parish_ID asc "); 
				 foreach($parish_arr as $row){
				  ?>
				  <option value="<?php echo $row['parish_ID'] ;?>" <?php echo (($row['parish_ID']==$parish_id)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select></div></td></tr>
                  <tr><td colspan="2">  <div class="questionholder" id="main_divParish" style="display:none">
       <table><tr><td> Name</td>
       <td>        <input name="parish_field" id="parish_field" class="form-control"></td></tr>
       <tr><td>Vicari</td><td><input name="parish_vicari" id="parish_vicari" class="form-control" /></td></tr>
        <tr><td>Phone No.</td><td><input name="parish_phone" id="parish_phone" class="form-control"/></td></tr>
          <tr><td>Vicari Address</td><td><input name="vicari_address" id="vicari_address" class="form-control"/></td></tr>
      <tr><td colspan="2"> <span class="badge badge-info" onclick="add_array('parish', 'divParish','../ajax/add_number_of_fields.php')" style="cursor:pointer;">Add</span>
   </td></tr></table> </div> </td>
  </tr>

</table>

       <h3>Contacted Through</h3> 
        <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" onclick="displayquestion('main_divVp')" ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong> Details
							 </div>
                              <?php if($vp_id !='' || $vp_id =='0'){
								$style='style="display:none"';
								}
								else{ $style='style="display:block"';}
								?>
                              <div class="questionholder" id="main_divVp" <?php echo $style;?>>
			 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
            
             <tr>
    <td>Name</td>
    <td><input id="vp_name" class="form-control parsley-validated" name="vp_name"  value="<?php echo $vp_name;?>" title="Name"  type="text"></td>
  </tr>
  <tr>
    <td>VP Phone</td>
    <td><input id="vp_phone" class="form-control" name="vp_phone"  title="Phone No." value="<?php echo $vp_phone;?>" type="text" ></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><textarea name="vp_address"  class="form-control parsley-validated" id="vp_address"  title="Address"><?php echo $vp_address;?></textarea></td>
  </tr>
    <tr>
    <td>Whatsapp Number</td>
    <td><input id="vp_whatsup" class="form-control parsley-validated" name="vp_whatsup" value="<?php echo $vp_whatsup;?>"  title="Whats Up"  type="text"></td>
  </tr>
    <tr>
    <td>Facebook ID</td>
    <td><input id="vp_fb" class="form-control parsley-validated" name="vp_fb"  title="Facebook" value="<?php echo $vp_fb;?>"  type="text"></td>
  </tr>
     <!-- <tr><td colspan="2"> <span class="badge badge-info" onclick="add_array('vp_details', 'divVp','../ajax/add_number_of_fields.php')" style="cursor:pointer;">Add</span>
   </td></tr>  -->         
</table>  </div> <div id="divVp"></div> 
					</div>				
				</div>
				
				<div class="col-md-3 splpadding">
					<div class="block-flat2">
                    <h3>Education</h3>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
                      <tr><td colspan="2"> <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" onclick="displayquestion('main_divClass')" ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong> Class
							 </div></td></tr>
  <tr>
    <td>Class</td>
    <td> <div class="questionholder" id="main_divClass" style="display:none">
        <input name="class_name" id="class_name"  class="form-control"><br>
       <span class="badge badge-info" onclick="add('class','divClass','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div><div id="divClass"><select name="class"  id="class" class="form-control" >
     <option value="">--Select Class--</option>
                     <?php $class_list=getResultArray("SELECT * FROM ".CLASS_TBL." WHERE status = 1  ORDER BY class_ID asc ");
				 foreach($class_list as $row){
				  ?>
				  <option value="<?php echo $row['class_ID'] ;?>" <?php echo (($row['class_ID']==$class)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
    </select></div></td>
  </tr>
    <tr><td colspan="2"> <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" onclick="add('s_syllabus','divSyllabus','../ajax/add_field.php')" ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong> School Syllabus
							 </div></td></tr>
  <tr>
    <td>School Syllabus</td>
    <td><div class="questionholder" id="main_divSyllabus" style="display:none">
        <input name="syllabus_field" id="syllabus_field"  class="form-control"><br>
       <span class="badge badge-info" onclick="add('s_syllabus','divSyllabus','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div><div id="divSyllabus"><?php $school_syllabus_list=getResultArray("SELECT * FROM ".SCHOOL_SYLLABUS_TBL." WHERE status = 1  ORDER BY school_syllabus_ID asc "); 
	?><select name="school_syllabus" id="school_syllabus" class="form-control" >
      <option value="">--Select Syllabus--</option >
                     <?php 
				 foreach($school_syllabus_list as $row){ 
				  ?>
				  <option value="<?php echo $row['school_syllabus_ID'];?> " <?php  if($school_syllabus=='2'){ echo 'selected="selected"';} ?> ><?php echo $row['school_syllabus_ID']; ?></option>
				     <?php } ?>
    </select></div></td>
  </tr>
  <tr>
    <td>Place </td>
    <td><input id="place" class="form-control" name="place"  title="Place" value="<?php echo $place;?>" type="text" ></td>
  </tr>
  <tr>
    <td>Sunday School</td>
    <td><input name="sunday_school" type="text"  class="form-control" id="sunday_school" title="Sunday School" value="<?php echo $school_name;?>" ></td>
  </tr>
  <tr>
    <td>Class Teacher</td>
    <td> <input type="text" name="school_teacher_name" id="school_teacher_name"  title="School Teacher Name" value="<?php echo $school_teacher_name; ?>" class="form-control" ></td>
  </tr>
  <tr>
    <td><br />
School Teacher Phone</td>
    <td><input id="school_teacher_phone" class="form-control" name="school_teacher_phone" title="School Teacher Contact No" value="<?php echo $school_teacher_phone;?>" type="text" > </td>
  </tr>
    <tr><td colspan="2"> <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" onclick="displayquestion('main_divParishTeacher_select')" ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong> Parish Teacher
							 </div></td></tr>
  <tr>
    <td>Sunday School Teacher</td>
    <td><div class="questionholder" id="main_divParishTeacher_select" style="display:none">
       Name <input name="teacher_name" id="teacher_name"  class="form-control"><br>
        Email <input name="teacher_email" id="teacher_email"  class="form-control"><br>
         Phone <input name="teacher_phone" id="teacher_phone"  class="form-control"><br>
          Address <input name="teacher_address" id="teacher_address"  class="form-control"><br>
          
       <span class="badge badge-info" onclick="add_array('parish_teacher','divParishTeacher_select','../ajax/add_number_of_fields.php')" style="cursor:pointer;">Add</span>
    </div><div id="divParishTeacher_select"> <select name="parish_teacher_id" id="parish_teacher_id" class="form-control"    >
                  <option value="">--Select Parish Teacher--</option>
                     <?php $teachers_arr=getResultArray("SELECT teacher_ID, name FROM ".MTABLE."teachers WHERE teacher_status = 1  ORDER BY teacher_ID desc "); 
				 foreach($teachers_arr as $row){
				  ?>
				  <option value="<?php echo $row['teacher_ID'] ;?>" <?php echo (($row['teacher_ID']==$parish_teacher_id)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select></div></td>
  </tr>
   <tr>
    <td>Teacher Comments</td>
    <td>
     <textarea name="teacher_comment" id="teacher_comment"   class="form-control"><?php echo $teacher_comment; ?></textarea></td> <input type="hidden" name="teacher_comment_id" id="teacher_comment_id" value="<?php echo $teacher_comment_id;?>" />
  </tr>
 
 </table>	

 <h3>Members of the Family</h3>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td>Father of Guardian</td>
    <td>
    <input id="guardian_father" class="form-control" name="guardian_father"  title="Guardian Name" value="<?php echo $guardian_father;?>" type="text" ></td>
  </tr>
  <tr>
    <td>Occupation</td>
    <td><input id="guardian_father_occupation" class="form-control" name="guardian_father_occupation"  title="Guardian Father Occupation" value="<?php echo $guardian_father_occupation;?>" type="text"></td>
  </tr><?php $siblings_no='2';?><input id="siblings_no" class="form-control" name="siblings_no" value="<?php echo $siblings_no;?>" type="hidden" >
  <!--<tr>
    <td>No. Of Siblings </td>
    <td> <!--required onkeyup="display_input('../ajax/ajax_display_input.php','display_input', this.value)"  </td>
  </tr>-->
 <?php
 if($action=='update'){
	 if(!empty($siblings_arr)){ 
		 $i=1;
		 foreach($siblings_arr as $row){?>
			 <tr><td>Sibling <?php echo $i;?> Name</td><td><input id="sibling_name_<?php echo $i;?>" class="form-control" value="<?php echo $row['relation_name'];?>" name="sibling_name_<?php echo $i;?>"  title="Name"  type="text"></td></tr>
              <tr><td>Age</td><td><input id="age_<?php echo $i;?>" class="form-control" value="<?php echo $row['relation_age'];?>" name="age_<?php echo $i;?>"  title="Age"  type="text"></td></tr>
             
  <tr><td>Relation </td><td><select name="relation_with_student<?php echo $i;?>" id="relation_with_student<?php echo $i;?>" class="form-control" >
                  <option value="">--Select Relation--</option>
                 <option value="brother" <?php if($row['relation_with_student'] =='brother'){ echo 'selected="selected"';}?>>Brother</option>
                 <option value="sister" <?php if($row['relation_with_student'] =='sister'){ echo 'selected="selected"';}?>>Sister</option>
                  </select></td></tr>
                   <tr><td>Education</td><td><input id="education_<?php echo $i;?>" value="<?php echo $row['relation_education'];?>" class="form-control" name="education_<?php echo $i;?>"  title="Education"  type="text"></td></tr>
                   <tr><td>Occupation</td><td><input id="occupation_<?php echo $i;?>" value="<?php echo $row['relation_occupation'];?>" class="form-control" name="occupation_<?php echo $i;?>"  title="Occupation"  type="text"></td></tr>
<?php	$i++;	 }
	}
 }
 else{
for($i=1;$i<=$siblings_no;$i++){?>

  <tr><td>Sibling <?php echo $i;?> Name</td>
  <td><input id="sibling_name_<?php echo $i;?>" class="form-control" name="sibling_name_<?php echo $i;?>"  title="Name"  type="text"></td></tr>
    <tr><td>Age</td>
  <td><input id="age_<?php echo $i;?>" class="form-control" name="age_<?php echo $i;?>"  title="Age"  type="text"></td></tr>
  <tr><td>Relation </td><td><select name="relation_with_student<?php echo $i;?>" id="relation_with_student<?php echo $i;?>" class="form-control" >
                  <option value="">--Select Relation--</option>
                 <option value="brother">Brother</option>
                 <option value="sister">Sister</option>
                  </select></td></tr>
                  <tr><td>Education</td><td><input id="education_<?php echo $i;?>" class="form-control" name="education_<?php echo $i;?>"  title="Name"  type="text"></td></tr>
                   <tr><td>Occupation</td><td><input id="occupation_<?php echo $i;?>" class="form-control" name="occupation_<?php echo $i;?>"  title="Name"  type="text"></td></tr>
                
  <?php
 }
 }
 ?>
    
   <tr>
    <td>Priests in Family</td>
    <td><input id="priests_family" class="form-control" name="priests_family"  title="Priests in Family" value="<?php echo $priests_family;?>" type="text"></td>
  </tr>
   <tr>
    <td>Nuns in Family</td>
    <td><input id="nuns_family" class="form-control parsley-validated" name="nuns_family"  title="Nuns in Family" value="<?php echo $nuns_family;?>" type="text"></td>
  </tr>
  
 </table>	
      
      <h3>Place</h3> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td colspan="2">House is Situated</td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="route_to_house" id="route_to_house" rows="2"  class="form-control"  title="Route to Residence"  ><?php echo $route_to_house;?></textarea></td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="description"  id="description" rows="4"  class="form-control"  title="Details" ><?php echo $d;?></textarea></td>
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
                      <tr><td colspan="2"> <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" onclick="displayquestion('main_divFamFinance')" ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong> Status
							 </div></td></tr>
  <tr>
    <td>Financial </td>
    <td> <div class="questionholder" id="main_divFamFinance" style="display:none">
        Financial Status<br>
        <input name="financial_status" id="financial_status"  class="form-control"><br>
       <span class="badge badge-info" onclick="add('family_financial','divFamFinance','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div><div id="divFamFinance"><select name="family_financial_status" id="family_financial_status" class="form-control"  >
                  <option value="">--Select Family Financial Status--</option>
                  <?php 
				   $family_financial_status_list=getResultArray("SELECT * FROM ".FAMILY_FINANCIAL_STATUS_TBL." WHERE status = 1  ORDER BY family_financial_status_ID asc ");
				  foreach($family_financial_status_list as $row){?>
                   <option value="<?php echo $row['family_financial_status_ID'] ;?>" <?php echo (($row['family_financial_status_ID']==$family_financial_status)?'selected="selected"':'') ?> ><?php echo $row['status_name']; ?></option>
				     <?php } ?>
                  </select></div></td>
  </tr> 
    <tr><td colspan="2"> <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" onclick="displayquestion('main_divReputation')"  ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong> Reputation
							 </div></td></tr>
  <tr>
    <td>Reputation in Parish </td>
    <td><div class="questionholder" id="main_divReputation" style="display:none">
        <input name="reputaion_parish_field" id="reputaion_parish_field"  class="form-control"><br>
       <span class="badge badge-info" onclick="add('reputation_in_parish','divReputation','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div> <div id="divReputation"><select name="reputation" id="reputation" class="form-control"  >
                  <option value="">--Select Family Reputation in Parish--</option>
                  <?php 
				   $reputation_list=getResultArray("SELECT * FROM ".REPUTATION_TBL." WHERE status = 1  ORDER BY reputation_list_ID asc ");
				  foreach($reputation_list as $row){?>
                   <option value="<?php echo $row['reputation_list_ID'] ;?>" <?php echo (($row['reputation_list_ID']==$reputation)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select></div></td>
  </tr>
   <tr><td colspan="2"> <div class="alert alert-info alert-white rounded">
								<button type="button" class="close"  onclick="displayquestion('main_divRelation_with')" ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong> Relation
							 </div></td></tr>
    <tr>
    <td>Relation with Parish</td>
    <td><div class="questionholder" id="main_divRelation_with" style="display:none">
        <input name="relation_field" id="relation_field"  class="form-control"><br>
       <span class="badge badge-info" onclick="add('relation_with_p','divRelation_with','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div> <div id="divRelation_with">
    <?php  
	$relation_with_parish_list=getResultArray("SELECT * FROM ".RELATION_WITH_PARISH_TBL." WHERE status = 1  ORDER BY relation_with_parish_ID asc ");?>
				 <select name="relation_with_parish" id="relation_with_parish" class="form-control"  >
                  <option value="">Select Relation with Parish</option>
                     <?php 
					 
					 
				 foreach($relation_with_parish_list as $row){
				  ?>
				  <option value="<?php echo $row['relation_list_ID'] ;?>" <?php echo (($row['relation_list_ID']==$relation_with_parish_id)?'selected="selected"':'') ?> ><?php echo $row['name'];; ?></option>
				     <?php } ?>
                  </select></div></td>
  </tr>
                    </table>
                     <h3>Family Related Questions</h3>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
                          <tr><td colspan="2"> <div class="alert alert-info alert-white rounded">
								<button type="button" class="close"  onclick="displayquestion('main_divQuestionType')" ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong> Type
							 </div></td></tr> 
  <tr><td><table><tr>
    <td>Question Type</td>
    
    <td> <div class="questionholder" id="main_divQuestionType" style="display:none">
        <input name="questiontype_field" id="questiontype_field"  class="form-control"><br>
       <span class="badge badge-info" onclick="add('question_type','divQuestionType','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div><div id="divQuestionType">
    <?php 
	 if(!empty($question_answer_arr)){
	  foreach($question_answer_arr as $ro){  
		  $question_type_id=$ro['question_type_ID'];
		  end;
	  }
	 }
		  $question_type_list=getResultArray("SELECT * FROM ".QUESTION_TYPE_TBL." WHERE status = 1  ORDER BY question_type_ID asc ");
	    ?>
    <select name="question_type" id="question_type" class="form-control"  >
                  <option value="">Select Type</option>
                     <?php 
				 foreach($question_type_list as $row){
				  ?>
				  <option value="<?php echo $row['question_type_ID'] ;?>" <?php echo (($row['question_type_ID']==$question_type_id)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select></div></td>
  </tr>
  <?php if(!empty($question_answer_arr)){
	  $c=1;
	  foreach($question_answer_arr as $ro){?>
  	 <tr>
    <td>Ques.<?php echo $c;?></td>
    <td id="divContainer_<?php echo $ro['question_answer_ID'];?>"><input type="text" name="question[]"  class="form-control parsley-validated" id="question<?php echo $c;?>"  value="<?php echo $ro['questions'];?>" />&nbsp;<a onclick="return delete_by_id('<?php echo $ro['question_answer_ID'];?>','../../ajax/delete_question.php','divContainer_<?php echo $ro['question_answer_ID'];?>');"><i class="fa fa-times"></a></td>
  </tr>
    <tr>
    <td>Ans.<?php echo $c;?></td>
    <td><input type="text" name="answer[]"  class="form-control parsley-validated" id="answer<?php echo $c;?>" value="<?php echo $ro['answers'];?>" ></td>
  </tr>
  <?php
  $c++;
	  }
  }
  else{ $c=1;?>
    <tr>
    <td>Ques.<?php echo $c;?></td>
    <td><input type="text" name="question[]"  class="form-control parsley-validated" id="question<?php echo $c;?>"  /></td>
  </tr>
    <tr>
    <td>Ans.<?php echo $c;?></td>
    <td><input type="text" name="answer[]"  class="form-control parsley-validated" id="answer<?php echo $c;?>" ></td>
  </tr>
 
  <?php
  }?>
  <tr><td colspan="2">
  <div id='TextBoxesGroup'>
    <div id="TextBoxDiv1">
        
    </div>
</div>
 <input type="hidden" name="counter" id="counter" value="<?php echo $c;?>" />
<input type='button' value='Add' id='addButton' class="btn btn-info btn-xs">
<input type='button' value='Delete' id='removeButton' class="btn btn-danger btn-xs">
</td></tr></table>
                      </table>	
                   
                   <h3>Qualities of Candidate</h3>
                   
                   		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
  <tr>
    <td>Alter Boy</td>
    <td> <label> <input type="radio" value="1" name="altara_boy" <?php if($altara_boy=='1'){ echo 'checked="checked"';}?>> Yes </label><label> <input type="radio" value="0"  name="altara_boy"  <?php if($altara_boy=='0' || $altara_boy='' ){ echo 'checked="checked"';}?> > No</label>  </td>
  </tr>
    <tr>
    <td>Catechism Class</td>
    <td><input type="text" name="catechism_class"  class="form-control parsley-validated" id="catechism_class" value="<?php echo$catechism_class;?>" ></td>
  </tr>
    <tr>
    <td>From which class</td>
    <td><input type="text" name="from_class"  class="form-control parsley-validated" id="from_class"  value="<?php echo $from_class;?>" ></td>
  </tr>
    <tr><td colspan="2"> <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" onclick="displayquestion('main_divChurchGoing')" ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong> Church Going
							 </div></td></tr>
  <tr>
    <td>Church Going</td>
    <td><div class="questionholder" id="main_divChurchGoing" style="display:none">
        <input name="church_going_field" id="church_going_field"  class="form-control"><br>
       <span class="badge badge-info" onclick="add('church_g','divChurchGoing','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div><div id="divChurchGoing"><select name="church_going" id="church_going" class="form-control" >
                  <option value="">Select Church Going </option>
                     <?php 
					  $church_going_list=getResultArray("SELECT * FROM ".CHURCH_GOING_TBL." WHERE status = 1  ORDER BY church_going_ID asc "); 
				 foreach($church_going_list as $row){
				  ?>
				  <option value="<?php echo $row['church_going_ID'] ;?>" <?php echo (($row['church_going_ID']==$church_going)?'selected="selected"':'') ?> ><?php echo $row['status_name']; ?></option>
				     <?php } ?>
                  </select></div></td>
  </tr>
   <tr><td colspan="2"> <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" onclick="displayquestion('main_divStudyStatus')" ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong> Study Status
							 </div></td></tr>
    <tr>
    <td>Study</td>
    <td> <div class="questionholder" id="main_divStudyStatus" style="display:none">
        <input name="s_status_field" id="s_status_field"  class="form-control"><br>
       <span class="badge badge-info" onclick="add('study_status','divStudyStatus','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div><div id="divStudyStatus"><select name="study_status_id" id="study_status_id" class="form-control"  >
                  <option value="">Select Study Status</option>
                     <?php 
					  $study_status_list=getResultArray("SELECT * FROM ".STUDY_STATUS_TBL." WHERE status = 1  ORDER BY study_status_ID asc "); 
				 foreach($study_status_list as $row){
					 
				  ?>
				  <option value="<?php echo $row['study_status_ID'] ;?>" <?php echo (($row['study_status_ID']==$study_status_id)?'selected="selected"':'') ?> ><?php echo $row['status_name']; ?></option>
				     <?php } ?>
                  </select></div></td>
  </tr>
   <tr>
    <td>Percentage % </td>
    <td><input name="percentage" id="percentage"  title="Percentages" value="<?php echo $percentage; ?>" class="form-control"  type="text" ></td>
  </tr>
    <tr><td colspan="2"> <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" onclick="displayquestion('main_divQuality')" ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong>Quality
							 </div></td></tr>
   <tr>
    <td>Qualities </td>
    <td> <div class="questionholder" id="main_divQuality" style="display:none">
        <input name="quality_field" id="quality_field"  class="form-control"><br>
       <span class="badge badge-info" onclick="add('quality','divQuality','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div><div id="divQuality"><?php
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
					?></div></td>
  </tr>
  <table border="0" class="tablestudentview">
  <tr><td colspan="2" style="font-style:italic;"> (Seperated by comas)</td></tr>
  <!-- <tr>
    <th>Qualities </th>
    <td><input id="other_qualities" class="form-control" name="other_qualities"  title="Others" value="<?php echo $other_qualities;?>" type="text"></td>
  </tr>-->
 
   <tr>
    <td>Likes</td>
    <td><input id="likes" class="form-control" name="likes"  title="Likes" value="<?php echo $likes;?>" type="text"></td>
  </tr>
  
   <tr>
    <td>Dislikes</td>
    <td><input id="dislikes" class="form-control" name="dislikes"  title="Dislikes" value="<?php echo $dislikes;?>" type="text"></td>
  </tr>
  
   <tr>
    <td>Hobbies </td>
    <td><input id="hobbies" class="form-control" name="hobbies"  title="Hobbies" value="<?php echo $hobbies;?>" type="text"></td>
  </tr>
  </table>
   <tr>
    <td>Excellence Awards Received </td>
    <td><input id="awards_received" class="form-control" name="awards_received"  title="Awards Received" value="<?php echo $awards_received;?>" type="text"></td>
  </tr>
                    </table>	
                    
                    
					</div>				
				</div>
                
				
				<div class="col-md-3 splpadding">
					<div class="block-flat2">
                    <h3>Contacts to MST</h3>
					  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
                        <tr><td colspan="2"> <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" onclick="displayquestion('main_divInterestPriest')" ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong> Interest Status
							 </div></td></tr>

  <tr>
    <td>Degree of Interest to be priest</td>
    <td><div class="questionholder" id="main_divInterestPriest" style="display:none">
        <input name="interest_priest_field" id="interest_priest_field"  class="form-control"><br>
       <span class="badge badge-info" onclick="add('interest_to_priest','divInterestPriest','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div><div id="divInterestPriest"><select name="interest_to_be_priest"  id="interest_to_be_priest" class="form-control " >
    <option value="">Select Interest Status</option>
                     <?php 
					  $interest_to_be_priest_list=getResultArray("SELECT * FROM ".INTEREST_TO_BE_PRIEST_TBL." WHERE status = 1  ORDER BY interest_to_be_priest_ID asc ");  
				 foreach($interest_to_be_priest_list as $row){
				  ?>
				  <option value="<?php echo $row['interest_to_be_priest_ID'] ;?>" <?php echo (($row['interest_to_be_priest_ID']==$interest_to_be_priest)?'selected="selected"':''); ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select></div></td>
  </tr>
  <tr>
    <td>Camp Attended </td>
    <td><?php if($camp_attended=='1'){  $selected='checked="checked"';}else{$selected='';}?>
    <input id="camp_attended"  name="camp_attended" <?php echo $selected;?> title="Camp Attended"  type="checkbox"></td>
  </tr>
    
   <tr>
    <td colspan="2">Exam Results</td>
    </tr>
    <tr>
    <td colspan="2"><div style="width:100%; height:300px;  overflow-y: scroll;">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
               <tr><td colspan="2"> <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" onclick="displayquestion('main_divExamModel')" ><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
								<div class="icon"><i class="fa fa-question-circle"></i></div>
								<strong>ADD</strong> Model
							 </div></td></tr>           
       <tr>
        <td colspan="2" class="headviewbg"> 
        <div class="questionholder" id="main_divExamModel" style="display:none">
       Model<br>
        <input name="model_field" id="model_field"  class="form-control"><br>
       <span class="badge badge-info" onclick="add('exam_model','divExamModel','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div><div id="divExamModel"><select name="exam_model" id="exam_model" class="form-control">
                      <option value="">----Select Model----</option>
                      <?php  $exam_model_list=getResultArray("SELECT * FROM ".EXAM_MODEL_TBL." WHERE status = 1  ORDER BY exam_model_list_ID asc ");  
					  foreach($exam_model_list as $row){?>
                       <option value="<?php echo $row['exam_model_list_ID'];?>" <?php if($exam_model == $row['exam_model_list_ID']){?>selected="selected" <?php }?>><?php echo $row['name'];?></option>
                       <?php }?>
                       </select></div></td>
        </tr>
         <tr>
    <td>Exam Date <span style="color:#F00;">*</span></td>
    <td>
     <div class="input-group date form_date" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1">
    <input id="exam_date" class="form-control" name="exam_date"  title="Date" value="<?php if($exam_date != '') { echo date('d-m-Y',$exam_date); } ?>" type="text">
    <span class="input-group-addon btn btn-primary "><span class="glyphicon glyphicon-th"></span></span></div>
    </td>
  </tr>
        <?php /*?> <tr>
        <td colspan="2">No of Subjects</td><td><input id="no_subjects" class="form-control" name="no_subjects" required onkeyup="display_input('../ajax/ajax_subjects.php','divSubjects', this.value)" title="No Subjects"  type="text"></td>
        </tr><?php */?>
        <?php $no_of_subjects='11';?>
     <input id="no_subjects" name="no_subjects" type="hidden" value="<?php echo $no_of_subjects;?>" />
<?php 
if($action=='update'){ 
	 $exam_results_arr = getResultArray("SELECT * FROM ".EXAM_RESULT_TBL." WHERE  exam_ID = '".$exam_id."'  ORDER BY result_ID asc");
	 if(!empty($exam_results_arr)){ 
	 $i=1;?>
     <tr><td>Subjects</td><td>Marks</td></tr>
     <?php
		 foreach($exam_results_arr as $row){
	 ?>
     <tr>
    <td><input id="subjects_<?php echo $i;?>" class="form-control" name="subjects_<?php echo $i;?>"  title="Subjects" value="<?php echo $row['subjects'];?>"  type="text"></td>
    <td><input id="marks_<?php echo $i;?>" class="form-control"   value="<?php echo $row['marks'];?>"name="marks_<?php echo $i;?>"  title="Marks"  type="text"></td>
  </tr>
  <?php	
  $i++;
	$dummy=$i;	 }
	if($dummy< $no_of_subjects){
		for($j=$dummy; $j<= $no_of_subjects; $j++){
		?>
		 <tr>
    <td><input id="subjects_<?php echo $j;?>" class="form-control" name="subjects_<?php echo $j;?>"  title="Subjects"   type="text"></td>
    <td><input id="marks_<?php echo $j;?>" class="form-control"   name="marks_<?php echo $j;?>"  title="Marks"  type="text"></td>
  </tr>
	<?php	
		}
		}
	 }
	}
	else{
for($i=1; $i<=$no_of_subjects; $i++){?>
<tr>
    <td><input id="subjects_<?php echo $i;?>" class="form-control" name="subjects_<?php echo $i;?>"  title="Subjects"  type="text"></td>
    <td><input id="marks_<?php echo $i;?>" class="form-control" name="marks_<?php echo $i;?>"  title="Marks"  type="text"></td>
  </tr>
  <?php
}
	}
?>

</table></div>
 </td> </tr>

                          <tr>
    <td colspan="2">Confidential Report of Viacar</td>
    </tr>
   <tr>
    <td colspan="2"><textarea name="title"  id="title" rows="3"  class="form-control"  placeholder="Confidential report" title="Confidential report"><?php echo $title;?></textarea></td>
    </tr>
      <tr>
    <td colspan="2">Interview Comments & Result</td>
    </tr>
   <tr>
    <td colspan="2"><textarea name="interview_comments" rows="3"  class="form-control" id="interview_comments" title="Interview Comments"><?php echo $interview_comments;?></textarea></td>
    </tr>
      <tr>
    <td colspan="2">Interviewed By Fathers</td>
    </tr>
   <tr>
    <td colspan="2"><textarea name="interviewed_by" rows="3"  class="form-control" id="interviewed_by" title="Interviewed By"><?php echo $interviewed_by;?></textarea></td>
    </tr>
     <tr> <td colspan="2">Psychological Results</td></tr>
     <tr>
    <td colspan="2"><textarea name="psychological_results" rows="3"  class="form-control" id="psychological_results" placeholder="Psychological_results" title="Psychological_results"><?php echo $psychological_results;?></textarea></td>
    </tr>
  

                    </table>
                     <div class="form-group">
              <div class="col-sm-offset-2 ">
              <?php if($action =='update'){?>
              <input type="hidden" name="father_relation_id" value="<?php echo $father_relation_id;?>" />
              <input type="hidden" name="mother_relation_id" value="<?php echo $mother_relation_id;?>" />
              <input type="hidden" name="guardian_relation_id" value="<?php echo $guardian_relation_id;?>" />
              <input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
              <?php
			  }?>
              <button type="submit" class="btn btn-primary">Submit</button>
 <input type="hidden" name="select_id"  id="select_id" value="<?php echo $select_id; ?>"></div></div>
     
						
					</div>				
				</div></form>
			</div>
			
		  </div>
  </div>