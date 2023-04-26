// Параметры
const ANIMATION_SPEED = 100;

// Меню

$(function() {
	// Инициализация плагина
	$('#menu').superfish({
		speed: 'fast',
		cssArrows: false
	});
});

// Галерея

$(function() {
	let gallery = $('#gallery');

	if (gallery.length) {
		// Инициализация галереи
		gallery.sliderPro({
			width: '100%',
			aspectRatio: 1.77777,
			imageScaleMode: 'contain',
			loop: false,
			slideDistance: 15,
			fade: true,
			autoplay: false,
			buttons: false,
			keyboard: false,
			thumbnailWidth: 75,
			thumbnailHeight: 50,
		});
	}
});

// Сокращения

$(function() {
	let shave = $('[data-shave]');

	if (shave.length) {
		// Инициализация плагина
		shave.each(function() {
			shave.shave($(this).data('shave'));
		});
	}
});

// Контакты

$(function() {
	let contacts = $('#contacts');

	if (contacts.length) {
		let map = contacts.find('.map'),
			coords = map.data('coords').split(',');

		ymaps.ready(init);
		function init() {
			// Инициализация карты
			map = new ymaps.Map(map[0], {
				controls: ['fullscreenControl', 'zoomControl'],
				center: coords,
				zoom: 17
			}, {
				suppressMapOpenBlock: true
			});
			// Настройка карты
			map.behaviors.disable(['drag', 'scrollZoom']);
			map.container.events.add('fullscreenenter', function() {
				map.behaviors.enable(['drag', 'scrollZoom']);
			});
			map.container.events.add('fullscreenexit', function() {
				map.behaviors.disable(['drag', 'scrollZoom']);
			});
			// Добавление маркера
			map.geoObjects.add(new ymaps.Placemark(coords));
		}
	}
});