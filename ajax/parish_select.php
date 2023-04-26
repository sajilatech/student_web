<?php $diocese_id=$_POST['by_id'];
 require('../application_top.php');
define('TABLE',MTABLE.'parish');?>

  <td>Parish</td>
    <td> <select name="parish_id" id="parish_id" class="form-control" required  >
                  <option value="">--Select Parish--</option>
                     <?php 
					  $parish_arr=getResultArray("SELECT * FROM ".MTABLE."parish WHERE parish_status = 1  AND diocese_ID= '".$diocese_id."' ORDER BY parish_ID asc "); 
				 foreach($parish_arr as $row){
				  ?>
				  <option value="<?php echo $row['parish_ID'] ;?>" <?php echo (($row['parish_ID']==$parish_id)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select></td>