
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Carry-Catalog</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="<?php echo $user_data['username'];?>"><strong><i class="glyphicon glyphicon-user"></i></strong> <?php echo $user_data['first_name'];?></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Edit Info <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="changepassword.php">Change Password</a></li>
                <li><a href="settings.php">Update Personal Info</a></li>
                <li><a href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage Site <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Manage Users</li>
                <li><a href="index.php?users">View Users</a></li>
                
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right"><!--login form-->
            <li><a href="register.php" title="Add User"><strong><i class="glyphicon glyphicon-plus"></i><i class="glyphicon glyphicon-user"></i></strong></a></li>
            <li><a href="logout.php"><strong><i class="glyphicon glyphicon-log-out"></i> Log Out</strong></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Begin page content -->
    <div class="container">
