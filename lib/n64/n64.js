const CLASS_NAME = "js-n64";

class N64Message {
	constructor(x, y, dx, dy) {
		this.type = "n64";
		this.x = x;
		this.y = y;
		this.dx = dx;
		this.dy = dy;
		// console.log(`x: ${x}, y: ${y}, dx: ${dx}, dy: ${dy}`)
	}
}

export function n64(config) {
	config.width ??= 150;
	config.height ??= 150;

	if (!window.n64_iframes) {
		window.n64_iframes = [];
	}

	let elements = document.getElementsByClassName(CLASS_NAME);
	console.log(`n64: ${elements.length} elements found`);
	for (var i = 0; i < elements.length; i++) {
		let element = elements[i];

		if (elements[i].n64) {
			console.log(`n64: skipping already initialized element`);
			continue;
		}
		elements[i].n64 = true;

		let iframe = element;
		if (element.tagName !== "IFRAME") {
			let width = element.dataset.n64Width ?? config.width;
			let height = element.dataset.n64Height ?? config.height;
			iframe = document.createElement("iframe");
			iframe.width = width;
			iframe.height = height;
			iframe = element.appendChild(iframe);
		}

		iframe.setAttribute("src", config.iframe_src);
		window.n64_iframes.push(iframe);
	}
	window.addEventListener("mousemove", function (event) {
		let clientX = event.clientX;
		let clientY = event.clientY;
		let movementX = event.movementX;
		let movementY = event.movementY;
		let invWindowWidth = 1.0 / window.innerWidth;
		let invWindowHeight = 1.0 / window.innerHeight;
		for (let iframe of window.n64_iframes) {
			// get bounding client rect of iframe
			var rect = iframe.getBoundingClientRect();
			var x = (clientX - (rect.left + rect.width * 0.5)) * invWindowWidth;
			var y = (clientY - (rect.top + rect.height * 0.5)) * invWindowHeight;
			iframe.contentWindow.postMessage(new N64Message(
				x, y, movementX, movementY
			), "*");
		}
	});
};
