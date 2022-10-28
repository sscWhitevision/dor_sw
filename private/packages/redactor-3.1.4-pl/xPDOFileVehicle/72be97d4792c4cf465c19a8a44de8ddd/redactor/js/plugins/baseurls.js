(function($R)
{
    $R.add('plugin', 'baseurls', {
        init: function(app)
        {
            this.app = app;
            this.editor = app.editor;
            this.toolbar = app.toolbar;
            this.opts = app.opts;

            this.app.callback.add('syncing', this.cleanOnSync.bind(this));
        },

        start: function() {
            this.processEditorSource();
        },

        onsource: {
            closed: function() {
                this.processEditorSource();
            }
        },

        onimage: {
            inserted: function()
            {
                this.processEditorSource();
            },

            changed: function()
            {
                this.processEditorSource();
            }
        },


        processEditorSource: function() {
            var dom = this.editor.getElement().get(),
                images = dom.querySelectorAll('img');

            if (images.length === 0) {
                return;
            }

            images.forEach(this.processImage.bind(this));
        },

        processImage: function(img) {
            var src = img.getAttribute('src'),
                normalised = src ? this.normaliseUrl(src) : {};

            if (src !== normalised.displaySrc) {
                img.setAttribute('src', normalised.displaySrc);
            }
            img.setAttribute('data-src', normalised.cleanedSrc);
        },

        cleanOnSync: function(html) {
            var replacements = [];
            var dom = this.editor.getElement().get(),
                images = dom.querySelectorAll('img');

            images.forEach(function(img) {
                var cleanSrc = img.getAttribute('data-src');
                if (cleanSrc) {
                    replacements.push({ src: img.getAttribute('src'), cleanSrc: cleanSrc});
                }
            });

            replacements.forEach(function(repl) {
                html = html.replace('src="' + repl.src + '"', 'src="' + repl.cleanSrc + '"');
                html = html.replace('data-src="' + repl.cleanSrc + '"', '');
            });
            return html;
        },

        normaliseUrl: function(url) {
            var baseUrl = this.opts.modx.base_url,
                siteUrl = this.opts.modx.site_url,
                mode = this.opts.baseurlsMode || 'relative',
                hasBaseUrl = (url.substr(0, baseUrl.length) === baseUrl);

            // Special handling for data urls
            if (url.substr(0, 11) === 'data:image/') {
                return {
                    cleanedSrc: url,
                    displaySrc: url
                }
            }

            if ((url.substr(0, 4) === 'http') || (url.substr(0, 2) === '//')) {
                // If the url starts with the siteUrl, strip it off to get a relative url to work with
                if (url.substr(0, siteUrl.length) === siteUrl) {
                    url = url.substr(siteUrl.length);
                    hasBaseUrl = false;
                }
                // If the url starts with a protocol but doesn't match the siteUrl, return it as-is.
                else {
                    return {
                        cleanedSrc: url,
                        displaySrc: url
                    };
                }
            }

            var displaySrc = url,
                cleanedSrc = url;

            switch (mode) {
                case 'full':
                    if (!hasBaseUrl) {
                        displaySrc = cleanedSrc = siteUrl + url;
                    }
                    else {
                        cleanedSrc = siteUrl + url.substr(baseUrl.length);
                    }
                    break;

                case 'absolute':
                    if (!hasBaseUrl) {
                        displaySrc = baseUrl + url;
                        cleanedSrc = baseUrl + url;
                    }
                    break;

                case 'root-relative':
                    if (!hasBaseUrl) {
                        displaySrc = '/' + url;
                        displaySrc = displaySrc.replace(/\/\/+/g, '/');
                    }
                    else {
                        cleanedSrc = '/' + url.substr(baseUrl.length);
                        cleanedSrc = cleanedSrc.replace(/\/\/+/g, '/');
                    }
                    break;

                case 'relative':
                default:
                    if (!hasBaseUrl) {
                        displaySrc = baseUrl + url;
                    } else {
                        cleanedSrc = url.substr(baseUrl.length);
                    }
                    break;
            }

            return {
                cleanedSrc: cleanedSrc,
                displaySrc: displaySrc
            };
        }
    });
})(Redactor);
