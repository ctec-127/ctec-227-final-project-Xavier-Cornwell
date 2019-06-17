<?php    
    /* login.php */
    session_start();

    try {
      require_once('../inc/mysqli_connect.php');
      require_once('../inc/functions.inc.php');
      log_page($db,"dashboard");
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
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
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


 <?php 
  
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
                        </p>
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
?>
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="card card-chart">
              <div class="card-header ">
                <h5 class="card-category">Ratings</h5>
                <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary "></i> 763,215</h3>
              </div>
              <div class="card-body ">
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="card card-chart">
              <div class="card-header ">
                <h5 class="card-category">Reviews</h5>
                <h3 class="card-title"><i class="tim-icons icon-send text-success "></i> 12,100K</h3>
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
                <div class="rating mt-5 align-items-center pb-4">
                  <span class="fa fa-heart checked"></span>
                  <span class="fa fa-heart checked"></span>
                  <span class="fa fa-heart checked"></span>
                  <span class="fa fa-heart"></span>
                  <span class="fa fa-heart"></span>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?> " method="POST">
                  <div class="form-group">
                    <label>Review</label>
                    <textarea type="text" class="form-control" placeholder="Leave a Review" value="Mike" rows="10"
                      cols="50"></textarea>
                  </div>
                  <button class="btn-lg btn-primary" style="border:none;" type="submit">Submit Review</button>
                </form>

              </div>
            </div>
          </div>
          <!-- COMMENTS AREA -->
          <div class="col-lg-12 col-md-12">
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Comments</h3>
              </div>
              <div class="card-body">

                <div class="container">

                  <div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-2">
                          <img class="avatar" src="../assets/img/anime6.png" alt="...">
                          <p class="text-secondary text-left">10 users with this review</p>
                        </div>
                        <div class="col-md-10">
                          <p>
                            <a class="float-left"
                              href="https://maniruzzaman-akash.blogspot.com/p/contact.html"><strong>Maniruzzaman
                                Akash</strong></a>
                                <div class="comment-heart" style="font-size:10px;">
                                <span class="fa fa-heart float-right"></span>
                                <span class="fa fa-heart float-right"></span>
                                <span class="fa fa-heart checked float-right"></span>
                                <span class="fa fa-heart checked float-right"></span>
                                <span class="fa fa-heart checked float-right"></span>
                              </div>


                          </p>
                          <div class="clearfix"></div>
                          <p>Lorem Ipsum is simply dummy text of the pr make but also the leap into electronic
                            typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                            release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                            publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                          <p>
                            <a class="float-right btn btn-sm btn-outline-primary ml-2"> <i class="fa fa-reply"></i>
                              Disagree</a>
                            <a class="float-right btn btn-sm text-white btn-danger"> <i class="fa fa-heart"></i> Agree</a>
                          </p>
                        </div>
                      </div>
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
  <script src="../assets/js/core/jquery.min.js"></script>
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
  <script>
    $(document).ready(function () {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
</body>

</html>