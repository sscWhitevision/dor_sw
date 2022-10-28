<div class="contentblocks-field contentblocks-field-color-picker">
    <div class="contentblocks-field-actions"></div>
    <label for="{%=o.generated_id%}-color-picker-button">{%=o.name%}</label>
    {% if (o.content_desc) { %}
    <p class="content-field-description">{%=o.content_desc%}</p>
    {% } %}
    <button id="{%=o.generated_id%}-color-picker-button"
            class="field-color-picker-button"
            type="button"
            data-color="{%=o.value%}"
            style="background-color:{% if (o.value) { %}{%=o.value%}{% }else{ %}#fafafa{% }%};"
    >
        <span id="{%=o.generated_id%}-color-picker-code" class="color-picker-code">
            {% if (o.value) { %}
            {%=o.value%}
            {% } else { %}
            #fafafa
            {% } %}
        </span>
    </button>

</div>
