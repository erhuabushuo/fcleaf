<h2>文章列表</h2>
<br>
<?php echo Html::anchor('admin/articles/create', '添加', array('class' => 'btn btn-success')); ?>
<?php if ($articles): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>标题</th>
			<th>分类</th>
			<th>访问次数</th>
			<th>是否推荐</th>
			<th>添加时间</th>
			<th>更新时间</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($articles as $article): ?>		<tr>

			<td><?php echo $article->title; ?></td>
			<td><?php echo $article->category->title; ?></td>
			<td><?php echo $article->clicked_num; ?></td>
			<td>
                            <?php if ($article->is_recommended): ?>
                            <i class="icon-ok"></i>
                            <?php else: ?>
                            <i class="icon-remove"></i>
                            <?php endif; ?>
                        </td>
           <td><?php echo date("Y-m-d H:i:s", $article->created_at); ?></td>
           <td><?php echo date("Y-m-d H:i:s", $article->updated_at); ?></td>
			<td>
				<?php echo Html::anchor('admin/articles/view/'.$article->id, '查看'); ?> |
				<?php echo Html::anchor('admin/articles/edit/'.$article->id, '编辑'); ?> |
				<?php echo Html::anchor('admin/articles/delete/'.$article->id, '删除', array('onclick' => "return confirm('你确定要这么做？')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>
<?php echo $pagination; ?>
<?php else: ?>
<p>没有文章.</p>

<?php endif; ?><p>
	

</p>
