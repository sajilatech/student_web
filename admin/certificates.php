<?php
require('../application_top.php');
define('MODULEID','7');
define('MODULE_TITLE','Courses');
require(DIR_ADMIN_INCLUDE.'session.php');
define('TABLE',MTABLE.'student_certificates');
define('CERTI_MASTER_TABLE',MTABLE.'certificates_master');
define('STUDTABLE',MTABLE.'students');
$GrpPage = 3;

#################### 
# Actions

switch($doaction)
{
	case 'insert':
	
					 $no_files = count($_FILES["files"]['name']);
					for ($i = 0; $i < $no_files; $i++) {
						if ($_FILES["files"]["error"][$i] > 0) {
							echo "Error: " . $_FILES["files"]["error"][$i] . "<br>";
						} else {
							$random_num=rand();
								$file_name=$random_num.'_'.$_FILES["files"]["name"][$i];
							if (file_exists( UPLOADS.'/certificates/' . $file_name)) {
								echo 'File already exists : /uploads/certificates/' . $file_name;
							} else { print_r("not exists");
								
								move_uploaded_file($_FILES["files"]["tmp_name"][$i], UPLOADS.'/certificates/' . $file_name);
								
								 $sql_data_array = array(
								 'file_name' => $file_name,
								 'student_ID' => $student_id);
								 $db->insert_from_array($sql_data_array,TABLE);	
								
							}
						}
					}
					$certificates_array=array(
								'student_ID'=>$student_id,
								'description'=>$description);
								 $db->insert_from_array($certificates_array,CERTI_MASTER_TABLE);
								 if($retur=='student'){
							redirect('students.php?edit=1&select_id='.$student_id,'');
						}
						else{
	 						redirect('certificates.php','');
						}
					
				   break;

	case 'update': 
				    $no_files = count($_FILES["files"]['name']);
					for ($i = 0; $i < $no_files; $i++) {
						if ($_FILES["files"]["error"][$i] > 0) {
							echo "Error: " . $_FILES["files"]["error"][$i] . "<br>";
						} else {
							$random_num=rand();
								$file_name=$random_num.'_'.$_FILES["files"]["name"][$i];
							if (file_exists('../uploads/certificates/' . $file_name)) {
								echo 'File already exists : ../uploads/certificates/' . $file_name;
							} else {
								
								if(move_uploaded_file($_FILES["files"]["tmp_name"][$i], '../uploads/certificates/' . $file_name)){
								 $sql_data_array = array(
								 'file_name' => $file_name,
								 'student_ID' => $student_id);
								 $db->insert_from_array($sql_data_array,TABLE);	
								}
							}
						}
					}
					$certificates_array=array(
								'student_ID'=>$student_id,
								'description'=>$description);
								  $db->update_from_array($certificates_array,CERTI_MASTER_TABLE,'student_ID', $select_id);
					  redirect('','upd=1&sort=certificate_ID desc ');
						
					break;
				
	case 'delete':
						  
							$db->query("delete from ".TABLE." where student_ID='".$select_id."'");
							redirect('','del=1&sort=student_ID desc ');
						
							break;
			
			
case 'deleterecord' :	
	                   $count=count($list);

			           if($count > 0)
			            {
		
				           for($i=0;$i<$count;$i++)
				          {	
					       $db->query("delete from ".TABLE." where student_ID='".$list[$i]."'");
				          }
						   
				        redirect('','dels=1&sort=student_ID desc ');
			             }
			        break;
					
	
} // END SWITCH

		if($ins) $alert = " Course Added successfully ";
		if($upd) $alert = " Course Updated successfully ";
		if($del) $alert = " Record deleted successfully ";
        if($dels) $alert = " Records deleted successfully ";
		

if($add || $edit)
{
   $action = 'insert';
   $TDHEADING = 'Add Certificates';
	if($select_id)
	{
		 $action = 'update';
		 $TDHEADING = 'Edit Certificates';			 
		 $student_id=$select_id;
		 list($description) = $db->fetch_one_row("SELECT  description FROM ".CERTI_MASTER_TABLE." WHERE student_ID='".$select_id."'");
		 
	}
	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));
}
else
{
	$TDHEADING = 'Certificates Listing';
	
		  if($search_txt != '' || $student_id != '')
		  {
			
			 if($search_txt != '')
		{ 
 		   	   $condition= " CONCAT(course_name) like lower('%".$search_txt."%')";
 		}
		
		if($student_id != '')
		{
			if($condition != '' )
 		   	  $condition.= " AND student_ID=".$student_id;
			else  
 		   	   $condition= " student_ID=".$student_id;
 		}
 		
					
			$sql_res = $db->query("SELECT * FROM ".TABLE." WHERE ".$condition);
			$no_of_rows = mysql_num_rows($sql_res);
			
			
			
			if($no_of_rows > '0') 
			{
					if(!$sort) $sort ='certificate_ID desc'; 
		 
			 $query = "SELECT * FROM ".TABLE." WHERE ".$condition." ORDER BY ".$sort;
			 $result1 = mysql_query($query) or die(mysql_error());
			 $no_of_rows = mysql_num_rows($result1);				 
			}
			else
			{
					$alert2 = "No Records !!";
			}
		}
		
		
		else
		{ 
		
			$no_of_rows = $db->get_count(TABLE);
			if($no_of_rows > '0')
			{
				if(!$sort) $sort ='certificate_ID DESC' ;
				
			
				
		$query = "SELECT * FROM ".TABLE." ".$condition." ORDER BY ".$sort;
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