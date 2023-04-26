<?php

require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Exams');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'exams');
define('EXAM_RESULT_TBL', MTABLE.'exam_results');

$GrpPage = 3;



#################### 

# Actions



switch($doaction)

{

	case 'insert':

				  

						
						/* $sql_data_array = array(
						 'exam_type' => $exam_type,
						  'exam_date'=>strtotime($exam_date),
						 'exam_model' =>$exam_model,
						  'description'=>$description,
						 'student_ID' => $student_id
						);*/
							if($exam_model !=''){
								$sql_exam_array = array(
									'exam_type'=>$exam_type, 
									 'exam_model' =>$exam_model,
									   'description'=>$description,
									 'student_ID' => $student_id
								);
								 $db->insert_from_array($sql_exam_array,TABLE);
							$exam_pri_id = $db->insert_id();
							//$exam_pri_id=7;
								if($exam_pri_id !=''){ 
							
									for($i=1;$i<=$no_subjects;$i++){ 	
										if($_POST['subjects_'.$i] !=''){
											$sql_exam_result_array = array(
												'exam_ID' =>$exam_pri_id,
												 'subjects' => $_POST['subjects_'.$i],
												 'marks'=> $_POST['marks_'.$i]);
												  $db->insert_from_array($sql_exam_result_array,EXAM_RESULT_TBL); 
										}
									}
								}
							}
					

						if($retur=='student'){
							redirect('students.php?edit=1&select_id='.$student_id,'');
						}
						else{
 							redirect('exams.php','');
						}

				   break;



	case 'update': 

				    if((int)$select_id == 0) redirect();

					
					if($exam_model !=''){
								$sql_exam_array = array(
									'exam_type'=>$exam_type, 
									 'exam_model' =>$exam_model,
									  'description'=>$description,
									 'student_ID' => $select_id
								);
								$db->update_from_array($sql_exam_array,TABLE,'student_ID', $select_id);
							 		$db->query("delete from ".EXAM_RESULT_TBL." where exam_ID='".$exam_id."' ");
									
									for($i=1;$i<=$no_subjects;$i++){ 
										if($_POST['subjects_'.$i] !=''){
											$sql_exam_result_array = array(
												'exam_ID' =>$exam_id,
												 'subjects' => $_POST['subjects_'.$i],
												 'marks'=> $_POST['marks_'.$i]); 
												  $db->insert_from_array($sql_exam_result_array,EXAM_RESULT_TBL); 
										}
									}
							}

						/* $sql_data_array = array(
						 'exam_type' => $exam_type,
						 'exam_date'=>strtotime($exam_date),
						 'subject'=>$subject,
						 'exam_model' =>$exam_model,
						 'marks' => $marks,
						  'description'=>$description,
						 'student_ID' => $student_id
						);*/


					 

					  $db->update_from_array($sql_data_array,TABLE,'exam_ID', $select_id);

					  

						 redirect('','upd=1&sort=exam_ID desc ');

						

					break;

				

	case 'delete':

							$db->query("delete from ".TABLE." where exam_ID='".$select_id."'");

							redirect('','del=1&sort=exam_ID desc ');						

							break;

			

			

case 'deleterecord' :	

	                   $count=count($list);



			           if($count > 0)

			            {

				           for($i=0;$i<$count;$i++)

				          {	

					       $db->query("delete from ".TABLE." where exam_ID='".$list[$i]."'");

				          }

						   

				        redirect('','dels=1&sort=exam_ID desc ');

			             }

			        break;

					

	

	

} // END SWITCH



		if($ins) $alert = " Exams Added successfully ";

		if($upd) $alert = " Exams Updated successfully ";

		if($del) $alert = " Record deleted successfully ";

        if($dels) $alert = " Records deleted successfully ";

		



if($add || $edit)

{

   $action = 'insert';

   $TDHEADING = 'Add Exams';



	if($select_id)

	{

		 $action = 'update';

		 $TDHEADING = 'Edit Exams';			 
		  list($exam_id, $student_id, $exam_type,  $exam_model, $description, $exam_date) = $db->fetch_one_row("SELECT exam_ID, student_ID, exam_type,   exam_model,  description, exam_date FROM ".TABLE." WHERE exam_ID='".$select_id."'");


	}

	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));

}

else

{

	$TDHEADING = 'Exams Listing';

	

		  if($search_txt != '' || $student_id != '' || $exam_model != '' ||$from_date != '' || $to_date != '')

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
					
					if($exam_model != ''){
			
						if($condition != '' )
			
						$condition.= " AND exam_model=".$exam_model;
			
						else  
			
						$condition= " exam_model=".$exam_model;
			
					}
					
				if($from_date != '' && $to_date != '' ){
			 	
					$from = strtotime($from_date);
					$to = strtotime($to_date);
					
					if($condition!='')
					
						$condition.= " AND ".TABLE.".exam_date BETWEEN ".$from." AND ".$to;
					
					else
						$condition = " ".TABLE.".exam_date BETWEEN ".$from." AND ".$to;
				}
					$sql_res = $db->query("SELECT * FROM ".TABLE." WHERE ".$condition);
		
					$no_of_rows = mysql_num_rows($sql_res);
		
				if($no_of_rows > '0') 
				
				{
				
						if(!$sort) $sort ='exam_ID desc'; 
				
				
				
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

				if(!$sort) $sort ='exam_ID DESC' ;
				
				

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