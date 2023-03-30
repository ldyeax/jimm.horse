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
		<img src="/img/CLIPLY_372109260_TWITTER_LOGO_400.gif" alt="Twitter" height=150 data-source="https://cliply.co/clip/twitter-logo/" usemap="#twittermap">
		<map name="twittermap">
			<area id="twittermap" shape="poly" 
			coords="91,27,87,28,94,28,98,28,101,29,103,31,106,32,110,33,114,32,118,30,119,32,119,36,122,37,122,41,122,45,119,47,117,49,115,51,113,53,113,56,113,60,112,63,111,67,111,70,112,74,116,74,119,75,123,75,120,78,118,80,116,82,113,84,111,85,105,86,103,88,105,92,103,93,98,95,95,97,93,99,93,100,90,102,86,104,86,105,81,107,75,109,75,110,68,111,59,112,54,113,46,112,39,110,32,107,28,101,30,97,34,97,38,96,42,96,46,93,41,89,38,82,40,79,35,75,31,68,32,62,33,57,31,50,32,42,35,39,36,42,38,44,40,46,45,46,47,46,49,48,51,50,53,52,55,54,58,55,63,55,65,55,67,57,70,58,74,50,74,42,77,36,81,32,85,29,76,38,74,47,74,55" 
			alt="Twitter" href="https://twitter.com/JimmJamme/">
		</map>
	</div>
</footer>
