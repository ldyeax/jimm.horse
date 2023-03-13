<?php

header('Content-Type: application/json');

$dir = "./asset/mares";
$files = scandir($dir);

echo "{\n\t\"mares\": [\n";

for ($i = 0; $i < count($files); $i++) {
	$filename = $files[$i];
	if ($filename[0] == ".") {
		continue;
	}
	echo "\t\t";
	echo json_encode($filename);
	if ($i < count($files) - 1) {
		echo ",\n";
	}
	else {
		echo "\n";
	}
}

echo "\t]\n}";

?>
