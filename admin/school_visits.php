<?php

require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','School Visits');

require(DIR_ADMIN_INCLUDE.'session.php');
define('DIOTABLE',MTABLE.'diocese');
define('TABLE',MTABLE.'school_visits');



$GrpPage = 1;



#################### 

# Actions



switch($doaction)

{

	case 'insert':


						 $sql_data_array = array(
						 'school_name' => $school_name,
						  'school_contact_no'=>$school_contact_no,
						 'school_headmaster'=>$school_headmaster,
						 'visit_date'=>$visit_date,
						 'visit_who'=>$visit_who,
						 'description'=> $description
						);

						 $db->insert_from_array($sql_data_array,TABLE);	

						 $insert_id = $db->insert_id();	

						 redirect('','ins=1&sort=school_visit_ID desc ');

				   break;



	case 'update': 

				    if((int)$select_id == 0) redirect();

					

						  $sql_data_array = array(
						 'school_name' => $school_name,
						  'school_contact_no'=>$school_contact_no,
						 'school_headmaster'=>$school_headmaster,
						 'visit_date'=>$visit_date,
						 'visit_who'=>$visit_who,
						 'description'=> $description
						);

					 

					  $db->update_from_array($sql_data_array,TABLE,'school_visit_ID', $select_id);

					  

						 redirect('','upd=1&sort=school_visit_ID desc ');

						

					break;

				

	case 'delete':

							$db->query("delete from ".TABLE." where school_visit_ID='".$select_id."'");

							redirect('','del=1&sort=school_visit_ID desc ');						

							break;

			

			

case 'deleterecord' :	

	                   $count=count($list);



			           if($count > 0)

			            {

				           for($i=0;$i<$count;$i++)

				          {	

					       $db->query("delete from ".TABLE." where school_visit_ID='".$list[$i]."'");

				          }

						   

				        redirect('','dels=1&sort=school_visit_ID desc ');

			             }

			        break;

					


	

} // END SWITCH



		if($ins) $alert = " School Visits Added successfully ";

		if($upd) $alert = " School Visits Updated successfully ";

		if($del) $alert = " Record deleted successfully ";

        if($dels) $alert = " Records deleted successfully ";

		



if($add || $edit)

{

   $action = 'insert';

   $TDHEADING = 'Add School Visits';



	if($select_id)

	{

		 $action = 'update';

		 $TDHEADING = 'Edit School Visits';			 

		  list($school_visit_id, $school_name, $school_contact_no, $school_headmaster, $visit_date, $visit_who, $description) = $db->fetch_one_row("SELECT school_visit_ID, school_name, school_contact_no, school_headmaster, visit_date, visit_who, description    FROM ".TABLE." WHERE school_visit_ID='".$select_id."'");

	}

	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));

}

else

{

	$TDHEADING = 'School Visits Listing';

	

		  if($search_txt != ''  )

		  {

					 if($search_txt != '')
		
					{ 
		
					   $condition= " CONCAT(parish_name) like lower('%".$search_txt."%')";
		
					}
		
					$sql_res = $db->query("SELECT * FROM ".TABLE." WHERE ".$condition);
		
					$no_of_rows = mysql_num_rows($sql_res);
		
				if($no_of_rows > '0') 
				
				{
				
						if(!$sort) $sort ='school_visit_ID desc'; 
				
				
				
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

				if(!$sort) $sort ='school_visit_ID DESC' ;
				
				

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