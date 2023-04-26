<?php

require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Parish');

require(DIR_ADMIN_INCLUDE.'session.php');
define('DIOTABLE',MTABLE.'diocese');
define('TABLE',MTABLE.'parish');



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
						 'name' => $parish_name,
						 'diocese_ID'=>$diocese_id,
						 'vicari'=>$vicari,
						 'phone'=> $phone,
						 'description'=>$description,
						 'added_date' => time());

						 $db->insert_from_array($sql_data_array,TABLE);	

						 $insert_id = $db->insert_id();	

						 redirect('','ins=1&sort=parish_ID desc ');

					}

				   break;



	case 'update': 

				    if((int)$select_id == 0) redirect();

					

						 $sql_data_array = array(
						 'name' => $parish_name,
						 'diocese_ID'=>$diocese_id,
						 'vicari'=>$vicari,
						 'phone'=> $phone,
						 'description'=>$description,
						 'added_date' => time());

					 

					  $db->update_from_array($sql_data_array,TABLE,'parish_ID', $select_id);

						 redirect('','upd=1&sort=parish_ID desc ');

						

					break;

				

	case 'delete':

							$db->query("delete from ".TABLE." where parish_ID='".$select_id."'");

							redirect('','del=1&sort=parish_ID desc ');						

							break;

			

case 'deleterecord' :	

	                   $count=count($list);



			           if($count > 0)

			            {

				           for($i=0;$i<$count;$i++)

				          {	

					       $db->query("delete from ".TABLE." where parish_ID='".$list[$i]."'");

				          }

						   

				        redirect('','dels=1&sort=parish_ID desc ');

			             }

			        break;
	

} // END SWITCH



		if($ins) $alert = "Parish Added successfully ";

		if($upd) $alert = " Parish Updated successfully ";

		if($del) $alert = " Record deleted successfully ";

        if($dels) $alert = " Records deleted successfully ";


if($add || $edit)

{

   $action = 'insert';

   $TDHEADING = 'Add Parish';



	if($select_id)

	{

		 $action = 'update';

		 $TDHEADING = 'Edit Parish';			 


		  list($parish_id, $parish_name, $diocese_id, $vicari, $phone, $parish_status, $description ) = $db->fetch_one_row("SELECT parish_ID, name, diocese_ID, vicari, phone, parish_status, description FROM ".TABLE." WHERE parish_ID='".$select_id."'");

	}

	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));

}

else

{

	$TDHEADING = 'Parish Listing';

	

		  if($search_txt != '' || $diocese != '')

		  {

					 if($search_txt != '')
		
					{ 
		
					   $condition= " CONCAT(parish_name) like lower('%".$search_txt."%')";
		
					}
		
				
		
				if($diocese_id != '')
		
				{
		
					if($condition != '' )
		
					  $condition.= " AND diocese_ID=".$diocese_id;
		
					else  
		
					   $condition= " diocese_ID=".$diocese_id;
		
				}
				
				
					$sql_res = $db->query("SELECT * FROM ".TABLE." WHERE ".$condition);
		
					$no_of_rows = mysql_num_rows($sql_res);
		
				if($no_of_rows > '0') 
				
				{
				
						if(!$sort) $sort ='parish_ID desc'; 
				
				
				
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

				if(!$sort) $sort ='parish_ID DESC' ;
				
				

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