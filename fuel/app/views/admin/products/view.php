<h2>Viewing #<?php echo $product->id; ?></h2>

<p>
	<strong>Title:</strong>
	<?php echo $product->title; ?></p>
<p>
	<strong>Category id:</strong>
	<?php echo $product->category_id; ?></p>
<p>
	<strong>Price:</strong>
	<?php echo $product->price; ?></p>
<p>
	<strong>Is recommend:</strong>
	<?php echo $product->is_recommend; ?></p>
<p>
	<strong>Click num:</strong>
	<?php echo $product->click_num; ?></p>
<p>
	<strong>Img:</strong>
	<?php echo $product->img; ?></p>
<p>
	<strong>Summary:</strong>
	<?php echo $product->summary; ?></p>

<?php echo Html::anchor('admin/products/edit/'.$product->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/products', 'Back'); ?>