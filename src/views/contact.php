<!DOCTYPE html>
<html lang="pl">
	<head>
		<?php
		include_once 'segments/head.php';
		?>
		<link rel="stylesheet" type="text/css" href="static/styles/layout.css">
		<link rel="stylesheet" type="text/css" href="static/styles/form.css">
		<link rel="stylesheet" type="text/css" href="static/styles/global.css">
		
		<link rel="stylesheet" type="text/css" href="static/scripts/jquery/jquery-ui.min.css">
		<link rel="stylesheet" type="text/css" href="static/scripts/jquery/jquery-ui.structure.min.css">
		<link rel="stylesheet" type="text/css" href="static/scripts/jquery/jquery-ui.theme.min.css">
		<script src="static/scripts/jquery/jquery.js"></script>
		<script src="static/scripts/jquery/jquery-ui.min.js"></script>
		
		<script src="static/scripts/jquery/plugin/jquery.mailtip.js"></script>
		<link rel="stylesheet" type="text/css" href="static/scripts/jquery/plugin/mailtip.css">

		<script src="static/scripts/add_favourites_menu.js"></script>
		<script src="static/scripts/image_preview.js"></script>
		<script src="static/scripts/form.js"></script>
		<script src="static/scripts/darkmode.js"></script>
	</head>
	<body>
		<?php 
		$active = "contact";
		require_once 'segments/nav.php';
		?>
		<main>
			<article class="general_content_box">
				<h2>Kontakt</h2>
				<div class="sub_container">
					<h3>Dane kontaktowe:</h3>
					<p>
						E-mail: <a href="mailto:s193053@student.pg.edu.pl">s193053@student.pg.edu.pl</a><br>
						Telefon: <a href="tel:+48698252047">(+48) 698 252 047</a>
					</p>
					<hr>
					<br>
					<h3>Formularz kontaktowy:</h3>
					<form action="php/form.php" method="post" onsubmit="validate()" enctype="multipart/form-data">
						<table>
							<tr>
								<td>
									<label for="mail">E-mail:</label>
								</td>
								<td>
									<input type="text" name="email" id="mail">
								</td>								
							</tr>
							<tr>
								<td>
									<label for="name">Imię:</label>
								</td>
								<td>
									<input type="text" name="imie" id="name">
								</td>									
							</tr>
							<tr>
								<td>
									Patent żeglarski (upr. ŻJ lub wyższe):
								</td>
								<td>	
									<input type="radio" id="yes" name="license" value="yes">
									<label for="yes"> Tak</label>
									<input type="radio" id="no" name="license" value="no">
									<label for="no"> Nie</label>
									<input type="radio" id="nd" name="license" value="not_disclosed" checked>
									<label for="nd">Nie chcę podawać</label>	
								</td>								
							</tr>
							<tr>
								<td>
									<label for="date">Data uzyskania patentu:</label>
								</td>
								<td>
									<input type="date" name="date" id="date">
								</td>								
							</tr>
							<tr>
								<td>
									<label for="sbjt">Temat:</label>
								</td>
								<td>
									<select id="sbjt" name="subject">
										<option value="not_chosen">-</option>
										<option value="helpdesk">Błąd techniczny na stronie</option>
										<option value="info">Błąd merytoryczny na stronie</option>
										<option value="question">Zapytanie dot. tematyki strony</option>
										<option value="buisness">Propozycja współpracy</option>
										<option value="other">Inne</option>
									</select>
								</td>								
							</tr>
							<tr>
								<td colspan="2">
									<textarea id="msg" name="message" rows="10" ></textarea>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label for="zal">Załącznik:</label>
									<input type="file" name="zalacznik" id="zal">
								</td>								
							</tr>
							<tr>
								<th>
									<input id="submit_button" type="submit" value="WYŚLIJ">
								</th>
								<th>
									<input type="reset" value="WYCZYŚĆ" onclick="clear_all()">
								</th>
							</tr>
						</table>
					</form>	
				</div>
				<figure class="sub_container">
					<img src="static/img/phone.png" alt="Symbol telefonu" title="Phone">
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