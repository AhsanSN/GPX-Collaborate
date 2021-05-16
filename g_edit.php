<?php 
include_once("./global.php");

$table = $_GET['t'];
$row = $_GET['r'];
$id = $_GET['i'];
$id_value = $_GET['iv'];
$callback = $_GET['c'];

//echo $row;
    
if(isset($_POST['title'])){
    $title = trim($_POST['title']);
    
    $table = $_GET['t'];
    $row = $_GET['r'];
    $id = $_GET['i'];
    $id_value = $_GET['iv'];
    $callback = $_GET['c'];
    
    $sql="update $table set $row='$title' where $id='$id_value' ";
    //echo $sql;
        if(!mysqli_query($con,$sql))
        {
            echo "err";
            echo mysqli_error($con);
        }else{
        ?>
        <script type="text/javascript">
            window.location = "<?php echo $callback;?>";
        </script>
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
  <?php include_once("./phpParts/sidenav.php")?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <?php include_once("./phpParts/topnav.php")?>
    <!-- Header -->
    <!-- Header -->
    <form method="post" action="" enctype="multipart/form-data">
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Edit Value</h6>
              
            </div>
            <?php if($session_role=="admin" || $session_role=="teacher"){?>
                <div class="col-lg-6 col-5 text-right">
                  <input type="submit" value="Save" class="btn btn-md btn-neutral" />
                </div>
            <?php }?>
            
          </div>
          <!-- Card stats -->
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12 col-md-21 col-lg-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="h3 mb-0">Edit Value</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
                
                    <?php 
                    $table = $_GET['t'];
                    $row = $_GET['r'];
                    $id = $_GET['i'];
                    $id_value = $_GET['iv'];
                    $callback = $_GET['c'];


                    $sql="select $row from $table where $id='$id_value' ";
                    //echo $sql;
                    $result = $con->query($sql);
                    if ($result->num_rows > 0){
                        while($row1 = $result->fetch_assoc()) 
                        {
                            $value = htmlentities($row1[$row]);
                        }
                    }
                    
                    //echo $value;
                    ?>
                  <div class="form-group">
                    <textarea type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="New Value" required><?php echo $value?></textarea>
                  </div>
           
           <p>If the input is for uploading a file, upload your file <a target="_blank" href="./g_fileupload.php">here</a> and then paste the link here.</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <?php include_once("./phpParts/footer.php")?>
    </div>
    </form>
  </div>
  <!-- Scripts -->
  <?php include_once("./phpParts/footer-scripts.php")?>
  
</body>

</html>
