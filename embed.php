<?php include_once("./global.php");
// $gpxfile = $_GET['filename'];
// $gpxfile = "test1.gpx";
$gpxfile = $_GET['f'];
?>
<!DOCTYPE html>
<html>
	<head>
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
<div id="leaflet"></div>
	
	<!--<div id="leaflet"></div>-->

		
		<script>
		    var map = new L.Map('leaflet', {layers: [new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')]});

            var gpx = './uploads/<?php echo $gpxfile?>'; // URL to your GPX file or the GPX itself
            new L.GPX(gpx, {async: true}).on('loaded', function(e) {
            	map.fitBounds(e.target.getBounds());
            }).addTo(map);
            
           


		</script>
	</body>
</html>