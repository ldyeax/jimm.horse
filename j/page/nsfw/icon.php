<script type=module>
import Win98Modal from "/lib/Win98Modal/win98modal.js";
window.enableNSFWMode = function() {
	if (getCookie("nsfw") || confirm("Enable NSFW mode? (18+ Only)")) {
		setCookie("nsfw", true);

		let w = window.innerWidth;
		let h = window.innerHeight;

		

		new Win98Modal({
			title: "Please send me $ 20 Dollat",
			type: "image",
			contents: "/lib/Win98Modal/examples/pippadvice.gif",
			width: 564,
			height: 332,
			icon: "/lib/Win98Modal/examples/dollarspindownd.gif",
			x: w/6,
			y: 0,
			resizable: false,
			href: "https://twitter.com/keryot/status/1614051474795008005"
		});

		new Win98Modal({
			title: "Work From Home",
			type: "html",
			contents: `
			<div style="background-color: white; margin: 0; padding: 0; text-align: center;">
				<h1 style="color: blue; margin-top: 0;" background-color: white;>Google Pays Me $173 An Hour</h1>
				<img src="/lib/Win98Modal/examples/wfh.png" width=274 height=171> <br>
				Google has blessed me with a $5000 a month at home job <a style="font-size: 24px;" href="https://github.com/AppleDash/rockstar" target="_blank"> &gt; &gt; See How</a>
			</div>
			`,
			width: 274,
			icon: "/lib/Win98Modal/examples/winupd.ico"
		})

		new Win98Modal({
			title: "horny🐎horsie",
			type: "image",
			contents: "/lib/Win98Modal/examples/myhornissobig.png",
			width: 640,
			height: 640,
			icon: "/lib/Win98Modal/examples/twibooru.ico",
			x: w - 640,
			y: h - 640,
			resizable: false,
			href: "https://www.twibooru.org/",
			imageWidth: 640,
			imageHeight: 640,
			iconPixelated: false
		});

		new Win98Modal({
			title: "My Husband Is Dead - Apply Online Today",
			type: "iframe",
			contents: "/lib/Win98Modal/examples/myhusbandisdead.html",
			width: 640,
			height: 480,
			icon: "/lib/Win98Modal/examples/gem.gif",
			x: w/4,
			y: h/6,
			resizable: true
		});

		new Win98Modal({
			title: "Velvety Smooth Skin!",
			type: "iframe",
			contents: "/lib/Win98Modal/examples/dermatologists.html",
			width: 350,
			height: 600,
			icon: "/lib/Win98Modal/examples/tv.ico",
			x: 24,
			y: h-600,
			resizable: true
		});

		new Win98Modal({
			title: "find out how this ugly son of a bitch managed to fuck your dad",
			type: "iframe",
			contents: "/lib/Win98Modal/examples/uglysonofabitch.html",
			width: 220,
			height: 323,
			icon: "/lib/Win98Modal/examples/ff.webp",
			x: w-220,
			y: 0
		});
	}
}
</script>
<img height=150 src="/img/nsfw.webp" alt="NSFW mode" class="icon" data-source="https://derpibooru.org/images/1502275" usemap="#nsfwMap" >
<map name="nsfwMap">
    <area id="area" shape="poly" coords="29,1,45,1,59,3,72,6,84,6,94,12,102,20,114,18,127,11,143,11,143,21,150,30,158,38,163,49,163,65,158,78,153,92,143,104,139,101,134,73,123,70,118,84,114,99,109,113,99,125,94,139,76,148,55,138,48,123,30,109,35,85,27,74,10,82,1,62,6,38,16,23,28,15,35,10" 
	alt="Activate NSFW Mode" 
	href="#"
	onclick="window.enableNSFWMode(); return false;"
	>
</map>
