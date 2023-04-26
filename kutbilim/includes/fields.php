<?php
	defined('ABSPATH') or exit('No direct script access allowed');

	/**
	 * Произвольные поля
	 */

	use Carbon_Fields\Container;
	use Carbon_Fields\Field;

	// Регистрация полей
	add_action('carbon_fields_register_fields', 'register_custom_fields');
	function register_custom_fields() {
		// Новости
		Container::make('post_meta', __('Другое'))
			->where('post_type', 'IN', ['news', 'analytics'])
			->add_fields([
				Field::make('media_gallery', 'gallery', __('Галерея'))->set_type('image')
			]);
	}

// fields.php