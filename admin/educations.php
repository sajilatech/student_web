<?php

require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Educations');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'educations');
define('DIOTABLE',MTABLE.'diocese');


$GrpPage = 3;



#################### 

# Actions



switch($doaction)

{

	case 'insert':

				  

						
						 $sql_data_array = array(
						 'education_type' => $education_type,
						 'institution_name'=>$institution_name,
						 'place' =>$place,
						 'start_year' => $start_year,
						  'end_year' => $end_year,
						 'student_ID' => $student_id,
						 'level_of' => $level_of,
						 'degree' => $degree,
						 'country' => $country,
						 'description'=>$description
						);

					 if($retur=='student'){
							redirect('students.php?edit=1&select_id='.$student_id,'');
						}
						else{

						 $db->insert_from_array($sql_data_array,TABLE);	
						}

						 $insert_id = $db->insert_id();	

						
 				redirect('educations.php','');

				   break;



	case 'update': 

				    if((int)$select_id == 0) redirect();

					

						  $sql_data_array = array( 
						  'education_type' => $education_type,
						 'institution_name'=>$institution_name,
						 'place' =>$place,
						 'start_year' => $start_year,
						  'end_year' => $end_year,
						 'student_ID' => $student_id,
						 'level_of' => $level_of,
						 'degree' => $degree,
						 'country' => $country,
						 'description'=>$description
						 );

					 

					  $db->update_from_array($sql_data_array,TABLE,'education_ID', $select_id);

					  

						 redirect('','upd=1&sort=education_ID desc ');

						

					break;

				

	case 'delete':

							$db->query("delete from ".TABLE." where education_ID='".$select_id."'");

							redirect('','del=1&sort=education_ID desc ');						

							break;

			

			

case 'deleterecord' :	

	                   $count=count($list);



			           if($count > 0)

			            {

				           for($i=0;$i<$count;$i++)

				          {	

					       $db->query("delete from ".TABLE." where education_ID='".$list[$i]."'");

				          }

						   

				        redirect('','dels=1&sort=education_ID desc ');

			             }

			        break;

					



} // END SWITCH



		if($ins) $alert = " Educations Added successfully ";

		if($upd) $alert = " Educations Updated successfully ";

		if($del) $alert = " Record deleted successfully ";

        if($dels) $alert = " Records deleted successfully ";

		



if($add || $edit)

{

   $action = 'insert';

   $TDHEADING = 'Add Education Details';



	if($select_id)

	{

		 $action = 'update';

		 $TDHEADING = 'Edit Education Details';			 
		  list($education_id, $student_id, $education_type, $place, $start_year, $end_year, $level_of, $country, $degree, $institution_name, $description ) = $db->fetch_one_row("SELECT education_ID, student_ID, education_type, place,  start_year, end_year, level_of, country, degree, institution_name, description FROM ".TABLE." WHERE education_ID='".$select_id."'");


	}

	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));

}

else

{

	$TDHEADING = 'Education  Listing';

	

		  if($search_txt != '' || $student_id != '' || $education_type)

		  {

					 if($search_txt != '')
		
					{ 
		
					   $condition= " CONCAT(title) like lower('%".$search_txt."%')";
		
					}
					if($student_id != ''){
			
						if($condition != '' )
			
						$condition.= " AND student_ID=".$student_id;
			
						else  
			
						$condition= " student_ID=".$student_id;
			
					}
				
				if($education_type != ''){
			
						if($condition != '' )
			
						$condition.= " AND education_type=".$education_type;
			
						else  
			
						$condition= " education_type=".$education_type;
			
					}
					$sql_res = $db->query("SELECT * FROM ".TABLE." WHERE ".$condition);
		
					$no_of_rows = mysql_num_rows($sql_res);
		
				if($no_of_rows > '0') 
				
				{
				
						if(!$sort) $sort ='education_ID desc'; 
				
				
				
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

				if(!$sort) $sort ='education_ID DESC' ;
				
				

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