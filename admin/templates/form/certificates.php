<?php //include("../includes/fancy_box.php");  ?>
<script type = "text/javascript" language = "javascript">
function delete_image(by_id,path,container){
		var ans=confirm("Do you want to Delete this item?");
		if(ans==true){
			 $.ajax({
									type:'POST',
									url:path,
									data:{'by_id':by_id },
									success: function(option_tags) {
										
										$('#'+container).html(option_tags);
										 location.reload();
									}
							});
		}
		else{
			return false;	
		}
		
	
	
	}
	</script>
    <script>
	
	function check_file_type(){ 
	var x = document.getElementById("FilUploader");
	
	var files = x.files;
	var file_type = files[0].type; 
	//var name = files[0].name; 
		if (!(file_type ==='application/pdf')) {
				alert("Please upload pdf file only");
				$('#FilUploader').attr({ value: '' });
				return false;
           	
            }
			else{ return true;}
	
		//alert($('input[name="files[]"]').eq(0).val());
	}
	
	/* $("#FilUploader").change(function () { alert("KKKKK");
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
        }
    });*/
</script>
<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Student MGT</a></li>
                 <li><a href="certificates.php">Certificates Lisitng</a></li>
				  <li class="active">Certificates</li>
				</ol>
			</div>
    <div class="cl-mcont">
    
    <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $TDHEADING; ?></h3><span style="float:right; margin-top:5px"><a class="label label-default" href="certificates.php"><i class="fa fa-reply"></i> &nbsp;Back</a></span>
          </div>
          <div class="content">
           <?php if($alert != '') { ?> 
           <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $alert; ?>
							 </div>
          <?php } if($mssg != '') { ?>
           <div class="alert alert-info alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-info-circle"></i></div>
								<strong>Info!</strong> <?php echo $mssg; ?>
							 </div>
          <?php } ?>
             <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="certificates.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;" onsubmit="return validate();">
             <?php if(isset($retur)){?>
				 <input type="hidden" name="retur" value="<?php echo $retur; ?>">
                 <?php
			 }
			 ?>
             <input type="hidden" name="select_id" value="<?php echo $select_id; ?>">
			 <input type="hidden" name="doaction" value="<?php echo $action; ?>">
             
             
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Student Name  </label>
                <div class="col-sm-6">
                   <select name="student_id" id="student_id" class="form-control" required>
                   <option value="">--Select Student Name--</option>
                     <?php
					 $student_arr=getResultArray("SELECT student_ID, name FROM ".MTABLE."students WHERE student_status = 1  ORDER BY student_ID asc "); 
   foreach($student_arr as $row)
   {
	  ?><option value="<?php echo $row['student_ID'];?>" <?php if($row['student_ID']==$student_id){ echo 'selected="selected"'; }?>><?php echo $row['name'];?></option>
      <?php
   }
   ?>
                  </select>			
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Upload multiple Certificates </label>
                <div class="col-sm-6">
                <I>(Upload certificates only in PDF Format)</I>
                  <input type="file" name="files[]" multiple id="FilUploader" onchange="return check_file_type();">      
           <!-- <input type="file" id="multiFiles" name="files[]" multiple="multiple"/> <div id="upload" class="btn btn-primary">Upload</div>  <p id="msg"></p>-->
           <?php if($action == 'update'){ 
		   $certificates_arr=getResultArray("SELECT  certificate_ID, file_name FROM ".MTABLE."student_certificates WHERE student_ID = $select_id  ORDER BY certificate_ID asc "); 
		  
		   if(!empty($certificates_arr)){
		   ?>
           </br>
           <?php 
		   	foreach($certificates_arr as $certi_row){ 
				//echo "../../uploads/".$certi_row['file_name'];
		   ?>
           <a class="fancybox" data-fancybox-group="gallery" href='<?php echo '../'.UPLOADS."/certificates/".$certi_row['file_name']?>' target="_blank" ><?php echo $certi_row['file_name'];?></a> <a data-placement="top" data-toggle="tooltip" data-original-title="Delete" class="label label-danger" onclick="delete_image('<?php echo $certi_row['certificate_ID'];?>','../ajax/delete_image.php','divDelete')"><i class="fa fa-times"></i></a><div id="divDelete"></div></br>
           <?php
		   	}
		   }// not empty close
		   }
		   ?>

<a href="path-to-my.pdf" target="_blank"></a>


             </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Descriptions</label>
                <div class="col-sm-6">
                <textarea class="ckeditor form-control" name="description" id="description"><?php echo $description; ?></textarea>
                 
                </div>
              </div>
               <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
               <!-- <button type="reset" class="btn btn-default">Reset</button>-->
              </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    </div>
  </div>