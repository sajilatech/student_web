<?php
require('../application_top.php');
define('MODULE_TITLE','Admin Index');


if(isset($_SESSION['admin']))
{
	redirect(ADMIN_URL."home.php");
}

if(isset($login))
{
	$result=$db->query("SELECT user_ID FROM ".MTABLE."users where user_status = 1 AND usertype ='".$login_role."' AND password ='".md5($password)."' AND username = '".$username."'");

	$num_rows=$db->num_rows($result); 
		if($num_rows > 0){
			$row=$db->fetch_row($result);
			$user_id=$row[0];
			session_start();
			$_SESSION['userid'] = $user_id;
			$_SESSION['usertype'] = $login_role;
			
		 	//redirect("home.php");
		}
		if($user_id != '')
	  	{ 
		//header("Location: http://google.co.in/");
			redirect("home.php");
						
	  } 
		else
		  {
		      redirect("index.php","err=1");
		  }
		/*else
		{ print_r("not login");
	  		redirect("index.php","err=1");
		}*/
}
else{
define('MAIN_TEMPLATE', DIR_ADMIN_TPL.'index.php');
}

?>
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

	<link rel="stylesheet" href="fonts/font-awesome-4/css/font-awesome.min.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="../../assets/js/html5shiv.js"></script>
	  <script src="../../assets/js/respond.min.js"></script>
	<![endif]-->

	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet" />	
    <script>
	function hideme(ids)
	{
	var brh = document.getElementById('brnchstaffs');	
	var spa = document.getElementById('spadmin');
	
	if(ids == 1)
	{
		brh.style.display = 'block';
		spa.style.display = 'none';
		document.getElementById('username2').value = "";
		document.getElementById('username2Info').innerHTML = "";
		document.getElementById('password2').value = "";
		document.getElementById('password2Info').innerHTML = "";
	}
	else
	{
		spa.style.display = 'block';
		brh.style.display = 'none';
		document.getElementById('brnch_id').value = "";
		document.getElementById('brnch_idInfo').innerHTML = "";
		document.getElementById('username').value = "";
		document.getElementById('usernameInfo').innerHTML = "";
		document.getElementById('password').value = "";
		document.getElementById('passwordInfo').innerHTML = "";
	}
	}
	
	function ChckBranch(theform)
	{
		var why = "";	
		
		if(theform.login_role.value == ""){
			document.getElementById('login_roleInfo').innerHTML = "This is Required !";
			why += "mm";
		}	
		else
		{
			document.getElementById('login_roleInfo').innerHTML = "";
		}
		
		if(theform.brnch_id.value == ""){
			document.getElementById('brnch_idInfo').innerHTML = "This is Required !";
			why += "mm";
		}	
		else
		{
			document.getElementById('brnch_idInfo').innerHTML = "";
		}
		
		if(theform.username.value == ""){
			document.getElementById('usernameInfo').innerHTML = "This is Required !";
			why += "mm";
		}	
		else
		{
			document.getElementById('usernameInfo').innerHTML = "";
		}
		
		if(theform.password.value == ""){
			document.getElementById('passwordInfo').innerHTML = "This is Required !";
			why += "mm";
		}	
		else
		{
			document.getElementById('passwordInfo').innerHTML = "";
		}
		
		if(why != ""){
			return false;
		}
		else
		{
		document.getElementById("frmlogin").submit();
		}
		
		
	}
	
	function ChckSAmin(theform)
	{
		var why2 = "";
		
		if(theform.login_role.value == ""){
			document.getElementById('login_roleInfo').innerHTML = "This is Required !";
			why += "mm";
		}	
		else
		{
			document.getElementById('login_roleInfo').innerHTML = "";
		}
		
		
		
		
		
		if(why2 != ""){
			return false;
		}
		else
		{
		document.getElementById("frmlogin").submit();
		}
		
		
	}
	
	</script>

</head>

<body class="texture" onLoad="hideme(1)">

<div id="cl-wrapper" class="login-container">

	<div class="middle-login">
		<div class="block-flat">
			<div class="header">							
				<h3 class="text-center">Missionary Society of St. Thomas the Apostle</h3>
			</div>
			<div>
				<form style="margin-bottom: 0px !important;" parsley-validate novalidate name="frmlogin" id="frmlogin" class="form-horizontal" method="post" action="index.php">
					<div class="content">
						<h4 class="title">Login Access<?php if($err==1) echo '&nbsp;&nbsp;&nbsp;&nbsp;<font size="2px" color="#FF0000"><b>Invalid Username or Password</b></font>';  ?></h4>
                        
                        <div class="form-group">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-users"></i></span>
                                        <select name="login_role" id="login_role" class="form-control" onChange="hideme(this.value)">
             							<option value="">Select Role</option>
                                        <option value="1">Super Admin</option>
                                        <option value="2">Moderator</option>
              							</select> <div id="login_roleInfo" name="brnch_idInfo" style="color:#cc0000;"></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										<input type="text" placeholder="Username" id="username" name="username" class="form-control">
                                        <div id="usernameInfo"  style="color:#cc0000;"></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-lock"></i></span>
										<input type="password" placeholder="Password" id="password" name="password" class="form-control">
                                         <div id="passwordInfo"  style="color:#cc0000;"></div>
									</div>
								</div>
							</div>
                            
                           <div class="foot">
						<button class="btn btn-primary2" data-dismiss="modal" id="login" name="login" type="submit">Log me in</button>
					</div>
                            
                            </div>
                            
							
					</div>
					
				</form>
			</div>
		</div>
		<!--<div class="text-center out-links"><a href="index.php">&copy; <?php echo date("Y"); ?> LCC</a></div>-->
	</div> 
	
</div>

<script src="js/jquery.js"></script>
<script src="js/jquery.parsley/parsley.js" type="text/javascript"></script>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.flot/jquery.flot.js"></script>
<script type="text/javascript" src="js/jquery.flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/jquery.flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="js/jquery.flot/jquery.flot.labels.js"></script>
</body>
</html>
