<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Course Students MGT</a></li>
                 <li><a href="students.php">Course Students Listing</a></li>
				  <li class="active">Course Student Form</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="students.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
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
          <?php } if($lmod != '') { ?>
          <br />
          <div class="table-responsive">
                            <form name="eventform" method="post">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Sl No</th>
                                            <th>Module Name</th>
                                            <th>Module Code</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
<?php  
$count_no = 0;
if($no_of_rows) 
{
while($row = mysql_fetch_array($result1)) {
$count_no++;

list($mdl_code,$mdl_name) = $db->fetch_one_row("SELECT mdl_code,mdl_name FROM ".TABLE5." WHERE mdl_id='".$row['mdl_id']."'");

?>
                                    
										<tr class="gradeA <?php if($count_no%2!=0) { echo 'class="odd"'; } else { echo 'class="even"'; } ?>">
                                            <td><?php echo $count_no; ?></td>
                                            <td><?php echo $mdl_name; ?></td>
                                            <td><?php echo $mdl_code; ?></td>
											<td><a data-placement="top" data-toggle="tooltip" data-original-title="Delete" class="label label-danger" href="students.php?doaction=deletemodule&select_id=<?php echo $row['stmod_id'];?>&stdid=<?php echo $row['std_roll'];?>"><i class="fa fa-times"></i></a></td>
                                            	

										</tr>
<?php } } ?>										
									</tbody>
								</table>	
                                </form>						
							</div>
          <?php } else if($receip != '') { ?>
          <br />
          
          <?php if($openpymt == 1)
		  {
			  echo '<a href="payments.php?std_roll='.$select_id.'"><div class="btn-group"><button class="btn btn-sm btn-success" type="button"><i class="fa fa-plus-square"></i></button><button class="btn btn-sm btn-default" type="button">Make Payment</button></div></a> ';
		  }
		  ?>
          <div class="table-responsive">
                            <form name="eventform" method="post">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Sl No </th>
                                            <th>Invoice No</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Mode</th>
                                            <th>Cheque Details</th>
                                            <th>Narrations</th>
                                            <th>Actions</th>
										</tr>
									</thead>
									<tbody>
<?php  
$count_no = 0;
if($no_of_rows1) 
{
while($row = mysql_fetch_array($result221)) {
 $count_no++;
?>
                                    
										<tr class="gradeA <?php if($count_no%2!=0) { echo 'class="odd"'; } else { echo 'class="even"'; } ?>">
										<td><?php echo $count_no; ?></td>
                                            <td><?php echo $row['recptno']; ?></td>
                                            <td><?php echo date('d-m-Y',$row['recptdt']); ?></td>
                                            <td><?php echo $row['amount']; ?></td>
                                            <td><?php echo $modepyment_list[$row['mode']]; ?></td>
											<td><?php if($row['chqno'] != '') { ?>
                                            No: <?php echo $row['chqno']; ?>, Date: <?php echo date('d-m-Y',$row['chqdt']); ?><br />
                                            Bank Name: <?php echo $row['bank']; } ?></td>
                                            <td><?php echo $row['narration']; ?></td>
                                            <td><span class="statusdiv" id="statusdiv<?php echo $row['payment_id']; ?>">
											<?php if($row['cancel'] != '1'){ ?> 
                                            <a data-placement="top" data-toggle="tooltip" data-original-title="Published" onclick="getStatus('ajax/changestatus.php?pymts=1&id=<?php echo $row['payment_id']; ?>&cstatus=<?php echo $row['cancel']; ?>','statusdiv<?php echo $row['payment_id']; ?>')" class="label label-success"><i class="fa fa-check"></i></a>
											<?php } else { ?> 
                                            <a data-placement="top" data-toggle="tooltip" data-original-title="Cancelled" onclick="getStatus('ajax/changestatus.php?pymts=1&id=<?php echo $row['payment_id']; ?>&cstatus=<?php echo $row['cancel']; ?>','statusdiv<?php echo $row['payment_id']; ?>')" class="label label-danger"><i class="fa fa-ban"></i></a>
											<?php } ?></span></td>
                                            	

										</tr>
<?php } } 


if($no_of_rows2) 
{
while($row = mysql_fetch_array($result441)) {
 $count_no++;
?>
                                    
										<tr class="gradeA <?php if($count_no%2!=0) { echo 'class="odd"'; } else { echo 'class="even"'; } ?>">
										<td><?php echo $count_no; ?></td>
                                            <td><?php echo $row['recptno']; ?></td>
                                            <td><?php echo date('d-m-Y',$row['recptdt']); ?></td>
                                            <td><?php echo $row['amount']; ?></td>
                                            <td><?php echo $modepyment_list[$row['mode']]; ?></td>
											<td><?php if($row['chqno'] != '') { ?>
                                            No: <?php echo $row['chqno']; ?>, Date: <?php echo date('d-m-Y',$row['chqdt']); ?><br />
                                            Bank Name: <?php echo $row['bank']; } ?></td>
                                            <td><?php echo $row['narration']; ?></td>
                                            <td><span class="statusdiv" id="statusdiv<?php echo $row['newpaymt_id']; ?>">
											<?php if($row['cancel'] != '1'){ ?> 
                                            <a data-placement="top" data-toggle="tooltip" data-original-title="Published" onclick="getStatus('ajax/changestatus.php?newpymts=1&id=<?php echo $row['newpaymt_id']; ?>&cstatus=<?php echo $row['cancel']; ?>','statusdiv<?php echo $row['newpaymt_id']; ?>')" class="label label-success"><i class="fa fa-check"></i></a>
											<?php } else { ?> 
                                            <a data-placement="top" data-toggle="tooltip" data-original-title="Cancelled" onclick="getStatus('ajax/changestatus.php?newpymts=1&id=<?php echo $row['newpaymt_id']; ?>&cstatus=<?php echo $row['cancel']; ?>','statusdiv<?php echo $row['newpaymt_id']; ?>')" class="label label-danger"><i class="fa fa-ban"></i></a>
											<?php } ?></span> <a data-placement="top" data-toggle="tooltip" data-original-title="View" href="receipt_view.php?pymtid=<?php echo $row['newpaymt_id']; ?>" target="_blank" class="label label-warning"><i class="fa fa-eye"></i></a></td>
                                            	

										</tr>

<?php } } 
 ?>										
									</tbody>
								</table>	
                                </form>						
							</div>

		 <!-- <br /><h3><?php echo $TDHEADING2; ?></h3> 
          
          <div class="table-responsive">
                            <form name="eventform" method="post">
								<table class="table table-bordered">
									<thead>
										<tr>
                                            <th>Installment No</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Marking</th>
                                            <th>Due Over</th>
										</tr>
									</thead>
									<tbody>
                                    
<?php 
$cnts = 0;
for ($rw = 0; $rw < $std_duration; $rw ++) { 
$cnts++;


?>
<tr class="gradeA <?php if($cnts%2!=0) { echo 'class="odd"'; } else { echo 'class="even"'; } ?>">
                                            <td><?php echo $cnts; ?></td>
                                            <td><?php echo $row12['instalmentno']; ?></td>
                                            <td><?php echo date('d-m-Y',$row12['installmentdate']); ?></td>
                                            <td><?php echo $row12['instalmentamt']; ?></td>
                                            <td><?php echo $pymtype_list[$row12['ptype']]; ?></td>
											<td><?php echo $row12['marking']; ?></td>
                                            <td><?php echo $row12['dueover']; ?></td>
                                            	

										</tr>
<?php } ?>										
									</tbody>
								</table>	
                                </form>						
							</div>  -->                         
          
          <?php } else { ?>
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="students.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;" autocomplete="off">
             
             
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
             
             
             
             
             <div class="form-group">
                <label class="col-sm-3 control-label">Roll Number</label>
                <div class="col-sm-6"><?php echo $std_roll; ?></div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Name <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="std_name" id="std_name" required title="Name" value="<?php echo $std_name; ?>" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Name of Guardian <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="std_guard" id="std_guard" required title="Name of Guardian" value="<?php echo $std_guard; ?>" class="form-control">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Mailing Address <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="std_addr1" id="std_addr1" required title="Address 1" value="<?php echo $std_addr1; ?>" class="form-control">
                  <input type="text" name="std_addr2" id="std_addr2" title="Address 2" value="<?php echo $std_addr2; ?>" class="form-control">
                  <input type="text" name="std_addr3" id="std_addr3" title="Address 3" value="<?php echo $std_addr3; ?>" class="form-control">
                </div>
              </div>
              
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Pin</label>
                <div class="col-sm-6">
                  <input type="text" name="std_pin" id="std_pin" title="Pin" value="<?php echo $std_pin; ?>" class="form-control">
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Mobile No  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="std_mobile" required id="std_mobile" title="Mobile No" value="<?php echo $std_mobile; ?>" class="form-control">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Email  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="email" name="std_email" required id="std_email" title="Email" value="<?php echo $std_email; ?>" class="form-control">
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Office No</label>
                <div class="col-sm-6">
                  <input type="text" name="std_off" id="std_off" title="Office No" value="<?php echo $std_off; ?>" class="form-control">
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Home No</label>
                <div class="col-sm-6">
                  <input type="text" name="std_res" id="std_res" title="Page Title" value="<?php echo $std_res; ?>" class="form-control">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Course   <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                   <select name="crs_id" id="crs_id" required class="form-control" onchange="getStatus('ajax/loadmodules.php?crs_id='+this.value,'mymodules')">
                  <option value="">Select Course</option>
                     <?php 
    $query=mysql_query("select crs_id, crs_code, crs_name from ".TABLE4." where crs_status = 1");
				  while($row=mysql_fetch_array($query)){
				  ?>
				  <option value="<?php echo $row['crs_id'] ;?>" <?php echo (($row['crs_id']==$crs_id)?'selected="selected"':'') ?>>
				  <?php echo $row['crs_name']; // $row['crs_name'].' - '.$row['crs_code']; ?></option>
				     <?php } ?>
                  </select>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Modules</label>
                <div class="col-sm-6"><div id="mymodules"><?php if($add== 1) { echo '<span style="color:#F00; font-size:12px;">Select Above Course</span>'; }
				else
				{
					while($row = mysql_fetch_array($result13)) {
						
					list($mdl_code,$mdl_name) = $db->fetch_one_row("SELECT mdl_code,mdl_name FROM ".TABLE5." WHERE mdl_id='".$row['mdl_id']."'");	
						
						echo $mdl_name.' - '.$mdl_code.'<br>';
						
					}
				}
				?></div></div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Colleage Name</label>
                <div class="col-sm-6">
                  <input type="text" name="std_college" id="std_college" title="Colleage Name" value="<?php echo $std_college; ?>" class="form-control">
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Faculty Name</label>
                <div class="col-sm-6">
                  <input type="text" name="std_faculty" id="std_faculty" title="Faculty Name" value="<?php echo $std_faculty; ?>" class="form-control">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Starting Date <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <div class="input-group date form_date col-md-5 col-xs-7" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2">
                    <input class="form-control" size="25" required name="std_strdt" id="std_strdt" type="text" value="<?php if($std_strdt != '') { echo date('d-m-Y',$std_strdt); } ?>" />
                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Course Duration  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="std_duration" id="std_duration" required title="Course Duration" value="<?php echo $std_duration; ?>" class="form-control" style="width:70%; float:left;">&nbsp;&nbsp;<span style="color:#908f8f; font-size:12px;">Months</span>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Course Complition Date <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <div class="input-group date form_date col-md-5 col-xs-7" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2">
                    <input class="form-control" size="25" required name="std_cmpdt" id="std_cmpdt" type="text" value="<?php if($std_cmpdt != '') { echo date('d-m-Y',$std_cmpdt); } ?>" />
                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Total Fee</label>
                <div class="col-sm-6">
                  <input type="text" name="std_totfees" id="std_totfees" required title="Total Fee" value="<?php echo $std_totfees; ?>" class="form-control">
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Mode of Payment</label>
                <div class="col-sm-6">
                <?php foreach($modefees_list as $key=>$modefees_lists) { ?>   
                <input name="std_mthinst" <?php if($std_mthinst == '' && $key == 1) { echo 'checked="checked"'; } elseif($std_mthinst == $key) { echo 'checked="checked"'; }  ?> id="std_mthinst" value="<?php echo $key; ?>" type="radio">  <?php echo $modefees_lists; ?>
    			<?php } ?>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Fee Due Date</label>
                <div class="col-sm-6">
                  <?php foreach($fessdue_list as $key=>$fessdue_lists) { ?>   
                <input name="std_paymode" <?php if($std_paymode == '' && $key == 1) { echo 'checked="checked"'; } elseif($std_paymode == $key) { echo 'checked="checked"'; }  ?> id="std_paymode" value="<?php echo $key; ?>" type="radio">  <?php echo $fessdue_lists; ?>
    			<?php } ?>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Fee Collected</label>
                <div class="col-sm-6">
                  <input type="text" readonly="readonly" value="<?php echo $feecollected; ?>" class="form-control">
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Balance Amt Payabale</label>
                <div class="col-sm-6">
                   <input type="text" readonly="readonly" value="<?php echo $balance_payable; ?>" class="form-control">
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Dues Over</label>
                <div class="col-sm-6">
                   <input type="checkbox" name="std_due_over" id="std_due_over" <?php if($std_due_over == 1) { echo ' checked="checked"'; } ?> value="1">
                </div>
              </div>
              
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Remarks</label>
                <div class="col-sm-6">
                <textarea id="std_remark" name="std_remark" class="form-control"><?php echo $std_remark; ?></textarea>
                </div>
              </div>
              

               <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Save And Invoice</button>
                <button type="reset" class="btn btn-default">Reset</button>
              </div>
              </div>
            </form>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    
    </div>
  </div>