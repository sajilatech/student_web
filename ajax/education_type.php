 <?php $by_id=$_POST['by_id'];
 
 if($by_id=='3'){
 ?>
 <label class="col-sm-3 control-label">Degree </label>
                <div class="col-sm-6">
                  <input type="text" name="degree" id="degree"  title="Degree"  class="form-control">
                </div>
                
                <?php
 }
 else{
	 echo ' <input type="hidden" name="degree" id="degree"   value="0">';
	 }
 ?>