<script type="text/javascript" src="../../js/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type = "text/javascript" language = "javascript">
         function ajax_phone_number(path,container){ 
		  var by_id = $('#phone_call_type').val();
			  $.ajax({
								type:'POST',
								url:path,
								data:{'by_id':by_id},
								success: function(option_tags) { 
									
									$('#'+container).html(option_tags);
								}
						});
				 }
			function checkbox(){ 
				if($("#reminder_checkbox").prop('checked') == true) {
					 $("#txtreminder").show();  
				} else {
					 $("#txtreminder").hide();
				}
			  }
			  
			  function delete_reminder(path, by_id){
				  var ans=confirm("Do you want to Delete this reminder?");
					if(ans==true){
							   $.ajax({
											type:'POST',
											url:path,
											data:{'by_id':by_id},
											success: function(option_tags) { 
												$('#divReminder').html(option_tags);
												location.reload();
											}
									});
						}
					else{
						return false;	
					}
				  
				  }
				  
			 </script>

<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Phone Calls</a></li>
                 <li><a href="phone_chart.php">Phone Calls Listing</a></li>
				  <li class="active">Phone Calls Form</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="phone_chart.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
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
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="phone_chart.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;">
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
                <label class="col-sm-3 control-label">Phone Number  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="our_phone_no" id="our_phone_no" required title="Phone No." value="<?php echo $our_phone_no; ?>" class="form-control">
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Date  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <div class="input-group date form_date col-md-5 col-xs-7" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1">
                  <input type="text" name="date" id="date" required title="Date" value="<?php if($date != '') { echo date('d-m-Y',$date); } ?>" class="form-control">
                   <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Phone Call Type  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                   <select name="phone_call_type" id="phone_call_type" class="form-control"  onchange="ajax_phone_number('../ajax/ajax_phone_number.php','divIncoming_outgoing')">
                    <option value="">----Select Call Type ----</option>
                  <?php foreach($phone_call_type_list as $key=> $value){?>
                  <option value="<?php echo $key;?>" <?php if($phone_call_type == $key){?>selected="selected" <?php }?>><?php echo $value;?></option>
                   <?php }?>
                   </select>
                </div>
              </div>
              
               <div class="form-group"> <div id="divIncoming_outgoing">
         <?php      if($phone_call_type=='1'){
?>

 <label class="col-sm-3 control-label">Incoming Phone Number  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="phone_no" id="phone_no" required title="Incoming Phone No." value="<?php echo $phone_no ;?>"  class="form-control">
                </div>
<?php
}
else if($phone_call_type=='2'){?>
<label class="col-sm-3 control-label">Outgoing Phone Number  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="phone_no" id="phone_no" required title="Outgoing Phone No."  value="<?php echo $phone_no ;?>" class="form-control">
                </div>

<?php
}
?>
              </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Phone Call Status  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <select name="phone_call_status" id="phone_call_status" class="form-control">
                   <option value="">----Select Call Status----</option>
                  <?php foreach($phone_call_status_list as $key=> $value){?>
                  <option value="<?php echo $key;?>" <?php if($phone_call_status == $key){?>selected="selected" <?php }?>><?php echo $value;?></option>
                   <?php }?>
                   </select>
                </div>
              </div>
            
               <div class="form-group">
                <label class="col-sm-3 control-label">Description  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <textarea name="description" id="description" required title="Description"  class="form-control"><?php echo $description; ?></textarea>
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Reminders in Calling  </label>
                <div class="col-sm-6">
                  <input type="checkbox"  name="reminder_checkbox" id="reminder_checkbox"  <?php if($reminder_check =='1'){?> checked="checked"<?php }?> onclick="checkbox()" >
                </div>
              </div>
              <?php if($reminder_check == '1'){?>
               <div id="txtreminder" style="display:block;">
              <?php
			  }else{?>
              <div id="txtreminder" style="display:none;">
              <?php }?>
             <div class="form-group">
                <label class="col-sm-3 control-label">Reminder Date  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                 <div class="input-group date form_date col-md-5 col-xs-7" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1">
                  <input type="text" name="reminder_date" id="reminder_date"  title="Reminder Date" value="<?php if($reminder_date != '') { echo date('d-m-Y',$reminder_date); } ?>" class="form-control">
                   <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>
                </div>
              </div>
             <div class="form-group"><?php if(!$reminder_time==""){
				 list($select1, $select2) = split('[-.-]', $reminder_time);
				  }?>
                <label class="col-sm-3 control-label">Reminder Time  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6" ><?php $start = strtotime('12:00 AM');
    $end   = strtotime('11:59 PM');?><div style="float:left;">
                <select class="form-control" name="select1" id="select1" style="width:85px;">
					<?php for($i = $start;$i<=$end;$i+=1800){ ?>  
                        <option value='<?php echo date('G:i', $i); ?>' <?php if($select1 == date('G:i', $i)){ echo 'selected="selected"';}?>><?php echo date('G:i', $i); ?></option>;
                    <?php } ?>
                </select>
                </div>
                <div style="float:left;">
                 <select class="form-control" name="select2" id="select2" style="width:85px;">
                 <option value="am" <?php if($select2=='am'){ echo 'selected="selected"';}?> >AM</option>
                 <option value="pm" <?php if($select2=='pm'){ echo 'selected="selected"';}?>>PM</option>
                 </select></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Reminder notes  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <textarea name="reminder_notes" id="reminder_notes" class="form-control"  title="Notes" ><?php echo $reminder_notes; ?></textarea>
                </div>
              </div>
              </div>
               <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
               <!-- <button type="reset" class="btn btn-default">Reset</button>-->
              </div>
              </div>
            </form>
            
          <!--  <div class="col-sm-6 col-md-6">-->
<?php 
if($last_insert_id ==""){ $last_insert_id='0';}
$call_reminders_arr=getResultArray("SELECT * FROM ".MTABLE."call_reminders WHERE phone_chart_ID = $select_id  AND reminder_ID != ".$last_insert_id." ORDER BY reminder_ID asc "); 
								if(!empty($call_reminders_arr)){?>
					<div class="block-flat">
						<div class="header">							
							<h3>Old Reminders</h3>
						</div>
						<div class="content">
							<table>
								<thead>
									<tr>
										<th style="width:50%;">Notes</th>
										<th>Date</th>
										<th class="text-right">Time</th>
                                        <th class="text-left">Delete</th>
									</tr>
								</thead>
								<tbody><div id="divReminder">
                                <?php
								
				 foreach($call_reminders_arr as $row){
								?>
									<tr>
										<td style="width:30%;"><?php echo $row['purpose'];?></td>
										<td><?php echo date('d-M-Y',$row['date']);?></td>
										<td class="text-right"><?php echo $row['time'];?></td>
                                        <td><a class="label label-danger" onclick="delete_reminder('../ajax/ajax_reminders.php','<?php echo $row['reminder_ID'];?>')"><i class="fa fa-times"></i></a></td>
									</tr>
									<?php
									}
								
									?></div>
								</tbody>
							</table>						
						</div>
					</div>
                    <?php
								}
								?>
         <!-- </div>-->
        </div>
      </div>
    </div>
    
    </div>
  </div>