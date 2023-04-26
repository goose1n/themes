<?php defined('ABSPATH') or exit('No direct script access allowed'); ?>
<?php global $banners; ?>
<div data-uk-slider="autoplay: true;">
	<div class="uk-position-relative uk-light">
		<ul class="uk-slider-items uk-child-width-1-1">
			<?php foreach ($banners as $single): ?>
				<li>
					<?=(($link = $single['link'] ? ['<a href="'.$single['link'].'" target="_blank">', '</a>'] : ['', ''])[0])?>
						<img src="<?=get_stylesheet_directory_uri()?>/images/placeholder.png" data-src="<?=wp_get_attachment_image_url($single['image'], 'large')?>" alt="<?=esc_attr($single['title'])?>" data-uk-img>
					<?=$link[1]?>
				</li>
			<?php endforeach; ?>
		</ul>
		<ul class="uk-slider-nav uk-dotnav uk-flex-center uk-position-bottom uk-padding-small"></ul>
	</div>
</div>