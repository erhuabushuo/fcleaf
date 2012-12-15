<h2>分类列表</h2>
<br>
<?php echo Html::anchor('admin/categories/create', '添加', array('class' => 'btn btn-success')); ?>
<?php if ($categories): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>标题</th>
			<th>类别</th>
			<th>添加时间</th>
			<th>更新时间</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($categories as $category): ?>		<tr>

			<td><?php echo str_repeat('&nbsp;&nbsp;&nbsp;', substr_count($category['structs'], '-')); ?><?php echo $category['title']; ?></td>
			<td><?php echo $types[$category['type']]; ?></td>
           <td><?php echo date("Y-m-d H:i:s", $category['created_at']); ?></td>
           <td><?php echo date("Y-m-d H:i:s", $category['updated_at']); ?></td>
			<td>
				<?php echo Html::anchor('admin/categories/view/'.$category['id'], '查看'); ?> |
				<?php echo Html::anchor('admin/categories/edit/'.$category['id'], '编辑'); ?> |
				<?php echo Html::anchor('admin/categories/delete/'.$category['id'], '删除', array('onclick' => "return confirm('你确定要这么做？')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	
	</tbody>
	</table>

<?php else: ?>
<p>没有分类.</p>

<?php endif; ?>
<p>
</p>
