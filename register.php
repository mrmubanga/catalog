<?php
include 'core/init.php';
protect_page();
admin_protect();
include 'includes/layout/header.php';
include 'includes/layout/adminnavmenu.php';

$f1 = "";
$f2 = "";
$f3 = "";
$f4 = "";
$f5 = "";
$f6 = "";

if (empty($_POST) === false) {
  if (!isset($_POST['captch'])) {
    $_SESSION['secure'] = rand(1000,9999);
  }else{
    if (!empty($_POST['captch'])){
      if ($_SESSION['secure']== $_POST['captch']) {
        $un = $_POST['username'];
        $p = $_POST['password'];
        $pa = $_POST['password_again'];;
        $fn = $_POST['first_name'];
        $ln = $_POST['last_name'];
        $em = $_POST['email'];
        $required_fields = array('username','password','password_again','first_name','email');
        foreach ($_POST as $key => $value) {
          if (empty($value) && in_array($key, $required_fields) ===true) {
            $errors[] = 'Fields marked with * are required';
            break;
          }
        }
        if (empty($errors) === true) {
          if (user_exists($_POST['username']) === true) {
            $errors[] = 'Sorry username '.$_POST['username'].' already exists';
            $un = "";
          }
          if (preg_match("/\\s/", $_POST['username']) == true) {
            $errors[] = 'Your user name must not contain a space';
            $un = "";
          }
          if (strlen($_POST['password'])< 6) {
            $errors[] = 'Password must be atleast 6 characters';
            $p ="";
            $pa ="";
          }
          if ($_POST['password'] !== $_POST['password_again']) {
            $errors[] = 'Your passwords do not match';
            $p ="";
            $pa ="";
          }
          if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'Valid email required';
            $em = "";
          }
          if (email_exists($_POST['email']) === true) {
            $errors[]= 'Email \''.$_POST['email'].'\' already in use';
            $em = "";
          }
        }
        $f1=$un;
        $f2=$p;
        $f3=$pa;
        $f4=$fn;
        $f5=$ln;
        $f6=$em;
      }else{
        $errors[] = 'Captcha Mismatch';
        $_SESSION['secure'] = rand(1000,9999);
        }
    }else{
      $errors[] = "All fields marked with * are required";
    }
  }
}elseif(!isset($_POST['captch'])){
  $_SESSION['secure'] = rand(1000,9999);
}else{
  $_SESSION['secure'] = rand(1000,9999);
}
?>

<h1>Register User</h1>

<?php
if (isset($_GET['success'])&& empty($_GET['success'])) {
  echo "<div class=\"alert alert-success\" role=\"alert\"><i class=\"glyphicon glyphicon-ok-sign\"></i> Registration Successful</div>";
  echo "<br/>";
  echo "<p><a href='index.php'><button class='btn btn-success'>Home</button></a></p>";
}else{
  if (empty($_POST) === false && empty($errors) === true) {
    $register_data = array('username' => $_POST['username'],
          'password' => $_POST['password'],
          'first_name' => $_POST['first_name'],
          'last_name' => $_POST['last_name'],
          'email' => $_POST['email'],
    );
      register_user($register_data);
              if (header('Location:register.php?success')) {
              exit();
              }else{
                echo '<script type="text/javascript">';
                echo 'window.location.href="register.php?success";';
                echo '</script>';
                echo '<noscript>';
                echo '<meta http-equiv="refresh" content="0;url=register.php?success" />';
                echo '</noscript>'; 
                exit; 
              }
  }else if (empty($errors) === false){
    echo "<div class=\"alert alert-danger\" role=\"alert\">".output_errors($errors)."</div>";
    $_SESSION['secure'] = rand(1000,9999);
  }
?>
<form class="navbar-form navbar-left" action="register.php" method="POST">
    <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-user"></i> *</span>
        <input type="text" class="form-control" name="username" placeholder="Username" ariadescribedby="basic-addon1" autofocus="autofocus" value="<?php echo $f1;?>">
        <br/>
      </div>
    </div>
    <br/>
    <br/>
    <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-lock"></i> *</span>
        <input type="password" class="form-control" name="password" placeholder="Password" ariadescribedby="basic-addon1" autofocus="autofocus" value="<?php echo $f2;?>">
        <br/>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-lock"></i> *</span>
        <input type="password" class="form-control" name="password_again" placeholder="Confirm Password" ariadescribedby="basic-addon1" autofocus="autofocus" value="<?php echo $f3;?>">
      </div>
    </div>
    <br/>
    <br/>
    <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1"><strong>First Name *</strong></span>
        <input type="text" class="form-control" name="first_name" placeholder="First Name" ariadescribedby="basic-addon1" autofocus="autofocus" value="<?php echo $f4;?>">
        <br/>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1"><strong>Last Name </strong></i></span>
        <input type="text" class="form-control" name="last_name" placeholder="Last Name" ariadescribedby="basic-addon1" autofocus="autofocus" value="<?php echo $f5;?>">
      </div>
    </div>
    <br/>
    <br/>
    <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-envelope"></i> *</span>
        <input type="email" class="form-control" name="email" placeholder="Email" ariadescribedby="basic-addon1" autofocus="autofocus" value="<?php echo $f6;?>">
        <br/>
      </div>
    </div>
    <br/>
    <br/>
    <!--Captcha-->
    <div class="form-group">
      <label for="captch">Are you Human* :</label>
      <img src="captcha.php" alt="Captcha Image" /><br/>
    </div>
    <br/>
    <br/>
    <!---->
    <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-picture"></i> *</span>
        <input type="text" class="form-control" name="captch" placeholder="Captcha Value" ariadescribedby="basic-addon1" autofocus="autofocus" autocomplete="off">
        <br/>
      </div>
    </div>
    <br/>
    <br/>
    <div class="form-group">
      <input type="submit" class="btn btn-primary" value="Register">
    </div>
</form>

<?php
}
include 'includes/layout/footer.php';
?>