<!--https://v2.convertapi.com/convert/web/to/png?Url=&StoreFile=true-->

<!DOCTYPE html>
<html>
	<head>
		<title>Leaflet</title>
		<style>
		    body {
	margin: 0;
}
html, body, #leaflet {
	height: 100%
}
		</style>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link type="text/css" rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
	</head>
	<body>
		<div id="leaflet"></div>

		<script src="https://unpkg.com/leaflet/dist/leaflet-src.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-gpx/1.4.0/gpx.min.js"></script>
		<script>
		    var map = new L.Map('leaflet', {layers: [new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')]});

            var gpx = './schiehallion.gpx'; // URL to your GPX file or the GPX itself
            new L.GPX(gpx, {async: true}).on('loaded', function(e) {
            	map.fitBounds(e.target.getBounds());
            }).addTo(map);
            
           


		</script>
	</body>
</html>