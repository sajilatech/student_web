<?php require('../application_top.php');

$siblings_no=$_POST['by_id'];
$exist_sibling=$_POST['exist_sibling'];
$count_limit=$siblings_no - $exist_sibling;
for($i=1;$i<=$siblings_no;$i++){
?>
 <tr><td>Sibling <?php echo $i;?> Name</td>
  <td colspan="2"><input id="sibling_name_<?php echo $i;?>" class="form-control" name="sibling_name_<?php echo $i;?>"  title="Name"  type="text"></td></tr>
    <tr><td>Age</td>
  <td colspan="2"><input id="age_<?php echo $i;?>" class="form-control" name="age_<?php echo $i;?>"  title="Age"  type="text"></td></tr>
  <tr><td>Relation </td><td colspan="2"><select name="relation_with_student<?php echo $i;?>" id="relation_with_student<?php echo $i;?>" class="form-control" >
                  <option value="">--Select Relation--</option>
                 <option value="brother">Brother</option>
                 <option value="sister">Sister</option>
                  </select></td></tr>
                  <tr><td>Education</td><td colspan="2"><input id="education_<?php echo $i;?>" class="form-control" name="education_<?php echo $i;?>"  title="Name"  type="text"></td></tr>
                   <tr><td>Occupation</td><td colspan="2"><input id="occupation_<?php echo $i;?>" class="form-control" name="occupation_<?php echo $i;?>"  title="Name"  type="text"></td></tr>
                   <?php
}
?>