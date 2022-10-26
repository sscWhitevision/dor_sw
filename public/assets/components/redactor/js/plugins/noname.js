(function($R)
{
    /**
     * The noname plugin is used as a hack for an issue in Redactor 3.0.11. In _buildName it is always setting
     * a name attribute on the original textarea being enhanced, even if it did not have a name before.
     *
     * Combined with MODX bug #13711 where unexpected fields with HTML break the response handling in ExtJS,
     * that means that in cases like ContentBlocks (which has rich text fields without a name, because CB handles
     * the actual processing and saving of said fields), the added name field can cause a manager save to fail.
     *
     * To combat that, this plugin will remove the name if it is "content-UUID", the format Redactor uses.
     *
     * Normal fields with their own names are unaffected, and use cases like ContentBlocks still work. Yay!
     *
     */
    $R.add('plugin', 'noname', {
        // construct
        init: function(app)
        {
            // define app
            this.uuid = app.uuid;
            this.element = app.element;
        },
        // public
        start: function()
        {
            var $element = this.element.getElement();

            var name = $element.attr('name');
            if (name === 'content-' + this.uuid) {
                $element.attr('name', '');
            }
        }
    });
})(Redactor);
