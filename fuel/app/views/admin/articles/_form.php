<?php use Fuel\Core\Uri;

echo Form::open(array('enctype' => 'multipart/form-data'), array('img' => isset($article) ? $article->img : '')); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('文章标题', 'title'); ?>

			<div class="input">
				<?php echo Form::input('title', Input::post('title', isset($article) ? $article->title : ''), array('class' => 'span4')); ?>

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
			<?php echo Form::label('是否推荐', 'is_recommmended'); ?>

			<div class="input">
				<?php echo Form::checkbox('is_recommmended', Input::post('is_recommmended', isset($article) ? $article->is_recommmended : 0)) ?>
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