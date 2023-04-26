<?php $reminder_id=$_POST['by_id'];
 require('../application_top.php');
define('REMINDERTABLE',MTABLE.'call_reminders');
deleteQuery(REMINDERTABLE,"reminder_ID= ".$reminder_id);
?>