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
    <div class="col-md-9">
       
       <div class="row">
       <? $query_quizQuestions= "select * from gpxCollaborate_posts where status='approve'"; 
        $result_quizQuestions = $con->query($query_quizQuestions);
        while($row = $result_quizQuestions->fetch_assoc()) 
        {
            foreach(json_decode($row['file'], true) as $fileorg){
                $file = strtolower($fileorg);
                $ext = end(explode('.', $file));
                if($ext=="gpx"){
                    $image = $row['image'];
                }else{
                    $image = "./uploads/".json_decode($row['file'], true)[0];
                }
            }
        ?>
        
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="<?echo $image?>" alt="<?echo $image?>">
                  <div class="card-body">
                    <h5 class="card-title"><?echo $row['title']?></h5>
                    <p class="card-text"><?echo $row['description']?></p>
                    <a href="./post.php?id=<?echo $row['id']?>" class="btn btn-primary">View</a>
                  </div>
                </div>
            </div>

         <?}?>
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
