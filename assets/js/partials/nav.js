//NAV ANIMATION
$(document).on('click', '.menu-link', function(e) {
	e.preventDefault();
	$('.menu-overlay').addClass('open');
});

$(document).on('click', '.close-menu', function(e) {
	e.preventDefault();
	$('.menu-overlay').removeClass('open');
});

//Click anywhere except nav
$(document).on('click', '.menu-overlay', function(e) {    
       if(e.target.id !== "main-nav") {
	       $('.menu-overlay').removeClass('open');
       }
});

//DISAPPEARING HEADER
$(window).load(function() {
	$('header').headroom({
        tolerance : 0,
        offset : 500
    });
});