<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Confidential Reports</a></li>
                 <li><a href="confidential_reports.php">Confidential Reports Listing</a></li>
				  <li class="active">Confidential Reports Form</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="confidential_reports.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
          </div>
          <div class="content">
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
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="confidential_reports.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;">
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
                <div class="form-group">
                <label class="col-sm-3 control-label">Student Name  </label>
                <div class="col-sm-6">
                   <select name="student_id" id="student_id" class="form-control" required>
                   <option value="">--Select Student Name--</option>
                     <?php
					 $student_arr=getResultArray("SELECT student_ID, name FROM ".MTABLE."students WHERE student_status = 1  ORDER BY student_ID asc "); 
   foreach($student_arr as $row)
   {
	  ?><option value="<?php echo $row['student_ID'];?>" <?php if($row['student_ID']==$student_id){ echo 'selected="selected"'; }?>><?php echo $row['name'];?></option>
      <?php
   }
   ?>
                  </select>			
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Title  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="title" id="title" required title="Title" value="<?php echo $title; ?>" class="form-control">
                </div>
              </div>
              
             <div class="form-group">
                <label class="col-sm-3 control-label">Interview Comments  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <textarea name="interview_comments" id="interview_comments" required title="Interview Comments"  class="form-control"><?php echo $interview_comments; ?></textarea>
                </div>
              </div>
              
             <?php /*?> <div class="form-group">
                <label class="col-sm-3 control-label">Interview Results  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <textarea name="interview_results" id="interview_results" required title="Interview Results"  class="form-control"><?php echo $interview_results; ?></textarea>
                </div>
              </div><?php */?>
            
               <div class="form-group">
                <label class="col-sm-3 control-label">Interviewed by  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="interviewed_by" id="interviewed_by" required title="Interviwed By" value="<?php echo $interviewed_by; ?>" class="form-control">
                </div>
              </div>
                 <div class="form-group">
                <label class="col-sm-3 control-label">Psychological Results  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <textarea name="psychological_results" id="psychological_results" required title="Psychological Results"  class="form-control"><?php echo $psychological_results; ?></textarea>
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Scan Image  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input  name="scan" id="scan" type="file" title="Scan"  class="form-control" >
                   <?php if($scan != '') { ?><a href="<?php echo '../'.UPLOADS.'/confidential_reports_scan/'.$scan ;?>" target="_blank"><?php echo $scan;  ?></a><?php }?>
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label"> Attachment Documents  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input  name="attachments" id="attachments" type="file" title="Attachments"  class="form-control" >
                  <?php if($attachments != '') { ?><a href="<?php echo '../'.UPLOADS.'/confidential_reports_attachments/'.$attachments; ?>" target="_blank"><?php echo $attachments; ?></a><?php } ?>
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Description  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <textarea name="description" id="description" required title="Description"  class="ckeditor form-control"><?php echo $description; ?></textarea>
                </div>
              </div>
               <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
               <!-- <button type="reset" class="btn btn-default">Reset</button>-->
              </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    </div>
  </div>