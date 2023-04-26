<?php
$by_id=$_POST['by_id']; 

if($by_id=='1'){
?>

 <label class="col-sm-3 control-label">Incoming Phone Number  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="phone_no" id="phone_no" required title="Incoming Phone No."  class="form-control">
                </div>
<?php
}
else if($by_id=='2'){?>
<label class="col-sm-3 control-label">Outgoing Phone Number  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="phone_no" id="phone_no" required title="Outgoing Phone No."  class="form-control">
                </div>

<?php
}
?>