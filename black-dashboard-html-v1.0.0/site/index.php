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

<?php require_once "..\inc\header.inc.php";   ?>
            <!-- End Navbar -->
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-5">
                            <div class="card-header">
                                <h2 class="title">Video Games Companies</h2>
                                <p class="category">Reviews for you're consumer satisfaction
                                    
                                </p>
                            </div>
                            <div class="card-body all-icons">
                                <div class="row">
                                    <?php 
                                    function db_query($db,$sql){
                                        $result = $db->query($sql);  
                                        
                                        while ($row = $result->fetch_assoc()) {
                                            $companyID=$row['company_id'];
                                            $company = $row['name'];
                                            $service= $row['service'];
                                            $country =$row['country'];
                                            $logo =  $row['logo_path'];
                                    
                                    
                                    
                                    ?>
                                    <div class="font-icon-list  col-sm-6 col-md-4 " >
                                        <div class="font-icon-detail pt-0">
                                            <a href="dashboard.php?id=<?php echo $companyID;?>">
                                            <img class="" src="uploads/<?php echo $logo; ?>" alt="..." class="responsive" style="height:300px; width:100%;">
                                            </a>
                                            <h4 class="text-center mb-0 mt-3"><?php echo $company; ?></h4>
                                            <p class="mt-0"> <?php echo $service; ?></p>
                                            <p class="mt-0"> <?php echo $country; ?></p>
                                            <div class="ratings">
                                                <span class="fa fa-heart checked"></span>
                                                <span class="fa fa-heart checked"></span>
                                                <span class="fa fa-heart checked"></span>
                                                <span class="fa fa-heart"></span>
                                                <span class="fa fa-heart"></span>
                                              </div>
                                        </div>
                                    </div>

                                    <?php }}
                                       $sql = "SELECT *
                                       FROM company
                                       ORDER BY name ASC"
                                       ;
                                    
                                    db_query($db,$sql);
                                 
                                    ?>
      
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
</body>

</html>