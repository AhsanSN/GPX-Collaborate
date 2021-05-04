<?include_once("./global.php");

if($logged==0){
    ?>
    <script type="text/javascript">
            window.location = "./";
        </script>
    <?
} 

?>
<!DOCTYPE html>
<html>

<head>
  <?include_once("./phpParts/header.php")?>
  
</head>

<body>
  <!-- Sidenav -->
  <?
 
    include_once("./phpParts/sidenav.php");

  ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <?include_once("./phpParts/topnav.php")?>
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
              
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">
                    Home
                </h6>
                 
            </div>
            
            
          </div>
          
            <?if(isset($_GET['m'])){?>
              <div class="alert alert-warning" role="alert">
                <strong><?echo $_GET['m'];?></strong>
            </div>
            <?}?>
          <div class="alert alert-info" role="alert">
                <strong>Welcome to your account.</strong>
            </div>
           
          <!-- Card stats -->
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        
    <div class="row">
      
</div>

    
      <!-- Footer -->
      <?//include_once("./phpParts/footer.php")?>
    </div>
  </div>
  <!-- Scripts -->
  <?include_once("./phpParts/footer-scripts.php")?>
  
  
  
</body>

</html>
