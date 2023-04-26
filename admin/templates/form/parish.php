<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Parish</a></li>
                 <li><a href="parish.php">Parish Listing</a></li>
				  <li class="active">Parish Form</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="parish.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
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
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="parish.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;">
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
             
              <div class="form-group">
                <label class="col-sm-3 control-label">Name  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="parish_name" id="parish_name" required title="Name" value="<?php echo $parish_name; ?>" class="form-control">
                </div>
              </div>
              
            <div class="form-group">
                <label class="col-sm-3 control-label">Diocese</label>
                <div class="col-sm-6">
                   <select name="diocese_id" id="diocese_id" class="form-control" required>
                   <option value="">--Select Diocese--</option>
                     <?php
					 $diocese_arr=getResultArray("SELECT diocese_ID, diocese_name FROM ".MTABLE."diocese WHERE diocese_status = 1  ORDER BY diocese_ID asc "); 
   foreach($diocese_arr as $row)
   {
	  ?><option value="<?php echo $row['diocese_ID'];?>" <?php if($row['diocese_ID']==$diocese_id){ echo 'selected="selected"'; }?>><?php echo $row['diocese_name'];?></option>
      <?php
   }
   ?>
                  </select>									
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Vicari Name  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="vicari" id="vicari" required title="Vicari Name" value="<?php echo $vicari; ?>" class="form-control">
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Phone  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="phone" id="phone" required title="Phone" value="<?php echo $phone; ?>" class="form-control">
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Google Map</label>
                <div class="col-sm-6">
                <textarea class="ckeditor form-control" name="description" id="description"><?php echo $description; ?></textarea>
                 
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