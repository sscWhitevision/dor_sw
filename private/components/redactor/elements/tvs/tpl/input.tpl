<textarea id="tv{$tv->id}" class="red-richtext" name="tv{$tv->id}" tvtype="{$tv->type}">{$tv->get('value')|escape}</textarea>

<script type="text/javascript">
    // Prevent instantiating the editor more than once
    (function() {
        var init = false;
        MODx.on('ready', function(){
            if (init) {
                return;
            }

            // Load Redactor - we use MODx.loadRedactorConfigurationSet to make sure
            // it's redactor, and not another RTE, and provide the chosen configuration set..
            MODx.loadRedactorConfigurationSet('tv{$tv->id}', {$configSet});
            init = true;
        });
    })();
</script>