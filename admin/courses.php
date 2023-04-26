<?php
require('../application_top.php');
define('MODULEID','7');
define('MODULE_TITLE','Courses');
require(DIR_ADMIN_INCLUDE.'session.php');
define('TABLE',MTABLE.'courses');

$GrpPage = 1;

#################### 
# Actions

switch($doaction)
{
	case 'insert':
				    /*$dups = $db->get_count(TABLE,"crs_code='".$crs_code."'");
					if($dups)
					{
						 $alert = "This Course Code already exists.";
						 $add=1;
					}
					else
					{*/
						 $sql_data_array = array(
						 'course_name' => addslashes($course_name),
						 'course_status' => 1,
						 'added_date' => time());
					
						 $db->insert_from_array($sql_data_array,TABLE);	
						 $insert_id = $db->insert_id();	
						 
						 redirect('','ins=1&sort=course_ID desc ');

					//}
				   break;

	case 'update': 
				    if((int)$select_id == 0) redirect();
					 $sql_data_array = array(
						 'course_name' => addslashes($course_name),
						 'course_status' => 1,
						 'updated_date' => time());
					 
					  $db->update_from_array($sql_data_array,TABLE,'course_ID', $select_id);
					  redirect('','upd=1&sort=course_ID desc ');
						
					break;
				
	case 'delete':
						  
							$db->query("delete from ".TABLE." where course_ID='".$select_id."'");
							redirect('','del=1&sort=course_ID desc ');
						
							break;
			
			
case 'deleterecord' :	
	                   $count=count($list);

			           if($count > 0)
			            {
		
				           for($i=0;$i<$count;$i++)
				          {	
					       $db->query("delete from ".TABLE." where course_ID='".$list[$i]."'");
				          }
						   
				        redirect('','dels=1&sort=course_ID desc ');
			             }
			        break;
					
case 'publish' :
	                   $count=count($list);

			           if($count > 0)
			            {
		
				           for($i=0;$i<$count;$i++)
				          {
						 $db->query("UPDATE ".TABLE." SET course_status = 1, course_updated_date ='".time()."' WHERE course_ID =".$list[$i]."");		  
				          }
						   
				        redirect('','upd=1&sort=course_ID desc ');
			             }
			        break;
					
case 'unpublish' :	
	                   $count=count($list);

			           if($count > 0)
			            {
		
				           for($i=0;$i<$count;$i++)
				          {
					        $db->query("UPDATE ".TABLE." SET course_status = 2, course_updated_date ='".time()."' WHERE course_ID =".$list[$i]."");	
				          }
						   
				        redirect('','upd=1&sort=course_ID desc ');
			             }
			        break;		
	
} // END SWITCH

		if($ins) $alert = " Course Added successfully ";
		if($upd) $alert = " Course Updated successfully ";
		if($del) $alert = " Record deleted successfully ";
        if($dels) $alert = " Records deleted successfully ";
		

if($add || $edit)
{
   $action = 'insert';
   $TDHEADING = 'Add Course';
	if($select_id)
	{
		 $action = 'update';
		 $TDHEADING = 'Edit Course';			 
		 
		  list($course_ID, $course_name, $course_status) = $db->fetch_one_row("SELECT course_ID, course_name, course_status FROM ".TABLE." WHERE course_ID='".$select_id."'");
		 
		 
	}
	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));
}
else
{
	$TDHEADING = 'Courses Listing';
	
		  if($search_txt != '' || $search_status != '')
		  {
			
			 if($search_txt != '')
		{ 
 		   	   $condition= " CONCAT(course_name) like lower('%".$search_txt."%')";
 		}
		
		/*if($search_status != '')
		{
			if($condition != '' )
 		   	  $condition.= " AND course_status=".$search_status;
			else  
 		   	   $condition= " crs_status=".$search_status;
 		}*/
 		
 		/*if(isset($_SESSION['staff']))
		{
		if($condition != '' )
 		   	  $condition.= " AND brnch_id=".$_SESSION['staff']['brnch_id'];
			else  
 		   	   $condition= " brnch_id=".$_SESSION['staff']['brnch_id'];
		}*/

					
			$sql_res = $db->query("SELECT * FROM ".TABLE." WHERE ".$condition);
			$no_of_rows = mysql_num_rows($sql_res);
			
			
			
			if($no_of_rows > '0') 
			{
					if(!$sort) $sort ='course_ID desc'; 
		 
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
				if(!$sort) $sort ='course_ID DESC' ;
				
			
				
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