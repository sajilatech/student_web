<?php
require('../application_top.php');

define('MODULEID','3');

define('MODULE_TITLE','Confidentail Reports');

require(DIR_ADMIN_INCLUDE.'session.php');

define('TABLE',MTABLE.'confidential_reports');
define('CREPORTS_ATTACH_TABLE',MTABLE.'creports_attach');

$GrpPage = 3;



#################### 

# Actions

$config = array(
  'upload_path' => '../'.UPLOADS.'/confidential_reports_scan/', // This is a directory to save our images
  'thumbnail_path' => '../'.UPLOADS.'/confidential_reports_scan/', // This is a directory to save our thumbnails
  'max_width' => 500, // Width of our thumbnail
  'max_height' => 500, // Height of our thumbnail
  'imagemagick_path' => '/usr/bin/' // The path to 'convert' or 'convert.exe'
 );	
$config_attachments = array(
  'upload_path' => '../'.UPLOADS.'/confidential_reports_attachments/', // This is a directory to save our images
  'thumbnail_path' => '../'.UPLOADS.'/confidential_reports_attachments/', // This is a directory to save our thumbnails

  'imagemagick_path' => '/usr/bin/' // The path to 'convert' or 'convert.exe'
 );	
switch($doaction)

{

	case 'insert':

						
						 $sql_data_array = array(
						 'student_ID' => $student_id,
						 'title' => $title,
						 'interview_comments'=>$interview_comments,
						//  'interview_results'=>$interview_results,
						 'interviewed_by' =>$interviewed_by,
						 'psychological_results' => $psychological_results,
						 'description' => $description
						
						);

						 $db->insert_from_array($sql_data_array,TABLE);	

						$insert_id = $db->insert_id();
						 $scan_img=$_FILES['scan']['name'];
						upload_files('scan' ,$config['upload_path']);
							$creports_attachments=array('type'=>'scan', 'file'=>$scan_img, 'creport_ID'=>$insert_id);
							 $db->insert_from_array($creports_attachments,CREPORTS_ATTACH_TABLE);	
						
						$attach_doc=$_FILES['attachments']['name'];
						upload_files('attachments' ,$config_attachments['upload_path']);
							$creports_attach=array('type'=>'attachments', 'file'=>$attach_doc, 'creport_ID'=>$insert_id);
							 $db->insert_from_array($creports_attach,CREPORTS_ATTACH_TABLE);	
						
 				redirect('confidential_reports.php','');

				   break;



	case 'update': 

				    if((int)$select_id == 0) redirect();

					
 						$sql_data_array = array(
						 'student_ID' => $student_id,
						 'interview_comments'=>$place,
						 'interviewed_by' =>$interviewed_by,
						 'psychological_results' => $psychological_results,
						 'remarks' => $remarks,
						 'scan' => $scan,
						 'attachments' => $attachments
						);

					 

					  $db->update_from_array($sql_data_array,TABLE,'creport_ID', $select_id);

					  

						 redirect('','upd=1&sort=creport_ID desc ');

						

					break;

				

	case 'delete':

							$db->query("delete from ".TABLE." where creport_ID='".$select_id."'");

							redirect('confidential_reports.php', '');						

							break;

			

			

case 'deleterecord' :	

	                   $count=count($list);



			           if($count > 0)

			            {

				           for($i=0;$i<$count;$i++)

				          {	

					       $db->query("delete from ".TABLE." where creport_ID='".$list[$i]."'");

				          }

						   

				        redirect('','dels=1&sort=creport_ID desc ');

			             }

			        break;

					

case 'publish' :

	                   $count=count($list);



			           if($count > 0)

			            {

		

				           for($i=0;$i<$count;$i++)

				          {

						 $db->query("UPDATE ".TABLE." SET brnch_status = 1, brnch_updated_date ='".time()."' WHERE creport_ID =".$list[$i]."");		  

				          }

						   

				        redirect('','upd=1&sort=creport_ID desc ');

			             }

			        break;

					

case 'unpublish' :	

	                   $count=count($list);



			           if($count > 0)

			            {

		

				           for($i=0;$i<$count;$i++)

				          {

					        $db->query("UPDATE ".TABLE." SET brnch_status = 2, brnch_updated_date ='".time()."' WHERE appointment_ID =".$list[$i]."");	

				          }

						   

				        redirect('','upd=1&sort=creport_ID desc ');

			             }

			        break;			

	

} // END SWITCH



		if($ins) $alert = " Confidential Reports Added successfully ";

		if($upd) $alert = " Confidential Reports Updated successfully ";

		if($del) $alert = " Record deleted successfully ";

        if($dels) $alert = " Records deleted successfully ";

		



if($add || $edit)

{

   $action = 'insert';

   $TDHEADING = 'Add Confidential Reports';



	if($select_id)

	{

		 $action = 'update';

		 $TDHEADING = 'Edit Confidential Reports';			 

		  list($creport_id, $student_id, $title, $interview_comments, $interviewed_by, $psychological_results, $description ) = $db->fetch_one_row("SELECT creport_ID, student_ID, title, interview_comments,  interviewed_by, psychological_results, description FROM ".TABLE." WHERE creport_ID='".$select_id."'");
  list($scan ) = $db->fetch_one_row("SELECT file FROM ".CREPORTS_ATTACH_TABLE." WHERE creport_ID='".$select_id."' AND type= 'scan'");
   list($attachments ) = $db->fetch_one_row("SELECT file FROM ".CREPORTS_ATTACH_TABLE." WHERE creport_ID='".$select_id."' AND type= 'attachments'");


	}

	define('MAIN_TEMPLATE', DIR_FORM.basename($_SERVER['PHP_SELF']));

}

else

{

	$TDHEADING = 'Confidential Reports Listing';

	

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
				
						if(!$sort) $sort ='creport_ID desc'; 
				
				
				
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

				if(!$sort) $sort ='creport_ID DESC' ;
				
				

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