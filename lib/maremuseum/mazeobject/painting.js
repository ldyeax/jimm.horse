import MazeObject from "engine/mazeobject.js";
import * as THREE from "three";

import FourCornerCellLightReceiver from "engine/mazescript/four_corner_cell_light_receiver.js";
import CellLightReceiverSingle from "engine/mazescript/celllightreceiver_single.js";
import CellAlphaReceiver from "engine/mazescript/cellalphareceiver.js";

/**
 * @typedef {import("engine/mazeengine.js").default} MazeEngine
 * @typedef {import("engine/asset/imageasset.js").default} ImageAsset
 */
export default class Painting extends MazeObject {
	scaleWithGlobalY = false;
	/**
	 * @param {MazeEngine} mazeEngine 
	 */
	constructor(mazeEngine, args) {
		super(mazeEngine);

		let SIDE = mazeEngine.SIDE;

		let cell = args.cell;
		/**
		 * @type {ImageAsset}
		 */
		let asset = args.asset;

		let ultimateWidth = SIDE;
		if (!args.square) {
			ultimateWidth *= asset.naturalWidth / asset.naturalHeight;
		}

		this.root = new THREE.Group();
		
		let painting = asset.getRoot();
		painting.userData.cell = cell;
		painting.scale.set(ultimateWidth, SIDE, 1);
		painting.position.y = SIDE * 0.5;

		this.root.add(painting);

		this.addScript(CellAlphaReceiver, {
			opacityFunction: (opacity) => {
				let ret = opacity + 0.5;
				if (ret > 1) {
					ret = 1;
				}
				return ret;
			}
		})
	}
}
