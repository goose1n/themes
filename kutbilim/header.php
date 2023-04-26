<?php defined('ABSPATH') or exit('No direct script access allowed'); ?>
<?php
	global $globalSocial, $globalCategories, $globalMedia, $newsCategories;

	// Выборка категорий
	$newsCategories = get_terms([
		'taxonomy' => 'news_categories',
		'include' => [
			pll_get_term(1262),
			pll_get_term(1282),
			pll_get_term(1612),
			pll_get_term(1382),
			pll_get_term(1372),
			pll_get_term(1702),
			pll_get_term(1517),
			pll_get_term(1467),
			pll_get_term(1447),
			pll_get_term(1757),
			pll_get_term(1482),
			pll_get_term(1807),
			pll_get_term(1637),
			pll_get_term(1687),
			pll_get_term(1767),
			pll_get_term(1722),
			pll_get_term(1832),
			pll_get_term(1852)
		],
		'hide_empty' => false
	]);
	// Выборка медиа
	$media = get_terms([
		'taxonomy' => 'news_media',
		'hide_empty' => false
	]);
?>
<!DOCTYPE HTML>
<html lang="<?=pll_current_language()?>" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#" itemscope itemtype="http://schema.org/WebSite">
	<head>
		<meta charset="<?=get_bloginfo('charset')?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?=wp_get_document_title()?></title>
		<?php wp_head(); ?>
		<?php foreach (['small' => '16x16', 'medium' => '32x32'] as $key => $value): ?>
			<link rel="icon" href="<?=get_template_directory_uri()?>/images/favicon/<?=$key?>.png" type="image/png" sizes="<?=$value?>">
		<?php endforeach; ?>
		<script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>
	</head>
	<body>
		<header class="header">
			<nav class="before">
				<div class="uk-container uk-flex uk-flex-between">
					<ul class="common_list uk-flex">
						<?php foreach (pll_the_languages(['hide_if_empty' => false, 'raw' => true]) as $single): ?>
							<li><a href="<?=$single['url']?>" class="<?=($single['current_lang'] ? 'active' : '')?>"><?=$single['name']?></a></li>
						<?php endforeach; ?>
					</ul>
					<ul class="common_list uk-flex">
						<?php if (!is_user_logged_in()): ?>
							<li><a href="<?=wp_login_url()?>"><?=pll__('Войти')?></a></li>
						<?php else: ?>
							<li><a href="<?=get_admin_url()?>"><?=pll__('Панель управления')?></a></li>
							<li><a href="<?=wp_logout_url()?>"><?=pll__('Выход')?></a></li>
						<?php endif; ?>
					</ul>
				</div>
			</nav>
			<div class="inner uk-container uk-section-medium uk-flex uk-flex-between uk-flex-middle">
				<?php $heading = is_home() ? ['<h1 class="logo">', '</h1>'] : ['<div class="logo">', '</div>']; ?>
				<?=$heading[0]?>
					<a href="<?=home_url()?>" title="<?=pll__('На главную')?>"><?=(get_option('blogname').' – '.get_option('blogdescription'))?></a>
				<?=$heading[1]?>
				<?php
					$social = [
						['facebook', pll__('Facebook')],
						['vk', pll__('ВКонтакте')],
						['twitter', pll__('Twitter')],
						['youtube', pll__('YouTube')],
						['instagram', pll__('Instagram')]
					];
					$globalSocial = [];
					foreach ($social as $single)
						if ($value = carbon_get_theme_option('social_'.$single[0]))
							$globalSocial[] = '<li><a href="'.$value.'" class="mdi mdi-'.$single[0].'" title="'.$single[1].'" target="_blank"></a></li>';
					$globalSocial = implode('', $globalSocial);
				?>
				<?php if ($globalSocial): ?>
					<ul class="social common_list uk-flex uk-visible@s">
						<?=$globalSocial?>
					</ul>
				<?php endif; ?>
			</div>
			<div class="after uk-section-small">
				<div class="uk-container uk-flex uk-flex-between uk-flex-middle">
					<nav class="menu">
						<ul id="menu" class="common_list uk-flex">
							<li><a href="#sidebar" data-uk-toggle><i class="mdi mdi-menu"></i> <?=pll__('Меню')?></a></li>
							<li><a href="<?=home_url()?>"><?=pll__('Главная')?></a></li>
							<li><a href="<?=get_post_type_archive_link('analytics')?>"><?=pll__('Аналитика')?></a></li>
							<li>
								<a href="<?=get_post_type_archive_link('news')?>"><?=pll__('Новости')?> <i class="mdi mdi-menu-down"></i></a>
								<ul>
									<?php
										$result = [];
										foreach ($newsCategories as $single)
											$result[] = '<li><a href="'.get_term_link($single->term_id).'">'.$single->name.'</a></li>';
										echo ($globalCategories = implode('', ($result ?? [])));
									?>
								</ul>
							</li>
							<li><a href="<?=get_post_type_archive_link('methodical')?>"><?=pll__('Методические работы')?></a></li>
							<li>
								<a href="#"><?=pll__('Медиа')?> <i class="mdi mdi-menu-down"></i></a>
								<ul>
									<?php
										$result = [];
										foreach ($media as $single)
											$result[] = '<li><a href="'.get_term_link($single->term_id).'">'.$single->name.'</a></li>';
										echo ($globalMedia = implode('', ($result ?? [])));
									?>
								</ul>
							</li>
							<li><a href="<?=get_permalink(pll_get_post(13))?>"><?=pll__('О нас')?></a></li>
							<li><a href="<?=get_permalink(pll_get_post(15))?>"><?=pll__('Контакты')?></a></li>
						</ul>
					</nav>
					<div class="search">
						<a href="#" class="mdi mdi-magnify" data-uk-toggle="target: + *; animation: uk-animation-fade;"></a>
						<form method="get" action="<?=home_url()?>" hidden>
							<input name="s" value="<?=get_search_query()?>" placeholder="<?=pll__('Поиск')?>">
						</form>
					</div>
				</div>
			</div>
		</header>
		<?php if (!is_home()): ?>
			<nav class="common_breadcrumb">
				<div class="uk-container">
					<?php
						if (is_singular('news') or is_tax(['news_categories', 'news_media', 'news_types'])) {
							$breadcrumb[] = [get_post_type_archive_link('news'), pll__('Новости')];
							if (is_singular('news') && ($terms = get_the_terms(get_the_ID(), 'news_categories')))
								$breadcrumb[] = [get_term_link($terms[0]->term_id), $terms[0]->name];
						} elseif (is_singular('analytics')) {
							$breadcrumb[] = [get_post_type_archive_link('analytics'), pll__('Аналитика')];
						} elseif (is_singular('methodical')) {
							$breadcrumb[] = [get_post_type_archive_link('methodical'), pll__('Методические работы')];
						}
						echo get_breadcrumb($breadcrumb ?? []);
					?>
				</div>
			</nav>
		<?php endif; ?>
		<main class="uk-section-small" data-uk-height-viewport="expand: true;" data-uk-margin>