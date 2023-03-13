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
			echo "\t<div class=icon>\n\n";
			require $iconPath;
			echo "\n\n\t</div>\n";
		}
	}
?>
	<div class=icon>
		<a href="https://twitter.com/JimmJamme/">
			<img src="/img/CLIPLY_372109260_TWITTER_LOGO_400.gif" alt="Twitter" height=150 longdesc="https://cliply.co/clip/twitter-logo/">
		</a>
	</div>
</footer>
