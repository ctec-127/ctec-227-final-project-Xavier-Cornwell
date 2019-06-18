<div class="wrapper ">
      <div class="sidebar">
          <!--
            Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
        -->
          <div class="sidebar-wrapper">
            <div class="logo">
              <a href="index.php" class="simple-text logo-mini">
                CG
              </a>
              <a href="index.php" class="simple-text logo-normal">
               Consumer Gaming
              </a>
            </div>
            <ul class="nav">
                <li>
                    <a href="./index.php">
                      <i class="tim-icons icon-align-center"></i>
                      <p>Home</p>
                    </a>
                  </li>
              <li class ="">
                <a href="./icons.php">
                  <i class="tim-icons icon-atom"></i>
                  <p>Search</p>
                </a>
              </li>
              
              <?php //Setting up links for different types of users
              if (isset($_SESSION['loggedin'])) {
               
              ?>
              <li>
                <a href="./user.php">
                  <i class="tim-icons icon-single-02"></i>
                  <p>User Profile</p>
                </a>
              </li>           
             <?php } ?>
             <?php //Setting up links for different types of users
              if (isset($_SESSION['loggedin']) && $_SESSION['role']=="admin") {
               
              ?>
              <li>
                <a href="./admin.php">
                <i class="tim-icons icon-atom"></i>
                  <p>Admin</p>
                </a>
              </li>           
             <?php } ?>
            </ul>
          </div>
        </div>
    <div class="main-panel">
          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent   ">
              <div class="container-fluid">
                <div class="navbar-wrapper">
                  <div class="navbar-toggle d-inline">
                    <button type="button" class="navbar-toggler">
                      <span class="navbar-toggler-bar bar1"></span>
                      <span class="navbar-toggler-bar bar2"></span>
                      <span class="navbar-toggler-bar bar3"></span>
                    </button>
                  </div>
                  <a class="navbar-brand" href="#pablo">Consumer Gaming</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                  aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-bar navbar-kebab"></span>
                  <span class="navbar-toggler-bar navbar-kebab"></span>
                  <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse" id="navigation">
                  <ul class="navbar-nav ml-auto ">
                    <!-- <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i class="tim-icons icon-simple-remove"></i>
                </button>
              </div>
      
              <div class="modal-footer">
              </div>
            </div>
          </div>
        </div> -->
                    <li class="dropdown nav-item">
                      <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <div class="photo">
                          <img src="<?php if (isset($_SESSION['loggedin'])) {
                              echo "uploads/" . $_SESSION['avatar'];
                             
                          }
                          else {
                              echo "../assets/img/anime3.png";
                          }
                          
                          ?>">
                        </div>
                        <b class="caret d-none d-lg-block d-xl-block"></b>
                        <p class="d-lg-none">
                          Log out
                        </p>
                      </a>
                      <ul class="dropdown-menu dropdown-navbar">
                        <li class="nav-link">
                          <a href="user.php" class="nav-item dropdown-item">Profile</a>
                        </li>
                        <div class="dropdown-divider"></div>
                        <li class="nav-link">
                        <?php //Setting up login in and logout button
              if (isset($_SESSION['loggedin'])) { ?>
                          <a href="login.php" class="nav-item dropdown-item">Log out</a>
                          <?php } 
                          else { ?>
                            <a href="login.php" class="nav-item dropdown-item">Log in</a>
                            <?php
                          }
                          
                          ?>
                        </li>
                      </ul>
                    </li>
                    <li class="separator d-lg-none"></li>
                  </ul>
                </div>
              </div>
            </nav>
            <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i class="tim-icons icon-simple-remove"></i>
                    </button>
                  </div>
                  <div class="modal-footer">
                  </div>
                </div>
              </div>
            </div>
            <!-- End Navbar -->