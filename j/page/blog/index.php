<?php

global $jArgs;

if (count($jArgs) === 0) {
	require "blog_index.php";
} else {
	$indexPath = "posts/$jArgs[0]/index.php";
	if (file_exists($indexPath)) {
		require $indexPath;
	} else {
		j404();
	}
}

?>
