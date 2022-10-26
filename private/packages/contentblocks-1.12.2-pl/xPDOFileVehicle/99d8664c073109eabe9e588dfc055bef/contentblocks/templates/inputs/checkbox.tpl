<div class="contentblocks-field contentblocks-field-checkbox">
    <div class="contentblocks-field-actions"></div>
    <label for="{%=o.generated_id%}-checkbox">{%=o.name%}</label>
    {% if (o.content_desc) { %}
    <p class="content-field-description">{%=o.content_desc%}</p>
    {% } %}
    <input
            id="{%=o.generated_id%}-checkbox"
            type="checkbox"
            class="contentblocks-field-checkbox"
            data-id="{%=o.generated_id%}-checkbox"
            {%=o.checked%}
    >
</div>
