RedactorConfiguration.window.Import = function(config) {
    config = config || {};
    config.id = config.id || Ext.id(),
    Ext.applyIf(config,{
        url: RedactorConfiguration.config.connectorUrl,
        autoHeight: true,
        fileUpload: true,
        modal: true,
        width: 450,
        fields: [{
            xtype: 'hidden',
            name: 'parent'
        },{
            xtype: 'panel',
            cls: 'panel-desc',
            html: '<p>' + config.introduction + '</p>',
            border: false
        },{
            xtype: 'textfield',
            fieldLabel: _('redactor.import_file'),
            name: 'file',
            inputType: 'file'
        },{
            xtype: 'radiogroup',
            fieldLabel: _('redactor.import_mode'),
            columns: 1,
            items: [{
                boxLabel: _('redactor.import_mode.insert', {what: config.what}),
                name: 'mode',
                inputValue: 'insert',
                checked: true
            },{
                boxLabel: _('redactor.import_mode.overwrite', {what: config.what}),
                name: 'mode',
                inputValue: 'overwrite'
            },{
                boxLabel: _('redactor.import_mode.replace', {what: config.what}),
                name: 'mode',
                inputValue: 'replace'
            }]
        }],
        buttons: [{
            text: _('cancel'),
            scope: this,
            handler: function() { this.hide(); }
        },'-',{
            text: _('redactor.start_import'),
            scope: this,
            handler: this.submit,
            cls: 'primary-button'
        }]
    });
    RedactorConfiguration.window.Import.superclass.constructor.call(this,config);
};
Ext.extend(RedactorConfiguration.window.Import, MODx.Window);
Ext.reg('redactor-window-import',RedactorConfiguration.window.Import);
