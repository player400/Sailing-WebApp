<!DOCTYPE html>
<html lang="pl">
	<head>
		<?php
		include_once 'segments/head.php';
		?>	
		<link rel="stylesheet" type="text/css" href="static/styles/layout.css">
		<link rel="stylesheet" type="text/css" href="static/styles/global.css">
		<link rel="stylesheet" type="text/css" href="static/styles/tabs.css">
		
		<link rel="stylesheet" type="text/css" href="static/scripts/jquery/jquery-ui.min.css">
		<link rel="stylesheet" type="text/css" href="static/scripts/jquery/jquery-ui.structure.min.css">
		<link rel="stylesheet" type="text/css" href="static/scripts/jquery/jquery-ui.theme.min.css">
		<script src="static/scripts/jquery/jquery.js"></script>
		<script src="static/scripts/jquery/jquery-ui.min.js"></script>
		<script>
			$( function() {
				$( "#tabs" ).tabs();
				document.getElementById('tabs_menu').style.display = 'block';
			} );
		</script>
		
		<script src="static/scripts/add_favourites_menu.js"></script>
		<script src="static/scripts/darkmode.js"></script>
	</head>
	<body onclick>
		<?php 
		$active = "index";
		require_once 'segments/nav.php'; 
		?>
		
		<main>
					
			<header>
				Żeglarstwo śródlądowe w Polsce
			</header>

			<article class="general_content_box">
				<h2>Wstęp</h2>
				<div class="sub_container">
					<h4>
						Niniejsza strona jest zbiorem informacji na temat żeglarstwa śródlądowego w Polsce, zarówno rekreacyjnego jak i sportowego.<br>
						Poniżej można znaleźć różnego rodzaju informacje dotyczące tego tematu, natomiast w zakładce KLASY dostępne są dane o kilku najpopularniejszych typach łodzi wykorzystywanych na polskich wodach śródlądowych i morskich wewnętrznych.<br>
					</h4>
					<p>
						Wdg badania Omnibus ok. 70% Polaków miało w ciągu swojego życia mniejszy lub większy kontakt z żeglarstwem, natomist 2% Polaków uczestniczy lub uczestniczyło w zawodach żeglarskich, natomiast aż 5% badanych zadeklarowało, że potrafi samodzielnie sterować jachtem pod żaglami.<br>
						<br>
						Głównymi ośrodkami żeglarstwa w Polsce są Mazury, z Giżyckiem, Rynem, Mrągowem, Mikołajkami, Ostródą oraz Pomorze na czele z Zatoką Gdańską.<br>
						<br>
						Największą organizacją branżową w kraju jest <a href="https://pya.org.pl/polski-zwiazek-zeglarski" target="new">Polski Związek Żeglarski</a>, podzielony na 38 związków okręgowych i zrzeszający ponad 700 klubów żeglarskich. PZŻ jest jedynym podmiotem wydającym uprawnienia żeglarskie oraz rejestrującym jachty żaglowe.<br>
						Związek organizuje również zawody sportowe oraz jest odpowiedzialny za dobór Polskiej kadry narodowej.
						
					<p>		
				</div>
				<figure class="sub_container">
					<img src="static/img/zachod_slonca.jpg" alt="Zachód słońca nad jeziorem" title="Piękna sceneria Pojezierza Mazurskiego">
				</figure>
				
			</article>
			<article class="general_content_box">
				<h2>Charakterystyka żeglarstwa w Polsce</h2>
				<div class="sub_container">
					<img src="static/img/jezioro.jpg" alt="Zdjęcie jeziora" title="Polskie jezioro">
				</div>
				<div class="sub_container" id="tabs">
					<ul id="tabs_menu">
						<li>
							<a href="#tury">Turystyka</a>
						</li>
						<li>
							<a href="#spor">Sport</a>
						</li>
						<li>
							<a href="#praw">Prawo</a>
						</li>
					</ul>
					<div id="tury">
						<h3>Turystyka</h3>
						<p>
							W miejscowościach położonych nad jeziorami i będących dużymi ośrodkami turystycznymi dostępna jest zazwyczaj bogata oferta turystyczna.<br>
							Możliwy jest min. czarter jachtów - dla wielu osób najbardziej praktyczny sposób na żeglarstwo rekreacyjne.<br>
							Pośród jachtów czarterowych przeważają zdecydowanie duże jachty kabinowe. Popularną formą wypoczynku na dużych akwenach są właśnie kilkudniowe rejsy wyczarterowanymi jachtami.
						</p>
					</div>
					<div id="spor">
						<h3>Zawody sportowe (regaty)</h3>
						<p>
							Głównym organizatorem regat, zarówno profesjonalnych, jak i amatorskich jest PZŻ.<br>
							Do największych należą Ogólnopolskie Regaty Żeglarskie, których uczestnicy są wyłaniani w regatach okręgowych.							
						</p>
					</div>
					<div id="praw">
						<h3>Regulacje prawne dot. żeglarstwa</h3>
						<p>
							Obowiązkowa jest rejestracja wszystkich jednostek pływającyh o długości kadłuba min. 7.5 lub o silniku mocy min. 15kW. Zdecydowana większość polskich jachtów żaglowych (poza jachtami pełnomorskimi) nie podlega więc temu obowiązkowi i zarejestrowana nie jest.<br>
							Istnieją 3 stopnie uprawnień żeglarskich: ŻJ (Żeglarz Jachtowy), JSM (Jachtowy Sternik Morski), KJ (Kapitan jachtowy). Osoby dysponujące uprawnieniami ŻJ i JSM mogą samodzielnie prowadzić jachty żaglowe po wodach śródlądowych oraz po wodach morskich z pewnymi ograniczeniami (dot. długości kadłuba, pogody oraz akwenu).<br>
							Bez żadnych uprawnień można prowadzić jednostki do 7.5m kadłuba, a więc większość jachtów występujących na polskich wodach śródlądowych i morskich wewnętrznych.
						</p>
					</div>
				</div>
			</article>
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
					<a class="fav_button" href="gallery.php">Zobacz galerię</a>
				</div>
				<figure class="sub_container">
					<img src="static/img/sailing_boat.jpg" alt="Zachód słońca nad jeziorem" title="Piękna sceneria Pojezierza Mazurskiego">
				</figure>
				
			</article>
		</main>
		<?php
		include_once 'segments/footer.php';
		?>
	</body>
</html>