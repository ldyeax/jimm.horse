<?php

function css($name) {
	global $jroot;
	echo "<style>";
	echo file_get_contents("$jroot/css/$name.css");
	echo "</style>";
}

?>
