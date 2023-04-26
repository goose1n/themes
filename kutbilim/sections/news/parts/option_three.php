<div class="uk-grid-small" data-uk-grid>
	<div class="image">
		<a href="<?=get_permalink()?>" class="uk-cover-container"><img src="<?=get_stylesheet_directory_uri()?>/images/placeholder.png" data-src="<?=get_the_post_thumbnail_url(get_the_ID(), 'medium')?>" alt="<?=esc_attr(get_the_title())?>" data-uk-cover data-uk-img></a>
	</div>
	<div class="uk-flex-1">
		<div class="title">
			<a href="<?=get_permalink()?>"><?=get_the_title()?></a>
		</div>
		<div class="date">
			<?=get_the_date()?>
		</div>
	</div>
</div>