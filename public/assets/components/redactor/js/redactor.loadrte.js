window.RedactorConfigurationSets = window.RedactorConfigurationSets || {};
(function() {
    if (!window.MODx) {
        window.MODx = {};
    }
    MODx.loadRedactorConfigurationSet = function(el, set) {
        el = el || '';
        el = el.split(',').filter(Boolean);
        console.debug('[Redactor] Initialising configuration set #' + set + ' for elements:', el);
        if (window.RedactorConfigurationSets[set]) {
            for (var i = 0; i < el.length; i++) {
                if (el[i] === 'ta' && window.ContentBlocksWillRenderContent) {
                    console.debug('Not initialising Redactor on content field - ContentBlocks is in use.');
                }
                else {
                    window.RedactorConfigurationSets[set](el[i]);
                }
            }
        }
        else {
            console.error('[Redactor] Configuration set with ID "' + set + '" is not available');
        }
    };

    MODx.loadRTE = MODx.loadRedactorRTE = function(el) {
        var set = window.RedactorConfigurationSet || 1;

        if (el === 'ta' || el === false) {
            // el = false for symlinks/weblinks without a content field; cast to an empty string
            el = el || '';
            document.querySelectorAll('.modx-richtext').forEach(function (tv) {
                el += ',' + tv.id;
            });
        }
        MODx.loadRedactorConfigurationSet(el, set);
    };
})();
