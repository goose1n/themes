<?php
	defined('ABSPATH') or exit('No direct script access allowed');

	/**
	 * Инициализация шаблона
	 */

	// Подключение зависимостей
	get_template_part('includes/admin');
	get_template_part('includes/configs');
	get_template_part('includes/fields');

	// Инициализация шаблона
	add_action('after_setup_theme', 'template_init');
	function template_init() {
		// Включение миниатюр
		add_theme_support('post-thumbnails', ['news', 'analytics', 'methodical']);
		// Удаление REST API из шапки
		remove_action('wp_head', 'rest_output_link_wp_head', 10);
	}

	// Изменение запросов
	add_action('pre_get_posts', 'changing_queries');
	function changing_queries($query) {
		if (!is_admin() && $query->is_main_query()) {
			if (is_search())
				$query->set('post_type', ['news', 'analytics', 'methodical']);
		}

		return $query;
	}

	// Переопределение шаблонов
	add_action('template_include', 'custom_templates');
	function custom_templates($template) {
		if (is_post_type_archive('news') or is_tax(['news_categories', 'news_media', 'news_types']) or is_search())
			$template = locate_template('sections/news/category.php');
		elseif (is_singular('news'))
			$template = locate_template('sections/news/single.php');
		elseif (is_post_type_archive('analytics'))
			$template = locate_template('sections/analytics/category.php');
		elseif (is_singular('analytics'))
			$template = locate_template('sections/analytics/single.php');
		elseif (is_post_type_archive('methodical'))
			$template = locate_template('sections/methodical/category.php');
		elseif (is_singular('methodical'))
			$template = locate_template('sections/methodical/single.php');

		return $template;
	}

	// Настройка почты
	add_action('phpmailer_init', 'init_mail');
	function init_mail($phpmailer) {
		$phpmailer->Host = 'smtp.mail.ru';
		$phpmailer->Port = 465;
		$phpmailer->Username = 'kutbilim.kg@edugate.kg';
		$phpmailer->Password = 'CB?bptu\'S3wF:c6J:WAV';
		$phpmailer->SMTPAuth = true;
		$phpmailer->SMTPSecure = 'ssl';
		$phpmailer->From = $phpmailer->Username;
		$phpmailer->FromName = 'Кутбилим';
		// $phpmailer->SMTPDebug = 2;
		// $phpmailer->debug = 1;
		$phpmailer->IsSMTP();
	}

	// Заголовок
	add_filter('document_title_separator', function() {
		return '–';
	});

	// Верхний бар
	add_filter('show_admin_bar', '__return_false');

	// Хлебные крошки
	function get_breadcrumb($items = [], $main = true) {
		$result[] = '<ul class="common_list uk-flex">';
		if ($main)
			$result[] = '<li><a href="'.get_home_url().'">'.pll__('Главная').'</a></li>';
		foreach ($items as $item)
			$result[] = isset($item[1]) ? '<li><a href="'.$item[0].'">'.$item[1].'</a></li>' : '<li><span>'.$item[0].'</span></li>';
		$result[] = '</ul>';

		return implode('', $result);
	}

	// Подключение библиотек
	$version = 1.0;
	add_action('wp_enqueue_scripts', 'header_libraries');
	add_action('wp_footer', 'footer_libraries');
	function header_libraries() {
		global $version;

		wp_deregister_script('jquery');
		wp_enqueue_style('template', get_template_directory_uri().'/styles/template.min.css?v='.$version);
	}
	function footer_libraries() {
		global $version;

		// Шрифты
		wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i&amp;subset=cyrillic');
		wp_enqueue_style('icons', 'https://cdn.materialdesignicons.com/5.6.55/css/materialdesignicons.min.css');
		// Библиотеки
		wp_enqueue_script('jquery', 'https://cdn.jsdelivr.net/npm/jquery@3.4/dist/jquery.min.js');
		$jsdelivr['css']['uikit'] = 'npm/uikit@3.4/dist/css/uikit.min.css';
		$jsdelivr['js']['uikit'] = 'npm/uikit@3.4/dist/js/uikit.min.js';
		$jsdelivr['css']['superfish'] = 'npm/superfish@1.7/dist/css/superfish.min.css';
		$jsdelivr['js']['superfish'] = 'npm/superfish@1.7/dist/js/superfish.min.js';
		if (is_home()) {
			wp_enqueue_script('shave', 'https://cdnjs.cloudflare.com/ajax/libs/shave/2.5.10/jquery.shave.min.js');
		}
		if (is_singular(['news', 'analytics'])) {
			wp_enqueue_style('sliderPro', 'https://cdn.jsdelivr.net/npm/slider-pro@1.5/dist/css/slider-pro.min.css');
			$jsdelivr['js']['sliderPro'] = 'npm/slider-pro@1.5/dist/js/jquery.sliderPro.min.js';
		}
		if (is_singular(['news', 'analytics', 'methodical'])) {
			wp_enqueue_script('share', 'https://yastatic.net/share2/share.js');
		}
		if (is_page(pll_get_post(16))) {
			wp_enqueue_script('maps', 'https://api-maps.yandex.ru/2.1/?lang=ru_RU');
		}
		wp_enqueue_style('jsdelivr', 'https://cdn.jsdelivr.net/combine/'.implode(',', $jsdelivr['css']));
		wp_enqueue_script('jsdelivr', 'https://cdn.jsdelivr.net/combine/'.implode(',', $jsdelivr['js']));
		wp_enqueue_script('template', get_template_directory_uri().'/scripts/template.min.js?v='.$version);
	}

// functions.php