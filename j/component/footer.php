</div>

<footer id=footer>
<?php
	global $jroot;
	// list folders under $jroot/page
	$files = scandir("$jroot/page");
	foreach ($files as $file) {
		if ($file[0] == ".") {
			continue;
		}
		$iconPath = "$jroot/page/$file/icon.php";
		if (file_exists($iconPath)) {
			echo "\n";
			echo "<div class=icon>\n";
			require $iconPath;
			echo "</div>\n";
		}
	}
?>
</footer>
