import MazeObject from "engine/mazeobject.js";
import * as THREE from "three";

import Player from "mazeobject/player.js";
import MazeCamera from "mazeobject/mazecamera.js";
import MarbleTest from "mazeobject/marbletest.js";
import CellLightManager from "engine/mazeobject/celllightmanager.js";
import CellLightSource from "engine/mazescript/celllightsource.js";

import marbleTest from "engine/test/marbletest.js";

import Maze from "mazeobject/maze.js";

import generateMaze from "engine/generatemaze.js";

import Ending from "../mazeobject/ending.js"
import Painting from "../mazeobject/painting.js";

let loopPoint = 179.441;
let duration = 185.436;

/**
 * @typedef {import("engine/mazeengine.js").default} MazeEngine
 * @typedef {import("engine/cell.js").default} Cell
 * @typedef {import("asset/imageasset.js").default} ImageAsset
 */
export default class MusicMazeScene extends MazeObject {
	/**
	* @type {HTMLAudioElement}
	*/
	audio1 = null;
	/**
	 * @type {HTMLAudioElement}
	 */
	audio2 = null;
	/**
	 * @type {boolean}
	 */
	musicStarted = false;
	/**
	 * @type {HTMLAudioElement[]}
	 */
	audios = [];
	/**
	 * @type {number}
	 */
	audioIndex = 0;
	/**
	 * @type {function}
	 */
	onMusicStarted = null;
	startMusic() {
		if (this.musicStarted) {
			return;
		}
	
		this.musicStarted = true;
	
		this.audio1 = new Audio("/lib/maremuseum/asset/museum2.mp3");
		this.audio1.volume = 0;
		this.audio1.currentTime = 0; // 170;
		this.audio1.loop = true;
	
		// clone audio1
		
		this.audio2 = this.audio1.cloneNode(true);
		this.audio2.volume = 0;
		this.audio2.currentTime = duration - loopPoint;
	
		this.audio1.play();
		this.audio2.play();
	
		this.audios = [this.audio1, this.audio2];

		if (this.onMusicStarted) {
			this.onMusicStarted();
		}
	}

	/**
	 * @param {MazeEngine} mazeEngine 
	 * @param {Object} args 
	 */
	constructor(mazeEngine, args) {
		super(mazeEngine, args);

		if (args.onMusicStarted) {
			this.onMusicStarted = args.onMusicStarted;
		}

		let SIDE = mazeEngine.SIDE;

		window.addEventListener("mousedown", this.startMusic.bind(this));
		window.addEventListener("touchstart", this.startMusic.bind(this));
		window.addEventListener("keydown", this.startMusic.bind(this));

		this.name = "Music Maze Scene";

        let width = 12;
        let height = 20;

		let cellData = generateMaze(width, height);
		let cells = cellData.cells;

		// let endingWidth = 6;
		let endingStartX = 0; // Math.floor(width/2) - Math.floor(endingWidth/2) - 1;
		let endingEndX = width - 1; // endingStartX + endingWidth + 1;

		for (let y = height - 3; y < height; y++) {
			for (let x = endingStartX; x <= endingEndX; x++) {
				let cell = cells[y][x];
				if (y != height - 3) {
					cell.down = false;
				}
				if (y != height - 1) {
					cell.up = false;
				}
				if (x != endingStartX) {
					cell.left = false;
				}
				if (x != endingEndX) {
					cell.right = false;
				}
			}
		}

        mazeEngine.instantiate(Maze, {width:width, height:height, cellData: cellData});

		mazeEngine.instantiate(CellLightManager);

		mazeEngine.cameraMazeObject = this.cameraMazeObject = mazeEngine.instantiate(MazeCamera);

		let player = mazeEngine.player = this.player = mazeEngine.instantiate(Player);
		player.addScript(CellLightSource);
		/**
		 * @type {ImageAsset[]}
		 */
		let mareAssets = [];
		let assetKeys = Object.keys(mazeEngine.assets);
		for (let assetKey of assetKeys) {
			if (assetKey.indexOf("mare_") != 0) {
				continue;
			}
			mareAssets.push(mazeEngine.assets[assetKey]);
		}
		// widest mares first 
		mareAssets = mareAssets.sort((a, b) => {
			return (b.naturalWidth / b.naturalHeight) - (a.naturalWidth / a.naturalHeight);
		});

		/**
		 * @type {Cell[]}
		 */
		let flatCells = [];
		for (let y = 0; y < height; y++) {
			for (let x = 0; x < width; x++) {
				flatCells.push(cells[y][x]);
			}
		}

		flatCells = flatCells.sort(() => {
			return Math.random() - 0.5;
		});

		for (let mareAsset of mareAssets) {
			let found = false;

			let cellsWide = Math.ceil(mareAsset.naturalWidth / mareAsset.naturalHeight);

			switch (cellsWide) {
				case 3:
					for (let cell of flatCells) {
						let cell1 = cell;
						let cell2 = cell.above;
						let cell3 = cell2?.above;
	
						if (cell1.mare || cell2?.mare || cell3?.mare) {
							continue;
						}
	
						let hasLeft = cell1.left && cell2?.left && cell3?.left;
						let hasRight = cell1.right && cell2?.right && cell3?.right;
	
						if (hasLeft || hasRight) {
							cell1.mare = cell2.mare = cell3.mare = mareAsset;
							let painting = mazeEngine.instantiate(Painting, {asset: mareAsset, cell: cell2});
	
							painting.rotation.y = Math.PI / 2 + (hasLeft ? 0 : Math.PI);
							painting.position.x = cell2.x * SIDE + (hasLeft ? 10 : SIDE - 10);
							painting.position.z = -cell2.y * SIDE - SIDE/2;

							found = true;
							break;
						}
					}
					break;
				case 2:
					for (let cell of flatCells) {
						let cell1 = cell;
						let cell2 = cell.above;
	
						if (cell1.mare || cell2?.mare) {
							continue;
						}
	
						let hasLeft = cell1.left && cell2?.left;
						let hasRight = cell1.right && cell2?.right;
	
						if (hasLeft || hasRight) {
							cell1.mare = cell2.mare = mareAsset;
							let painting = mazeEngine.instantiate(Painting, {asset: mareAsset, cell: cell2});
	
							painting.rotation.y = Math.PI / 2 + (hasLeft ? 0 : Math.PI);
							painting.position.x = cell2.x * SIDE + (hasLeft ? 10 : SIDE - 10);
							painting.position.z = -cell2.y * SIDE;

							found = true;
							break;
						}
					}
					break;
				case 1:
					for (let cell of flatCells) {
						if (cell.mare || cell.y > height - 4) {
							continue;
						}
	
						if (cell.up || cell.down) {
							cell.mare = mareAsset;
							let painting = mazeEngine.instantiate(Painting, {asset: mareAsset, cell: cell});
	
							painting.rotation.y = (cell.up ? 0 : Math.PI);
							painting.position.x = cell.x * SIDE + SIDE/2;
							painting.position.z = -cell.y * SIDE + (cell.up ? -SIDE + 10 : -10);

							found = true;
							break;
						}
					}
			}

			if (!found) {
				console.log("Could not find a place for mare " + cellsWide, mareAsset);
			}
		}

		let cutemare1Asset = mazeEngine.assets.cutemare1;
		let cutemare2Asset = mazeEngine.assets.cutemare2;
		for (let x = 0; x < width; x++) {
			let cutemareAsset = x < width / 2 ? cutemare1Asset : cutemare2Asset;
			let cell = cells[height - 1][x];
			let painting = mazeEngine.instantiate(Painting, {asset: cutemareAsset, cell: cell, square: true});
			painting.rotation.y = 0;
			painting.position.x = cell.x * SIDE + SIDE/2;
			painting.position.z = -cell.y * SIDE - SIDE + 5;
			if (x < width / 2) {
				painting.scale.x *= -1;
			}
		}
		
		mazeEngine.instantiate(Ending);
	}

	update() {
		super.update();

		if (this.musicStarted) {
			let dt = this.mazeEngine.deltaTime * 0.5;

			let currentAudio = this.audios[this.audioIndex % 2];
			let otherAudio = this.audios[(this.audioIndex + 1) % 2];

			if (currentAudio.currentTime > loopPoint) {
				otherAudio.currentTime = 0;
				this.audioIndex++;
				currentAudio = this.audios[this.audioIndex % 2];
				otherAudio = this.audios[(this.audioIndex + 1) % 2];
			}

			if (currentAudio.volume < 1) {
				try {
					currentAudio.volume += dt;
				} catch (_) {
					currentAudio.volume = 1;
				}
				
			} else {
				currentAudio.volume = 1;
			}

			if (otherAudio.volume > 0) {
				try {
					otherAudio.volume -= dt;
				} catch (_) {
					otherAudio.volume = 0;
				}
			} else {
				otherAudio.volume = 0;
			}
		}
	}
}
