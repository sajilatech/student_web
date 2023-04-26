<?php require('../application_top.php');
require('../includes/mail.php');
define('TABLE',MTABLE.'special_days');

$mailClass= new Mail();
 $special_days_row = getRowByID(TABLE,'special_day_ID',$select_id,"");
if($special_days_row['category']=='1'){
	$cat_subject="Happy Celebrations";
?>
<?php
}
else if ($special_days_row['category']=='2'){
	$cat_subject="Happy Wedding Anniversary";
	?>


<?php
}
else if ($special_days_row['category']=='3'){
	
	$cat_subject="Happy Birthday";?>

<?php
}

$mailto="sajilaanil@gmail.com";
$cc='';
$bcc='';

$thesubject=$cat_subject;
		$mailfrom=''; 
		$headers  = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$mailbody= '<table width="100%" border="0" align="center" cellpadding="10" cellspacing="2">'; 
		$mailbody.='<tr><td colspan="2"><strong><font size="+1"><u>'.$thesubject.'</u></font></strong></td></tr>'; 
		$mailClass->sendMail($mailto,$email,$thesubject,$mailbody,$cc,$bcc);
		//$mailClass->sendMail($email,$mailto,"Admin reply :".$thesubject,$replymessage,$cc,$bcc);
		$originatingpage='special_days.php?msg=Successfully sent to admin'; 
		echo '<script type="text/javascript"> 
		window.location = "'.$originatingpage.'"; 
		</script>'; 
		exit; 
?>