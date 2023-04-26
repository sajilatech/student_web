<?php

require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Publications And Conferences');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'publications_n_conferences');
define('AWARDTABLE',MTABLE.'awards');


$GrpPage = 3;



#################### 

# Actions



switch($doaction)

{

	case 'insert':

						 $sql_data_array = array(
						 'title'=>$title,
						 'description'=>$description,
						 'year'=>$year,
						 'place' =>$place,
						 'publisher' => $publisher,
						  'publication_type' => $publication_type,
						 'student_ID' => $student_id
						
						);

					

						 $db->insert_from_array($sql_data_array,TABLE);	

						 $insert_id = $db->insert_id();	

						 $award_data_array = array( 
						  'award_title' => $award_title,
						 'award_year'=>$award_year,
						 'award_for' =>$award_for,
						  'award_from' =>$award_from,
						  'publication_ID'=>$insert_id
						 );
						 
						  $db->insert_from_array($award_data_array,AWARDTABLE);	
 				redirect('publications_n_conferences.php','');

				   break;



	case 'update': 

				    if((int)$select_id == 0) redirect();

					

						 $sql_data_array = array(
						 'title'=>$title,
						 'description'=>$description,
						 'year'=>$year,
						 'place' =>$place,
						 'publisher' => $publisher,
						  'publication_type' => $publication_type,
						 'student_ID' => $student_id
						
						);

					  $db->update_from_array($sql_data_array,TABLE,'publication_ID', $select_id);

					   $award_data_array = array( 
						  'award_title' => $award_title,
						 'award_year'=>$award_year,
						 'award_for' =>$award_for,
						  'award_from' =>$award_from,
						  'publication_ID'=>$select_id
						 );
						 
 				$db->update_from_array($award_data_array,AWARDTABLE,'publication_ID', $select_id);
						 redirect('','upd=1&sort=publication_ID desc ');

						

					break;

				

	case 'delete':

							$db->query("delete from ".TABLE." where publication_ID='".$select_id."'");

							redirect('','del=1&sort=publication_ID desc ');						

							break;

			

			

case 'deleterecord' :	

	                   $count=count($list);



			           if($count > 0)

			            {

				           for($i=0;$i<$count;$i++)

				          {	

					       $db->query("delete from ".TABLE." where publication_ID='".$list[$i]."'");

				          }

						   

				        redirect('','dels=1&sort=publication_ID desc ');

			             }

			        break;

					



} // END SWITCH



		if($ins) $alert = " Publications And Conferences Added successfully ";

		if($upd) $alert = " Publications And Conferences Updated successfully ";

		if($del) $alert = " Record deleted successfully ";

        if($dels) $alert = " Records deleted successfully ";

		



if($add || $edit)

{

   $action = 'insert';

   $TDHEADING = 'Add Publications And Conferences Details';



	if($select_id)

	{

		 $action = 'update';

		 $TDHEADING = 'Edit Publications And Conferences Details';			 

		  list($publication_id, $student_id, $title, $description, $place, $year, $publisher, $publication_type) = $db->fetch_one_row("SELECT publication_ID, student_ID, title, description,  place,  year, publisher, publication_type FROM ".TABLE." WHERE publication_ID='".$select_id."'");
		  
  list($publication_id, $award_title,  $award_year, $award_for, $award_from) = $db->fetch_one_row("SELECT publication_ID,  award_title,  award_year,  award_for, award_from FROM ".AWARDTABLE." WHERE publication_ID='".$select_id."'");

	}

	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));

}

else

{

	$TDHEADING = 'Publications And Conferences  Listing';

	

		  if($search_txt != '' || $student_id != '')

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
					$sql_res = $db->query("SELECT * FROM ".TABLE." WHERE ".$condition);
		
					$no_of_rows = mysql_num_rows($sql_res);
		
				if($no_of_rows > '0') 
				
				{
				
						if(!$sort) $sort ='publication_ID desc'; 
				
				
				
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

				if(!$sort) $sort ='publication_ID DESC' ;

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