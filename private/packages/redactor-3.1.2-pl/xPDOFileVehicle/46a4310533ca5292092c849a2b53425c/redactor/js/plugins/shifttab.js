(function($R)
{
    /**
     * shifttab plugin adds proper tab/shift-tab support to lists.
     *
     */
    $R.add('plugin', 'shifttab', {
        // construct
        init: function(app)
        {
            // define app
            this.app = app;
            this.selection = app.selection;
            this.inspector = app.inspector;

            this.app.callback.add('tab', this.handleTabEvent.bind(this));
        },

        handleTabEvent: function(e) {
            // Only trigger when we have a shift-tab
            if (!e.shiftKey) {
                return true;
            }

            var current = this.selection.getCurrent();
            var data = this.inspector.parse(current);

            if (data.isList()) {
                this.app.api('module.list.outdent');
                return false; // indicates to the broadcaster to halt
            }

            return true;
        }
    });
})(Redactor);
