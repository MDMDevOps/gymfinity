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
		};

		var calculate = function() {
			settings = {
				'width'  : $sidebar.width(),
				'top'    : $sidebar.data( 'offset' ) || 0,
				'height' : $column.height(),
			};
			// console.log( $container.height() );
			$(window).on('scroll', function(){
				// console.log( $(document).scrollTop() );
			});
		};

		var bindEvents = function() {
			$sidebar.waypoint( scrollTrigger, { offset : settings.top } );
			// var newoff = 0 - ( $container.height() - $sidebar.height() - parseInt( settings.top ));
			$container.waypoint( stopScroll, { offset : calculateStop } );
			// Resizer column width
			$( window ).on( 'resize', resizeWidth );
		};

		var calculateStop = function() {
			console.log( $column.height() );
			return 0 - ( $container.height() - $column.height() - parseInt( settings.top ) );
		};

		var setWidth = function() {
			// calculate();
			$column.css( { 'width' : $sidebar.width() + 'px' } );
		};

		var scrollTrigger = function( direction ) {
			if( direction === 'down' ) {
				// $( window ).on( 'scroll', scrollEffect );
				$column.css( { 'width' : $sidebar.width() + 'px', 'position' : 'fixed', 'top' : settings.top } );

			} else {
				console.log( direction );
				// $( window ).off( 'scroll', scrollEffect );
				$column.css( { 'position' : 'relative', 'top' : 0  } );
			}

			return;
		};

		var resizeWidth = function() {
			$column.css( { 'width' : $sidebar.width() + 'px' } );
		};

		var stopScroll = function( direction ) {

			if( direction === 'down' ) {
				// $sidebar.css( { 'position' : 'relative', 'height' : $container.height() } );
				$column.css( { 'position' : 'absolute', 'top' : $container.height() - $column.height() } );
			} else {
				$column.css( { 'width' : $sidebar.width() + 'px', 'position' : 'fixed', 'top' : settings.top } );
				// $sidebar.css( { 'position' : 'relative', 'height' : 'auto' } ).promise().done( function() {
				// 	$column.attr( 'style', '' );
					// $column.css( { 'top' : '50px', background : 'blue'} );
				// });

			}
		};

		( function() {
			cacheDom();
			calculate();
			bindEvents();
		})();

		return $sidebar;
	}
});