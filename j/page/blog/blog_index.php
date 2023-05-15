<?php

global $jroot;

$blogPostsRoot = "$jroot/page/blog/posts/";
$posts = glob("$blogPostsRoot/*");

function getPostName($post) {
	global $blogPostsRoot;
	$post = str_replace($blogPostsRoot, "", $post);
	$post = str_replace("\\", "/", $post);
	$post = str_replace("/index.php", "", $post);
	$post = str_replace("/", "", $post);
	return $post;
}

//var_dump($posts);
foreach ($posts as $post) {
	$postUrlpart = getPostName($post);
	$title = $postUrlpart;
	if (file_exists("$post/title")) {
		$title = file_get_contents("$post/title");
	}
	echo "<div><a href=\"/blog/$postUrlpart\">$title</a></div>\n";
	
}

?>
