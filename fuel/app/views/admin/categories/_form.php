<?php echo Form::open(); ?>
<fieldset>
	<div class="clearfix">
		<?php echo Form::label('分类名称', 'title'); ?>

		<div class="input">
			<?php echo Form::input('title', Input::post('title', isset($category) ? $category->title : ''), array('class' => 'span4')); ?>
		</div>
	</div>
	<div class="clearfix">
		<?php echo Form::label('分类类型', 'type'); ?>

		<div class="input">
			<?php echo Form::select('type', Input::post('type', isset($category) ? $category->type : ''), $types,array('class' => 'span4')); ?>
		</div>
	</div>
	
	<div class="clearfix">
		<?php echo Form::label('上级分类', 'type'); ?>

		<div class="input">
			<select id="form_pid" name="pid">
				<option>一级分类</option>
				<?php foreach($categories as $item): ?>
				<option value="<?php echo $item["id"]; ?>" <?php if (isset($category) and $category->pid == $item["id"]) echo 'selected="selected"'; ?>><?php echo str_repeat('&nbsp;&nbsp;&nbsp;', substr_count($item['structs'], '-')); ?><?php echo $item['title']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	
	<div class="clearfix">
		<?php echo Form::label('分类排序', 'title'); ?>

		<div class="input">
			<?php echo Form::input('order', Input::post('order', isset($category) ? $category->order : ''), array('class' => 'span1')); ?>
		</div>
	</div>
	<div class="actions">
		<?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>
	</div>
</fieldset>
<?php echo Form::close(); ?>