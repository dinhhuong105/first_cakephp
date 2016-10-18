/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    
    config.height   = '500px';
    
    config.extraPlugins = 'youtube';
    
    config.toolbarGroups = [
        { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
        { name: 'links' },
        { name: 'insert' },
        { name: 'colors' },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        
        { name: 'others' },        
        { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
        { name: 'styles' },
        
        { name: 'document',    groups: [ 'mode', 'document'] },
        { name: 'tools' }
    ];
    
    config.toolbar = [{ name: 'insert', items: ['Image', 'Youtube']}];
        
	config.filebrowserBrowseUrl         = baseUrl + 'webroot/js/admin/kcfinder/browse.php?opener=ckeditor&type=files';
	config.filebrowserImageBrowseUrl    = baseUrl + 'webroot/js/admin/kcfinder/browse.php?opener=ckeditor&type=images';
	config.filebrowserFlashBrowseUrl    = baseUrl + 'webroot/js/admin/kcfinder/browse.php?opener=ckeditor&type=flash';
	config.filebrowserUploadUrl         = baseUrl + 'webroot/js/admin/kcfinder/upload.php?opener=ckeditor&type=files';
	config.filebrowserImageUploadUrl    = baseUrl + 'webroot/js/admin/kcfinder/upload.php?opener=ckeditor&type=images';
	config.filebrowserFlashUploadUrl    = baseUrl + 'webroot/js/admin/kcfinder/upload.php?opener=ckeditor&type=flash';
};
