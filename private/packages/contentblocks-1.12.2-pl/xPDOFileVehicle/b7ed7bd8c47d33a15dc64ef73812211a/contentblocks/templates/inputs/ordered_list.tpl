<div class="contentblocks-field contentblocks-field-list ordered">
    <div class="contentblocks-field-actions"></div>

    <label>{%=o.name%}</label>
    {% if (o.content_desc) { %}
    <p class="content-field-description">{%=o.content_desc%}</p>
    {% } %}
    <ul id="{%=o.generated_id%}-outer" class="contentblocks-field-list-outer"></ul>
</div>
