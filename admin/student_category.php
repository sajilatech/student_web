<?php

require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Student Category');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'student_category_list');



$GrpPage = 1;



#################### 

# Actions



switch($doaction)

{

	case 'insert':

				    $dups = $db->get_count(TABLE,"category_name='".$category_name."'");

					if($dups)

					{

						 $alert = "This Name already exists.";

						 $add=1;

					}

					else

					{

						 $sql_data_array = array(
						 'category_name' => $category_name,
						 'status' => $status);

					

						 $db->insert_from_array($sql_data_array,TABLE);	

						 $insert_id = $db->insert_id();	

						
 				redirect('student_category.php','');



						

					}

				   break;



	case 'update': 

				    if((int)$select_id == 0) redirect();

					

						 $sql_data_array = array(
						 'category_name' => $category_name,
						 'status' => $status);

					 

					  $db->update_from_array($sql_data_array,TABLE,'student_category_ID', $select_id);

					  

						 redirect('','upd=1&sort=student_category_ID desc ');

						

					break;

				

	case 'delete':

							$db->query("delete from ".TABLE." where student_category_ID='".$select_id."'");

							redirect('','del=1&sort=student_category_ID desc ');						

							break;

			

			

case 'deleterecord' :	

	                   $count=count($list);



			           if($count > 0)

			            {

				           for($i=0;$i<$count;$i++)

				          {	

					       $db->query("delete from ".TABLE." where student_category_ID='".$list[$i]."'");

				          }

						   

				        redirect('','dels=1&sort=student_category_ID desc ');

			             }

			        break;

					

case 'publish' :

	                   $count=count($list);



			           if($count > 0)

			            {

		

				           for($i=0;$i<$count;$i++)

				          {

						 $db->query("UPDATE ".TABLE." SET status = 1 WHERE status =".$list[$i]."");		  

				          }

						   

				        redirect('','upd=1&sort=student_category_ID desc ');

			             }

			        break;

					

case 'unpublish' :	

	                   $count=count($list);



			           if($count > 0)

			            {

		

				           for($i=0;$i<$count;$i++)

				          {

					        $db->query("UPDATE ".TABLE." SET status = 2 WHERE student_category_ID =".$list[$i]."");	

				          }

						   

				        redirect('','upd=1&sort=student_category_ID desc ');

			             }

			        break;			

	

} // END SWITCH



		if($ins) $alert = " Student Category Added successfully ";

		if($upd) $alert = " Student Category Updated successfully ";

		if($del) $alert = " Record deleted successfully ";

        if($dels) $alert = " Records deleted successfully ";

		



if($add || $edit)

{

   $action = 'insert';

   $TDHEADING = 'Add Student Category';



	if($select_id)

	{

		 $action = 'update';

		 $TDHEADING = 'Edit Student Category';			 


		  list($student_category_id, $category_name) = $db->fetch_one_row("SELECT student_category_ID, category_name FROM ".TABLE." WHERE student_category_ID='".$select_id."'");

		 

		 

	}

	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));

}

else

{

	$TDHEADING = 'Student Category Listing';

	

		  if($search_txt != '' || $search_status != '')

		  {

			

					 if($search_txt != '')
		
					{ 
		
					   $condition= " CONCAT(category_name) like lower('%".$search_txt."%')";
		
					}
		
				
		
				/*if($search_status != '')
		
				{
		
					if($condition != '' )
		
					  $condition.= " AND brnch_status=".$search_status;
		
					else  
		
					   $condition= " brnch_status=".$search_status;
		
				}*/
				
				
					$sql_res = $db->query("SELECT * FROM ".TABLE." WHERE ".$condition);
		
					$no_of_rows = mysql_num_rows($sql_res);
		
				if($no_of_rows > '0') 
				
				{
				
						if(!$sort) $sort ='student_category_ID desc'; 
				
				
				
					 $query = "SELECT * FROM ".TABLE." WHERE ".$condition." ORDER BY ".$sort;
				
					$result1 = mysql_query($query) or die(mysql_error());
				
				 $no_of_rows = mysql_num_rows($result1);				 
				
				}
				
				else
				
				{
				
						$alert2 = "No Records !!";
				
				}
		
	}// end search close

		else

		{ 

		

			$no_of_rows = $db->get_count(TABLE);

			if($no_of_rows > '0')

			{

				if(!$sort) $sort ='student_category_ID DESC' ;
				
				

		$query = "SELECT * FROM ".TABLE."  ORDER BY ".$sort;

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