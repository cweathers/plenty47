//SLIDER JS
$(document).on('click', '.launchVideo', function(e) {
	e.preventDefault();
	var vimeo_id = $(this).attr('data-video-id');
	$('#homeVideoModal iframe').attr('src', 'https://player.vimeo.com/video/'+vimeo_id);
	$('#homeVideoModal').modal('show');
});

//Carousel Interval
$('#hero-carousel').carousel({
  interval: 8000
});