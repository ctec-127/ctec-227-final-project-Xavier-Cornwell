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
        $company = $db->real_escape_string($_POST['name']);
        $service = $db->real_escape_string($_POST['role']);
        $country = $db->real_escape_string($_POST['country']);
        $about = $db->real_escape_string($_POST['about']);
        $sql = "INSERT INTO company (name, service, company_about, country) VALUES ('$company','$service' ,'$about','$country')";
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
                         
                                        <      <div class="content">
        <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <h5 class="title">Advanced Search</h5>
                    <?php require_once __DIR__ .'../inc/search.inc.php' ;?>
                  </div>
                  <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> " method="post">
                      <div class="row">
                        <div class="col-md-5 pr-md-1">
                          <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" class="form-control"placeholder="Company" id="name" value="">
                          </div>
                        </div>
                        <div class="col-md-3 px-md-1">
                          <div class="form-group">
                            <label>Role</label>
                            <input type="text" class="form-control" placeholder="Role" id="role" value="">
                          </div>
                        </div>
                        <div class="col-md-4 pl-md-1">
                      </div>
                      <div class="row">
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" id="country" placeholder="country" value="">
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label>About</label>
                            <textarea type="text" class="form-control" id="about" placeholder="description" value="">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-fill btn-primary">Save</button>
                  </div>
                </div>
 
          </div>
        </div>
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