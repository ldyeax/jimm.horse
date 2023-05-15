<?php

global $jArgs;
global $jroot;

$found = count($jArgs) > 0 && file_exists("$jroot/page/blog/posts/$jArgs[0]/index.php");

if ($found) {
	require "$jroot/page/blog/posts/$jArgs[0]/index.php";
} else {
	require "blog_index.php";
}

// if (count($jArgs) === 0) {
// 	require "blog_index.php";
// } else {
// 	$indexPath = "posts/$jArgs[0]/index.php";
// 	if (file_exists($indexPath)) {
// 		require $indexPath;
// 	} else {
// 		j404();
// 	}
// }

?>
