<?php
 require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Publicatins And Conferences');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'publications_n_conferences');
define('AWARDTABLE',MTABLE.'awards');

 $TDHEADING = 'View Publications And Conferences';	
  $GrpPage = 3;
 require_once("header.php");
 list($publication_id, $student_id, $title, $description, $place, $year, $publisher, $publication_type) = $db->fetch_one_row("SELECT publication_ID, student_ID, title, description,  place,  year, publisher, publication_type FROM ".TABLE." WHERE publication_ID='".$select_id."'");
		  
  
  $award_row = getRowByID(AWARDTABLE,'publication_ID',$select_id,"");
 $student_row = getRowByID(MTABLE."students",'student_ID',$student_id,"");
 
 ?>
  <div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Publications And Conferences</h2>
      <ol class="breadcrumb">
        <li><a href="home.php">Home</a></li>
        <li><a href="publications_n_conferences.php">Publications And Conferences</a></li>
        <li class="active">Publications And Conferences View</li>
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
                <div class="col-sm-6"><?php echo $place;?></div>
              </div>
              
             <div class="col-sm-6 col-md-6">
					<div class="block">
						<div class="header">
							<h2>Publications <span class="pull-right"></span></h2>
						</div>
						<div class="content no-padding ">
							<ul class="items">
								<li>
									<i class="fa fa-file-text"></i>Publisher <span class="pull-right value"><?php echo $publisher;?></span>
								</li>
								<li>
									<i class="fa fa-file-text"></i>Publication Type<span class="pull-right value"><?php echo $publication_type;?></span>
								</li>
								<li>
									<i class="fa fa-file-text"></i>Year<span class="pull-right value"><?php echo $year;?></span>
								</li>
								
							</ul>
						</div>
							
					</div>
				</div>
                <?php if(!empty($award_row)){?>
                <div class="col-sm-6 col-md-6">
					<div class="block">
						<div class="header">
							<h2>Awards <span class="pull-right"></span></h2>
						</div>
						<div class="content no-padding ">
							<ul class="items">
								<li>
									<i class="fa fa-file-text"></i>Award Title <span class="pull-right value"><?php echo $award_row['award_title'];?></span>
								</li>
								<li>
									<i class="fa fa-file-text"></i>Year<span class="pull-right value"><?php echo $award_row['award_year'];?></span>
								</li>
								<li>
									<i class="fa fa-file-text"></i>Award For<span class="pull-right value"><?php echo $award_row['award_for'];?></span>
								</li>
								<li>
									<i class="fa fa-file-text"></i>Award From<span class="pull-right value"><?php echo $award_row['award_from'];?></span>
								</li>
							</ul>
						</div>
							
					</div>
				</div>
               <?php
				}?>
                 <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <a class="btn btn-primary wizard-next" href="publications_n_conferences.php">Back</a>
                </div>
                </div>
              </form>


             
              
           
              
              
    
          
              
              
          </div>
        </div>
        
        

        

        

        

        
        
      </div>
    </div>
    
    </div>
  </div> 
</div>
 
