<?php
	defined('ABSPATH') or exit('No direct script access allowed');

	/**
	 * Инициализация админ-панели
	 */

	// Верхний бар
	add_action('wp_before_admin_bar_render', 'custom_admin_bar');
	function custom_admin_bar() {
		global $wp_admin_bar;

		$wp_admin_bar->remove_menu('comments');
		$wp_admin_bar->remove_menu('new-content');
		$wp_admin_bar->remove_menu('delete-cache');
		$wp_admin_bar->remove_menu('autoptimize');
		if (current_user_can('administrator')) {
			$wp_admin_bar->add_menu([
				'parent' => false,
				'id' => 'clear-cache',
				'title' => __('Очистить кэш'),
				'href' => wp_nonce_url(admin_url('options-general.php?page=wpsupercache&wp_delete_cache=1&tab=contents'), 'wp-cache')
			]);
		} else {
			$wp_admin_bar->remove_node('wp-logo');
			$wp_admin_bar->remove_menu('languages');
		}
	}

	// Виджеты консоли
	add_action('wp_dashboard_setup', 'clear_wp_dash');
	function clear_wp_dash() {
		// Приветствие
		remove_action('welcome_panel', 'wp_welcome_panel');
		add_meta_box('welcome', __('Добро пожаловать!'), 'welcome_dashboard_widget', 'dashboard', 'normal');
		function welcome_dashboard_widget() {
			echo __('Для навигации по админ-панели воспользуйтесь левым меню.');
		}
		// Отключение виджетов
		$removable = [
			'dashboard_right_now',
			'dashboard_activity',
			'dashboard_quick_press',
			'dashboard_primary'
		];
		$widgets['normal'] = &$GLOBALS['wp_meta_boxes']['dashboard']['normal']['core'];
		$widgets['side'] = &$GLOBALS['wp_meta_boxes']['dashboard']['side']['core'];
		foreach ($removable as $remove) {
			if (isset($widgets['normal'][$remove]))
				unset($widgets['normal'][$remove]);
			if (isset($widgets['side'][$remove]))
				unset($widgets['side'][$remove]);
		}
		// Отключение виджета здоровья
		remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
		// Отключение виджета TinyPNG
		remove_meta_box('tinypng_dashboard_widget', 'dashboard', 'normal');
	}

	// Блокирование страниц
	add_filter('user_has_cap', 'disable_pages', 10, 3);
	function disable_pages($caps, $current, $args) {
		// ID страниц
		$pages = [];
		// Изменение прав
		if (($args[0] == 'delete_post') && in_array($args[2], $pages))
			$caps[$current[0]] = false;

		return $caps;
	}

	// Ограничение просмотра постов
	add_filter('parse_query', 'show_current_user_posts');
	function show_current_user_posts($query) {
		if (is_admin() && function_exists('get_current_screen') && (get_current_screen()->id == 'edit-methodical') && !current_user_can('administrator'))
			$query->set('author', get_current_user_id());
	}

	// Ограничение просмотра медиафайлов
	add_filter('parse_query', 'show_current_user_attachments');
	add_filter('ajax_query_attachments_args', 'show_current_user_attachments_ajax');
	function show_current_user_attachments($query) {
		if (is_admin() && function_exists('get_current_screen') && (get_current_screen()->id == 'upload') && !current_user_can('administrator'))
			$query->set('author', get_current_user_id());
	}
	function show_current_user_attachments_ajax($query) {
		if (is_admin() && !current_user_can('administrator'))
			$query['author'] = get_current_user_id();

		return $query;
	}

// admin.php