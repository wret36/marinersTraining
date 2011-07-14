<div class="latest_news">
	<?php foreach($blog_widget as $post_widget): ?>
		<?php $link = 'blog/'.date('Y/m', $post_widget->created_on) .'/'.$post_widget->slug; ?>
		<div class="news-container">
			<span class="content-heading">
				<?php echo anchor($link, $post_widget->title); ?>
			</span>
			<p class="news-content">
				<?php 
				$displayText = $post_widget->body;
				if ($post_widget->intro) {
					$displayText = $post_widget->intro;
				}
				echo substr($displayText, 0, 130) . '...';?>
				<span class="read-on"><?php echo anchor($link,'Read More'); ?></span>
			</p>
		</div>
	<?php endforeach; ?>
</div>