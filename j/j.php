<?php
namespace j;

$jroot = __DIR__;
require "jlib.php";

$requestingJson = false;
// check Accept header
if (isset($_SERVER['HTTP_ACCEPT'])) {
	$accept = $_SERVER['HTTP_ACCEPT'];
	if (strpos($accept, "json") !== false) {
		$requestingJson = true;
	}
}

if ($requestingJson) {
	header("Content-Type: application/json");
} else {
	header("Content-Type: text/html");
}

#region page name processing
$allowed = "abcdefghijklmnopqrstuvqxyz123456789_";
$pageName = $_GET['page'];
$tmp = "";
$len = min(32, strlen($pageName));
for ($i = 0; $i < $len; $i++) {
	$c = $pageName[$i];
	if ($c === ".") {
		break;
	}
	if (strpos($allowed, $c) !== false) {
		$tmp .= $c;
	}
}
$pageName = $tmp;
if (strlen($pageName) == 0) {
	$pageName = "index";
}
#endregion

#region find page and render

if ($requestingJson) {
	echo "{";
}

// check if page/$pageName.php exists
if (file_exists("page/$pageName/index.php")) {
	if (!$requestingJson) {
		require "component/header1.php";
	} else {
		echo "\n\t\"header\": ";
		ob_start();
	}
	if (file_exists("page/$pageName/header.php")) {
		require "page/$pageName/header.php";
	} else {
		echo("<title class=\"jHeader\">$pageName</title>");
	}
	if ($requestingJson) {
		echo json_encode(ob_get_clean());
		echo ",\n\t";
	} else {
		require "component/header2.php";
	}

	if ($requestingJson) {
		echo "\"body\": ";
		ob_start();
	}
	require "page/$pageName/index.php";

	if ($requestingJson) {
		echo json_encode(ob_get_clean());
		echo ",\n\t";

		echo "\"footer\": ";
		ob_start();
	}

	if (file_exists("page/$pageName/footer.php")) {
		require "page/$pageName/footer.php";
	} else {
		require "component/footer.php";
	}

	if ($requestingJson) {
		echo json_encode(ob_get_clean());
		echo "\n";
	}
} else {
	require "404.php";
}

if ($requestingJson) {
	echo "}\n";
}

#endregion

?>
