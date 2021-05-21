<?php include_once("./global.php");

if($logged==0){
  ?>
  <script type="text/javascript">
    window.location = "./";
  </script>
  <?php 
} 


if(isset($_POST['title'])){
  $title = mb_htmlentities(($_POST['title']));
  $route = mb_htmlentities(($_POST['route']));
  $description = mb_htmlentities(($_POST['description']));
  $price = mb_htmlentities(($_POST['price']));
  $userId= $session_userId;


  if(isset($_FILES["files"])){

        //echo "asd";
    $myfiles = array();
    $extension=array("jpeg","jpg","png","gif");

    /*code by keyur*/
    if(pathinfo($_FILES["files"]["name"][0],PATHINFO_EXTENSION) == trim("gpx")){
        
        //()
      $fname = generateRandomString()."_merged.gpx";
      $newGpxFileName = "./uploads/".$fname; 
      $gpxFileCreate = fopen($newGpxFileName,"w");
      $lastItemKey = count($_FILES);
    }
    /*end code by keyur*/
    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
      $txtGalleryName = generateRandomString();
      $file_name=$_FILES["files"]["name"][$key];
      $file_tmp=$_FILES["files"]["tmp_name"][$key];
      $ext=pathinfo($file_name,PATHINFO_EXTENSION);
    
    
      if(true) {
        if(!file_exists("./uploads/".$file_name)) {

          $filename=basename($file_name,$ext);
          $newFileName=$filename.time().".".$ext;
          move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"./uploads/".$newFileName);

                    //var_dump($a);
        }
        else {
          $filename=basename($file_name,$ext);
          $newFileName=$filename.time().".".$ext;
          move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"./uploads/".$newFileName);
        }
        
        
        /*code by keyur*/
        if(pathinfo($_FILES["files"]["name"][0],PATHINFO_EXTENSION) == trim("gpx")){
          $fcontent = file_get_contents("./uploads/".$newFileName);
          
        //   echo "file: ".$newFileName."<br>";
          if(count($_FILES["files"]["tmp_name"])>1){
              
              if(count($myfiles)==0){
                //   echo "replacing end:<br>";
                  $fcontent = preg_replace("/(<\/gpx.*)/", "", $fcontent);
              }else{
                //   echo "replacing start:<br>";
                  $fcontent = preg_replace("/(<\?xml.*)/", "", $fcontent);
                  $fcontent = preg_replace("/(<gpx.*)/", "", $fcontent);
              }
          }
            
            // echo $fcontent;
          
          fwrite($gpxFileCreate,$fcontent);
          fwrite($gpxFileCreate,"<!-- $newFileName comment -->");
        }
        /*end code by keyur*/
        array_push($myfiles, $newFileName);
      }
      
    }

    if($gpxFileCreate && (pathinfo($_FILES["files"]["name"][0],PATHINFO_EXTENSION) == trim("gpx"))){
        echo "merged created";
        $myfiles = array($fname);
        fclose($gpxFileCreate);
    }else{
      
    }
    
    $logo=json_encode($myfiles, true);
  }
  
  
  
  $timeAdded = time();
  $id = generateRandomString();
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql="update gpxCollaborate_posts set title='$title', description='$description', timeAdded='$timeAdded', userId='$session_userId', type='$route' where id='$id'  ";
  }else{
    $sql="insert into gpxCollaborate_posts set title='$title', description='$description', timeAdded='$timeAdded', userId='$session_userId', id='$id', status='new', type='$route' ";
  }
    //echo $sql;
  if(!mysqli_query($con,$sql))
  {
    echo "err";

  }else{
    if(count($myfiles)>0){

            //if gfx
      foreach($myfiles as $fileorg){
        $file = strtolower($fileorg);
        $ext = end(explode('.', $file));
        if($ext=="gpx"){
          $gpxfile = $fileorg;
          $url = "$g_project_url"."gfx_to_png.php?filename=$gpxfile";

          $urlPing = "https://www.api.anomoz.com/api/anomoz/url_to_png.php?url=".urlencode($url)."&ViewportWidth=850";
          $ch = curl_init();

          curl_setopt($ch, CURLOPT_URL, $urlPing);
          curl_setopt($ch, CURLOPT_HEADER, 0);

          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

          curl_setopt($ch, CURLOPT_TIMEOUT, 10);

          $image = curl_exec($ch);


        }
      }





      $stmt = $con->prepare("UPDATE gpxCollaborate_posts set file='$logo', image='$image' where id='$id';");
      if( $stmt->execute()){
        $stmt->close();
      }
    }

    if(!isset($_GET['id'])){
      ?>
      <script type="text/javascript">
        window.location = "./home.php?m=Your post was created and is awaiting approval.";
      </script>
      <?php 
    }else{
      ?>
      <script type="text/javascript">
        window.location = "?";
      </script>
      <?php 
    }

  }
  
  

}


if(isset($_GET['delete-post'])){
  $id = $_GET['delete-post'];
  if($id!="admin"){
    $sql="delete from gpxCollaborate_posts where id='$id' and userId='$session_userId'";
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
                Posts
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
                  <h5 class="h3 mb-0">Insert</h5>
                </div>
              </div>
            </div>
            <div class="card-body">

              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Title</th>
                      <th scope="col">Description</th>
                      <th scope="col">Type</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                   <?php      


                   $query_quizQuestions= "select * from gpxCollaborate_posts where userId='$session_userId'"; 
                   $result_quizQuestions = $con->query($query_quizQuestions);
                   if ($result_quizQuestions->num_rows > 0)
                   { 
                    //successfull login
                    while($row = $result_quizQuestions->fetch_assoc()) 
                    { 



                      ?>
                      <tr>
                        <td>
                          <?php echo $row['title']?>
                        </td>

                        <td>
                          <?php echo $row['description']?>
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
                              <a class="btn btn-warning btn-sm" href="?id=<?php echo $row['id']?>">Edit</a>
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


    </div>
    <div class="col-md-4">


      <div class="card">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h5 class="h3 mb-0">Insert / Update</h5>
            </div>
          </div>
        </div>
        <div class="card-body">

         <?php 
         $id = $_GET['id'];

         $query_quizQuestions= "select * from gpxCollaborate_posts where id='$id'"; 
         $result_quizQuestions = $con->query($query_quizQuestions);
         while($row = $result_quizQuestions->fetch_assoc()) 
         { 
          $data = $row;
        }?>

        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <input value="<?php echo $data['title']?>" type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Title" required>
          </div>

          <div class="form-group">
            <select required name="route" class=" form-control" >
              <?php foreach($g_routes as $route){?>
                <option value="<?php echo $route?>" <?php if($route==$data['route']){echo "selected";}?>><?php echo $route?></option>
              <?php }?>
            </select>
          </div>


          <div class="form-group">
            <textarea value="" type="text" name="description" placeholder="Description"  class="form-control" id="exampleFormControlInput1"  required><?php echo $data['description']?></textarea>
          </div>

          <div class="form-group">
            <label for="exampleFormControlInput1">File</label>
            <input type="file"  name="files[]" multiple  class="form-control" id="exampleFormControlInput1"  >
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
