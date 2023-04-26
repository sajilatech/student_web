<?php

require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Special Days');

require(DIR_ADMIN_INCLUDE.'session.php');
define('TABLE',MTABLE.'special_days');


$GrpPage = 1;



#################### 

# Actions



switch($doaction)

{

	case 'insert':

				    $dups = $db->get_count(TABLE,"parish_name='".$parish_name."'");

					if($dups)

					{

						 $alert = "This Name already exists.";

						 $add=1;

					}

					else

					{

						 $sql_data_array = array(
						 'category' => $category,
						 'date'=> strtotime($date)
						);
						 $db->insert_from_array($sql_data_array,TABLE);	

						 $insert_id = $db->insert_id();	

						 redirect('','ins=1&sort=special_day_ID desc ');

					}

				   break;



	case 'update': 

				    if((int)$select_id == 0) redirect();

					

						 $sql_data_array = array(
						 'category' => $category,
						 'date'=>strtotime($date)
						);

					 

					  $db->update_from_array($sql_data_array,TABLE,'special_day_ID', $select_id);

					  

						 redirect('','upd=1&sort=special_day_ID desc ');

						

					break;

				

	case 'delete':

							$db->query("delete from ".TABLE." where special_day_ID='".$select_id."'");

							redirect('','del=1&sort=special_day_ID desc ');						

							break;

			

			

case 'deleterecord' :	

	                   $count=count($list);



			           if($count > 0)

			            {

				           for($i=0;$i<$count;$i++)

				          {	

					       $db->query("delete from ".TABLE." where special_day_ID='".$list[$i]."'");

				          }

						   

				        redirect('','dels=1&sort=special_day_ID desc ');

			             }

			        break;

					


	

} // END SWITCH



		if($ins) $alert = " Special Days Added successfully ";

		if($upd) $alert = " Special Days Updated successfully ";

		if($del) $alert = " Record deleted successfully ";

        if($dels) $alert = " Records deleted successfully ";

		



if($add || $edit)

{

   $action = 'insert';

   $TDHEADING = 'Add Special Days';



	if($select_id)

	{

		 $action = 'update';

		 $TDHEADING = 'Edit Special Days';			 


		  list($special_day_id, $category, $date) = $db->fetch_one_row("SELECT special_day_ID, category, date FROM ".TABLE." WHERE special_day_ID='".$select_id."'");

		 

		 

	}

	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));

}

else

{

	$TDHEADING = 'Special Days Listing';

	

		  if($search_txt != '' || $search_status != '')

		  {

			

					 if($search_txt != '')
		
					{ 
		
					   $condition= " CONCAT(parish_name) like lower('%".$search_txt."%')";
		
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
				
						if(!$sort) $sort ='special_day_ID desc'; 
				
				
				
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
		

			/*$no_of_rows = $db->get_count(TABLE);

			if($no_of_rows > '0')

			{*/

				if(!$sort) $sort ='special_day_ID DESC' ;
				
				

		$query = "SELECT * FROM ".TABLE."  ORDER BY ".$sort; 

		$result1 = mysql_query($query) or die(mysql_error());

		$no_of_rows = mysql_num_rows($result1);		 

			/*}

		

			else

			{

					 $alert2 = "No Records !!";

			}*/

		}

			

		define('MAIN_TEMPLATE', DIR_LIST.basename($_SERVER['PHP_SELF']));

}

#######################

require(DIR_ADMIN_TPL.'main.php');  /* Iclude Tempate*/

exit; 

 ?>