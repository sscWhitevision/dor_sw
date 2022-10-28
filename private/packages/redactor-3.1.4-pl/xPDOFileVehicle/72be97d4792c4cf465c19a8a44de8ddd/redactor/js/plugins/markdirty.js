(function($R)
{
    $R.add('plugin', 'markdirty', {
        init: function(app)
        {
            app.callback.add('syncing', this.doSync.bind(this));
        },

        start: function() {

        },

        doSync: function(html) {
            if (window.MODx && MODx.fireResourceFormChange) {
                MODx.fireResourceFormChange();
            }
        }
    });
})(Redactor);
