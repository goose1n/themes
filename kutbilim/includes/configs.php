<?php
	defined('ABSPATH') or exit('No direct script access allowed');

	/**
	 * Настройки
	 */

	use Carbon_Fields\Container;
	use Carbon_Fields\Field;

	// Регистрация настроек
	add_action('carbon_fields_register_fields', 'create_options_page');
	function create_options_page() {
		Container::make('theme_options', 'template', __('Шаблон'))
			->set_page_parent('options-general.php')
			->add_tab(__('Основные'), [

			])
			->add_tab(__('Реклама'), [
				Field::make('complex', 'banner_before_main_news', __('Перед главными новостями'))
					->set_layout('tabbed-horizontal')
					->add_fields([
						Field::make('text', 'title', __('Название'))->set_required(true),
						Field::make('image', 'image', __('Изображение'))->set_help_text('1200x450')->set_required(true),
						Field::make('text', 'link', __('Ссылка'))
					])
					->set_header_template('<%-title%>'),
				Field::make('complex', 'banner_after_main_news', __('После главных новостей'))
					->set_layout('tabbed-horizontal')
					->add_fields([
						Field::make('text', 'title', __('Название'))->set_required(true),
						Field::make('image', 'image', __('Изображение'))->set_help_text('1200x450')->set_required(true),
						Field::make('text', 'link', __('Ссылка'))
					])
					->set_header_template('<%-title%>')
			])
			->add_tab(__('Контакты'), [
				Field::make('text', 'contacts_coords', __('Координаты'))->set_help_text('https://www.mapcoordinates.net/'),
				Field::make('separator', 'social', __('Социальные сети')),
				Field::make('text', 'social_facebook', __('Facebook'))->set_width(50),
				Field::make('text', 'social_vk', __('ВКонтакте'))->set_width(50),
				Field::make('text', 'social_twitter', __('Twitter'))->set_width(50),
				Field::make('text', 'social_youtube', __('YouTube'))->set_width(50),
				Field::make('text', 'social_instagram', __('Instagram'))->set_width(50)
			])
			->add_tab(__('Другое'), [
				Field::make('footer_scripts', 'footer_scripts', __('Вставки'))
			]);
	}

// configs.php