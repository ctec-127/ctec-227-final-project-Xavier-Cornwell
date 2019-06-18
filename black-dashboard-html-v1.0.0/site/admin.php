<?php    
    /* login.php */
    session_start();

    try {
      require_once('../inc/mysqli_connect.php');
      require_once('../inc/functions.inc.php');
      log_page($db,"admin");
    } catch(Exception $e) {
      $error = $e->getMessage();
    }
    //checking if an admin is using the page if not redirecting them
    if (isset($_SESSION['loggedin']) && $_SESSION['role']=="admin") {
    }
    else {
      header('Location: index.php')
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
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>
<body>

<?php 

$success = false;


// set upload folder name
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



if($_SERVER["REQUEST_METHOD"] == "POST"){
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



        // Required field names
        $required = array('name', 'role', 'about', 'country');

    // Loop over field names, make sure each one exists and is not empty
    $error = false;


    if ($error) {
        echo '<div class="error">All fields are required.</div>';
    } else {

    // Loop over field names, make sure each one exists and is not empty


        $company = $db->real_escape_string($_POST['name']);
        $service = $db->real_escape_string($_POST['role']);
        $country = $db->real_escape_string($_POST['country']);
        $about = $db->real_escape_string($_POST['about']);
        $sql = "INSERT INTO company (name, service, company_about, country, logo_path) VALUES ('$company','$service' ,'$about','$country','$target_file')";
            // echo $sql;
        $result = $db->query($sql);
        if($db->error){
            echo '<div class="error">' . $db->error . '</div>';
        } else {
            echo '<div class="success">Your registration has been successfully processed.</div>';
            $success = true;
        }

      }

      //this section is for uploading images to a folder

    }
    require_once "..\inc\header.inc.php";   
?>


       <div class="content">
        <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <h5 class="title">Create new company profile page</h5>
                  </div>
                  <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> " method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-5 pr-md-1">
                          <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" class="form-control"placeholder="Company" name="name" id="name" >
                          </div>
                        </div>
                        <div class="col-md-3 px-md-1">
                          <div class="form-group">
                            <label>Role</label>
                            <input type="text" class="form-control" placeholder="Role" id="role" name="role"  >
                          </div>
                        </div>
                        <div class="col-md-4 ">
                      </div>
                      <div class="row">
                        <div class="col-md-6 pl-4 pr-4">
                          <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" id="country" placeholder="country"  name="country">
                          </div>
                        </div>
                        <div class="col-md-6 pr-5">
                          <div class="form-group">
                            <label>About</label>
                            <textarea type="text" class="form-control" id="about" placeholder="description" name="about" ></textarea>
                          </div>
                        </div>
                        <div>		<input type="hidden" name="MAX_FILE_SIZE" value="100000000">
		<input type="file" name="file_upload" class="btn btn-outline-info ml-4"></div>
                      </div>
                 
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-fill btn-primary">Save</button>
                  </div>
                </div>
 
          </div>
        </div>
      </div>
        
                                      
                                            </div>
                                        </div>
                                   
                                   
                                </div>
                                </form>
                            </div>
                        </div>
        
                    </div>

                </div>

                <?php $db->close();  ?>

 
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
      $(document).ready(function() {
        $().ready(function() {
          $sidebar = $('.sidebar');
          $navbar = $('.navbar');

          $full_page = $('.full-page');

          $sidebar_responsive = $('body > .navbar-collapse');
          sidebar_mini_active = true;
          white_color = false;

          window_width = $(window).width();

          fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



          $('.fixed-plugin a').click(function(event) {
            // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
            if ($(this).hasClass('switch-trigger')) {
              if (event.stopPropagation) {
                event.stopPropagation();
              } else if (window.event) {
                window.event.cancelBubble = true;
              }
            }
          });

          $('.fixed-plugin .background-color span').click(function() {
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

          $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
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
            var simulateWindowResize = setInterval(function() {
              window.dispatchEvent(new Event('resize'));
            }, 180);

            // we stop the simulation of Window Resize after the animations are completed
            setTimeout(function() {
              clearInterval(simulateWindowResize);
            }, 1000);
          });

          $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
            var $btn = $(this);

            if (white_color == true) {

              $('body').addClass('change-background');
              setTimeout(function() {
                $('body').removeClass('change-background');
                $('body').removeClass('white-content');
              }, 900);
              white_color = false;
            } else {

              $('body').addClass('change-background');
              setTimeout(function() {
                $('body').removeClass('change-background');
                $('body').addClass('white-content');
              }, 900);

              white_color = true;
            }


          });

          $('.light-badge').click(function() {
            $('body').addClass('white-content');
          });

          $('.dark-badge').click(function() {
            $('body').removeClass('white-content');
          });
        });
      });
    </script>
</body>

</html>


