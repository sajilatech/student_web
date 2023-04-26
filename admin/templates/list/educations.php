<div class="container-fluid" id="pcont">
			<div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#">Educations</a></li>
				  <li class="active">Educations Listing</li>
				</ol>
			</div>	
		<div class="cl-mcont">
         
         <div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Search</h3>
						</div>
						<div class="content">
							<div class="table-responsive">
                            <form role="form" method="post" action="educations.php">  
							<table class="table no-border hover">
								<thead class="no-border">
									<tr>
										<th style="width:5%;">Keyword</th>
										<th style="width:30%;"><input type="text" id="search_txt" name="search_txt" class="form-control"></th>
										
									
                                   <th style="width:8%;">Students</th>
										<th style="width:30%;"><select name="student_id" id="student_id" class="form-control" >
                  <option value="">--Select Student--</option>
                     <?php $student_arr=getResultArray("SELECT student_ID, name FROM ".MTABLE."students WHERE student_status = 1  ORDER BY student_ID asc "); 
				 foreach($student_arr as $row){
				  ?>
				  <option value="<?php echo $row['student_ID'] ;?>" <?php echo (($row['student_ID']==$student_id)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select></th>
                                   
                                   
									</tr>
                                    <tr> <tr>
										<th style="width:5%;">Education Type</th>
										<th style="width:30%;"><select name="education_type" id="education_type" class="form-control"  onchange="ajax_education_type('../ajax/education_type.php','displayEducation')">
                  <option value="">--Select Education Type--</option>
               <?php  foreach($type_of_education_list as $key=>$value){
				  ?>
				  <option value="<?php echo $key ;?>" <?php echo (($key==$education_type)?'selected="selected"':'') ?> ><?php echo $value; ?></option>
				     <?php } ?>
                  </select></th>
                                     </tr>
                                    <tr><th style="width:2%;"></th>
										<th style="width:30%;"><button class="btn btn-primary" type="submit">Search</button></th></tr>
								</thead>
								
							</table>
                            </form>		
							</div>
						</div>
					</div>				
				</div>
			</div>
		
		 <div class="row">
				<div class="col-md-12">	
                
					<div class="block-flat">
						<div class="header">							
							<h3><?php echo $TDHEADING; ?></h3>
                           <?php if($alert2 != '') { ?>
                             <div class="alert alert-warning alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-warning"></i></div>
								<strong>Alert!</strong> <?php echo $alert2; ?>
							 </div>
							 </div>
                            <?php } ?>
                            <?php if($alert != '') { ?>
                             <div class="alert alert-success alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-check"></i></div>
								<strong>Success!</strong> <?php echo $alert; ?>
							 </div>
                             </div>
                            <?php } ?>
						
                         <div class="pull-left" style="padding-bottom:10px"><div class="dataTables_info" id="datatable_info">
                            <a href="educations.php?add=1"><div class="btn-group"><button class="btn btn-sm btn-success" type="button"><i class="fa fa-plus-square"></i></button><button class="btn btn-sm btn-default" type="button">Add New</button></div></a>                            
                            <a style="cursor:pointer;" onclick="return confirm_delete(document.eventform.list,document.eventform,<?php echo $no_of_rows; ?>)"><div class="btn-group"><button class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash-o"></i></button><button class="btn btn-sm btn-default" type="button">Delete All</button></div></a>
                           <!-- <a style="cursor:pointer;" onclick="return confirm_delete(document.eventform.list,document.eventform,<?php echo $no_of_rows; ?>,3)"><div class="btn-group"><button class="btn btn-sm btn-success" type="button"><i class="fa fa-check"></i></button><button class="btn btn-sm btn-default" type="button">Publish All</button></div></a>
                            <a style="cursor:pointer;" onclick="return confirm_delete(document.eventform.list,document.eventform,<?php echo $no_of_rows; ?>,4)"><div class="btn-group"><button class="btn btn-sm btn-danger" type="button"><i class="fa fa-ban"></i></button><button class="btn btn-sm btn-default" type="button">Unpublish All</button></div></a>        -->                   
                            </div></div>
						<div class="content">
                       
							<div class="table-responsive">
                            <form name="eventform" method="post" action="educations.php?doaction=deleterecord">
								<table class="table table-bordered" id="datatable" >
									<thead>
										<tr>
                                            <th><input name="checkme" id="checkme" type="checkbox" onclick="make_selection(document.eventform)"></th>
											<th>Sl No</th>
                                            <th>Type of Education</th>
                                            <th>Name of Institution</th>
											<th>Students</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                       <?php  
$count_no = 0;
if($no_of_rows) 
{
while($row = mysql_fetch_array($result1)) {
 $count_no++;
  $student_row = getRowByID(MTABLE."students",'student_ID',$row['student_ID'],"");
?>
                                    
										<tr class="gradeA <?php if($count_no%2!=0) { echo 'class="odd"'; } else { echo 'class="even"'; } ?>">
										<td><input name="list[]" id="list<?php echo $count_no; ?>" class="chkbx" value="<?php echo $row['education_ID']; ?>" type="checkbox"></td>
                                            <td><?php echo $count_no; ?></td>
                                              <td><?php foreach($type_of_education_list as $key=>$value){ if ( $row['education_type']==$key){ echo $value;}} ?></td>
                                            <td><?php echo $row['institution_name']; ?></td>
										  <td><?php echo $student_row['name']; ?></td>
											<td><a data-placement="top" data-toggle="tooltip" data-original-title="Edit" class="label label-primary" href="educations.php?edit=1&select_id=<?php echo $row['education_ID'];?>"><i class="fa fa-pencil"></i></a>
                                            <a data-placement="top" data-toggle="tooltip" data-original-title="Delete" class="label label-danger" href="educations.php?doaction=delete&select_id=<?php echo $row['education_ID'];?>"><i class="fa fa-times"></i></a>
                                            <a  href="educations_view.php?select_id=<?php echo $row['education_ID'];?>"><span class="badge">View</span></a></td>
                                            	

										</tr>
<?php } } ?>										
									</tbody>
								</table>	
                                </form>						
							</div>
						</div>
					</div>				
				</div>
			</div>
			
		  </div>
		</div>
<script language="javascript">
function confirm_delete(field,form_name,cnt,vl)
{
	
var a=new Array();
a=document.getElementsByName("list[]");
var p=0;
	for(i=0;i<a.length;i++){
		if(a[i].checked){
			p=1;
		}
	}
		
		if(p == 0) 
		{
			alert('Please Select the records you want to delete!');
			return false;
		}
		else
		{
			if(vl == 3)
			{
				if(confirm("Are you sure to Publish these records?"))
				{
				form_name.action = "educations.php?doaction=publish";
				form_name.submit();
				}
				else
				return false;
			}
			
			else if(vl == 4)
			{
				if(confirm("Are you sure to Unpublish these records?"))
				{
				form_name.action = "educations.php?doaction=unpublish";
				form_name.submit();
				}
				else
				return false;
			}
			else
			{
				if(confirm("Are you sure to delete the records?"))
				form_name.submit();
				else
				return false;
			}
		}
		
	}
</script>        