<?php
css("popup"); 
?>

<div>
	<div id="pip_popup" style="position: absolute; left: 100px; top: 100px; display: none;">
		<div class="win98popup shadow" style="width: 292px; height: 195px;">
			<div class="bar" style="width: 282px;">
				<p>Please send me $ 20 dollat</p>
				<button class="shadow">
				<svg xmlns="http://www.w3.org/2000/svg" width="8px" height="7px" viewBox="0 0 8 7" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"><path d="M1 6V5h1V4h1V3h2v1h1v1h1v1h1v1H6V6H5V5H3v1H2v1H0V6h1zm0-4V1H0V0h2v1h1v1h2V1h1V0h2v1H7v1H6v1H2V2H1z"/></svg>
				</button>
			</div>
			<iframe id=pippiframe src="/lib/popup" width=282 height=166 style="position: absolute; top: 24px;"></iframe>
		</div>
	</div>
</div>

<div style="text-align: center;">
	<button id=pipp>Make Your Mark Season 2 xvid full</button>
</div>
<script>
document.getElementById("pipp").onclick = function() {
	if ("ontouchstart" in document.documentElement) {
		let pip_popup = document.getElementById("pip_popup");
		pip_popup.style.display = "block";
		let iframe = document.getElementById("pippiframe");
		// get content window of iframe
		let contentWindow = iframe.contentWindow;
		contentWindow.args = {screenWidth: window.innerWidth, screenHeight: window.innerHeight - 32, width: 282, height: 166, iframe: true};
		// listen for messages from iframe
		window.addEventListener("message", function(event) {
			if (event.data.pipp) {
				pip_popup.style.left = event.data.x + "px";
				pip_popup.style.top = event.data.y + "px";
			}
		}, false);
		document.getElementById("pipp").style.display = "none";
	} else {

		window.open("/lib/popup/", "pipp", "width=564,height=332").args = {screenWidth: window.innerWidth, screenHeight: window.innerHeight, width: 564, height: 332};
	};
}
</script>
