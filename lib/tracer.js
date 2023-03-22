class Point {
	/**
	 * @type {number}
	 */
	x;
	/**
	 * @type {number}
	 */
	y;
	constructor(x, y) {
		this.x = parseInt(x);
		this.y = parseInt(y);
	}
	distance(x_point, y) {
		if (typeof x_point == "number") {
			let x = x_point;
			return Math.sqrt(Math.pow(this.x - x, 2) + Math.pow(this.y - y, 2));
		}
		let point = x_point;
		return Math.sqrt(Math.pow(this.x - point.x, 2) + Math.pow(this.y - point.y, 2));
	}
	equals(x_point, y) {
		if (typeof x_point == "number") {
			let x = x_point;
			return this.x == x && this.y == y;
		}
		let point = x_point;
		return this.x == point.x && this.y == point.y;
	}
}

export default class Tracer {
	/**
	 * @type {ImageData}
	 */
	imgData;

	/**
	 * @type {CanvasRenderingContext2D}
	 */
	ctxInput;

	/**
	* @type {CanvasRenderingContext2D}
	*/
	ctxOutput;

	/**
	 * @type {Point}
	 */
	firstPixel;

	findFirstPixel() {
		let data = this.imgData.data;
		let ctx = this.ctxInput;
		for (let i = 0; i < data.length; i++) {
			let a = data[i + 3];
			if (a > 0) {
				let y = Math.floor(i / (ctx.canvas.width * 4));
				let x = (i - (y * ctx.canvas.width * 4)) / 4;
				return this.firstPixel = new Point(x, y);
			}
		}
	}

	/**
	 * @type {ImageData}
	 */
	tmpImageData;

	/**
	 * @type {Point[]}
	 */
	#firstPassPoints = [];

	getTransparentNeighbors(x, y, radius = 1) {
		let neighbors = [];
		for (let y1 = y - radius; y1 <= y + radius; y1++) {
			for (let x1 = x - radius; x1 <= x + radius; x1++) {
				if (x1 < 0 || x1 >= this.imgData.width || y1 < 0 || y1 >= this.imgData.height) {
					continue;
				}
				let alpha = this.imgData.data[(y1 * this.imgData.width + x1) * 4 + 3];
				if (alpha == 0 && !this.isTmpFilled(x1, y1)) {
					neighbors.push(new Point(x1, y1));
				}
			}
		}
		return neighbors;
	}

	getSolidNeighbors(x, y) {
		let neighbors = [];
		for (let y1 = y - 1; y1 <= y + 1; y1++) {
			for (let x1 = x - 1; x1 <= x + 1; x1++) {
				if ((x1 == x && y1 == y) || x1 < 0 || x1 >= this.imgData.width || y1 < 0 || y1 >= this.imgData.height) {
					continue;
				}
				let alpha = this.imgData.data[(y1 * this.imgData.width + x1) * 4 + 3];
				if (alpha > 0) {
					neighbors.push(new Point(x1, y1));
				}
			}
		}
		return neighbors;
	}

	isTmpFilled(x, y) {
		let alpha = this.tmpImageData.data[(y * this.tmpImageData.width + x) * 4 + 3];
		return alpha == 255;
	}

	cyanTmp(x, y) {
		this.tmpImageData.data[(y * this.tmpImageData.width + x) * 4 + 0] = 0;
		this.tmpImageData.data[(y * this.tmpImageData.width + x) * 4 + 1] = 255;
		this.tmpImageData.data[(y * this.tmpImageData.width + x) * 4 + 2] = 255;
		this.tmpImageData.data[(y * this.tmpImageData.width + x) * 4 + 3] = 255;
	}
	blackTmp(x, y) {
		this.tmpImageData.data[(y * this.tmpImageData.width + x) * 4 + 0] = 0;
		this.tmpImageData.data[(y * this.tmpImageData.width + x) * 4 + 1] = 0;
		this.tmpImageData.data[(y * this.tmpImageData.width + x) * 4 + 2] = 0;
		this.tmpImageData.data[(y * this.tmpImageData.width + x) * 4 + 3] = 255;
	}

	polygonRecurseValid(x, y) {
		if (this.isTmpFilled(x, y)) {
			return false;
		}
		return true;
	}

	// Only called on valid pixels
	async polygonRecurse(x, y, depth, debugAnimation) {
		console.log("polygonRecurse");
		depth++;

		if (debugAnimation) {
			this.polygonDebugAnimation();	
			//await new Promise(r => setTimeout(r, y < 16 ? 300 : 1));
			await new Promise(r => setTimeout(r, 1));
		}

		if (depth > 1 && this.firstPixel.equals(x, y)) {
			return true;
		}

		this.#firstPassPoints.push(new Point(x, y));

		this.blackTmp(x, y);

		for (let radius = 1; radius < 16; radius++) {
			let transparentNeighbors = this.getTransparentNeighbors(x, y, radius);
			for (let transNeighbor of transparentNeighbors) {
				this.cyanTmp(transNeighbor.x, transNeighbor.y);
	
				for (let solidNeighbor of this.getSolidNeighbors(transNeighbor.x, transNeighbor.y)) {
					let nx = solidNeighbor.x;
					let ny = solidNeighbor.y;
	
					if (this.polygonRecurseValid(nx, ny)) {
						return this.polygonRecurse(nx, ny, depth);
					}
				}
			}
		}
		//  console.log("failed at " + x + "," + y);
		this.#firstPassPoints.pop();
		return false;
	}

	clearTmp(x, y) {
		this.tmpImageData.data[(y * this.tmpImageData.width + x) * 4 + 0] = 0;
		this.tmpImageData.data[(y * this.tmpImageData.width + x) * 4 + 1] = 0;
		this.tmpImageData.data[(y * this.tmpImageData.width + x) * 4 + 2] = 0;
		this.tmpImageData.data[(y * this.tmpImageData.width + x) * 4 + 3] = 0;
	}

	output = [];

	polygonDebugAnimation() {
		let ctxOutput = this.ctxOutput;
		let ctxInput = this.ctxInput;

		let testImageData = new ImageData(ctxOutput.canvas.width, ctxOutput.canvas.height);
		let inputImageData = ctxInput.getImageData(0, 0, ctxInput.canvas.width, ctxInput.canvas.height);

		for (let i = 0; i < this.tmpImageData.data.length; i += 4) {
			let r1 = inputImageData.data[i];
			let g1 = inputImageData.data[i + 1];
			let b1 = inputImageData.data[i + 2];
			let a1 = inputImageData.data[i + 3];

			let r2 = this.tmpImageData.data[i];
			let g2 = this.tmpImageData.data[i + 1];
			let b2 = this.tmpImageData.data[i + 2];
			let a2 = this.tmpImageData.data[i + 3];

			let r,g,b,a = 0;

			if (a1 == 0) {
				r = r2;
				g = g2;
				b = b2;
				a = a2;
			} else if (a2 == 0) {
				r = r1;
				g = g1;
				b = b1;
				a = a1;
			} else {
				r = (r1 + r2) * 0.5;
				g = (g1 + g2) * 0.5;
				b = (b1 + b2) * 0.5;
				a = (a1 + a2) * 0.5;
			}

			testImageData.data[i] = r;
			testImageData.data[i + 1] = g;
			testImageData.data[i + 2] = b;
			testImageData.data[i + 3] = a;
		}

		ctxOutput.putImageData(testImageData, 0, 0);

		this.output = [];
		for (let i = 0; i < this.#firstPassPoints.length; i++) {
			let point = this.#firstPassPoints[i];
			if (point.skip) {
				continue;
			}
			this.output.push(point);
		}

		let outputLength = this.output.length;
		for (let i = 0; i < outputLength - 1; i++) {
			let a = this.output[i];
			let b = this.output[(i + 1)];
			
			let R,G,B = 0;

			R = 255 * (i / outputLength);
			G = 255 * (1 - (i / outputLength));
			B = 0;

			let A = 255;

			this.ctxOutput.beginPath();
			this.ctxOutput.moveTo(a.x, a.y);
			this.ctxOutput.lineTo(b.x, b.y);
			this.ctxOutput.strokeStyle = "rgba(" + R + "," + G + "," + B + "," + A + ")";
			this.ctxOutput.stroke();

			// // fill square at a and b
			// this.ctxOutput.fillStyle = "rgba(" + R + "," + G + "," + B + "," + A + ")";
			// this.ctxOutput.fillRect(a.x, a.y, 1, 1);
			// this.ctxOutput.fillRect(b.x, b.y, 1, 1);
		}
	}

	async calculatePolygon(debugAnimation = false) {
		let firstPixel = this.firstPixel;
		this.output = [];
		await this.polygonRecurse(firstPixel.x, firstPixel.y, 0, debugAnimation);
		if (debugAnimation) {
			this.polygonDebugAnimation();
		}
		return this.output;
	}

	constructor(ctxInput, ctxOutput) {
		this.ctxInput = ctxInput;
		this.ctxOutput = ctxOutput;
		this.imgData = ctxInput.getImageData(0, 0, ctxInput.canvas.width, ctxInput.canvas.height);
		this.tmpImageData = new ImageData(ctxOutput.canvas.width, ctxOutput.canvas.height);

		this.findFirstPixel();
	}

	// constructor(image) {
	// 	cnvInput = new OffscreenCanvas(image.width, image.height);
	// 	cnvOutput = new OffscreenCanvas(image.width, image.height);
	// 	this.ctxInput = cnvInput.getContext("2d");
	// 	this.ctxOutput = cnvOutput.getContext("2d");
	// 	this.ctxInput.drawImage(image, 0, 0);
	// 	this.imgData = this.ctxInput.getImageData(0, 0, image.width, image.height);
	// 	this.tmpImageData = new ImageData(image.width, image.height);

	// 	this.findFirstPixel();
	// }
}
