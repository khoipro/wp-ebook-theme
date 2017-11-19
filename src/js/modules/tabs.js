var tabModules = Array.prototype.slice.call( document.querySelectorAll('[data-module-init="tabs"]') );
if( tabModules ) {
	tabModules.forEach( function( el ) {
		var toggles = Array.prototype.slice.call( el.querySelectorAll('[data-tab-content]') ),
			blocks  = Array.prototype.slice.call( el.querySelectorAll('.js-tab-content') ),
			activeClass = 'active';

		function findBlock( toggle ) {
			return el.querySelector( toggle.getAttribute('data-tab-content') );
		}

		function activateTab( currentToggle ) {
			var activeBlock = findBlock( currentToggle );
			currentToggle.classList.add( activeClass );
			activeBlock.classList.add( activeClass );
		}

		function deactiveOtherTabs() {
			toggles.forEach( function( otherToggle ) {
				var otherBlock = findBlock( otherToggle );
				otherToggle.classList.remove( activeClass );
				otherBlock.classList.remove( activeClass );
			} );
		}

		// Active first tab
		activateTab( toggles[0] );

		toggles.forEach( function( toggle ) {
			toggle.addEventListener('click', function() {
				if( !toggle.classList.contains( activeClass ) ) {
					deactiveOtherTabs();
					activateTab( this );
				}
			});
		});
	});
}
