<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Other MST Persons</a></li>
                 <li><a href="other_mst_persons.php">Other MST Persons Listing</a></li>
				  <li class="active">Other MST Persons Form</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="other_mst_persons.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
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
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="other_mst_persons.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;">
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
             
              <div class="form-group">
                <label class="col-sm-3 control-label">Name  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="name" id="name" required title="Name" value="<?php echo $name; ?>" class="form-control">
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Category <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <select name="category" id="category" class="form-control" >
                  <option value="">Select Category</option>
                     <?php 
				 foreach($persons_category_list as $key=> $value){
				  ?>
				  <option value="<?php echo $key ;?>" <?php echo (($key==$category)?'selected="selected"':'') ?> ><?php echo $value; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Email  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="email" id="email" required title="Email" value="<?php echo $email; ?>" class="form-control">
                </div>
              </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Parish</label>
                <div class="col-sm-6">
                   <select name="parish_id" id="parish_id" class="form-control" required>
                   <option value="">--Select Parish--</option>
                     <?php
					 $parish_arr=getResultArray("SELECT parish_ID, name FROM ".MTABLE."parish WHERE parish_status = 1  ORDER BY parish_ID asc "); 
   foreach($parish_arr as $row)
   {
	  ?><option value="<?php echo $row['parish_ID'];?>" <?php if($row['parish_ID']==$parish_id){ echo 'selected="selected"'; }?>><?php echo $row['name'];?></option>
      <?php
   }
   ?>
                  </select>									
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">MST ID  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="mst_id" id="mst_id" required title="MST ID" value="<?php echo $mst_id; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Cell Phone  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="cell_phone" id="cell_phone" required title="Cell Phone" value="<?php echo $cell_phone; ?>" class="form-control">
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Land Phone  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="land_phone" id="land_phone" required title="Land Phone" value="<?php echo $land_phone; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Place  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="place" id="place" required title="Place" value="<?php echo $place; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">District  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="district" id="district" required title="District" value="<?php echo $district; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Country  <span style="color:#F00;">*</span></label>
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
                <label class="col-sm-3 control-label">Post Code  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="post_code" id="post_code" required title="Post Code" value="<?php echo $post_code; ?>" class="form-control">
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