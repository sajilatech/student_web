<?php
require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Phone Calls');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'phone_chart');

define('REMINDERTABLE',MTABLE.'call_reminders');
$GrpPage = 3;



#################### 

# Actions



switch($doaction)

{

	case 'insert':

				  
		if($reminder_checkbox=='on'){
			$r_checkbox='1';
		}
		else{ $r_checkbox='0';}
						
						 $sql_data_array = array(
						 'student_ID'=>$student_id,
						 'title' => $title,
						 'date' =>strtotime($date),
						 'phone_call_type' => $phone_call_type,
						 'phone_call_status' => $phone_call_status,
						 'our_phone_no'=> $our_phone_no, 
						 'phone_no' =>$phone_no,
						 'description'=>$description,
						 'reminder_check'=>$r_checkbox
						);

					

						 $db->insert_from_array($sql_data_array,TABLE);	
						  $insert_id = $db->insert_id();	
						 if($r_checkbox=='1'){
							 $reminder_time=$select1.'-'.$select2;
							 $sql_reminder_data_array=array(
							 	'date'=>strtotime($reminder_date),
								'time'=>$reminder_time,
								'purpose'=>$reminder_notes,
								'phone_chart_ID'=>$insert_id
							 
							 );
							  $db->insert_from_array($sql_reminder_data_array,REMINDERTABLE);	
						 }

						

						
 				redirect('phone_chart.php','');

				   break;



	case 'update': 

				    if((int)$select_id == 0) redirect();

					if($reminder_checkbox=='on'){
						$r_checkbox='1';
					}
					else{ $r_checkbox='0';}

						  $sql_data_array = array(
						 'student_ID'=>$student_id,
						 'title' => $title,
						 'date' =>strtotime($date),
						  'phone_call_type' => $phone_call_type,
						 'phone_call_status' => $phone_call_status,
						 'our_phone_no'=> $our_phone_no,
						 'phone_no' => $phone_no,
						 'description'=>$description,
						 'reminder_check'=>$r_checkbox
						);

					 

					  $db->update_from_array($sql_data_array,TABLE,'phone_chart_ID', $select_id);
 							if($r_checkbox=='1'){
								 $reminder_time=$select1.'-'.$select2;
							 $sql_reminder_data_array=array(
							 	'date'=>strtotime($reminder_date),
								'time'=>$reminder_time,
								'purpose'=>$reminder_notes,
								'phone_chart_ID'=>$select_id
							 
							 );
							  $db->insert_from_array($sql_reminder_data_array,REMINDERTABLE);	
						 }
					  

						 redirect('','upd=1&sort=phone_chart_ID desc ');

						

					break;

				

	case 'delete':

							$db->query("delete from ".TABLE." where phone_chart_ID='".$select_id."'");

							redirect('','del=1&sort=phone_chart_ID desc ');						

							break;

			

			

case 'deleterecord' :	

	                   $count=count($list);



			           if($count > 0)

			            {

				           for($i=0;$i<$count;$i++)

				          {	

					       $db->query("delete from ".TABLE." where phone_chart_ID='".$list[$i]."'");

				          }

						   

				        redirect('','dels=1&sort=phone_chart_ID desc ');

			             }

			        break;

					


	

} // END SWITCH



		if($ins) $alert = " Phone Calls Added successfully ";

		if($upd) $alert = " Phone Calls Updated successfully ";

		if($del) $alert = " Record deleted successfully ";

        if($dels) $alert = " Records deleted successfully ";

		



if($add || $edit)

{

   $action = 'insert';

   $TDHEADING = 'Add Phone Calls';



	if($select_id)

	{

		 $action = 'update';

		 $TDHEADING = 'Edit Phone Calls';			 

		  list($phone_chart_id, $student_id, $title, $date,  $description,  $phone_call_type, $phone_call_status, $our_phone_no, $phone_no, $reminder_check) = $db->fetch_one_row("SELECT phone_chart_ID, student_ID, title, date, description, phone_call_type,  phone_call_status, our_phone_no, phone_no, reminder_check FROM ".TABLE." WHERE phone_chart_ID='".$select_id."'");
 $reminder_arr=getResultArray("SELECT reminder_ID FROM ".MTABLE."call_reminders WHERE phone_chart_ID = '".$select_id."' ORDER BY reminder_ID desc ");
if(!empty($reminder_arr)){
	$last_insert_id=$reminder_arr[0]['reminder_ID'];
}
 list($reminder_id, $reminder_date, $reminder_time, $reminder_notes) = $db->fetch_one_row("SELECT reminder_ID, date, time, purpose FROM ".REMINDERTABLE." WHERE reminder_ID='".$last_insert_id."'");
	}

	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));

}

else

{

	$TDHEADING = 'Phone Calls Listing';

	

		  if($search_txt != '' || $student_id != '' || $from_date != '' || $to_date != '' || $phone_call_type !='' || $phone_call_status != '' )

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
					
					if($phone_call_type != ''){
			
						if($condition != '' )
			
						$condition.= " AND phone_call_type=".$phone_call_type;
			
						else  
			
						$condition= " phone_call_type=".$phone_call_type;
			
					}
					
					if($phone_call_status != ''){
			
						if($condition != '' )
			
						$condition.= " AND phone_call_status=".$phone_call_status;
			
						else  
			
						$condition= " phone_call_status=".$phone_call_status;
			
					}
					
					if($from_date != '' && $to_date != '' ){
			 	
						$from = strtotime($from_date);
						$to = strtotime($to_date);
						
						if($condition!='')
						
							$condition.= " AND ".TABLE.".date BETWEEN ".$from." AND ".$to;
						
						else
							$condition = " ".TABLE.".date BETWEEN ".$from." AND ".$to;
					}
				
					$sql_res = $db->query("SELECT * FROM ".TABLE." WHERE ".$condition);
		
					$no_of_rows = mysql_num_rows($sql_res);
		
				if($no_of_rows > '0') 
				
				{
				
						if(!$sort) $sort ='phone_chart_ID desc'; 
				
				
				
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

				if(!$sort) $sort ='phone_chart_ID DESC' ;
				
				

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