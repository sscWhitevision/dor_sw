(function($R)
{
    $R.add('plugin', 'divider', {
        init: function(app)
        {
            this.toolbar = app.toolbar;
            this.opts = app.opts;
        },
        start: function() {
            var prev = false,
                idx = 1,
                toolbar = this.toolbar,
                origButtons = this.opts.buttons;

            // First, make each button name unique
            this.opts.buttons.forEach(function(btn, i) {
                if (prev && btn === 'divider') {
                    origButtons.splice(i, 1, 'divider' + idx);
                    idx++;
                }
                prev = btn;
            });
            this.opts.buttons = origButtons;

            // Then, use the improved addButton API in the toolbar to insert the actual button in its rightful place
            // Previously this was part of the above forEach however with addButton interacting with opts.buttons
            // while we're changing it, that becomes a little unpredictable. Splitting up makes it work reliably.
            this.opts.buttons.forEach(function(btn, i) {
                if (btn.substring(0, 'divider'.length) === 'divider') {
                    var $button = toolbar.addButton(btn, {
                        'title': '|'
                    });
                    $button.disable();
                }
            });
        }
    });
})(Redactor);
