<!--https://v2.convertapi.com/convert/web/to/png?Url=&StoreFile=true-->


<?
$url = "https://projects.anomoz.com/gpxCollaborate/gfx_to_png.php?filename=W6LOCRNZN2";

$urlPing = "https://www.api.anomoz.com/api/anomoz/url_to_png.php?url=".urlencode($url)."&ViewportWidth=850";
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $urlPing);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$return = curl_exec($ch);

$url = $return;

?>