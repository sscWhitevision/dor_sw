<div class="color-picker-modal">
    <div class="half">
        <div id="color-picker-widget"></div>
    </div>
    <div class="half readout">
        <div class="swatchGrid" id="swatch-grid">
            {% if (o.properties.swatch1) { %}
            <div class="swatch" data-color="{%=o.properties.swatch1%}" style="background: {%=o.properties.swatch1%}"></div>
            {% } %}
            {% if (o.properties.swatch2) { %}
            <div class="swatch" data-color="{%=o.properties.swatch2%}" style="background: {%=o.properties.swatch2%}"></div>
            {% } %}
            {% if (o.properties.swatch3) { %}
            <div class="swatch" data-color="{%=o.properties.swatch3%}" style="background: {%=o.properties.swatch3%}"></div>
            {% } %}
            {% if (o.properties.swatch4) { %}
            <div class="swatch" data-color="{%=o.properties.swatch4%}" style="background: {%=o.properties.swatch4%}"></div>
            {% } %}
            {% if (o.properties.swatch5) { %}
            <div class="swatch" data-color="{%=o.properties.swatch5%}" style="background: {%=o.properties.swatch5%}"></div>
            {% } %}
            {% if (o.properties.swatch6) { %}
            <div class="swatch" data-color="{%=o.properties.swatch6%}" style="background: {%=o.properties.swatch6%}"></div>
            {% } %}
            {% if (o.properties.swatch7) { %}
            <div class="swatch" data-color="{%=o.properties.swatch7%}" style="background: {%=o.properties.swatch7%}"></div>
            {% } %}
            {% if (o.properties.swatch8) { %}
            <div class="swatch" data-color="{%=o.properties.swatch8%}" style="background: {%=o.properties.swatch8%}"></div>
            {% } %}

            {% if (o.properties.swatch9) { %}
            <div class="swatch" data-color="{%=o.properties.swatch9%}" style="background: {%=o.properties.swatch9%}"></div>
            {% } %}
            {% if (o.properties.swatch10) { %}
            <div class="swatch" data-color="{%=o.properties.swatch10%}" style="background: {%=o.properties.swatch10%}"></div>
            {% } %}
            {% if (o.properties.swatch11) { %}
            <div class="swatch" data-color="{%=o.properties.swatch11%}" style="background: {%=o.properties.swatch11%}"></div>
            {% } %}
            {% if (o.properties.swatch12) { %}
            <div class="swatch" data-color="{%=o.properties.swatch12%}" style="background: {%=o.properties.swatch12%}"></div>
            {% } %}
            {% if (o.properties.swatch13) { %}
            <div class="swatch" data-color="{%=o.properties.swatch13%}" style="background: {%=o.properties.swatch13%}"></div>
            {% } %}
            {% if (o.properties.swatch14) { %}
            <div class="swatch" data-color="{%=o.properties.swatch14%}" style="background: {%=o.properties.swatch14%}"></div>
            {% } %}
            {% if (o.properties.swatch15) { %}
            <div class="swatch" data-color="{%=o.properties.swatch15%}" style="background: {%=o.properties.swatch15%}"></div>
            {% } %}
            {% if (o.properties.swatch16) { %}
            <div class="swatch" data-color="{%=o.properties.swatch16%}" style="background: {%=o.properties.swatch16%}"></div>
            {% } %}
        </div>
        <div class="title">{%=_('contentblocks.color_picker.current')%}:</div>
        <div class="flex column">
            <div class="">
                <div id="selected-color" class="selected-color"></div>
            </div>
            <div class="values-wrap">
                hex: <input type="text" id="hex-input">
                <div id="values"></div>
            </div>
            <div class="color-picker-modal-buttons">
                <button class="contentblocks-field-button big cancel">{%=_('contentblocks.color_picker.cancel')%}</button>
                <button class="contentblocks-field-button big select"><i class="icon icon-check"></i>&nbsp;&nbsp;{%=_('contentblocks.color_picker.select')%}</button>
            </div>
        </div>

    </div>
</div>