<?php // Filename: connect.inc.php



$error_bucket = [];

// http://php.net/manual/en/mysqli.real-escape-string.php


$upload_dir = 'uploads';
// Define these errors in an array
$upload_errors = array(
                        UPLOAD_ERR_OK 				=> "No errors.",
                        UPLOAD_ERR_INI_SIZE  		=> "Larger than upload_max_filesize.",
                        UPLOAD_ERR_FORM_SIZE 		=> "Larger than form MAX_FILE_SIZE.",
                        UPLOAD_ERR_PARTIAL 			=> "Partial upload.",
                        UPLOAD_ERR_NO_FILE 			=> "No file.",
                        UPLOAD_ERR_NO_TMP_DIR 		=> "No temporary directory.",
                        UPLOAD_ERR_CANT_WRITE 		=> "Can't write to disk.",
                        UPLOAD_ERR_EXTENSION 		=> "File upload stopped by extension.");



if($_SERVER['REQUEST_METHOD']=="POST"){
    // grab primary key from hidden field


    $success = false;
    
    
    // set upload folder name

    
        // what file do we need to move?
        $tmp_file = $_FILES['file_upload']['tmp_name'];
    
        // set target file name
        // basename gets just the file name
        $target_file = basename($_FILES['file_upload']['name']);
    
    
        // Now lets move the file
        // move_uploaded_file returns false if something went wrong
        if(move_uploaded_file($tmp_file, $upload_dir . "/" . $target_file)){
            $message = "File uploaded successfully";
        } else {
            $error = $_FILES['file_upload']['error'];
            $message = $upload_errors[$error];
        } // end of if
    

        // Loop over field names, make sure each one exists and is not empty
        $error = false;
    
    
    
    
       
    
        
 

    
        $id = $_SESSION['id'];
    
    // First insure that all required fields are filled in
    if (empty($_POST['firstname'])) {
        array_push($error_bucket,"<p>A first name is required.</p>");
    } else {
        $first = $db->real_escape_string(strip_tags($_POST['firstname']));
    }
    if (empty($_POST['lastname'])) {
        array_push($error_bucket,"<p>A last name is required.</p>");
    } else {
        $last = $db->real_escape_string(strip_tags($_POST['lastname']));
    }
    if (empty($_POST['username'])) {
        array_push($error_bucket,"<p>Username is required.</p>");
    } else {
        $username = $db->real_escape_string(strip_tags($_POST['username']));
    }
    if (empty($_POST['email'])) {
        array_push($error_bucket,"<p>An email address is required.</p>");
    } else {
        $email = $db->real_escape_string(strip_tags($_POST['email']));
    }
    if (empty($_POST['about'])) {
        $about='';
    } else {
        $about = $db->real_escape_string(strip_tags($_POST['about']));
    }
    if (empty($target_file)) {
        $target_file=$_SESSION['avatar'];
    }
    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        // Time for some SQL
        $sql = "UPDATE user SET first_name='$first', last_name='$last', username='$username', email='$email',about='$about', avatar_path='$target_file' WHERE user_id = $id";

        $result = $db->query($sql);
        if (!$result) {
            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not save that record for you. ' .  
            $db->error . '.</div>';
        } else {
            echo '<div class="alert alert-success" role="alert">
            I saved that new record for you!
          </div>';
            unset($first);
            unset($last);
            unset($username);
            unset($email);
            unset($about);
        }
    } else {
        display_error_bucket($error_bucket);
     // end of error bucket
} 
    // check for record id (primary key)
    $id = $_SESSION['id'];
    // now we need to query the database and get the data for the record
    // note limit 1
    $sql = "SELECT * FROM user WHERE user_id=$id LIMIT 1";
    // query database
    $result = $db->query($sql);
    // get the one row of data
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
    header("location: user.php");
  } 
    
