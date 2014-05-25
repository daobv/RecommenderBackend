/*
 * custom.js
 * Custom JS code required by the theme.
 */

jQuery( function($) {

	// Remove no-js class on page load
	$( 'html' ).removeClass( 'no-js' ).addClass( 'js-enabled' );


	// Image preloader
	target = $( '.slide, .entry-thumb a, .minifolio li a, .post-thumb' );
	images = target.find( 'img' );
	counter = 0;
	i = 0;
	loaded = [];
	nextDelay = 0;
	images.each( function() {
		if ( $( this ).parent().length == 0 )
			$( this ).wrap( '<span class="preload" />' );
		else
			$( this ).parent().addClass( 'preload' );
		loaded[i++] = false;
	} );
	images = $.makeArray( images );

	timer = setInterval( function() {
		if ( counter >= loaded.length )
		{
			clearInterval( timer );
			return;
		}
		for ( i = 0; i < images.length; i++ )
		{
			if ( images[i].complete )
			{
				if ( loaded[i] == false )
				{
					loaded[i] = true;
					counter++;
					nextDelay = nextDelay + 100;
				}
				$( images[i]).css( 'visibility', 'visible' ).delay( nextDelay ).animate( { opacity:1 }, 300,
				function() {
					$( this ).parent().removeClass( 'preload' );
				} );
			}
			else
			{
				$( images[i] ).css( { 'visibility':'hidden', opacity:0 } );
			}
		}
	}, 100 );

} );


// document.ready call
jQuery( document ).ready( function($) {

	// Navigation drop down effect
	
	$( '.nav-menu ul, .sec-menu ul' ).css( { display: "none" } );
	function showMenu(){
		$( this ).find( 'ul:first' ).css( { visibility: "visible", display: "none" } ).slideDown( 300 );
	};
	function hideMenu(){
		$( this ).find( 'ul:first' ).css( { visibility: "visible", display: "none" } );
	};
	var config = {
		over	: showMenu,
		timeout	: 10,
		out		: hideMenu
	};
	$( '.nav-menu li, .sec-menu li' ).hoverIntent( config );

	
	// Responsive navigation drop-down
	
	if ( typeof ss_custom != 'undefined' && ss_custom.enable_responsive_menu ) {
		$( '<div />' ).attr( 'class', 'menu-drop' ).appendTo( '#responsive-menu' );
	
		if ( $( '#main-nav' ).html() )
			$( 'ul.nav-menu' ).clone().removeClass( 'nav-menu' ).appendTo( '.menu-drop' );
			
		if ( $( '#optional-nav' ).html() )
			$( 'ul.sec-menu' ).clone().removeClass( 'sec-menu' ).appendTo( '.menu-drop' ).addClass( 'optional-menu' );
	
		$( '#menu-button' ).click( function() {
			$( '.menu-drop' ).slideToggle( 300 );
			$( this ).toggleClass( 'activetoggle' );
			return false;
		} );
	}

	
	// Toggle button
	
	$( 'h5.toggle' ).click( function() {
		$( this ).next().slideToggle( 300 );
		$( this ).toggleClass( 'activetoggle' );
		return false;
	} ).next().hide();

	
	// Scroll to top button
	
	$( '.scroll-to-top' ).hide();
	$( window ).scroll( function () {
		if ( $( this ).scrollTop() > 100 ) {
			$( '.scroll-to-top' ).fadeIn( 300 );
		}
		else {
			$( '.scroll-to-top' ).fadeOut( 300 );
		}
	} );
	
	$( '.scroll-to-top a' ).click( function() {
		$( 'html, body' ).animate( { scrollTop:0 }, 500 );
		return false;
	} );

	
	// Box close button
	
	$( '.box' ).each(function() {
			$( this ).find( '.hide_box' ).click( function() {
				$( this ).parent().hide();
			} );
	} );
	
	
	// PrettyPhoto Init	

	$( 'a[data-rel]' ).each( function() {
		$( this ).attr( 'rel', $( this ).data( 'rel' ) );
	} );
	
	$( "a[rel^='prettyPhoto[group1]'], a[rel^='prettyPhoto[group2]'], a[rel^='prettyPhoto[inline]'], a[rel^='prettyPhoto']" ).prettyPhoto();
	
	// Live preview option panel

	$( '.option-panel' ).css( { left: "-218px" } );
	var tog = 0;
	$( '.option-btn a' ).click( function() {
		if ( tog++ % 2 == 0 ) {
			$( '.option-panel' ).stop().animate( { left: "0px" }, 300 );
		}
		else {
			$( '.option-panel' ).stop().animate( { left:"-218px" }, 300 );
		}
		return false;
	} );
																																	  
} )