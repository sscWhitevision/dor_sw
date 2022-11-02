!function(l,s){s.fieldTypes.heading=function(i,o){var n={init:function(){var e,t=o.properties.available_levels||"h1=heading_1,h2=heading_2,h3=heading_3,h4=heading_4,h5=heading_5,h6=heading_6",n=i.find(".contentblocks-field-heading-level select"),t=t.split(",");l.each(t,function(e,t){t=t.split("=");var i=_("contentblocks."+t[1])||t[1];n.append('<option value="'+t[0]+'">'+i+"</option>")}),o.level?n.val(o.level):(e=o.properties.default_level||"h2",n.val(e)),s.toBoolean(o.properties.use_tinyrte)&&(e=i.find("#"+o.generated_id+"_input"),s.addTinyRte(e))},getData:function(){return{value:i.find(".contentblocks-field-heading-input input").val(),level:i.find(".contentblocks-field-heading-level select").val()}},confirmBeforeDelete:function(){var e=n.getData(),t=e.level!=o.properties.default_level,e=0<e.value.replace(/^\s\s*/,"").replace(/\s\s*$/,"").length;return t||e}};return n},s.fieldTypes.textarea=function(t,i){return{init:function(){var e;i.properties&&s.toBoolean(i.properties.use_tinyrte)?(e=t.find("#"+i.generated_id+"_textarea"),s.addTinyRte(e)):setTimeout(function(){window.autosize(t.find(".contentblocks-field-textarea textarea")).on("autosize:resized",s.fixColumnHeights)},100)},getData:function(){return{value:t.find(".contentblocks-field-textarea textarea").val()}}}},s.fieldTypes.richtext=function(t,e){return{init:function(){var e=t.find(".contentblocks-field-textarea textarea");MODx.loadRTE?(MODx.loadRTE(e.attr("id")),setTimeout(function(){s.fixColumnHeights()},100)):setTimeout(function(){window.autosize(e).on("autosize:resized",s.fixColumnHeights)},100),e.on("change",s.fixColumnHeights)},getData:function(){return{value:t.find(".contentblocks-field-textarea textarea").val()}}}},s.fieldTypes.textfield=function(t,i){return{init:function(){var e;s.toBoolean(i.properties.use_tinyrte)&&(e=t.find("#"+i.generated_id+"_textfield"),s.addTinyRte(e))},getData:function(){return{value:t.find(".contentblocks-field-text input").val()}}}},s.fieldTypes.quote=function(t,i){return{init:function(){var e;s.toBoolean(i.properties.use_tinyrte)?(e=t.find("#"+i.generated_id+"_quote"),s.addTinyRte(e)):setTimeout(function(){window.autosize(t.find(".contentblocks-field-textarea textarea")).on("autosize:resized",s.fixColumnHeights)},100),i.cite&&t.find(".contentblocks-field-text input").val(i.cite)},getData:function(){return{value:t.find(".contentblocks-field-textarea textarea").val(),cite:t.find(".contentblocks-field-text input").val()}}}}}(vcJquery,ContentBlocks),function(n){n.fieldTypes.link=function(t,e){var i={init:function(){n.initializeLinkField(t.find("input[id].linkfield"),e)},getData:function(){var e=t.find("input[id].linkfield");return{link:e.val(),linkType:n.getLinkFieldDataType(e.val())}}};return i}}((vcJquery,ContentBlocks)),function(o){o.fieldTypes.table=function(t,i){var n={table:!1,handsontable:!1,init:function(){this.table=t.find(".contentblocks-field-table-instance");var e={startRows:3,minSpareRows:1,minSpareCols:1,startCols:4,stretchH:"all",manualColumnMove:!0,enterBeginsEditing:!1,contextMenu:!0,autoWrapCol:!0,nativeScrollbars:!1,afterChange:function(){o.fireChange()},afterCreateRow:o.fixColumnHeights,afterRemoveRow:o.fixColumnHeights};i.value&&(e.data=i.value),this.table.handsontable(e),this.handsontable=this.table.handsontable("getInstance"),t.on("contentblocks:field_dragged",function(){n.handsontable.render()})},getData:function(){return{value:this.handsontable.getData()}}};return n}}((vcJquery,ContentBlocks)),vcJquery,ContentBlocks.fieldTypes.hr=function(e,t){var i={getData:function(){return{value:1}}};return i},function(o,l){l.fieldTypes.multi_select=function(t,i){var n={fieldId:i.field,select:null,options:{},init:function(){var e;t.addClass("contentblocks-field-loading"),i.settingType?(this.select=t.find("select"),e=i.value.split(","),n.select.select2({selectionCssClass:"contentblocks-multi-select",dropdownCssClass:"contentblocks-multi-select-dropdown"}).val(e).trigger("change")):(this.select=t.find(".contentblocks-field-multi-select select"),this.loadOptions()),t.removeClass("contentblocks-field-loading")},loadOptions:function(){var e;i.value&&((e=o("<option></option>")).attr("value",i.value),e.text(i.display||i.value),this.select.append(e),this.select.attr("disabled","disabled")),o.ajax({dataType:"json",url:ContentBlocksConfig.connectorUrl,data:{action:"content/multi_select/getlist",context:MODx.activePage.record?MODx.activePage.record.context_key:"web",field:n.fieldId,resource:MODx.request.id||0},context:this,beforeSend:function(e,t){t.crossDomain||e.setRequestHeader("modAuth",MODx.siteId)},success:function(e){e.results?(n.setOptions(e.results),this.optionsLoaded(),n.select.select2({selectionCssClass:"contentblocks-multi-select",dropdownCssClass:"contentblocks-multi-select-dropdown"})):l.alert(_("contentblocks.dropdown.none_available"))}})},setOptions:function(e){n.options=e,n.optionsLoaded()},optionsLoaded:function(){n.select.empty(),o.each(n.options,function(e,t){var i=o("<option></option>");i.attr("value",t.value),i.text(t.display),t.disabled&&i.attr("disabled","disabled"),n.select.append(i)}),i.value||(i.value=i.properties.default_value),i.value&&n.select.val(i.value),n.select.attr("disabled",null)},getData:function(){return{value:n.select.val()}}};return n}}(vcJquery,ContentBlocks),function(s,r){r.fieldTypes.image=function(o,n){var l={fieldDom:o.find(".contentblocks-field"),fileBrowser:!1,source:0<n.properties.source?n.properties.source:ContentBlocksConfig["image.source"],directory:n.properties.directory,cropData:n.crops||{},cropPreviews:o.find(".contentblocks-field-image-crop-previews"),openCropperAutomatically:r.toBoolean(n.properties.open_crops_automatically),init:function(){var e;n.url&&n.url.length&&(e=r.utilities.normaliseUrls(n.url),l.fieldDom.find(".url").val(e.cleanedSrc).change(),l.fieldDom.find(".size").val(n.size),l.fieldDom.find(".width").val(n.width),l.fieldDom.find(".height").val(n.height),l.fieldDom.find(".extension").val(n.extension),l.fieldDom.find(".source").val(n.source),l.fieldDom.find("img.contentblocks-field-image-preview-img").attr("src",l.getThumbnailPreview(n.url)),l.fieldDom.addClass("preview"),l.initCropPreviews()),n.properties.crops&&0!==n.properties.crops.length?(l.fieldDom.find(".contentblocks-field-crop-image").on("click",l.openCropper),l.fieldDom.on("click",".contentblocks-field-image-crop-preview",function(e){var t=s(this).data("key");l.openCropper(e,t)})):l.fieldDom.find(".contentblocks-field-crop-image").hide(),o.find(".contentblocks-field-delete-image").on("click",function(){l.fieldDom.removeClass("preview"),l.fieldDom.find(".url").val("").change(),l.fieldDom.find(".size").val(""),l.fieldDom.find(".width").val(""),l.fieldDom.find(".height").val(""),l.fieldDom.find(".extension").val(""),l.fieldDom.find(".source").val(""),l.fieldDom.find("img.contentblocks-field-image-preview-img").attr("src",""),l.cropData=n.crops={},l.cropPreviews.empty(),r.fixColumnHeights(),r.fireChange()}),l.fieldDom.find(".contentblocks-field-upload").on("click",function(){l.fieldDom.find(".contentblocks-field-upload-field").click()}),l.fieldDom.find(".contentblocks-field-image-choose").on("click",s.proxy(function(){this.chooseImage()},this)),l.fieldDom.find(".contentblocks-field-image-url").on("click",s.proxy(function(){this.promptImage()},this)),this.initUpload(),this.initDropReceiver()},getThumbnailPreview:function(e){return n.properties.thumbnail_crop&&l.cropData[n.properties.thumbnail_crop]&&l.cropData[n.properties.thumbnail_crop].url?l.cropData[n.properties.thumbnail_crop].url:n.properties.thumbnail_size?r.utilities.getThumbnailUrl(e,n.properties.thumbnail_size):r.utilities.normaliseUrls(e).displaySrc},initDropReceiver:function(){MODx.load({xtype:"modx-treedrop",target:l.fieldDom,targetEl:l.fieldDom.get(0),onInsert:function(e){l.insertFromUrl(e)}})},initUpload:function(){var e=o.attr("id");l.fieldDom.find("#"+e+"-upload").fileupload({url:ContentBlocksConfig.connectorUrl+"?action=content/image/upload",dataType:"json",dropZone:l.fieldDom,progressInterval:250,paramName:"file",pasteZone:null,add:function(e,t){var i;r.fireChange(),l.fieldDom.addClass("uploading"),t.files[0].ext=t.files[0].name.split(".").pop(),t.files[0].size<7e5&&window.FileReader&&((i=new FileReader).onload=function(e){l.fieldDom.find("img.contentblocks-field-image-preview-img").attr("src",e.target.result),r.fixColumnHeights()},i.readAsDataURL(t.files[0])),setTimeout(function(){t.submit()},1e3)},done:function(e,t){var i,n;t.result.success?(n=t.result.object,i=r.utilities.normaliseUrls(n.url),l.fieldDom.find(".url").val(i.cleanedSrc).change(),l.fieldDom.find(".size").val(n.size),l.fieldDom.find(".width").val(n.width),l.fieldDom.find(".height").val(n.height),l.fieldDom.find(".extension").val(n.extension),l.fieldDom.find(".source").val(n.source),l.fieldDom.find("img.contentblocks-field-image-preview-img").attr("src",l.getThumbnailPreview(n.url)),l.fieldDom.addClass("preview"),l.loadTinyRTE(),l.openCropperAutomatically&&l.openCropper()):(n=_("contentblocks.upload_error",{file:t.files[0].filename,message:t.result.message}),1572864<t.files[0].size&&(n+=_("contentblocks.upload_error.file_too_big")),r.alert(n),l.fieldDom.find("img.contentblocks-field-image-preview-img").attr("src","")),l.fieldDom.removeClass("uploading"),setTimeout(function(){r.fixColumnHeights(o.parents(".contentblocks-region-content"))},150)},fail:function(e,t){var i=_("contentblocks.upload_error",{file:t.files[0].filename,message:t.result.message});1572864<t.files[0].size&&(i+=_("contentblocks.upload_error.file_too_big")),r.alert(i),l.fieldDom.removeClass("uploading"),l.fieldDom.find("img.contentblocks-field-image-preview-img").attr("src",""),r.fixColumnHeights(o.parents(".contentblocks-region-content"))},formData:function(){var e=[{name:"HTTP_MODAUTH",value:MODx.siteId},{name:"resource",value:MODx.request.id||0},{name:"field",value:n.id}];return n.settingKey&&e.push({name:"setting_key",value:n.settingKey}),n.layout&&e.push({name:"layout",value:n.layout}),e},progress:function(e,t){t=parseInt(t.loaded/t.total*100,10)+"%";l.fieldDom.find(".upload-progress .bar").width(t)}})},chooseImage:function(){var e=MODx.load({xtype:"modx-browser",id:Ext.id(),multiple:!0,listeners:{select:function(e){e.source=this.config.source,l.chooseImageCallback(e)}},allowedFileTypes:n.properties.file_types,hideFiles:!0,title:_("contentblocks.choose_image"),source:l.source,openTo:n.properties.directory});e.setSource(l.source),e.show(),e.win.setZIndex(10210)},chooseImageCallback:function(e){var t=e.fullRelativeUrl;"http"!=t.substr(0,4)&&"/"!=t.substr(0,1)&&(t=MODx.config.base_url+t);var i=r.utilities.normaliseUrls(t);l.fieldDom.find(".url").val(i.cleanedSrc).change(),l.fieldDom.find(".size").val(e.size),l.fieldDom.find(".width").val(e.image_width),l.fieldDom.find(".height").val(e.image_height),l.fieldDom.find(".extension").val(e.ext),l.fieldDom.find(".source").val(e.source),l.fieldDom.find("img.contentblocks-field-image-preview-img").attr("src",l.getThumbnailPreview(t)),l.fieldDom.addClass("preview"),r.fireChange(),this.loadTinyRTE(),l.openCropperAutomatically&&l.openCropper()},promptImage:function(){Ext.Msg.prompt(_("contentblocks.from_url_title"),_("contentblocks.from_url_prompt"),function(e,t,i){"ok"===e&&l.insertFromUrl(t)},this)},insertFromUrl:function(e){!e||e.length<3?r.alert("No URL provided."):(l.fieldDom.addClass("contentblocks-field-loading"),s.ajax({dataType:"json",url:ContentBlocksConfig.connector_url,type:"POST",beforeSend:function(e,t){t.crossDomain||e.setRequestHeader("modAuth",MODx.siteId)},data:{action:"content/image/download",field:n.field,layout:n.layout,setting_key:n.settingKey,resource:ContentBlocksResource&&ContentBlocksResource.id?ContentBlocksResource.id:0,url:e},context:this,success:function(e){var t;l.fieldDom.removeClass("contentblocks-field-loading"),e.success?(t=r.utilities.normaliseUrls(e.object.url),l.fieldDom.find(".url").val(t.cleanedSrc).change(),l.fieldDom.find(".size").val(e.object.size),l.fieldDom.find(".width").val(e.object.width),l.fieldDom.find(".height").val(e.object.height),l.fieldDom.find(".extension").val(e.object.extension),l.fieldDom.find(".source").val(e.object.source),l.fieldDom.find("img.contentblocks-field-image-preview-img").attr("src",l.getThumbnailPreview(t.cleanedSrc)),l.fieldDom.addClass("preview"),r.fireChange(),this.loadTinyRTE(),l.openCropperAutomatically&&l.openCropper()):r.alert(e.message)}}))},initCropPreviews:function(){s.each(l.cropData,function(e,t){t.url&&n.properties.crops&&-1!==n.properties.crops.indexOf(e)&&(t=s.extend({cropKey:e},t),l.cropPreviews.append(tmpl("contentblocks-field-image-crop",t)))})},openCropper:function(e,t){var i=s.extend(!0,{},n,l.getData());r.Cropper(i,{configurations:n.properties.crops||"",initialCrop:t=t||!1}).onChange(function(e){l.cropData=s.extend(!0,{},e,!0),s.each(e,function(e,t){var i;t.url&&((i=l.cropPreviews.find(".image-crop-"+e+" img"))&&i.length?i.attr("src",t.url):(t=s.extend({cropKey:e},t),l.cropPreviews.append(tmpl("contentblocks-field-image-crop",t))))}),n.properties.thumbnail_crop&&l.cropData[n.properties.thumbnail_crop]&&l.cropData[n.properties.thumbnail_crop].url&&l.fieldDom.find("img.contentblocks-field-image-preview-img").attr("src",l.cropData[n.properties.thumbnail_crop].url)})},getData:function(){return{url:l.fieldDom.find(".url").val(),size:l.fieldDom.find(".size").val(),width:l.fieldDom.find(".width").val(),height:l.fieldDom.find(".height").val(),extension:l.fieldDom.find(".extension").val(),source:l.fieldDom.find(".source").val(),crops:l.cropData||{}}},loadTinyRTE:function(){}};return l},r.fieldTypes.image_with_title=function(t,i){var n=r.fieldTypes.image(t,i);return n.init=function(){var e;i.url&&i.url.length&&(e=r.utilities.normaliseUrls(i.url),n.fieldDom.find(".url").val(e.cleanedSrc).change(),n.fieldDom.find(".size").val(i.size),n.fieldDom.find(".width").val(i.width),n.fieldDom.find(".height").val(i.height),n.fieldDom.find(".extension").val(i.extension),n.fieldDom.find(".source").val(i.source),n.fieldDom.find("img.contentblocks-field-image-preview-img").attr("src",n.getThumbnailPreview(i.url)),n.fieldDom.find(".contentblocks-field-image-title-input").val(i.title||""),n.fieldDom.addClass("preview"),n.initCropPreviews(),this.loadTinyRTE()),i.properties.crops&&0!==i.properties.crops.length?(n.fieldDom.find(".contentblocks-field-crop-image").on("click",n.openCropper),n.fieldDom.on("click",".contentblocks-field-image-crop-preview",function(e){var t=s(this).data("key");n.openCropper(e,t)})):n.fieldDom.find(".contentblocks-field-crop-image").hide(),n.fieldDom.find(".contentblocks-field-delete-image").on("click",function(){n.fieldDom.removeClass("preview"),n.fieldDom.find(".url").val("").change(),n.fieldDom.find(".size").val(""),n.fieldDom.find(".width").val(""),n.fieldDom.find(".height").val(""),n.fieldDom.find(".extension").val(""),n.fieldDom.find(".source").val(""),n.fieldDom.find(".contentblocks-field-image-title-input").val("").removeClass("tinyrte-replaced"),n.fieldDom.find("img.contentblocks-field-image-preview-img").attr("src",""),n.fieldDom.find(".tinyrte-container").remove(),n.cropData=i.crops={},n.cropPreviews.empty(),r.fixColumnHeights(),r.fireChange()}),n.fieldDom.find(".contentblocks-field-upload").on("click",function(){n.fieldDom.find(".contentblocks-field-upload-field").click()}),n.fieldDom.find(".contentblocks-field-image-choose").on("click",s.proxy(function(){this.chooseImage()},this)),n.fieldDom.find(".contentblocks-field-image-url").on("click",s.proxy(function(){this.promptImage()},this)),this.initUpload(),this.initDropReceiver()},n.loadTinyRTE=function(){var e;r.toBoolean(i.properties.use_tinyrte)&&(e=t.find(".contentblocks-field-image-title-input"),r.addTinyRte(e))},n.getData=function(){return{url:n.fieldDom.find(".url").val(),title:n.fieldDom.find(".contentblocks-field-image-title-input").val(),size:n.fieldDom.find(".size").val(),width:n.fieldDom.find(".width").val(),height:n.fieldDom.find(".height").val(),extension:n.fieldDom.find(".extension").val(),source:n.fieldDom.find(".source").val(),crops:n.cropData||{}}},n}}(vcJquery,ContentBlocks),function(l,a){a.fieldTypes.file=function(s,i){var r={fileCount:0,fileBrowser:!1,source:0<i.properties.source?i.properties.source:ContentBlocksConfig["image.source"],directory:i.properties.directory,init:function(){this.initUpload(),s.find(".contentblocks-field-upload").on("click",function(){s.find(".contentblocks-field-upload-field").click()}),s.find(".contentblocks-field-file-choose").on("click",l.proxy(function(){this.chooseFile()},this)),l.isArray(i.files)&&l.each(i.files,function(e,t){r.fileCount++,t.id=i.generated_id+"-file"+r.fileCount,r.addFile(t)}),s.find(".file-holder").sortable({connectWith:".file-holder",forceHelperSize:!0,forcePlaceholderSize:!0,placeholder:"contentblocks-file-placeholder",tolerance:"pointer",cursor:"move",update:function(){a.fixColumnHeights(),MODx.fireResourceFormChange()},start:function(e,t){t.placeholder.height(t.item.height())}})},chooseFile:function(){var e=i.properties.max_files,t=s.find(".file-holder").find("li").length;if(0<e&&e<=t)return alert(_("contentblocks.file.max_files.reached",{max:e})),!1;e=MODx.load({xtype:"modx-browser",id:Ext.id(),multiple:!0,listeners:{select:function(e){r.chooseFileCallback(e)}},allowedFileTypes:i.properties.file_types,hideFiles:!0,title:_("contentblocks.file.choose_file"),source:r.source,openTo:i.properties.directory});e.setSource(r.source),e.show()},chooseFileCallback:function(e){var t=e.fullRelativeUrl;"http"!=t.substr(0,4)&&"/"!=t.substr(0,1)&&(t=MODx.config.base_url+t),r.fileCount++;var i=s.attr("id")+"-file"+r.fileCount,n=e.size,o=Math.round(Date.parse(e.lastmod)/1e3),l=e.ext;this.addFile({url:t,title:e.filename,id:i,size:n,upload_date:o,extension:l})},addFile:function(e){var t=e.url||e.title,i=s.find(".file-holder");e.filename=t.split("/").pop(),e.icon=r.getIconClass(e.extension),i.append(tmpl("contentblocks-field-fileinput_file",e));var n=l("#"+e.id);n.find(".contentblocks-fileinput_file-delete").on("click",function(){n.fadeOut(function(){n.remove(),a.fixColumnHeights(),MODx.fireResourceFormChange()})})},getIconClass:function(e){switch(e){case"doc":case"docx":case"pages":case"odt":case"rtf":case"tex":case"wpd":case"wps":return"word";case"txt":case"msg":case"log":case"dat":case"sdf":return"text";case"pps":case"ppt":case"pptx":case"key":return"powerpoint";case"csv":case"xlr":case"xls":case"xlsx":return"excel";case"pdf":case"indd":return"pdf";case"aif":case"iff":case"m3u":case"m4a":case"mid":case"mp3":case"mpa":case"ra":case"wav":case"wma":return"audio";case"3g2":case"3gp":case"asf":case"asx":case"avi":case"flv":case"m4v":case"mov":case"mp4":case"mpg":case"rm":case"swf":case"vob":case"wmv":return"video";case"bmp":case"dds":case"gif":case"jpg":case"jpeg":case"png":case"psd":case"pspimage":case"tga":case"thm":case"tif":case"tiff":case"yuv":case"ai":case"eps":case"ps":case"svg":return"image";case"7z":case"cbr":case"deb":case"gz":case"pkg":case"rar":case"rpm":case"sitx":case"tar":case"zip":case"zipx":return"zip";default:return e}},initUpload:function(){var n=s.attr("id"),o=i.properties.max_files;s.find("#"+n+"-upload").fileupload({url:ContentBlocksConfig.connectorUrl+"?action=content/file/upload",dataType:"json",dropZone:l("#"+n),progressInterval:250,paramName:"file",multiple:!0,pasteZone:null,add:function(e,t){var i=s.find(".file-holder").find("li").length;if(0<o&&o<=i)return alert(_("contentblocks.file.max_files.reached",{max:o})),!1;r.fileCount++;i=n+"-file"+r.fileCount;t.files[0].ext=t.files[0].name.split(".").pop(),r.addFile({title:t.files[0].name,url:"",id:i,size:t.files[0].size,upload_date:t.files[0].upload_date,extension:t.files[0].ext}),t.domId="#"+i,l(t.domId).addClass("uploading"),setTimeout(function(){t.submit()},1e3),MODx.fireResourceFormChange()},done:function(e,t){var i,n=l(t.domId);t.result.success?(i=t.result.object,n.find(".url").val(i.url),n.find(".size").val(i.size),n.find(".upload_date").val(i.upload_date),n.find(".extension").val(i.extension),n.removeClass("uploading")):(i=_("contentblocks.upload_error",{file:t.files[0].filename,message:t.result.message}),t.files[0].size>MODx.config.upload_maxsize&&(i+=_("contentblocks.upload_error.file_too_big")),alert(i),n.remove()),setTimeout(function(){a.fixColumnHeights()},150)},fail:function(e,t){var i=_("contentblocks.upload_error",{file:t.files[0].filename,message:t.result.message});t.files[0].size>MODx.config.upload_maxsize&&(i+=_("contentblocks.upload_error.file_too_big")),alert(i),l(t.domId).remove(),a.fixColumnHeights()},formData:function(){return[{name:"HTTP_MODAUTH",value:MODx.siteId},{name:"resource",value:MODx.request.id||0},{name:"field",value:i.id}]},progress:function(e,t){var i=parseInt(t.loaded/t.total*100,10)+"%";l(t.domId).find(".upload-progress .bar").width(i)}}).on("fileuploaddragover",function(){l(this).css("background","red")})},getData:function(){var i=[];return s.find(".file-holder li").each(function(e,t){t=l(t),t={url:t.find(".url").val(),title:t.find(".title").val(),size:t.find(".size").val(),upload_date:t.find(".upload_date").val(),extension:t.find(".extension").val()};i.push(t)}),{files:i}}};return r}}(vcJquery,ContentBlocks),vcJquery,ContentBlocks.fieldTypes.checkbox=function(i,e){var t={init:function(){},getData:function(){var e="",t="";return i.find("input[id]")[0].checked&&(e="1",t='checked="checked"'),{value:e,checked:t}}};return t},function(s,r){r.fieldTypes.chunk=function(n,o){var l={preview:n.find(".chunkOutput"),propList:n.find(".contentblocks-properties-list"),dynamicPreview:!0,fieldWrapper:n.closest(".contentblocks-field-outer"),init:function(){var e;!o.properties||!o.properties.chunk||o.properties.chunk<1?l.preview.html("<p>"+_("contentblocks.chunk.no_chunk_set")+"</p>"):(o.properties.custom_preview&&1<o.properties.custom_preview.length?(l.dynamicPreview=!1,l.preview.html(o.properties.custom_preview)):(n.addClass("contentblocks-field-loading"),(e=window.Ext&&Ext.getCmp?Ext.getCmp("modx-panel-resource"):null)&&e.on("success",function(e){l.loadPreview(!1,l.getPreviewData())})),l.fieldWrapper.on("input change","input, textarea, select",r.utilities.debounce(function(){r.fireChange(),l.dynamicPreview&&l.loadPreview(!1,l.getPreviewData())},300)),l.loadPreview(!0,l.getPreviewData(!0)))},getPreviewData:function(e){e=e||!1;var t=s.extend({settings:Ext.decode(l.fieldWrapper.data("settings"))||{}},l.getData());return e&&(t.chunk_properties=o.chunk_properties),t},loadPreview:function(i,e){s.ajax({dataType:"json",url:ContentBlocksConfig.connector_url,type:"POST",beforeSend:function(e,t){t.crossDomain||e.setRequestHeader("modAuth",MODx.siteId)},data:{action:"content/chunk/get",id:o.properties.chunk,field:o.field,resource:ContentBlocksResource&&ContentBlocksResource.id?ContentBlocksResource.id:0,data:e},context:this,success:function(e){var t;e.success?(l.dynamicPreview&&(t=(t=e.object.preview).replace(/(<\s*\/?\s*)script(\s*([^>]*)?\s*>)/gi,"$1jscript$2"),n.find(".chunkOutput").html(t)),i&&e.object.properties&&this.loadProperties(e.object.properties)):(l.preview.html(e.message),r.alert(e.message)),n.removeClass("contentblocks-field-loading")}})},getData:function(){var n={};return l.propList.find("li").each(function(e,t){var i=s(t).find("input,select"),t=i.data("name");n[t]=i.val()}),{chunk_properties:n}},loadProperties:function(e){l.propList.empty().hide(),e&&(s.each(e,function(e,t){var i=o.chunk_properties&&o.chunk_properties[e]?o.chunk_properties[e]:t.value;t.id="contentblocks-chunk-property-"+e+"-"+o.generated_id,t.key=e,t.value=i,t.name=_(t.name)?_(t.name):t.name,t.type,l.propList.append(tmpl("contentblocks-field-chunk-property",t))}),l.propList.show(),r.fixColumnHeights())}};return l}}(vcJquery,ContentBlocks),function(o,l){l.fieldTypes.dropdown=function(t,i){var n={fieldId:i.field,select:null,options:{},init:function(){t.addClass("contentblocks-field-loading"),i.settingType?i.setting.type_ahead===_("yes")&&(this.select=t.find("select"),n.select.select2({selectionCssClass:"contentblocks-select-setting",dropdownCssClass:"contentblocks-select-setting-dropdown"}).val(i.value).trigger("change")):(this.select=t.find(".contentblocks-field-dropdown select"),this.loadOptions())},loadOptions:function(){var e;i.value&&((e=o("<option></option>")).attr("value",i.value),e.text(i.display||i.value),this.select.append(e),this.select.attr("disabled","disabled")),o.ajax({dataType:"json",url:ContentBlocksConfig.connectorUrl,data:{action:"content/dropdown/getlist",context:MODx.activePage.record?MODx.activePage.record.context_key:"web",field:n.fieldId,resource:MODx.request.id||0},context:this,beforeSend:function(e,t){t.crossDomain||e.setRequestHeader("modAuth",MODx.siteId)},success:function(e){e.results?(n.setOptions(e.results),this.optionsLoaded(),i.properties.type_ahead===_("yes")&&n.select.select2({selectionCssClass:"contentblocks-dropdown-inputtype",dropdownCssClass:"contentblocks-dropdown-inputtype-dropdown"})):l.alert(_("contentblocks.dropdown.none_available")),t.removeClass("contentblocks-field-loading")}})},setOptions:function(e){n.options=e,n.optionsLoaded()},optionsLoaded:function(){n.select.empty(),o.each(n.options,function(e,t){var i=o("<option></option>");i.attr("value",t.value),i.text(t.display),t.disabled&&i.attr("disabled","disabled"),n.select.append(i)}),i.value||(i.value=i.properties.default_value),i.value&&n.select.val(i.value),n.select.attr("disabled",null)},getData:function(){return{value:n.select.val()||"",display:n.select.find(":selected").text()}}};return n}}(vcJquery,ContentBlocks),function(l,s){s.fieldTypes.snippet=function(t,i){var o={fieldId:i.field,propertyId:0,snippet:"",snippets:{},properties:{},hiddenProperties:{},select:null,propertiesList:null,propertiesSelectWrapper:null,propertiesSelect:null,init:function(){s.toBoolean(i.properties.allow_uncached)?t.find(".uncached").val(i.uncached||""):t.find(".contentblocks-field-snippet-uncached").hide(),t.addClass("contentblocks-field-loading"),this.select=t.find(".contentblocks-field-snippet-select select"),this.propertiesList=t.find(".contentblocks-properties-list"),this.propertiesSelectWrapper=t.find(".contentblocks-field-snippet-add-property"),this.propertiesSelect=this.propertiesSelectWrapper.find("select"),this.select.on("change",l.proxy(function(){this.chooseSnippet(this.select.val())},this)),this.propertiesSelect.on("change",l.proxy(function(){this.chooseProperty(this.propertiesSelect.val())},this)),l.ajax({dataType:"json",url:ContentBlocksConfig.connectorUrl,data:{action:"content/snippet/getlist",field:o.fieldId},context:this,beforeSend:function(e,t){t.crossDomain||e.setRequestHeader("modAuth",MODx.siteId)},success:function(e){e.results?e.results&&e.results.length?(l.each(e.results,function(e,t){o.snippets[t.name]=t}),this.snippetsLoaded()):s.alert(_("contentblocks.snippet.none_available")):s.alert(e.message),t.removeClass("contentblocks-field-loading")}})},snippetsLoaded:function(){if(o.select.empty(),o.select.append("<option></option>"),l.each(o.snippets,function(e,t){o.select.append('<option value="'+e+'">'+t.name+"</option>")}),!i.snippet||!i.snippet.length&&1==o.snippets.length){for(var e in o.snippets)break;i.snippet=e}i.snippet&&(o.select.val(i.snippet),o.chooseSnippet(i.snippet),i.snippet_properties&&l.each(i.snippet_properties,function(e,t){o.chooseProperty(e,t)})),o.select.find("option").length<2?o.select.hide():o.select.show()},chooseSnippet:function(e){var t=this.snippets[e];if(!t)return console&&console.error("Snippet "+e+" not found in available snippets: ",this.snippets),!1;o.snippet=e,o.properties=t.properties,o.propertiesSelect.empty(),o.propertiesList.empty(),o.propertiesSelect.append("<option></option>"),t.properties&&l.each(t.properties,function(e,t){o.propertiesSelect.append('<option value="'+e+'">'+t.name+"</option>")}),o.propertiesSelect.append('<option value="__other__">'+_("contentblocks.snippet.other_property")+"</option>"),o.propertiesSelectWrapper.show()},chooseProperty:function(e,t){t=t||"",o.propertyId++;var i,n=!1;(n="__other__"==e?{name:_("contentblocks.snippet.other_property"),desc_trans:_("contentblocks.snippet.other_property.desc")}:!(!o.properties||!o.properties[e])&&o.properties[e])?(n.id="contentblocks-snippet-property-"+o.propertyId,n.key=e,n.value=t,o.propertiesSelect.find("option[value="+e+"]").remove(),o.hiddenProperties[e]=n,o.propertiesList.append(tmpl("contentblocks-field-snippet-property",n)),(i=o.propertiesList.find("#"+n.id)).find(".contentblocks-field-snippet-delete-property").on("click",function(){o.propertiesSelect.append('<option value="'+e+'">'+n.name+"</option>"),o.hiddenProperties[e]=!1,i.remove(),o.propertiesList.find("li").length<1&&o.propertiesList.hide()}),i.find("input").on("keyup",function(){s.fireChange()}),o.propertiesList.show()):console&&console.error("Property "+e+" not found for snippet "+o.snippet)},getData:function(){var n={};o.propertiesList.find("li").each(function(e,t){var i=l(t).find("input"),t=i.data("name");n[t]=i.val()});var e=s.toBoolean(i.properties.allow_uncached)?t.find(".uncached").val():"0";return{snippet:o.snippet,snippet_properties:n,uncached:e}}};return o}}(vcJquery,ContentBlocks),function(l,s){s.fieldTypes.chunk_selector=function(t,i){var o={fieldId:i.field,propertyId:0,chunk_selector:"",chunk_selectors:{},properties:{},hiddenProperties:{},select:null,propertiesList:null,propertiesSelectWrapper:null,propertiesSelect:null,init:function(){t.addClass("contentblocks-field-loading"),this.select=t.find(".contentblocks-field-chunk_selector-select select"),this.propertiesList=t.find(".contentblocks-properties-list"),this.propertiesSelectWrapper=t.find(".contentblocks-field-chunk_selector-add-property"),this.propertiesSelect=this.propertiesSelectWrapper.find("select"),this.select.on("change",l.proxy(function(){this.chooseChunk(this.select.val())},this)),this.propertiesSelect.on("change",l.proxy(function(){this.chooseProperty(this.propertiesSelect.val())},this)),l.ajax({dataType:"json",url:ContentBlocksConfig.connectorUrl,data:{action:"content/chunk_selector/getlist",field:o.fieldId},context:this,beforeSend:function(e,t){t.crossDomain||e.setRequestHeader("modAuth",MODx.siteId)},success:function(e){e.results?e.results&&e.results.length?(l.each(e.results,function(e,t){o.chunk_selectors[t.name]=t}),this.chunk_selectorsLoaded()):s.alert(_("contentblocks.snippet.none_available")):s.alert(e.message),t.removeClass("contentblocks-field-loading")}})},chunk_selectorsLoaded:function(){if(o.select.empty(),o.select.append("<option></option>"),l.each(o.chunk_selectors,function(e,t){t.name=""!=t.description?t.name+" ("+t.description+")":t.name,o.select.append('<option value="'+e+'">'+t.name+"</option>")}),!i.chunk_selector||!i.chunk_selector.length&&1==o.chunk_selectors.length){for(var e in o.chunk_selectors)break;i.chunk_selector=e}i.chunk_selector&&(o.select.val(i.chunk_selector),o.chooseChunk(i.chunk_selector),i.chunk_selector_properties&&l.each(i.chunk_selector_properties,function(e,t){o.chooseProperty(e,t)})),o.select.find("option").length<2?o.select.hide():o.select.show()},chooseChunk:function(e){var t=this.chunk_selectors[e];if(!t)return console&&console.error("Chunk "+e+" not found in available chunks: ",this.chunk_selectors),!1;o.chunk_selector=e,o.properties=t.properties,o.propertiesSelect.empty(),o.propertiesList.empty(),o.propertiesSelect.append("<option></option>"),t.properties&&l.each(t.properties,function(e,t){o.propertiesSelect.append('<option value="'+e+'">'+t.name+"</option>")}),o.propertiesSelect.append('<option value="__other__">'+_("contentblocks.snippet.other_property")+"</option>"),o.propertiesSelectWrapper.show()},chooseProperty:function(e,t){t=t||"",o.propertyId++;var i,n=!1;(n="__other__"==e?{name:_("contentblocks.snippet.other_property"),desc_trans:_("contentblocks.snippet.other_property.desc")}:!(!o.properties||!o.properties[e])&&o.properties[e])?(n.id="contentblocks-chunk_selector-property-"+o.propertyId,n.key=e,n.value=t,n.name=_(n.name)?_(n.name):n.name,o.propertiesSelect.find("option[value="+e+"]").remove(),o.hiddenProperties[e]=n,o.propertiesList.append(tmpl("contentblocks-field-chunk_selector-property",n)),(i=o.propertiesList.find("#"+n.id)).find(".contentblocks-field-chunk-delete-property").on("click",function(){o.propertiesSelect.append('<option value="'+e+'">'+n.name+"</option>"),o.hiddenProperties[e]=!1,i.remove(),o.propertiesList.find("li").length<1&&o.propertiesList.hide()}),i.find("input").on("keyup",function(){s.fireChange()}),o.propertiesList.show()):console&&console.error("Property "+e+" not found for chunk_selector "+o.chunk_selector)},getData:function(){var n={};return o.propertiesList.find("li").each(function(e,t){var i=l(t).find("input"),t=i.data("name");n[t]=i.val()}),{chunk_selector:o.chunk_selector,chunk_selector_properties:n}}};return o}}(vcJquery,ContentBlocks),function(s,r){r.fieldTypes.layout=function(i,n){var e={init:function(){var e=n.child_layouts||{},t=!1;n.properties.available_layouts&&i.data("layouts",n.properties.available_layouts),n.properties.available_templates&&i.data("templates",n.properties.available_templates),!(t=void 0!==window.event?s(window.event.target).hasClass("contentblocks-repeat-layout"):t)&&s.isEmptyObject(e)&&r.initialized&&setTimeout(function(){i.find(".contentblocks-add-layout").click()},500),r.buildContents(e,i.find(".contentblocks-layout-wrapper").first())},destroy:function(){i.find(".contentblocks-layout").each(function(e,t){var i=s(t),t=i.find(".contentblocks-content").not(i.find(".contentblocks-layout .contentblocks-content"));s.each(t,function(e,t){s.each(s(t).find(".contentblocks-field").not(s(t).find(".contentblocks-field .contentblocks-field")),function(e,t){r.deleteField(window.event,s(t),!0)})}),r.deleteLayout(window.event,i,!0)})},getData:function(){var o=[];return i.find(".contentblocks-layout-wrapper").first().children(".contentblocks-layout").each(function(e,t){var i=s(t),n=i.data("layout"),t=s(this).parent().closest("li.contentblocks-field-outer").data("field")||0,l={layout:n,content:{},settings:Ext.decode(i.data("settings"))||{},parent:t},t=i.find("> .contentblocks-region-container > .contentblocks-region-container-header .contentblocks-layout-title").text(),n=ContentBlocksLayouts["_"+n]?ContentBlocksLayouts["_"+n].name:"";_(n)&&(n=_(n)),t&&t.length&&t!==n&&(l.title=t);i=i.find(".contentblocks-content").not(i.find(".contentblocks-content .contentblocks-content"));s.each(i,function(e,t){var i=s(t),t=i.data("part"),o=[];s.each(i.children("li"),function(e,t){var i=s(t),n=i.data("field"),t=i.attr("id"),t=r.generatedContentFields[t];t&&((t=t.getData()).field=n,t.settings=Ext.decode(i.data("settings"))||{},o.push(t))}),l.content[t]=o}),o.push(l)}),{child_layouts:o}}};return e}}(vcJquery,ContentBlocks);
//# sourceMappingURL=all-min.js.map