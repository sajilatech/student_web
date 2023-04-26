 <?php $by_id = $_POST['by_id'];
 require('../application_top.php');
 ?>
  <td colspan="2"><?php
for($i=1;$i<=$by_id;$i++){?>
<table  border="1" bordercolor="#333333"  cellspacing="2">
  <tr><td>Name</td><td><input id="sibling_name_<?php echo $i;?>" class="form-control" name="sibling_name_<?php echo $i;?>"  title="Name"  type="text"></td></tr>
  <tr><td>Relation </td><td><select name="relation_with_student<?php echo $i;?>" id="relation_with_student<?php echo $i;?>" class="form-control" >
                  <option value="">--Select Relation--</option>
                 <option value="brother">Brother</option>
                 <option value="sister">Sister</option>
                  </select></td></tr>
                   <tr><td>Occupation</td><td><input id="occupation_<?php echo $i;?>" class="form-control" name="occupation_<?php echo $i;?>"  title="Name"  type="text"></td></tr>
                  </table>
  <?php
 }
 ?></table></td>