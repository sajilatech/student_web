<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Exams</a></li>
                 <li><a href="exams.php">Exams Listing</a></li>
				  <li class="active">Exams Form</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="exams.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
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
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="exams.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;">
             <?php if(isset($retur)){?>
				 <input type="hidden" name="retur" value="<?php echo $retur; ?>">
                 <?php
			 }
			 ?>
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
             
              <div class="form-group">
                <label class="col-sm-3 control-label">Exam Type  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <select name="exam_type" id="exam_type" class="form-control">
                  <option value="Catechims">Catechims</option>
                   <option value="Academic">Academic</option>
                   </select>
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Exam Model  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <select name="exam_model" id="exam_model" class="form-control">
                  <option value="">----Select Model----</option>
                  <?php foreach($exam_model_list as $key=> $value){?>
                  <option value="<?php echo $key;?>" <?php if($exam_model == $key){?>selected="selected" <?php }?>><?php echo $value;?></option>
                   <?php }?>
                   </select>
                </div>
              </div>
             <?php $no_of_subjects='5';?>
     <input id="no_subjects" name="no_subjects" type="hidden" value="<?php echo $no_of_subjects;?>" />
<?php 
if($action=='update'){ 
	 $exam_results_arr = getResultArray("SELECT * FROM ".EXAM_RESULT_TBL." WHERE  exam_ID = '".$exam_id."'  ORDER BY result_ID asc");
	 if(!empty($exam_results_arr)){ 
	 $i=1;?>
   
     <?php
		 foreach($exam_results_arr as $row){
	 ?>
      <div class="form-group">
                <label class="col-sm-3 control-label">Subjects <?php echo $i;?></label>
    <div class="col-sm-6"><input id="subjects_<?php echo $i;?>" class="form-control" name="subjects_<?php echo $i;?>"  title="Subjects" value="<?php echo $row['subjects'];?>"  type="text"> </div>
              </div>
    <div class="form-group">
                <label class="col-sm-3 control-label">Marks</label>
    <div class="col-sm-6"><input id="marks_<?php echo $i;?>" class="form-control"   value="<?php echo $row['marks'];?>"name="marks_<?php echo $i;?>"  title="Marks"  type="text"></div>
              </div>
  <?php	
  $i++;
	$dummy=$i;	 }
	if($dummy< $no_of_subjects){
		for($j=$dummy; $j<= $no_of_subjects; $j++){
		?>
		 <div class="form-group">
                <label class="col-sm-3 control-label">Subjects <?php echo $j;?></label>
     <div class="col-sm-6"><input id="subjects_<?php echo $j;?>" class="form-control" name="subjects_<?php echo $j;?>"  title="Subjects"   type="text"></div>
              </div>
    <div class="form-group">
                <label class="col-sm-3 control-label">Marks</label>
    <div class="col-sm-6"><input id="marks_<?php echo $j;?>" class="form-control"   name="marks_<?php echo $j;?>"  title="Marks"  type="text"></div>
              </div>
	<?php	
		}
		}
	 }
	}
	else{
for($i=1; $i<=$no_of_subjects; $i++){?>
 <div class="form-group">
                <label class="col-sm-3 control-label">Subjects <?php echo $i;?></label>
     <div class="col-sm-6"><input id="subjects_<?php echo $i;?>" class="form-control" name="subjects_<?php echo $i;?>"  title="Subjects"  type="text"></div>
              </div>
  <div class="form-group">
                <label class="col-sm-3 control-label">Marks</label> <div class="col-sm-6"><input id="marks_<?php echo $i;?>" class="form-control" name="marks_<?php echo $i;?>"  title="Marks"  type="text"></div>
              </div>
  <?php
}
	}
?>
              <!-- <div class="form-group">
                <label class="col-sm-3 control-label">Exam Start Date  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <div class="input-group date form_date col-md-5 col-xs-7" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1">
                  <input type="text" name="exam_date" id="exam_date" required title="Exam Date" value="<?php if($exam_date != '') { echo date('d-m-Y',$exam_date); } ?>" class="form-control">
                   <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>
                </div>
              </div>-->
           <!-- <div class="form-group">
                <label class="col-sm-3 control-label">Marks  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="marks" id="marks" required title="Marks" value="<?php echo $marks; ?>" class="form-control">
                </div>
              </div>-->
             
            <div class="form-group">
                <label class="col-sm-3 control-label">Student Name</label>
                <div class="col-sm-6">
                   <select name="student_id" id="student_id" class="form-control" required>
                   <option value="">--Select Student--</option>
									 <?php
                                     $student_arr=getResultArray("SELECT student_ID, name FROM ".MTABLE."students WHERE student_status = 1  ORDER BY student_added_date asc "); 
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
                <label class="col-sm-3 control-label">Descriptions  <span style="color:#F00;">*</span></label>
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