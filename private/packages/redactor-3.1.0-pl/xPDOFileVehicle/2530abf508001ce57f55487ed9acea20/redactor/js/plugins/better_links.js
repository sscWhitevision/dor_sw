(function($R)
{
    $R.add('plugin', 'better_links', {
        init: function(app)
        {
            window._resourceTitleCache = window._resourceTitleCache || {};
            this.app = app;
            this.lang = app.lang;
            this.opts = app.opts;
        },

        // messages
        onmodal: {
            link: {
                open: function($modal, $form)
                {
                    this._enhanceField($modal, 'modal-link-url', true, true);
                }
            },

            imageedit: {
                open: function($modal)
                {
                    this._enhanceField($modal, 'modal-image-url');
                }
            }
        },


        _enhanceField: function($modal, fieldId, required, focus) {
            this._lastModal = $modal;

            var $displayField = $modal.find('#' + fieldId),
                $urlLabel = $modal.find('label[for=' + fieldId + ']'),
                req = required ? ' <span class="req">*</span>' : '',
                $valueField = $R.dom('<input>');

            $displayField.attr('id', $displayField.attr('id') + '-' + this.app.uuid);
            $urlLabel.attr('for', $urlLabel.attr('for') + '-' + this.app.uuid);
            fieldId = $displayField.attr('id');

            if (focus) {
                setTimeout(function() {
                    $displayField.focus();
                }, 500);
            }

            $displayField.removeAttr('name');
            $valueField.attr('name', 'url');
            $valueField.attr('type', 'hidden');
            $valueField.val($displayField.val());
            $displayField.after($valueField);
            $urlLabel.html(this.lang.get('special_url') + req);

            var anchorsEnabled = this.opts.linkToAnchor;
            if (anchorsEnabled) {
                var $anchorWrapper = $R.dom('<div class="form-item">'),
                    $anchorField = $R.dom('<input>');
                $anchorWrapper.addClass('form-item');
                $anchorWrapper.append($R.dom('<label for="modal-link-anchor">' + this.lang.get('anchor') + '</label>'));
                $anchorField.attr('id', 'modal-link-anchor');
                $anchorField.on('input', updateValue);
                $anchorWrapper.append($anchorField);
                $urlLabel.parent().after($anchorWrapper);
            }

            this.typeahead = autocomplete('#' + fieldId, {
                openOnFocus: true,
                minLength: 0,
                cssClasses: {
                    root: 'redactor-autocomplete'
                }
            },[{
                source: this._debounce(this._searchResources.bind(this), 300),
                templates: {
                    suggestion: function(suggestion) {
                        window._resourceTitleCache[suggestion.id] = suggestion.pagetitle;
                        return '<div><p class="resource-id">#' + suggestion.id + '</p>' +
                            '<p class="resource-crumbs">' + (suggestion.crumbs || "") + '</p>' +
                            '<p class="resource-name">' + suggestion.pagetitle + '</p>' +
                            '<p class="resource-introtext">' + suggestion.introtext + '</p></div>';
                    }
                },
                displayKey: 'pagetitle'
            }]);

            this.typeahead.on('autocomplete:selected', function(event, suggestion, dataset, context) {
                $displayField.val(suggestion.pagetitle);
                $valueField.val('[[~' + suggestion.id + ']]');
                updateValue(true);
            });

            $displayField.on('input', function() { updateValue() });
            updateValue();

            $displayField.after($R.dom('<i class="icon">'));

            function updateValue(useValueField) {
                useValueField = useValueField || false;
                var displayVal = $displayField.val(),
                    val = useValueField ? $valueField.val() : displayVal,
                    type = getLinkType(val),
                    anchor = '';

                if (anchorsEnabled) {
                    type === 'email' ? $anchorWrapper.hide() : $anchorWrapper.show();
                    anchor = $anchorField.val();

                    if (val.indexOf('#') !== -1) {
                        if (anchor.length === 0) {
                            anchor = val.substring(val.indexOf('#') + 1);
                        }
                        displayVal = val = val.substring(0, val.indexOf('#'));
                    }
                }

                // The data-type is used for styling and adding an icon into the field
                $displayField.attr('data-type', type);

                if (type === 'url') {
                    // val = val;
                    // Maybe add processing for http(s) or making relative urls absolute?
                }
                else if (type === 'email') {
                    if (val.indexOf('mailto:') === 0) {
                        val = val.substring(7);
                        displayVal = val.substring(7);
                    }
                    val = 'mailto:' + val;
                }
                else if (type === 'resource') {
                    if (val.indexOf('[[~') >= 0) {
                        val = val.substring(val.indexOf('[[~') + 3, val.indexOf(']]'));
                        displayVal = window._resourceTitleCache[val] ? window._resourceTitleCache[val] : val;
                    }
                    val = '[[~' + val + ']]';
                }


                if (anchorsEnabled) {
                    if (anchor.length) {
                        val += '#' + anchor;
                    }
                    $anchorField.val(anchor);
                }
                $valueField.val(val);
                $displayField.val(displayVal);
            }

            function getLinkType (val) {
                var emailRE = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i, // https://stackoverflow.com/questions/46155/validate-email-address-in-javascript/46181#46181
                    type = 'url';

                if (val.indexOf('mailto:') === 0 || emailRE.test(val)) {
                    type = 'email';
                }
                else if (val.indexOf('[[~') >= 0 && val.indexOf(']]') >= 3) {
                    type = 'resource';
                }
                else if (val !== '' && !isNaN(val)) {
                    type = 'resource';
                }

                return type;
            }
        },


        _searchResources: function(query, callback) {
            if (query.indexOf('[[~') >= 0 && query.indexOf(']]') >= 3) {
                query = query.substring(query.indexOf('[[~') + 3, query.indexOf(']]'))
            }

            if (!query || query === '') {
                var textField = this._lastModal ? this._lastModal.find('input[name=text]') : false;
                if (textField && textField.nodes[0] && textField.nodes[0].value !== '') {
                    query = textField.nodes[0].value;
                }
            }

            $R.ajax.get({
                url: this.opts.linkResourceUrl + '&query=' + encodeURIComponent(query),
                success: callback
            });
        },

        _debounce: function(func, wait, immediate) {
            var timeout;
            return function() {
                var context = this, args = arguments;
                var later = function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        }

    });
})(Redactor);