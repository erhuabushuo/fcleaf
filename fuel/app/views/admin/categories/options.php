<?php foreach($categories as $item): ?>
	<option value="<?php echo $item["id"]; ?>"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;', substr_count($item['structs'], '-')); ?><?php echo $item['title']; ?></option>
<?php endforeach; ?>