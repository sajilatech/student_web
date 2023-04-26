<?php
require('../application_top.php');

define('MODULEID','9');
define('MODULE_TITLE','Courses - Modules');
require(DIR_ADMIN_INCLUDE.'session.php');
define('TABLE',MTABLE.'crsmdl');
define('TABLE2',MTABLE.'course');
define('TABLE3',MTABLE.'module');

$GrpPage = 2;

#################### 

switch($doaction)
{
	case 'insert':
				    $dups = $db->get_count(TABLE,"crs_id='".$crs_id."' AND mdl_id='".$mdl_id."'");
					if($dups)
					{
						 $alert = "This Module Already alloted to Course";
						 $add=1;
					}
					else
					{
						 $sql_data_array = array('crs_id' => $crs_id, 
						 'brnch_id' => $_SESSION['staff']['brnch_id'], 
						 'staff_id' => $_SESSION['staff']['staff_id'],
						 'mdl_id' => $mdl_id);
						 
										
						 $db->insert_from_array($sql_data_array,TABLE);	
						 $insert_id = $db->insert_id();	
						 
						 redirect('','ins=1&sort=crsmdl_id desc ');
					}
				   break;

	case 'delete':
	
						$db->query("delete from ".TABLE." where crsmdl_id='".$select_id."'");
						redirect('','del=1&sort=crsmdl_id desc ');
						
				    break;
					
	case 'deleterecord' :

						
	                   $count=count($list);

			           if($count > 0)
			            {
		
				           for($i=0;$i<$count;$i++)
				          {
					 		
					       $db->query("delete from ".TABLE." where crsmdl_id='".$list[$i]."'");
				          }
				          redirect('','dels=1&sort=crsmdl_id desc ');
			             }
			        break;
					
 
} // END SWITCH

	if($ins) $alert = "Course - Modules added successfully";
	if($del) $alert = "Record deleted successfully";
	if($dels) $alert = "Records deleted successfully";

if($add )
{
   $action = 'insert';
   $TDHEADING = 'Add Course - Modules';
	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));
}
else
{
	$TDHEADING = 'Course - Modules Listing';	
			
		  if($crs_id != '' || $mdl_id != '')
		  {
		  	if($crs_id != '')
		   	 $condition = " crs_id =".$crs_id;
		
		if($mdl_id!= '')
				{
					if($condition!='')
					$condition.=" AND mdl_id =".$mdl_id;
					else
					$condition = " mdl_id =".$mdl_id;
					}	
					
		if(isset($_SESSION['staff']))
		{
		if($condition != '' )
 		   	  $condition.= " AND brnch_id=".$_SESSION['staff']['brnch_id'];
			else  
 		   	   $condition= " brnch_id=".$_SESSION['staff']['brnch_id'];
		}			
		
			$sql_res = $db->query("SELECT * FROM ".TABLE." WHERE".$condition);
			$no_of_rows = mysql_num_rows($sql_res);
			
			if($no_of_rows > '0') 
			{
				if(!$sort) $sort ='crsmdl_id desc'; 
				$query = "SELECT * FROM ".TABLE." WHERE".$condition." ORDER BY ".$sort;
				$result1 = mysql_query($query) or die(mysql_error());
				$no_of_rows = mysql_num_rows($result1);
			}
			else
			{
					$alert2 = "No Search Result !";
			}
		}
		else
		{ 
		
			$no_of_rows = $db->get_count(TABLE);
			
			if($no_of_rows > '0')
			{
				if(!$sort) $sort ='crsmdl_id desc ' ;
				
				if(isset($_SESSION['staff']))
 		   	   	$condition= " WHERE brnch_id=".$_SESSION['staff']['brnch_id'];
				
				$query = "SELECT * FROM ".TABLE." ".$condition." ORDER BY ".$sort;
				$result1 = mysql_query($query) or die(mysql_error());
				$no_of_rows = mysql_num_rows($result1);				 
				
				}
		
			else
			{
					 $alert2 = "No Records !";
			}
		}
			
		define('MAIN_TEMPLATE', DIR_LIST.basename($_SERVER['PHP_SELF']));
}
#######################
require(DIR_ADMIN_TPL.'main.php');  /* Iclude Tempate*/
exit; 
 ?>