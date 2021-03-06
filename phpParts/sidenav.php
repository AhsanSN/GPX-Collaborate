<?php 
$filenameLink = basename($_SERVER['PHP_SELF']);

?>

 <style>
      .notification{
          position: absolute;
        border: 1px solid #fff;
        right: 10px;
        font-size: 9px;
        background: #f44336;
        color: #fff;
        min-width: 20px;
        padding: 0 5px;
        height: 20px;
        border-radius: 10px;
        text-align: center;
        line-height: 19px;
        vertical-align: middle;
        display: block;
        z-index: 1;
      }
          
      </style>
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main" style="height:50px;">
                <a class="nav-link" >
                <span class="nav-link-text">Close</span>
              </a>
              </div>
            </li>
           
           
            <li class="nav-item">
              <a class="nav-link <?php if($filenameLink==''||$filenameLink=='home.php'){echo 'active';}?>" href="./home.php">
                <span class="nav-link-text">Home</span>
              </a>
            </li>
            <?php if(isset($session_id)){?>
            <li class="nav-item">
              <a class="nav-link <?php if($filenameLink=='newpost.php' && $_GET['category']=="route"){echo 'active';}?>" href="./newpost.php?category=route">
                <span class="nav-link-text">New Route</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($filenameLink=='newpost.php' && $_GET['category']=="journey"){echo 'active';}?>" href="./newpost.php?category=journey">
                <span class="nav-link-text">New Journey</span>
              </a>
            </li>
            <?php }else{ ?>
            <li class="nav-item">
              <a class="nav-link" href="./signup.php">
                <span class="nav-link-text">Signup</span>
              </a>
            </li>
              <li class="nav-item">
              <a class="nav-link" href="./login.php">
                <span class="nav-link-text">Login</span>
              </a>
            </li>
            <?php } ?>

            
            <?php if($session_role=="admin"){?>
            <li class="nav-item">
              <a class="nav-link <?php if($filenameLink=='users.php'){echo 'active';}?>" href="./users.php">
                <span class="nav-link-text">Users</span>
              </a>
            </li>
            <?php }?>
            <?php if($session_role=="admin" || $session_role=="approver"){?>
            <li class="nav-item">
              <a class="nav-link <?php if($filenameLink=='posts.php'){echo 'active';}?>" href="./posts.php">
                <span class="nav-link-text">Posts</span>
              </a>
            </li>
            <?php }?>
           
            <!--<li class="nav-item">-->
            <!--  <a class="nav-link <?php if($filenameLink=='settings.php'){echo 'active';}?>" href="./settings.php">-->
            <!--    <span class="nav-link-text">Profile Settings</span>-->
            <!--  </a>-->
            <!--</li>-->
          
            
          </ul>
          <!-- Divider -->
         
          
          
        </div>
      </div>
    </div>
  </nav>