<?php css("topo"); ?>

<canvas width=640 height=480 id=cnvMain></canvas>
<canvas width=320 height=320 id=cnvMap></canvas>
<script type=module>

import * as THREE from '/lib/MazeEngine/three/Three.js';

const loader = new THREE.TextureLoader();
const jimm = await loader.loadAsync('/img/jimm.png');

console.log(jimm);

// draw gradient circle in middle of cnvMap
const cnvMap = document.getElementById('cnvMap');

const ctxMap = cnvMap.getContext('2d');

//fill white rectangle
ctxMap.fillStyle = 'white';
ctxMap.fillRect(0, 0, cnvMap.width, cnvMap.height);

const grdMap = ctxMap.createRadialGradient(160, 160, 0, 160, 160, 160);
grdMap.addColorStop(0, 'rgba(0, 0, 0, 0)');
grdMap.addColorStop(1, 'rgba(0, 0, 0, 1)');
ctxMap.fillStyle = grdMap;
ctxMap.fillRect(0, 0, cnvMap.width, cnvMap.height);

const canvasTexture = new THREE.CanvasTexture(cnvMap);

const material = new THREE.MeshStandardMaterial({
    color: 0xFFFFFF,
    displacementMap: canvasTexture,
    displacementScale: 0.5,
	map: jimm,
});

const geometry = new THREE.PlaneGeometry(1, 1, 1024, 1024);
const mesh = window.mesh = new THREE.Mesh(geometry, material);
mesh.position.set(0, 0, 0);
mesh.rotation.set(-Math.PI/2, 0, 0);
mesh.scale.set(1, 1, 1);

const scene = new THREE.Scene();
scene.add(mesh);

// const light = new THREE.AmbientLight(0xFFFFFF, 1);
// scene.add(light);

const camera = window.camera = new THREE.PerspectiveCamera(75, 1, 0.1, 1000);
camera.position.set(0, 1, 1);
camera.lookAt(0, 0, 0);

const pointLight = new THREE.PointLight(0xFFFFFF, 1);
pointLight.position.set(0, 1, 1);
scene.add(pointLight);

const renderer = new THREE.WebGLRenderer({canvas: document.getElementById('cnvMain')});

let deltaTime = 0;
let lastTime = performance.now();
const animate = function () {
	const now = performance.now();
	deltaTime = now - lastTime;
	lastTime = now;

	mesh.rotation.z += deltaTime * 0.0001;

	requestAnimationFrame(animate);
	renderer.render(scene, camera);
};
animate();

</script>
