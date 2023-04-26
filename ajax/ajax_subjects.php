<?php $no_of_subjects=$_POST['by_id'];

?>
<!--<td colspan="2"><table width="100%">-->
 <tr>
        <td class="headview">Subject</td>
        <td class="headview">Mark</td>
        </tr>
<?php for($i=1; $i<=$no_of_subjects; $i++){?>
<tr>
    <td><input id="subjects_<?php echo $i;?>" class="form-control" name="subjects_<?php echo $i;?>" required title="Subjects"  type="text"></td>
    <td><input id="marks_<?php echo $i;?>" class="form-control" name="marks_<?php echo $i;?>" required title="Marks"  type="text"></td>
  </tr>
  <?php
}
?>
  <!--</table>
  </td>-->