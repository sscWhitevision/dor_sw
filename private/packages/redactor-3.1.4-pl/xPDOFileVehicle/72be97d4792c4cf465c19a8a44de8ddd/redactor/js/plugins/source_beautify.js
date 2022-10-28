(function($R)
{
    $R.add('plugin', 'source_beautify', {
        init: function(app)
        {
            this.app = app;
            this.app.callback.add('syncBefore', this.callbackOnBeforeSync.bind(this));
        },

        onsource: {
            open: function(html) {
                return this._beautify(html);
            }
        },

        callbackOnBeforeSync: function(html) {
            // Basic throttling - once every couple of seconds is fine
            if (this._throttle) {
                return html;
            }
            this._throttle = true;
            setTimeout(function() {
                this._throttle = false;
            }.bind(this), 3000);

            // Be-a-u-tify it!
            return this._beautify(html);
        },

        _beautify: function(html) {
            return html_beautify(html);
        }
    });
})(Redactor);
