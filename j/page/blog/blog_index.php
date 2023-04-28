<?php

$posts = glob("posts/*/index.php");

foreach ($posts as $post) {
	echo "<div>$post</div>\n";
}

?>
