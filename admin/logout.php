<?php
require('../application_top.php');

if($_SESSION['userid'] != 0) {

//$db->query("UPDATE ".MTABLE."staff_log set staff_logout =".time()." WHERE staff_logid=".$_SESSION['admin']['adminid']);
}

session_destroy();

redirect('index.php');

exit; 
 ?>