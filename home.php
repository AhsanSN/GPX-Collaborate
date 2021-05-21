<?php 
include_once("./global.php");
include_once("./include/core/session.php");
include_once("./include/core/dbmodel.php");

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
                    Home
                </h6>
                 
            </div>
            
            
          </div>
          
            <?php if(isset($_GET['m'])){?>
              <div class="alert alert-warning" role="alert">
                <strong><?php echo $_GET['m'];?></strong>
            </div>
            <?php }?>
            <div class="alert alert-info" role="alert">
              <strong>Welcome to your account.</strong>
            </div>

            <form method="get" action="./home.php">
              <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search here...">
                <div class="input-group-append">
                  <button class="btn btn-white" type="submit">SEARCH</button>
                </div>
              </div>
            </form>
            
           
          <!-- Card stats -->
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        
    <div class="row">
    <div class="col-md-12">
       
       <div class="row">
       <?php  
        if(isset($_GET['search']) && !empty($_GET['search'])){
          $s = $_GET['search'];
          $query_quizQuestions= "select * from gpxCollaborate_posts where status='approve' AND title LIKE '%$s%'"; 
        }else{
          $query_quizQuestions= "select * from gpxCollaborate_posts where status='approve'"; 
        }
        $result_quizQuestions = $con->query($query_quizQuestions);
        while($row = $result_quizQuestions->fetch_assoc()) 
        {
          $pid = $row['id'];
          $review_sql = "SELECT * FROM `gpxCollaborate_reviews` AS review JOIN `gpxCollaborate_users` AS user ON review.user_id = user.id WHERE `post_id` = '$pid'";
          $getReviews = getAll($con,$review_sql);

          $sumOfRating = array_sum(array_column($getReviews,'rate'));
          $totalRating = count($getReviews);
          $avg = (int)((($sumOfRating*5)/($totalRating*5))/2);

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
        
            <div class="col-md-3">
                <div class="card" style="">
                  <img class="card-img-top" src="<?php echo $image?>" alt="<?php echo $image?>">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']?></h5>
                    <p class="card-text"><?php echo $row['description']?></p>

                    <?php if($avg != null){ ?>
                    <div class="d-inline float-right mt-2" style="font-size: 1.2em;"  data-rating-value="<?php echo $avg; ?>" data-rating-readonly="true" data-rating-stars="5"></div>
                    <?php }?>
                    
                    <a href="./post.php?id=<?php echo $row['id']?>" class="btn btn-primary float-left">View</a>
                  </div>
                </div>
            </div>

         <?php }?>
        </div>
       
    </div>

          
    </div>

    
      <!-- Footer -->
      <?php include_once("./phpParts/footer.php")?>
    </div>
  </div>
  <!-- Scripts -->
  <?php include_once("./phpParts/footer-scripts.php")?>
  
  
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="assets/js/rating.js"></script>
</body>

</html>
