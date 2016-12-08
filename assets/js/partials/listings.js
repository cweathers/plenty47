function indListings() {
	$('.ind-listing').removeAttr('style');
	if($(window).width() >= 768) {
		$('.ind-listing').equalHeights();
	}
}

$(window).load(function() {
	indListings();
});
$(window).resize(function() {
	indListings();
});

//Filter Listings
$(document).on('click', 'ul.filter-listings li a', function(e) {
	e.preventDefault();
	var btn = $(this);
	var type = $(btn).attr('data-type');
	var id = $(btn).attr('data-id');
	
	if(type === 'market') {
		$('#filter-market').val(id);
		$('#market-list li a').removeClass('active');
		$('#market-list li a i').remove();
	}else {
		$('#filter-category').val(id);
		$('#category-list li a').removeClass('active');
		$('#category-list li a i').remove();
	}
	
	//Now grab the values that we're going to filter...
	var market = $('#filter-market').val();
	var category = $('#filter-category').val();
	
	//Listings loader...
	$('#listings-loader').html('<div class="listings-preloader"><i class="fa fa-spinner fa-spin"></i></div>');
	
	$.ajax({
	    url: siteUrl+'listings/filter',
	    type: 'POST',
	    data: {
		    _token:     CSRF_TOKEN,
		    market: market,
		    category: category
		},
	    success: function (data) {
	        //Mark this as the active one...
	        $(btn).addClass('active').prepend('<i class="fa fa-check"></i>');
	        $('#listings-loader').html(data);
	    }
	});
	
});

//Search...
$(document).on('keyup', '#searchListings', function() {
	var searchTerm = $(this).val();
	$.ajax({
	    url: siteUrl+'listings/search',
	    type: 'POST',
	    data: {
		    _token:     CSRF_TOKEN,
		    searchTerm: searchTerm
		},
	    success: function (data) {
	        //Show the listings...
	        $('#searchResults').html(data).slideDown();
	    }
	});
});

//Search...
$(document).on('click', '.custom-search-btn', function(e) {
	e.preventDefault();
	var searchTerm = $('#searchListings').val();
	$.ajax({
	    url: siteUrl+'listings/search',
	    type: 'POST',
	    data: {
		    _token:     CSRF_TOKEN,
		    searchTerm: searchTerm
		},
	    success: function (data) {
	        //Show the listings...
	        $('#searchResults').html(data).slideDown();
	    }
	});
});


$(document).on('blur', '#searchListings', function() {
	$('#searchResults').slideUp();	
});