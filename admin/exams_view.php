<?php
 require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Exams');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'Exams');

 $TDHEADING = 'View Exams';	
  $GrpPage = 3;
  require_once("header.php");  list($exam_id, $student_id, $exam_type, $subject, $exam_model, $marks, $description, $exam_date) = $db->fetch_one_row("SELECT exam_ID, student_ID, exam_type, subject,  exam_model, marks, description, exam_date FROM ".TABLE." WHERE exam_ID='".$select_id."'");
 $student_row = getRowByID(MTABLE."students",'student_ID',$student_id,"");
 
 ?>
<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Exams</a></li>
                 <li><a href="exams.php">Exams Listing</a></li>
				  <li class="active">Exams View</li>
				</ol>
			</div>
   <div class="cl-mcont">
			<div class="row">
				<div class="col-sm-6 col-md-6">
					<div class="block-flat">
						<div class="header">
							<h3>Exam of <?php	
			   echo ucfirst($student_row['name']);?></h3><small>	</small>
						</div>
						<div class="content">
							
							<div class="spacer">&nbsp;</div>
							<div class="color-primary">Exam Type : <?php echo $exam_type; ?></div>
							
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
							<h3>Subject</h3>
						</div>
						<div class="content overflow-hidden">
							<address>
								<strong><?php echo $subject; ?></strong><br>
								<div class="color-primary">Marks : &nbsp; <?php echo $marks; ?></div>
								<br>
										
						</div>
						
							
						</div>
					</div>

					<div class="block-flat">
						<div class="header">
							<h3>Model</h3>
						</div>
						<div class="content overflow-hidden">
							<p class="color-primary"><?php foreach($exam_model_list as $key=> $value){ 
							if($key==$exam_model){ echo $value; }
							}?>
							</p>
							
						</div>
					</div>
			
				</div>			
			<a class="btn btn-primary wizard-next" href="appointments.php">Back</a>
			
		  </div>
  </div>