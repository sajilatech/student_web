/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{	

	 config.filebrowserBrowseUrl ='includes/ckeditor/filemanager/browser/default/browser.html?Connector=http://localhost/EMLC/site/EMLC@dmin/includes/ckeditor/filemanager/connectors/php/connector.php',
     config.filebrowserImageBrowseUrl = 'includes/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=http://localhost/EMLC/site/EMLC@dmin/includes/ckeditor/filemanager/connectors/php/connector.php',
     config.filebrowserFlashBrowseUrl ='includes/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=http://localhost/EMLC/site/EMLC@dmin/includes/ckeditor/filemanager/connectors/php/connector.php',
	 config.filebrowserUploadUrl  ='http://localhost/EMLC/site/EMLC@dmin/includes/ckeditor/filemanager/connectors/php/upload.php?Type=File',
	 config.filebrowserImageUploadUrl = 'http://localhost/EMLC/site/EMLC@dmin/includes/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
	 config.filebrowserFlashUploadUrl = 'http://localhost/EMLC/site/EMLC@dmin/includes/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'


	config.toolbar_Limited =
[
{ name: 'document', items : ['Source', '-','Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates' ] },
{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
'/',
{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv', '-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
	'/',
{ name: 'colors', items : [ 'TextColor','BGColor' ] },
{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
];	
	
	
};
