(function ($, ContentBlocks) {
    ContentBlocks.fieldTypes.image = function(dom, data) {
        var input = {
            fieldDom: dom.find('.contentblocks-field'),
            fileBrowser: false,
            source: data.properties.source > 0 ? data.properties.source : ContentBlocksConfig['image.source'],
            directory: data.properties.directory,
            cropData: data.crops || {},
            cropPreviews: dom.find('.contentblocks-field-image-crop-previews'),
            openCropperAutomatically: ContentBlocks.toBoolean(data.properties.open_crops_automatically)
        };

        input.init = function() {
            if (data.url && data.url.length) {
                var urls = ContentBlocks.utilities.normaliseUrls(data.url);
                input.fieldDom.find('.url').val(urls.cleanedSrc).change();
                input.fieldDom.find('.size').val(data.size);
                input.fieldDom.find('.width').val(data.width);
                input.fieldDom.find('.height').val(data.height);
                input.fieldDom.find('.extension').val(data.extension);
                input.fieldDom.find('.source').val(data.source);
                input.fieldDom.find('img.contentblocks-field-image-preview-img').attr('src', input.getThumbnailPreview(data.url));
                input.fieldDom.addClass('preview');
                input.initCropPreviews();
            }

            if (!data.properties.crops || data.properties.crops.length === 0) {
                input.fieldDom.find('.contentblocks-field-crop-image').hide();
            }
            else {
                input.fieldDom.find('.contentblocks-field-crop-image').on('click', input.openCropper);
                input.fieldDom.on('click', '.contentblocks-field-image-crop-preview', function(e) {
                    var crop = $(this),
                        cropKey = crop.data('key');
                    input.openCropper(e, cropKey);
                });
            }
            dom.find('.contentblocks-field-delete-image').on('click', function() {
                input.fieldDom.removeClass('preview');
                input.fieldDom.find('.url').val('').change();
                input.fieldDom.find('.size').val('');
                input.fieldDom.find('.width').val('');
                input.fieldDom.find('.height').val('');
                input.fieldDom.find('.extension').val('');
                input.fieldDom.find('.source').val('');
                input.fieldDom.find('img.contentblocks-field-image-preview-img').attr('src', '');
                input.cropData = data.crops = {};
                input.cropPreviews.empty();

                ContentBlocks.fixColumnHeights();
                ContentBlocks.fireChange();
            });
            input.fieldDom.find('.contentblocks-field-upload').on('click', function() {
                input.fieldDom.find('.contentblocks-field-upload-field').click();
            });

            input.fieldDom.find('.contentblocks-field-image-choose').on('click', $.proxy(function() {
                this.chooseImage();
            }, this));
            input.fieldDom.find('.contentblocks-field-image-url').on('click', $.proxy(function() {
                this.promptImage();
            }, this));

            this.initUpload();
            this.initDropReceiver();
        };

        input.getThumbnailPreview = function(url) {
            if (data.properties.thumbnail_crop
                && input.cropData[data.properties.thumbnail_crop]
                && input.cropData[data.properties.thumbnail_crop].url) {
                return input.cropData[data.properties.thumbnail_crop].url;
            }
            else if (data.properties.thumbnail_size) {
                return ContentBlocks.utilities.getThumbnailUrl(url, data.properties.thumbnail_size);
            }
            var urls = ContentBlocks.utilities.normaliseUrls(url);
            return urls.displaySrc;
        };

        input.initDropReceiver = function() {
            MODx.load({
                xtype: 'modx-treedrop'
                ,target: input.fieldDom
                ,targetEl: input.fieldDom.get(0)
                ,onInsert: function(val) {
                    input.insertFromUrl(val);
                }
            });
        };

        input.initUpload = function() {

            var id = dom.attr('id');
            input.fieldDom.find('#' + id + '-upload').fileupload({
                url: ContentBlocksConfig.connectorUrl + '?action=content/image/upload',
                dataType: 'json',
                dropZone: input.fieldDom,
                progressInterval: 250,
                paramName: 'file',
                pasteZone: null,

                /**
                 * Add an item to the upload queue.
                 *
                 * The item gets an image preview using the FileReader APIs if available
                 *
                 * @param e
                 * @param data
                 */
                add: function(e, data) {
                    ContentBlocks.fireChange();
                    input.fieldDom.addClass('uploading');
                    data.files[0].ext = data.files[0].name.split('.').pop();
                    if (data.files[0].size < 700000 && window.FileReader) {
                        // Only if the image is smaller than ~ 700kb we want to show a preview.
                        // This is to prevent filling up the users' RAM, while providing the user
                        // with a fancy preview of what they're uploading.
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            input.fieldDom.find('img.contentblocks-field-image-preview-img').attr('src', e.target.result);
                            ContentBlocks.fixColumnHeights();
                        };
                        reader.readAsDataURL(data.files[0]);
                    }

                    setTimeout(function() {
                        data.submit();
                    }, 1000);
                },

                /**
                 * When the image has been uploaded add it to the collection.
                 *
                 */
                done: function(e, responseData) {
                    if (responseData.result.success) {
                        var record = responseData.result.object,
                            urls = ContentBlocks.utilities.normaliseUrls(record.url);
                        input.fieldDom.find('.url').val(urls.cleanedSrc).change();
                        input.fieldDom.find('.size').val(record.size);
                        input.fieldDom.find('.width').val(record.width);
                        input.fieldDom.find('.height').val(record.height);
                        input.fieldDom.find('.extension').val(record.extension);
                        input.fieldDom.find('.source').val(record.source);
                        input.fieldDom.find('img.contentblocks-field-image-preview-img').attr('src', input.getThumbnailPreview(record.url));
                        input.fieldDom.addClass('preview');
                        input.loadTinyRTE();
                        if (input.openCropperAutomatically) {
                            input.openCropper();
                        }
                    }
                    else {
                        var message = _('contentblocks.upload_error', {file: responseData.files[0].filename, message: responseData.result.message});
                        if (responseData.files[0].size > 1048576*1.5) {
                            message += _('contentblocks.upload_error.file_too_big');
                        }
                        ContentBlocks.alert(message);
                        input.fieldDom.find('img.contentblocks-field-image-preview-img').attr('src','');
                    }
                    input.fieldDom.removeClass('uploading');

                    setTimeout(function() {
                        ContentBlocks.fixColumnHeights(dom.parents('.contentblocks-region-content'));
                    }, 150);
                },

                fail: function(e, data) {
                    var message = _('contentblocks.upload_error', {file: data.files[0].filename, message:  data.result.message});
                    if (data.files[0].size > 1048576*1.5) {
                        message += _('contentblocks.upload_error.file_too_big');
                    }
                    ContentBlocks.alert(message);

                    input.fieldDom.removeClass('uploading');
                    input.fieldDom.find('img.contentblocks-field-image-preview-img').attr('src','');

                    ContentBlocks.fixColumnHeights(dom.parents('.contentblocks-region-content'));
                },

                /**
                 * Fetch the items we want to send along in the POST. In this case,
                 * this is overridden because normally it sends the entire form = the resource.
                 * All we really want is the resource ID, which we fetch from the URL.
                 * @returns {Array}
                 */
                formData: function() {
                    var fd = [{
                        name: 'HTTP_MODAUTH',
                        value: MODx.siteId
                    },{
                        name: 'resource',
                        value: MODx.request.id || 0
                    },{
                        name: 'field',
                        value: data.id
                    }];

                    if (data.settingKey) {
                        fd.push({
                            name: 'setting_key',
                            value: data.settingKey
                        })
                    }

                    if (data.layout) {
                        fd.push({
                            name: 'layout',
                            value: data.layout
                        })
                    }
                    return fd;
                },

                /**
                 * Update progress for queue items
                 */
                progress: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10) + '%';
                    input.fieldDom.find('.upload-progress .bar').width(progress);
                }
            });
        };

        input.chooseImage = function() {
            var fileBrowser = MODx.load({
                xtype: 'modx-browser',
                id: Ext.id(),
                multiple: true,
                listeners: {
                    select: function(imageData) {
                        imageData.source = this.config.source;
                        input.chooseImageCallback(imageData);
                    }
                },
                allowedFileTypes: data.properties.file_types,
                hideFiles: true,
                title: _('contentblocks.choose_image'),
                source: input.source,
                openTo: data.properties.directory
            });
            fileBrowser.setSource(input.source);
            fileBrowser.show();
            // After showing, set the zindex to make sure it shows in front of CB modals (zindex 1020x)
            fileBrowser.win.setZIndex(10210);
        };

        input.chooseImageCallback = function(imageData) {
            var url = imageData.fullRelativeUrl;
            if (url.substr(0, 4) != 'http' && url.substr(0,1) != '/' ) {
                url = MODx.config.base_url + url;
            }
            var urls = ContentBlocks.utilities.normaliseUrls(url);
            input.fieldDom.find('.url').val(urls.cleanedSrc).change();
            input.fieldDom.find('.size').val(imageData.size);
            input.fieldDom.find('.width').val(imageData.image_width);
            input.fieldDom.find('.height').val(imageData.image_height);
            input.fieldDom.find('.extension').val(imageData.ext);
            input.fieldDom.find('.source').val(imageData.source);
            input.fieldDom.find('img.contentblocks-field-image-preview-img').attr('src', input.getThumbnailPreview(url));
            input.fieldDom.addClass('preview');
            ContentBlocks.fireChange();
            this.loadTinyRTE();
            if (input.openCropperAutomatically) {
                input.openCropper();
            }
        };

        // Prompts the user to enter an image url directly.
        input.promptImage = function() {
            Ext.Msg.prompt(_('contentblocks.from_url_title'),
                _('contentblocks.from_url_prompt'),
                function(btn, url, prompt) {
                    // The user cancelled
                    if (btn !== 'ok') {
                        return;
                    }

                    input.insertFromUrl(url);
                }, this);
        };

        input.insertFromUrl = function(url) {
            if (!url || url.length < 3) {
                ContentBlocks.alert('No URL provided.');
                return;
            }

            input.fieldDom.addClass('contentblocks-field-loading');
            $.ajax({
                dataType: 'json',
                url: ContentBlocksConfig.connector_url,
                type: "POST",
                beforeSend:function(xhr, settings){
                    if(!settings.crossDomain) {
                        xhr.setRequestHeader('modAuth',MODx.siteId);
                    }
                },
                data: {
                    action: 'content/image/download',
                    field: data.field,
                    layout: data.layout,
                    setting_key: data.settingKey,
                    resource: ContentBlocksResource && ContentBlocksResource.id ? ContentBlocksResource.id : 0,
                    url: url
                },
                context: this,
                success: function(result) {
                    input.fieldDom.removeClass('contentblocks-field-loading');
                    if (!result.success) {
                        ContentBlocks.alert(result.message);
                    }
                    else {
                        var urls = ContentBlocks.utilities.normaliseUrls(result.object.url);

                        input.fieldDom.find('.url').val(urls.cleanedSrc).change();
                        input.fieldDom.find('.size').val(result.object.size);
                        input.fieldDom.find('.width').val(result.object.width);
                        input.fieldDom.find('.height').val(result.object.height);
                        input.fieldDom.find('.extension').val(result.object.extension);
                        input.fieldDom.find('.source').val(result.object.source);
                        input.fieldDom.find('img.contentblocks-field-image-preview-img').attr('src', input.getThumbnailPreview(urls.cleanedSrc));
                        input.fieldDom.addClass('preview');
                        ContentBlocks.fireChange();
                        this.loadTinyRTE();
                        if (input.openCropperAutomatically) {
                            input.openCropper();
                        }
                    }
                }
            });
        };

        input.initCropPreviews = function() {
            $.each(input.cropData, function(key, cropData) {
                if (cropData.url && data.properties.crops && data.properties.crops.indexOf(key) !== -1) {
                    var cd = $.extend({cropKey: key}, cropData);
                    input.cropPreviews.append(tmpl('contentblocks-field-image-crop', cd));
                }
            });
        };

        input.openCropper = function(e, crop) {
            var imgData = $.extend(true, {}, data, input.getData());
            crop = crop || false;
            var cropper = ContentBlocks.Cropper(imgData, {
                configurations: data.properties.crops || '',
                initialCrop: crop
            });
            cropper.onChange(function(cropperData) {
                input.cropData = $.extend(true, {}, cropperData, true);
                $.each(cropperData, function(cropKey, cropData) {
                    if (!cropData.url) {
                        return;
                    }
                    var preview = input.cropPreviews.find('.image-crop-' + cropKey + ' img');
                    if (preview && preview.length) {
                        preview.attr('src', cropData.url)
                    }
                    else {
                        var cd = $.extend({cropKey: cropKey}, cropData);
                        input.cropPreviews.append(tmpl('contentblocks-field-image-crop', cd));
                    }
                });
                if (data.properties.thumbnail_crop
                    && input.cropData[data.properties.thumbnail_crop]
                    && input.cropData[data.properties.thumbnail_crop].url) {
                    input.fieldDom.find('img.contentblocks-field-image-preview-img').attr('src', input.cropData[data.properties.thumbnail_crop].url);
                }
            });
        };

        input.getData = function () {
            return {
                url: input.fieldDom.find('.url').val(),
                size: input.fieldDom.find('.size').val(),
                width: input.fieldDom.find('.width').val(),
                height: input.fieldDom.find('.height').val(),
                extension: input.fieldDom.find('.extension').val(),
                source: input.fieldDom.find('.source').val(),
                crops: input.cropData || {}
            };
        };

        input.loadTinyRTE = function() { };

        return input;
    };

    ContentBlocks.fieldTypes.image_with_title = function(dom, data) {
        var input = ContentBlocks.fieldTypes.image(dom, data);

        input.init = function () {
            if (data.url && data.url.length) {
                var urls = ContentBlocks.utilities.normaliseUrls(data.url);
                input.fieldDom.find('.url').val(urls.cleanedSrc).change();
                input.fieldDom.find('.size').val(data.size);
                input.fieldDom.find('.width').val(data.width);
                input.fieldDom.find('.height').val(data.height);
                input.fieldDom.find('.extension').val(data.extension);
                input.fieldDom.find('.source').val(data.source);
                input.fieldDom.find('img.contentblocks-field-image-preview-img').attr('src', input.getThumbnailPreview(data.url));
                input.fieldDom.find('.contentblocks-field-image-title-input').val(data.title || '');
                input.fieldDom.addClass('preview');
                input.initCropPreviews();
                this.loadTinyRTE();
            }

            if (!data.properties.crops || data.properties.crops.length === 0) {
                input.fieldDom.find('.contentblocks-field-crop-image').hide();
            }
            else {
                input.fieldDom.find('.contentblocks-field-crop-image').on('click', input.openCropper);
                input.fieldDom.on('click', '.contentblocks-field-image-crop-preview', function(e) {
                    var crop = $(this),
                        cropKey = crop.data('key');
                    input.openCropper(e, cropKey);
                });
            }
            input.fieldDom.find('.contentblocks-field-delete-image').on('click', function() {
                input.fieldDom.removeClass('preview');
                input.fieldDom.find('.url').val('').change();
                input.fieldDom.find('.size').val('');
                input.fieldDom.find('.width').val('');
                input.fieldDom.find('.height').val('');
                input.fieldDom.find('.extension').val('');
                input.fieldDom.find('.source').val('');
                input.fieldDom.find('.contentblocks-field-image-title-input').val('').removeClass('tinyrte-replaced');
                input.fieldDom.find('img.contentblocks-field-image-preview-img').attr('src', '');
                input.fieldDom.find('.tinyrte-container').remove();
                input.cropData = data.crops = {};
                input.cropPreviews.empty();

                ContentBlocks.fixColumnHeights();
                ContentBlocks.fireChange();
            });
            input.fieldDom.find('.contentblocks-field-upload').on('click', function() {
                input.fieldDom.find('.contentblocks-field-upload-field').click();
            });

            input.fieldDom.find('.contentblocks-field-image-choose').on('click', $.proxy(function() {
                this.chooseImage();
            }, this));
            input.fieldDom.find('.contentblocks-field-image-url').on('click', $.proxy(function() {
                this.promptImage();
            }, this));

            this.initUpload();
            this.initDropReceiver();
        };

        input.loadTinyRTE = function() {
            if (ContentBlocks.toBoolean(data.properties.use_tinyrte)) {
                var title = dom.find('.contentblocks-field-image-title-input');
                ContentBlocks.addTinyRte(title);
            }
        };

        input.getData = function () {
            return {
                url: input.fieldDom.find('.url').val(),
                title: input.fieldDom.find('.contentblocks-field-image-title-input').val(),
                size: input.fieldDom.find('.size').val(),
                width: input.fieldDom.find('.width').val(),
                height: input.fieldDom.find('.height').val(),
                extension: input.fieldDom.find('.extension').val(),
                source: input.fieldDom.find('.source').val(),
                crops: input.cropData || {}
            };
        };
        return input;
    };

})(vcJquery, ContentBlocks);
