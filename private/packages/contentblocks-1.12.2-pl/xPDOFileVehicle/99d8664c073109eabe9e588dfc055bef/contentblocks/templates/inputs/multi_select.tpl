<div class="contentblocks-loader"></div>
<div class="contentblocks-field contentblocks-field-multi-select contentblocks-float-label">
    <div class="contentblocks-field-actions"></div>

    <label for="{%=o.generated_id%}_select">{%=o.name%}</label>
    {% if (o.content_desc) { %}
    <p class="content-field-description">{%=o.content_desc%}</p>
    {% } %}
    <select multiple aria-multiselectable="true" style="width: 100%;" id="{%=o.generated_id%}_select"></select>
</div>
