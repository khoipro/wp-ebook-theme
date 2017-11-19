var content = document.querySelector('.js-content'),
	sidebarToggle = document.querySelector('.js-toggle'),
	activeClass = 'js-menu-active';

if( content && sidebarToggle ) {
	sidebarToggle.addEventListener('click', function() {
		document.body.classList.toggle( activeClass );
	});
}
