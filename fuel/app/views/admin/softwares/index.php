<h2>软件列表</h2>
<br>
<?php if ($softwares): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>标题</th>
			<th>分类</th>
			<th>是否推荐</th>
			<th>访问次数</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($softwares as $software): ?>		
            <tr>
                <td><?php echo $software->title; ?></td>
                <td><?php echo $software->category->title; ?></td>
                <td>
                    <?php if ($software->is_recommended): ?>
                    <i class="icon-ok"></i>
                    <?php else: ?>
                    <i class="icon-remove"></i>
                    <?php endif; ?>
                </td>
                <td><?php echo $software->click_num; ?></td>
                <td>
                        <?php echo Html::anchor('admin/softwares/view/'.$software->id, '查看'); ?> |
                        <?php echo Html::anchor('admin/softwares/edit/'.$software->id, '修改'); ?> |
                        <?php echo Html::anchor('admin/softwares/delete/'.$software->id, '删除', array('onclick' => "return confirm('你确定？')")); ?>

                </td>
        </tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>没有软件.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/softwares/create', '添加软件', array('class' => 'btn btn-success')); ?>

</p>
