<?php

switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:

        $note = '';
        if ($options[xPDOTransport::PACKAGE_ACTION] == xPDOTransport::ACTION_UPGRADE) {
            $note = '<p><b>Importan</b>t: if you choose layouts or fields during an upgrade or reinstall, this will create <em>new</em> layouts or fields, so you would end up with duplicates. Make sure that\'s what you want.</p>';
        }

$output = <<<HTML
<p>You're almost ready to start creating better content! To get you from zero to done as quickly as possible, you can choose to have some fields and layouts set up automatically during the installation process. Simply choose what you would like to install below, and you're ready to go. </p>

$note

<p><b>Layouts</b></p>
<p>Layouts are "rows" of content with one or more columns. You'll need these in order to start editing content. Choose one of the options below. </p>

<label>
    <input type="radio" name="contentblocks_layouts" value="" checked="checked">
    None
</label>
<label>
    <input type="radio" name="contentblocks_layouts" value="foundation5">
    Foundation (v4/5)
</label>
<label>
    <input type="radio" name="contentblocks_layouts" value="bootstrap3">
    Bootstrap (v3)
</label>


<p><b>Fields</b></p>
<p>If you want, we can install a basic set of fields which provides some default templates for the majority of the included input types so you can get started right away. </p>

<label>
    <input type="radio" name="contentblocks_fields" value="" checked="checked">
    None
</label>
<label>
    <input type="radio" name="contentblocks_fields" value="basic">
    Basic Set
</label>


HTML;
    break;
    default:
    case xPDOTransport::ACTION_UNINSTALL:
        $output = '';
    break;
}

return $output;
