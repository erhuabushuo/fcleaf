<h2>Viewing #<?php echo $software->id; ?></h2>

<p>
	<strong>Title:</strong>
	<?php echo $software->title; ?></p>
<p>
	<strong>Category id:</strong>
	<?php echo $software->category_id; ?></p>
<p>
	<strong>File:</strong>
	<?php echo $software->file; ?></p>
<p>
	<strong>Is recommended:</strong>
	<?php echo $software->is_recommended; ?></p>
<p>
	<strong>Img:</strong>
	<?php echo $software->img; ?></p>
<p>
	<strong>Summary:</strong>
	<?php echo $software->summary; ?></p>

<?php echo Html::anchor('admin/softwares/edit/'.$software->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/softwares', 'Back'); ?>