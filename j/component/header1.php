<!doctype html>
<meta charset=utf-8>
<style>
<?php echo file_get_contents(__DIR__."/header.css"); ?>
</style>

<script type="module">
	import {n64} from "/n64/n64.js";
	window.addEventListener("load", function() {
		n64({
			iframe_src: "/n64/n64.html",
			width: 150,
			height: 150
		});
	});
</script>

