<input type="file" name="file_upload" id="file_upload" />
<link rel="stylesheet" type="text/css" href="<?php echo Uri::base() ?>uploadify/uploadify.css" />
<script type="text/javascript" src="<?php echo Uri::base() ?>uploadify/jquery.uploadify-3.1.min.js"></script>
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
    $('#file_upload').uploadify({
        'swf'      : '<?php echo Uri::base() ?>uploadify/uploadify.swf',
        'uploader' : '<?php echo Uri::create('admin/softwares/test') ?>',
        //'multi'          : false,
        //'auto'           : true,
        'fileTypeExts'   : '*.jpg;*.gif;*.png',
        'fileTypeDesc'   : 'Image Files (.JPG, .GIF, .PNG)',
        //'queueID'        : 'custom-queue',
        //'queueSizeLimit' : 3,
        //'removeCompleted': false,
        'formData'       : {'fuelcid': getCookie('fuelcid')},
        'onSelect'       : function(file)
        {
            alert('The file ' + file.name + ' was added to the queue.');
        },
        'onQueueComplete' : function(queueData)
        {
            alert(queueData.uploadsSuccessful + ' files were successfully uploaded.');
        }
        // Put your options here
    });
});
</script>