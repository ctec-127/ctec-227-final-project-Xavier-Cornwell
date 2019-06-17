
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="../assets/css/login.css" rel="stylesheet" />
    <title>Document</title>
</head>
<body>

    <?php
    /* login.php */
   
    session_start();
    session_destroy();
    session_start();
    try {
      require_once('../inc/mysqli_connect.php');
      require_once('../inc/functions.inc.php');
      log_page($db,"Login");
    } catch(Exception $e) {
      $error = $e->getMessage();
    }

    function login($db){
      $email = $db->real_escape_string($_POST['email']);
      $password = hash('sha512', $_POST['password']);

      $sql = "SELECT * FROM user WHERE email='" . $_POST["email"] . "'" . " AND password=" . "'" . $password . "' LIMIT 1";
      
      $result = $db->query($sql);

      if ($result->num_rows == 1){
        // return true;
        $row = $result->fetch_assoc();
        $_SESSION['firstname'] = $row['first_name'];
        $_SESSION['lastname'] = $row['last_name'];
        $_SESSION['id'] = $row['user_id'];
        $_SESSION['loggedin'] = 1;
        $_SESSION['role'] = $row['role'];
        $_SESSION['avatar']=$row['avatar_path'];
        $_SESSION['username']=$row['username'];
        $_SESSION['email']=$row['email'];
        $_SESSION['about']=$row['about'];
        header("location: index.php");
      } else {
        return false;
      }
    }

    ?>



    <?php

    $success = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
          // Required field names
      $required = array('email','password');

        // Loop over field names, make sure each one exists and is not empty
      $error = false;
      foreach($required as $field) {
        if (empty($_POST[$field])) {
          $error = true;
        }
      }

      if ($error) {
        echo "All fields are required.";
      } else {
        $status = login($db);

        if ($status){
          echo "<br>You are now logged in!";
          $success = true;
        } else {
          echo "<br>Could not log you in. Please try again.";
        }
      }
    }

    $db->close();

    if (!$success) { ?>

        <div class="container-fluid">
                <div class="row no-gutter">
                  <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
                  <div class="col-md-8 col-lg-6">
                    <div class="login d-flex align-items-center py-5">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-9 col-lg-8 mx-auto">
                            <h3 class="login-heading mb-4">Welcome back!</h3>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> " method="post">
                              <div class="form-label-group">
                              <input class="form-control" type="email" id="email" name="email" placeholder="Email" value="<?php if(isset($_POST["email"])){echo $_POST["email"];} ?>">
                                <label for="email">Email address</label>
                              </div>
              
                              <div class="form-label-group">
                              <input class="form-control" type="password" id="password" name="password" placeholder="Password" value="<?php if(isset($_POST["password"])){echo $_POST["password"];} ?>">
                                <label for="password">Password</label>
                              </div>
                              <button class="btn btn-lg btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" value="Login">Sign in</button>
                              <div class="text-center">
                              <a  href="index.php">Continue Without Signing in</a> <br> <a class="small" href="registration.php">Register</a></div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?> 
</body>
</html>