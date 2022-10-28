RedactorConfiguration.grid.ConfigurationSets = function (config) {
    config = config || {};
    config.id = config.id || 'redactor-configuration-sets-grid';
    Ext.applyIf(config, {
        url: RedactorConfiguration.config.connectorUrl,
        baseParams: {
            action: 'mgr/configuration_sets/getlist',
            showNone: false
        },
        autosave: true,
        save_action: 'mgr/configuration_sets/update_from_grid',
        autoHeight: true,
        emptyText: _('no_results'),
        fields: [
            {name: 'id', type: 'int'},
            {name: 'class_key', type: 'string'},
            {name: 'name', type: 'string'},
            {name: 'description', type: 'string'},
            {name: 'usage', type: 'string'},
            {name: 'is_default', type: 'bool'},
            {name: 'is_introtext', type: 'bool'},
            {name: 'content', type: 'object'}
        ],
        paging: true,
        // remoteSort: true,
        // plugins: [new Ext.ux.dd.GridDragDropRowOrder({
        //     copy: false,
        //     scrollable: true, // enable scrolling support
        //     listeners: {
        //         'afterrowmove': {
        //             fn: this.onAfterRowMove,
        //             scope: this
        //         }
        //     }
        // })],
        columns: [
            {
                header: _('redactor.id'),
                dataIndex: 'id',
                sortable: true,
                width: .10,
                hidden: true
            },
            {
                header: _('redactor.name'),
                dataIndex: 'name',
                sortable: true,
                width: .25,
                editor: RedactorConfiguration.config.permissions.redactor_sets_save ? {
                    xtype: 'textfield'
                } : false,
                renderer: function (value, metaData, record) {
                    value = Ext.util.Format.htmlEncode(value);
                    if (RedactorConfiguration.config.permissions.redactor_sets_view) {
                        var link = MODx.config.manager_url + '?namespace=redactor&a=set&id=' + record.id;
                        value = '<a href="' + link + '">' + value + '</a>';
                    }
                    return value + ' <span class="redactor-inline-note">(' + record.id + ')</span>';
                }
            },
            /*{
                header: _('redactor.class_key'),
                dataIndex: 'class_key',
                sortable: true,
                width: .15,
                editor: {
                    xtype: 'redactor-combo-sets-class-key',
                    renderer: true
                }
            },*/
            {
                header: _('redactor.usage'),
                dataIndex: 'usage',
                sortable: false,
                width: .40,
                renderer: function (value) {
                    // This renderer is used to bypass automatic HTML encoding in MODX3
                    // The `usage` value is generated server-side from lexicons and htmlencoded values
                    return value;
                }
            },
            {
                header: _('redactor.description'),
                dataIndex: 'description',
                sortable: true,
                width: .40,
                renderer: Ext.util.Format.htmlEncode,
                editor: RedactorConfiguration.config.permissions.redactor_sets_save ? {
                    xtype: 'textarea'
                } : false
            }
        ],
        tbar: this.getToolbarButtons(config)
    });
    RedactorConfiguration.grid.ConfigurationSets.superclass.constructor.call(this, config);
};
Ext.extend(RedactorConfiguration.grid.ConfigurationSets, MODx.grid.Grid, {
    getToolbarButtons: function(config) {
        var buttons = [];
        
        if (RedactorConfiguration.config.permissions.redactor_sets_create
            && RedactorConfiguration.config.permissions.redactor_sets_save) {
            buttons.push({
                text: _('redactor.add_configuration_set'),
                handler: this.addConfigurationSet,
                scope: this
            });
        }

        buttons.push('->');

        if (RedactorConfiguration.config.permissions.redactor_sets_export) {
            buttons.push({
                text: _('redactor.export_configuration_sets'),
                handler: this.exportAllConfigurationSets,
                scope: this
            });
        }

        if (RedactorConfiguration.config.permissions.redactor_sets_import
            && RedactorConfiguration.config.permissions.redactor_sets_create
            && RedactorConfiguration.config.permissions.redactor_sets_save
            && RedactorConfiguration.config.permissions.redactor_sets_delete
        ) {
            buttons.push({
                text: _('redactor.import_configuration_sets'),
                handler: this.importConfigurationSets,
                scope: this
            });
        }

        return buttons;
    },
    
    addConfigurationSet: function () {
        if (!RedactorConfiguration.config.permissions.redactor_sets_create
            || !RedactorConfiguration.config.permissions.redactor_sets_save) {
            return false;
        }
        var win = MODx.load({
            xtype: 'redactor-window-configuration_sets',
            listeners: {
                success: {fn: function (r) {
                    this.refresh();
                }, scope: this},
                scope: this
            }
        });
        win.show();
    },

    editConfigurationSet: function () {
        if (!RedactorConfiguration.config.permissions.redactor_sets_save) {
            return false;
        }
        var record = this.menu.record;
        var win = MODx.load({
            xtype: 'redactor-window-configuration_sets',
            record: record,
            isUpdate: true,
            initCount: 0,
            listeners: {
                success: {fn: function () {
                    this.refresh();
                }, scope: this},
                scope: this
            }
        });
        win.setValues(record);
        win.show();
    },


    duplicateConfigurationSet: function() {
        if (!RedactorConfiguration.config.permissions.redactor_sets_create
            || !RedactorConfiguration.config.permissions.redactor_sets_save) {
            return false;
        }
        var record =  Ext.apply({}, this.menu.record);
        record.id = 0;
        var win = MODx.load({
            xtype: 'redactor-window-configuration_sets',
            record: record,
            isUpdate: false,
            isDuplicate: true,
            title: _('redactor.duplicate_configuration_set'),
            listeners: {
                success: {fn: function(r) {
                    this.refresh();
                },scope: this},
                scope: this
            }
        });
        win.setValues(record);
        win.show();
    },


    deleteConfigurationSet: function () {
        if (!RedactorConfiguration.config.permissions.redactor_sets_delete) {
            return false;
        }
        var record = this.menu.record;

        MODx.msg.confirm({
            title: _('warning'),
            text: _('redactor.delete_configuration_set.confirm'),
            url: RedactorConfiguration.config.connectorUrl,
            params: {
                id: record.id,
                action: 'mgr/configuration_sets/remove'
            },
            listeners: {
                'success': {fn: function (r) {
                    this.refresh();
                }, scope: this}
            }
        });
    },

    getMenu: function () {
        var m = [];

        if (RedactorConfiguration.config.permissions.redactor_sets_save) {
            m.push({
                text: _('redactor.manage_configuration'),
                handler: function() {
                    MODx.loadPage('set', 'namespace=redactor&id=' + this.menu.record.id);
                },
                scope: this
            }, '-');

            m.push({
                text: _('redactor.edit_configuration_set'),
                handler: this.editConfigurationSet,
                scope: this
            });
        }


        if (RedactorConfiguration.config.permissions.redactor_sets_create && RedactorConfiguration.config.permissions.redactor_sets_save) {
            m.push({
                text: _('redactor.duplicate_configuration_set'),
                handler: this.duplicateConfigurationSet,
                scope: this
            });
        }

        if (RedactorConfiguration.config.permissions.redactor_sets_export) {
            m.push({
                text: _('redactor.export_configuration_set'),
                handler: this.exportConfigurationSet,
                scope: this
            });
        }

        if (RedactorConfiguration.config.permissions.settings) {
            var _added = false;
            if (!this.menu.record.is_default) {
                if (!_added && m.length > 0) {
                    m.push('-');
                    _added = true;
                }
                m.push({
                    text: _('redactor.make_default_set'),
                    handler: this.makeDefaultSet,
                    scope: this
                });
            }
            if (!this.menu.record.is_introtext) {
                if (!_added && m.length > 0) {
                    m.push('-');
                }
                m.push({
                    text: _('redactor.make_introtext_set'),
                    handler: this.makeIntrotextSet,
                    scope: this
                });
            }
        }

        if (RedactorConfiguration.config.permissions.redactor_sets_delete) {
            if (m.length > 0) {
                m.push('-');
            }
            m.push({
                text: _('redactor.delete_configuration_set'),
                handler: this.deleteConfigurationSet,
                scope: this
            });
        }

        return m;
    },

    exportConfigurationSet: function() {
        if (!RedactorConfiguration.config.permissions.redactor_sets_export) {
            return false;
        }
        var record = this.menu.record;
        var url = RedactorConfiguration.config.connectorUrl + '?action=mgr/configuration_sets/export';
        url += '&items=' + record.id;
        url += '&HTTP_MODAUTH=' + MODx.siteId;
        window.location = url;
    },

    makeDefaultSet: function() {
        if (!RedactorConfiguration.config.permissions.settings) {
            return false;
        }
        var grid = this;

        MODx.msg.confirm({
            title: _('redactor.make_default_set'),
            text: _('redactor.make_default_set.confirm_text', {name: Ext.util.Format.htmlEncode(this.menu.record.name)}),
            url: RedactorConfiguration.config.connectorUrl,
            params: {
                action: 'mgr/configuration_sets/set_default',
                set: this.menu.record.id
            },
            listeners: {
                'success': {fn: function(r) {
                    MODx.msg.status({
                        title: _('success'),
                        message: _('redactor.make_default_set.saved'),
                        delay: 5
                    });
                    setTimeout(function() {
                        grid.refresh();
                    }, 500);
                }, scope: true},
                'failure': {fn: function(r) {
                    var message = r.message || r.data[0].msg;
                    MODx.msg.alert(_('error'), message);
                }, scope: true}
            }
        });
    },

    makeIntrotextSet: function() {
        if (!RedactorConfiguration.config.permissions.settings) {
            return false;
        }
        var grid = this;

        MODx.msg.confirm({
            title: _('redactor.make_introtext_set'),
            text: _('redactor.make_introtext_set.confirm_text', {name: Ext.util.Format.htmlEncode(this.menu.record.name)}),
            url: RedactorConfiguration.config.connectorUrl,
            params: {
                action: 'mgr/configuration_sets/set_for_introtext',
                set: this.menu.record.id
            },
            listeners: {
                'success': {fn: function(r) {
                    MODx.msg.status({
                        title: _('success'),
                        message: _('redactor.make_introtext_set.saved'),
                        delay: 5
                    });
                    setTimeout(function() {
                        grid.refresh();
                    }, 500);
                }, scope: true},
                'failure': {fn: function(r) {
                    var message = r.message || r.data[0].msg;
                    MODx.msg.alert(_('error'), message);
                }, scope: true}
            }
        });
    },

    exportAllConfigurationSets: function() {
        if (!RedactorConfiguration.config.permissions.redactor_sets_export) {
            return false;
        }

        var url = RedactorConfiguration.config.connectorUrl + '?action=mgr/configuration_sets/export';
        url += '&HTTP_MODAUTH=' + MODx.siteId;
        window.location = url;
    },

    importConfigurationSets: function() {
        if (
            !RedactorConfiguration.config.permissions.redactor_sets_import
            || !RedactorConfiguration.config.permissions.redactor_sets_create
            || !RedactorConfiguration.config.permissions.redactor_sets_save
            || !RedactorConfiguration.config.permissions.redactor_sets_delete
        ) {
            return false;
        }
        var win = MODx.load({
            xtype: 'redactor-window-import',
            title: _('redactor.import_configuration_sets.title'),
            introduction: _('redactor.import_configuration_sets.intro'),
            what: _('redactor.configuration_sets'),
            baseParams: {
                action: 'mgr/configuration_sets/import'
            },
            listeners: {
                success: {fn: function(r) {
                    this.refresh();
                },scope: this},
                scope: this
            }
        });
        win.show();
    }
});
Ext.reg('redactor-grid-configuration_sets', RedactorConfiguration.grid.ConfigurationSets);
