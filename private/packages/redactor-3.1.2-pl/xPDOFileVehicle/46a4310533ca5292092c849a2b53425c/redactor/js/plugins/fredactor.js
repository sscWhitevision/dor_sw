(function($R)
{
    $R.add('plugin', 'fredactor', {
        init: function(app)
        {
            this.app = app;
            this.element = app.element;
            this.toolbar = app.toolbar;
            this.source = app.source;
            this.lang = app.lang;
            this.app.callback.add('syncing', this.doSync.bind(this));
        },

        start: function() {
            var $element = this.element.getElement(),
                id = $element.attr('id');

            if (window.FredactorInstances[id]) {
                this.fredactor = window.FredactorInstances[id];
            }
        },

        doSync: function(html) {
            this.fredactor.onChange(html);
        }
    });
})(Redactor);
