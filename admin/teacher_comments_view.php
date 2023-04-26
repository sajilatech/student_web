<?php
 require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Teacher Comments');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'teacher_comments');
define('TEACHERTABLE',MTABLE.'teachers');

 $TDHEADING = 'View Teacher Comments';	
 $GrpPage = 3;
 require_once("header.php"); 
   list($teacher_comment_id, $comments, $teacher_id, $student_id) = $db->fetch_one_row("SELECT teacher_comment_ID, comments, teacher_ID, student_ID FROM ".TABLE." WHERE teacher_comment_ID='".$select_id."'");
 $student_row = getRowByID(MTABLE."students",'student_ID',$student_id,"");
  $teacher_row = getRowByID(MTABLE."teachers",'teacher_ID',$teacher_id,"");
 ?>
<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Teacher Comments</a></li>
                 <li><a href="appointments.php">Teacher Comments Listing</a></li>
				  <li class="active">Teacher Comments View</li>
				</ol>
			</div>
   <div class="cl-mcont">
			<div class="row">
				<div class="col-sm-6 col-md-6">
					<div class="block-flat">
						<div class="header">
							<h3>Comments of <?php	
			   echo ucfirst($teacher_row['name']);?></h3><small>	</small>
						</div>
						<div class="content">
							
							<div class="spacer">&nbsp;</div>
							<div class="color-primary">Student : </div><?php  echo ucfirst($student_row['name']); ?>
							
							<p class="spacer">
								
							</p>						
						</div>
					</div>
				
					<div class="block-flat">
						<div class="header">
							<div class="color-primary">Comments</div>
						</div>
						<div class="content overflow-hidden">
							<?php echo $comments; ?>

						</div>
					</div>
				</div>
				
				

					
				</div>			
			<a class="btn btn-primary wizard-next" href="appointments.php">Back</a>
			
		  </div>
  </div>