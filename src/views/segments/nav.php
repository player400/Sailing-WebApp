		<nav>
			<svg id="menu_svg" viewBox="0 0 100 100" onclick="change()">
				<polygon points="75,98 5,98 15,83 54,83 54,10 57,10 57,83 95,83" style="fill:var(--general_text_color);"/>
				<polygon points="95,82 62,78 58,10" style="fill:var(--navigation_text_color);"/>
				<polygon points="53,80 15,75 53,10" style="fill:var(--theme_color);"/>
			</svg>
			<ol>
				<li class="menu_element <?php if($active==="index"): ?> active <?php endif;?>" >
					<a href="index.php" class="menu_link">
						STRONA GŁÓWNA
					</a>
				</li>

				<li id="dropdown" class="menu_element <?php if($active==="classes"): ?> active <?php endif;?>">
					<a href="#" class="menu_link">KLASY</a>
					<ul id="dropdown_body">		
						<li class="menu_element">
							<a href="classes.php#omega" class="menu_link">
								OMEGA
							</a>
						</li>
						

						
						<li class="menu_element">
							<a href="classes.php#venus" class="menu_link">
								VENUS
							</a>
						</li>
							

						
						<li class="menu_element">
							<a href="classes.php#orion" class="menu_link">
								ORION
							</a>
						</li>
											

						
						<li class="menu_element">
							<a href="classes.php#laser" class="menu_link">
								LASER
							</a>
						</li>
	
						<li class="menu_element">
							<a href="classes.php#optymist" class="menu_link">
								OPTYMIST
							</a>
						</li>			
					</ul>
				</li>

				<li class="menu_element <?php if($active==="contact"): ?> active <?php endif;?>" id="bottom_menu_element">
					<a href="contact.php" class="menu_link">
						KONTAKT
					</a>
				</li>
			</ol>
			
		</nav>