<div id=n64Icon class=js-n64 data-n64-width=150 data-n64-height=150></div>
<script>
function n64Icon_click() {
	j("n64");
	return false;
}
</script>
<a href="/n64" onclick="return n64Icon_click()">
	<div id=n64IconLink style="position: absolute; z-index:5; top: 0; left: 0; height: 150px; width: 150px;"></div>
</a>
<script>
function updateN64Icon() {
	let n64Icon = document.getElementById("n64Icon");
	let n64IconLink = document.getElementById("n64IconLink");
	n64IconLink.style.left = n64Icon.offsetLeft + "px";
	n64IconLink.style.top = n64Icon.offsetTop + "px";
	requestAnimationFrame(updateN64Icon);
}
updateN64Icon();
</script>
<script type=module>
	import {n64} from "/lib/n64/n64.js";
	n64();
</script>
