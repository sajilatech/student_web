 <?php
 $by_id=$_POST['by_id'];
 if($by_id=='3'){?>
 
 <label class="col-sm-3 control-label">Degree  <span style="color:#F00;">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="degree" id="degree" required title="Level" value="<?php echo $degree; ?>" class="form-control">
                </div>
                <?php
 }
 ?>