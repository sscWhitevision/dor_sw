RedactorConfigSetsCombo = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        url: RedactorConfiguration.config.connectorUrl,
        baseParams: {
            action: 'mgr/configuration_sets/getlist',
            combo: true
        },
        fields: ['id','name'],
        hiddenName: config.name,
        paging: true,
        valueField: 'id',
        displayField: 'name',
        // tpl: new Ext.XTemplate('<tpl for="."><div class="x-combo-list-item" style="float: left;"><img src="{icon_url}" alt="{value}" width="80" height="80"></div></tpl>')
    });
    RedactorConfigSetsCombo.superclass.constructor.call(this,config);
};
Ext.extend(RedactorConfigSetsCombo,MODx.combo.ComboBox);
Ext.reg('redactor-configsets',RedactorConfigSetsCombo);
