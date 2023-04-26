<div id="head-nav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" target="_blank" href="<?php echo ADMIN_URL; ?>">Missionary Society of St. Thomas</a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="fa fa-gear"></span>
        </button>
        
      </div>
      <div class="navbar-collapse collapse">
        
    <ul class="nav navbar-nav navbar-right user-nav" style="background-color:#03b5a7 !important;">
      <li class="dropdown profile_menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php if($_SESSION['usertype'] == 1) { echo 'Super Admin'; } else { echo 'Hi Moderator '; } ?>  <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="logout.php">Sign Out</a></li>
        </ul>
      </li>
    </ul>			

      </div><!--/.nav-collapse -->
    </div>
  </div>