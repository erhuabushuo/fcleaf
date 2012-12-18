<h2>编辑产品</h2>
<br>

<?php echo render('admin/products/_form'); ?>
<p>
	<?php echo Html::anchor('admin/products/view/'.$product->id, 'View'); ?> |
	<?php echo Html::anchor('admin/products', 'Back'); ?></p>
