<?php include_once("./global.php");

if($session_userId!="admin" && $session_userId!="approver"){
    ?>
    <script type="text/javascript">
            window.location = "./";
        </script>
    <?php 
} 

if(isset($_FILES["files"])){

        //echo "asd";
        $id = $_GET['upload-image'];
    $myfiles = array();
    $extension=array("jpeg","jpg","png","gif");


    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
      $txtGalleryName = generateRandomString();
      $file_name=$_FILES["files"]["name"][$key];
      $file_tmp=$_FILES["files"]["tmp_name"][$key];
      $ext=pathinfo($file_name,PATHINFO_EXTENSION);
    
    
      if(true) {
        $filename=basename($file_name,$ext);
      $newFileName=$filename.time().".".$ext;
      move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"./uploads/".$newFileName);

        
        
        $sql="update gpxCollaborate_posts set image='$newFileName' where id='$id'";
        if(!mysqli_query($con,$sql))
        {
            echo "err";
        }
        
        
      }
      
    }

    header("Location: ./posts.php");
 }



if(isset($_GET['change-status'])){
    $id = $_GET['change-status'];
    $role = $_GET['role'];
    if($id!="admin"){
        $sql="update gpxCollaborate_posts set status='$role' where id='$id'";
        if(!mysqli_query($con,$sql))
        {
            echo "err";
        }
    }
}

if(isset($_GET['delete-post'])){
    $id = $_GET['delete-post'];
    if($id!="admin"){
        $sql="delete from gpxCollaborate_posts where id='$id' and id!='admin'";
        if(!mysqli_query($con,$sql))
        {
            echo "err";
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
                    All posts  
                </h6>
                 
            </div>
            
            
            
          </div>
          
        
                  <?php if(isset($_GET['delete-user'])){?>
              <div class="alert alert-success" role="alert">
                <strong>User deleted successfully</strong>
            </div>
            <?php }?>
            
            
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        
    <div class="row">
        <?if(!isset($_GET['upload-image'])){?>
  <div class="col-md-12">
      
      <div class="card" style="margin-top:50px;">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Posts</h3>
        </div>
        
      </div>
    </div>
    
    
    <div class="table-responsive">
      <!-- Projects table -->
      <table class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Image</th>
            <th scope="col">Type</th>
             <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            
           <?php      
        
                
           $query_quizQuestions= "select * from gpxCollaborate_posts"; 
                $result_quizQuestions = $con->query($query_quizQuestions);
                if ($result_quizQuestions->num_rows > 0)
                { 
                    //successfull login
                    while($row = $result_quizQuestions->fetch_assoc()) 
                    { 
                        
                        $files = json_decode($row['file'], true);
                        $i = 0;
                        foreach($files as $filen){
                            $i+=1;
                            $file = strtolower($filen);
                            $ext = end(explode('.', $file));
                            if($ext=="gpx"){
                                $gpxFile = $filen;
                            }
                        }
                        
                ?>
              <tr>
                <td>
                    <?php echo $row['title']?>
                </td>
                
                <td>
                    <?if($row['image']!=""){?>
                    <img src="./uploads/<?php echo $row['image']?>" style="width: 100px;">
                    <?}else{?>
                    
                    <?}?><br>
                    <a href="?upload-image=<?echo $row['id']?>" class="btn btn-sm btn-warning">Upload Image</a>
                    <a href="<?echo $g_project_url?>embed.php?f=<?echo $gpxFile?>" target="_blank"  class="btn btn-sm btn-info">View Map</a>
                </td>
                <td>
                    <?php echo ucfirst($row['type'])?>
                </td>
                <td>
                    <?php echo ucfirst($row['status'])?>
                </td>
               
                
                <td>
                    <div class="media align-items-center">
                        <div class="media-body">
                            
                            <a class="btn btn-primary btn-sm" href="./post.php?id=<?php echo $row['id']?>">View</a>

                            <?php if($row['status']=="new"){?>
                                <a class="btn btn-success btn-sm" href="?change-status=<?php echo $row['id']?>&role=approve">Approve</a>
                                <a class="btn btn-warning btn-sm" href="?change-status=<?php echo $row['id']?>&role=disapprove">Disapprove</a>
                            <?php }?>
                            <a class="btn btn-danger btn-sm" href="?delete-post=<?php echo $row['id']?>">Delete</a>

                            
                          
                          </span>
                        </div>
                    </div>
                </td>
              
              </tr>
              <?php }
              }?>
        </tbody>
      </table>
    </div>
  </div>
  
  </div>
  <?}?>
  
  <?if(isset($_GET['id']) || isset($_GET['upload-image'])){?>
    <div class="col-md-12">


      <div class="card">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h5 class="h3 mb-0">Upload Image</h5>
            </div>
          </div>
        </div>
        <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">
          

          <div class="form-group">
            <label for="exampleFormControlInput1">Upload Image File <small></label>
            <input type="file" accept=".png,.jpg,.jpeg" name="files[]" class="form-control" id="exampleFormControlInput1"  >
          </div>

          <div class="form-group">
            <button class="btn btn-primary btn-md btn-block" type="submit">Submit</button>
          </div>

        </form>       


      </div>
    </div>


  </div>
  <?}?>
  
  
</div>

    
      <!-- Footer -->
      <?php include_once("./phpParts/footer.php")?>
    </div>
  </div>
  <!-- Scripts -->
  <?php include_once("./phpParts/footer-scripts.php")?>

  
</body>

</html>
