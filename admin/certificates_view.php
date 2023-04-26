<?php
 require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Certificates');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'student_certificates');

 $TDHEADING = 'View Certificates';	
  $GrpPage = 3;
 require_once("header.php"); 
$student_certificates_arr=getResultArray("SELECT * FROM ".MTABLE."student_certificates WHERE student_ID = '". $select_id."'  ORDER BY certificate_ID asc ");
 $student_row = getRowByID(MTABLE."students",'student_ID',$select_id,"");
 
 ?>
<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Certificates</a></li>
                 <li><a href="certificates.php">Certiicates Listing</a></li>
				  <li class="active">Certificates View</li>
				</ol>
			</div>
   <div class="cl-mcont">
			<div class="row">
				<div class="col-sm-6 col-md-6">
					<div class="block-flat">
						<div class="header">
							<h3><?php	
			   echo ucfirst($student_row['name']);?></h3><small>	</small>
						</div>
						<div class="content">
							
							<div class="block-flat">
						<div class="header">
							<h3>Certificates</h3>
						</div>
						<div class="block">
							 <div class="content no-padding ">
    
							<ul class="items" >
                            <?php foreach($student_certificates_arr as $row){  ?>
								<li style="padding-left:0px;"><a href="<?php echo '../'.UPLOADS."/certificates/".$row['file_name']?>" target="_blank"><i class="fa fa-file-text" style="line-height:10px;"></i><?php echo $row['file_name'];?></a> </li>
								<?php
							}
							?>
							</ul></div>					
						</div>
					</div>				
						</div>
					</div>
				
					
				</div>
				
				</div>			
			<a class="btn btn-primary wizard-next" href="certificates.php">Back</a>
			
		  </div>
  </div>