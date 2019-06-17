<?php
/* register.php */
session_start();

try {
	require_once('../inc/functions.inc.php');
	require_once('../inc/mysqli_connect.php');
	// log page usage
	log_page($db,"Register");
} catch(Exception $e) {
	$error = $e->getMessage();
}

?>

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
<link href="../assets/css/register.css" rel="stylesheet" />
<!------ Include the above in your HEAD tag ---------->
    <title>Document</title>
</head>
<body>

<?php 

$success = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Required field names
    $required = array('firstname', 'lastname', 'username', 'email', 'password');

    // Loop over field names, make sure each one exists and is not empty
    $error = false;
    foreach($required as $field) {
        if (empty($_POST[$field])) {
            $error = true;
        }
    }

    if ($error) {
        echo '<div class="error">All fields are required.</div>';
    } else {
        $user_name = $db->real_escape_string($_POST['username']);
        $first_name = $db->real_escape_string($_POST['firstname']);
        $last_name = $db->real_escape_string($_POST['lastname']);
        $email = $db->real_escape_string($_POST['email']);
        $password = hash('sha512', $_POST['password']);
        $role = $db->real_escape_string($_POST['role']);
        $sql = "INSERT INTO user (username, first_name, last_name, email, password, role, avatar_path) VALUES ('$user_name','$first_name' ,'$last_name','$email','$password','$role','default-avatar.png')";
            // echo $sql;
        $result = $db->query($sql);

        if($db->error){
            echo '<div class="error">' . $db->error . '</div>';
        } else {
            header("location: login.php");
            echo '<div class="success">Your registration has been successfully processed.</div>';
            $success = true;
        }
    }
}

if (!$success) { ?>


    <div class="back">
        <div class="register">
                        <div class="row">
                            <div class="col-md-3 col-sm-0 register-left">
                            <h1 >You're close </h1>
                            <h3>to being able to review companies</h3>
                            </div>
                            <div class="col-md-9 col-sm-12 register-right">

                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?> " method="post">
                                <div class="tab-content" id="myTabContent">
                         
                                        <h3 class="register-heading">Sign-Up</h3>
                                        <div class="row register-form">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input id="firstname" name="firstname" type="text" class="form-control" placeholder="First Name *" value="<?php if(isset($_POST["firstname"])){echo $_POST["firstname"];} ?>" />
                                                </div>
                                                <div class="form-group">
                                                    <input id="lastname" name="lastname" type="text" class="form-control" placeholder="Last Name *" value="<?php if(isset($_POST["lastname"])){echo $_POST["lastname"];} ?>" />
                                                </div>
                                                <div class="form-group">
                                                    <input id="username" name="username" type="text" class="form-control" placeholder="Username *" value="<?php if(isset($_POST["username"])){echo $_POST["username"];} ?>" />
                                                </div>
                                
                                            </div>
                                            <div class="col-md-12">
                                                    <div class="form-group">
                                                            <input id="email" name="email" type="email" class="form-control" placeholder="Email *" value="<?php if(isset($_POST["email"])){echo $_POST["email"];} ?>" />
                                                        </div>
        
                                                    <div class="form-group">
                                                            <input id="password" name="password" type="password" class="form-control" placeholder="Password *" value="<?php if(isset($_POST["password"])){echo $_POST["password"];} ?>" />
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label for="role"><h4>Role:</h4></label>
                                                            <select name="role" class="form-control" id="role">
                                                                <option value="user" default>User</option>
                                                                <option value="admin">Admin</option>
                                                            </select>
                                                        </div>
        
                                                <input type="submit" class="btnRegister"  value="Register"/>
                                            </div>
                                        </div>
                                   
                                   
                                </div>
                                </form>
                            </div>
                        </div>
        
                    </div>

                </div>
                <?php } ?>

                <?php $db->close(); ?>
</body>
</html>