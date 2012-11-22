<h2>Editing Article</h2>
<br>

<?php echo render('admin/articles/_form'); ?>
<p>
	<?php echo Html::anchor('admin/articles/view/'.$article->id, 'View'); ?> |
	<?php echo Html::anchor('admin/articles', 'Back'); ?></p>
