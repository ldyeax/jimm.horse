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
<a id=link href="https://twitter.com/keryot/status/1614051474795008005?t=UalnZ0mpPm5R3N6tIHJi2w&s=19">
	<div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
</a>
<script>
let defaultArgs = {
	screenWidth: 800,
	screenHeight: 600,
	width: 564,
	height: 332
};

let link = document.getElementById("link");

// let phase = Math.random() * 1000;

let x = 0;
let y = 0;
let dx = 1;
let dy = 1;

window.args = window.args || defaultArgs;

function animate() {
	window.args = Object.assign(defaultArgs, window.args || {});

	let maxX = args.screenWidth - args.width;
	let maxY = args.screenHeight - args.height;

	let t = performance.now();
	let a = Math.PI * 2 / 10000;

	// console.log(t * a);
	// let x = Math.sin(phase + t * a * 2) * 300 + 300;
	// let y = Math.cos(phase + t * a) * 200 + 200;

	if (x > maxX) {
		dx = -1;
	}
	if (x < 0) {
		dx = 1;
	}
	if (y > maxY) {
		dy = -1;
	}
	if (y < 0) {
		dy = 1;
	}

	x += dx;
	y += dy;

	x += dx * 2 * Math.cos(t * a * 2);
	y += dy * Math.abs(Math.sin(t * a));

	if (args.iframe) {
		window.parent.postMessage({x: x, y: y, pipp: "petals"}, "*");
		link.href = "#";
	} else {
		window.moveTo(parseInt(x), parseInt(y));
	}
	requestAnimationFrame(animate);
}
animate();

document.getElementById("link").addEventListener("click", function(e) {
	if (window.args.iframe) {
		window.parent.postMessage({"pippdirect": "https://twitter.com/keryot/status/1614051474795008005?t=UalnZ0mpPm5R3N6tIHJi2w&s=19"});
	}
});

</script>
