<!--https://v2.convertapi.com/convert/web/to/png?Url=&StoreFile=true-->

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
		
		
	<div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="h3 mb-0"><?echo $postDeets['title']?></h5>
                </div>
              </div>
            </div>
            <div class="card-body" style="height:1000px;;">
                
                <div id="leaflet"></div>


            </div>
          </div>
	
	<!--<div id="leaflet"></div>-->

		
		<script>
		    var map = new L.Map('leaflet', {layers: [new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')]});

            var gpx = './schiehallion.gpx'; // URL to your GPX file or the GPX itself
            new L.GPX(gpx, {async: true}).on('loaded', function(e) {
            	map.fitBounds(e.target.getBounds());
            }).addTo(map);
            
           


		</script>
	</body>
</html>