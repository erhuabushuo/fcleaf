<h2>Listing Products</h2>
<br>
<?php if ($products): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Category id</th>
			<th>Price</th>
			<th>Is recommend</th>
			<th>Click num</th>
			<th>Img</th>
			<th>Summary</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($products as $product): ?>		<tr>

			<td><?php echo $product->title; ?></td>
			<td><?php echo $product->category_id; ?></td>
			<td><?php echo $product->price; ?></td>
			<td><?php echo $product->is_recommended; ?></td>
			<td><?php echo $product->click_num; ?></td>
			<td><?php echo $product->img; ?></td>
			<td><?php echo $product->summary; ?></td>
			<td>
				<?php echo Html::anchor('admin/products/view/'.$product->id, 'View'); ?> |
				<?php echo Html::anchor('admin/products/edit/'.$product->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/products/delete/'.$product->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Products.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/products/create', 'Add new Product', array('class' => 'btn btn-success')); ?>

</p>
