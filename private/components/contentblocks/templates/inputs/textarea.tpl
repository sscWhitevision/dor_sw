<div class="contentblocks-field contentblocks-field-textarea">
    <div class="contentblocks-field-actions"></div>

    <label for="{%=o.generated_id%}_textarea">{%=o.name%}</label>
    {% if (o.content_desc) { %}
    <p class="content-field-description">{%=o.content_desc%}</p>
    {% } %}
    <div class="contentblocks-field-textarea contentblocks-field-textarea-textarea">
        <textarea id="{%=o.generated_id%}_textarea">{%=o.value%}</textarea>
    </div>
</div>
