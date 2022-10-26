<div class="contentblocks-field contentblocks-field-table">
    <div class="contentblocks-field-actions"></div>

    <label>{%=o.name%}</label>
    {% if (o.content_desc) { %}
    <p class="content-field-description">{%=o.content_desc%}</p>
    {% } %}
    <div id="{%=o.generated_id%}-table" class="contentblocks-field-table-instance prevent-drag"></div>
</div>
