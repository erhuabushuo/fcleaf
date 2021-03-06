<script type="text/javascript">
function getCookie(c_name)
{
    if (document.cookie.length > 0)
    {
        c_start = document.cookie.indexOf(c_name + "=");

        if (c_start != -1)
        {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) c_end = document.cookie.length;
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }

    return "";
}    
$(function() {
    var $async_upload = $('#async_upload');
    var $form_file = $('#form_file');
    $async_upload.uploadify({
        'buttonText' : '选择...',
        'swf'      : '<?php echo Asset::get_file('uploadify.swf', 'swf') ?>',
        'uploader' : '<?php echo Uri::create('admin/softwares/async_upload') ?>',
        //'multi'          : false,
        //'auto'           : true,
        //'fileTypeExts'   : '*.jpg;*.gif;*.png',
        //'fileTypeDesc'   : 'Image Files (.JPG, .GIF, .PNG)',
        //'queueID'        : 'custom-queue',
        //'queueSizeLimit' : 3,
        //'removeCompleted': false,
        'formData'       : {'fuelcid': getCookie('fuelcid')},
        /*
        'onSelect'       : function(file)
        {
            alert('The file ' + file.name + ' was added to the queue.');
        },
        'onQueueComplete' : function(queueData)
        {
            alert(queueData.uploadsSuccessful + ' files were successfully uploaded.');
        }
        */
       'onUploadSuccess' : function(file, data, response)
       {
           var jsonObj = $.parseJSON(data);
           $form_file.val(jsonObj.filename);
       }
        // Put your options here
    });
});
</script>