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
	"footerHeight" => "150px"
));
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

function css($name) {
	global $jroot;
	echo "<style>";
	echo file_get_contents("$jroot/css/$name.css");
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
