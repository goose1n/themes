<div class="inner uk-grid-small" data-uk-grid>
	<div class="image uk-width-1-1 uk-width-auto@s">
		<a href="<?=get_permalink()?>" class="uk-cover-container"><img src="<?=get_stylesheet_directory_uri()?>/images/placeholder.png" data-src="<?=get_the_post_thumbnail_url(get_the_ID(), 'large')?>" alt="<?=esc_attr(get_the_title())?>" data-uk-cover data-uk-img></a>
	</div>
	<div class="uk-flex-1">
		<div class="title">
			<a href="<?=get_permalink()?>"><?=get_the_title()?></a>
		</div>
		<ul class="params common_list uk-flex">
			<li><i class="mdi mdi-calendar"></i> <?=get_the_date()?></li>
			<li><i class="mdi mdi-comment"></i> <?=$post->comment_count?></li>
		</ul>
		<?php if (has_excerpt()): ?>
			<div class="description" data-shave="60">
				<?=get_the_excerpt()?>
			</div>
		<?php endif; ?>
	</div>
</div>