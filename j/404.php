<?php
header("HTTP/1.0 404 Not Found");
?>
<!doctype html>
<meta charset=utf-8>
<title>404</title>
<body>
<canvas id=annie></canvas>
<script type=module>
import Matrix from "https://raw.githubusercontent.com/ldyeax/Fill-In-Matrix-Effect/main/matrix.js";
Matrix({
    canvas: document.getElementById("annie"),
    imageUrl: "/img/annie_green.png",
    fullscreen: true
});
</script>