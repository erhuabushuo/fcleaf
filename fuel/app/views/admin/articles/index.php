<h2>Listing Articles</h2>
<br>
<?php if ($articles): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Summary</th>
			<th>Clicked num</th>
			<th>Is recommmended</th>
			<th>Img</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($articles as $article): ?>		<tr>

			<td><?php echo $article->title; ?></td>
			<td><?php echo $article->summary; ?></td>
			<td><?php echo $article->clicked_num; ?></td>
			<td><?php echo $article->is_recommmended; ?></td>
			<td><?php echo $article->img; ?></td>
			<td>
				<?php echo Html::anchor('admin/articles/view/'.$article->id, 'View'); ?> |
				<?php echo Html::anchor('admin/articles/edit/'.$article->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/articles/delete/'.$article->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Articles.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/articles/create', 'Add new Article', array('class' => 'btn btn-success')); ?>

</p>
