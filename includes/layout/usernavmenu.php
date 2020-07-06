
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
          <a class="navbar-brand" href="index.php">Carry-Catalog</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="<?php echo $user_data['username'];?>"><strong><i class="glyphicon glyphicon-user"></i></strong> <?php echo $user_data['first_name'];?></a></li>
            <!-- <li><a href="contact.php">Contact Admin</a></li> -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Edit Info <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="changepassword.php">Change Password</a></li>
                <li><a href="settings.php">Update Personal Info</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Store Info <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Stores</li>
                <li><a href="index.php?astore">Add Store</a></li>
                <li><a href="index.php?ustore">Update Store</a></li>
                <li><a href="index.php?dstore">Delete Store</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Products</li>
                <li><a href="index.php?aprod">Add Product</a></li>
                <li><a href="index.php?uprod">Update Product</a></li>
                <li><a href="index.php?dprod">Delete Product</a></li>
              
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right"><!--logout-->
            <li><a href="logout.php"><strong><i class="glyphicon glyphicon-log-out"></i> Log Out</strong></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Begin page content -->
    <div class="container">
