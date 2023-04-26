<?php
 require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Appointments');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'appointments');
define('DIOTABLE',MTABLE.'diocese');

 $TDHEADING = 'View Appointments';	
 $GrpPage = 3;
  require_once("header.php");

list($appointment_id, $student_id, $title, $place, $from_date, $to_date, $state, $country, $description, $order ) = $db->fetch_one_row("SELECT appointment_ID, student_ID, title, place,  from_date, to_date, state, country, description, appointment_order FROM ".TABLE." WHERE appointment_ID='".$select_id."'");
 $student_row = getRowByID(MTABLE."students",'student_ID',$student_id,"");
 
 ?>
 
 <div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Appointment View</h2>
      <ol class="breadcrumb">
        <li><a href="home.php">Home</a></li>
        <li><a href="appointments">Appointments</a></li>
        <li class="active">Appointment View</li>
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
                <label class="col-sm-3 control-label" style="padding-top:0px;">Student Name</label>
                <div class="col-sm-6"><?php	
			   echo ucfirst($student_row['name']);?></div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Title</label>
                <div class="col-sm-6"><?php echo $title; ?></div>
              </div>



				<div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Descriptions</label>
                <div class="col-sm-6"><?php echo $description; ?></div>
              	</div>
                
                     <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Place</label>
                <div class="col-sm-6"><?php echo $place; ?></div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">State</label>
                <div class="col-sm-6"><?php echo $state; ?></div>
              </div>



				<div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">Country</label>
                <div class="col-sm-6"><?php  foreach($country_array as $key=>$value){
								if($country==$key){ echo $value; }
							}
				  ?></div>
              	</div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">From</label>
                <div class="col-sm-6"> <?php echo date('d-M-Y', $from_date);?></div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label" style="padding-top:0px;">To</label>
                <div class="col-sm-6"> <?php echo date('d-M-Y', $to_date);?></div>
              </div>
              
                <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
               	<a class="btn btn-primary wizard-next" href="appointments.php">Back</a>
              </div>
              </div>
              </form>


             
              
           
              
              
    
          
              
              
          </div>
        </div>
        
        

        

        

        

        
        
      </div>
    </div>
    
    </div>
  </div>
  
