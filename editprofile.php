<?php 
include_once("./global.php");

if($logged==0){
  ?>
  <script type="text/javascript">
    window.location = "./";
  </script>
  <?php 
} 

if(isset($_POST['password'])){
    $password = ( md5(md5(sha1( $_POST['password'])).'Anomoz'));
    $password2 = ( md5(md5(sha1( $_POST['password2'])).'Anomoz'));
    
    if($password2==$password){
        $sql="update gpxCollaborate_users set password='$password' where id='$session_userId'";
        if(!mysqli_query($con,$sql))
        {
            echo "err";
        }else{
            $_SESSION['password'] = $row['password'];
            $passwordChanged = "yes";
        }
    }
}

if(isset($_POST['name'])){
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    /*
    if(isset($_FILES['image']) && (strlen($_FILES['image']['name']) > 0)){
    $image = trim(uploadFile($_FILES['image']));
    $sql="update gpxcollaborate_users set `pic`='$image' where id='$session_userId'";
        if(!mysqli_query($con,$sql))
        {
            echo "err";
        }
  }
  */

    $sql="update gpxCollaborate_users set `name`='$name', `phone`='$phone' where id='$session_userId'";
        if(!mysqli_query($con,$sql))
        {
            echo "err1";
            $dupErr = "yes";
        }else{
            ?>
            <script>window.location = "./editprofile.php";</script>
            <?php
        }
            
    
}

?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once("./phpParts/header.php")?>
  
</head>

<body>
  <!-- Sidenav -->
  <?php 

  include_once("./phpParts/sidenav.php");

  ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <?php include_once("./phpParts/topnav.php")?>
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">

            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">
                My Profile
              </h6>

            </div>
            
            
          </div>
          
          <?php if(isset($_GET['m'])){?>
            <div class="alert alert-warning" role="alert">
              <strong><?php echo $_GET['m'];?></strong>
            </div>
          <?php }?>


          <!-- Card stats -->
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">

      <div class="row">
        <div class="col-md-8">

          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="h3 mb-0">Personal Information</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
             <form action="" method="post" enctype="multipart/form-data">

              <?php if($session_pic!=""){?>
                <!--<img src="./uploads/<?php echo $session_pic; ?>" style="height:100px;">-->
              <?php }?>
<!--
              <div class="form-group">
                <label for="profileImg">Profile Pic</label>
                <input type="file" name="image" class="form-control" id="profileImg"  >
              </div>
-->
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?php echo $session_name; ?>" autocomplete="off" required>
              </div>

              <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" autocomplete="off" value="<?php echo $session_email; ?>" readonly>
              </div>

              <div class="form-group">
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" value="<?php echo $session_phone; ?>" autocomplete="off" required>
              </div>

              <div class="form-group">
                <button class="btn btn-primary btn-md float-right" type="submit">Submit</button>
              </div>

            </form>  
            </div>
          </div>


        </div>
        <div class="col-md-4">


          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="h3 mb-0">Change Password</h5>
                </div>
              </div>
            </div>
            <div class="card-body">


            <form action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <input value="" type="password" name="password" class="form-control" id="" placeholder="Password" autocomplete="off" required>
              </div>

              <div class="form-group">
                <input type="password" name="password2" class="form-control" id="" placeholder="Confirm Password" autocomplete="off" required>
              </div>

              <div class="form-group">
                <button class="btn btn-primary btn-md btn-block" type="submit">Submit</button>
              </div>

            </form>       


          </div>
        </div>


      </div>


    </div>


    <!-- Footer -->
    <?php include_once("./phpParts/footer.php")?>
  </div>
</div>
<!-- Scripts -->
<?php include_once("./phpParts/footer-scripts.php")?>



</body>

</html>
