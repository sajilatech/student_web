<?php

require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Appointments');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'appointments');
define('DIOTABLE',MTABLE.'diocese');


$GrpPage = 3;



#################### 

# Actions



switch($doaction)

{

	case 'insert':

				  

						
						 $sql_data_array = array(
						 'student_ID'=>$student_id,
						 'title' => $title,
						 'place'=>$place,
						 'from_date' =>strtotime($from_date),
						 'to_date' => strtotime($to_date),
						 'state' => $state,
						 'country' => $country,
						 'description'=>$description,
						 'appointment_order'=>$order
						);

					

						 $db->insert_from_array($sql_data_array,TABLE);	

						 $insert_id = $db->insert_id();	

						
 				redirect('appointments.php','');

				   break;



	case 'update': 

				    if((int)$select_id == 0) redirect();


						  $sql_data_array = array(
						   'student_ID'=>$student_id,
						 'title' => $title,
						 'place'=>$place,
						 'from_date' =>strtotime($from_date),
						 'to_date' => strtotime($to_date),
						 'state' => $state,
						 'country' => $country,
						 'description'=>$description,
						 'appointment_order'=>$order
						);

					 

					  $db->update_from_array($sql_data_array,TABLE,'appointment_ID', $select_id);

					  

						 redirect('','upd=1&sort=appointment_ID desc ');

						

					break;

				

	case 'delete':

							$db->query("delete from ".TABLE." where appointment_ID='".$select_id."'");

							redirect('','del=1&sort=appointment_ID desc ');						

							break;

			

			

case 'deleterecord' :	

	                   $count=count($list);



			           if($count > 0)

			            {

				           for($i=0;$i<$count;$i++)

				          {	

					       $db->query("delete from ".TABLE." where appointment_ID='".$list[$i]."'");

				          }

						   

				        redirect('','dels=1&sort=appointment_ID desc ');

			             }

			        break;

					


	

} // END SWITCH



		if($ins) $alert = " Appointments Added successfully ";

		if($upd) $alert = " Appointments Updated successfully ";

		if($del) $alert = " Record deleted successfully ";

        if($dels) $alert = " Records deleted successfully ";

		



if($add || $edit)

{

   $action = 'insert';

   $TDHEADING = 'Add Appointments';



	if($select_id)

	{

		 $action = 'update';

		 $TDHEADING = 'Edit Appointments';	
		  list($appointment_id, $student_id, $title, $place, $from_date, $to_date, $state, $country, $description, $order ) = $db->fetch_one_row("SELECT appointment_ID, student_ID, title, place,  from_date, to_date, state, country, description, appointment_order FROM ".TABLE." WHERE appointment_ID='".$select_id."'");


	}

	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));

}

else

{

	$TDHEADING = 'Appointments Listing';

		  if($search_txt != '' || $student_id != '' || $from_date != '' || $to_date != '')

		  {
				 if($search_txt != '')
	
				{ 
	
				   $condition= " CONCAT(title) like lower('%".$search_txt."%')";
	
				}
		
				if($student_id != '')
				{
					if($condition != '' )
					  $condition.= " AND student_ID=".$student_id;
					else  
					   $condition= " student_ID=".$student_id;
				}
				
				if($from_date != '' && $to_date != '' ){
			 	
					$from = strtotime($from_date);
					$to = strtotime($to_date);
					
					if($condition!='')
					
						$condition.= " AND ".TABLE.".from_date BETWEEN ".$from." AND ".$to;
					
					else
						$condition = " ".TABLE.".from_date BETWEEN ".$from." AND ".$to;
				}
				
					$sql_res = $db->query("SELECT * FROM ".TABLE." WHERE ".$condition);
		
					$no_of_rows = mysql_num_rows($sql_res);
		
				if($no_of_rows > '0') 
				
				{
				
						if(!$sort) $sort ='appointment_order desc'; 
				
				
				
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

				if(!$sort) $sort ='appointment_order DESC' ;
				
				

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