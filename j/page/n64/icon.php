<div id=n64Icon class=js-n64 data-n64-width=150 data-n64-height=150></div>
<a href="/n64" data-j>
	<div id=n64IconLink style="position: absolute; z-index:5; top: 0; left: 0; height: 150px; width: 150px;"></div>
	<noscript>
		<img src=/img/n64.webp alt="N64 Logo Demo" height=150 width=150>
	</noscript>
</a>
<script>
function updateN64Icon() {
	let n64Icon = document.getElementById("n64Icon");
	if (n64Icon) {
		let n64IconLink = document.getElementById("n64IconLink");
		n64IconLink.style.left = n64Icon.offsetLeft + "px";
		n64IconLink.style.top = n64Icon.offsetTop + "px";
	}
	requestAnimationFrame(updateN64Icon);
}

if (!window.updatingN64) {
	updateN64Icon();
}

window.updatingN64 = true;
</script>
<script type=module>
	import {n64} from "/lib/n64/n64.js";
	n64();
</script>
