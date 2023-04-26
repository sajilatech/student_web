<?php
require('../application_top.php');
define('MODULEID','8');
define('MODULE_TITLE','Module');
require(DIR_ADMIN_INCLUDE.'session.php');
define('TABLE',MTABLE.'module');

$GrpPage = 2;

#################### 
# Actions

switch($doaction)
{
	case 'insert':
				    $dups = $db->get_count(TABLE,"mdl_code='".$mdl_code."'");
					if($dups)
					{
						 $alert = "This Module Code already exists.";
						 $add=1;
					}
					else
					{
						 $sql_data_array = array('mdl_code' => addslashes($mdl_code),
						 'mdl_name' => addslashes($mdl_name),
						 'mdl_status' => 1,
						 'brnch_id' => $_SESSION['staff']['brnch_id'], 
						 'staff_id' => $_SESSION['staff']['staff_id'],
						 'mdl_added_date' => time());
					
						 $db->insert_from_array($sql_data_array,TABLE);	
						 $insert_id = $db->insert_id();	
						 
						 redirect('','ins=1&sort=mdl_id desc ');

					}
				   break;

	case 'update': 
				    if((int)$select_id == 0) redirect();
					
						 $sql_data_array = array('mdl_code' => addslashes($mdl_code),
						 'mdl_name' => addslashes($mdl_name),
						 'mdl_status' => 1,
						 'brnch_id' => $_SESSION['staff']['brnch_id'], 
						 'staff_id' => $_SESSION['staff']['staff_id'],
						 'mdl_updated_date' => time());
					 
					  $db->update_from_array($sql_data_array,TABLE,'mdl_id', $select_id);
					  redirect('','upd=1&sort=mdl_id desc ');
						
					break;
				
	case 'delete':
						  
							$db->query("delete from ".TABLE." where mdl_id='".$select_id."'");
							redirect('','del=1&sort=mdl_id desc ');
						
							break;
			
			
case 'deleterecord' :	
	                   $count=count($list);

			           if($count > 0)
			            {
		
				           for($i=0;$i<$count;$i++)
				          {	
					       $db->query("delete from ".TABLE." where mdl_id='".$list[$i]."'");
				          }
						   
				        redirect('','dels=1&sort=mdl_id desc ');
			             }
			        break;
					
case 'publish' :
	                   $count=count($list);

			           if($count > 0)
			            {
		
				           for($i=0;$i<$count;$i++)
				          {
						 $db->query("UPDATE ".TABLE." SET mdl_status = 1, mdl_updated_date ='".time()."' WHERE mdl_id =".$list[$i]."");		  
				          }
						   
				        redirect('','upd=1&sort=mdl_id desc ');
			             }
			        break;
					
case 'unpublish' :	
	                   $count=count($list);

			           if($count > 0)
			            {
		
				           for($i=0;$i<$count;$i++)
				          {
					        $db->query("UPDATE ".TABLE." SET mdl_status = 2, mdl_updated_date ='".time()."' WHERE mdl_id =".$list[$i]."");	
				          }
						   
				        redirect('','upd=1&sort=mdl_id desc ');
			             }
			        break;		
	
} // END SWITCH

		if($ins) $alert = " Module Added successfully ";
		if($upd) $alert = " Module Updated successfully ";
		if($del) $alert = " Record deleted successfully ";
        if($dels) $alert = " Records deleted successfully ";
		

if($add || $edit)
{
   $action = 'insert';
   $TDHEADING = 'Add Module';

	if($select_id)
	{
		 $action = 'update';
		 $TDHEADING = 'Edit Module';			 
		 
		  list($mdl_id, $mdl_code, $mdl_name, $mdl_status) = $db->fetch_one_row("SELECT mdl_id, mdl_code, mdl_name, mdl_status FROM ".TABLE." WHERE mdl_id='".$select_id."'");
		 
		 
	}
	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));
}
else
{
	$TDHEADING = 'Modules Listing';
	
		  if($search_txt != '' || $search_status != '')
		  {
			
			 if($search_txt != '')
		{ 
 		   	   $condition= " CONCAT(mdl_name, mdl_code) like lower('%".$search_txt."%')";
 		}
		
		if($search_status != '')
		{
			if($condition != '' )
 		   	  $condition.= " AND mdl_status=".$search_status;
			else  
 		   	   $condition= " mdl_status=".$search_status;
 		}
 		
 		if(isset($_SESSION['staff']))
		{
		if($condition != '' )
 		   	  $condition.= " AND brnch_id=".$_SESSION['staff']['brnch_id'];
			else  
 		   	   $condition= " brnch_id=".$_SESSION['staff']['brnch_id'];
		}

					
			$sql_res = $db->query("SELECT * FROM ".TABLE." WHERE ".$condition);
			$no_of_rows = mysql_num_rows($sql_res);
			
			
			
			if($no_of_rows > '0') 
			{
					if(!$sort) $sort ='mdl_id desc'; 
		 
			 $query = "SELECT * FROM ".TABLE." WHERE ".$condition." ORDER BY ".$sort;
			 $result1 = mysql_query($query) or die(mysql_error());
			 $no_of_rows = mysql_num_rows($result1);				 
			}
			else
			{
					$alert2 = "No Records !!";
			}
		}
		
		
		else
		{ 
		
			$no_of_rows = $db->get_count(TABLE);
			if($no_of_rows > '0')
			{
				if(!$sort) $sort ='mdl_id DESC' ;
				
				if(isset($_SESSION['staff']))
 		   	   	$condition= " WHERE brnch_id=".$_SESSION['staff']['brnch_id'];
				
				
		$query = "SELECT * FROM ".TABLE." ".$condition." ORDER BY ".$sort;
		$result1 = mysql_query($query) or die(mysql_error());
		$no_of_rows = mysql_num_rows($result1);		 
			}
		
			else
			{
					 $alert2 = "No Records !!";
			}
		}
			
		define('MAIN_TEMPLATE', DIR_LIST.basename($_SERVER['PHP_SELF']));
}
#######################
require(DIR_ADMIN_TPL.'main.php');  /* Iclude Tempate*/
exit; 
 ?>