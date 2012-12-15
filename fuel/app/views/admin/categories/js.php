<script>
$(function(){
	var $form_type = $('#form_type');	
	var $form_pid  = $('#form_pid');
	$form_type.change(function() {
		var val = $(this).val();
		$.ajax({
			'url':'<?php echo Uri::create('admin/categories/get_all'); ?>/' + val,
			'type':'GET',
			'dataType':'html',
			'success':function(data) {
				$form_pid.find('option:gt(0)').remove();
				$form_pid.append(data);
			}
		});
	});
});
</script>