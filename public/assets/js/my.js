jQuery(function($) {
	
	var $upload_info = $('#upload_info');
	$upload_info.popover();
	
	new AjaxUpload('upload_button', {
		action: 'upload',
		name: 'userfile',
		autoSubmit: true,
		responseType: 'json',
		onChange: function(file, extension) {},
		onSubmit: function(file, extension) {},
		onComplete: function(file, response) {
			$('#form_img').val(response.filename);
			$upload_info.text(response.filename).attr('data-content', "<img src='" + response.urlpath +"' />");
		}
	});
	
	
});