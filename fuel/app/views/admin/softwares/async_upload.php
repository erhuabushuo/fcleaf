<script type="text/javascript">
    $(function() {
        var $form_file = $('#form_file');

        $form_file.makeAsyncUploader({
            upload_url: '<?php echo Uri::create('admin/softwares/async_upload'); ?>', 
            flash_url: '<?php echo Asset::get_file('swfupload.swf', 'img'); ?>',
            button_image_url: '<?php echo Asset::get_file('blankButton.png', 'img'); ?>',
            file_size_limit: '1024 MB',
            post_params: {"PHPSESSID": "<?php echo Session::key('session_id'); ?>"},
            upload_success_handler: function(file, response) {
                alert(response.filename);
                /*
                $("input[name$=_filename]", container).val(file.name);
                $("input[name$=_guid]", container).val(response);
                $("#analysis").html('<a target="_blank" href="uploads/analysis_file/12/' + response +'">Show and modify</a>');
                $("span[id$=_completedMessage]", container).html("Uploaded <b>{0}</b> ({1} KB)"
                    .replace("{0}", file.name)
                    .replace("{1}", Math.round(file.size / 1024))
                );
                */
            }
        });
    
    });
</script>