<?php require('../application_top.php');
$by_id=$_POST['by_id'];
if($by_id=='parish'){ 
	define('TABLE',MTABLE.'parish');
	$data =  $_POST['info'];
	$diocese =  $_POST['second_id'];
	$sql_data_array = array(
						 'name' => $data[0],
						 'vicari'=> $data[1],
						 'phone'=>  $data[2],
						 'vicari_address'=> $data[3],
						 'diocese_ID'=> $diocese,
						 'description'=>0,
						 'added_date' => time());

						 $db->insert_from_array($sql_data_array,TABLE);
						  $parish_arr=getResultArray("SELECT parish_ID, name FROM ".MTABLE."parish WHERE parish_status = 1  AND diocese_ID= ". $diocese." ORDER BY parish_ID desc "); 	

 ?>
						 <select name="parish_id" id="parish_id" class="form-control" style="width:85%;"  >
                  <option value="">--Select Parish--</option>
                     <?php 
					 
				 foreach($parish_arr as $row){
				  ?>
				  <option value="<?php echo $row['parish_ID'] ;?>" <?php echo (($row['parish_ID']==$parish_id)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select>
 <?php }
 else if($by_id=='parish_teacher'){
	 define('TABLE',MTABLE.'teachers'); 
	 $data =  $_POST['info'];
	$parish =  $_POST['second_id'];
	 $sql_data_array = array(
						 'name' => $data[0],
						 'email'=>$data[1],
						 'phone'=>$data[2],
						 'address'=> $data[3],
						 'parish_ID'=> $parish,
						 'added_date' => time());
						 $db->insert_from_array($sql_data_array,TABLE);	
 
 ?>
  <select name="parish_teacher_id" id="parish_teacher_id" class="form-control"    >
                  <option value="">--Select Parish Teacher--</option>
                     <?php $teachers_arr=getResultArray("SELECT teacher_ID, name FROM ".MTABLE."teachers WHERE teacher_status = 1 AND parish_ID= ".$parish." ORDER BY teacher_ID desc "); 
				 foreach($teachers_arr as $row){
				  ?>
				  <option value="<?php echo $row['teacher_ID'] ;?>" <?php echo (($row['teacher_ID']==$parish_teacher_id)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select>
 
 
 <?php
 }
 else if($by_id=='vp_details'){ 
	  define('TABLE',MTABLE.'vp'); 
	   $data =  $_POST['info'];
	    $sql_data_array = array(
						 'vp_name' => $data[0],
						 'vp_phone'=>$data[1],
						 'vp_address'=>$data[2],
						 'vp_whatsup'=> $data[3],
						 'vp_fb'=> $data[4]
						 );
						 $db->insert_from_array($sql_data_array,TABLE);	
						 $insert_id = $db->insert_id();
?>
<input type="hidden" name="vp_id" id="vp_id" value="<?php echo $insert_id;?>" />
<?php
 }
 ?>