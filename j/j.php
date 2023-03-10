<?php
namespace j;

$jroot = __DIR__;
require "jlib.php";

#region LESS
require "lessphp/lessc.inc.php";

$formatter = new \lessc_formatter_classic;
$formatter->indentChar = "\t";
$less = new \lessc;
$less->setPreserveComments(true);
$less->setFormatter($formatter);
$files = scandir("$jroot/less");

//echo "<table>";

foreach ($files as $file) {
	//echo "<tr>";
	//echo "<td>$file</td>";
	if (strlen($file) >= 5 && substr($file, -5) == ".less") {
		$cssFile = substr($file, 0, -5);
		$less->checkedCompile("$jroot/less/$file", "$jroot/css/$cssFile.css");
		//echo "<td>$jroot/less/$file</td>";
		//echo "<td>$jroot/css/$cssFile.css</td>";
	}
	//echo "</tr>";
}
//echo "</table>";
#endregion

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

// check if page/$pageName.php exists
if (file_exists("page/$pageName.php")) {
	require "component/header1.php";
	if (file_exists("page/$pageName.header.php")) {
		require "page/$pageName.header.php";
	} else {
		echo("<title>$pageName</title>");
	}
	require "component/header2.php";
	require "page/$pageName.php";
	if (file_exists("page/$pageName.footer.php")) {
		require "page/$pageName.footer.php";
	} else {
		require "component/footer.php";
	}
} else {
	require "404.php";
	die();
}
#endregion

?>
