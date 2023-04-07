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
	#region header

	if (!$requestingJson) {
		require "component/header.php";
	} else {
		echo "\n\t\"header\": ";
		ob_start();
	}

	if (file_exists("page/$pageName/header.php")) {
		require "page/$pageName/header.php";
	} else {
		echo("\n<title class=\"jHeader\" >$pageName</title>\n");
	}

	if (file_exists("page/$pageName/index.less")) {
		cssPage($pageName, true);
	}

	// Header content JSON field
	if ($requestingJson) {
		echo json_encode(ob_get_clean());
		echo ",\n\t";
	}

	#endregion header

	#region body
	if ($requestingJson) {
		echo "\"body\": ";
		ob_start();
	} else {
		echo "<body>\n";
	}

	if (!$requestingJson) {
		echo "<div id=body>\n";
	}
	require "page/$pageName/index.php";
	if (!$requestingJson) {
		echo "</div>\n";
	}

	// Body content JSON field
	if ($requestingJson) {
		echo json_encode(ob_get_clean());
		echo ",\n\t";
	}
	#endregion

	#region footer
	if ($requestingJson) {
		echo "\"footer\": ";
		ob_start();
	}

	if (!$requestingJson) {
		echo "<footer id=footer>\n";
	}

	if (file_exists("page/$pageName/footer.php")) {
		require "page/$pageName/footer.php";
	} else {
		require "component/footer.php";
	}

	if (!$requestingJson) {
		echo "</footer>\n";
	}

	// Footer content JSON field
	if ($requestingJson) {
		echo json_encode(ob_get_clean());
		echo "\n";
	}
	#endregion
} else {
	require "404.php";
}

if ($requestingJson) {
	echo "}\n";
}

#endregion

?>
