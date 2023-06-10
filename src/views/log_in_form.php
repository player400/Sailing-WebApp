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
				<h2>Logowanie</h2>
				<div class="sub_container">
					<h3>Formularz logowania:</h3>
					<form action="/log_in.php" method="post">
						<table>
							<tr>
								<td>
									<label for="login">Login:</label>
								</td>
								<td>
									<input type="text" name="login" id="login" required> <?php if($login==='empty'):?> Należy podać login <?php endif ?><?php if($login==='incorrect'):?> Nie ma takiego użytkownika <?php endif ?>
								</td>									
							</tr>
							<tr>
								<td>
									<label for="password">Hasło:</label>
								</td>
								<td>
									<input type="password" name="haslo" id="password" required> <?php if($password==='empty'):?> Należy podać hasło <?php endif ?><?php if($password==='incorrect'):?>Hasło jest niepoprawne<?php endif ?>
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
						<?php if($method==='error'):?> 
						<p>Błąd przesyłania danych. Jeśli problem się powtarza, prosimy o zgłoszenie przez formularz w zakładce Kontakt.</p>
						<?php endif ?>
					</form>	
					<div class="line">
						<a class="fav_button" href="gallery.php">Galeria</a>
					</div>
				</div>
				<figure class="sub_container">
					<img src="static/img/authorization.jpg" alt="Telefon z odciskiem palca na ekranie" title="Authentication">
				</figure>
			</article>
		</main>
		<?php
		include_once 'segments/footer.php';
		?>
		<div id="validation_dialog" title="Formularz zawiera błędy">
			<p>Nieprawidłowe dane znajdują się w następujących polach formularza:</p>
			<p id="error_list"></p>
		</div>
	</body>
</html>