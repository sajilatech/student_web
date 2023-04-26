<?php

require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Teacher Comments');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'teacher_comments');
define('TEACHERTABLE',MTABLE.'teachers');



$GrpPage = 3;



#################### 

# Actions



switch($doaction)

{

	case 'insert':

						 $sql_data_array = array(
						 'teacher_ID' => $teacher_id,
						 'student_ID'=> $student_id,
						 'comments'=>$comments,
						 'added_date' => time());

						 $db->insert_from_array($sql_data_array,TABLE);	

						 $insert_id = $db->insert_id();	

						
 				redirect('teacher_comments.php','');
				   break;



	case 'update': 

				    if((int)$select_id == 0) redirect();

					

						  $sql_data_array = array( 'teacher_ID' => $teacher_id,
						 'student_ID'=> $student_id,
						 'comments'=>$comments
						 );

					 

					  $db->update_from_array($sql_data_array,TABLE,'teacher_comment_ID', $select_id);

					  

						 redirect('','upd=1&sort=teacher_comment_ID desc ');

						

					break;

				

	case 'delete':

							$db->query("delete from ".TABLE." where teacher_comment_ID='".$select_id."'");

							redirect('','del=1&sort=teacher_comment_ID desc ');						

							break;

			

			

case 'deleterecord' :	

	                   $count=count($list);



			           if($count > 0)

			            {

				           for($i=0;$i<$count;$i++)

				          {	

					       $db->query("delete from ".TABLE." where teacher_comment_ID='".$list[$i]."'");

				          }

						   

				        redirect('','dels=1&sort=teacher_comment_ID desc ');

			             }

			        break;

					


} // END SWITCH



		if($ins) $alert = " Comments Added successfully ";

		if($upd) $alert = " Comments Updated successfully ";

		if($del) $alert = " Record deleted successfully ";

        if($dels) $alert = " Records deleted successfully ";

		



if($add || $edit)

{

   $action = 'insert';

   $TDHEADING = 'Add Comments';



	if($select_id)

	{

		 $action = 'update';

		 $TDHEADING = 'Edit Comments';			 


		  list($teacher_comment_id, $comments, $teacher_id, $student_id) = $db->fetch_one_row("SELECT teacher_comment_ID, comments, teacher_ID, student_ID FROM ".TABLE." WHERE teacher_comment_ID='".$select_id."'");

	}

	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));

}

else

{

	$TDHEADING = 'Teacher Comments Listing';

	

		  if($search_txt != '' || $search_status != '')

		  {

			

					/* if($search_txt != '')
		
					{ 
		
					   $condition= " CONCAT(diocese_name) like lower('%".$search_txt."%')";
		
					}*/
		
					$sql_res = $db->query("SELECT * FROM ".TABLE." WHERE ".$condition);
		
					$no_of_rows = mysql_num_rows($sql_res);
		
				if($no_of_rows > '0') 
				
				{
				
						if(!$sort) $sort ='teacher_comment_ID desc'; 
				
				
				
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

				if(!$sort) $sort ='teacher_comment_ID DESC' ;
				
				

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