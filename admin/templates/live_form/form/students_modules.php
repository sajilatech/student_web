<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Course Students MGT</a></li>
                 <li><a href="students_modules.php">Student - Modules Listing</a></li>
				  <li class="active">Student - Modules Form</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="students_modules.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
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
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="students_modules.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;">
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
             
              <div class="form-group">
                <label class="col-sm-3 control-label">Student  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <select name="std_roll" id="std_roll" required class="form-control" onchange="getStatus('ajax/loadstudentmodules.php?std_roll='+this.value,'mymodules')">
                  <option value="">Select Students</option>
                     <?php 
    			  $query=mysql_query("select std_roll, std_name from ".TABLE2." ORDER BY std_roll DESC");
				  while($row=mysql_fetch_array($query)){
				  ?>
				  <option value="<?php echo $row['std_roll'] ;?>"><?php echo $row['std_name']; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
              
              <div id="mymodules">
        
              <div class="form-group">
                <label class="col-sm-3 control-label">Module</label>
                <div class="col-sm-6"><span style="color:#F00; font-size:12px;">Select Above Student</span></div>
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