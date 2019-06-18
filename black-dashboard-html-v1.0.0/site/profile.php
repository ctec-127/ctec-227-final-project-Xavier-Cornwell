<?php    
    /* login.php */
    session_start();

    try {
      require_once('../inc/mysqli_connect.php');
      require_once('../inc/functions.inc.php');
      log_page($db,"Homepage");
    } catch(Exception $e) {
      $error = $e->getMessage();
    }?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
            Consumer Gaming
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class=" ">

<?php require_once "..\inc\header.inc.php";  
$userID= $_GET['userid'];
$sql = "SELECT * FROM user WHERE user_id='$userID'";
// echo $sql;
$result = $db->query($sql);

$row = $result->fetch_assoc();
$firstname = $row['first_name'];
$lastname = $row['last_name'];
$role = $row['role'];
$avatar = $row['avatar_path'];
$username =$row['username'];
$about=$row['about'];
?>
<div class="content ">
<div class="col-md-12" style="min-height:500px;">
            <div class="card  card-user">
              <div class="card-body ">
                <p class="card-text">
                  <div class="author">
                    <div class="block block-one"></div>
                    <div class="block block-two"></div>
                    <div class="block block-three"></div>
                    <div class="block block-four"></div>
                      <img class="avatar" src="uploads/<?php echo $avatar; ?>" alt="...">
                      <h3 class="title"> <?php echo $username ;?></h3>
                      <h4 class="title"> <?php echo $firstname . ' ' . $lastname ;?></h4>         
                    <p class="description">
                      <?php echo $role; ?>
                    </p>
                  </div>
                </p>
                <p class="card-description col-6" style="display:block; margin:0 auto;">
                <?php echo $about; ?>
                </p>
              </div>
              </div>
              <?php

           
            $comments = "SELECT review.id, review.user_id, review.review, review.rating, user.username, user.avatar_path , user.user_id
            FROM review
            JOIN user 
            ON review.user_id = user.user_id 
            WHERE review.user_id = '$userID'
            ORDER BY review.date ASC
           ";
           $Rcomments = $db->query("$comments");
           
 ?>
          <div class="col-lg-12 col-md-12">
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Reviews</h3>
              </div>
              <div class="card-body">

                <div class="container">

                  <div>
                    <div class="card-body">
                   <?php 
                   
                   
                   
                   while ($row = $Rcomments->fetch_assoc()){
                     $review=$row['id'];
                     $username = $row['username'];
                     $reviewComment = $row['review'];
                     $reviewRating = $row['rating'];
                     $avatar = $row['avatar_path'];
                     $userID =$row['user_id'];
                     
                     ?>
                      <div class="row mt-3">
                        <div class="col-md-2 mt-0">
                          <img class="avatar" src="uploads/<?php echo $avatar;?>" alt="...">
                          <p class="text-secondary text-left">10 users with this review</p>
                        </div>
                        <div class="col-md-10">
                          <p>
                            <a class="float-left"
                              href="profile.php?userid=<?php echo $userID; ?>"><strong><?php echo $username;?></strong></a>
                             <div class="comment-heart float-right" style="font-size:10px; ">
                             <?php
                             $commentHearts=5;
                             $countSum=0;
                             for ($i=0; $i < $reviewRating ; $i++) { 
                            $countSum= $countSum + 1;
                            echo "<span class='fa fa-heart checked '></span>";
                          }
                          $commentHearts= $commentHearts-$countSum;
                          for ($i=0; $i < $commentHearts ; $i++) { 
                            echo "<span class='fa fa-heart'></span>";
                          }
                        
                        ?>
                              </div>


                          </p>
                          <div class="clearfix"></div>
                          <p><?php if($reviewComment != '') {
                            echo $reviewComment;
                            ?></p>
                          <?php
                          }
                          else {
                            echo '';
                          }
                          ?>
                        </div>
                      </div>
                      <?php
                  } 
                  ?>
            
</body>