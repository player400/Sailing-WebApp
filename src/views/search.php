<?php if(!empty($images)):?>
	<form action="/save_chosen.php" method="post">
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
					<label for="<?php echo $image['id']?>">Zaznacz: </label><input type="checkbox" name="chosen[]" value="<?php echo $image['id']?>" id="<?php echo $image['id']?>" <?php if($image['checked']) {echo 'checked disabled';}?>>
					<?php if(!($image['owner']==='public')){ echo '(prywatne)'; } ?> 
				</figure>
			<?php endforeach ?>
			<div class="line">
				<input id="submit_button" type="submit" value="ZAPISZ WYBRANE">
				<input type="reset" value="WYCZYŚĆ">
			</div>
		</div>
	</form>
<?php endif ?>
