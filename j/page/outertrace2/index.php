<canvas id=input></canvas>
<canvas id=output></canvas>
<img id="imageMapSrc" src="/img/jimm.png" usemap="#outputMap" width=256>
<map name="outputMap">
    
</map>

<script type=module>

let cnvInput = document.getElementById("input");
let cnvOutput = document.getElementById("output");

let ctxIn = document.getElementById("input").getContext("2d");
let ctxOut = document.getElementById("output").getContext("2d");

// set no filtering on the canvases
ctxIn.imageSmoothingEnabled = false;
ctxOut.imageSmoothingEnabled = false;
// view pixelated
ctxIn.webkitImageSmoothingEnabled = false;
ctxOut.webkitImageSmoothingEnabled = false;


function test() {
    img.width = 256;

    let ratio = img.width / img.naturalWidth;
    img.height = parseInt(img.naturalHeight * ratio);

    cnvInput.width = img.width;
    cnvInput.height = img.height;

    cnvOutput.width = img.width;
    cnvOutput.height = img.height;

    ctxIn.drawImage(img, 0, 0, img.width, img.height);

	let map = document.querySelector(`map[name="outputMap"]`);
	// get canvas 1 image data
	let imgData = ctxIn.getImageData(0, 0, cnvInput.width, cnvInput.height);
	let data = imgData.data;
	for (let y = 0; y < cnvInput.height; y++) {
		for (let x = 0; x < cnvInput.width; x++) {
			let i = (y * cnvInput.width + x) * 4;
			let r = data[i];
			let g = data[i + 1];
			let b = data[i + 2];
			let a = data[i + 3];
			if (a > 0) {
				let area = document.createElement("area");
				area.shape = "rect";
				area.coords = `${x},${y},${x + 1},${y + 1}`;
				area.alt = `${x},${y}`;
				area.href = `/${x},${y}`;
				map.appendChild(area);
			}
		}
	}
}

window.img = document.getElementById("imageMapSrc");
if (img.complete) {
    test();
} else {
    img.onload = () => {test();}
}

</script>
