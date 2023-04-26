<?php defined('ABSPATH') or exit('No direct script access allowed'); ?>
<?php get_header(); ?>
	<section class="news_single uk-container">
		<div class="common_wrapper">
			<div class="content">
				<h1 class="title"><?=get_the_title()?></h1>
				<div class="common_text">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>