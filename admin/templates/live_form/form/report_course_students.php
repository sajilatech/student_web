<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Report MGT</a></li>
				  <li class="active">Student Detail View</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3>
          </div>
          <div class="content">
             
          <form class="form-horizontal group-border-dashed">

             <div class="form-group">
                <label class="col-sm-3 control-label">Roll Number</label>
                <div class="col-sm-6"><?php echo $std_roll; ?></div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Name</label>
                <div class="col-sm-6"><?php echo $std_name; ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Name of Guardian</label>
                <div class="col-sm-6"><?php echo $std_guard; ?>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Mailing Address</label>
                <div class="col-sm-6"><?php echo $std_addr1.'<br>';  echo $std_addr2.'<br>'; echo $std_addr3.'<br>';?>
                </div>
              </div>
              
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Pin</label>
                <div class="col-sm-6"><?php echo $std_pin; ?>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Mobile No</label>
                <div class="col-sm-6"><?php echo $std_mobile; ?>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-6"><?php echo $std_email; ?>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Office No</label>
                <div class="col-sm-6"><?php echo $std_off; ?>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Home No</label>
                <div class="col-sm-6"><?php echo $std_res; ?>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Course</label>
                <div class="col-sm-6">
				<?php 
   				  $query=mysql_query("select crs_id, crs_code, crs_name from ".TABLE4." where crs_id = ".$crs_id);
				  $row=mysql_fetch_array($query);
				  echo $row['crs_name']
				  ?>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Colleage Name</label>
                <div class="col-sm-6"><?php echo $std_college; ?>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Faculty Name</label>
                <div class="col-sm-6"><?php echo $std_faculty; ?>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Starting Date</label>
                <div class="col-sm-6"><?php if($std_strdt != '') { echo date('d-m-Y',$std_strdt); } ?>
                  </div>
                </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Course Duration </label>
                <div class="col-sm-6"><?php echo $std_duration; ?>&nbsp;&nbsp;<span style="color:#908f8f; font-size:12px;">Months</span>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Course Complition Date</label>
                <div class="col-sm-6"><?php if($std_cmpdt != '') { echo date('d-m-Y',$std_cmpdt); } ?>
                  </div>
                </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Total Fee</label>
                <div class="col-sm-6"><?php echo $std_totfees; ?>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Mode of Payment</label>
                <div class="col-sm-6"><?php echo $modefees_list[$std_mthinst]; ?>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Fee Due Date</label>
                <div class="col-sm-6"><?php echo $fessdue_list[$std_paymode]; ?>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Fee Collected</label>
                <div class="col-sm-6"><?php echo $feecollected; ?>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Balance Amt Payabale</label>
                <div class="col-sm-6"><?php echo $balance_payable; ?>
                </div>
              </div>
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Dues Over</label>
                <div class="col-sm-6"><?php if($std_due_over == 1) { echo ' Yes'; } else { echo ' No'; }  ?>
                </div>
              </div>
              
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Remarks</label>
                <div class="col-sm-6"><?php echo $std_remark; ?>
                </div>
              </div>
            </form>
            
          <br /><h3><?php echo $TDHEADING2; ?></h3>             
          <div class="table-responsive">
                            <form name="eventform" method="post">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Sl No</th>
                                            <th>Module Name</th>
                                            <th>Module Code</th>
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
										</tr>
<?php } } else { echo '<tr class="gradeA odd"><td colspan="4">No Modules Allocated</td></tr>'; }  ?>										
									</tbody>
								</table>	
                                </form>						
							</div>
                            
          <br /><h3><?php echo $TDHEADING3; ?></h3> 
          <div class="table-responsive" id="recpt">
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
                                            <th>Status</th>
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
                                            <td><?php if($row['cancel'] != '1'){ echo 'Not Cancelled'; } else { echo 'Cancelled'; } ?></td>
                                            	

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

		 <!-- <br /><h3><?php echo $TDHEADING4; ?></h3> 
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
          </div>
        </div>
      </div>
    </div>
    
    </div>
  </div>