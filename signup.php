<?include_once("global.php");?>
    <?
    
if($logged==1){
    ?>
    <script type="text/javascript">
            window.location = "./home.php";
        </script>
    <?
} 
if(isset($_GET['logout'])){
    session_destroy();
    $logged=0;
    ?>
    <script type="text/javascript">
            window.location = "./";
        </script>
    <?
}


if(isset($_POST['name'])){
    $name = mb_htmlentities(($_POST['name']));
    $email = mb_htmlentities(($_POST['email']));
    $route = mb_htmlentities(($_POST['route']));
    $referral = mb_htmlentities(($_POST['referral']));
    $country = mb_htmlentities(($_POST['country']));
    $state = mb_htmlentities(($_POST['state']));
    $city = mb_htmlentities(($_POST['city']));
    
    $password = mb_htmlentities( md5(md5(sha1( $_POST['password'])).'Anomoz'));    
    $id = generateRandomString();
    
    
    
    
    $sql="insert into gpxCollaborate_users set name='$name', email='$email', password='$password', id='$id', 
    country='$country', state='$state', city='$city', route='$route', referral='$referral', timeAdded=now()";
    if(!mysqli_query($con,$sql))
    {
        // echo "err";
        $error = "yes";
        
    }else{
        
        $logged=1;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        ?>
        <script type="text/javascript">
            window.location = "./home.php";
        </script>
        <?
            
        /**
        $desc = "Your account has been setup. Your credentials are<br>
Email: $email<br>
Password: $password_org<br>
You are requested to change your password at your earliest. <br>
Login now: https://projects.anomoz.com/gpxCollaborate/ <br>
Thank you.
        ";
        sendEmailNotification("Your account has been setup.", $desc, $email);
        **/
    }
    
    
}


?>
<!DOCTYPE html>
<html>

<head>
  <?include_once("./phpParts/header.php")?>
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
                 
                Signup
              
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
                    
                    <input class="form-control" placeholder="Name" type="text" required name="name">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                   
                    <input class="form-control" placeholder="Email" type="email" required name="email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    
                    <input class="form-control" placeholder="Password" type="password" required name="password">
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    
                    <select required name="route" class=" form-control" >
                    <option value="All">All Routes</option>
                    <?foreach($g_routes as $route){?>
                        <option value="<?echo $route?>"><?echo $route?></option>
                    <?}?>
                    </select>
                  </div>
                </div>
                
                
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    
                    <select  name="country" class="countries form-control" id="countryId">
    <option value="">Select Country</option>
</select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    
                    <select name="state" class="states form-control" id="stateId">
    <option value="">Select State</option>
</select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    
                   <select name="city" class="cities form-control" id="cityId">
    <option value="">Select City</option>
</select>
                  </div>
                </div>
                
                 <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    
                    <input class="form-control" placeholder="Referred by (Name)" type="text" name="referral">
                  </div>
                </div>
                
                




                <?if($error=="yes"){?>
                <div class="alert alert-danger">Email is under use. Please try a different one.</div>
                <?}?>
               
                
                <div class="text-center">
                  <input type="submit" class="btn btn-primary mt-4" value="Signup">
                </div>
                 <div class="text-center">
                </div>
                <br>
                <a href="./">Already have an account? Login!</a>
                
                
              </form>
              
               
            </div>
          </div>
         
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?include_once("./phpParts/footer-login-signup.php")?>
  <!-- Scripts -->
  <?include_once("./phpParts/footer-scripts.php")?>
  
  
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script src="//geodata.solutions/includes/countrystatecity.js"></script>
  
</body>

</html>