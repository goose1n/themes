<?php defined('ABSPATH') or exit('No direct script access allowed'); ?>
<?php
	// Выборка главных новостей
	$topNews = new WP_Query([
		'post_type' => ['news', 'analytics'],
		'posts_per_page' => 9,
		'tax_query' => [[
			'taxonomy' => 'news_types',
			'terms' => (pll_get_term(26) ?: 26)
		]]
	]);
	// Выборка последних новостей
	$lastNews = new WP_Query([
		'post_type' => 'news',
		'posts_per_page' => 4
	]);
	// Выборка аналитики
	$analytics = new WP_Query([
		'post_type' => 'analytics',
		'posts_per_page' => 4
	]);
	// Выборка новостей о высшем образовании
	$higherEducation = new WP_Query([
		'post_type' => 'news',
		'posts_per_page' => 6,
		'tax_query' => [[
			'taxonomy' => 'news_categories',
			'terms' => (pll_get_term(1342) ?: 1342)
		]]
	]);
	// Выборка новостей для абитуриентов
	$applicantsNews = new WP_Query([
		'post_type' => 'news',
		'posts_per_page' => 2,
		'tax_query' => [[
			'taxonomy' => 'news_categories',
			'terms' => (pll_get_term(1262) ?: 1262)
		]]
	]);
	// Выборка новостей о электронной школе
	$electronicNews = new WP_Query([
		'post_type' => 'news',
		'posts_per_page' => 5,
		'tax_query' => [[
			'taxonomy' => 'news_categories',
			'terms' => (pll_get_term(1837) ?: 1837)
		]]
	]);
	// Выборка новостей об открытом уроке
	$openLessonNews = new WP_Query([
		'post_type' => 'news',
		'posts_per_page' => 5,
		'tax_query' => [[
			'taxonomy' => 'news_categories',
			'terms' => (pll_get_term(1597) ?: 1597)
		]]
	]);
	// Выборка медиа
	$mediaPhoto = new WP_Query([
		'post_type' => 'news',
		'posts_per_page' => 4,
		'tax_query' => [[
			'taxonomy' => 'news_media',
			'terms' => (pll_get_term(18) ?: 18)
		]]
	]);
	$mediaVideo = new WP_Query([
		'post_type' => 'news',
		'posts_per_page' => 4,
		'tax_query' => [[
			'taxonomy' => 'news_media',
			'terms' => (pll_get_term(14) ?: 14)
		]]
	]);
	$mediaAudio = new WP_Query([
		'post_type' => 'news',
		'posts_per_page' => 4,
		'tax_query' => [[
			'taxonomy' => 'news_media',
			'terms' => (pll_get_term(16) ?: 16)
		]]
	]);
?>
<?php get_header(); ?>
	<?php if ($banners = carbon_get_theme_option('banner_before_main_news')): ?>
		<div class="common_slider uk-container">
			<?php get_template_part('sections/banner'); ?>
		</div>
	<?php endif; ?>
	<section class="news_main uk-container">
		<div class="common_wrapper" data-uk-slider>
			<h2 class="heading uk-flex uk-flex-between uk-flex-middle">
				<a href="<?=get_term_link(pll_get_term(26) ?: 26)?>"><?=pll__('Главные не новости')?></a>
				<span>
					<a href="#" class="mdi mdi-chevron-left-circle" data-uk-slider-item="previous"></a>
					<a href="#" class="mdi mdi-chevron-right-circle" data-uk-slider-item="next"></a>
				</span>
			</h2>
			<div class="content">
				<div class="uk-slider-container">
					<div class="uk-slider-items uk-child-width-1-1">
						<?php while ($topNews->have_posts()): $topNews->the_post(); ?>
							<div>
								<div class="uk-grid-small uk-child-width-1-2@m" data-uk-grid>
									<div>
										<a href="<?=get_permalink()?>" class="inner main uk-cover-container">
											<img src="<?=get_stylesheet_directory_uri()?>/images/placeholder.png" data-src="<?=get_the_post_thumbnail_url(get_the_ID(), 'large')?>" alt="<?=esc_attr(get_the_title())?>" data-uk-cover data-uk-img>
											<span class="description uk-position-bottom">
												<?php if ($terms = get_the_terms(get_the_ID(), 'news_categories')): ?>
													<span class="category"><?=$terms[0]->name?></span>
												<?php endif; ?>
												<span class="title"><?=get_the_title()?></span>
												<span><?=get_the_date()?></span>
											</span>
										</a>
									</div>
									<?php if ($topNews->have_posts()): ?>
										<div>
											<div class="uk-grid-small uk-child-width-1-2@s uk-child-width-1-1@m" data-uk-grid>
												<?php for ($i = 1; $i <= 2; $i++): ?>
													<?php if ($topNews->have_posts()): $topNews->the_post(); ?>
														<div>
															<a href="<?=get_permalink()?>" class="inner secondary uk-cover-container">
																<img src="<?=get_stylesheet_directory_uri()?>/images/placeholder.png" data-src="<?=get_the_post_thumbnail_url(get_the_ID(), 'large')?>" alt="<?=esc_attr(get_the_title())?>" data-uk-cover data-uk-img>
																<span class="description uk-position-bottom">
																	<?php if ($terms = get_the_terms(get_the_ID(), 'news_categories')): ?>
																		<span class="category"><?=$terms[0]->name?></span>
																	<?php endif; ?>
																	<span class="title"><?=get_the_title()?></span>
																	<span><?=get_the_date()?></span>
																</span>
															</a>
														</div>
													<?php endif; ?>
												<?php endfor; ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php if ($banners = carbon_get_theme_option('banner_after_main_news')): ?>
		<div class="common_slider uk-container">
			<?php get_template_part('sections/banner'); ?>
		</div>
	<?php endif; ?>
	<section class="news_category uk-container">
		<div class="option_one common_wrapper">
			<h2 class="heading"><a href="<?=get_post_type_archive_link('news')?>"><?=pll__('Последние новости')?></a></h2>
			<div class="content">
				<div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m" data-uk-grid>
					<?php while ($lastNews->have_posts()): $lastNews->the_post(); ?>
						<?php get_template_part('sections/news/parts/option_one'); ?>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</section>
	<section class="news_category uk-container">
		<div class="option_one common_wrapper">
			<h2 class="heading"><a href="<?=get_post_type_archive_link('analytics')?>"><?=pll__('Аналитика')?></a></h2>
			<div class="content">
				<div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m" data-uk-grid>
					<?php while ($analytics->have_posts()): $analytics->the_post(); ?>
						<?php get_template_part('sections/news/parts/option_one'); ?>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</section>
	<div class="uk-container">
		<div class="uk-grid-small" data-uk-grid data-uk-height-match="target: > * > .common_wrapper;">
			<section class="news_category uk-width-2-3@m">
				<div class="common_wrapper">
					<h2 class="heading"><a href="<?=get_term_link(pll_get_term(1342) ?: 1342)?>"><?=pll__('Высшее образование')?></a></h2>
					<div class="content">
						<div class="uk-grid-small uk-child-width-1-2@s" data-uk-grid>
							<div class="option_two">
								<?php if ($higherEducation->have_posts()): ?>
									<?php $higherEducation->the_post(); ?>
									<?php get_template_part('sections/news/parts/option_two'); ?>
								<?php endif; ?>
							</div>
							<div class="option_three">
								<?php while ($higherEducation->have_posts()): $higherEducation->the_post(); ?>
									<?php get_template_part('sections/news/parts/option_three'); ?>
								<?php endwhile; ?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="news_category uk-width-1-3@m">
				<div class="common_wrapper">
					<h2 class="heading type_green"><a href="<?=get_term_link(pll_get_term(1262) ?: 1262)?>"><?=pll__('Абитуриент')?></a></h2>
					<div class="content">
						<div class="uk-grid-small uk-child-width-1-1" data-uk-grid>
							<div class="option_one uk-width-1-2@s uk-width-1-1@m">
								<?php if ($applicantsNews->have_posts()): ?>
									<?php $applicantsNews->the_post(); ?>
									<?php get_template_part('sections/news/parts/option_one'); ?>
								<?php endif; ?>
							</div>
							<div class="option_three uk-width-1-2@s uk-width-1-1@m">
								<?php if ($applicantsNews->have_posts()): ?>
									<?php $applicantsNews->the_post(); ?>
									<?php get_template_part('sections/news/parts/option_three'); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<div class="news_category darkened">
		<div class="uk-container">
			<div class="option_one common_wrapper">
				<ul class="tabs uk-subnav uk-subnav-pill uk-flex-center" data-uk-switcher="animation: uk-animation-fade;">
					<li><a href="#"><?=pll__('Фото')?></a></li>
					<li><a href="#"><?=pll__('Видео')?></a></li>
					<li><a href="#"><?=pll__('Аудио')?></a></li>
				</ul>
				<div class="content uk-switcher">
					<div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m" data-uk-grid>
						<?php while ($mediaPhoto->have_posts()): $mediaPhoto->the_post(); ?>
							<?php get_template_part('sections/news/parts/option_one'); ?>
						<?php endwhile; ?>
					</div>
					<div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m" data-uk-grid>
						<?php while ($mediaVideo->have_posts()): $mediaVideo->the_post(); ?>
							<?php get_template_part('sections/news/parts/option_one'); ?>
						<?php endwhile; ?>
					</div>
					<div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m" data-uk-grid>
						<?php while ($mediaAudio->have_posts()): $mediaAudio->the_post(); ?>
							<?php get_template_part('sections/news/parts/option_one'); ?>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="uk-container">
		<div class="uk-grid-small" data-uk-grid data-uk-height-match="target: > * > .common_wrapper;">
			<section class="news_category uk-width-1-3@m">
				<div class="common_wrapper">
					<h2 class="heading"><a href="<?=get_term_link(pll_get_term(1837) ?: 1837)?>"><?=pll__('Электронная школа')?></a></h2>
					<div class="content" data-uk-margin>
						<div class="option_two">
							<?php if ($electronicNews->have_posts()): ?>
								<?php $electronicNews->the_post(); ?>
								<?php get_template_part('sections/news/parts/option_two'); ?>
							<?php endif; ?>
						</div>
						<div class="option_three">
							<?php while ($electronicNews->have_posts()): $electronicNews->the_post(); ?>
								<?php get_template_part('sections/news/parts/option_three'); ?>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</section>
			<section class="news_category uk-width-1-3@m">
				<div class="common_wrapper">
					<h2 class="heading"><a href="<?=get_term_link(pll_get_term(1597) ?: 1597)?>"><?=pll__('Открытый урок')?></a></h2>
					<div class="content" data-uk-margin>
						<div class="option_two">
							<?php if ($openLessonNews->have_posts()): ?>
								<?php $openLessonNews->the_post(); ?>
								<?php get_template_part('sections/news/parts/option_two'); ?>
							<?php endif; ?>
						</div>
						<div class="option_three">
							<?php while ($openLessonNews->have_posts()): $openLessonNews->the_post(); ?>
								<?php get_template_part('sections/news/parts/option_three'); ?>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
<?php get_footer(); ?>