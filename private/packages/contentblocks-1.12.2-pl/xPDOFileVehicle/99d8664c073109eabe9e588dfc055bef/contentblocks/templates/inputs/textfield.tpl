<div class="contentblocks-field contentblocks-field-text contentblocks-float-label">
    <div class="contentblocks-field-actions"></div>

    <div class="contentblocks-field-text contentblocks-field-text-input">
        <label for="{%=o.generated_id%}_textfield">{%=o.name%}</label>
        {% if (o.content_desc) { %}
        <p class="content-field-description">{%=o.content_desc%}</p>
        {% } %}
        <input type="text" id="{%=o.generated_id%}_textfield" placeholder=" " value="{%=o.value%}">
    </div>
</div>
