/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.toolbar = 'MyToolbar';

    config.toolbar_MyToolbar =
    [
        //['Bold','Italic','Strike','-','FontSize','TextColor','-','JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
        ['Bold','Italic','Strike','-','FontSize','TextColor','-','JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock','-','NumberedList','BulletedList','Outdent','Indent','Blockquote'],
        ['Image','Link','Unlink','Table'],
        ['Source','Maximize']     
    ];
};