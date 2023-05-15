<?php
	global $jroot;
	global $sfwMode;
	// todo: ordering?
	$files = scandir("$jroot/page");
	foreach ($files as $file) {
		if ($file[0] == ".") {
			continue;
		}
		if ($sfwMode && file_exists("$jroot/page/$file/nsfw")) {
			continue;
		}
		$iconPath = "$jroot/page/$file/icon.php";
		if (file_exists($iconPath)) {
			echo "\n";
			echo "\t<div class=icon>\n\n";
			require $iconPath;
			echo "\n\n\t</div>\n";
		}
	}
?>
