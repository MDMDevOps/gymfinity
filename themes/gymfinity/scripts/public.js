// Protect the global namespace
if( $ ) { $.noConflict(); }
// Document ready function
jQuery( function( $ ) {
	'use strict';

	var $fs = $.map( $( '.fixed-scroll' ), function( element ) {
		return new FixedScrollingSidebar( element );
	});

	function FixedScrollingSidebar( sidebar ) {
		var $sidebar, $column, $container, settings = {};

		var cacheDom = function() {
			$sidebar   = $( sidebar );
			$column    = $sidebar.find( '.fixed-scroll-column' ).first();
			$container = $( $sidebar.data( 'container' ) );
			console.log( $container );
		};

		var calculate = function() {
			settings = {
				'width' : $sidebar.width(),
				'top'    : $sidebar.data( 'offset' ) || 0,
			};
		};

		var bindEvents = function() {
			$sidebar.waypoint( scrollTrigger, { offset : settings.top } );
			$( window ).on( 'resize', setWidth );
		};

		var setWidth = function() {
			// calculate();
			$column.css( { 'width' : $sidebar.width() + 'px' } );
		};

		var scrollTrigger = function( direction ) {
			console.log( direction );
			if( direction === 'down' ) {
				// $( window ).on( 'scroll', scrollEffect );
				$column.css( { 'width' : settings.width + 'px', 'position' : 'fixed', 'top' : settings.top} );
			} else {
				// $( window ).off( 'scroll', scrollEffect );
				$column.css( { 'position' : 'relative', 'top' : 0 , 'width' : 'auto' } );
			}

			return;
		};

		var scrollEffect = function( event ) {
			$column.css( { 'width' : settings.width + 'px', 'position' : 'fixed', 'top' : 0 } );
		};

		( function() {
			cacheDom();
			calculate();
			bindEvents();
		})();

		return $sidebar;
	}
});