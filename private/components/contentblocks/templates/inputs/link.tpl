<div class="contentblocks-field contentblocks-field-link">
    <div class="contentblocks-field-actions"></div>

    <div class="contentblocks-field-text contentblocks-field-link-input">
        <label for="{%=o.generated_id%}_link">{%=o.name%}</label>
        {% if (o.content_desc) { %}
        <p class="content-field-description">{%=o.content_desc%}</p>
        {% } %}
        <input type="text" placeholder="{%=_('contentblocks.link.placeholder')%}" id="{%=o.generated_id%}_linkfield" class="linkfield" value="{%#o.link%}" data-link-type="{%=o.linkType%}">
    </div>
</div>
