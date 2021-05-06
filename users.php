<?include_once("./global.php");

if($session_userId!="admin"){
    ?>
    <script type="text/javascript">
            window.location = "./";
        </script>
    <?
} 

if(isset($_GET['change-user'])){
    $id = $_GET['change-user'];
    $role = $_GET['role'];
    if($id!="admin"){
        $sql="update gpxCollaborate_users set role='$role' where id='$id'";
        if(!mysqli_query($con,$sql))
        {
            echo "err";
        }
    }
}

if(isset($_GET['delete-user'])){
    $id = $_GET['delete-user'];
    if($id!="admin"){
        $sql="delete from gpxCollaborate_users where id='$id' and id!='admin'";
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
                    All Users  
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
  <div class="col-md-8">
      
      <div class="card" style="margin-top:50px;">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Users</h3>
        </div>
        
      </div>
    </div>
    
    
    <div class="table-responsive">
      <!-- Projects table -->
      <table class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            
           <?     
        
                
           $query_quizQuestions= "select * from gpxCollaborate_users"; 
                $result_quizQuestions = $con->query($query_quizQuestions);
                if ($result_quizQuestions->num_rows > 0)
                { 
                    //successfull login
                    while($row = $result_quizQuestions->fetch_assoc()) 
                    { 
                        
                        
                        
                ?>
              <tr>
                <td>
                    <?echo $row['name']?>
                </td>
                
                <td>
                    <?echo $row['email']?>
                </td>
                <td>
                    <?echo ucfirst($row['role'])?>
                </td>
               
                
                <td>
                    <div class="media align-items-center">
                        <div class="media-body">
                            
                            <?if($row['role']=="user"){?>
                                <a class="btn btn-success btn-md" href="?change-user=<?echo $row['id']?>&role=approver">Make Approver</a>
                            <?}else if($row['role']=="approver"){?>
                                <a class="btn btn-warning btn-md" href="?change-user=<?echo $row['id']?>&role=user">Make User</a>
                            <?}?>
                            <a class="btn btn-danger btn-md" href="?delete-user=<?echo $row['id']?>">Delete</a>

                            
                          
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
