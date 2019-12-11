<?php 
session_start();

// initializing variables

$username = "";
$email = "";
$errors = array();

//connect to the database

$db = mysqli_connect('localhost', 'root', '', 'register');

// Register User

if (isset($_POST['reg_user'])) {


  //receive all input values from the form

  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $confirmpassword = mysqli_real_escape_string($db, $_POST['confirmpassword']);
  $dateofbirth = mysqli_real_escape_string($db, $_POST['dateofbirth']);
  $gender = mysqli_real_escape_string($db, $_POST['gender']);
  $jlptlevel= mysqli_real_escape_string($db, $_POST['jlptlevel']);
  $profileimage = mysqli_real_escape_string($db, $_POST['profileimage']);
  //echo $profileimage;

  // form validation: ensure that the form is correctly filled
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) {array_push($errors, "Username is required");}
  if (empty($email)) {array_push($errors, "Email is required");}
  if (empty($password)) {array_push($errors, "Password is required");}

  if ($password != $confirmpassword)
  {
    array_push($errors, "The two passwords do not match");
  }
  if (empty($dateofbirth)) {array_push($errors, "Date of Birth is required");}
  if (empty($gender)) {array_push($gender, "Gender is required");}
  if (empty($jlptlevel)) {array_push($jlptlevel, "JLPT Level is required");}
  if (empty($profileimage)) {array_push($profileimage, "Profile imgae is required");}

  // first check the database to make sure
  // a user does not already exist with the same username or email
  $user_check_query = "SELECT * FROM user WHERE email ='$email'";
  
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);


  if ($user) { 
    array_push($errors, "email already exists");
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
      //echo "dddd";
      //exit();
      $password_1 = md5($password);

      $query = "INSERT INTO user (username, email, password, dateofbirth, gender, jlptlevel, profileimage )
                VALUES('$username', '$email', '$password_1', '$dateofbirth', '$gender', '$jlptlevel', '$profileimage')";
                mysqli_query($db, $query);
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: signin.php');
    }
    
  }

 ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Customer Register</title>

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
                <h1 class="h4 text-gray-900 mb-4">Register Form</h1>
              </div>
              <form method="POST" action="" class="user">

                  <?php  if (count($errors) > 0) : ?>
                    <div class="error-kmmt" style="color: red;">
                      <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error ?></p>
                      <?php endforeach ?>
                    </div>
                 <?php  endif ?>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="exampleUserName" placeholder="User Name" name="username">
                  </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleConfirmPassword" placeholder="Confirm Password" name="confirmpassword">
                  </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                    <label for="dateofbirth"><b>Date of Birth<b></label>
                    <input type="date" class="form-control form-control-user" id="exampleDateofBirth" name="dateofbirth">
                    </div>
                  </div>
                 <label><b>Gender</b></label><br>
                 <input type="radio" id="male" name="gender" value="male">
                 <label for="male"><b>Male</b></label>
                  <input type="radio" id="female" name="gender" value="female">
                      <label for="female"><b>Female</b></label><br>

                      <div class="custom" style="width: 400px;">
                        <select name="jlptlevel">
                          <option>Select JLPT Level</option>
                          <option value="N5">N5</option>
                          <option value="N4">N4</option>
                          <option value="N3">N3</option>
                          <option value="N2">N2</option>
                          <option value="N1">N1</option>
                        </select>
                      </div><br> 

                      

                    <form method="post" enctype="multipart/form-data">
                      <div>
                        <label for="file">Choose file to upload</label>
                        <input type="file" id="file" name="profileimage" multiple>

                      </div><br>
                      
                  <input type="submit" value="register" name="reg_user">
                              
              </form>
              
              

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
