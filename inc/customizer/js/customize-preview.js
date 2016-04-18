/**
 * Live-update changed settings in real time in the Customizer preview.
 */
 
( function( $ ) {
	
	api = wp.customize;
	
	api( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.site-logo-link a' ).html( newval );
		} );
	} );
	
	api( 'contact_button', function( value ) {
		value.bind( function( newval ) {
			$( '.bean-contact-form .button' ).html( newval );
		} );
	} );

	api( 'powered_by_essay', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.powered-by-essay' ).removeClass( 'hidden' );
			} else {
				$( '.powered-by-essay' ).addClass( 'hidden' );
			}
		} );
	} );

	api( 'powered_by_wordpress', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.powered-by-wordpress' ).removeClass( 'hidden' );
			} else {
				$( '.powered-by-wordpress' ).addClass( 'hidden' );
			}
		} );
	} );

} )( jQuery );