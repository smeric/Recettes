( function( $ ) {
    wp.customize( 'background_color', function( value ) {
        value.bind( function( newval ) {
            $( 'body' ).css( 'background-color', newval );
        } );
    } );

    wp.customize( 'blogname', function( value ) {
        value.bind( function( newval ) {
            $( '.site-title' ).html( newval );
        } );
    } );

    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( newval ) {
            $( '.site-description' ).html( newval );
        } );
    } );
} )( jQuery );