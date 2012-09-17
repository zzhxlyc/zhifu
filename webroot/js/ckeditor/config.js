/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	//config.toolbar = new Object() ;
	
	config.toolbar ='hppToolbar';
	//config.toolbar_simple =['Font','FontSize','TextColor','Bold','Italic','Underline','JustifyLeft','JustifyCenter','JustifyRight'];
	config.toolbar_hppToolbar =
	[
	['Bold','Italic','Underline','Strike'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	['Link','Unlink'],
	['Styles','Format','Font','FontSize'],
	['Undo','Redo','RemoveFormat'],
	['TextColor','BGColor']
	];
	
	config.toolbar_MXICToolbar =
	[
	['Source','-','NewPage','Save','Preview','-','Templates'],
	['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
	['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	'/',
	['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
	['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	['Link','Unlink','Anchor'],
	['Image','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
	'/',
	['Styles','Format','Font','FontSize'],
	['TextColor','BGColor'],
	['Maximize','ShowBlock']
	];

};
