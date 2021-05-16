<?php 
include_once("./global.php");

if(isset($_FILES["fileToUpload"])){
            $randomName = time();
            $target_dir = "./uploads/";
            $fileName_db = "aud_".$randomName.basename($_FILES["fileToUpload"]["name"]);
            $target_file = $target_dir . "aud_".$randomName.basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if($_FILES["fileToUpload"]["tmp_name"]!="") {
                
                $uploadOk = 1;
            
            // Check if file already exists
            if (file_exists($target_file)) {
                //echo "Sorry, file already exists.";
                $filename=basename( $_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 5000000000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if(false) {
                echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    $filename=basename( $_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
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
              <h6 class="h2 text-white d-inline-block mb-0">Upload file</h6>
              
            </div>
            <?php if($session_role=="admin" || $session_role=="teacher"){?>
                <div class="col-lg-6 col-5 text-right">
                  <input type="submit" value="Upload" class="btn btn-md btn-neutral" />
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
                  <h5 class="h3 mb-0">Upload file</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
                
                  <div class="form-group">
                    <input type="file" name="fileToUpload" class="form-control" id="exampleFormControlInput1" placeholder="New Value" required>
                  </div>
                  
                  <?php echo $fileName_db?>
           
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
