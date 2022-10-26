(function($R)
{
    $R.add('plugin', 'download', {
        init: function(app)
        {
            this.toolbar = app.toolbar;
            this.source = app.source;
            this.lang = app.lang;
        },

        start: function() {
            var pos = this.toolbar.buttons.indexOf('download'),
                prev = null;
            if (pos >= 1) {
                prev = this.toolbar.buttons[pos - 1];
            }
            var $button = this.toolbar.addButtonAfter(prev, 'download', {
                title: this.lang.get('download'),
                api: 'plugin.download.download'
            });
            $button.setIcon('<i class="icon icon-download"></i>');
        },

        download: function() {
            var el = document.createElement('a');
            el.setAttribute('target', '_blank');
            el.setAttribute('download', 'content.html');
            el.setAttribute('href', 'data:text/html,' + encodeURI(this.source.getCode()));
            el.click();
        }
    });
})(Redactor);
