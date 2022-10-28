(function($R)
{
    $R.add('plugin', 'better_filemanager', {
        translations: {
            en: {
                'choose': 'Choose',
                'loading': 'Loading...',
                'browse_files': 'Browse Files'
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
            file: {
                open: function($modal, $form)
                {
                    this.buildModal($modal)
                }
            }
        },

        // private
        buildModal: function($modal)
        {
            if (this.opts.fileSimpleBrowser) {
                this.addSimpleBrowser($modal);
            }
            if (this.opts.fileMODXBrowser && window.MODx && window.MODx.browser) {
                this.addMODXBrowser($modal);
            }
        },

        addSimpleBrowser: function($modal) {
            this.$chooseTab = $R.dom('<div>');
            this.$chooseTab.attr('data-title', this.lang.get('choose'));
            this.$chooseTab.addClass('redactor-modal-tab');
            this.$chooseTab.hide();
            this.$chooseTab.css({
                overflow: 'auto',
                height: '300px',
                'line-height': 1
            });

            this.$pathSelect = $R.dom('<select class="redactormedia__path_select">');
            this.$pathSelect.append('<option value="">' + this.lang.get('loading') + '</option>');
            this.$pathSelect.attr('disabled', 'disabled');
            this.$pathSelect.attr('title', this.lang.get('loading'));
            this.$pathSelect.on('change', this.chooseDirectory.bind(this));
            this.$chooseTab.append(this.$pathSelect);

            this.$fileHolder = $R.dom('<ul class="redactormedia__files">');
            this.$chooseTab.append(this.$fileHolder);

            var $body = $modal.getBody();
            $body.append(this.$chooseTab);

            $R.ajax.get({
                url: this.opts.modx.connector_url + '?action=media/directories&type=file&configuration=' + this.opts.modx.configuration_set + '&HTTP_MODAUTH=' + this.opts.modx.auth,
                success: this.renderDirectories.bind(this)
            });

            this.fetchFiles('/');
        },

        chooseDirectory: function () {
            var dir = this.$pathSelect.val();
            this.fetchFiles(dir);
        },

        _loader: function () {
            var $loader = $R.dom('<li class="redactormedia__loader ">');
            $loader.html('<em>' + this.lang.get('loading') + '</em>');
            return $loader;
        },
        fetchFiles: function(dir) {
            dir = dir || '/';

            this.$fileHolder.empty();
            this.$fileHolder.append(this._loader());

            $R.ajax.get({
                url: this.opts.modx.connector_url + '?action=media/files&type=file&dir=' + dir + '&configuration=' + this.opts.modx.configuration_set + '&HTTP_MODAUTH=' + this.opts.modx.auth,
                success: this.renderFiles.bind(this)
            });
        },
        renderFiles: function(data)
        {
            this.$fileHolder.empty();
            for (var key in data)
            {
                if (!data.hasOwnProperty(key)) {
                    continue;
                }

                var obj = data[key];
                if (typeof obj !== 'object') continue;

                var $li = $R.dom('<li>');
                var $item = $R.dom('<a>');
                $item.attr('href', '#');
                $item.addClass('redactor-file-manager-link');
                $item.attr('data-params', encodeURI(JSON.stringify(obj)));
                $item.text(obj.name);
                $item.on('click', this._insert.bind(this));

                var $modified = $R.dom('<span>');
                $modified.addClass('r-file-name');
                $modified.addClass('r-file-modified');
                $modified.text(obj.modified);
                $item.append($modified);

                var $size = $R.dom('<span>');
                $size.addClass('r-file-size');
                $size.text(obj.filesize);
                $item.append($size);

                $li.append($item);

                this.$fileHolder.append($li);
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

            var $el = $R.dom(e.target).closest('.redactor-file-manager-link');
            var data = JSON.parse(decodeURI($el.attr('data-params')));

            this.app.api('module.file.insert', { file: data });
        },

        addMODXBrowser: function($modal) {
            this.$modal = $modal;
            this.$chooseBtn = $R.dom('<button>');
            this.$chooseBtn.html(this.lang.get('browse_files'));
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
                    hideFiles: true,
                    title: this.lang.get('browse_files'),
                    source: this.app.opts.fileMODXBrowserSource || 1,
                    openTo: this.app.opts.fileMODXBrowserPath || '/'
                });
                fileBrowser.setSource(this.app.opts.fileMODXBrowserSource || 1);
                fileBrowser.show();

                this.app.api('module.modal.close');
            }.bind(this));

            var $body = $modal.getBody(),
                $uploadBox = $body.find('.upload-redactor-box');
            $uploadBox.before(this.$chooseBtn);
        },

        browserCallback: function(imageData) {
            var url = imageData.fullRelativeUrl,
                nameField = this.$modal ? this.$modal.find('#modal-file-title') : null,
                name = nameField ? nameField.val() || imageData.name : imageData.name;

            // @todo normalise url before insert

            this.app.api('module.file.insert', {
                file: {
                    id: url,
                    url: url,
                    name: name
                }
            });
        }
    });
})(Redactor);