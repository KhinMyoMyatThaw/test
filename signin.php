<?php
 session_start();

 $errors = array();

 $db = mysqli_connect('localhost', 'root', '','register');
 // Login User
 if (isset($_POST['user_login'])) {

  //recevie all input values from the form

  $email= mysqli_real_escape_string($db, $_POST['email']);
  $password= mysqli_real_escape_string($db, $_POST['password']);

   if (empty($email)) {
    array_push($errors, "Email is required");
  }
   if (empty($password)) {
    array_push($errors, "Password is required");
  }

   if (count($errors)==0) {
    $password = md5($password);
    $query = "SELECT * FROM user WHERE email= '$email' And password= '$password'";
    $results = mysqli_query($db, $query);
    if(mysqli_num_rows($results)==1){
      $_SESSION['email'] =$email;
      $_SESSION['success'] = "You are now logged in";
      header('location: home.php');


    }else{
    
      array_push(($errors), "Wrong username/password combination");
     # code...
    }
   }
   }
   # code...
 
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sign In</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background: pink;">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Sign In Form</h1>
              </div>
              <form class="user" method="POST" action="">
                <?php  if (count($errors) > 0) : ?>
                    <div class="error-kmmt" style="color: red;">
                      <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error ?></p>
                      <?php endforeach ?>
                    </div>
                 <?php  endif ?>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email">
                </div>
                
                  <div class="form">
                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                  </div>
                  <br>
                  <input type="submit" value="Login" name="user_login">
                
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div><br>
              <a href="register.php" class="btn btn-facebook btn-user btn-block">
                  Register Account
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
