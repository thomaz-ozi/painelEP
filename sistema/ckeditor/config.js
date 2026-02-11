/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	
	
	
	// Define changes to default configuration here. For example:
	config.language = 'pt-br';
	config.scayt_sLang  = 'pt-br';
	//config.uiColor = '#EEEDDB';
	config.uiColor = '#FFFFFF';




config.toolbar = 'clear';
config.toolbar_clear = [
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline','-', 'RemoveFormat' ] },
	{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
	{ name: 'tools', items: [ 'Source' ] },

];

	
	
config.toolbar = 'basic';
config.toolbar_basic = [
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: ['NewPage', 'Undo', 'Redo','-','Cut', 'Copy', 'Paste', 'PasteText'  ] },
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline','-', 'RemoveFormat' ] },
	{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	{ name: 'insert', items: [ 'Smiley'] },
	
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
	{ name: 'tools', items: [ 'Source' ] },

];

	
	
	
config.toolbar = 'default';
config.toolbar_default = [
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: ['NewPage', 'Undo', 'Redo','-','Cut', 'Copy', 'Paste', 'PasteText'  ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: ['Print', 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
	{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'  ] },
	{ name: 'tools', items: [ 'Source', '-', 'Maximize' ] },
	'/',

	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline','-', 'RemoveFormat' ] },
	{ name: 'styles', items: [ 'Styles', 'Format' ] },
	{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',  '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor'] },
];



config.toolbar = 'full';
config.toolbar_full = [
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Undo', 'Redo','-','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'  ] },
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
		{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor', 'Iframe' ] },
	{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
	'/',

	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
	
	{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak' ] },
	'/',
	{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
	{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	{ name: 'tools', items: [ 'Source', '-', 'Maximize', 'ShowBlocks' ] },
	{ name: 'others', items: [ '-' ] },
	{ name: 'about', items: [ 'About' ] }
];


	

	
	
};
