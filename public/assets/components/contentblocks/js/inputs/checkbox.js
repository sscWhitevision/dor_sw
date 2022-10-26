(function ($, ContentBlocks) {
    ContentBlocks.fieldTypes.checkbox = function(dom, data) {
        var input = {};
        input.init = function() {};

        input.getData = function() {
            var $checkbox = dom.find('input[id]');
            var returnValue = '';
            var returnChecked = '';

            if ($checkbox[0].checked) {
                returnValue = '1'
                returnChecked = 'checked="checked"';
            }

            return {
                value: returnValue,
                checked: returnChecked
            }
        };

        return input;
    }
})(vcJquery, ContentBlocks);
