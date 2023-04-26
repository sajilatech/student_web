<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Appointments</a></li>
                 <li><a href="appointments.php">Appointments Listing</a></li>
				  <li class="active">Appointments Form</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="appointments.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
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
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="appointments.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;">
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
             
              <div class="form-group">
                <label class="col-sm-3 control-label">Title  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="title" id="title" required title="Title" value="<?php echo $title; ?>" class="form-control">
                </div>
              </div>
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
                <label class="col-sm-3 control-label">From Date  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <div class="input-group date form_date col-md-5 col-xs-7" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1">
                  <input type="text" name="from_date" id="from_date" required title="From" value="<?php if($from_date != '') { echo date('d-m-Y',$from_date); } ?>" class="form-control">
                   <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">To Date  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <div class="input-group date form_date col-md-5 col-xs-7" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2">
              
                  <input type="text" name="to_date" id="to_date" required title="To" value="<?php if($to_date != '') { echo date('d-m-Y',$to_date); } ?>"  class="form-control">
                   <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>
                </div>
              </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Place  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="place" id="place" required title="Place" value="<?php echo $place; ?>" class="form-control">
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">State  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="state" id="state" required title="State" value="<?php echo $state; ?>" class="form-control">
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Country <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 
                   <select name="country" id="country" class="form-control" >
                  <option value="">--Select Country--</option>
               <?php  foreach($country_array as $key=>$value){
				  ?>
				  <option value="<?php echo $key ;?>" <?php echo (($key==$country)?'selected="selected"':'') ?> ><?php echo $value; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Give an order  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="order" id="order" required title="Order" value="<?php echo $order; ?>" class="form-control">
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