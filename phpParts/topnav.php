<?php 
$filenameLink = basename($_SERVER['PHP_SELF']);

?>

<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          
           <ul class="navbar-nav">
            
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main" style="height:50px;">
                <a class="nav-link" >
                <span class="nav-link-text">Close</span>
              </a>
              </div>
            </li>
           
           <!--
            <li class="nav-item">
              <a class="nav-link <?php if($filenameLink==''||$filenameLink=='home.php'){echo 'active';}?>" href="./home.php">
                <span class="nav-link-text">Home</span>
              </a>
            </li>
            -->
            <li class="nav-item">
              <a class="nav-link <?php if($filenameLink=='home.php' && $_GET['category']=="route"){echo 'active';}?>" href="./home.php?category=route">
                <span class="nav-link-text">Routes</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($filenameLink=='home.php' && $_GET['category']=="journey"){echo 'active';}?>" href="./home.php?category=journey">
                <span class="nav-link-text">Journeys</span>
              </a>
            </li>
          
          
            
          </ul>
          
          
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
              
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                  <?php if($nMessages>0){?>
            <span class="notification" style="position: relative;"><?php echo $nMessages?></span>
          <?php }?>
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
                
              </div>
            </li>
           
            
          </ul>
         
          
         
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 " >
              
             
            <?php if($logged==1){?> 
            
           
            <li class="nav-item dropdown">
                
            <?php if($session_name=="")
            {?>
            
                <a class="btn btn-default" href="./login.php">Login</a>
                <a class="btn btn-success" href="./register.php">Register</a>
              
              
              <?php }else
              {?>
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="assets/img/theme/user-img.png">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $session_name?></span>
                  </div>
                </div>
              </a>
              <?php }?>
              
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                
                <a href="./editprofile.php" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a>
                
                <div class="dropdown-divider"></div>
                <a href="./login.php?logout=1" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
            
            <?php }?>
            
            
            
          </ul>
        </div>
      </div>
    </nav>
    
    <script>
        function submitlanguageform(){
            $("#languageform").submit();
        }
    </script>