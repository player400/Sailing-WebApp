<!DOCTYPE html>
<html lang="pl">
	<head>
		<?php 
		include_once 'segments/head.php';
		?>
		
		<link rel="stylesheet" type="text/css" href="static/styles/layout.css">
		<link rel="stylesheet" type="text/css" href="static/styles/global.css">
		<link rel="stylesheet" type="text/css" href="static/styles/form.css">
		<link rel="stylesheet" type="text/css" href="static/styles/gallery.css">
		
		<script src="static/scripts/add_favourites_menu.js"></script>
		<script src="static/scripts/jquery/jquery.js"></script>
		<script src="static/scripts/darkmode.js"></script>
		<script src="static/scripts/ajax.js"></script>
	</head>
	<body>
		<?php 
		$active = "index";
		require_once 'segments/nav.php'; 
		?>
		
		<main>
			<article class="general_content_box" id="venus">
				<label for="phrase"><h2>Wyszukaj zdjęcie:</h2></label>
				<input type="text" id="phrase" name="fraza" onkeyup="search()">
				<div id="search_results">
				
				</div>
				<div class="line">
					<a class="fav_button" href="gallery.php">Galeria</a>
				</div>
			</article>
		</main>
		<?php
		include_once 'segments/footer.php';
		?>
	</body>
</html>