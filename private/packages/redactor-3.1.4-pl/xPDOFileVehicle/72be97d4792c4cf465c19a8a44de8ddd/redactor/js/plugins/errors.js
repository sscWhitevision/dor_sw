(function($R)
{
    $R.add('plugin', 'errors', {
        onfile: {
            uploadError: function(response) {
                if (window.MODx && window.MODx.msg) {
                    MODx.msg.alert(_('error'), response.message);
                }
                else {
                    alert(response.message);
                }
            }
        },
        onimage: {
            uploadError: function(response) {
                if (window.MODx && window.MODx.msg) {
                    MODx.msg.alert(_('error'), response.message);
                }
                else {
                    alert(response.message);
                }
            }
        },
        onupload: {
            error: function (response) {
                if (window.MODx && window.MODx.msg) {
                    MODx.msg.alert(_('error'), response.message);
                } else {
                    alert(response.message);
                }
            }
        }
    });
})(Redactor);
