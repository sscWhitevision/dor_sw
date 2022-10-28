(function($R)
{
    $R.add('plugin', 'better_imagemanager', {
        translations: {
            en: {
                'choose': 'Choose',
                'browse_images': 'Browse images'
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
            image: {
                open: function($modal, $form)
                {
                    this.buildModal($modal)
                }
            }
        },

        // private
        buildModal: function($modal)
        {
            if (this.opts.imageSimpleBrowser) {
                this.addSimpleBrowser($modal);
            }
            if (this.opts.imageMODXBrowser && window.MODx && window.MODx.browser) {
                this.addMODXBrowser($modal);
            }
        },

        addSimpleBrowser: function($modal) {
            $modal.css({maxWidth: '800px', marginLeft: '-400px'});
            this.$chooseTab = $R.dom('<div>');
            this.$chooseTab.attr('data-title', this.lang.get('choose'));
            this.$chooseTab.addClass('redactor-modal-tab');
            this.$chooseTab.hide();
            this.$chooseTab.css({
                overflow: 'auto',
                height: '400px',
                'line-height': 1
            });

            this.$pathSelect = $R.dom('<select class="redactormedia__path_select">');
            this.$pathSelect.append('<option value="">' + this.lang.get('loading') + '</option>');
            this.$pathSelect.attr('disabled', 'disabled');
            this.$pathSelect.attr('title', this.lang.get('loading'));
            this.$pathSelect.on('change', this.chooseDirectory.bind(this));
            this.$chooseTab.append(this.$pathSelect);

            this.$imageHolder = $R.dom('<ul class="redactormedia__images">');
            this.$chooseTab.append(this.$imageHolder);

            var $body = $modal.getBody();
            $body.append(this.$chooseTab);

            $R.ajax.get({
                url: this.opts.modx.connector_url + '?action=media/directories&configuration=' + this.opts.modx.configuration_set + '&HTTP_MODAUTH=' + this.opts.modx.auth,
                success: this.renderDirectories.bind(this)
            });

            this.fetchImages('/');
        },

        chooseDirectory: function () {
            var dir = this.$pathSelect.val();
            this.fetchImages(dir);
        },

        _loader: function () {
            var $loader = $R.dom('<li class="redactormedia__loader">');
            $loader.html('<em>' + this.lang.get('loading') + '</em>');
            return $loader;
        },
        fetchImages: function(dir) {
            dir = dir || '/';

            this.$imageHolder.empty();
            this.$imageHolder.append(this._loader());

            $R.ajax.get({
                url: this.opts.modx.connector_url + '?action=media/files&dir=' + dir + '&configuration=' + this.opts.modx.configuration_set + '&HTTP_MODAUTH=' + this.opts.modx.auth,
                success: this.renderImages.bind(this)
            });
        },
        renderImages: function(data)
        {
            this.$imageHolder.empty();
            for (var key in data)
            {
                if (!data.hasOwnProperty(key)) {
                    continue;
                }

                var obj = data[key];
                if (typeof obj !== 'object') continue;

                var $img = $R.dom('<img>');
                var url = (obj.thumb) ? obj.thumb : obj.url;

                $img.attr('src', url);
                $img.attr('data-params', encodeURI(JSON.stringify(obj)));
                $img.attr('tabindex', 0);
                $img.on('click', this._insert.bind(this));

                var $sizes = $R.dom('<p class="redactormedia__image_sizes">');
                $sizes.text(obj.dimensions + ', ' + obj.filesize);
                var $name = $R.dom('<p class="redactormedia__image_name">');
                $name.text(obj.name);

                var $item = $R.dom('<li class="redactormedia__image">');
                $item.append($img);
                $item.append($name);
                $item.append($sizes);

                this.$imageHolder.append($item);
            }
        },
        renderDirectories: function(data)
        {
            this.$pathSelect.empty();
            for (var key in data)
            {
                if (!data.hasOwnProperty(key)) {
                    continue;
                }
                var obj = data[key];
                if (typeof obj !== 'object') continue;

                var $opt = $R.dom('<option>');
                $opt.attr('value', obj.path);
                $opt.text(obj.path);

                this.$pathSelect.append($opt);
            }
            this.$pathSelect.removeAttr('disabled');
            this.$pathSelect.attr('title', this.lang.get('choose_directory'));
        },
        _insert: function(e)
        {
            e.preventDefault();

            var $el = $R.dom(e.target);
            var data = JSON.parse(decodeURI($el.attr('data-params')));

            this.app.api('module.image.insert', { image: data });
        },

        addMODXBrowser: function($modal) {
            this.$chooseBtn = $R.dom('<button>');
            this.$chooseBtn.html(this.lang.get('browse_images'));
            this.$chooseBtn.addClass('redactor-modx-browser-button');
            this.$chooseBtn.on('click', function(e) {
                e.preventDefault();
                var fileBrowser = MODx.load({
                    xtype: 'modx-browser',
                    id: Ext.id(),
                    multiple: true,
                    listeners: {
                        select: this.browserCallback.bind(this)
                    },
                    allowedFileTypes: 'png,gif,jpg,jpeg,svg,gif,webp',
                    hideFiles: true,
                    title: this.lang.get('browse_images'),
                    source: this.app.opts.imageMODXBrowserSource || 1,
                    openTo: this.app.opts.imageMODXBrowserPath || '/'
                });
                fileBrowser.setSource(this.app.opts.imageMODXBrowserSource || 1);
                fileBrowser.show();

                this.app.api('module.modal.close');
            }.bind(this));

            var $body = $modal.getBody(),
                $uploadBox = $body.find('.upload-redactor-box');
            $uploadBox.before(this.$chooseBtn);
        },

        browserCallback: function(imageData) {
            var url = imageData.fullRelativeUrl;

            // @todo normalise url before insert

            this.app.api('module.image.insert', {
                image: {
                    id: url,
                    url: url
                }
            });
        }
    });
})(Redactor);