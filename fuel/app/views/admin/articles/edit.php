<h2>编辑文章</h2>
<br>

<?php echo render('admin/articles/_form'); ?>
<p>
	<?php echo Html::anchor('admin/articles/view/'.$article->id, '查看'); ?> |
	<?php echo Html::anchor('admin/articles', '返回'); ?></p>
