<h2>编辑软件</h2>
<br>

<?php echo render('admin/softwares/_form'); ?>
<p>
	<?php echo Html::anchor('admin/softwares/view/'.$software->id, 'View'); ?> |
	<?php echo Html::anchor('admin/softwares', '返回'); ?></p>
