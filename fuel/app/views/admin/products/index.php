<h2>产品列表</h2>
<br>
	<?php echo Html::anchor('admin/products/create', '添加', array('class' => 'btn btn-success')); ?>
<?php if ($products): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>标题</th>
			<th>分类</th>
			<th>价格</th>
			<th>推荐</th>
			<th>访问次数</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($products as $product): ?>		<tr>

			<td><?php echo $product->title; ?></td>
			<td><?php echo $product->category->title; ?></td>
			<td><?php echo $product->price; ?></td>
			<td>
                            <?php if ($product->is_recommended): ?>
                            <i class="icon-ok"></i>
                            <?php else: ?>
                            <i class="icon-remove"></i>
                            <?php endif; ?>
                        </td>
			<td><?php echo $product->click_num; ?></td>
			<td>
				<?php echo Html::anchor('admin/products/view/'.$product->id, '查看'); ?> |
				<?php echo Html::anchor('admin/products/edit/'.$product->id, '编辑'); ?> |
				<?php echo Html::anchor('admin/products/delete/'.$product->id, '删除', array('onclick' => "return confirm('你确定?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>
Dashboard
<?php else: ?>
<p>没有产品.</p>

<?php endif; ?><p>


</p>
