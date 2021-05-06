<?include_once("./global.php");

if($logged==0){
    ?>
    <script type="text/javascript">
            window.location = "./";
        </script>
    <?
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
                
                array_push($myfiles, $newFileName);
            }
            else {
                array_push($error,"$file_name, ");
            }
        }
        
        $logo=json_encode($myfiles, true);
        
        }
     
    $timeAdded = time();
    $id = generateRandomString();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql="update gpxCollaborate_posts set title='$title', description='$description', timeAdded='$timeAdded', userId='$session_userId', id='$id', status='new', type='$route' ";
    }else{
        $sql="insert into gpxCollaborate_posts set title='$title', description='$description', timeAdded='$timeAdded', userId='$session_userId', id='$id', status='new', type='$route' ";
    }
    //echo $sql;
    if(!mysqli_query($con,$sql))
    {
        echo "err";
        
    }else{
        if(count($myfiles)>0){
		    $stmt = $con->prepare("UPDATE gpxCollaborate_posts set file='$logo' where id='$id';");
		    if( $stmt->execute()){
		        $stmt->close();
		    }
		}
		
		?>
    <script type="text/javascript">
            window.location = "./home.php?m=Your post was created and is awaiting approval.";
        </script>
    <?
    
		
    }
    
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
    <div class="col-md-9">
        <div class="alert alert-info" role="alert">
                <strong>Posts will show here in the next sprint.</strong>
            </div>
    </div>
      <div class="col-md-3">
          
          
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="h3 mb-0">Insert</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
               
                
            <form action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <input value="<?echo $title?>" type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Title" required>
              </div>
              
              <div class="form-group">
                <select required name="route" class=" form-control" >
                    <?foreach($g_routes as $route){?>
                        <option value="<?echo $route?>"><?echo $route?></option>
                    <?}?>
                    </select>
              </div>
              
              
              <div class="form-group">
                <textarea value="" type="text" name="description" placeholder="Description"  class="form-control" id="exampleFormControlInput1"  required><?echo $description?></textarea>
              </div>
              
             <div class="form-group">
                <label for="exampleFormControlInput1">File</label>
                <input type="file"  name="files[]" multiple  class="form-control" id="exampleFormControlInput1"  >
              </div>
              
              
              <div class="form-group">
                  <button class="btn btn-primary btn-md btn-block" type="submit">Insert</button>
              </div>
              
            </form>       
           

            </div>
          </div>
          
          
         </div>
          
          
    </div>

    
      <!-- Footer -->
      <?include_once("./phpParts/footer.php")?>
    </div>
  </div>
  <!-- Scripts -->
  <?include_once("./phpParts/footer-scripts.php")?>
  
  
  
</body>

</html>
