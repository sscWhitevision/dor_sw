(function($R)
{
    $R.add('plugin', 'linkstyle', {
        translations: {
            en: {
                'link_style': 'Link Style'
            }
        },
        init: function(app)
        {
            this.app = app;
            this.lang = app.lang;
            this.opts = app.opts;
        },

        // messages
        onmodal: {
            link: {
                open: function($modal)
                {
                    this.buildModal($modal)
                }
            }
        },
        onlink: {
            inserted: function(link) {
                var elem = link.first();
                if (!this._modal) {
                    return;
                }
                var style = this._modal.find('#modal-link-style').get(0);
                if (!style) {
                    return;
                }

                // Remove other classes, if any
                var target = elem;
                this.opts.linkStyles.forEach(function(obj) {
                    target.removeClass(obj.value);
                });

                // Add the selected class, if any
                var val = style.options[style.selectedIndex].value;
                if (val.length > 0) {
                    target.addClass(val);
                }
            },
            changed: function(links)
            {
                var style = this._modal.find('#modal-link-style').get(0);
                if (!style) {
                    return;
                }

                var target = links[0];
                if (!target) {
                    return;
                }

                // Remove any old styles that may be present
                this.opts.linkStyles.forEach(function(obj) {
                    var classes = obj.value.split(' ');
                    classes.forEach(function(cls) {
                        target.classList.remove(cls);
                    });
                });

                // Add the selected class, if any
                var val = style.options[style.selectedIndex].value;
                if (val.length > 0) {
                    var classes = val.split(' ');
                    classes.forEach(function(cls) {
                        target.classList.add(cls);
                    });
                }
            }
        },

        // private
        buildModal: function($modal)
        {
            this._modal = $modal;
            var current = this._getCurrent(),
                beforeElem = $modal.$modalBody.find('.form-item').last(),
                elem = $R.dom('<div>');

            elem.addClass('form-item');
            elem.addClass('form-item-style');
            
            var label = $R.dom('<label>').attr('for', 'modal-link_style').text(this.lang.get('link_style'));
            var select = $R.dom('<select>').attr('name', 'style').attr('id', 'modal-link-style');

            select.append($R.dom('<option>').attr('value', '').text(''));
            this.opts.linkStyles.forEach(function(obj) {
                var opt = $R.dom('<option>').attr('value', obj.value).text(obj.label);
                if (current === obj.value) {
                    opt.attr('selected', 'selected');
                }
                select.append(opt);
            });

            elem.append(label);
            elem.append(select);

            beforeElem.after(elem);
        },

        _getCurrent: function() {
            var current = '';

            if (this.app.module.link && this.app.module.link.$link) {
                var targetElem = this.app.module.link.$link.first();

                // Loop over the defined linkStyles to find a match
                this.opts.linkStyles.forEach(function(obj) {

                    // Classes may be plural - e.g. `btn btn-primary`
                    // By defaulting hasAll to true, and setting it to false when a class isn't present, a link style
                    // without classes is supported as well
                    var classes = obj.value.split(' '),
                        hasAll = true;

                    // Check each class individually
                    classes.forEach(function(cls) {
                        if (!targetElem.hasClass(cls)) {
                            hasAll = false;
                        }
                    });

                    if (hasAll) {
                        current = obj.value;
                    }
                });
            }

            return current;
        }
    });
})(Redactor);