<?php // Template Name: Контакты ?>
<?php defined('ABSPATH') or exit('No direct script access allowed'); ?>
<?php get_header(); ?>
	<div id="contacts" class="contacts uk-container">
		<div class="uk-grid-small uk-child-width-1-2@m" data-uk-grid data-uk-height-match="target: > * > .common_wrapper;">
			<section>
				<div class="common_wrapper">
					<h1 class="heading"><?=get_the_title()?></h1>
					<div class="content common_text">
						<?php the_content(); ?>
					</div>
				</div>
			</section>
			<section class="feedback">
				<div class="common_wrapper">
					<h2 class="heading"><?=pll__('Обратная связь')?></h2>
					<div class="content">
						<?=do_shortcode('[contact-form-7 id="'.['ru' => 16, 'ky' => 52][pll_current_language()].'"]')?>
					</div>
				</div>
			</section>
			<div class="uk-width-1-1">
				<div class="map" data-coords="<?=esc_attr(carbon_get_theme_option('contacts_coords'))?>"></div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>