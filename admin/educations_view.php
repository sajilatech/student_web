<?php
 require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Educations');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'educations');

 $TDHEADING = 'View Educations';
 $GrpPage = 3;	
 require_once("header.php");
  list($education_id, $student_id, $education_type, $place, $start_year, $end_year, $level_of, $country, $degree, $institution_name, $description ) = $db->fetch_one_row("SELECT education_ID, student_ID, education_type, place,  start_year, end_year, level_of, country, degree, institution_name, description FROM ".TABLE." WHERE education_ID='".$select_id."'");
 $student_row = getRowByID(MTABLE."students",'student_ID',$student_id,"");
 
 ?>
 
   <div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Educations</h2>
      
       <ol class="breadcrumb">
        <li><a href="home.php">Home</a></li>
        <li><a href="educations.php">Educations Listing</a></li>
        <li class="active">Education View</li>
      </ol>
      
    </div>
    <div class="cl-mcont">
    <div class="row"></div>
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
         
          <div class="content">
          
           <form class="form-horizontal group-border-dashed" action="#" style="border-radius: 0px;">
           
          <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Student</label>
                <div class="col-sm-6"><?php	
			   echo ucfirst($student_row['name']);?></div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Institute</label>
                <div class="col-sm-6"><?php echo $institution_name; ?></div>
              </div>



				<div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Descriptions</label>
                <div class="col-sm-6"><?php echo $description; ?></div>
              	</div>
                
                     <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Place</label>
                <div class="col-sm-6"><?php echo $place;?></div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Country</label>
                <div class="col-sm-6"><?php  foreach($country_array as $key=>$value){
								if($country==$key){ echo $value; }
							}
				  ?></div>
              </div>
   <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Start Year</label>
                <div class="col-sm-6"><?php echo $start_year;?></div>
              </div>
                 <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">End Year</label>
                <div class="col-sm-6"> <?php echo  $end_year;?></div>
              </div>
   <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Level Of</label>
                <div class="col-sm-6"><?php echo $level_of; ?></div>
              </div>
               <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
<a class="btn btn-primary wizard-next" href="educations.php">Back</a>
 </div>
              </div>
              
              </form>
              
          </div>
        </div>
      </div>
    </div>
    
