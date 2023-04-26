<div class="container-fluid" id="pcont">
    <div class="page-head">
      <ol id="showlinks" class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Course MGT</a></li>
        <li><a href="courses_modules.php">Courses - Modules Listing</a></li>
        <li class="active">Courses - Modules Form</li>
      </ol>
    </div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="courses_modules.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
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
    <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="courses_modules.php" method="post" style="border-radius: 0px;">
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
             
             <div class="form-group">
                <label class="col-sm-3 control-label">Courses  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <select name="crs_id" id="crs_id" required class="form-control">
                  <option value="">Select Course</option>
                     <?php 
    $query=mysql_query("select crs_id, crs_code, crs_name from ".TABLE2." where crs_status = 1");
				  while($row=mysql_fetch_array($query)){
				  ?>
				  <option value="<?php echo $row['crs_id'] ;?>"><?php echo $row['crs_name'].' - '.$row['crs_code']; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Module  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <select name="mdl_id" id="mdl_id" required class="form-control">
                  <option value="">Select Module</option>
                     <?php 
    $query=mysql_query("select mdl_id, mdl_code, mdl_name from ".TABLE3." where mdl_status = 1");
				  while($row=mysql_fetch_array($query)){
				  ?>
				  <option value="<?php echo $row['mdl_id'] ;?>"><?php echo $row['mdl_name'].' - '.$row['mdl_code']; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
              
              
              


               <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
              </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    </div>
  </div>