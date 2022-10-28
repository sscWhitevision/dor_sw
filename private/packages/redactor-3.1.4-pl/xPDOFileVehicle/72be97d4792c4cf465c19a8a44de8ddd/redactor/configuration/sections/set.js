Ext.onReady(function() {
    MODx.load({
        xtype: 'redactor-page-configuration',
        renderTo: 'redactor-configuration'
    });
});
 
RedactorConfiguration.page.Set = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        cls: 'container form-with-labels',
        border: false,
        id : 'redactor-page-wrapper',
        components: [{
            xtype: 'panel',
            html: '<h2>' + _('redactor.configuration') + ' &raquo; <em>' + Ext.util.Format.htmlEncode(RedactorConfiguration.record.name) + '</em></h2>',
            border: false,
            id: 'modx-redactor-header',
            cls: 'modx-page-header'
        },{
            xtype: 'panel',
            layout: 'column',
            items: [{
                columnWidth: 0.4,
                items: [{
                    xtype: 'modx-tabs',
                    id: 'redactor-page-sets-tabs',
                    width: '98%',
                    border: true,

                    stateful: true,
                    stateId: 'redactor-page-configuration',
                    stateEvents: ['tabchange'],
                    getState: function() {
                        return {
                            activeTab:this.items.indexOf(this.getActiveTab())
                        };
                    },

                    defaults: {
                        border: false,
                        autoHeight: true,
                        defaults: {
                            border: false
                        }
                    },
                    items: this.getTabs(config)
                }, RedactorConfiguration.attribution()]
            }, {
                columnWidth: 0.6,
                items: [{

                    xtype: 'modx-tabs',
                    id: 'redactor-page-sets-tabs',
                    width: '98%',
                    border: true,

                    stateful: true,
                    stateId: 'redactor-page-configuration-preview',
                    stateEvents: ['tabchange'],
                    getState: function() {
                        return {
                            activeTab:this.items.indexOf(this.getActiveTab())
                        };
                    },

                    defaults: {
                        border: false,
                        autoHeight: true,
                        defaults: {
                            border: false
                        }
                    },
                    items: [{
                        title: _('redactor.live_preview'),
                        id: 'redactor-page-sets-tabs-preview',
                        hidden: true,
                        hideLabel: true,
                        items: [{
                            xtype: 'panel',
                            bodyCssClass: 'panel-desc',
                            html: '<p>' + _('redactor.live_preview_desc_' + RedactorConfiguration.record.class_key) + '</p>'
                        }, {
                            xtype: 'panel',
                            bodyCssClass: 'panel-desc error',
                            hidden: true,
                            id: 'redactor-preview-error'
                        }, {
                            xtype: 'panel',
                            cls: 'main-wrapper',
                            html: '<div class="redactor-preview-container">' +
                            '<textarea id="redactor-preview">' + RedactorConfiguration.getDummyText() + '</textarea>',
                        }]
                    }]

                }]
            }]

        }],
        buttons: this.getButtons(config)
    });
    if (RedactorConfiguration.config.permissions.redactor_sets_save) {
        new Ext.KeyMap(Ext.getBody(), {
            key: 's',
            ctrl: true,
            fn: this.submit,
            scope: this
        });
    }
    if (RedactorConfiguration.config.permissions.redactor_sets_export) {
        new Ext.KeyMap(Ext.getBody(), {
            key: 'e',
            ctrl: true,
            fn: this.exportConfigurationSet,
            scope: this
        });
    }
    RedactorConfiguration.page.Set.superclass.constructor.call(this,config);
};
Ext.extend(RedactorConfiguration.page.Set,MODx.Component,{
    getTabs: function(config) {
        var tabs = [];

        tabs.push({
            title: _('redactor.manage_configuration'),
            id: 'redactor-page-sets-tabs-config',
            hidden: true,
            hideLabel: true,
            items: [{
                xtype: 'panel',
                bodyCssClass: 'panel-desc',
                html: '<p>' + _('redactor.manage_configuration_desc_' + RedactorConfiguration.record.class_key) + '</p>'
            }, {
                id: 'redactor-page-sets-tabs-config-panel',
                xtype: (RedactorConfiguration.record.class_key === 'redConfigurationSet') ? 'redactor-panel-edit-set-basic' : 'redactor-panel-edit-set-advanced',
                record: RedactorConfiguration.record
            }]
        });

        return tabs;
    },

    getButtons: function() {
        var buttons = [];


        if (RedactorConfiguration.config.permissions.redactor_sets_save) {
            buttons.push([{
                text: _('save'),
                handler: this.submit,
                scope: this,
                id: 'modx-abtn-submit',
                cls: 'primary-button'
            }]);
        }

        if (RedactorConfiguration.config.permissions.redactor_sets_export) {
            buttons.push([{
                text: _('redactor.export_configuration_set'),
                handler: this.exportConfigurationSet,
                scope: this,
                id: 'modx-abtn-export'
            }]);
        }

        buttons.push([{
            text: _('close'),
            handler: function() {
                MODx.loadPage('configuration','namespace=redactor');
            },
            scope: this,
            id: 'modx-abtn-back'
        }]);

        return buttons;
    },

    submit: function() {
        if (RedactorConfiguration.config.permissions.redactor_sets_save) {
            Ext.getCmp('redactor-page-sets-tabs-config-panel').submit(false);
        }
    },

    exportConfigurationSet: function() {
        if (RedactorConfiguration.config.permissions.redactor_sets_export) {
            var record = RedactorConfiguration.record;
            var url = RedactorConfiguration.config.connectorUrl + '?action=mgr/configuration_sets/export';
            url += '&items=' + record.id;
            url += '&HTTP_MODAUTH=' + MODx.siteId;
            window.location = url;
        }
    }
});
Ext.reg('redactor-page-configuration',RedactorConfiguration.page.Set);
