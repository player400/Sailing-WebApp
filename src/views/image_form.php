<!DOCTYPE html>
<html lang="pl">
	<head>
		<?php
		include_once 'segments/head.php';
		?>
		<link rel="stylesheet" type="text/css" href="static/styles/layout.css">
		<link rel="stylesheet" type="text/css" href="static/styles/form.css">
		<link rel="stylesheet" type="text/css" href="static/styles/global.css">

		<script src="static/scripts/add_favourites_menu.js"></script>
		<script src="static/scripts/image_preview.js"></script>
		<script src="static/scripts/darkmode.js"></script>
	</head>
	<body>
		<?php 
		$active = "index";
		require_once 'segments/nav.php';
		?>
		<main>
			<article class="general_content_box">
				<h2>Dodawanie zdjęcia</h2>
				<div class="sub_container">
					<h3>Formularz przesyłania zdjęcia:</h3>
					<form action="/submit_image.php" method="post" enctype="multipart/form-data">
						<table>
							<tr>
								<td>
									<label for="title">Tytuł:</label>
								</td>
								<td>
									<input type="text" name="tytul" id="title" required> <?php if(!($input_data_status['title']==='ok')):?> Należy podać tytuł <?php endif ?>
								</td>								
							</tr>
							<tr>
								<td>
									<label for="author">Autor:</label>
								</td>
								<td>
									<input type="text" name="autor" id="author" <?php if($logged_in){ echo 'value="' . $login . '"'; }?> required> <?php if(!($input_data_status['author']==='ok')):?>Należy podać autora <?php endif ?>
								</td>									
							</tr>
							<tr>
								<td>
									<label for="watermark">Znak wodny:</label>
								</td>
								<td>
									<input type="text" name="znak" id="watermark" required> <?php if(!($input_data_status['watermark']==='ok')):?> Należy podać treść znaku wodnego<?php endif ?>
								</td>									
							</tr>
							<?php if($logged_in):?>
								<tr>
									<td>
										Prywatność:
									</td>
									<td>	
										<input type="radio" id="public" name="privacy" value="public">
										<label for="public"> Publiczne</label>
										<input type="radio" id="private" name="privacy" value="private">
										<label for="private"> Prywatne</label>
									</td>								
								</tr>
							<?php endif ?>
							<tr>
								<td colspan="2">
									<label for="zal">Zdjęcie:</label>
									<input type="file" name="obraz" id="zal" required>
									<?php if($input_data_status['file']==='empty'):?> Należy załczyć plik<?php endif ?>
									<?php if($input_data_status['file']==='type'):?> Akceptowane pliki: jpeg, png.<?php endif ?>
									<?php if($input_data_status['file_size']==='size'):?> Maksymalny rozmiar pliku to 1MB<?php endif ?>
								</td>								
							</tr>
							<tr>
								<th>
									<input id="submit_button" type="submit" value="WYŚLIJ">
								</th>
								<th>
									<input type="reset" value="WYCZYŚĆ" onclick="remove_preview()">
								</th>
							</tr>
						</table>
						<?php if($input_data_status['method']==='error'):?> 
						<p>Błąd przesyłania danych. Jeśli problem się powtarza, prosimy o zgłoszenie przez formularz w zakładce Kontakt.</p>
						<?php endif ?>
					</form>	
					<?php if(!($database_status==='ok')):?> <p>Wystąpił błąd po stronie serwera. Jesli problem się powtarza, prosimy o zgłoszenie poprzez formularz w zakładce Kontakt. (<?php echo $database_status ?>)</p><?php endif ?>
					<div class="line">
						<a class="fav_button" href="gallery.php">Galeria</a>
					</div>
				</div>
				<figure class="sub_container">
					<img src="static/img/mailstorm.png" alt="Obrazek z kopertami" title="Mailstorm">
				</figure>
			</article>
		</main>
		<?php
		include_once 'segments/footer.php';
		?>
	</body>
</html>