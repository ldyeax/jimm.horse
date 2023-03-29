<!--
Credits (incomplete):

Special thanks to Lunar Harmony for the original Mare Museum: https://www.youtube.com/watch?v=p00FDbiD-5g (contains hidden NSFW)

https://derpibooru.org/images/2970137?q=oc%3Atiny+jasmini
https://derpibooru.org/images/2646488?q=oc%3Atiny+jasmini
https://derpibooru.org/images/1994967?q=oc%3Atiny+jasmini


https://maremaremaremaremaremare.com/marefiles/EarthCube.jpg

https://derpibooru.org/images/2639330?q=rainbowshining

https://knowyourmeme.com/photos/1183103-my-little-pony-friendship-is-magic

https://www.facebook.com/575372246168033/photos/im-gonna-take-my-horse-to-the-hotel-room-and-err/801929876845601/?paipv=0&eav=AfaykykfIH7IL-xdyO5cFaiMETrcuxMOEg7fUWYG-61IlCF3k12dvGJQB8N7qUVwebo&_rdr

https://pony.tube/lazy-static/previews/e2eb94bf-bf90-4427-b002-94ae60bbcaf5.jpg (only place I could find the Verity image)

https://derpibooru.org/images/1733640?q=berryshine%2Cgameloft

https://derpibooru.org/images/1092588?q=looking+at+you%2Cminuette%2Csolo%2Csafe%2C-anthro%2C-food%2C-human

https://derpibooru.org/images/2593878?q=amending+fences%2Cscreencap%2Cminuette%2Cfood%2Ctwinkleshine%2Clemon+hearts

https://twitter.com/orchidpony/status/1487877725960425472/photo/1

https://derpibooru.org/images/1380914?q=linky%2Csolo%2Chappy

https://www.deviantart.com/plainoasis/art/Moon-creek-857870188

https://derpibooru.org/images/36980

-->
<noscript>
	<style>#maremuseum{display: none;}</style>
	<div class=center>
		<h1 class=txt>The full Mare Museum cannot be accessed without Javascript</h1>
		<br>
		<img width=400 src=/img/everyfoalingdaythislittlefilly.png alt="Anonfilly" title="Every foaling day this little filly just sits there and gives me this derpy look on her face">
		<br>
		<h2 class=txt>Refresh the page to traverse the noscript Mare Muesum</h2>
		<br>
		<img src=/lib/maremuseum/randommare.php?1 width=350 alt="Random mare 1" title="inere">
		<img src=/lib/maremuseum/randommare.php?2 width=350 alt="Random mare 2" title="csfer">
		<img src=/lib/maremuseum/randommare.php?3 width=350 alt="Random mare 3" title="aeov!">
	</div>
</noscript>
<iframe id=maremuseum src="/lib/maremuseum/maremuseum.html" style="z-index: -1;"></iframe>
<script>
if (!window.maremuseuminterval) {
	window.addEventListener("mousemove", (e) => {
		window.maremuseummousex = e.clientX;
		window.maremuseummousey = e.clientY;
	});
	window.maremuseuminterval = setInterval(function() {
		let museum = document.getElementById("maremuseum");
		try {
			if (museum) {
				let contentWindow = museum.contentWindow;
				if (!contentWindow.maremousemoveadded) {
					contentWindow.addEventListener("mousemove", (e) => {
						window.maremuseummousex = e.clientX;
						window.maremuseummousey = e.clientY;
					});
					contentWindow.maremousemoveadded = true;
				}
				if (museum) {
					//determine if mouse pointer is over footer
					let rect = document.getElementById("footer").getBoundingClientRect();
					let x = window.maremuseummousex;
					let y = window.maremuseummousey;
					if (x >= rect.left && x <= rect.right && y >= rect.top && y <= rect.bottom) {
						museum.style.zIndex = "-1";
					} else {
						museum.style.zIndex = "1";
						if (document.activeElement !== museum) {
							museum.focus();
						}
					}
				}
			}
		} finally {}
	}, 100);
}
</script>
