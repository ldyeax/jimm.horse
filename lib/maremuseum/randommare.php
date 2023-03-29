<?php
$dir = "./asset/full_resolution_mares";
$files = scandir($dir);

$allowed = ["png", "jpg", "jpeg", "gif", "webp", "svg"];

$files = array_filter($files, function($file) {
	global $allowed;
	$file = strtolower($file);
	return $file[0] != "." && in_array(pathinfo($file, PATHINFO_EXTENSION), $allowed);
});
$files = array_values($files);
$randomFile = $files[rand(0, count($files) - 1)];
if (isset($_GET["index"])) {
	$index = $_GET["index"];
	$randomFile = $files[$_GET["index"]];
}
$extension = pathinfo($randomFile, PATHINFO_EXTENSION);
switch ($extension) {
	case "png":
		header("Content-Type: image/png");
		break;
	case "jpg":
	case "jpeg":
		header("Content-Type: image/jpeg");
		break;
	case "gif":
		header("Content-Type: image/gif");
		break;
	case "webp":
		header("Content-Type: image/webp");
		break;
	case "svg":
		header("Content-Type: image/svg+xml");
		break;
	default:
		header("Content-Type: application/octet-stream");
		break;
}
readfile($dir . "/" . $randomFile);
?>
