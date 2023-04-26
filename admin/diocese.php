<?php

require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Diocese');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'diocese');



$GrpPage = 1;



#################### 

# Actions



switch($doaction)

{

	case 'insert':

				    $dups = $db->get_count(TABLE,"diocese_name='".$diocese_name."'");

					if($dups)

					{

						 $alert = "This Name already exists.";

						 $add=1;

					}

					else

					{

						 $sql_data_array = array(
						 'diocese_name' => $diocese_name,
						 'added_date' => time());

					

						 $db->insert_from_array($sql_data_array,TABLE);	

						 $insert_id = $db->insert_id();	

						
 				redirect('diocese.php','');



						

					}

				   break;



	case 'update': 

				    if((int)$select_id == 0) redirect();

					

						  $sql_data_array = array('diocese_name' => addslashes($diocese_name),

						 'added_date' => time());

					 

					  $db->update_from_array($sql_data_array,TABLE,'diocese_ID', $select_id);

					  

						 redirect('','upd=1&sort=diocese_ID desc ');

						

					break;

				

	case 'delete':

							$db->query("delete from ".TABLE." where diocese_ID='".$select_id."'");

							redirect('','del=1&sort=diocese_ID desc ');						

							break;

			

			

case 'deleterecord' :	

	                   $count=count($list);



			           if($count > 0)

			            {

				           for($i=0;$i<$count;$i++)

				          {	

					       $db->query("delete from ".TABLE." where diocese_ID='".$list[$i]."'");

				          }

						   

				        redirect('','dels=1&sort=diocese_ID desc ');

			             }

			        break;

					

case 'publish' :

	                   $count=count($list);



			           if($count > 0)

			            {

		

				           for($i=0;$i<$count;$i++)

				          {

						 $db->query("UPDATE ".TABLE." SET brnch_status = 1, brnch_updated_date ='".time()."' WHERE brnch_id =".$list[$i]."");		  

				          }

						   

				        redirect('','upd=1&sort=diocese_ID desc ');

			             }

			        break;

					

case 'unpublish' :	

	                   $count=count($list);



			           if($count > 0)

			            {

		

				           for($i=0;$i<$count;$i++)

				          {

					        $db->query("UPDATE ".TABLE." SET brnch_status = 2, brnch_updated_date ='".time()."' WHERE diocese_ID =".$list[$i]."");	

				          }

						   

				        redirect('','upd=1&sort=diocese_ID desc ');

			             }

			        break;			

	

} // END SWITCH



		if($ins) $alert = " Diocese Added successfully ";

		if($upd) $alert = " Diocese Updated successfully ";

		if($del) $alert = " Record deleted successfully ";

        if($dels) $alert = " Records deleted successfully ";

		



if($add || $edit)

{

   $action = 'insert';

   $TDHEADING = 'Add Diocese';



	if($select_id)

	{

		 $action = 'update';

		 $TDHEADING = 'Edit Diocese';			 


		  list($diocese_id, $diocese_name) = $db->fetch_one_row("SELECT diocese_ID, diocese_name FROM ".TABLE." WHERE diocese_ID='".$select_id."'");

		 

		 

	}

	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));

}

else

{

	$TDHEADING = 'Diocese Listing';

	

		  if($search_txt != '' || $search_status != '')

		  {

			

					 if($search_txt != '')
		
					{ 
		
					   $condition= " CONCAT(diocese_name) like lower('%".$search_txt."%')";
		
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
				
						if(!$sort) $sort ='diocese_ID desc'; 
				
				
				
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

				if(!$sort) $sort ='diocese_ID DESC' ;
				
				

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