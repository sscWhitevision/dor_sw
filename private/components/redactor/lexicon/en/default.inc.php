<?php

$_lang['redactor.configuration'] = 'Redactor Configuration';
$_lang['redactor.configuration.menu_desc'] = 'Manage the configuration sets for your rich text editor.';

$_lang['redactor.group.toolbar'] = 'Toolbar';
$_lang['redactor.group.appearance'] = 'Appearance';
$_lang['redactor.group.clean'] = 'Cleanup';
$_lang['redactor.group.formatting'] = 'Formatting';
$_lang['redactor.group.media'] = 'Media';
$_lang['redactor.group.media_uploads'] = '- Uploads';
$_lang['redactor.group.media_simplebrowser'] = '- Simple Browser';
$_lang['redactor.group.media_modxbrowser'] = '- MODX Browser';
$_lang['redactor.group.link'] = 'Links';
$_lang['redactor.group.link_resource'] = '- Resources';
$_lang['redactor.group.link_autoparse'] = '- Autoparse';
$_lang['redactor.group.utilities'] = 'Text Utilities';
$_lang['redactor.group.misc'] = 'Miscellaneous';
$_lang['redactor.group.source'] = 'Source';

$_lang['redactor.buttons'] = 'Toolbar Buttons';
$_lang['redactor.buttons.desc'] = 'The buttons to show on the toolbar, as a comma-separated list. The order in which you name the buttons determines their position in the toolbar.
<a href="https://docs.modmore.com/en/Redactor/v3.x/Features/Toolbar.html" target="_blank" rel="noopener">Learn more</a>
<br>
<br><b>Formatting and text</b>: <code>format, bold, italic, deleted, underline, sup, sub, fontcolor, fontfamily, fontsize, inlinestyle, textdirection, alignment</code>
<br><b>Lists</b>: <code>lists, ol, ul, indent, outdent</code>
<br><b>Media</b>: <code>link, image, file, video, widget</code>
<br><b>Editor</b>: <code>redo, undo, fullscreen, divider, download</code>
<br><b>Others</b>: <code>html, line, properties, specialchars, table, toggledark</code>';
$_lang['redactor.buttonsTextLabeled'] = 'Prefer text buttons';
$_lang['redactor.buttonsTextLabeled.desc'] = 'Use textual labels instead of icons for the toolbar buttons. Some buttons, such as bold and italics, will still use an icon.';
$_lang['redactor.formatting'] = 'Formatting options';
$_lang['redactor.formatting.desc'] = 'List of tags to offer in the <code>format</code> dropdown. This can contain the following tags: <code>p, blockquote, pre, h1, h2, h3, h4, h5, h6</code>. For other tags, including custom classes, see custom formatting below, or add <code>properties</code> to your toolbar buttons.';
$_lang['redactor.formattingAdd'] = 'Custom formatting';
$_lang['redactor.formattingAdd.desc'] = 'Custom formatting options in JSON object format. Example: <br>
<code>{
    "info-callout": {
        "title": "Info callout",
        "api": "module.block.format",
        "args": {
            "tag": "div",
            "class": "callout callout__info"
        }
    }
}
</code>
<br>
<a href="https://docs.modmore.com/en/Redactor/v3.x/Features/Custom_Formatting.html" target="_blank" rel="noopener">Learn more in the documentation</a>';
$_lang['redactor.air'] = 'Use Air Mode';
$_lang['redactor.air.desc'] = 'Only show a floating toolbar when selecting part of the content. This is useful if you only need basic formatting in the editor (e.g. in the introtext, or in a ContentBlocks field) and want to hide the toolbar until it is needed.';
$_lang['redactor.toolbar'] = 'Show Toolbar';
$_lang['redactor.toolbar.desc'] = 'Disable to hide the toolbar, so that you can only use shortcuts. Makes for a very minimalistic experience!';
$_lang['redactor.toolbarContext'] = 'Context Toolbar';
$_lang['redactor.toolbarContext.desc'] = 'Show a contextual toolbar when selecting interactive elements like links and images.';

$_lang['redactor.lang'] = 'Language';
$_lang['redactor.lang.desc'] = 'The language to use for the editor. When left empty, this will use the current manager language.';
$_lang['redactor.theme'] = 'Toolbar theme';
$_lang['redactor.theme.desc'] = 'The theme to use for the toolbar. Custom themes can be created with CSS. Available themes: <code>default</code>, <code>redactor2</code>, <code>dark</code>, <code>minimal</code>, <code>pride</code>, <code>rebeccapurple</code>.
<br><br>Add <code>toggledark</code> to your Toolbar Buttons to switch between dark mode dynamically. <a href="https://docs.modmore.com/en/Redactor/v3.x/Themes/index.html" target="_blank" rel="noopener">Learn more</a>
';
$_lang['redactor.minHeight'] = 'Minimum Height';
$_lang['redactor.minHeight.desc'] = 'In pixels.';
$_lang['redactor.maxHeight'] = 'Maximum Height';
$_lang['redactor.maxHeight.desc'] = 'When this height (in pixels) is exceeded, a vertical scrollbar will be added in the editor. Useful for configuration sets used in modal windows.';
$_lang['redactor.maxWidth'] = 'Maximum Width';
$_lang['redactor.maxWidth.desc'] = 'When set to a width (in pixels), the content in Redactor will be restricted to this width.';
$_lang['redactor.animation'] = 'Use animations';
$_lang['redactor.animation.desc'] = 'Animations are used to smoothly open/hide dropdowns, the air toolbar, and modal windows. When disabled, they open instantly.';
$_lang['redactor.structure'] = 'Show structure';
$_lang['redactor.structure.desc'] = 'Add a subtle indication of the type of headings and other types of tags inserted in the content.';
$_lang['redactor.structureTheme'] = 'Structure theme';
$_lang['redactor.structureTheme.desc'] = 'Choose one of the available themes for the structure feature. To customise structures further, use <a href="https://docs.modmore.com/en/Redactor/v3.x/Features/Custom_CSS.html" target="_blank" rel="noopener">custom CSS</a>.';
$_lang['redactor.structureTheme.default'] = 'Default (subtle labels)';
$_lang['redactor.structureTheme.gutter'] = 'Gutter (small sidebar)';
$_lang['redactor.structureTheme.blocks'] = 'Blocks (distinct sections)';
$_lang['redactor.counter'] = 'Show word/character count';
$_lang['redactor.counter.desc'] = 'Adds a subtle footer to the editor showing the total number of words and characters in the content.';
$_lang['redactor.source'] = 'Allow source mode';
$_lang['redactor.source.desc'] = 'Allows the <code>html</code> button in the toolbar to edit the content in source mode. <a href="https://docs.modmore.com/en/Redactor/v3.x/Features/Source.html" target="_blank" rel="noopener">Learn more about source mode</a>';
$_lang['redactor.sourceBeautify'] = 'Beautify source code';
$_lang['redactor.sourceBeautify.desc'] = 'Automatically beautify (reformat) the source code for the content. Runs every few seconds while editing, and when toggling between source and visual mode. Make sure <em>Remove new lines</em> in the Cleanup section is disabled.';
$_lang['redactor.showSource'] = 'Open in source mode';
$_lang['redactor.showSource.desc'] = 'Open the content in source mode by default.';
$_lang['redactor.sourceCodemirror'] = 'Enable CodeMirror';
$_lang['redactor.sourceCodemirror.desc'] = 'When checked, CodeMirror will be used to improve code editing in source mode.';
$_lang['redactor.stylesClass'] = 'Content style class';
$_lang['redactor.stylesClass.desc'] = 'Set to a class name to use for the content inside Redactor. This is used as a theme for basic content styling, which can be made to match your front-end.';
$_lang['redactor.direction'] = 'Text Direction';
$_lang['redactor.direction.ltr'] = 'Left-to-right';
$_lang['redactor.direction.rtl'] = 'Right-to-left';
$_lang['redactor.direction.desc'] = 'Either <code>ltr</code> or <code>rtl</code> for right-to-left text.';

$_lang['redactor.cleanOnEnter'] = 'Cleanup on enter';
$_lang['redactor.cleanOnEnter.desc'] = 'When enabled, <code>class</code> and <code>style</code> attributes from a previous tag are not inherited when starting a new line.';
$_lang['redactor.cleanInlineOnEnter'] = 'Cleanup inline on enter';
$_lang['redactor.cleanInlineOnEnter.desc'] = 'Keep inline tags (with styles) when starting a new line.';
$_lang['redactor.removeScript'] = 'Remove script tags';
$_lang['redactor.removeScript.desc'] = 'Removes <code>script</code> tags in the content. Recommended.';
$_lang['redactor.removeNewLines'] = 'Remove new lines';
$_lang['redactor.removeNewLines.desc'] = 'Remove new lines between tags in the source code.';
$_lang['redactor.removeComments'] = 'Remove comments';
$_lang['redactor.removeComments.desc'] = 'Removes HTML comments from the content.';
$_lang['redactor.pasteClean'] = 'Cleanup on paste';
$_lang['redactor.pasteClean.desc'] = 'Run cleanup rules on pasted content.';
$_lang['redactor.pastePlainText'] = 'Paste as plaintext';
$_lang['redactor.pastePlainText.desc'] = 'Restrict the pasted content to plaintext, removing all tags and formatting except images and links. Images and links can be controlled separately below.';
$_lang['redactor.pasteLinks'] = 'Paste links';
$_lang['redactor.pasteLinks.desc'] = 'Allow links to be kept in pasted content.';
$_lang['redactor.pasteLinkTarget'] = 'Pasted link target';
$_lang['redactor.pasteLinkTarget.desc'] = 'Apply a target to all pasted links, such as <code>_blank</code>.';
$_lang['redactor.pasteImages'] = 'Paste images';
$_lang['redactor.pasteImages.desc'] = 'Allow images to be kept in pasted content.';
$_lang['redactor.pasteBlockTags'] = 'Allowed block tags in paste';
$_lang['redactor.pasteBlockTags.desc'] = 'The block-level tags that will be kept in pasted content. Can only contain tags from this list: <code>pre, h1, h2, h3, h4, h5, h6, table, tbody, thead, tfoot, th, tr, td, ul, ol, li, blockquote, p, figure, figcaption</code>';
$_lang['redactor.pasteInlineTags'] = 'Allowed inline tags in paste';
$_lang['redactor.pasteInlineTags.desc'] = 'The inline-level tags that will be kept in pasted content. Can only contain tags from this list: <code>a, img, br, strong, ins, code, del, span, samp, kbd, sup, sub, mark, var, cite, small, b, u, em, i</code>';
$_lang['redactor.pasteKeepStyle'] = 'Keep style for';
$_lang['redactor.pasteKeepStyle.desc'] = 'Comma separated list of tags for which the <code>style</code> attribute will be kept on paste.';
$_lang['redactor.pasteKeepClass'] = 'Keep class for';
$_lang['redactor.pasteKeepClass.desc'] = 'Comma separated list of tags for which the <code>class</code> attribute will be kept on paste.';
$_lang['redactor.pasteKeepAttrs'] = 'Keep attributes for';
$_lang['redactor.pasteKeepAttrs.desc'] = 'Comma separated list of tags for which attributes (except <code>style</code> and <code>class</code>, see other options) will be kept on paste.';

$_lang['redactor.markup'] = 'Paragraph markup';
$_lang['redactor.markup.desc'] = 'The tag to use for paragraphs. Usually <code>p</code>, but can also be set to <code>div</code> for example.';
$_lang['redactor.breakline'] = 'Use breaklines';
$_lang['redactor.breakline.desc'] = 'Use <code>br</code> tags when entering new lines, rather than creating new paragraphs.';
$_lang['redactor.enterKey'] = 'Allow enter key';
$_lang['redactor.enterKey.desc'] = 'Allow the use of the enter key to add new lines (paragraphs).';
$_lang['redactor.preClass'] = '<code>pre</code> class';
$_lang['redactor.preClass.desc'] = 'Class, or classes, to add to <code>pre</code> tags. Useful for syntax highlighting.';
$_lang['redactor.preSpaces'] = 'Spaces in <code>pre</code>';
$_lang['redactor.preSpaces.desc'] = 'The number of spaces to apply when a user presses tab inside a <code>pre</code> block, or 0 to apply actual tabs.';
$_lang['redactor.tabAsSpaces'] = 'Spaces for tab';
$_lang['redactor.tabAsSpaces.desc'] = 'The number of spaces to use for a tab, or 0 to apply actual tabs.';
$_lang['redactor.fontcolors'] = 'Font Colors';
$_lang['redactor.fontcolors.desc'] = 'If the <code>fontcolor</code> button is added to the toolbar, you can change the available colors here. Each option is comma separated and needs to be a valid hex or CSS color name. 11 colors fit per row in the color picker.';
$_lang['redactor.fontfamily'] = 'Font Family options';
$_lang['redactor.fontfamily.desc'] = 'If the <code>fontfamily</code> button is added to the toolbar, the fonts provided here are available in the dropdown.';

$_lang['redactor.imageFigure'] = 'Use <code>figure</code> tags';
$_lang['redactor.imageFigure.desc'] = 'Wrap images inside a <code>figure</code> tag, also allowing <code>figcaption</code> when "Add image captions" is enabled.';
$_lang['redactor.imageCaption'] = 'Add image captions';
$_lang['redactor.imageCaption.desc'] = 'Adds a caption field when editing images, which will be written to a <code>figcaption</code> tag.';
$_lang['redactor.imagePosition'] = 'Image positioning';
$_lang['redactor.imagePosition.desc'] = 'Adds float-based image positioning options to an image. Also see the image float margin option.';
$_lang['redactor.imageFloatMargin'] = 'Image float margin';
$_lang['redactor.imageFloatMargin.desc'] = 'The margin to add to an image when its position is floated. This is automatically applied to the sides of the image that may touch text otherwise, for example the left and bottom when an image is floating right.';
$_lang['redactor.imageEditable'] = 'Editable images';
$_lang['redactor.imageStyles'] = 'Image Styles';
$_lang['redactor.imageStyles.desc'] = 'Allows the editor to select an image style (read: a CSS class) to an image. <a href="https://docs.modmore.com/en/Redactor/v3.x/Features/Image_Styles.html" target="_blank" rel="noopener">Learn more about image styles</a>.
<br><br>Provide a JSON structure like this: <code>[{"value":"special_image", "label": "Special Image"}]</code>
<br><br>To change the image styling in the editor, <a href="https://docs.modmore.com/en/Redactor/v3.x/Features/Custom_CSS.html" target="_blank" rel="noopener">register a custom CSS file</a>.';
$_lang['redactor.baseurlsMode'] = 'Image Path Mode (Base URLs)';
$_lang['redactor.baseurlsMode.desc'] = 'Redactor normalises image urls when saving based on the mode you select here. If your template includes a <code>&lt;base href=""&gt;</code> tag, relative is recommended for most portability. On sites with multiple contexts, <code>root-relative</code> or <code>absolute</code> are better.
<a href="https://docs.modmore.com/en/Redactor/v3.x/Features/Image_Path_Mode.html" target="_blank" rel="noopener">Learn more</a>
<br>
<br><b>Relative</b>: most portable, but requires you a base href in your template. Example: <code>uploads/image.jpg</code>
<br><b>Absolute</b>: prefixes the base url for the site, making it not portable for sites or contexts in subdirectories. Example: <code>/modx/uploads/image.jpg</code>
<br><b>Full</b>: prefixes the full site url for the site, making it not portable at all. Example: <code>https://site.com/modx/uploads/image.jpg</code>
<br><b>Root-relative</b>: for use with contexts that each have their own physical directory, served from the root of their (sub)domain. This prefixes the image url with a slash regardless of the base url. Example: <code>/uploads/image.jpg</code>
<br>
<br>In the configurator, you may need to first save the configuration and reload the page for the mode to properly work.';
$_lang['redactor.baseurlsMode.relative'] = 'Relative';
$_lang['redactor.baseurlsMode.absolute'] = 'Absolute';
$_lang['redactor.baseurlsMode.full'] = 'Full';
$_lang['redactor.baseurlsMode.root-relative'] = 'Root relative';

$_lang['redactor.imageSimpleBrowser'] = 'Enable Simple Browser for Images';
$_lang['redactor.imageSimpleBrowser.desc'] = 'Shows a simple "Choose" tab allowing you to browse for images within the specified media source and directory.';
$_lang['redactor.imageSimpleBrowserSource'] = 'Simple Image Browser Media Source';
$_lang['redactor.imageSimpleBrowserSource.desc'] = 'The media source to use for the simple image media browser. Note: requires saving the configuration before the preview is affected.';
$_lang['redactor.imageSimpleBrowserPath'] = 'Simple Image Browser Path';
$_lang['redactor.imageSimpleBrowserPath.desc'] = 'The path relative to the root of the provided media source to restrict the simple browser to. Note: requires saving the configuration before the preview is affected.';
$_lang['redactor.fileSimpleBrowser'] = 'Enable Simple Browser for Files';
$_lang['redactor.fileSimpleBrowser.desc'] = 'Shows a simple "Choose" tab allowing you to browse for files within the specified media source and directory.';
$_lang['redactor.fileSimpleBrowserSource'] = 'Simple File Browser Media Source';
$_lang['redactor.fileSimpleBrowserSource.desc'] = 'The media source to use for the simple file media browser. Note: requires saving the configuration before the preview is affected.';
$_lang['redactor.fileSimpleBrowserPath'] = 'Simple File Browser Path';
$_lang['redactor.fileSimpleBrowserPath.desc'] = 'The path relative to the root of the provided media source to restrict the simple browser to. Note: requires saving the configuration before the preview is affected.';
$_lang['redactor.simpleBrowserDirectoryDepth'] = 'Directory Depth';
$_lang['redactor.simpleBrowserDirectoryDepth.desc'] = 'How many levels to traverse the configured path. A higher number cause loading the directories to take longer, while a lower number may cause certain directories to be unavailable. Affects both the browser for images and files. Save the configuration set for this to take effect. Directories are cached for 5 minutes.';
$_lang['redactor.imageMODXBrowser'] = 'Enable MODX Browser for Images';
$_lang['redactor.imageMODXBrowser.desc'] = 'Allows using the standard MODX Media browser to select (and upload) images through a "Browse Images" button when choosing to insert an image.';
$_lang['redactor.imageMODXBrowserSource'] = 'Image Media Source';
$_lang['redactor.imageMODXBrowserSource.desc'] = 'The media source to open by default when using the MODX browser to select an image. Note that the MODX browser allows the user to switch to other media sources. To prevent users from accessing other media sources, use the MODX permissions system.';
$_lang['redactor.imageMODXBrowser.desc'] = 'Allows using the standard MODX Media browser to select (and upload) images through a "Browse Images" button when choosing to insert an image.';
$_lang['redactor.imageMODXBrowserPath'] = 'Image relative path';
$_lang['redactor.imageMODXBrowserPath.desc'] = 'The path relative to the root of the provided media source to open by default. Note that the user may navigate outside of this path.';
$_lang['redactor.fileMODXBrowser'] = 'Enable MODX Browser for Files';
$_lang['redactor.fileMODXBrowser.desc'] = 'Allows using the standard MODX Media browser to select (and upload) files through a "Browse Files" button when choosing to insert a file.';
$_lang['redactor.fileMODXBrowserSource'] = 'Default File Media Source';
$_lang['redactor.fileMODXBrowserSource.desc'] = 'The media source to open by default when using the MODX browser to select a file. Note that the MODX browser allows the user to switch to other media sources. To prevent users from accessing other media sources, use the MODX permissions system.';
$_lang['redactor.fileMODXBrowserPath'] = 'File relative path';
$_lang['redactor.fileMODXBrowserPath.desc'] = 'The path relative to the root of the provided media source to open by default. Note that the user may navigate outside of this path.';

$_lang['redactor.imageResizable'] = 'Resizable images';
$_lang['redactor.imageResizable.desc'] = 'Allows resizing images after clicking it in the content.';

$_lang['redactor.imageUploadSource'] = 'Image Upload Source';
$_lang['redactor.imageUploadSource.desc'] = 'The media source to use for uploading images.';
$_lang['redactor.imageUploadPath'] = 'Image Upload Path';
$_lang['redactor.imageUploadPath.desc'] = 'The path, relative to the root of the media source, that images should be uploaded to. Save the configuration for this option to take effect. Placeholders can be used to automatically organise uploads:
<br>
<br><b>Date & time:</b> <code>[[+year]]</code>, <code>[[+month]]</code>, <code>[[+day]]</code>
<br><b>User:</b> <code>[[+user]]</code> (ID), <code>[[+username]]</code>
<br><b>Settings:</b> <code>[[++assets_url]]</code>, <code>[[++site_url]]</code>, <code>[[++base_url]]</code>
<br><b>Resource*:</b> any resource field, e.g. <code>[[+id]]</code>, <code>[[+alias]]</code>, <code>[[+uri]]</code>
<br><b>Parent resource*:</b> <code>[[+parent]]</code> (ID), <code>[[+parent_alias]]</code>, <code>[[+ultimate_parent]]</code> (ID), <code>[[+ultimate_parent_alias]]</code>
<br>
<br>* Resource placeholders may not work in the configurator, third party components, or on new resources that have not been saved yet. In such cases, the placeholder is removed.';
$_lang['redactor.fileUploadSource'] = 'File Upload Source';
$_lang['redactor.fileUploadSource.desc'] = 'The media source to use for uploading files.';
$_lang['redactor.fileUploadPath'] = 'File Upload Path';
$_lang['redactor.fileUploadPath.desc'] = 'Path relative to the root of the media source that files should be uploaded to. Save the configuration for this option to take effect. See <em>Image Upload Path</em> above for available placeholders.';
$_lang['redactor.uploadCleanFilenames'] = 'Clean filenames';
$_lang['redactor.uploadCleanFilenames.desc'] = 'Sanitizes the file name. This uses transliteration (if enabled) and regex replacements. To fine-tune the cleaning, adjust the redactor.sanitize_replace and redactor.sanitize_pattern system settings.';
$_lang['redactor.uploadIncrementFilenames'] = 'Add increment to filenames';
$_lang['redactor.uploadIncrementFilenames.desc'] = 'When enabled, uploads to a File media source will be suffixed with an incrementing number, instead of overwriting files with the same name.';
$_lang['redactor.dragUpload'] = 'Allow drag & drop uploads';
$_lang['redactor.dragUpload.desc'] = 'Lets users drag files directly into the editor without using the insert image window.';
$_lang['redactor.clipboardUpload'] = 'Allow paste (clipboard) uploads';
$_lang['redactor.clipboardUpload.desc'] = 'Uploads images that are pasted into the editor.';

$_lang['redactor.linkTitle'] = 'Use link title';
$_lang['redactor.linkTitle.desc'] = 'Adds the ability to set a title when inserting or editing a link.';
$_lang['redactor.linkNewTab'] = 'Add new tab checkbox';
$_lang['redactor.linkNewTab.desc'] = 'Adds a checkbox to links to make them open in new tabs/windows.';
$_lang['redactor.linkNofollow'] = 'Add <code>nofollow</code> to links';
$_lang['redactor.linkNofollow.desc'] = 'Adds a <code>rel="nofollow"</code> attribute to <b>all links in the content</b> to instruct search engines to not follow the link.';
$_lang['redactor.linkToAnchor'] = 'Use anchor links';
$_lang['redactor.linkToAnchor.desc'] = 'When enabled, you can link to anchors when adding links. To add anchors into your content, you can use the "properties" toolbar button.';
$_lang['redactor.linkStyles'] = 'Link Styles';
$_lang['redactor.linkStyles.desc'] = 'Allows the editor to select a link style (read: a CSS class) to a link. <a href="https://docs.modmore.com/en/Redactor/v3.x/Features/Link_Styles.html" target="_blank" rel="noopener">Learn more about link styles</a>.
<br><br>Provide a JSON structure like this: <code>[{"value":"external", "label": "External Link"}]</code>
<br><br>To change the styling of a link in the editor, <a href="https://docs.modmore.com/en/Redactor/v3.x/Features/Custom_CSS.html" target="_blank" rel="noopener">register a custom CSS file</a>.';
$_lang['redactor.linkSize'] = 'Link text length';
$_lang['redactor.linkSize.desc'] = 'The maximum number of characters that will be used for the link text of an autoparsed link.';
$_lang['redactor.linkValidation'] = 'Link validation';
$_lang['redactor.linkValidation.desc'] = 'Makes sure a link has a protocol (<code>http://</code> or <code>mailto:</code>) when inserted or edited.';
$_lang['redactor.linkResourceLimitToContext'] = 'Limit to current context';
$_lang['redactor.linkResourceLimitToContext.desc'] = 'Limits search results for resources to the current context. Save the configuration for this to take effect. In non-resource uses, this will restrict to the "web" context.';
$_lang['redactor.linkResourceIncludeIntrotext'] = 'Include introtext';
$_lang['redactor.linkResourceIncludeIntrotext.desc'] = 'Shows the introtext for resource search results. Save the configuration for this to take effect.';
$_lang['redactor.definedlinks'] = 'Predefined Links';
$_lang['redactor.definedlinks.desc'] = 'Adds a dropdown to the link window to quickly insert common links. Needs to be defined in JSON, as an array of objects, each with the key <code>name</code> and <code>url</code>. For example: <code>[
    { "name": "Select...", "url": false },
    { "name": "Google", "url": "https://google.com" }
]</code>';
$_lang['redactor.autoparse'] = 'Autoparse';
$_lang['redactor.autoparse.desc'] = 'Allow Redactor to automatically turn links to video (YouTube/Vimeo), image URLs, and text URls into clickable links. Can be fine tuned with the autoparse options for links, images, and videos below.';
$_lang['redactor.autoparseLinks'] = 'Autoparse Links';
$_lang['redactor.autoparseLinks.desc'] = 'Automatically inserts a link when a full URL is pasted into the content.';
$_lang['redactor.autoparseImages'] = 'Autoparse Images';
$_lang['redactor.autoparseImages.desc'] = 'Automatically inserts a proper image when a full link URL (including domain) is pasted into the content.';
$_lang['redactor.autoparseVideo'] = 'Autoparse Video';
$_lang['redactor.autoparseVideo.desc'] = 'Automatically inserts the proper video embed code when a URL to a video on YouTube or Vimeo is pasted into the content. Make sure the video privacy allows it to be embedded.';

$_lang['redactor.limiter'] = 'Maximum content length';
$_lang['redactor.limiter.desc'] = 'Limits the content to the number of characters you set. Combine with the <em>Show word/character count</em> option under <em>Appearance</em>.';
$_lang['redactor.clips'] = 'Clips';
$_lang['redactor.clips.desc'] = 'Pre-defined special characters or (small) blocks of content to insert at a single click. Inserted content can be edited and is subject to regular cleanup rules. This needs to be defined as a JSON array of arrays, where the first element is the label of the clip in the modal window, and the second element is the HTML to insert. For example: <code>[ ["Lipsum", "&lt;p&gt;Lorem &lt;b&gt;ipsum&lt;/b&gt; dolor sit amet&lt;/p&gt;"], ["Foo", "&lt;div&gt;foo bar baz&lt;/div&gt;"] ]</code>
<br><br>You can also use the syntax from Redactor v2, which will be automatically converted.  <a href="https://docs.modmore.com/en/Redactor/v3.x/Features/Clips.html" target="_blank" rel="noopener">Learn more</a>';
$_lang['redactor.textexpander'] = 'Text expander';
$_lang['redactor.textexpander.desc'] = 'Lets you define text shortcuts that get expanded to longer content when following it with a space. Useful for common predefined text. Needs to be defined as a JSON array of arrays where the first element is the shortcut, and the second element the text to insert. For example: <code>[ ["lipsum", "Lorem ipsum dolor sit amet"] ]</code>. <a href="https://docs.modmore.com/en/Redactor/v3.x/Features/Text_Expander.html" target="_blank" rel="noopener">Learn more</a>';
$_lang['redactor.variables'] = 'Variables';
$_lang['redactor.variables.desc'] = 'Special elements that are non-editable once inserted into the content. Separate multiple variables with a comma. <a href="https://docs.modmore.com/en/Redactor/v3.x/Features/Variables.html" target="_blank" rel="noopener">Learn more</a>';
$_lang['redactor.placeholder'] = 'Placeholder text';
$_lang['redactor.placeholder.desc'] = 'Dummy text to show as placeholder when the content is empty.';

$_lang['redactor.spellcheck'] = 'Allow spellcheck';
$_lang['redactor.spellcheck.desc'] = 'Allow native spellcheckers, integrated in browsers, to check the content in Redactor for spelling and grammar.';
$_lang['redactor.grammarly'] = 'Allow Grammerly spellcheck';
$_lang['redactor.grammarly.desc'] = 'Allow the Grammarly spell checker browser plugin to be used with the editor.';
$_lang['redactor.tabKey'] = 'Tab handling';
$_lang['redactor.tabKey.desc'] = 'When enabled tabs will be inserted into content. When disabled, tab will instead move the focus to the next input on the page.';
$_lang['redactor.additionalPlugins'] = 'Additional Plugins';
$_lang['redactor.additionalPlugins.desc'] = 'Provide a comma-separated list of custom plugins to initialise. Add the necessary assets to the <code>redactor.js</code> and <code>redactor.css</code> system settings first. <a href="https://docs.modmore.com/en/Redactor/v3.x/Features/Custom_Plugins.html" target="_blank" rel="noopener">Learn more.</a>';

// CB Input Type
$_lang['redactor.input_name'] = 'Rich Text - Redactor';
$_lang['redactor.input_description'] = 'Adds a Redactor rich text editor field, optionally with a different configuration set to customise the editor experience.';

$_lang['redactor.file_err_ns'] = 'No file received. The chosen file was probably too large to be uploaded, and was rejected by the server. Try uploading a smaller version of the file or increase the server limits.';

// System settings
$_lang['area_advanced'] = 'Advanced Options';
$_lang['area_configuration'] = 'Configuration';

$_lang['setting_redactor.configuration_set'] = 'Configuration Set';
$_lang['setting_redactor.configuration_set_desc'] = 'The Redactor configuration set to use by default. Create context settings with the same key to override this per context. Learn more about the different ways to use Redactor in the documentation at https://docs.modmore.com/en/Redactor/v3.x/index.html';

$_lang['setting_redactor.introtext'] = 'Use Redactor for the introtext';
$_lang['setting_redactor.introtext_desc'] = 'When enabled, Redactor will be initialised on the resource introtext field. Add the desired configuration set to the redactor.introtext.configuration_set system setting.';
$_lang['setting_redactor.introtext.configuration_set'] = 'Introtext Configuration Set';
$_lang['setting_redactor.introtext.configuration_set_desc'] = 'Enter the ID of the configuration set to use for the resource introtext field. The ID can be found in Extras > Redactor Configuration. Only used if redactor.introtext is enabled.';

$_lang['setting_redactor.css'] = 'Custom CSS';
$_lang['setting_redactor.css_desc'] = 'Comma separated list of fully qualified URLs to CSS files to load in the manager. Use this for custom themes or styling the content in the manager to fit your front-end better.';

$_lang['setting_redactor.js'] = 'Custom JavaScript';
$_lang['setting_redactor.js_desc'] = 'Comma separated list of fully qualified URLs to JavaScript files to load in the manager. Use this to load custom Redactor plugins.';

$_lang['setting_redactor.sanitizeReplace'] = 'Sanitize Replace';
$_lang['setting_redactor.sanitizeReplace_desc'] = 'The replacement character used when sanitizing names of uploaded files.';
$_lang['setting_redactor.sanitizePattern'] = 'Sanitize Pattern';
$_lang['setting_redactor.sanitizePattern_desc'] = 'A RegEx pattern applied when sanitizing names of uploaded files.';

$_lang['setting_redactor.translit'] = 'Transliteration';
$_lang['setting_redactor.translit_desc'] = 'When set to a value that is not "none" or empty, this will enable transliteration as part of the filename sanitization process, allowing translating of complex characters to valid ones for files. If this value is empty, it will inherit from the core "friendly_alias_translit" setting.';
$_lang['setting_redactor.translit_class'] = 'Translit Class';
$_lang['setting_redactor.translit_class_desc'] = 'The name of the class to use for transliteration. If this value is empty, it will inherit from the core "friendly_alias_translit_class" setting.';
$_lang['setting_redactor.translit_class_path'] = 'Translit Class Path';
$_lang['setting_redactor.translit_class_path_desc'] = 'The path to the class to use for transliteration. If this value is empty, it will inherit from the core "friendly_alias_translit_class_path" setting.';
