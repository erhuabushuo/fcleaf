<?php echo Form::open(array(), array('img' => isset($software) ? $software->img : '', 'file' => isset($software) ? $software->file: '' )); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('软件标题', 'title'); ?>

			<div class="input">
				<?php echo Form::input('title', Input::post('title', isset($software) ? $software->title : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('软件分类', 'category_id'); ?>

			<div class="input">
				<select id="form_category_id" name="category_id">
					<?php foreach($categories as $item): ?>
					<option value="<?php echo $item["id"]; ?>" <?php if (isset($software) and $software->category_id == $item["id"]) echo 'selected="selected"'; ?>><?php echo str_repeat('&nbsp;&nbsp;&nbsp;', substr_count($item['structs'], '-')); ?><?php echo $item['title']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('软件地址', 'file'); ?>

			<div class="input">
				<?php echo Form::input('file', Input::post('file', isset($software) ? $software->file : ''), array('class' => 'span4', 'id' => 'async_upload')); ?>
                        </div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('是否推荐', 'is_recommended'); ?>

			<div class="input">
				<?php echo Form::checkbox('is_recommended', 1, Input::post('is_recommended', isset($software) ? $software->is_recommended : 0)) ?>
			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('软件图片', 'img'); ?>

			<div class="input">
				<button class="btn" id="upload_button">Upload</button>
				&nbsp;
				<span id="upload_info" data-original-title="查看" rel="popover" data-content="<img src='<?php echo (isset($software) and !empty($software->img)) ? Uri::base() . DS . 'upload' . DS .  'softwares' . DS . $software->img : ''; ?>' />" class="label label-info">
					<?php echo isset($software) ? $software->img : 'None'; ?>
				</span>
			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('软件描述', 'summary'); ?>

			<div class="input">
				<?php echo ckeditor('summary', Input::post('summary', isset($software) ? $software->summary : ''), array('class' => 'span8', 'rows' => 8)); ?>
			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>

<script type="text/javascript">
    window.upload_url = '<?php echo Uri::create('admin/softwares/upload'); ?>';
</script>