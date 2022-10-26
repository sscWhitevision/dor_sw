RedactorConfiguration.combo.ConfigurationSetsClasses = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        mode: 'local',
        store: new Ext.data.SimpleStore({
            fields: ['display','value'],
            data: [
                [_('redactor.class_key.redConfigurationSet'), 'redConfigurationSet'],
                [_('redactor.class_key.redAdvancedConfigurationSet'), 'redAdvancedConfigurationSet']
            ]
        }),
        fields: ['value','display'],
        hiddenName: config.name || 'class_key',
        paging: false,
        valueField: 'value',
        displayField: 'display'
    });
    RedactorConfiguration.combo.ConfigurationSetsClasses.superclass.constructor.call(this,config);
};
Ext.extend(RedactorConfiguration.combo.ConfigurationSetsClasses,MODx.combo.ComboBox);
Ext.reg('redactor-combo-sets-class-key',RedactorConfiguration.combo.ConfigurationSetsClasses);

RedactorConfiguration.combo.EditorDirection = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        mode: 'local',
        store: new Ext.data.SimpleStore({
            fields: ['display','value'],
            data: [
                [_('redactor.direction.ltr'), 'ltr'],
                [_('redactor.direction.rtl'), 'rtl'],
            ]
        }),
        fields: ['value','display'],
        hiddenName: config.name || 'direction',
        paging: false,
        valueField: 'value',
        displayField: 'display'
    });
    RedactorConfiguration.combo.EditorDirection.superclass.constructor.call(this,config);
};
Ext.extend(RedactorConfiguration.combo.EditorDirection,MODx.combo.ComboBox);
Ext.reg('redactor-combo-editor-direction',RedactorConfiguration.combo.EditorDirection);

RedactorConfiguration.combo.BaseUrlMode = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        mode: 'local',
        store: new Ext.data.SimpleStore({
            fields: ['display','value'],
            data: [
                [_('redactor.baseurlsMode.relative'), 'relative'],
                [_('redactor.baseurlsMode.absolute'), 'absolute'],
                [_('redactor.baseurlsMode.full'), 'full'],
                [_('redactor.baseurlsMode.root-relative'), 'root-relative'],
            ]
        }),
        fields: ['value','display'],
        hiddenName: config.name || 'baseurlsMode',
        paging: false,
        valueField: 'value',
        displayField: 'display'
    });
    RedactorConfiguration.combo.BaseUrlMode.superclass.constructor.call(this,config);
};
Ext.extend(RedactorConfiguration.combo.BaseUrlMode,MODx.combo.ComboBox);
Ext.reg('redactor-combo-baseurlmode',RedactorConfiguration.combo.BaseUrlMode);

RedactorConfiguration.combo.StructureTheme = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        mode: 'local',
        store: new Ext.data.SimpleStore({
            fields: ['display','value'],
            data: [
                [_('redactor.structureTheme.default'), 'default'],
                [_('redactor.structureTheme.gutter'), 'gutter'],
                [_('redactor.structureTheme.blocks'), 'blocks']
            ]
        }),
        fields: ['value','display'],
        hiddenName: config.name || 'structureTheme',
        paging: false,
        valueField: 'value',
        displayField: 'display'
    });
    RedactorConfiguration.combo.StructureTheme.superclass.constructor.call(this,config);
};
Ext.extend(RedactorConfiguration.combo.StructureTheme,MODx.combo.ComboBox);
Ext.reg('redactor-combo-structuretheme',RedactorConfiguration.combo.StructureTheme);
