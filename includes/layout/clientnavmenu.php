
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
          <a class="navbar-brand" href="index.php">Carry-Cat</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">View Catalog <span class="caret"></span></a>
              <ul class="dropdown-menu">       
                <li class="dropdown-header">Products</li>
                <li role="separator" class="divider"></li>
                <li><a href="index.php?products">View All Products</a></li>
                <li><a href="index.php?recent">Recently Added</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right"><!--login form-->
            <form class="navbar-form navbar-left" action="login.php" method="POST" role="search">
              <li>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" name="username" placeholder="Username" ariadescribedby="basic-addon1">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" class="form-control" name="password" placeholder="Password" ariadescribedby="basic-addon1">
                  </div>
                  <button type="submit" class="btn btn-primary">Log In</button>
                </div>
              </li>
            </form>
            <form class="navbar-form navbar-left" action="recover.php">
              <li>
                <button type="submit" class="btn btn-info" title="Recover Details"><i class="glyphicon glyphicon-repeat"></i></button>
              </li>
            </form>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Begin page content -->
    <div class="container">
