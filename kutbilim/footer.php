<?php defined('ABSPATH') or exit('No direct script access allowed'); ?>
<?php global $globalSocial, $globalCategories, $globalMedia, $newsCategories; ?>
		</main>
		<aside id="sidebar" data-uk-offcanvas="overlay: true;">
			<div class="uk-offcanvas-bar uk-flex uk-flex-column uk-flex-between">
				<div>
					<button class="uk-offcanvas-close" data-uk-close></button>
					<ul class="uk-nav uk-nav-default">
						<li class="uk-nav-header"><?=pll__('Меню')?></li>
						<li><a href="<?=home_url()?>"><?=pll__('Главная')?></a></li>
						<li><a href="<?=get_post_type_archive_link('analytics')?>"><?=pll__('Аналитика')?></a></li>
						<li>
							<a href="<?=get_post_type_archive_link('news')?>"><?=pll__('Новости')?></a>
							<ul class="uk-nav-sub"><?=$globalCategories?></ul>
						</li>
						<li><a href="<?=get_post_type_archive_link('methodical')?>"><?=pll__('Методические работы')?></a></li>
						<li>
							<a href="#"><?=pll__('Медиа')?></a>
							<ul class="uk-nav-sub"><?=$globalMedia?></ul>
						</li>
						<li><a href="<?=get_permalink(pll_get_post(13))?>"><?=pll__('О нас')?></a></li>
						<li><a href="<?=get_permalink(pll_get_post(15))?>"><?=pll__('Контакты')?></a></li>
					</ul>
				</div>
				<?php if ($globalSocial): ?>
					<ul class="social common_list uk-flex uk-flex-center">
						<?=$globalSocial?>
					</ul>
				<?php endif; ?>
			</div>
		</aside>
		<footer class="footer">
			<div class="uk-container">
				<div class="uk-section-medium uk-flex">
					<div class="uk-width-1-1 uk-width-auto@m">
						<div class="about">
							<div class="logo" hidden>
								<span></span>
							</div>
							<div class="description">
								<?=get_option('blogdescription')?>
							</div>
							<ul class="social common_list uk-flex uk-flex-center">
								<?=$globalSocial?>
							</ul>
						</div>
					</div>
					<div class="menu uk-flex-1 uk-visible@m">
						<ul class="common_list uk-grid-collapse uk-child-width-1-3 uk-child-width-1-4@l" data-uk-grid>
							<?php foreach ($newsCategories as $single): ?>
								<li><a href="<?=get_term_link($single->term_id)?>"><?=$single->name?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<div class="copyright">
					© <?=date('Y')?> – <?=get_option('blogname')?>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
		<script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
	</body>
</html>