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
		<script src="static/scripts/darkmode.js"></script>
	</head>
	<body>
		<?php 
		$active = "index";
		require_once 'segments/nav.php'; 
		?>
		
		<main>
			<article class="general_content_box">
				<h2>Galeria społeczności</h2>
				<div class="sub_container">
					<h4>
						Zachęcamy wszystkich użytkowników strony do dzielenia się wspomnieniami dotyczącymi naszej pasji.<br>
						Nie ważne, czy żeglarstwo to dla Ciebie sposób na życie, czy sposób na przyjemny weekend.<br>
					</h4>
					<p>
						Zapraszamy do obejrzenia galerii zdjęć nadesłanych przez członków naszej społeczności.<br>
						<br>
						Dla użytkowników zarejestrowanych dostępna jest również opcja przesyłania zdjęć prywatnych, do własnego użytku.
					<p>	
					<a class="fav_button" href="image_form.php">Dodaj zdjęcie</a>
					<a class="fav_button" href="search_engine.php">Wyszukiwarka zdjęć</a>
					<?php if(!isset($_SESSION['user'])):?>
						<a class="fav_button" href="log_in_form.php">Logowanie</a>
						<a class="fav_button" href="sign_up_form.php">Rejestracja</a>
					<?php endif ?>
					<?php if($logged_in):?>
						<a class="fav_button" href="log_out.php">Wyloguj</a>
					<?php endif ?>
				</div>
				<figure class="sub_container">
					<img src="static/img/sailing_boat.jpg" alt="Zachód słońca nad jeziorem" title="Piękna sceneria Pojezierza Mazurskiego">
				</figure>
				<div class="line">
					<center>
					<?php 
						if(!empty($prompt))
							echo 'Wiadomość serwera: ' . $prompt;
					?>
				</div>
			</article>

			<article class="general_content_box" id="venus">
				<h2>Zdjęcia</h2>
				<form action="/save_chosen.php" method="post">
					<?php if(!empty($images)): ?>
						<?php foreach($images as $image): ?>
							<figure class="image_miniature">
								<a href="view_image.php?<?php echo 'source=' . $image['id'] . '&static=no'?>"><img src="<?php echo $image['source'] ?>" title= "<?php echo $image['title']?> - <?php echo $image['author']?>"></a>
								<label for="<?php echo $image['id']?>">Zaznacz: </label><input type="checkbox" name="chosen[]" value="<?php echo $image['id']?>" id="<?php echo $image['id']?>" <?php if($image['checked']) {echo 'checked disabled';}?>>
								<?php if(!($image['owner']==='public')){ echo '(prywatne)'; } ?> 
							</figure>
						<?php endforeach ?>
						<div class="line">
							<input id="submit_button" type="submit" value="ZAPISZ WYBRANE">
							<input type="reset" value="WYCZYŚĆ">
						</div>
					<?php endif ?>
					<?php if($method==='error'):?> 
						<p>Błąd przesyłania danych. Jeśli problem się powtarza, prosimy o zgłoszenie przez formularz w zakładce Kontakt.</p>
					<?php endif ?>
				</form>
				<div class="line">
					<a class="fav_button" href="chosen.php">Pokaż zapisane</a>
					<a class="fav_button" href="next_page.php">Następna strona</a>
					<a class="fav_button" href="previous_page.php">Poprzednia strona</a>
				</div>
			</article>
		</main>
		<?php
		include_once 'segments/footer.php';
		?>
	</body>
</html>