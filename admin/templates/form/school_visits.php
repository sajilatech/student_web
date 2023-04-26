<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Other MST Persons</a></li>
                 <li><a href="school_visits.php">Other MST Persons Listing</a></li>
				  <li class="active">Other MST Persons Form</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="school_visits.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
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
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="school_visits.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;">
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
             
              <div class="form-group">
                <label class="col-sm-3 control-label">School Name  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="school_name" id="school_name" required title="School Name" value="<?php echo $school_name; ?>" class="form-control">
                </div>
              </div>
               
              <div class="form-group">
                <label class="col-sm-3 control-label">Contact No.  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="school_contact_no" id="school_contact_no" required title="Contact No." value="<?php echo $school_contact_no; ?>" class="form-control">
                </div>
              </div>
           
              <div class="form-group">
                <label class="col-sm-3 control-label">School Headermaster Name  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="school_headmaster" id="school_headmaster" required title="School Headmaster" value="<?php echo $school_headmaster; ?>" class="form-control">
                </div>
              </div>
             
               <div class="form-group">
                <label class="col-sm-3 control-label">Visit Date  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <div class="input-group date form_date col-md-5 col-xs-7" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1">
                  <input type="text" name="visit_date" id="visit_date" required title="Visit Date" value="<?php echo $visit_date; ?>" class="form-control">
                   <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                   </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Who Visited  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="visit_who" id="visit_who" required title="Who Visited" value="<?php echo $visit_who; ?>" class="form-control">
                </div>
              </div>
             
               <div class="form-group">
                <label class="col-sm-3 control-label">Description  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <textarea name="description" id="description"  title="Description"  class="ckeditor form-control"><?php echo $description; ?></textarea>
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