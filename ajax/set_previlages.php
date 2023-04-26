<?php require('../application_top.php');
 define('TABLE',MTABLE.'users');
$by_id=$_POST['by_id'];
$status=$_POST['status'];

if($status=='1'){
	$update_status='0';
}
else{
	$update_status='1';
	}
	$sql_data_array = array('user_status'=> $update_status); 
	$db->update_from_array($sql_data_array, TABLE,'user_ID', $by_id);
?>
<a class="btn btn-primary wizard-next" onclick="set_status('<?php echo $by_id;?>','../ajax/set_previlages.php','<?php echo $update_status; ?>')"><?php if($update_status['user_ID']=='1'){ ?>Inactive Status<?php } else{?>Active Status<?php }?></a>