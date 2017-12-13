// Protect the global namespace
if( $ ) { $.noConflict(); }
// Document ready function
jQuery( function( $ ) {
	'use strict';
	var $dropDownToggles = $.map( $( '.dropdown-toggle' ), function( button ) {
		return new dropDownToggle( button );
	});

	function dropDownToggle( button ) {
		var $button, $parent;

		var cacheDom = function() {
			$button = $( button );
			$parent = $button.parents( 'li' ).first();
		};

		var bindEvents = function() {
			$button.on( 'mouseenter', transferHover );
			$button.on( 'mouseleave', removeHover );
		};

		var transferHover = function( event ) {
			$parent.addClass( 'hovered' );
		};

		var removeHover = function( event ) {
			$parent.removeClass( 'hovered' );
		};

		( function(){
			cacheDom();
			bindEvents();
		})();
		return $button;
	}

	$('.no-link').click(function (event) {
	    // custom handling here
	    event.preventDefault();
	});


	$('.testimonial-wrapper.slider' ).slick({
	    autoplay: true,
	    autoplaySpeed: 5000,
	    arrows: false, //Set these to whatever you need
	    adaptiveHeight : true,
	});

	$( '.checkout-addon-products ul.products' ).slick({
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 2000,
		dots: true,
		responsive: [
		    {
		      breakpoint: 768,
		      settings: {
		        slidesToShow: 3,
		      }
		    },
		    {
		      breakpoint: 600,
		      settings: {
		        slidesToShow: 2,
		      }
		    },
		    {
		      breakpoint: 420,
		      settings: {
		        slidesToShow: 1,
		      }
		    }
		  ]
	});

	// Datatables stuff
	(function(){
		var $datatables, $tables;

		var cacheDom = function() {
			$tables = $( 'table.openings' );
		};

		var initialize = function() {
			if( Mpress.breakpoint.get() >= 3 && !$.fn.DataTable.isDataTable( $datatables ) ) {
				$datatables = $tables.dataTable( { searching : false, destroy : true, order : [[ 0, "desc" ]] } );
			} else if( Mpress.breakpoint.get() < 3 && $.fn.DataTable.isDataTable( $datatables ) ) {
				$datatables.fnDestroy();
			}
		};

		var bindEvents = function() {
			$( window ).on( 'resize', initialize );
		};

		// Cache the dom
		cacheDom();
		// Init
		initialize();
		// Bind Events
		bindEvents();
	})();

	// document.getElementById('').onclick = function(e){
	//     e.preventDefault();

	//     var page = document.getElementById('white-ribbon-party-size').value,
	//         extension = '.html';

	//     window.location = category + extension;
	// }

	var $party_size_selector = $.map( $( '.card-wrapper' ), function( card ) {
		return new Party_Size_Selector( card );
	});

	function Party_Size_Selector(el){
		var $el, $button, $select;

		var cacheDom = function() {
			$el = $( el );
			$button = $el.find( '.ecommerce-button-nav' );
			$select = $el.find( 'select' );
		};

		var bindEvents = function() {
			$select.on( 'change', redirect_url );
		};

		var redirect_url = function() {
			$button.attr('href', $select.val());
			console.log($button.attr('href'));
		};

		( function(){
			cacheDom();
			bindEvents();
		})();
		return $button;
	}
});
