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
			<article class="general_content_box" id="venus">
				<h2>Zapisane zdjęcia:</h2>
				<form action="/delete_chosen.php" method="post">
					<?php if(!empty($images)): ?>
						<div class="line">
						<?php $i = -1 ?>
						<?php foreach($images as $image): ?>
							<?php 
								$i = $i + 1;
								if($i === 2)
								{
									echo '</div><div class="line">';
									$i = 0;
								}
							?>
							<figure class="sub_container">
								<a href="view_image.php?<?php echo 'source=' . $image['id'] . '&static=no'?>"><img src="<?php echo $image['source'] ?>" title= "<?php echo $image['title']?> - <?php echo $image['author']?>"></a>
								<label for="<?php echo $image['id']?>">Zaznacz: </label><input type="checkbox" name="chosen[]" value="<?php echo $image['id']?>" id="<?php echo $image['id']?>">
								<?php if(!($image['owner']==='public')){ echo '(prywatne)'; } ?> 
							</figure>
						<?php endforeach ?>
						</div>
					<?php endif ?>
					<div class="line">
						<input id="submit_button" type="submit" value="USUŃ ZAZNACZONE Z ZAPAMIĘTANYCH">
						<input type="reset" value="WYCZYŚĆ">
					</div>
					<?php if($method==='error'):?> 
						<p>Błąd przesyłania danych. Jeśli problem się powtarza, prosimy o zgłoszenie przez formularz w zakładce Kontakt.</p>
					<?php endif ?>
				</form>
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