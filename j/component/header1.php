<!doctype html>
<!--
kO000K0OOO00KKKK00KKXXKkk000OOOOOKXXXKOxk00K0kOOOOkxxkOOO00KXNXXK00OO0KXXXKKKKKKKKKKKO0XKOxxkOO0OOOO
0OOO0K0OOO0K0KKKK00KKK000KKKKKKKXXK0OOkdolllc::;;;:;;;:::clodkO0XXXNNXXNNXXXXXXK000OxxOKKOxdxk0XKOOO
O000KK0OO0XK00KK00KKK000KKK000OO0Okxoc:;;;,,;,;;,,,,,,;,;ldoddlcox0XNNNNWWWWNNXK00OkxO0000000KXXX0OO
KXXXXK00KKXXXK00KKKKK00OOOkkkkOOkdl:;;;,;;;;;,;,,;:::cllclddoccc:;cdOKXXXXXNNWWWNNX0KK0OkOKXXXKKKK00
OO0XXXXK0O0KK0OkO0KK0kxxxxxxxxxdl:;;;;;;,;;;;;,,;;:::cllc::;,,;,,,,;:oxkkO0KKKKXNWWWNNXX0OOOKXK0O0OO
xxk0XK00kkOOOOOkk00Okxxxxxxddddc;,;;;;;;;,;;;;;;;;;:ll:;:;;:::;,,,,,,:looodxO0K00KXXXNNXK0OO0KKK00OO
kO0OOxk0OkO0000Okxxxxxxxddddddl:,,,;;;;;;;;;;;;;;;;:c:;;;;;;::;;:::;;;coolllodxkO0O0KXK0OO0KXXXK0000
00O0OkkOOxk0XK0kxxxxxddddoooodl;;;;;;;;;;;;;;,,,,,,,,;;;;;;;;,;::;;,;;cddolllllodxxxkOkkOkOO0KK00000
OkxxkkkkO0KKKkxxxxdddddooolldxolccc::::;;;;;,,;;;;;;,,,,;;;;;;;;;;;;;;coxdlccclllloooodO000KKK000000
00OOOkO00KKOxdxxddddoooollldkkkkxxxdolllccc:::::::::::c:;;;;;;;,,,;;;:ldxkdlccccclllloooxO0KK0000000
00KK0000OOkddxxddddoooolloxkO000OOOkxxxxddddooollccccccc:;;;;,,,,;;;clodxkkxlcccccclllolldxkO000KKK0
000KXXK00OddxxddddoooollcdOO0KK0OOOOOOOkOkkkkkxxxxxxdollolc;;;;;;::coddxxkkxoc:ccccllloolodxkO00Okkk
0000KXXK0kddxddddoooollclxOO0KK0OO0OOOOO00OOOOOOOkkkkkxxxdo:;:::cclodxkkkkkkxo::cccclllollodxO0K0kdd
0OOKXXKKOdodddddooooolcldkOO0KK0O00OkkOOOO00000OOO0OOOkxxxdolloodddxkkOOkkOkkxl::cccllllllodxkOOkkxk
xdxOOOKKOdodddodoooollclxOOO0KKKOkxxdddddxxxkkOOO0000OOkxxxxddxxkkkkOOOOOOOOkxl::cclllllllodkkkxxdod
xxodxkOKKkddddoooooollclxOOO00KK0kdollllooooddddxkkkkOOOOkkkkkkOOOOOOOOOOOOOkdc:cccllllllldxkO0kkkkO
xxdoxO0KK0doddooooooolccdkOO00000OkdolloxkOkxxxxkkkO00000OOOOOOOOOOOOOOOOOOOxl::ccllllllloodxxkOOO0O
0OOxxOKK00xoodooooooollclxOO000OOkxxdooodk0KKKXXXXXXXKK00OOOO0000000OOOOOOOxo::ccclllllcloolooxOOdoo
K00kkOO000koloooooooolllcldkOOOOOOOOOkkxdoodk0KXKKKKK00000OO0000000000OOOkdl::ccclllllclodxxxkkkkkxk
OOOOOO0000OxolooooooollllclldO00KKKKKKK0OkxolodxOO00000000OO00KK00000OOkdlc::cccllllclodooxOkOOkkkxk
kxkO0000000kxdolooooollllllloOKKKKKXXKKKK00OkdolloodxkkkOOOxk000000Okxolc:ccccllllccloddxk0K0kO0OOOO
xkkO0OO000Okxddolllooollccc:lxO0KKXXKKXXXXKK0OkxolllclllodxlcxOOkxdolc::cccccccccclloodxkkkkkxdddool
kkxxkkkkkkkkkxxddollllllcc:::lxOO00KKKKXXXXKK00OOkkxoc:::clc;:lolcccccccloooolllloooddooooolllcccc::
oxkkkkOkddkkkkdooooolllccc::::ldxkkOOOO0KKKKKKKKXXXK0kdoc::::cllodxxdooooollccllodoooodddoolllc:;,,;
:clddxOOkxdxkOkxddkkxdollc:::::codxxkkkkkkO0KXNNWWNNXKOkxdolloccccccc::::::ccllooooodxkkxxxxdlc;,,,,
::::cldkO0OO00Okxxxxxxdddolc::;;;;;:loodxxxxOXNWWWNNXK0Okdol:,'',;;;::clodddddoddddddxxkkxoc:,,'''',
:::::::codxkkkxddddddxxxxxxdolc:;,'.''',;:cllxKXXKK0Oxoc:,,'',;:codxkOO0000OOkxxkxddxxdoc:,,''''''',
;::;;;;::clodxxdxkkddxxxxkkOkxdolc:;,'',''',,:dxdolc;,'..',;:coxkO0KK0OO00O000OkOOkdoc:;,'''',,,,,,,
-->
<meta charset=utf-8>
<script>
window.addEventListener("load", function() {
	// todo: more general
	let areas = document.querySelectorAll(`area[shape="poly"]`);
	for (let area of areas) {
		let parent = area.parentElement;
		if (parent.dataset.scaled) {
			continue;
		}
		let name = parent.getAttribute("name");
		let img = document.querySelector(`img[usemap="#${name}"]`);
		let coords = area.getAttribute("coords").split(",");
		let imgWiddth = img.width;
		let imgHeight = img.height;
		let naturalWidth = img.naturalWidth;
		let naturalHeight = img.naturalHeight;
		let xRatio = imgWiddth / naturalWidth;
		let yRatio = imgHeight / naturalHeight;
		let newCoords = "";
		for (let i = 0; i < coords.length; i += 2) {
			newCoords += parseInt(coords[i]) * xRatio;
			newCoords += ",";
			newCoords += parseInt(coords[i + 1]) * yRatio;
			if (i < coords.length - 2) {
				newCoords += ",";
			}
		}
		area.setAttribute("coords", newCoords);
	}
});

function resolvePageName(pageName) {
	while (pageName.length > 0 && pageName[0] == "/") {
		pageName = pageName.substring(1);
	}
	return `/${pageName}`;
}

const HEADER_CLASS = "jHeader";

async function loadPageContents(pageName) {
	pageName = resolvePageName(pageName);

	let body = document.getElementById("body");
	body.classList.add("loading");
	let tmpElement = document.createElement("div");
	body.innerHTML = "";

	let page = await fetch(
		pageName, 
		{
			headers: {
				accept: "application/json"
			}
		}
	);
	let json = await page.json();
	tmpElement.innerHTML = json.body;
	let nodes = tmpElement.childNodes;
	body.classList.remove("loading");

	for (let node of nodes) {
		let clone = node.cloneNode(true);
		let newNode = null;
		if (clone.tagName == "SCRIPT") {
			newNode = document.createElement("script");
			newNode.type = clone.type;
			newNode.innerHTML = clone.innerHTML;
		} else {
			newNode = clone;
		}
		body.appendChild(newNode);
	}

	tmpElement.innerHTML = json.header;
	let toRemove = document.getElementsByClassName(HEADER_CLASS);
	console.log("toRemove: ", toRemove.length, " elements")
	for (let i = 0; i < toRemove.length; i++) {
		toRemove[i].remove();
	}

	nodes = tmpElement.childNodes;
	for (let node of nodes) {
		let clone = node.cloneNode(true);
		document.head.appendChild(clone);
	}
}

window.history.replaceState({pageName: window.location.pathname}, "");

window.j = async function(pageName) {
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

</script>
<?php css("header"); ?>
