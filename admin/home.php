<?php	
$curPage = 1;
require('../application_top.php');
define('MODULEID','ALL');
define('MODULE_TITLE','Home');
require(DIR_ADMIN_INCLUDE.'session.php');
define('MAIN_TEMPLATE', DIR_ADMIN_TPL.basename($_SERVER['PHP_SELF']));
require(DIR_ADMIN_TPL.'main.php');  /* Include Tempate*/
exit;?>
