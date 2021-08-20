<?
$fcontent = "</gpx>";
$fcontent = preg_replace("/(<\/gpx.*)/", "", $fcontent);
var_dump($fcontent);
?>


