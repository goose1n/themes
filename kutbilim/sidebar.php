<?php defined('ABSPATH') or exit('No direct script access allowed'); ?>
<?php
	// Выборка последних новостей
	$lastNews = new WP_Query([
		'post_type' => 'news',
		'posts_per_page' => 3
	]);
	// Выборка новостей для абитуриентов
	$applicantsNews = new WP_Query([
		'post_type' => 'news',
		'posts_per_page' => 3,
		'tax_query' => [[
			'taxonomy' => 'news_categories',
			'terms' => (pll_get_term(1262) ?: 1262)
		]]
	]);
	// Выборка медиа
	$mediaNews = new WP_Query([
		'post_type' => 'news',
		'posts_per_page' => 3,
		'tax_query' => [[
			'taxonomy' => 'news_media',
			'operator' => 'EXISTS'
		]]
	]);
?>
<aside class="uk-width-1-3@m" data-uk-margin>
	<div class="news_category">
		<div class="option_three common_wrapper">
			<div class="heading">
				<a href="<?=get_post_type_archive_link('news')?>"><?=pll__('Последние новости')?></a>
			</div>
			<div class="content" data-uk-margin>
				<?php while ($lastNews->have_posts()): $lastNews->the_post(); ?>
					<?php get_template_part('sections/news/parts/option_three'); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
	<div class="news_category">
		<div class="option_three common_wrapper">
			<div class="heading type_green">
				<a href="<?=get_term_link(pll_get_term(1262) ?: 1262)?>"><?=pll__('Абитуриент')?></a>
			</div>
			<div class="content" data-uk-margin>
				<?php while ($applicantsNews->have_posts()): $applicantsNews->the_post(); ?>
					<?php get_template_part('sections/news/parts/option_three'); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
	<div class="news_category">
		<div class="option_three common_wrapper">
			<div class="heading type_dark">
				<?=pll__('Медиа')?>
			</div>
			<div class="content" data-uk-margin>
				<?php while ($mediaNews->have_posts()): $mediaNews->the_post(); ?>
					<?php get_template_part('sections/news/parts/option_three'); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</aside>