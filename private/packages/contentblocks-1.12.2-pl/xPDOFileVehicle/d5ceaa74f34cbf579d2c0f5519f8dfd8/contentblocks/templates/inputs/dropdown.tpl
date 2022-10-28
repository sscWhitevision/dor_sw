<div class="contentblocks-loader"></div>
<div class="contentblocks-field contentblocks-field-dropdown contentblocks-float-label">
    <div class="contentblocks-field-actions"></div>

    <div class="contentblocks-field-text contentblocks-field-dropdown-select">
        <label for="{%=o.generated_id%}_select">{%=o.name%}</label>
        {% if (o.content_desc) { %}
        <p class="content-field-description">{%=o.content_desc%}</p>
        {% } %}
        <select id="{%=o.generated_id%}_select" style="width: 100%;"></select>
    </div>
</div>
