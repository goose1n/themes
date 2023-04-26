<?php defined('ABSPATH') or exit('No direct script access allowed'); ?>
<?php get_header(); ?>
	<div class="uk-container">
		<div class="uk-grid-small" data-uk-grid>
			<article class="news_single uk-width-2-3@m">
				<div class="common_wrapper">
					<div class="content">
						<h1 class="title"><?=get_the_title()?></h1>
						<ul class="params common_list uk-flex">
							<li><i class="mdi mdi-calendar"></i> <?=get_the_date()?></li>
							<?php if ($terms = get_the_terms(get_the_ID(), 'news_media')): ?>
								<li>
									<i class="mdi mdi-tag"></i>
									<?php
										$result = [];
										foreach ($terms as $single)
											$result[] = '<a href="'.get_term_link($single->term_id).'">'.$single->name.'</a>';
										echo implode(', ', $result);
									?>
								</li>
							<?php endif; ?>
							<li><a href="#comments" data-uk-scroll><i class="mdi mdi-comment"></i> <?=$post->comment_count?></a></li>
						</ul>
						<?php if (false && ($thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large'))): ?>
							<div class="preview uk-cover-container">
								<img src="<?=get_stylesheet_directory_uri()?>/images/placeholder.png" data-src="<?=$thumbnail?>" alt="<?=esc_attr(get_the_title())?>" data-uk-cover data-uk-img>
							</div>
						<?php endif; ?>
						<div class="common_text" data-uk-lightbox='toggle: a[href$="jpg"];'>
							<?php the_content(); ?>
						</div>
						<?php if ($gallery = carbon_get_the_post_meta('gallery')): ?>
							<div id="gallery" class="gallery slider-pro" data-uk-lightbox>
								<div class="sp-slides">
									<?php foreach ($gallery as $single): ?>
										<div class="sp-slide">
											<a href="<?=wp_get_attachment_image_url($single, 'full')?>"><img src="<?=get_stylesheet_directory_uri()?>/images/placeholder.png" data-src="<?=wp_get_attachment_image_url($single, 'large')?>" class="sp-image" alt="<?=esc_attr(get_the_title())?>"></a>
										</div>
									<?php endforeach; ?>
								</div>
								<div class="sp-thumbnails">
									<?php foreach ($gallery as $single): ?>
										<img src="<?=get_stylesheet_directory_uri()?>/images/placeholder.png" data-src="<?=wp_get_attachment_image_url($single)?>" class="sp-thumbnail" alt="<?=esc_attr(get_the_title())?>">
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
						<?php get_template_part('sections/share'); ?>
					</div>
				</div>
				<?php get_template_part('sections/comments'); ?>
			</article>
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>