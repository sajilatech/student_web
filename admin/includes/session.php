<?php
if(isset($_SESSION['userid']))
{
	define('USERID',$_SESSION['userid']);
}
else
{
	redirect(ADMIN_URL.'index.php','denied=1');
}
?>