<?php 
include_once("./global.php");
include_once("./include/core/session.php");
include_once("./include/core/dbmodel.php");


$id = $_GET['id'];
$query_quizQuestions= "select * from gpxCollaborate_posts where id='$id'"; 
$result_quizQuestions = $con->query($query_quizQuestions);
while($row = $result_quizQuestions->fetch_assoc()) 
{ 
    $postDeets = $row;
}

/*get all comments*/
$comment_sql = "SELECT * FROM `gpxcollaborate_comments` AS com JOIN `gpxCollaborate_users` AS user ON com.user_id = user.id WHERE `post_id` = '$id'";
$getComments = getAll($con,$comment_sql);
/*end of get all comments*/

/*get all comments*/
$review_sql = "SELECT * FROM `gpxCollaborate_reviews` AS review JOIN `gpxCollaborate_users` AS user ON review.user_id = user.id WHERE `post_id` = '$id'";
$getReviews = getAll($con,$review_sql);

$sumOfRating = array_sum(array_column($getReviews,'rate'));
$totalRating = count($getReviews);
$avg = (int)((($sumOfRating*5)/($totalRating*5))/2);

$isUserPostReview = in_array($session_id,array_column($getReviews,'user_id'));
/*end of get all comments*/
?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once("./phpParts/header.php")?>
  	<style>
		    body {
	margin: 0;
}
html, body, #leaflet {
	height: 100%
}
		</style>
		<link type="text/css" rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" type="text/css" href="./assets/css/site-style.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://unpkg.com/leaflet/dist/leaflet-src.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-gpx/1.4.0/gpx.min.js"></script>
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
                    <?php echo $postDeets['title']?>
                </h6>
                 
            </div>
            
            
          </div>
          
           
           
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
                  <h5 class="h3 mb-0"><?php echo $postDeets['title']?></h5>
                </div>
              </div>
            </div>
            <div class="card-body" style="a:1000px;">
                
                
                <?php $files = json_decode($postDeets['file'], true);
                foreach($files as $filen){
                    $file = strtolower($filen);
                    $ext = end(explode('.', $file));
                    if($ext=="gpx"){
                        $gpxFile = $filen;
                        ?><div id="leaflet" style="height:400px;"></div><?php 
                    }else if(in_array($ext, array("png", "jpg", "jpeg"))){
                        ?><img src="./uploads/<?php echo $filen?>" style="width:100%;" ><?php 
                    }else if(in_array($ext, array("mp4"))){
                        ?>
                             <video width="320" height="240" controls>
                              <source src="./uploads/<?php echo $filen?>" type="video/mp4">
                            Your browser does not support the video tag.
                            </video> 
                        <?php 
                    }
                ?>
                    
                <?php }?>
                
                <p><?php echo $postDeets['description']?></p>
               


            </div>
          </div>
          <?if($gpxFile!=""){?>
              <div class="alert alert-info" role="alert">
              <strong>Embed map: </strong> <?echo $g_project_url?>embed.php?f=<?echo $gpxFile?>
            </div>
            <?}?>
          
    </div>
      <div class="col-md-4">
          
          
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="h3 mb-0">Comment Section</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <?php 
              if(getFlash("error")){
                ?>
                <div class="alert <?php echo getFlashType("error"); ?> alert-bold alert-dismissible fade show" role="alert">
                  <span class="alert-text">
                    <?php echo getFlash("error"); removeFlash("error"); ?>
                  </span>
                </div>
              <?php } ?>
              
              


              <?php if(isset($session_id)){ ?>
              <form method="post" action="./include/models/comment.php">
                <div class="input-group mb-3">
                  <input type="text" name="body" class="form-control" placeholder="Comment...">
                  <input type="hidden" name="CREATE_COMMENT" value="true">
                  <input type="hidden" name="post_id" value="<?php echo $id;?>">
                  <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">
                      <i class="ni ni-send"></i>
                    </button>
                  </div>
                </div>
              </form>
              <?php } ?>
              
              <div class="list-group comment-box">
                <!-- foreach of comments -->
                <?php
                foreach($getComments as $comment){
                ?>
                <a href="#" class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?php echo $comment['name']; ?></h5>
                    <small><?php echo date("d M",strtotime($comment['created_at'])); ?></small>
                  </div>
                  <small><?php echo $comment['body']; ?></small>
                  <!-- auth check for remove comment -->
                  <?php
                  if(($comment['user_id'] == $_SESSION['userId']) || in_array($_SESSION['role'],['admin','approver'])){
                  ?>
                  <div class="float-right">
                    <form method="post" action="./include/models/comment.php">
                      <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>">
                      <input type="hidden" name="DELETE_COMMENT" value="true">
                      <input type="hidden" name="post_id" value="<?php echo $id;?>">
                      <button class="btn btn-sm btn-outline-danger">REMOVE</button>
                    </form>
                  </div>
                  <?php } ?>
                  <!-- end auth check for remove comment -->
                </a>
                <?php } ?>
                <!-- end foreach of comments -->
              </div>
                


            </div>
          </div>
          
          
         </div>
          
            <div class="col-md-8 mb-3">
          
          
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="h3 mb-0 d-inline float-left">Ratting and Reviews</h5>
                  <div class="showstarrating d-inline float-right" style="font-size: 1.2em;"  data-rating-value="<?php echo $avg; ?>" data-rating-readonly="true" data-rating-stars="5"></div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <?php 
              if(getFlash("review-error")){
                ?>
                <div class="alert <?php echo getFlashType("review-error"); ?> alert-bold alert-dismissible fade show" role="alert">
                  <span class="alert-text">
                    <?php echo getFlash("review-error"); removeFlash("review-error"); ?>
                  </span>
                </div>
              <?php } ?>

              <?php if(isset($session_id) && !$isUserPostReview){ ?>
              <form method="post" action="./include/models/review.php">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="hidden" name="rate">
                      <label>Rate</label>
                      <div class="starrating" style="font-size: 2em;"></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="hidden" name="difficulty_rates">
                      <label>Difficulty Rates</label>
                      <div class="starrating" style="font-size: 1.2em;"></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="hidden" name="view_rates">
                      <label>View Rates</label>
                      <div class="starrating" style="font-size: 1.2em;"></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="hidden" name="crowdesness_rates">
                      <label>Crowdesness Rates</label>
                      <div class="starrating" style="font-size: 1.2em;"></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="hidden" name="surface_rates">
                      <label>Surface Rate</label>
                      <div class="starrating" style="font-size: 1.2em;"></div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="description" placeholder="Review..."></textarea>
                  <input type="hidden" name="post_id" value="<?php echo $id;?>">
                  <input type="hidden" name="CREATE_REVIEW" value="true">
                  <button class="btn btn-sm btn-primary mt-4" type="submit">
                    SUBMIT
                  </button>
                </div>
              </form>
              <?php } ?>
              
              <div class="list-group comment-box">
                <!-- foreach of comments -->
                <?php
                foreach($getReviews as $review){
                  $avgRate += $review['rate'];
                ?>
                <a href="#" class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?php echo ucfirst($review['name']); ?></h5>
                    <small><?php echo date("d M",strtotime($review['created_at'])); ?></small>
                  </div>
                  <div class="ratelist" data-rating-stars="10" data-rating-value="<?php echo $review['rate']; ?>" data-rating-readonly="true"></div>
                  <strong class="d-block mb-2"><?php echo $review['description']; ?></strong>
                  <?php if(isset($review['difficulty_rates'])){ ?>
                  <small class="d-block text-muted"><b>Difficulty Rates : </b><?php echo $review['difficulty_rates']; ?></small>
                  <?php }?>

                  <?php if(isset($review['view_rates'])){ ?>
                  <small class="d-block text-muted"><b>View Rates : </b><?php echo $review['view_rates']; ?></small>
                  <?php }?>

                  <?php if(isset($review['crowdesness_rates'])){ ?>
                  <small class="d-block text-muted"><b>Crowdesness Rates : </b><?php echo $review['crowdesness_rates']; ?></small>
                  <?php }?>

                  <?php if(isset($review['surface_rates'])){ ?>
                  <small class="d-block text-muted"><b>Surface Rates : </b><?php echo $review['surface_rates']; ?></small>
                  <?php }?>
                  <!-- auth check for remove comment -->
                  <?php
                  if(($review['user_id'] == $_SESSION['userId']) || in_array($_SESSION['role'],['admin'])){
                  ?>
                  <div class="float-right">
                    <form method="post" action="./include/models/review.php">
                      <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
                      <input type="hidden" name="DELETE_REVIEW" value="true">
                      <input type="hidden" name="post_id" value="<?php echo $id;?>">
                      <button class="btn btn-sm btn-outline-danger">REMOVE</button>
                    </form>
                  </div>
                  <?php } ?>
                  <!-- end auth check for remove comment -->
                </a>
                <?php }
                ?>
                <!-- end foreach of comments -->
              </div>
                


            </div>
          </div>
          
          
         </div>
    </div>      
    </div>

    
      <!-- Footer -->
      <?php //include_once("./phpParts/footer.php")?>
    </div>
  </div>
  <!-- Scripts -->
  <?php //include_once("./phpParts/footer-scripts.php")?>
  
  <script>
  
  <?php $files = json_decode($postDeets['file'], true);
    foreach($files as $fileorg){
            $file = strtolower($fileorg);
            $ext = end(explode('.', $file));
            if($ext=="gpx"){?>
            var map = new L.Map('leaflet', {layers: [new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')]});
        
            var gpx = './uploads/<?php echo $fileorg?>'; // URL to your GPX file or the GPX itself
            new L.GPX(gpx, {async: true}).on('loaded', function(e) {
            	map.fitBounds(e.target.getBounds());
            }).addTo(map);
    <?php }}?>
           


		</script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="assets/js/rating.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('.starrating').rating({
          stars: 10,
          click:function (e) {
              var selector = e.event.currentTarget;
              $(selector).parents(".form-group").find('input').val(e.stars);
            }
        });
      });
    </script>
</body>

</html>
