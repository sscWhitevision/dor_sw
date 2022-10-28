window.FredactorInstances = window.FredactorInstances || {};
var Fredactor = function (fred, pluginTools) {
    var instance = 0;

    return function (el, config, onInit, onChange, onFocus, onBlur) {
        var configSet = config && config.configuration_set ? Number(config.configuration_set) : RedactorConfigurationSet,
            id = el.getAttribute('id');

        // Make sure that the element has an ID; if it doesn't we can't target it with Redactor
        if (!id || id.length < 1) {
            instance++;
            id = 'fredactor-' + instance;
            el.setAttribute('id', id);
        }

        // Store information about the instance globally. Would be nice to *not* do this globally, but alas, config sets
        // are isolated in such a way that we can't readily override options client-side like here.
        window.FredactorInstances[id] = {
            el: el,
            config: config,
            onInit: onInit,
            onChange: onChange,
            onFocus: onFocus,
            onBlur: onBlur
        };

        // Fred expects a promise to be returned. We need to call onInit() and/or (?) resolve() when complete
        // (or Fred will never stop initialising a page)
        return new Promise(function (resolve, reject) {

            // it appears that when this is called, the DOM is not yet available, so we delay initialising
            // the chosen configuration set by 500ms
            setTimeout(function() {
                MODx.loadRedactorConfigurationSet(id, configSet);
            }, 500);

            // No need to wait for the timeout for this - fredactor will come when it's ready.
            onInit();
            resolve();
        });
    }
};