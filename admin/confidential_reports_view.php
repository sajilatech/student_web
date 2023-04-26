<?php
 require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Confidential Reports');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'confidential_reports');
define('CREPORTS_ATTACH_TABLE',MTABLE.'creports_attach');

 $TDHEADING = 'View Confidential Reports';	
  $GrpPage = 3;
  require_once("header.php"); 
  list($creport_id, $student_id, $title, $interview_comments, $interview_results, $interviewed_by, $psychological_results, $description ) = $db->fetch_one_row("SELECT creport_ID, student_ID, title, interview_comments,  interview_results, interviewed_by, psychological_results, description FROM ".TABLE." WHERE creport_ID='".$select_id."'");
  list($scan ) = $db->fetch_one_row("SELECT file FROM ".CREPORTS_ATTACH_TABLE." WHERE creport_ID='".$select_id."' AND type= 'scan'");
   list($attachments ) = $db->fetch_one_row("SELECT file FROM ".CREPORTS_ATTACH_TABLE." WHERE creport_ID='".$select_id."' AND type= 'attachments'");

 $student_row = getRowByID(MTABLE."students",'student_ID',$student_id,"");
 
 ?>
<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Confidential Reports</a></li>
                 <li><a href="confidential_reports.php">Confidential Reports Listing</a></li>
				  <li class="active">Confidential Reports View</li>
				</ol>
			</div>
   <div class="cl-mcont">
			<div class="row">
				<div class="col-sm-6 col-md-6">
					<div class="block-flat">
						<div class="header">
							<h3>Confidential Reports of <?php	
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
				
				<div class="row dash-cols">
				<div class="col-sm-6 col-md-6">
					<div class="block">
						<div class="header">
							<h2>Interview <span class="pull-right"></span></h2>
						</div>
						<div class="content no-padding ">
							<ul class="items">
								<li>
									<i class="fa fa-file-text"></i>Interview Comments <span class="pull-right value"><?php echo $interview_comments;?></span>
								</li>
								<li>
									<i class="fa fa-file-text"></i>Interview Results<span class="pull-right value"><?php echo $interview_comments;?></span>
								</li>
								<li>
									<i class="fa fa-file-text"></i>Interviews By<span class="pull-right value"><?php echo $interviewed_by;?></span>
								</li>
								
							</ul>
						</div>
							
					</div>
				</div>	
				<div class="row">
				
				
				<div class="col-md-4">
					<div class="block-flat">
						<div class="header">							
							<h3>Scan Image</h3>
						</div>
						<div class="content">
							<div class="row">
								<div class="col-md-12">
								  <ul class="nav nav-pills nav-stacked margin-bottom">
									<li class="active"><?php if($scan != '') { ?> <a href="<?php echo '../'.UPLOADS.'/confidential_reports_scan/'.$scan ;?>" target="_blank"><i class="fa fa-home fa-fw"></i>&nbsp; <?php echo $scan;  ?></a><?php }?></li>
									
								  </ul>
								</div>
							</div>
		
						</div>
					</div>				
				</div>
				
				<div class="col-md-4">
					<div class="block-flat">
						<div class="header">							
							<h3>Attachment</h3>
						</div>
						<div class="content">
							<div class="row">
								<div class="col-md-12">
								  <ul class="nav nav-pills nav-stacked margin-bottom">
									<li class="active"> <?php if($attachments != '') { ?> <a href="<?php echo '../'.UPLOADS.'/confidential_reports_attachments/'.$attachments; ?>" target="_blank"><?php echo $attachments; ?></a><?php } ?></li>
                                    </ul>
								</div>
							</div>
		
						</div>
					</div>				
				</div>
			</div>
			</div>
			<a class="btn btn-primary wizard-next" href="appointments.php">Back</a>
			
		  </div>
  </div>