(function($R)
{
    $R.add('plugin', 'fixed_toolbar', {
        init: function(app)
        {
            this.app = app;
            this.toolbar = app.toolbar;
            this.opts = app.opts;

            // Disable core fixed toolbar
            this.opts.toolbarFixed = false;
        },

        start: function()
        {
            this.scrollTarget = document.querySelector('#modx-content > .x-panel-bwrap > .x-panel-body');
            if (!this.scrollTarget) {
                // When in Fred, we don't need an error, we just return.
                if (document.documentElement.className.indexOf('fred--active') !== -1) {
                    return;
                }
                console.error('[Redactor.fixed_toolbar] Scroll target not found');
                return;
            }
            this.element = this.app.container.getElement().get();
            this.topOffset = document.documentElement.className.indexOf('redactor-modx3') === -1
                ? document.getElementById('modx-header').clientHeight
                : 0; // no topOffset in MODX3

            this._toolbarWrapper = this.toolbar.getWrapper().get();
            this._toolbar = this.toolbar.getElement().get();

            this.scrollTarget.addEventListener('scroll', this.throttleScroll.bind(this), {passive: true, capture: true});
        },

        throttleScroll: function()
        {
            if (this._throttled) {
                return;
            }
            this._throttled = setTimeout(this.onScroll.bind(this), 100);
        },

        onScroll: function()
        {
            this._throttled = false;

            // Prevent firing when the toolbar isn't available
            if (!this._toolbar) {
                return;
            }

            var currentlyFixed = this._toolbar.classList.contains('redactor-toolbar__fixed');
            if (this.element.classList.contains('redactor-box-fullscreen')) {
                if (currentlyFixed) {
                    this._unfix();
                    // Trigger a resize to make it flow naturally now the toolbar was resized
                    // This is a private method, so a little extra care making sure it's there. Might break in the future.
                    if (this.app.plugin.fullscreen && this.app.plugin.fullscreen._resize) {
                        this.app.plugin.fullscreen._resize();
                    }
                }
                return;
            }

            var toolbarRect = this.element.getBoundingClientRect(),
                boxTop = toolbarRect.top - this.topOffset,
                boxBottom = this.element.getBoundingClientRect().bottom - this.topOffset - this._toolbar.clientHeight;

            // The toolbar (boxTop) is out of view, while the boxBottom (bottom of editor) is still visible
            if (boxTop < 0 && boxBottom > 0) {
                if (!currentlyFixed) {
                    this._fix(toolbarRect);
                }
            }
            // Unfix it
            else if (currentlyFixed) {
                this._unfix();
            }
        },

        _fix: function(toolbarRect) {
            // Set a fixed height on the toolbar wrapper - makes content stay in place
            this._toolbarWrapper.style.height = this._toolbarWrapper.clientHeight + 'px';

            var width = this._toolbarWrapper.clientWidth - 18,
                top = this.topOffset,

                toolbarXW = toolbarRect.x + toolbarRect.width,
                actionButtonRect = document.getElementById('modx-action-buttons').getBoundingClientRect();

            if (toolbarXW > actionButtonRect.x) {
                var overflow = toolbarXW - actionButtonRect.x;
                if (
                    ((width / 3) > (width - overflow))
                    || (width - overflow) < 250
                ) {
                    top += actionButtonRect.height;
                }
                else {
                    width -= overflow;
                }
            }

            // Fix the toolbar
            this._toolbar.classList.add('redactor-toolbar__fixed');
            this._toolbar.style.width = width + 'px'; // css applied a 9px margin on both sides
            this._toolbar.style.top = top + 'px'
        },

        _unfix: function() {
            this._toolbarWrapper.style.height = null;
            this._toolbar.classList.remove('redactor-toolbar__fixed');
            this._toolbar.style.width = null;
            this._toolbar.style.position = null;
            this._toolbar.style.top = null;
        }
    });
})(Redactor);
