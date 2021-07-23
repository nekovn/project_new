/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};

var writer = editor.dataProcessor.writer;

// The character sequence to use for every indentation step.
writer.indentationChars = '\t';

// The way to close self-closing tags, like <br/>.
writer.selfClosingEnd = ' />';

// The character sequence to be used for line breaks.
writer.lineBreakChars = '\n';

// The writing rules for the <p> tag.
writer.setRules( 'p', {
    // Indicates that this tag causes indentation on line breaks inside of it.
    indent: true,

    // Inserts a line break before the <p> opening tag.
    breakBeforeOpen: true,

    // Inserts a line break after the <p> opening tag.
    breakAfterOpen: true,

    // Inserts a line break before the </p> closing tag.
    breakBeforeClose: false,

    // Inserts a line break after the </p> closing tag.
    breakAfterClose: true
} );
