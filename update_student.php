<?php
require('application_top.php');


/*$result1 = mysql_query("select * from lcc_studentsp") or die(mysql_error());
while($row = mysql_fetch_array($result1)) {
	
$result2 = mysql_query("select * from lcc_course WHERE crs_code = '".$row['std_course']."'") or die(mysql_error());
$row2 = mysql_fetch_array($result2);	
	
	$dt1 = ''; $dt2 = '';
	
	if($row['std_strdt'] != '') {
		
		$dt1 = str_replace('00:00:00','',$row['std_strdt']);
		$dt1 = strtotime($dt1 . " +1 days"); }
		 
	if($row['std_cmpdt'] != '') { 
	
	$dt2 = str_replace('00:00:00','',$row['std_cmpdt']);
	$dt2 = strtotime($dt2 . " +1 days");

	
	}
	echo "UPDATE lcc_studentsp set crs_id = ".$row2['crs_id'].", std_strdt2=".$dt1.", std_cmpdt2 =".$dt2." WHERE std_roll = ".$row['std_roll'].""; exit();

$db->query("UPDATE lcc_studentsp set crs_id = ".$row2['crs_id'].", std_strdt2=".$dt1.", std_cmpdt2 =".$dt2." WHERE std_roll = ".$row['std_roll']."");


	
	
}*/



$result1 = mysql_query("select * from lcc_students_module") or die(mysql_error());
while($row = mysql_fetch_array($result1)) {
	
$result3 = mysql_query("select * from lcc_module WHERE mdl_code = '".$row['mdl_mdlcd']."'") or die(mysql_error());
$row3 = mysql_fetch_array($result3);	

$db->query("UPDATE lcc_students_module set mdl_id = ".$row3['mdl_id'].", std_roll=".$row['mdl_roll'].", stmod_status = 1 WHERE stmod_id = ".$row['stmod_id']."");
}

/*$result1 = mysql_query("select * from lcc_paymentp") or die(mysql_error());
while($row = mysql_fetch_array($result1)) {
	
	
	$dt1 = ''; $dt2 = '';
	
	if($row['recptdt'] != '') {
		
		$dt1 = str_replace('00:00:00','',$row['recptdt']);
		$dt1 = strtotime($dt1 . " +1 days"); }
		 
	if($row['chqdt'] != '') { 
	
	$dt2 = str_replace('00:00:00','',$row['chqdt']);
	$dt2 = strtotime($dt2 . " +1 days");

	
	}
	

$db->query("UPDATE lcc_paymentp set recptdt2='".$dt1."', chqdt2 ='".$dt2."' WHERE payment_id = ".$row['payment_id']."");	
}*/

/*$result1 = mysql_query("select * from lcc_paymentschedule") or die(mysql_error());
while($row = mysql_fetch_array($result1)) {
	
	
	$dt1 = ''; 
	
	if($row['installmentdate'] != '') {
		
		$dt1 = str_replace('00:00:00','',$row['installmentdate']);
		$dt1 = strtotime($dt1 . " +1 days"); }
		 
	

$db->query("UPDATE lcc_paymentschedule set installmentdate2='".$dt1."' WHERE psche_id = ".$row['psche_id']."");	
}
*/

?>