<?php 
include_once("global.php");?>
<?php 

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $query = "SELECT * FROM gpxcollaborate_users WHERE passwordResetId='$token'";
    $result = $con->query($query);
    if ($result->num_rows > 0){
        //
    }else{
        ?>
            <script type="text/javascript">
                window.location = "./";
            </script>
        <?php 
    }

}else{
    ?>
        <script type="text/javascript">
            window.location = "./";
        </script>
    <?php 
}


if(isset($_POST['password'])){

    $password = mysqli_real_escape_string($con,md5(md5(sha1( $_POST['password'])).'Anomoz'));
    $sql="update gpxcollaborate_users set password='$password' where passwordResetId='$token'";
    if(!mysqli_query($con,$sql))
    {
        echo "err";
    }else{
    
        ?>
        <script type="text/javascript">
            window.location = "./";
        </script>
    <?php 
        
    }
    
}
?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once("./phpParts/header.php")?>
  <style>
  .fill-default {
      fill:#e8e8e8;
  }
  .bg-default {
    background-color: #e8e8e8 !important;
}
      
  </style>
</head>

<body class="bg-default">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="./">
        <h3 style="font-size: 30px;color: white;font-weight:800;">

            

            <!--
            EduSkot
            -->
            </h3>
      </a>
     
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9" style="padding-bottom:5rem!important;padding-top:8rem!important;">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">
                 
                Reset Password
              
              </h1>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <form role="form" method="post" action="">
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="New Password" type="password" required name="password">
                  </div>
                </div>
                
                
              
               
               <?php if(isset($_GET['email-sent'])){?>
              <div class="alert alert-success" role="alert">
                <strong>Email Sent. Check your spam box</strong>
            </div>
            <?php }?>
                
                <div class="text-center">
                  <input type="submit" class="btn btn-primary mt-4" value="Change Password">
                </div>
                 <div class="text-center">
                     
                </div>
                
                
                
              </form>
              
               
            </div>
          </div>
         
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php include_once("./phpParts/footer-login-signup.php")?>
  <!-- Scripts -->
  <?php include_once("./phpParts/footer-scripts.php")?>
  
  <script>
      function submitlanguageform(){
            $("#languageform").submit();
        }
  </script>
</body>

</html>