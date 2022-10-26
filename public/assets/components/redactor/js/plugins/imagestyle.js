(function($R)
{
    $R.add('plugin', 'imagestyle', {
        translations: {
            en: {
                'image_style': 'Image Style'
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
            imageedit: {
                open: function($modal)
                {
                    this.buildModal($modal)
                }
            }
        },
        onimage: {
            changed: function(image)
            {
                if (this._modal) {
                    var style = this._modal.find('#modal-image-style').get(0);
                    if (!style) {
                        return;
                    }

                    // Remove other classes, if any
                    var target = this.opts.imageFigure ? image.closest('figure') || image.$element : image.$element;
                    this.opts.imageStyles.forEach(function(obj) {
                        target.removeClass(obj.value);
                    });

                    // Add the selected class, if any
                    var val = style.options[style.selectedIndex].value;
                    if (val.length > 0) {
                        target.addClass(val);
                    }
                }
            }
        },

        // private
        buildModal: function($modal)
        {
            this._modal = $modal;
            var current = this._getCurrent(),
                beforeElem = $modal.$modalBody.find('.form-item-caption').last(),
                elem = $R.dom('<div>');

            elem.addClass('form-item');
            elem.addClass('form-item-style');
            
            var label = $R.dom('<label>').attr('for', 'modal-image_style').text(this.lang.get('image_style'));
            var select = $R.dom('<select>').attr('name', 'style').attr('id', 'modal-image-style');

            select.append($R.dom('<option>').attr('value', '').text(''));
            this.opts.imageStyles.forEach(function(obj) {
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
            if (this.app.module.image && this.app.module.image.$image && this.app.module.image.$image.$element) {
                var targetElem = this.app.module.image.$image;
                targetElem = this.opts.imageFigure ? targetElem.closest('figure') || targetElem.$element : targetElem.$element;

                this.opts.imageStyles.forEach(function(obj) {
                    // Classes may be plural - e.g. `thumbnail thumbnail-primary`
                    // By defaulting hasAll to true, and setting it to false when a class isn't present, an image style
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