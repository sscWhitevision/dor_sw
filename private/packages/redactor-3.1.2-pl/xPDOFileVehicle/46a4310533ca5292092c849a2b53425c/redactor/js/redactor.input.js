(function ($, ContentBlocks) {
    ContentBlocks.fieldTypes.redactor = function(dom, data) {
        var input = {
            configurationSet: Number(data.properties.configuration_set) || 1,
            textarea: null,
            textareaId: null,
        };

        input.init = function() {
            input.textarea = dom.find('.contentblocks-field-redactor-textarea textarea');
            if (input.textarea) {
                input.textareaId = input.textarea.attr('id');
                MODx.loadRedactorConfigurationSet(input.textareaId, input.configurationSet);
            }
            else {
                console.error('Textarea for Redactor input type not found');
            }
        };

        input.getData = function() {
            return {
                value: input.textarea.val()
            }
        };

        // Always return the input variable.
        return input;
    }
})(vcJquery, ContentBlocks);