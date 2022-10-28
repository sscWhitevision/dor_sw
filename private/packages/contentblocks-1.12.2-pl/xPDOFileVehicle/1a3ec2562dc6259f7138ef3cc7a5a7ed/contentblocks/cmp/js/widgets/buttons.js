ContentBlocksComponent.button.Contexts = function(config) {
    config = config || {};
    config.btn = this;

    Ext.apply(config,{
        id: 'cb-rebuild-content-btn',
        menu: new Ext.menu.Menu({
            cls: 'contentblocks-rebuild-menu',
            items: this.getMenuItems(config),
            listeners: {
                'beforeshow': {fn:function() {
                        this.menu.setWidth(this.getWidth());
                    },scope: this}
            }
        }),
        listeners: {
            click: {
                fn: this.rebuildContexts,
                scope:this
            }
        }
    });
    ContentBlocksComponent.button.Contexts.superclass.constructor.call(this, config);
};
Ext.extend(ContentBlocksComponent.button.Contexts, Ext.SplitButton, {
    getMenuItems: function(config) {
        var menuItems = [];
        ContentBlocksContextKeys.forEach(function(menuItem) {
            menuItems.push({
                text: '<div class="rebuild-ctx-row"><span class="ctx-name">' + menuItem.name + '</span> '
                       + '<span class="ctx-key">' + menuItem.key + '</span></div>',
                key: menuItem.key,
                name: menuItem.name,
                cls: 'x-btn-text',
                handler: config.btn.rebuildContexts
            });
        });
        return menuItems;
    },
    rebuildContexts: function(btn, e) {
        var title = typeof btn.key === 'undefined' ? '' : ' - ' + _('context') + ': ' + btn.name + ' (' + btn.key + ')';
        Ext.Msg.confirm(_('contentblocks.rebuild_content') + title,
            _('contentblocks.rebuild_content.confirm'), function(e) {
                if (e === 'yes') {
                    var win = MODx.load({
                        xtype: 'contentblocks-window-rebuild_content',
                        contextKey: typeof btn.key !== 'undefined' ? btn.key : 'all'
                    });
                    win.show();
                }
            });
    }
});
Ext.reg('contentblocks-button-contexts',ContentBlocksComponent.button.Contexts);