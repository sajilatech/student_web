<?php
require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Parish');

require(DIR_ADMIN_INCLUDE.'session.php');
define('DIOTABLE',MTABLE.'diocese');
define('PARISHTBL',MTABLE.'parish');
define('TABLE',MTABLE.'teachers');


$GrpPage = 1;



#################### 

# Actions



switch($doaction)

{

	case 'insert':

				    

						 $sql_data_array = array(
						 'name' => $name,
						 'email'=>$email,
						 'phone'=>$phone,
						 'address'=> $address,
						/* 'course_ID'=> $course_id,*/
						 'parish_ID'=> $parish_id,
						 'added_date' => time());
						 $db->insert_from_array($sql_data_array,TABLE);	

						 $insert_id = $db->insert_id();	

						 redirect('','ins=1&sort=teacher_ID desc ');
				   break;



	case 'update': 

				    if((int)$select_id == 0) redirect();

					

						  $sql_data_array = array(
						 'name' => $name,
						 'email'=>$email,
						 'phone'=>$phone,
						 'address'=> $address,
						  /*'course_ID'=> $course_id,*/
						  'parish_ID'=> $parish_id,
						 'added_date' => time());



					 

					  $db->update_from_array($sql_data_array,TABLE,'teacher_ID', $select_id);

					  

						 redirect('','upd=1&sort=teacher_ID desc ');

						

					break;

				

	case 'delete':

							$db->query("delete from ".TABLE." where teacher_ID='".$select_id."'");

							redirect('','del=1&sort=teacher_ID desc ');						

							break;

			

			

case 'deleterecord' :	

	                   $count=count($list);



			           if($count > 0)

			            {

				           for($i=0;$i<$count;$i++)

				          {	

					       $db->query("delete from ".TABLE." where teacher_ID='".$list[$i]."'");

				          }

						   

				        redirect('','dels=1&sort=teacher_ID desc ');

			             }

			        break;

					



} // END SWITCH



		if($ins) $alert = " Parish Added successfully ";

		if($upd) $alert = " Parish Updated successfully ";

		if($del) $alert = " Record deleted successfully ";

        if($dels) $alert = " Records deleted successfully ";

		



if($add || $edit)

{

   $action = 'insert';

   $TDHEADING = 'Add Teacher';



	if($select_id)

	{

		 $action = 'update';

		 $TDHEADING = 'Edit Teacher';			 


		  list($parish_id, $course_id, $name, $email, $phone, $address) = $db->fetch_one_row("SELECT parish_ID, course_ID, name, email, phone, address FROM ".TABLE." WHERE teacher_ID='".$select_id."'");

		 

		 

	}

	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));

}

else

{

	$TDHEADING = 'Teacher Listing';

	

		  if($search_txt != '' || $parish_id != '')

		  {
				 if($search_txt != '')
	
				{ 
	
				   $condition= " CONCAT(name) like lower('%".$search_txt."%')";
	
				}
				if($parish_id != '')
		
				{
		
					if($condition != '' )
		
					  $condition.= " AND parish_ID=".$parish_id;
		
					else  
		
					   $condition= " parish_ID=".$parish_id;
		
				}
				
					$sql_res = $db->query("SELECT * FROM ".TABLE." WHERE ".$condition);
		
					$no_of_rows = mysql_num_rows($sql_res);
		
				if($no_of_rows > '0') 
				
				{
				
						if(!$sort) $sort ='teacher_ID desc'; 
				
				
				
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

				if(!$sort) $sort ='teacher_ID DESC' ;
				
				

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