<div>
	<div id="pip_popup" style="position: absolute; left: 100px; top: 100px; display: none;">
		<div class="win98popup shadow" style="width: 292px; height: 195px;">
			<div class="bar" style="width: 282px;">
				<p>Please send me $ 20 dollat</p>
			</div>
			<iframe id=pippiframe src="/lib/popup/" width=282 height=166 style="position: absolute; top: 24px;"></iframe>
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
		contentWindow.args = {screenWidth: window.innerWidth * 3.0/4.0, screenHeight: window.innerHeight - 32, width: 282, height: 166, iframe: true};
		// listen for messages from iframe
		window.addEventListener("message", function(event) {
			if (event.data.pipp) {
				pip_popup.style.left = event.data.x + "px";
				pip_popup.style.top = event.data.y + "px";
			}
			if (event.data.pippdirect) {
				window.location = event.data.pippdirect;
			}
		}, false);
		document.getElementById("pipp").style.display = "none";
	} else {

		window.open("/lib/popup/", "pipp", "width=564,height=332").args = {screenWidth: window.innerWidth, screenHeight: window.innerHeight, width: 564, height: 332};
	};
}
</script>
