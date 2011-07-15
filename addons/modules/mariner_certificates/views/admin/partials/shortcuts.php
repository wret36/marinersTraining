<nav id="shortcuts">
	<h6><?php echo lang('cp_shortcuts_title'); ?></h6>
	<?php $colorbox = ''; if(!empty($galleries)) $colorbox = 'upload_colorbox'; ?>
	<ul>
		<li><?php echo anchor('admin/mariner_certificates/add', 'Add') ?></li>
		<li><?php echo anchor('admin/mariner_certificates/browse', 'Browse') ?></li>
		<li><?php echo anchor('admin/mariner_certificates/upload', 'Upload') ?></li>
	</ul>
	<br class="clear-both" />
</nav>
