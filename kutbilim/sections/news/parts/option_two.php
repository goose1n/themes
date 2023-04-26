<div>
	<div class="image">
		<a href="<?=get_permalink()?>" class="uk-cover-container"><img src="<?=get_stylesheet_directory_uri()?>/images/placeholder.png" data-src="<?=get_the_post_thumbnail_url(get_the_ID(), 'large')?>" alt="<?=esc_attr(get_the_title())?>" data-uk-cover data-uk-img></a>
	</div>
	<div class="title">
		<a href="<?=get_permalink()?>"><?=get_the_title()?></a>
	</div>
	<div class="date">
		<?=get_the_date()?>
	</div>
	<?php if (has_excerpt()): ?>
		<div class="description" data-shave="60">
			<?=get_the_excerpt()?>
		</div>
	<?php endif; ?>
</div>