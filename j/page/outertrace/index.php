
<canvas id=input></canvas>
<canvas id=output></canvas>
<img id="imageMapSrc" src="/img/nsfw_for_imagemap.webp" usemap="#outputMap">
<map name="outputMap">
    <area id="area" shape="poly" coords="0,0,10,0,10,10" alt="Test" href="/">
</map>

<script type=module>

import Tracer from "/lib/tracer.js";

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


async function test() {
	img.height = 150;
	img.width = 165;

    cnvInput.width = img.width;
    cnvInput.height = img.height;

    cnvOutput.width = img.width;
    cnvOutput.height = img.height;

    ctxIn.drawImage(img, 0, 0, img.width, img.height);

    let tracer = new Tracer(ctxIn, ctxOut);
	let output = await tracer.calculatePolygon(true);

    let s = "";
    for (let i = 0; i < output.length; i+=16) { 
        s += output[i].x
        s += ",";
        s += output[i].y
        s += ",";
    }
    s = s.substring(0, s.length - 1);
    console.log(s);

    document.getElementById("area").coords = s;
}

window.img = document.getElementById("imageMapSrc");
if (img.complete) {
    test();
} else {
    img.onload = () => {test();}
}

</script>
