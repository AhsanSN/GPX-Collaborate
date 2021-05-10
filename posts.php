<?include_once("./global.php");

if($session_userId!="admin" && $session_userId!="approver"){
    ?>
    <script type="text/javascript">
            window.location = "./";
        </script>
    <?
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
                    All posts  
                </h6>
                 
            </div>
            
            
            
          </div>
          
        
                  <?if(isset($_GET['delete-user'])){?>
              <div class="alert alert-success" role="alert">
                <strong>User deleted successfully</strong>
            </div>
            <?}?>
            
            
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        
    <div class="row">
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
            <th scope="col">Description</th>
            <th scope="col">Type</th>
             <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            
           <?     
        
                
           $query_quizQuestions= "select * from gpxCollaborate_posts"; 
                $result_quizQuestions = $con->query($query_quizQuestions);
                if ($result_quizQuestions->num_rows > 0)
                { 
                    //successfull login
                    while($row = $result_quizQuestions->fetch_assoc()) 
                    { 
                        
                        
                        
                ?>
              <tr>
                <td>
                    <?echo $row['title']?>
                </td>
                
                <td>
                    <?echo $row['description']?>
                </td>
                <td>
                    <?echo ucfirst($row['type'])?>
                </td>
                <td>
                    <?echo ucfirst($row['status'])?>
                </td>
               
                
                <td>
                    <div class="media align-items-center">
                        <div class="media-body">
                            
                            <a class="btn btn-primary btn-sm" href="./post.php?id=<?echo $row['id']?>">View</a>

                            <?if($row['status']=="new"){?>
                                <a class="btn btn-success btn-sm" href="?change-status=<?echo $row['id']?>&role=approve">Approve</a>
                                <a class="btn btn-warning btn-sm" href="?change-status=<?echo $row['id']?>&role=disapprove">Disapprove</a>
                            <?}?>
                            <a class="btn btn-danger btn-sm" href="?delete-post=<?echo $row['id']?>">Delete</a>

                            
                          
                          </span>
                        </div>
                    </div>
                </td>
              
              </tr>
              <?}
              }?>
        </tbody>
      </table>
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
