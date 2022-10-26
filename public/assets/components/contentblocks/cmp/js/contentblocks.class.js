var ContentBlocksComponent = function(config) {
    config = config || {};
    ContentBlocksComponent.superclass.constructor.call(this,config);
};
Ext.extend(ContentBlocksComponent,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},tabs:{},combo:{},button:{},
    config: {
        connectorUrl: ''
    },
    attribution: function() {
        return {
            xtype: 'panel',
            bodyStyle: 'text-align: right; background: none; padding: 10px 0;',
            html: '<p class="contentblocks-credits">' +
                '<span class="contentblocks-credits__version">ContentBlocks v' + ContentBlocksConfig.version + '</span>' +
                '<a href="https://www.modmore.com/contentblocks/?utm_source=contentblocks_footer" target="_blank" rel="noopener"  class="contentblocks-credits__logo">' +
                    '<img src="' + ContentBlocksComponent.config.assetsUrl + 'img/modmore.svg" alt="a modmore product"/>' +
                '</a>' +
            '</p>',
            border: false,
            width: '98%',
            hidden: ContentBlocksComponent.config.hideLogo
        };
    }
});
Ext.reg('contentblocks',ContentBlocksComponent);
ContentBlocksComponent = new ContentBlocksComponent();
