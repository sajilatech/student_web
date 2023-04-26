<?php
require('../application_top.php');

define('MODULEID','2');
define('MODULE_TITLE','Super Admin');
require(DIR_ADMIN_INCLUDE.'session.php');
define('TABLE',MTABLE.'users');
$session_id=$_SESSION['userid'];
#################### 
$user_type=$_SESSION['usertype'];
	if($user_type=='1'){
		$h='Super Admin';
	}
	else{
		$h='Moderator';
	}
switch($doaction)

{

	case 'update':

				    if((int)$select_id == 0) redirect();

						if($password != '******')							  
						 {
						$sql_data_array = array(
						'firstname' => $firstname,
						 'lastname' => $lastname,
						 'username'=>$username,
						 'password' => md5($password),
						 'email' => $email,
						 'mobile' => $mobile
						);
						  // print_r($sql_data_array);exit;
						$db->update_from_array($sql_data_array,TABLE,'user_ID', $select_id);
							
						 }
						 else
						 {
						$sql_data_array = array(
						'firstname' => $firstname,
						 'lastname' => $lastname,
						 'username'=>$username,
						 'password' => md5($password),
						 'email' => $email,
						 'mobile' => $mobile
							);  
							   //print_r($sql_data_array);exit;
						$db->update_from_array($sql_data_array,TABLE,'user_ID', $select_id);
						 }
				$originatingpage='admin.php?upd=1'; 
								echo '<script type="text/javascript"> 
								window.location = "'.$originatingpage.'"; 
								</script>'; 
								exit;
						//redirect('','upd=1');

					break;			

	

} // END SWITCH

if($add || $edit)

{
	
   $action = 'insert';

   $TDHEADING = 'Add '.$h;

   $active_array = array('1'=> 'Active','0' => 'Inactive');

   $active = 1;

	if($select_id)

	 {

		 $action = 'update';

		 $TDHEADING = 'Edit '.$h;

		 if(!isset($username))

		 {

			 list($id, $username, $email, $firstname, $lastname, $user_status, $mobile) = $db->fetch_one_row("SELECT user_ID, username, email,firstname, lastname,user_status, mobile FROM ".TABLE." WHERE user_ID='".$select_id."'");

		 }

	 }

		define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));

}
else if($previlages){ 
$sql = $db->query("SELECT user_ID, firstname, lastname, username, email, mobile, user_status FROM " .TABLE ." WHERE user_ID != $session_id ");
$count_result=$db->query("SELECT COUNT(*) AS total FROM " .TABLE ." WHERE user_ID != $session_id ");
$count_row = mysql_fetch_assoc($count_result);
$no_of_rows = $count_row['total'];
	 define('MAIN_TEMPLATE', DIR_LIST.basename($_SERVER['PHP_SELF']));
	}
else

{
	 $TDHEADING = $h.' Listing';
		$session_id=$_SESSION['userid'];
		if($upd) $alert = " Record Updated Successfully "; 

		$no_of_rows = $db->get_count(TABLE);

		if($no_of_rows > '0')
		{

					if(!$sort) $sort ='user_ID';
					$sql = $db->query("SELECT user_ID, firstname, lastname, username, email, mobile, user_status FROM " .TABLE ." WHERE user_ID= $session_id ORDER BY " . $sort);

		}

		else

		{

		         $alert2 = "No Records !!";

		}

		define('MAIN_TEMPLATE', DIR_LIST.basename($_SERVER['PHP_SELF']));

}

#######################
require(DIR_ADMIN_TPL.'main.php');  /* Iclude Tempate*/
exit; 
 ?>