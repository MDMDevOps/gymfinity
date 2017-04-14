jQuery( function( $ ) {
	'use strict';

	$( '.mdm-metabox .color-field' ).wpColorPicker( {
	    hide: true,
	    palettes: true,
	    color: true,
	});




	var mediaFrame, $metabox, inputs = {}, options = {};

	var cacheDom = function() {
		inputs = {
			src     : $metabox.find( '[data-input=src]' ),
			preview : $metabox.find( '#preview' ),
		};

		options = {
			default : inputs.preview.data( 'default' ),
		};
	};

	var bindEvents = function() {
		$( document ).on( 'click', '.mdm-metabox [data-action="choose"]', chooseImage );
		$( document ).on( 'click', '.mdm-metabox [data-action="remove"]', removeImage );
	};

	var createFrame = function() {
		// Create frame
		wp.media.frames.file_frame = wp.media({
			title: "Insert Background Image",
			multiple: false,
			editing:   false,
			button: { text: "Choose Image" },
			displaySettings: false,
			library: {
			   type: 'image'
			}
		});
		// Bind frame's open event
		wp.media.frames.file_frame.on( 'open', cacheDom );
		// Return frame
		return wp.media.frames.file_frame;
	};

	var chooseImage = function( event ) {
		event.preventDefault();
		// Set metabox element
		$metabox = $( event.target ).closest( '.inside' );
		// Create media frame
		if( typeof mediaFrame === 'undefined' ) {
			mediaFrame = createFrame();
		}
		// Bind frame's select event
		mediaFrame.on( 'select', insertImage );
		// Open frame
		mediaFrame.open();
	};

	var removeImage = function( event ) {
		event.preventDefault();
		$metabox = $( event.target ).closest( '.inside' );

		cacheDom();
		inputs.src.attr( 'value', '' );
		inputs.preview.attr( 'src', options.default );
	};

	var insertImage = function( event ) {
		// Get selection
		var selection = mediaFrame.state().get( 'selection' ).first().toJSON();
		// Insert
		inputs.src.attr( 'value', selection.id );
		inputs.preview.attr( 'src', selection.url );
		// Remove handler
		mediaFrame.off( 'select', insertImage );
	};

	( function() {
		bindEvents();
	})();
});

console.log( 'lasjdflasdkl' );