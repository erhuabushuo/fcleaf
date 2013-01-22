<?php echo Form::open(array(), array('img' => isset($product) ? $product->img : '')); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('产品名称', 'title'); ?>

			<div class="input">
				<?php echo Form::input('title', Input::post('title', isset($product) ? $product->title : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('产品分类', 'type'); ?>
	
			<div class="input">
				<select id="form_category_id" name="category_id">
					<?php foreach($categories as $item): ?>
					<option value="<?php echo $item["id"]; ?>" <?php if (isset($product) and $product->category_id == $item["id"]) echo 'selected="selected"'; ?>><?php echo str_repeat('&nbsp;&nbsp;&nbsp;', substr_count($item['structs'], '-')); ?><?php echo $item['title']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('价格', 'price'); ?>

			<div class="input">
				<?php echo Form::input('price', Input::post('price', isset($product) ? $product->price : ''), array('class' => 'span1')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('是否推荐', 'is_recommended'); ?>

			<div class="input">
				<?php echo Form::checkbox('is_recommended', 1, Input::post('is_recommended', isset($product) ? $product->is_recommended : 0)) ?>
			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('产品图片', 'img'); ?>

			<div class="input">
				<button class="btn" id="upload_button">Upload</button>
				&nbsp;
				<span id="upload_info" data-original-title="查看" rel="popover" data-content="<img src='<?php echo (isset($product) and !empty($product->img)) ? Uri::base() . DS . 'upload' . DS .  'products' . DS . $product->img : ''; ?>' />" class="label label-info">
					<?php echo isset($product) ? $product->img : 'None'; ?>
				</span>
			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('产品描述', 'summary'); ?>

			<div class="input">
				<?php echo ckeditor('summary', Input::post('summary', isset($product) ? $product->summary : ''), array('class' => 'span8', 'rows' => 8)); ?>
			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', '保存', array('class' => 'btn btn-primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>

<script type="text/javascript">
    window.upload_url = '<?php echo Uri::create('admin/products/upload'); ?>';
</script>