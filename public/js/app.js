$( function () {
	$( document ).on( 'click', '.ajax-btn', function ( event ) {
		if ( $( this ).data( 'data-toggle' ) != 'modal' ) {
			event.preventDefault();
		}

		var $this = $( this ),
			url = $this.data( 'url' ),
			$target = $( $this.data( 'target' ) ),
			callback = $this.data( 'callback' ),
			active = $this.data( 'active' );

		if ( url && $target ) {
			$.ajax( {
				type: "GET",
				url: url,
				success: function ( result ) {
					$target.html( result );

					if ( callback ) {
						callFunction( callback, window, $this );
					}
				}
			} );
		}
		else {
			event.preventDefault();
		}
	} );

	$( document ).on( 'click', '.ajax-choose-btn', function ( event ) {
		var $this = $( this ),
			addUrl = $this.data( 'add-url' ),
			removeUrl = $this.data( 'remove-url' );

		if ( $this.hasClass( 'active' ) ) {
			$.ajax( {
				type: "GET",
				url: removeUrl,
				success: function ( result ) {
					$( '#ajax-show-scales' ).html( result );
					$this.removeClass( 'active' );
				}
			} );
		}
		else {
			$.ajax( {
				type: "GET",
				url: addUrl,
				success: function ( result ) {
					$( '#ajax-show-scales' ).html( result );
					$this.addClass( 'active' )
				}
			} );
		}
	} );
});

var selectScaleBtn = function($this){
	$('.pianoMainScaleBtn.active').removeClass('active')
	$this.addClass('active');
};


/*****************************************************
 * Function
 * Allow global functions to be called programatically
 * by the string name
 */
function callFunction( functionName, context /*, args */ ) {
	var args = Array.prototype.slice.call( arguments ).splice( 2 );
	console.log( args );

	var namespaces = functionName.split( '.' );
	var func = namespaces.pop();

	for ( var i = 0; i < namespaces.length; i++ ) {
		context = context[ namespaces[ i ] ];
	}

	if ( typeof( context[ func ] ) === 'function' ) {
		return context[ func ].apply( context, args );
	}

	return null;
}