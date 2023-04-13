
// window.addEventListener("load", function() {
// 	// todo: more general
// 	let areas = document.querySelectorAll(`area[shape="poly"]`);
// 	for (let area of areas) {
// 		let parent = area.parentElement;
// 		if (parent.dataset.scaled) {
// 			continue;
// 		}
// 		let name = parent.getAttribute("name");
// 		let img = document.querySelector(`img[usemap="#${name}"]`);
// 		let coords = area.getAttribute("coords").split(",");
// 		let imgWiddth = img.width;
// 		let imgHeight = img.height;
// 		let naturalWidth = img.naturalWidth;
// 		let naturalHeight = img.naturalHeight;
// 		let xRatio = imgWiddth / naturalWidth;
// 		let yRatio = imgHeight / naturalHeight;
// 		let newCoords = "";
// 		for (let i = 0; i < coords.length; i += 2) {
// 			newCoords += parseInt(coords[i]) * xRatio;
// 			newCoords += ",";
// 			newCoords += parseInt(coords[i + 1]) * yRatio;
// 			if (i < coords.length - 2) {
// 				newCoords += ",";
// 			}
// 		}
// 		area.setAttribute("coords", newCoords);
// 	}
// });

function getCookie(name) {
	let value = "; " + document.cookie;
	let parts = value.split("; " + name + "=");
	if (parts.length == 2) return parts.pop().split(";").shift();
}

function setCookie(name, value, days) {
	let expires = "";
	if (days) {
		let date = new Date();
		date.setTime(date.getTime() + (days*24*60*60*1000));
		expires = "; expires=" + date.toUTCString();
	}
	document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function resolvePageName(pageName) {
	while (pageName.length > 0 && pageName[0] == "/") {
		pageName = pageName.substring(1);
	}
	return `/${pageName}`;
}

const HEADER_CLASS = "jHeader";

function executeScripts(nodes) {
	for (let node of nodes) {
		let parent = node.parentElement;
		let script = document.createElement("script");
		script.type = node.type || "text/javascript";
		script.innerHTML = node.innerHTML;
		parent.removeChild(node);
		parent.appendChild(script);
	}
}

async function loadPageContents(pageName) {
	pageName = resolvePageName(pageName);

	let page = await fetch(
		pageName, 
		{
			headers: {
				accept: "application/json"
			}
		}
	);
	let json = await page.json();

	let tmpElement = document.createElement("div");

	let body = document.getElementById("body");

	// let footer = document.getElementById("footer");

	// #region header
	// remove all header elements and noscript elements
	tmpElement.innerHTML = json.header;
	let toRemove = document.querySelectorAll(`.${HEADER_CLASS}, noscript`);
	for (let i = 0; i < toRemove.length; i++) {
		toRemove[i].remove();
	}

	let nodes = tmpElement.childNodes;
	for (let node of nodes) {
		let clone = node.cloneNode(true);
		document.head.appendChild(clone);
	}
	// #endregion
	
	executeScripts(document.querySelectorAll(`script.${HEADER_CLASS}`));

	body.innerHTML = json.body;
	executeScripts(body.querySelectorAll("script"));

	// todo: check if footer actually needs to be reloaded
	// footer.innerHTML = json.footer;
	// executeScripts(footer.querySelectorAll("script"));

	addJEventListeners();
}

window.history.replaceState({pageName: window.location.pathname}, "");

window.onJ = [];

window.j = async function(pageName) {
	for (let callback of window.onJ) {
		try {
			await callback(pageName);
		} catch (e) {
			console.error("error in onJ");
			console.error(e);
		}
	}
	window.onJ = [];
	pageName = resolvePageName(pageName);
	window.history.pushState({pageName: pageName}, "", pageName);
	loadPageContents(pageName);
};

window.onpopstate = function(event) {
	if (event.state) {
		loadPageContents(event.state.pageName);
	} else {
		console.error("no event.state");
	}
};

function addJEventListeners() {
	let jPageLinks = document.querySelectorAll("[data-j]");
	for (let link of jPageLinks) {
		link.onclick = function() {
			j(link.getAttribute("href").substring(1));
			return false;
		}
	}
};

window.addEventListener("load", addJEventListeners);
