<h2>Viewing #<?php echo $article->id; ?></h2>

<p>
	<strong>Title:</strong>
	<?php echo $article->title; ?></p>
<p>
	<strong>Summary:</strong>
	<?php echo $article->summary; ?></p>
<p>
	<strong>Clicked num:</strong>
	<?php echo $article->clicked_num; ?></p>
<p>
	<strong>Is recommmended:</strong>
	<?php echo $article->is_recommmended; ?></p>
<p>
	<strong>Img:</strong>
	<?php echo $article->img; ?></p>

<?php echo Html::anchor('admin/articles/edit/'.$article->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/articles', 'Back'); ?>