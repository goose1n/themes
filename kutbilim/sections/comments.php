<?php defined('ABSPATH') or exit('No direct script access allowed'); ?>
<?php
	// Выборка комментариев
	$comments = get_comments([
		'post_id' => get_the_ID(),
		'status' => 'approve'
	]);
?>
<div id="comments" class="comments common_wrapper uk-margin-small-top">
	<div class="content" data-uk-margin>
		<h2 class="uk-heading-bullet"><?=pll__('Комментарии')?></h2>
		<div class="list">
			<?php foreach ($comments as $single): ?>
				<div class="inner">
					<div class="common_text">
						<strong><?=$single->comment_author?></strong>
						<small class="uk-margin-xsmall-left uk-text-muted">/ <?=(new DateTime($single->comment_date))->format(get_option('links_updated_date_format'))?></small>
					</div>
					<div class="common_text">
						<?=$single->comment_content?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>