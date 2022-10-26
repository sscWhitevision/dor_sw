(function($R)
{
    /**
     * Simple theme plugin that sets a theme name, provided as `theme` property in initialisation, and sets
     * a class name of redactor-theme-THEMENAME on the container element to allow it to be targeted by CSS.
     */
    $R.add('plugin', 'theme', {
        translations: {
            en: {
                'toggle-dark-mode': 'Toggle dark mode'
            }
        },
        // construct
        init: function(app)
        {
            this.app = app;
            this.lang = app.lang;
            this.toolbar = app.toolbar;
            this.container = app.container;
        },
        // public
        start: function()
        {
            if (this.app.opts.theme !== '') {
                this.container.getElement().addClass('redactor-theme-' + this.app.opts.theme);
            }
            if (this.app.opts.structure && this.app.opts.structureTheme !== '') {
                this.container.getElement().addClass('redactor-structure__' + this.app.opts.structureTheme);
            }

            var pos = this.toolbar.buttons.indexOf('toggledark'),
                prev = null;
            if (pos >= 1) {
                prev = this.toolbar.buttons[pos - 1];
            }
            if (prev) {
                this.$button = this.toolbar.addButtonAfter(prev, 'download', {
                    title: this.lang.get('toggle-dark-mode'),
                    api: 'plugin.theme.toggle_dark'
                });
                this.$button.setIcon('<i class="icon icon-toggle-on"></i>');
            }
        },

        toggle_dark: function() {
            var el = this.container.getElement();
            el.toggleClass('redactor-theme__dark');
            if (el.hasClass('redactor-theme__dark')) {
                this.$button.setIcon('<i class="icon icon-toggle-off"></i>');
            }
            else {
                this.$button.setIcon('<i class="icon icon-toggle-on"></i>');
            }
        }
    });
})(Redactor);
