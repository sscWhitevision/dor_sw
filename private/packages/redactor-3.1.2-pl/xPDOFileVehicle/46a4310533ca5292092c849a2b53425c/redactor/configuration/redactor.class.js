var RedactorConfiguration = function(config) {
    config = config || {};
    RedactorConfiguration.superclass.constructor.call(this,config);
};
Ext.extend(RedactorConfiguration,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},tabs:{},combo:{},
    config: {
        connectorUrl: ''
    },
    _dummyText: '',
    attribution: function() {
        return {
            xtype: 'panel',
            bodyStyle: 'text-align: right; background: none; padding: 10px 0; margin-bottom: 2em;',
            html: '<p>' +
        '<span style="font-size:11px;color: #777;">Powered by Redactor ' + RedactorConfiguration.config.version + '</span>' + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
        '<a href="https://www.modmore.com/redactor/" target="_blank" rel="noopener">' +
        '<img src="' + RedactorConfiguration.config.assetsUrl + 'configuration/img/small_modmore_logo.png" alt="Redactor is brought to you by modmore" style="vertical-align:middle;">' +
        '</a></p>',
            border: false,
            width: '98%',
            hidden: RedactorConfiguration.config.hideLogo
        };
    },

    getDummyText: function() {
        if (this._dummyText.length === 0) {
            var metaTag = document.getElementById('redactor-dummy-text');
            if (metaTag) {
                this._dummyText = metaTag.getAttribute('content');
            }
            else if (window.console) {
                console.error('redactor-dummy-text meta tag not found');
            }
        }
        return this._dummyText;
    }
});
Ext.reg('redactor',RedactorConfiguration);
RedactorConfiguration = new RedactorConfiguration();
