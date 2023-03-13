import MazeObject from "engine/mazeobject.js";
import * as THREE from "three";

import FourCornerCellLightReceiver from "engine/mazescript/four_corner_cell_light_receiver.js";
import CellLightReceiverSingle from "engine/mazescript/celllightreceiver_single.js";
import CellAlphaReceiver from "engine/mazescript/cellalphareceiver.js";

/**
 * @typedef {import("engine/mazeengine.js").default} MazeEngine
 */
export default class Ending extends MazeObject {
	scaleWithGlobalY = false;
	/**
	 * @param {MazeEngine} mazeEngine 
	 */
	constructor(mazeEngine) {
		super(mazeEngine);

		let SIDE = mazeEngine.SIDE;

		let cell = mazeEngine.cells[mazeEngine.height - 1][mazeEngine.width - 1];

		this.root = new THREE.Group();

		let x = mazeEngine.width * SIDE / 2;
		
		let ending1 = mazeEngine.assets.ending1.getRoot();
		ending1.userData.cell = cell;
		ending1.scale.set(SIDE * 5.333, SIDE, 1);
		ending1.position.x = x;
		ending1.position.y = SIDE - 10;
		ending1.position.z = -mazeEngine.height * SIDE + SIDE * 0.5;
		ending1.rotation.x = Math.PI / 2;

		let ending2 = mazeEngine.assets.ending2.getRoot();
		ending2.userData.cell = cell;
		ending2.scale.set(SIDE * 5.333, SIDE, 1);
		ending2.position.x = x;
		ending2.position.y = SIDE * 0.5;
		ending2.position.z = -mazeEngine.height * SIDE + 10;

		let ending3 = mazeEngine.assets.ending3.getRoot();
		ending3.userData.cell = cell;
		ending3.scale.set(SIDE * 5.333, SIDE, 1);
		ending3.position.x = x;
		ending3.position.y = 10;
		ending3.position.z = -mazeEngine.height * SIDE + SIDE * 0.5;
		ending3.rotation.x = -Math.PI / 2;

		this.root.add(ending1);
		this.root.add(ending2);
		this.root.add(ending3);
	}
}
