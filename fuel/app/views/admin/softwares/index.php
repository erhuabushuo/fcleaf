<h2>Listing Softwares</h2>
<br>
<?php if ($softwares): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Category id</th>
			<th>File</th>
			<th>Is recommended</th>
			<th>Img</th>
			<th>Summary</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($softwares as $software): ?>		<tr>

			<td><?php echo $software->title; ?></td>
			<td><?php echo $software->category_id; ?></td>
			<td><?php echo $software->file; ?></td>
			<td><?php echo $software->is_recommended; ?></td>
			<td><?php echo $software->img; ?></td>
			<td><?php echo $software->summary; ?></td>
			<td>
				<?php echo Html::anchor('admin/softwares/view/'.$software->id, 'View'); ?> |
				<?php echo Html::anchor('admin/softwares/edit/'.$software->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/softwares/delete/'.$software->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Softwares.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/softwares/create', 'Add new Software', array('class' => 'btn btn-success')); ?>

</p>
