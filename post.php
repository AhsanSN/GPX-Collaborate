<?include_once("./global.php");

if($logged==0){
    ?>
    <script type="text/javascript">
            window.location = "./";
        </script>
    <?
} 

$id = $_GET['id'];
$query_quizQuestions= "select * from gpxCollaborate_posts where id='$id'"; 
$result_quizQuestions = $con->query($query_quizQuestions);
while($row = $result_quizQuestions->fetch_assoc()) 
{ 
    $postDeets = $row;
}


?>
<!DOCTYPE html>
<html>

<head>
  <?include_once("./phpParts/header.php")?>
  	<style>
		    body {
	margin: 0;
}
html, body, #leaflet {
	height: 100%
}
		</style>
		<link type="text/css" rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet-src.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-gpx/1.4.0/gpx.min.js"></script>
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
                    <?echo $postDeets['title']?>
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
                  <h5 class="h3 mb-0"><?echo $postDeets['title']?></h5>
                </div>
              </div>
            </div>
            <div class="card-body" style="a:1000px;">
                
                <p><?echo $postDeets['description']?></p>
               
                <?$files = json_decode($postDeets['file'], true);
                foreach($files as $file){
                    $file = strtolower($file);
                    $ext = end(explode('.', $file));
                    if($ext=="gpx"){
                        ?><div id="leaflet" style="height:400px;"></div><?
                    }else if(in_array($ext, array("png", "jpg", "jpeg"))){
                        ?><img src="./uploads/<?echo $file?>" style="width:100%;" ><?
                    }else if(in_array($ext, array("mp4"))){
                        ?>
                             <video width="320" height="240" controls>
                              <source src="./uploads/<?echo $file?>" type="video/mp4">
                            Your browser does not support the video tag.
                            </video> 
                        <?
                    }
                ?>
                    
                <?}?>


            </div>
          </div>
          
          
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
               
                


            </div>
          </div>
          
          
         </div>
          
          
    </div>

    
      <!-- Footer -->
      <?//include_once("./phpParts/footer.php")?>
    </div>
  </div>
  <!-- Scripts -->
  <?//include_once("./phpParts/footer-scripts.php")?>
  
  <script>
  
  <?$files = json_decode($postDeets['file'], true);
    foreach($files as $file){
            $file = strtolower($file);
            $ext = end(explode('.', $file));
            if($ext=="gpx"){?>
            var map = new L.Map('leaflet', {layers: [new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')]});
        
            var gpx = './uploads/<?echo $file?>'; // URL to your GPX file or the GPX itself
            new L.GPX(gpx, {async: true}).on('loaded', function(e) {
            	map.fitBounds(e.target.getBounds());
            }).addTo(map);
    <?}}?>
           


		</script>
  
  
</body>

</html>
