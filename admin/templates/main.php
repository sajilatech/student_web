<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Missionary Society of St. Thomas - ADMIN PANEL</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>

	<!-- Bootstrap core CSS -->
	<link href="js/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="js/jquery.gritter/css/jquery.gritter.css" />
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

	<link rel="stylesheet" href="fonts/font-awesome-4/css/font-awesome.min.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="../../assets/js/html5shiv.js"></script>
	  <script src="../../assets/js/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="js/jquery.nanoscroller/nanoscroller.css" />
	<link rel="stylesheet" type="text/css" href="js/jquery.easypiechart/jquery.easy-pie-chart.css" />
	<link rel="stylesheet" type="text/css" href="js/bootstrap.switch/bootstrap-switch.css" />
	<!--<link rel="stylesheet" type="text/css" href="js/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css" />-->
	<link rel="stylesheet" type="text/css" href="js/jquery.select2/select2.css" />
	<link rel="stylesheet" type="text/css" href="js/bootstrap.slider/css/slider.css" />
    <link rel="stylesheet" type="text/css" href="js/jquery.datatables/bootstrap-adapter/css/datatables.css" />
	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet" />	
    <script src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-1.8.3.min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="js/reCopy.js"></script>
     <script type="text/javascript" src="includes/ckeditor/ckeditor.js"></script>
    <script src="js/jquery.parsley/parsley.js" type="text/javascript"></script>
     <script language="JavaScript" type="text/JavaScript">   
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
	} // AJAX HTTP CODE
	
function getStatus(strURL,Loadingdivs) {	
		
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					//alert(req.responseText);
					if (req.status == 200) {						
						document.getElementById(Loadingdivs).innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}  // AJAX CODE TO LOAD ADVERTISEMENT
	
function closePrint () {
  document.body.removeChild(this.__container__);
}

function setPrint () {
  this.contentWindow.__container__ = this;
  this.contentWindow.onbeforeunload = closePrint;
  this.contentWindow.onafterprint = closePrint;
  this.contentWindow.print();
}

function printPage (sURL) {
  var oHiddFrame = document.createElement("iframe");
  oHiddFrame.onload = setPrint;
  oHiddFrame.style.visibility = "hidden";
  oHiddFrame.style.position = "fixed";
  oHiddFrame.style.right = "0";
  oHiddFrame.style.bottom = "0";
  oHiddFrame.src = sURL;
  document.body.appendChild(oHiddFrame);
}	
	
</script>
</head>

<body<?php if($pymtid != '') { ?> onLoad="printPage('receipt_prints.php?pymtid=<?php echo $pymtid; ?>')" <?php } ?>>

  <!-- Fixed navbar -->
<?php require(DIR_ADMIN_TPL.'top_menu.php');  ?> 

<div id="cl-wrapper">
<?php require(DIR_ADMIN_TPL.'menu.php');  ?>		

<?php require(MAIN_TEMPLATE); ?> 
	
</div>
	<script type="text/javascript" src="js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
	<script type="text/javascript" src="js/jquery.sparkline/jquery.sparkline.min.js"></script>
	<script type="text/javascript" src="js/jquery.easypiechart/jquery.easy-pie-chart.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
	<script type="text/javascript" src="js/behaviour/general.js"></script>
  <script src="js/jquery.ui/jquery-ui.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.nestable/jquery.nestable.js"></script>
	<script type="text/javascript" src="js/bootstrap.switch/bootstrap-switch.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    
  <script src="js/jquery.select2/select2.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.gritter/js/jquery.gritter.min.js"></script>
	<script type="text/javascript" src="js/jquery.datatables/jquery.datatables.min.js"></script>
	<script type="text/javascript" src="js/jquery.datatables/bootstrap-adapter/js/datatables.js"></script>
   


    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.dataTables();
      });
	  
	  $('#datatable').dataTable( {
  "serverSide": true
} );
    </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript" src="js/jquery.flot/jquery.flot.js"></script>
	<script type="text/javascript" src="js/jquery.flot/jquery.flot.pie.js"></script>
	<script type="text/javascript" src="js/jquery.flot/jquery.flot.resize.js"></script>
	<script type="text/javascript" src="js/jquery.flot/jquery.flot.labels.js"></script>
  </body>
</html>
<script type="text/javascript">


function make_selection(form_name)
{

	if((document.eventform.checkme.checked) == true)

	{

		checkAll(form_name.list,form_name);	

	}

	else

	{

		uncheckAll(form_name.list,form_name)	

	}
}

function make_selection_bottom(form_name)
{

	if((form_name.checkme_bottom.checked) == true)

	{

		checkAll(form_name.list,form_name);	

	}

	else

	{

		uncheckAll(form_name.list,form_name)	

	}}

function checkAll(field)
{ 
$('.lbl_checkbox').removeClass('lbl_checkbox').addClass('lbl_checkbox_checked');
$(".chkbx").attr('checked', true);
}

function uncheckAll(field)
{
	
$('.lbl_checkbox_checked').removeClass('lbl_checkbox_checked').addClass('lbl_checkbox');
$(".chkbx").removeAttr('checked');
}

//in this line of code, to display the datetimepicker,  we used ‘form_datetime’ as an argument to be 
//passed in javascript. This is for Date and Time.
//this is for Date only	
 	$('.form_date').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
</script>
