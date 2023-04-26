<?php
 require('../application_top.php');
 define('TABLE',MTABLE.'student_certificates');
 
$by_id=$_POST['by_id'];
  list($file_name)=$db->fetch_one_row("SELECT file_name FROM ".TABLE." WHERE certificate_ID='".$by_id."'"); 
  
$my_file = UPLOADS.'/certificates/'.$file_name;
deleteQuery(TABLE,"certificate_ID= ".$by_id);
		if(is_file($my_file))
		{
			//print_r($my_file);
			unlink($my_file);
			$condi = " certificate_ID= ".$by_id;
			deleteQuery(TABLE, $condi);
		} 