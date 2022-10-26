RedactorConfiguration.window.ConfigurationSets = function (config) {
    config = config || {};
    config.id = config.id || Ext.id();
    Ext.applyIf(config, {
        url: RedactorConfiguration.config.connectorUrl,
        baseParams: {
            action: (config.isUpdate) ?
                'mgr/configuration_sets/update' :
                'mgr/configuration_sets/create'
        },
        title: (config.isUpdate) ?
            _('redactor.edit_configuration_set') :
            _('redactor.add_configuration_set'),
        autoHeight: true,
        modal: true,
        width: 400,
        fields: [{
            xtype: 'hidden',
            name: 'id'
        },{
            xtype: 'hidden',
            name: 'content'
        },{
            xtype: 'textfield',
            name: 'name',
            fieldLabel: _('redactor.name'),
            allowBlank: true,
            anchor: '100%'
        },{
            xtype: 'hidden', // 'redactor-combo-sets-class-key',
            name: 'class_key',
            fieldLabel: _('redactor.class_key'),
            allowBlank: true,
            anchor: '100%',
            value: 'redConfigurationSet',
            disabled: config.isUpdate
        },{
            xtype: 'hidden', // 'panel',
            html: '<p>' + ((config.isUpdate) ? _('redactor.class_key.description_upd') : _('redactor.class_key.description')) + '</p>'
        },{
            xtype: 'textarea',
            name: 'description',
            fieldLabel: _('redactor.description'),
            allowBlank: true,
            anchor: '100%'
        }],
        buttons: this.getWindowButtons(config)
    });
    RedactorConfiguration.window.ConfigurationSets.superclass.constructor.call(this, config);
};
Ext.extend(RedactorConfiguration.window.ConfigurationSets, MODx.Window, {
    getWindowButtons: function(config) {
        var b = [{
            text: _('cancel'),
            scope: this,
            handler: function() { this.hide(); }
        },'-'];

        // if (RedactorConfiguration.config.permissions.configuration_sets_save) {
            b.push([{
                text: _('save'),
                scope: this,
                handler: this.submit,
                cls: 'primary-button'
            }]);
        // }
        return b;
    }
});
Ext.reg('redactor-window-configuration_sets', RedactorConfiguration.window.ConfigurationSets);
