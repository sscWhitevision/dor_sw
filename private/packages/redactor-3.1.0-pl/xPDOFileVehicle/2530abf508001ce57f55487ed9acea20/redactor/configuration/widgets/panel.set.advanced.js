RedactorConfiguration.panel.EditSetAdvanced = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        url: RedactorConfiguration.config.connectorUrl,
        baseParams: {
            action: 'mgr/configuration_sets/update',
            id: config.record.id
        },
        cls:'main-wrapper',
        id: 'redactor-panel-edit-set-advanced-fp',
        buttonAlign: 'center',
        items: [{
            xtype: 'panel'
            ,border: false
            ,layout: 'form'
            ,labelAlign: 'top'
            ,id: 'redactor-advanced-content-container'
            ,items: []
        }],
        listeners: {
            // On render we load the content field; if we do this before it is rendered we get an error from ace.
            render: {fn: function() {
                var contentContainer = Ext.getCmp('redactor-advanced-content-container');
                if (contentContainer) {
                    // Check if ace is available. If it isn't, suggest people install it so they can use
                    // syntax highlighting and get some nice other features
                    var aceAvl = Ext.ComponentMgr.isRegistered('modx-texteditor');
                    if (!aceAvl) {
                        contentContainer.add({
                            xtype: 'panel',
                            html: '<p>' + _('redactor.install_ace') + '</p>'
                        });
                    }

                    // Add the advanced config input field, using ace (modx-texteditor) if possible.
                    contentContainer.add({
                        id: 'redactor-advanced-content',
                        xtype: aceAvl ? 'modx-texteditor' : 'textarea',
                        fieldLabel: _('redactor.advanced_configuration'),
                        name: 'content',
                        value: config.record.content || '',
                        anchor: '100%',
                        grow: true,
                        growMin: 150,
                        growMax: 999999,
                        enableKeyEvents: true,
                        mimeType: 'text/javascript',
                        listeners: {
                            keyup: {fn: this.updatePreview, scope: this}
                        }
                    });
                }
                var that = this;
                setTimeout(function() {
                    that.updatePreview.bind(that)();
                });
            }, scope: this}
        }
    });
    RedactorConfiguration.panel.EditSetAdvanced.superclass.constructor.call(this,config);
};
Ext.extend(RedactorConfiguration.panel.EditSetAdvanced, MODx.FormPanel,{
    previewErrorHolder: false,

    updatePreview: function() {
        if (!this.previewErrorHolder) {
            this.previewErrorHolder = Ext.getCmp('redactor-preview-error');
        }
        if (!this.advancedContentFld) {
            this.advancedContentFld = Ext.getCmp('redactor-advanced-content');
        }
        this.previewErrorHolder.hide();

        var fldValue = this.advancedContentFld.getValue();

        try {
            // Try to turn the provided value into a javascript object to pass to redactor
            var fn = Function('element', fldValue);

            // if the above didn't fail, destroy the existing instance
            $R('#redactor-preview', 'destroy');
            // and rebuild it again with the new options
            fn('#redactor-preview');
        }
        catch(e) {
            // if we get an error, show it to the user above the live preview
            this.previewErrorHolder.update(_('redactor.live_preview_error', {error: e}));
            this.previewErrorHolder.show();
            // console.error(e);
        }

    }
});
Ext.reg('redactor-panel-edit-set-advanced',RedactorConfiguration.panel.EditSetAdvanced);
