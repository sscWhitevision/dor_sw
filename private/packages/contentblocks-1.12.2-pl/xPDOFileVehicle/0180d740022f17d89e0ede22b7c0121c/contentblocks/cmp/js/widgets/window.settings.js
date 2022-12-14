ContentBlocksComponent.window.Settings = function(config) {
    config = config || {};
    config.id = config.id || Ext.id();
    var fieldHasOptions = ['select', 'multi_select', 'radio', 'checkbox'],
        fieldHasTypeAheadBoolCombo = ['select'],
        fieldHasTemplate = ['multi_select'],
        fieldHasSeparator = ['multi_select'],
        showMediaOptions = (config.record && config.record.fieldtype == 'image');
    Ext.applyIf(config,{
        title: (config.isUpdate) ?
            _('contentblocks.edit_setting') :
            _('contentblocks.add_setting'),
        autoHeight: true,
        modal: true,
        width: 700,
        fields: [{
            layout: 'column',
            defaults: {
                layout: 'form'
            },
            items: [{
                columnWidth: 0.6,
                items: [{
                    xtype: 'textfield',
                    name: 'reference',
                    fieldLabel: _('contentblocks.reference'),
                    allowBlank: false,
                    anchor: '100%',
                    maxLength: 25,
                    vtype: 'alphanum'
                }, {
                    xtype: 'textfield',
                    name: 'title',
                    fieldLabel: _('contentblocks.title'),
                    allowBlank: false,
                    anchor: '100%'
                }, {
                    xtype: 'textarea',
                    name: 'description',
                    fieldLabel: _('contentblocks.description'),
                    anchor: '100%'
                }, {
                    xtype: 'contentblocks-combo-fieldtypes',
                    name: 'fieldtype',
                    fieldLabel: _('contentblocks.fieldtype'),
                    allowBlank: false,
                    anchor: '100%',
                    value: 'textfield',
                    listeners: {
                        blur: function (fld) {
                            setTimeout(function () {
                                fld.fireEvent('change', fld, fld.getValue());
                            }, 100)
                        },
                        change: function (fld, value) {
                            var fldOpts = Ext.getCmp(config.id + '-fieldoptions');
                            if (fieldHasOptions.indexOf(value) === -1) {
                                fldOpts.hide();
                            }
                            else {
                                fldOpts.show();
                            }

                            var typeAheadBoolCombo = Ext.getCmp(config.id + '-select-typeahead');
                            if (fieldHasTypeAheadBoolCombo.indexOf(value) === -1) {
                                typeAheadBoolCombo.hide();
                            }
                            else {
                                typeAheadBoolCombo.show();
                            }

                            var outputTpl = Ext.getCmp(config.id + '-setting-template');
                            if (fieldHasTemplate.indexOf(value) === -1) {
                                outputTpl.hide();
                            }
                            else {
                                outputTpl.show();
                            }

                            var separator = Ext.getCmp(config.id + '-separator');
                            if (fieldHasSeparator.indexOf(value) === -1) {
                                separator.hide();
                            }
                            else {
                                separator.show();
                            }

                            var imgSource = Ext.getCmp(config.id + '-image_source'),
                                imgDirectory = Ext.getCmp(config.id + '-image_directory'),
                                imgFiletypes = Ext.getCmp(config.id + '-image_file_types'),
                                imgThumbnailSize = Ext.getCmp(config.id + '-image_thumbnail_size');
                            if (value === 'image') {
                                imgSource.show();
                                imgDirectory.show();
                                imgFiletypes.show();
                                imgThumbnailSize.show();
                            }
                            else {
                                imgSource.hide();
                                imgDirectory.hide();
                                imgFiletypes.hide();
                                imgThumbnailSize.hide();
                            }
                        }
                    }
                }, {
                    xtype: 'textarea',
                    name: 'default_value',
                    fieldLabel: _('contentblocks.default_value'),
                    allowBlank: true,
                    anchor: '100%'
                }]
            }, {
                columnWidth: 0.4,
                items: [{
                    xtype: 'contentblocks-combo-mediasource',
                    name: 'image_source',
                    hiddenName: 'image_source',
                    id: config.id + '-image_source',
                    fieldLabel: _('contentblocks.image.source'),
                    allowBlank: true,
                    anchor: '100%',
                    hidden: !showMediaOptions,
                    hideMode: 'offsets'
                }, {
                    xtype: 'textfield',
                    name: 'image_directory',
                    id: config.id + '-image_directory',
                    fieldLabel: _('contentblocks.directory'),
                    allowBlank: true,
                    anchor: '100%',
                    hidden: !showMediaOptions
                }, {
                    xtype: 'textfield',
                    name: 'image_file_types',
                    id: config.id + '-image_file_types',
                    fieldLabel: _('contentblocks.file_types'),
                    description: _('contentblocks.file_types.description'),
                    allowBlank: true,
                    anchor: '100%',
                    hidden: !showMediaOptions
                }, {
                    xtype: 'textfield',
                    name: 'image_thumbnail_size',
                    id: config.id + '-image_thumbnail_size',
                    fieldLabel: _('contentblocks.image.thumbnail_size'),
                    description: _('contentblocks.image.thumbnail_size.description'),
                    allowBlank: true,
                    anchor: '100%',
                    hidden: !showMediaOptions
                }, {
                    xtype: 'textarea',
                    name: 'fieldoptions',
                    id: config.id + '-fieldoptions',
                    fieldLabel: _('contentblocks.fieldoptions'),
                    description: _('contentblocks.fieldoptions.description'),
                    allowBlank: true,
                    anchor: '100%',
                    grow: true,
                    growMin: 50,
                    growMax: 150,
                    hidden: (config.record) ? ( fieldHasOptions.indexOf(config.record.fieldtype) == -1 ) : true
                }, {
                    xtype: 'textfield',
                    name: 'separator',
                    id: config.id + '-separator',
                    fieldLabel: _('contentblocks.multiselect.output_separator'),
                    description: _('contentblocks.multiselect.output_separator.description'),
                    allowBlank: true,
                    anchor: '100%',
                    hidden: (config.record) ? ( fieldHasSeparator.indexOf(config.record.fieldtype) == -1 ) : true
                }, {
                    xtype: 'combo-boolean',
                    name: 'type_ahead',
                    id: config.id + '-select-typeahead',
                    fieldLabel: _('contentblocks.dropdown.search_enabled'),
                    description: _('contentblocks.dropdown.search_enabled.description'),
                    value: _('no'),
                    hidden: (config.record) ? ( fieldHasTypeAheadBoolCombo.indexOf(config.record.fieldtype) == -1 ) : true
                }, {
                    xtype: 'contentblocks-combo-field_is_exposed',
                    fieldLabel: _('contentblocks.field_is_exposed'),
                    description: _('contentblocks.field_is_exposed.description'),
                    name: 'field_is_exposed',
                    allowBlank: false,
                    anchor: '100%',
                    value: 'modal',
                    id: config.id + '-field_is_exposed'
                }, {
                    xtype: 'checkbox',
                    boxLabel: _('contentblocks.link.limit_to_current_context'),
                    description: _('contentblocks.link.limit_to_current_context.description'),
                    name: 'limit_to_current_context',
                    allowBlank: true,
                    anchor: '100%',
                    inputValue: 1,
                    id: config.id + '-limit_to_current_context',
                    hidden: (config.record) ? ( config.record.fieldtype != 'link' ) : true
                }, {
                    xtype: 'checkbox',
                    boxLabel: _('contentblocks.process_tags'),
                    description: _('contentblocks.process_tags.description'),
                    name: 'process_tags',
                    allowBlank: false,
                    anchor: '100%',
                    inputValue: 1,
                    id: config.id + '-process_tags'
                }]
            }]
        },{
            xtype: Ext.ComponentMgr.isRegistered('modx-texteditor') ? 'modx-texteditor' : 'textarea',
            mimeType: 'text/html',
            name: 'template',
            id: config.id + '-setting-template',
            fieldLabel: _('contentblocks.template'),
            description: _('contentblocks.setting_template.description') || undefined,
            allowBlank: true,
            anchor: '100%',
            height: 75,
            grow: true,
            growMin: 75,
            growMax: 200,
            value: (config.record) ? config.record.template : '[[+value]]',
            hidden: (config.record) ? ( fieldHasTemplate.indexOf(config.record.fieldtype) === -1 ) : true
        }],
        keys: []
    });
    ContentBlocksComponent.window.Settings.superclass.constructor.call(this,config);
};
Ext.extend(ContentBlocksComponent.window.Settings, MODx.Window, {
    submit: function() {
        var r = this.fp.getForm().getValues();
        this.fireEvent('success', r);
        this.close();
        return false;
    }
});
Ext.reg('contentblocks-window-settings',ContentBlocksComponent.window.Settings);
