<?php $diocese_id=$_POST['by_id'];
 require('../application_top.php');
define('TABLE',MTABLE.'teachers');
$parish_id= $_POST['by_id'];
?>
<input type="hidden" name="parish_id" id="parish_id" value="<?php echo $parish_id;?>" />
  <select name="parish_teacher_id" id="parish_teacher_id" class="form-control"  >
                  <option value="">--Select Parish Teacher--</option>
                     <?php $teachers_arr=getResultArray("SELECT teacher_ID, name FROM ".MTABLE."teachers WHERE teacher_status = 1  AND parish_ID= ".$parish_id." ORDER BY teacher_ID asc "); 
				 foreach($teachers_arr as $row){
				  ?>
				  <option value="<?php echo $row['teacher_ID'] ;?>" <?php echo (($row['teacher_ID']==$parish_teacher_id)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select>