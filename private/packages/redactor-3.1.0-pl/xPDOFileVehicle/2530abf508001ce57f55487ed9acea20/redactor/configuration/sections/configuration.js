Ext.onReady(function() {
    MODx.load({
        xtype: 'redactor-page-configuration',
        renderTo: 'redactor-configuration'
    });
});
 
RedactorConfiguration.page.Configuration = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        cls: 'container form-with-labels',
        border: false,
        id : 'redactor-page-wrapper',
        components: [{
            xtype: 'panel',
            html: '<h2>' + _('redactor.configuration') + '</h2>',
            border: false,
            id: 'modx-redactor-header',
            cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs',
            id: 'redactor-page-configuration-tabs',
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
        }, RedactorConfiguration.attribution()],
        buttons: this.getButtons(config)
    });
    RedactorConfiguration.page.Configuration.superclass.constructor.call(this,config);
};
Ext.extend(RedactorConfiguration.page.Configuration,MODx.Component,{
    getTabs: function(config) {
        var tabs = [];

        tabs.push({
            title: _('redactor.configuration_sets'),
            id: 'redactor-page-home-tabs-fields',
            hidden: true,
            hideLabel: true,
            items: [{
                xtype: 'panel',
                bodyCssClass: 'panel-desc',
                html: '<p>' + _('redactor.configuration_sets_desc') + '</p>'
            }, {
                xtype: 'redactor-grid-configuration_sets',
                cls: 'main-wrapper'
            }]
        });

        return tabs;
    },

    getButtons: function() {
        var buttons = [];

        // buttons.push([{
        //     text: _('help_ex'),
        //     handler: this.loadHelpPane,
        //     scope: this,
        //     id: 'modx-abtn-help'
        // }]);

        return buttons;
    }

    // loadHelpPane: function() {
    //     var tabs = Ext.getCmp('redactor-page-configuration-tabs'),
    //         aTab = tabs.activeTab,
    //         baseUrl = 'https://www.modmore.com/redactor/documentation/',
    //         url = '';
    //
    //     switch (aTab.id) {
    //         case 'redactor-page-home-tabs-fields':
    //             url = 'fields/';
    //             break;
    //         case 'redactor-page-home-tabs-layouts':
    //             url = 'layouts/';
    //             break;
    //         case 'redactor-page-home-tabs-templates':
    //             url = 'templates/';
    //             break;
    //         case 'redactor-page-home-tabs-categories':
    //             url = 'categories/';
    //             break;
    //         case 'redactor-page-home-tabs-defaults':
    //             url = 'defaults/';
    //             break;
    //     }
    //
    //     if (url.length > 0) {
    //         MODx.config.help_url = baseUrl + url + '?embed=1';
    //         MODx.loadHelpPane();
    //     }
    // },
});
Ext.reg('redactor-page-configuration',RedactorConfiguration.page.Configuration);
