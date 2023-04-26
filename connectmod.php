<?php
require('application_top.php');

/*$result1 = mysql_query("select * from lcc_crsmdl") or die(mysql_error());
while($row = mysql_fetch_array($result1)) {
	
$result2 = mysql_query("select * from lcc_course WHERE crs_code = '".$row['crscode']."'") or die(mysql_error());
$row2 = mysql_fetch_array($result2);	

$result3 = mysql_query("select * from lcc_module WHERE mdl_code = '".$row['mdlcode']."'") or die(mysql_error());
$row3 = mysql_fetch_array($result3);

$db->query("UPDATE lcc_crsmdl set crs_id =".$row2['crs_id'].", mdl_id=".$row3['mdl_id']." WHERE crsmdl_id = ".$row['crsmdl_id']."");
	
	
	
}*/

$result1 = mysql_query("select * from lcc_feestructure") or die(mysql_error());
while($row = mysql_fetch_array($result1)) {	
	
	$dt1 = ''; $dt2 = '';
	
	if($row['int_fstructurepaydate'] != '') {
		
		$dt1 = str_replace('00:00:00','',$row['int_fstructurepaydate']);
		$dt1 = strtotime($dt1 . " +1 days"); }
		 
	if($row['int_fstructureccdate'] != '') { 
	
	$dt2 = str_replace('00:00:00','',$row['int_fstructureccdate']);
	$dt2 = strtotime($dt2 . " +1 days");

	
	}

$db->query("UPDATE lcc_feestructure set int_fstructurepaydate2 =".$dt1.", int_fstructureccdate2 =".$dt2." WHERE feestruct_id = ".$row['feestruct_id']."");


	
	
}


?>