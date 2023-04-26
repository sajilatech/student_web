<div class="container-fluid" id="pcont">
    <div class="page-head">
      <ol id="showlinks" class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Branch MGT</a></li>
        <li><a href="staffs_previleges.php">Staffs Previleges Listing</a></li>
        <li class="active">Staffs Previlege Form</li>
      </ol>
    </div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="staffs_previleges.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
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
    <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="staffs_previleges.php" method="post" style="border-radius: 0px;">
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
             
             <div class="form-group">
                <label class="col-sm-3 control-label">Staff  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <select name="staff_id" id="staff_id" required class="form-control">
                  <option value="">Select Staff</option>
                     <?php 
    $query=mysql_query("select * from ".TABLE2." AS S, ".TABLE3." AS B where S.brnch_id = B.brnch_id AND S.staff_status = 1");
				  while($row=mysql_fetch_array($query)){
				  ?>
				  <option value="<?php echo $row['staff_id'] ;?>"><?php echo $row['staff_name'].' - '.$row['brnch_name'].' ('.$row['brnch_location'].')'; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Privilege  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <select name="previl_item" id="previl_item" required class="form-control">
                  <option value="">Select Privilege</option>
                     <?php 
   foreach($privileges_list as $key=>$privileges_lists)
   {
	   echo '<option value="'.$key.'" '.(($key==$previl_item)?'selected="selected"':'').'>'.$privileges_lists.'</option>';
   }
   ?>
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