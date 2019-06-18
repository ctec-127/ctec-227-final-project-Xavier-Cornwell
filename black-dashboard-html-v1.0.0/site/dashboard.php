<?php    
    /* login.php */
    session_start();

    try {
      require_once('../inc/mysqli_connect.php');
      require_once('../inc/functions.inc.php');
      log_page($db,"dashboard");
    } catch(Exception $e) {
      $error = $e->getMessage();
    }
    
    if (isset($_SESSION['loggedin'])) {
      echo '';
    }
    else {
      header('Location: login.php');    
    }
    ?>

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
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

</head>

<body class=" " >


 <?php     
 

  if(isset($_GET['id'])){
     $id=$_GET['id'];
    
       $sql = "SELECT *
       FROM company 
        WHERE company_id = $id";
                     
  $result = $db->query($sql);  
  
  while ($row = $result->fetch_assoc()) {
      $companyID=$row['company_id'];
      $company = $row['name'];
      $service= $row['service'];
      $country =$row['country'];
      $logo =  $row['logo_path'];
      $about= $row['company_about'];
      
      //getting all the reviews and counting them for the average.
      $sql = $db->query("SELECT id FROM review WHERE company_id = $id");
      $numR = $sql->num_rows;

      $sql = $db->query("SELECT SUM(rating) AS total FROM review WHERE company_id = $id");
      $rData = $sql->fetch_array();
      $total = $rData['total'];
      if ($numR!=0) {
        $avg = $total / $numR;
      }
      else{
        $numR=1;
        $avg =0;
      }
      
      
  
 ?>
      <?php require_once "..\inc\header.inc.php";   ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-12">
            <div class="card card-chart">
              <div class="card-header ">
                <div class="row">
                  <div class="col-sm-6 company-info ">
                      <p class="card-text">
                          <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                              
                              <h2 class="title text-center"><?php echo $company;?></h2>
                              <img class="" src="uploads/<?php echo $logo;?>" alt="..." class="responsive " style=" min-width:100%; max-height:400px;">
                            </a>
                            <h4 class="text-center mt-3 mb-4">
                            <?php echo $service;?>
                            </h4>
                          </div>
                          <div class="comment-heart float-right " style="">
                          <?php 
                          //coding for getting the average rating but rounded up
                          $sum = getSum($avg);
                          $countSum=0;
                          $totalHearts= 5;
                          if (is_infinite($sum)) {
                            
                          }
                          else{
                          for ($i=0; $i < $sum ; $i++) { 
                            $countSum= $countSum + 1;
                            echo "<span class='fa fa-heart checked '></span>";
                          }
                          $totalHearts= $totalHearts-$countSum;
                          for ($i=0; $i <$totalHearts ; $i++) { 
                            echo "<span class='fa fa-heart'></span>";
                          }
                        }
                          ?>

                              </div>
                        <p><?php echo $country;?></p>
                        <p class="card-description text-left">
                        <?php echo $about;?> 
                        </p>
                  </div>
                </div>
              </div>
              <div class="card-body md-1">
                <!-- <h4 class="col-12 mb-0">tags:</h4> -->
                <div class="item-content-block tags mt-3">
                  <!-- <a href="#">lorem</a> <a href="#">loremipse</a> <a href="#">Esrite</a> <a href="#">remip</a> <a href="#">serte</a> <a href="#">quiaxms</a> <a href="#">loremipse</a> <a href="#">Esrite</a> -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php 

  }
  
  }


?>
<?php
    
    $conn = new mysqli('localhost', 'root', '', 'game_com_review');
    $userId= $_SESSION['id'];
    if (isset($_POST['save'])) {
      $sql = $db->query("SELECT * FROM review WHERE user_id='$userId' AND company_id ='$id' ORDER BY id  DESC LIMIT 1");
        $uData = $sql->fetch_assoc();
        $uID = $uData['id'];
        $ratedIndex = $conn->real_escape_string($_POST['ratedIndex']);
        $ratedIndex++;

        if (!$uID) {
            $db->query("INSERT INTO review (rating, user_id, company_id) VALUES ('$ratedIndex','$userId','$id')");
            $sql = $db->query("SELECT * FROM review WHERE user_id='$userId' AND company_id ='$id' ORDER BY id  DESC LIMIT 1");
            $uData = $sql->fetch_assoc();
            $uID = $uData['id'];
        } else
            $db->query("UPDATE review SET rating='$ratedIndex' WHERE company_id='$id' AND user_id='$userId' LIMIT 1");

        exit(json_encode(array('id' => $uID)));
    }

// CODE FOR UPLOADING THE REVIEW DESCRIPTION 
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $id = $_GET['id'];
  $review = $db->real_escape_string($_POST['review']);

  $sql = $db->query("SELECT * FROM review WHERE user_id='$userId' AND company_id ='$id' ORDER BY id  DESC LIMIT 1");
  $uData = $sql->fetch_assoc();
  $uID = $uData['id'];

  if (!$uID) {
    $db->query("INSERT INTO review (review) VALUES ('$review')");
    
  }
 else{
    $db->query("UPDATE review SET review='$review' WHERE company_id='$id' AND user_id='$userId' LIMIT 1");

}

}

?>

        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="card card-chart" style="height:200px;">
              <div class="card-header ">
                <h5 class="card-category">Reviews</h5>
                <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary  "style="font-size:18px; "></i> <?php echo $numR;  ?></h3>
              </div>
              <div class="card-body ">
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="card card-chart" style="font-size:18px; height:200px;">
              <div class="card-header ">
                <h5 class="card-category">rate</h5>
                <div class="rating mt-5 align-items-center" style="font-size:2em;" >
                <!-- Area below is for heart rating -->
                <i class="fa fa-heart fa-2x" data-index="0" ></i>
        <i class="fa fa-heart fa-2x" data-index="1"></i>
        <i class="fa fa-heart fa-2x" data-index="2"></i>
        <i class="fa fa-heart fa-2x" data-index="3"></i>
        <i class="fa fa-heart fa-2x" data-index="4"></i>
        <br><br>
     
                </div>
              </div>
              <div class="card-body ">
              </div>
            </div>
          </div>
        </div> 
        
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="card card-tasks">
              <div class="card-header ">
                <h3 class="card-title">
                  Leave a Review
                </h3>
                
              </div>
              <div class="card-body ">

                <form action="<?php echo "dashboard.php?id=$id;"?> " method="POST">
                  <div class="form-group">
                    <label>Review</label>
                    <textarea type="text" class="form-control" name="review" id="review" placeholder="Leave a Review" value="Mike" rows="10"
                      cols="50"></textarea>
                  </div>
                  <button class="btn-lg btn-primary" style="border:none;" type="submit">Submit Review</button>
                </form>

              </div>
            </div>
          </div>
          <!-- COMMENTS AREA -->
          <?php 
          $id=$_GET['id'];
    $comments = "SELECT review.id, review.review, review.rating, user.username, user.avatar_path , user.user_id
            FROM review
            JOIN user 
            ON review.user_id = user.user_id 
            WHERE company_id = '$id'
            ORDER BY review.date ASC
           ";
           $Rcomments = $db->query("$comments");
           
 ?>
          <div class="col-lg-12 col-md-12">
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Comments</h3>
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
                          <p>
                             <!-- NEEED WORK FOR VOTING FOR COMMENTS NOT DONE YET -->
                            <form action="dashboard.php?id=<?php echo $id; ?>" method='POST'>
                            <a class="float-right btn btn-sm text-white btn-danger" value='1' name='agree' id='agree'> <i class="fa fa-heart"></i> Agree</a>
                            </form>
                          </p>
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
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
              
      <footer class="footer">
        <div class="container-fluid">
          <nav>
            <ul>
              <li>
                <a href="https://www.github.com">
                  GitHub
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            ©
            <script>
              document.write(new Date().getFullYear())
            </script> 
            <a href="https://github.com/Xavier-Cornwell" target="_blank">Xavier Cornwell</a> 
          </div>
      </footer>
    </div>
  </div>


  <!--   Core JS Files   -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/black-dashboard.min.js?v=1.0.0" type="text/javascript"></script>
  <!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
  //demo  site js
  var ratedIndex = -1;
    $(document).ready(function () {
      $().ready(function () {
        $sidebar = $('.sidebar');
        $navbar = $('.navbar');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;
        white_color = false;

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



        $('.fixed-plugin a').click(function (event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .background-color span').click(function () {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($navbar.length != 0) {
            $navbar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function () {
          var $btn = $(this);

          if (sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            sidebar_mini_active = false;
            blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
          } else {
            $('body').addClass('sidebar-mini');
            sidebar_mini_active = true;
            blackDashboard.showSidebarMessage('Sidebar mini activated...');
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function () {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function () {
            clearInterval(simulateWindowResize);
          }, 1000);
        });

        $('.switch-change-color input').on("switchChange.bootstrapSwitch", function () {
          var $btn = $(this);

          if (white_color == true) {

            $('body').addClass('change-background');
            setTimeout(function () {
              $('body').removeClass('change-background');
              $('body').removeClass('white-content');
            }, 900);
            white_color = false;
          } else {

            $('body').addClass('change-background');
            setTimeout(function () {
              $('body').removeClass('change-background');
              $('body').addClass('white-content');
            }, 900);

            white_color = true;
          }


        });

        $('.light-badge').click(function () {
          $('body').addClass('white-content');
        });

        $('.dark-badge').click(function () {
          $('body').removeClass('white-content');
        });
      });
    });
  </script>
 <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script>
        var ratedIndex = -1, uID = 0;

        $(document).ready(function () {
            resetStarColors();

            if (localStorage.getItem('ratedIndex') != null) {
                setStars(parseInt(localStorage.getItem('ratedIndex')));
                uID = localStorage.getItem('uID');
            }

            $('.fa-2x').on('click', function () {
               ratedIndex = parseInt($(this).data('index'));
               localStorage.setItem('ratedIndex', ratedIndex);
               saveToTheDB();
            });

            $('.fa-2x').mouseover(function () {
                resetStarColors();
                var currentIndex = parseInt($(this).data('index'));
                setStars(currentIndex);
            });

            $('.fa-2x').mouseleave(function () {
                resetStarColors();

                if (ratedIndex != -1)
                    setStars(ratedIndex);
            });
        });

        function saveToTheDB() {
            $.ajax({
               url: "dashboard.php?id=<?php echo $id; ?>",
               method: "POST",
               dataType: 'json',
               data: {
                   save: 1,
                   ratedIndex: ratedIndex
               }, success: function (r) {

               }
            });
        }

        function setStars(max) {
            for (var i=0; i <= max; i++)
                $('.fa-2x:eq('+i+')').css('color', 'pink');
        }

        function resetStarColors() {
            $('.fa-2x').css('color', 'grey');
        }
    </script>
</body>

</html>