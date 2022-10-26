RedactorConfiguration.panel.EditSetBasic = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        url: RedactorConfiguration.config.connectorUrl,
        baseParams: {
            action: 'mgr/configuration_sets/update',
            id: config.record.id
        },
        id: 'redactor-panel-edit-set-basic-fp',
        buttonAlign: 'center',
        items: [{
            xtype: 'hidden',
            name: 'id',
            value: RedactorConfiguration.record.id
        },{
            xtype: 'modx-vtabs'
            ,border: false
            ,labelAlign: 'top'
            ,hideMode: 'offsets'
            ,deferredRender: false
            ,forceLayout: true
            ,id: 'redactor-basic-content-container'
            ,items: this.getCategoryTabs(config)
        }],
        listeners: {
            // On render we load the content field; if we do this before it is rendered we get an error from ace.
            render: {fn: function() {
                function isObject(value) {
                    return (!!value) && (value.constructor === Object);
                }
                function isArray(value) {
                    return (!!value) && (value.constructor === Array);
                }
                var form = this.getForm(),
                    record = this.config.record;
                Ext.iterate(record.content, function(key, value) {
                    if (isObject(value)) {
                        record[key] = JSON.stringify(value, null, '    ');
                    }
                    else if (isArray(value)) {
                        var newValue = [],
                            isNested = false;
                        Ext.each(value, function(aValue) {
                            if (isArray(aValue) || isObject(aValue)) {
                                isNested = true;
                            }
                            newValue.push(aValue);
                        });
                        newValue = isNested ? JSON.stringify(newValue, null, '    ') : newValue.join(', ');
                        record[key] = newValue;
                    }
                });
                form.setValues(record.content);
                form.setValues(record);
                this.changedFieldHandlerEnabled = true;

                var that = this;
                setTimeout(function() {
                    that.onChangedField();
                })
            }, scope: this}
        }
    });
    RedactorConfiguration.panel.EditSetBasic.superclass.constructor.call(this,config);
};
Ext.extend(RedactorConfiguration.panel.EditSetBasic, MODx.FormPanel,{
    changedFieldHandlerEnabled: false,
    onChangedField: function() {
        if (!this.changedFieldHandlerEnabled) {
            return;
        }
        if (!this.previewErrorHolder) {
            this.previewErrorHolder = Ext.getCmp('redactor-preview-error');
        }
        this.previewErrorHolder.hide();
        var that = this;

        // Get the setting values
        var options = this.getForm().getValues();
        MODx.Ajax.request({
            url: RedactorConfiguration.config.connectorUrl,
            params: {
                action: 'mgr/configuration_sets/process_options',
                options: Ext.encode(options)
            },
            listeners: {
                success: {fn: function(result) {
                    try {
                        // Destroy the previous instance
                        $R('#redactor-preview', 'destroy');

                        // Make sure the modal was removed
                        var modalEl = document.getElementById('redactor-modal');
                        if (modalEl) {
                            modalEl.remove();
                        }
                    }
                    catch(e) {
                        // if we get an error, show it to the user above the live preview
                        var msg = '[' + Ext.util.Format.htmlEncode(e.name) + '] ' + Ext.util.Format.htmlEncode(e.message);

                        // Try to show the filename and line number if available (not available cross-browser)
                        if (e.fileName) {
                            msg += ' in ' + e.fileName;
                        }
                        if (e.lineNumber) {
                            msg += ' on line ' + e.lineNumber;
                            if (e.columnNumber) {
                                msg += ':' + e.columnNumber;
                            }
                        }

                        that.previewErrorHolder.update(_('redactor.live_preview_error', {error: msg}));
                        that.previewErrorHolder.show();
                        if (console) {
                            console.error(e);
                        }
                    }
                    try {
                        // If the response is JSON, you have to decode it
                        var options = result.object.options;
                        // and rebuild it again with the new options
                        $R('#redactor-preview', options);
                    }
                    catch(e) {
                        try {
                            $R('#redactor-preview', 'destroy');
                        }
                        catch (e) {
                            if (console) {
                                console.error('Could not destroy Redactor instance after encountering error. Refresh of page might be necessary to continue.');
                            }
                        }
                        // if we get an error, show it to the user above the live preview
                        var msg = '[' + Ext.util.Format.htmlEncode(e.name) + '] ' + Ext.util.Format.htmlEncode(e.message);

                        // Try to show the filename and line number if available (not available cross-browser)
                        if (e.fileName) {
                            msg += ' in ' + e.fileName;
                        }
                        if (e.lineNumber) {
                            msg += ' on line ' + e.lineNumber;
                            if (e.columnNumber) {
                                msg += ':' + e.columnNumber;
                            }
                        }

                        // if we get an error, show it to the user above the live preview
                        that.previewErrorHolder.update(_('redactor.live_preview_error', {error: msg}));
                        that.previewErrorHolder.show();
                        if (console) {
                            console.error(e);
                        }
                    }

                }, scope: this},
                failure: {fn: function(result) {
                    MODx.msg.alert(result.message);
                }, scope: this}
            }
        });

    },

    getCategoryTabs: function(config) {
        var tabs = RedactorConfiguration.formDefinition,
            changeListener = {fn: this.onChangedField, scope: this};

        // Add the changeListener to each of the items, to all possible events depending on xtype
        Ext.iterate(tabs, function(tab) {
            Ext.iterate(tab.items, function(item) {
                item.listeners = {
                    check: changeListener,
                    change: changeListener,
                    select: changeListener,
                    keyup: changeListener
                }
            });
        });

        return tabs;
    }
});
Ext.reg('redactor-panel-edit-set-basic',RedactorConfiguration.panel.EditSetBasic);
