<?php defined('ABSPATH') or exit('No direct script access allowed'); ?>
<?php get_header(); ?>
	<section class="news_category uk-container">
		<div class="option_four common_wrapper">
			<h1 class="heading"><?=(is_post_type_archive() ? pll__('Новости') : (is_search() ? (pll__('Поиск').': '.get_search_query()) : single_term_title()))?></a></h1>
			<div class="content">
				<?php while (have_posts()): the_post(); ?>
					<?php get_template_part('sections/news/parts/option_four'); ?>
				<?php endwhile; ?>
			</div>
			<?php wp_pagenavi(); ?>
		</div>
	</section>
<?php get_footer(); ?>