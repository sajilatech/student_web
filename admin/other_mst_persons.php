<?php

require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Other MST Persons');

require(DIR_ADMIN_INCLUDE.'session.php');
define('DIOTABLE',MTABLE.'diocese');
define('TABLE',MTABLE.'other_mst_persons');



$GrpPage = 1;



#################### 

# Actions



switch($doaction)

{

	case 'insert':


						 $sql_data_array = array(
						 'name' => $name,
						 'category'=>$category,
						 'email'=>$email,
						 'parish_ID'=>$parish_id,
						 'mst_id'=>$mst_id,
						 'place'=> $place,
						  'post_code'=> $post_code,
						   'district'=> $district,
						    'state'=> $state,
							 'country'=> $country,
							  'land_phone'=> $land_phone,
							  'cell_phone'=>$cell_phone,
							  'description'=>$description,
						 'added_date' => time());

						 $db->insert_from_array($sql_data_array,TABLE);	

						 $insert_id = $db->insert_id();	

						 redirect('','ins=1&sort=other_mst_person_ID desc ');

				   break;



	case 'update': 

				    if((int)$select_id == 0) redirect();

					

						  $sql_data_array = array(
						 'name' => $name,
						  'category'=>$category,
						 'email'=>$email,
						 'parish_ID'=>$parish_id,
						 'mst_id'=>$mst_id,
						 'place'=> $place,
						  'post_code'=> $post_code,
						   'district'=> $district,
						    'state'=> $state,
							 'country'=> $country,
							  'land_phone'=> $land_phone,
							  'cell_phone'=>$cell_phone,
							  'description'=>$description,
						 'added_date' => time());

					 

					  $db->update_from_array($sql_data_array,TABLE,'other_mst_person_ID', $select_id);

					  

						 redirect('','upd=1&sort=other_mst_person_ID desc ');

						

					break;

				

	case 'delete':

							$db->query("delete from ".TABLE." where parish_ID='".$select_id."'");

							redirect('','del=1&sort=other_mst_person_ID desc ');						

							break;

			

			

case 'deleterecord' :	

	                   $count=count($list);



			           if($count > 0)

			            {

				           for($i=0;$i<$count;$i++)

				          {	

					       $db->query("delete from ".TABLE." where other_mst_person_ID='".$list[$i]."'");

				          }

						   

				        redirect('','dels=1&sort=other_mst_person_ID desc ');

			             }

			        break;

					

		

	

} // END SWITCH



		if($ins) $alert = " Other MST Persons Added successfully ";

		if($upd) $alert = " Other MST Persons Updated successfully ";

		if($del) $alert = " Record deleted successfully ";

        if($dels) $alert = " Records deleted successfully ";

		



if($add || $edit)

{

   $action = 'insert';

   $TDHEADING = 'Add Other MST Persons';



	if($select_id)

	{

		 $action = 'update';

		 $TDHEADING = 'Edit Other MST Persons';			 

		  list($other_mst_person_ID, $name, $category, $email, $parish_id, $mst_id, $place, $post_code, $district, $state, $country, $land_phone, $cell_phone, $description) = $db->fetch_one_row("SELECT other_mst_person_ID, name, category, email, parish_ID, mst_id, place, post_code, district, state, country,  land_phone, cell_phone, description    FROM ".TABLE." WHERE other_mst_person_ID='".$select_id."'");

	}

	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));

}

else

{

	$TDHEADING = 'Other MST Persons Listing';

	

		  if($search_txt != '' || $parish_id != '' || $category !='' )

		  {

			

					 if($search_txt != '')
		
					{ 
		
					   $condition= " CONCAT(parish_name) like lower('%".$search_txt."%')";
		
					}
		
				
		
				if($parish_id != '')
		
				{
		
					if($condition != '' )
		
					  $condition.= " AND parish_ID=".$parish_id;
		
					else  
		
					   $condition= " parish_ID=".$parish_id;
		
				}
				if($category != '')
		
				{
		
					if($condition != '' )
		
					  $condition.= " AND category=".$category;
		
					else  
		
					   $condition= " category=".$category;
		
				}
				
				
					$sql_res = $db->query("SELECT * FROM ".TABLE." WHERE ".$condition);
		
					$no_of_rows = mysql_num_rows($sql_res);
		
				if($no_of_rows > '0') 
				
				{
				
						if(!$sort) $sort ='other_mst_person_ID desc'; 
				
				
				
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

				if(!$sort) $sort ='other_mst_person_ID DESC' ;
				
				

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