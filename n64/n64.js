export const name = "n64";
export function n64(config) {
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
	const CLASS_NAME = "js-n64";
	let elements = document.getElementsByClassName(CLASS_NAME);
	let iframes = [];
	for (var i = 0; i < elements.length; i++) {
		var element = elements[i];
		var iframe = document.createElement("iframe");
		iframe.width = config.width;
		iframe.height = config.height;
		iframe.setAttribute("src", config.iframe_src);
		element.appendChild(iframe);
		iframes.push(iframe);
	}
	window.addEventListener("mousemove", function (event) {
		var clientX = event.clientX;
		var clientY = event.clientY;
		var movementX = event.movementX;
		var movementY = event.movementY;
		var invWindowWidth = 1.0 / window.innerWidth;
		var invWindowHeight = 1.0 / window.innerHeight;
		for (var iframe of iframes) {
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