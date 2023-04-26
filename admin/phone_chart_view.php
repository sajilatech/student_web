<?php
 require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Phone Charts');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'phone_chart');
define('DIOTABLE',MTABLE.'diocese');

 $TDHEADING = 'View Phone Chart';
  $GrpPage = 3;	
 require_once("header.php"); 
  list($phone_chart_id, $student_id, $title, $date,  $description,  $phone_call_type, $phone_call_status, $our_phone_no, $phone_no, $reminder_check) = $db->fetch_one_row("SELECT phone_chart_ID, student_ID, title, date, description, phone_call_type,  phone_call_status, our_phone_no, phone_no, reminder_check FROM ".TABLE." WHERE phone_chart_ID='".$select_id."'");
 $student_row = getRowByID(MTABLE."students",'student_ID',$student_id,"");
 
 ?>
<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Phone Chart</a></li>
                 <li><a href="appointments.php">Phone Chart Listing</a></li>
				  <li class="active">Phone Chart  View</li>
				</ol>
			</div>
   <div class="cl-mcont">
			<div class="row">
				<div class="col-sm-6 col-md-6">
					<div class="block-flat">
						<div class="header">
							<h3>Phone Charts of <?php	
			   echo ucfirst($student_row['name']);?></h3><small>	</small>
						</div>
						<div class="content">
							
							<div class="spacer">&nbsp;</div>
							<div class="color-primary">Title : </div><?php echo $title; ?>
							
							<p class="spacer">
								
							</p>						
						</div>
					</div>
				
					<div class="block-flat">
						<div class="header">
							<div class="color-primary">Descriptions</div>
						</div>
						<div class="content overflow-hidden">
							<?php echo $description; ?>

						</div>
					</div>
				</div>
				
				<div class="col-sm-6 col-md-6">

					<div class="block-flat">
						<!--<div class="header">							
							<h3>Body Elements</h3>
						</div>-->
                        
						<div class="header">
							<h3>Address</h3>
						</div>
						<div class="content overflow-hidden">
							<address>
								<strong><?php echo $place; ?></strong><br>
								<?php echo $state; ?><br>
								<?php  foreach($country_array as $key=>$value){
								if($country==$key){ echo $value; }
							}
				  ?><br>
										
						</div>
						
							
						</div>
					</div>

					<div class="block-flat">
						<div class="header">
							<h3>Date</h3>
						</div>
						<div class="content overflow-hidden">
							<p class="color-primary">From : <?php echo date('d-M-Y', $from_date);?></p>
							<p class="color-primary">To : <?php echo date('d-M-Y', $to_date);?></p>
							
						</div>
					</div>
			
				</div>			
			<a class="btn btn-primary wizard-next" href="appointments.php">Back</a>
			
		  </div>
  </div>