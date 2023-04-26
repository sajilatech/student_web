<?php
$user_type=$_SESSION['usertype'];
if($user_type=='1'){
	$h='Super Admin';
}
else{
	$h='Moderator';
	}
	
?>
<script type = "text/javascript" language = "javascript">
function set_status(by_id,path,status){ alert(status)
	if(status=='1'){
		var msg_status= "Disable";
	}
	else{
		var msg_status= "Enable";
		}
	
		var ans=confirm("Do you want to "+msg_status+" this item?");
		if(ans==true){
			 $.ajax({
									type:'POST',
									url:path,
									data:{'by_id':by_id,'status' : status },
									success: function(option_tags) {
										
										$('#divPrevilages').html(option_tags);
										// location.reload();
									}
							});
		}
		else{
			return false;	
		}
		
	
	
	}
</script>
<div class="container-fluid" id="pcont">
			<div class="page-head">
				<ol class="breadcrumb" id="showlinks">
				 <li><a href="home.php">Home</a></li>
				  <li class="active"><?php echo $h;?></li>
				</ol>
			</div>		
		<div class="cl-mcont">
		
			<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3><?php echo $TDHEADING; ?></h3>
                            <?php if($alert2 != '') { ?>
                             <div class="alert alert-warning alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-warning"></i></div>
								<strong>Alert!</strong> <?php echo $alert2; ?>
							 </div>
							 </div>
                            <?php } ?>
                            <?php if($alert != '') { ?>
                             <div class="alert alert-success alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-check"></i></div>
								<strong>Success!</strong> <?php echo $alert; ?>
							 </div>
                            <?php } ?>
						</div>
						<div class="content">
							<div class="table-responsive">
								<table class="table table-bordered" id="datatable" >
									<thead>
										<tr>
											<th>Name</th>
											<th>Email</th>
                                            <th>Mobile</th>
                                            <?php if(isset($previlages)){ ?>
                                            <th>Set Previlages of Other Users</th>
                                            <?php }
											?>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                       <?php  
$count_no = 0;
if($no_of_rows) 
{
	while($row = $db->fetch_assoc($sql)) 
	{
	 $count_no++;
  ?>
                                    
										<tr class="gradeA <?php if($count_no%2!=0) { echo 'class="odd"'; } else { echo 'class="even"'; } ?>">
											<td><?php echo $row['firstname'].','. $row['lastname']; ?></td>
											<td id="showlinks"><?php echo $html->email($row['email']); ?></td>
                                            <td><?php echo $row['mobile']; ?></td>
                                              <?php if(isset($previlages)){?> <td><div id="divPrevilages"><a class="btn btn-primary wizard-next" onclick="set_status('<?php echo $row['user_ID'];?>','../ajax/set_previlages.php','<?php echo $row['user_status']; ?>')"><?php if($row['user_status']=='1'){ ?>Inactive Status<?php } else{?>Active Status<?php }?></a></div></td> <?php }
											?>
											<td><a data-placement="top" data-toggle="tooltip" data-original-title="Edit" class="label label-primary" href="admin.php?edit=1&select_id=<?php echo $row['user_ID'];?>"><i class="fa fa-pencil"></i></a></td>
										</tr>
<?php } } ?>										
									</tbody>
								</table>							
							</div>
						</div>
					</div>				
				</div>
			</div>
			
		  </div>
		</div>