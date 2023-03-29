<?php

#region LESS

// Ensure $jroot/css exists
if (!file_exists("$jroot/css")) {
	mkdir("$jroot/css");
}

require "lessphp/lessc.inc.php";

$formatter = new \lessc_formatter_classic;
$formatter->indentChar = "\t";
$less = new \lessc;
$less->setVariables(array(
	"headerHeight" => "0px",
	"footerHeight" => "150px",
	"celestiaPurple" => "#6C53D2"
));
$less->setPreserveComments(true);
$less->setFormatter($formatter);

$files = scandir("$jroot/less");

foreach ($files as $file) {
	if (strlen($file) >= 5 && substr($file, -5) == ".less") {
		$cssFile = substr($file, 0, -5);
		$less->checkedCompile("$jroot/less/$file", "$jroot/css/$cssFile.css");
	}
}

// page/*/index.less automatically included in page
$files = scandir("$jroot/page");
foreach ($files as $file) {
	if (file_exists("$jroot/page/$file/index.less")) {
		$less->checkedCompile("$jroot/page/$file/index.less", "$jroot/css/page_$file.css");
	}
}

#endregion

function css($name) {
	global $jroot;
	echo "<style>";
	echo file_get_contents("$jroot/css/$name.css");
	echo "</style>";
}

function cssPage($pageName) {
	global $jroot;
	echo "<style>";
	echo file_get_contents("$jroot/css/page_$pageName.css");
	echo "</style>";
}

function scaleImageMap($imageMap, $xScale, $yScale) {
	$values = explode(",", $imageMap);
	$len = count($values);
	for ($i = 0; $i < $len; $i++) {
		$values[$i] = round($values[$i] * $xScale);
		$values[++$i] = round($values[$i] * $yScale);
	}
	return implode(",", $values);
}

?>
