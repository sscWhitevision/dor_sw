<div id="tv-input-properties-form{$tv}"></div>

<div class="x-form-item">
    <label for="inopt_max_products" class="x-form-item-label">
        {$_lang['redactor.configuration_set'|escape:javascript]}</label>
    <div class="x-form-element">
        <select name="inopt_configuration_set" id="inopt_configuration_set"  class="x-form-text x-form-field">
        {foreach from=$configSets key=k item=v name='p'}
            <option value="{$k|escape}" {if $params.configuration_set eq $k}selected="selected"{/if}>
                {$v|escape}
            </option>
        {/foreach}
        </select>
    </div>
    <p class="desc-under">{$_lang['redactor.configuration_set_desc'|escape:javascript]}</p>
</div>
