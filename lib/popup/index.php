<!doctype html>
<!-- https://twitter.com/keryot/status/1614051474795008005?t=UalnZ0mpPm5R3N6tIHJi2w&s=19 -->
<meta charset=utf-8>
<style>
body{
	background-image: url("/img/pipp advice.gif");
	background-size: cover;
	background-repeat: no-repeat;
	overflow: hidden;
}
</style>
<title>Please send me $ 20 dollat</title>
<body>

<script>

let phase = Math.random() * 1000;

function animate() {
	let t = performance.now();
	let a = Math.PI * 2 / 10000;
	console.log(t * a);
	let x = Math.sin(phase + t * a * 2) * 300 + 300;
	let y = Math.cos(phase + t * a) * 200 + 200;
	window.moveTo(parseInt(x), parseInt(y));
	requestAnimationFrame(animate);
}
animate();
</script>
<a href="https://twitter.com/keryot/status/1614051474795008005?t=UalnZ0mpPm5R3N6tIHJi2w&s=19">
	<div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
</a>
