<?php echo Form::open(array('enctype' => 'multipart/form-data'), array('img' => isset($article) ? $article->img : '')); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('文章标题', 'title'); ?>

			<div class="input">
				<?php echo Form::input('title', Input::post('title', isset($article) ? $article->title : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('文章分类', 'type'); ?>
	
			<div class="input">
				<select id="form_category_id" name="category_id">
					<?php foreach($categories as $item): ?>
					<option value="<?php echo $item["id"]; ?>" <?php if (isset($article) and $article->category_id == $item["id"]) echo 'selected="selected"'; ?>><?php echo str_repeat('&nbsp;&nbsp;&nbsp;', substr_count($item['structs'], '-')); ?><?php echo $item['title']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('文章图片', 'img'); ?>

			<div class="input">
				<button class="btn" id="upload_button">Upload</button>
				&nbsp;
				<span id="upload_info" data-original-title="查看" rel="popover" data-content="<img src='<?php echo (isset($article) and !empty($article->img)) ? Uri::base() . DS . 'upload' . DS .  'articles' . DS . $article->img : ''; ?>' />" class="label label-info">
					<?php echo isset($article) ? $article->img : 'None'; ?>
				</span>
			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('是否推荐', 'is_recommended'); ?>

			<div class="input">
				<?php echo Form::checkbox('is_recommended', 1, Input::post('is_recommended', isset($article) ? $article->is_recommended : 0)) ?>
			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('文章内容', 'summary'); ?>

			<div class="input">
				<?php echo ckeditor('summary', Input::post('summary', isset($article) ? $article->summary : ''), array('class' => 'span8', 'rows' => 8)); ?>
			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>