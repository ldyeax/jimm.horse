<?php
header("HTTP/1.0 404 Not Found");
global $requestingJson;
if (!$requestingJson) {
?>
<html lang=en>
<!doctype html>
<!--
Annie Vorchine credit Tiny Jasmini
https://derpibooru.org/search?q=oc%3Aannie%20vorechine
-->
<meta charset=utf-8>
<title>404</title>
<style>
html, body {
	padding: 0 0 0 0;
	margin: 0 0 0 0;
	overflow: hidden;
	background-color: black;
}
</style>
<body>
<canvas id=annie></canvas>
<script type=module>
import Matrix from "/lib/Fill-In-Matrix-Effect/matrix.js";
new Matrix({
	canvas: document.getElementById("annie"),
	imageUrl: "/img/annie_green.png",
	fullscreen: true
});
</script>
<?php
}
?>
