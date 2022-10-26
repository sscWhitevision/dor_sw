(function ($, ContentBlocks) {
    ContentBlocks.fieldTypes.color_picker = function(dom, data) {
        var input = {
            value: (function() {
                if (data.value) {
                    return data.value;
                }
                return '#fafafa';
            })()
        };

        // Format swatch properties
        if ((typeof data.properties['swatch_colors'] !== 'undefined')) {
            var hexCodes = data.properties['swatch_colors'].split(',');
            for (var i = 0; i < 16; i++) {
                if ((typeof hexCodes[i] !== 'undefined')) {
                    data.properties['swatch' + (i + 1)] = hexCodes[i];
                }
            }
        }
        var modal = {
            title: _('contentblocks.colorpicker'),
            html: tmpl('contentblocks-color-picker-modal', {'properties':data.properties}),
            options: {
                width: '630px',
                initCallback: function(modal, options) {
                    input.element = document.getElementById('color-picker-widget');
                    input.colorPicker = new iro.ColorPicker(input.element, {
                        width: 280,
                        color: input.value,
                        borderWidth: 0,
                        layout: [
                            {
                                component: iro.ui.Box,
                            },
                            {
                                component: iro.ui.Slider,
                                options: {
                                    id: 'hue-slider',
                                    sliderType: 'hue'
                                }
                            }
                        ]
                    });

                    // Update color picker on swatch click
                    input.swatchGrid = modal.find('#swatch-grid');
                    input.swatchGrid.on('click', function(e) {
                        var clickTarget = e.target;
                        if (clickTarget.dataset.color) {
                            input.colorPicker.color.set(clickTarget.dataset.color);
                        }
                    });

                    // Update color values when color picker changes
                    var hexInput = modal.find("#hex-input");
                    var values = modal.find("#values");
                    input.colorPicker.on(["color:init", "color:change"], function(color){
                        hexInput.val(color.hexString);
                        values.html([
                            'rgb: ' + color.rgbString,
                            'hsl: ' + color.hslString,
                        ].join("<br>"));
                        input.selectedColorEl = modal.find('#selected-color');
                        input.selectedColorEl.css('background-color',color.hexString);
                        input.selectedColorEl.data('color',color.hexString);
                        input.selectedColor = color.hexString;
                    });

                    // Listen for Enter key in text field
                    hexInput.on("keyup", function(event) {
                        if (event.key === "Enter") {
                            if ((hexInput.val().length === 7 || hexInput.val().length === 4) && hexInput.val().charAt(0) === '#') {
                                input.colorPicker.color.set(hexInput.val());
                            }
                        }
                    });

                    // Modal buttons
                    modal.find('.cancel').on('click', ContentBlocks.closeModal);
                    modal.find('.select').on('click', function() {
                        dom.find('#' + data.generated_id + '-color-picker-button').css('background-color',input.selectedColor);
                        dom.find('#' + data.generated_id + '-color-picker-code').html(input.selectedColor);
                        input.value = input.selectedColor;

                        if (data.settingType === 'layout' || data.settingType === 'field') {
                            dom.find('.setting-color-picker-button').css('background-color', input.selectedColor);
                            dom.find('.color-picker-code').html(input.selectedColor);

                            // Trigger change event else value won't save!
                            var settingInput = dom.find('input[type=hidden]')
                            settingInput.val(input.selectedColor);
                            settingInput.trigger('change');
                            ContentBlocks.closeModal();
                        }

                        else if (data.settingType === 'modal') {
                            var selectedColor = input.selectedColor;

                            // Reload original settings modal and add values back
                            var layoutId = localStorage.getItem('layout-settings-modal-id');

                            // TODO: this was causing issues but keeping here for now
                            // ContentBlocks.openLayoutSettings('', $('#' + layoutId));

                            // Here we take back our saved modal-content element and replace the newly created one.
                            var $modalContent = $('#contentblocks-modal').find('.contentblocks-modal-content');
                            $modalContent.removeAttr('id');
                            $modalContent.replaceWith( $('#saved-modal-content') );

                            // Parse through the old modal content, find the relevant setting and change the value.
                            var inputs = $('#contentblocks-modal').find('input');
                            inputs.each(function(i, input) {
                                if (input.getAttribute('name') === layoutId + '-setting-' + data.reference
                                                                || input.getAttribute('name') === data.inputName) {
                                    input.value = selectedColor;
                                    input.parentNode.querySelector('span').innerText = selectedColor;

                                    var btn = input.parentNode.querySelector('button');
                                    btn.style.background = selectedColor;
                                    btn.dataset.color = selectedColor;
                                }
                            });
                        }
                        else {
                            ContentBlocks.closeModal();
                        }
                    });
                }
            }
        };

        input.init = function() {
            var button;
            if (data.settingType === 'layout' || data.settingType === 'field' || data.settingType === 'modal') {
                button = dom.find('.setting-color-picker-button');
            }
            else {
                button = dom.find('#' + data.generated_id + '-color-picker-button');
            }

            if (data.settingType === 'modal') {
                button.on('click', function (e) {
                    // Copy and hide the whole modal content element
                    var content = $(this).closest('.contentblocks-modal-content');
                    content.attr('id','saved-modal-content');
                    content.appendTo($(document.body));

                    ContentBlocks.openModal(modal.title, modal.html, modal.options);
                });
            }
            else {
                button.on('click', function (e) {
                    ContentBlocks.openModal(modal.title, modal.html, modal.options);
                });
            }
        };

        input.getData = function() {
            return {
                value: input.value
            }
        };
        return input;
    }
})(vcJquery, ContentBlocks);