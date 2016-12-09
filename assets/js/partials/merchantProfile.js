var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

function mhBot() {
	if($(window).width() >= 768) {
		$('.mh-bot').removeAttr('style');
		var sbWidth = $('.mh-sidebar').outerWidth();
		$('.mh-bot').css('width', 'calc(100% - '+sbWidth+'px)');
	}else {
		$('.mh-bot').removeAttr('style');
	}
}

$(window).load(function() {
	mhBot();
});

$(window).resize(function() {
	mhBot();
});

$(document).ready(function() {
	$(".fancybox").fancybox({
	  helpers: {
	    overlay: {
	      locked: false
	    }
	  }
	});
});

//Save fact
$(document).on('click', '.merchant-saveFact', function(e) {
	
	e.preventDefault();
	
	var btn = $(this);
	var id = $(btn).attr('data-id');
	var fact = $('#fact-text-'+id).val();
	
	$('i', btn).removeClass('fa-check').addClass('fa-spinner fa-spin');
	
	$.ajax({
	    url: siteUrl+'merchant/saveFact',
	    type: 'POST',
	    data: {
		    _token:     CSRF_TOKEN,
		    factId: id,
		    fact: fact
		},
	    success: function (data) {
	        $('i', btn).removeClass('fa-spinner fa-spin').addClass('fa-check');
	    }
	});
});

//Delete Fact
$(document).on('click', '.merchant-removeFact', function(e) {
	
	e.preventDefault();
	
	var btn = $(this);
	var id = $(btn).attr('data-id');
	
	$('i', btn).removeClass('fa-check').addClass('fa-spinner fa-spin');
	
	$.ajax({
	    url: siteUrl+'merchant/deleteFact',
	    type: 'POST',
	    data: {
		    _token:     CSRF_TOKEN,
		    factId: id,
		},
	    success: function (data) {
	        $('tr#fact-row-'+id).remove();
	    }
	});
});

//Delete Fact
$(document).on('click', '.merchant-addFact', function(e) {
	
	e.preventDefault();
	
	if($('#fact-row-new').length > 0) {
		alert('please finish the fact you already added!');
	}else {
	
		$('table#factTable').append('<tr id="fact-row-new"><td><input type="text" class="newFact form-control" value=""></td><td class="text-center"><a href="#" class="merchant-newFact btn btn-success"><i class="fa fa-check"></i></a> <a href="#" class="merchant-removeNewFact btn btn-danger"><i class="fa fa-times"></i></a></tr>');
		
	}
});

//Delete Fact
$(document).on('click', '.admin-addFact', function(e) {
	
	e.preventDefault();
	
	if($('#fact-row-new').length > 0) {
		alert('please finish the fact you already added!');
	}else {
	
		$('table#factTable').append('<tr id="fact-row-new"><td><input type="text" class="newFact form-control" value=""></td><td class="text-center"><a href="#" class="admin-newFact btn btn-success"><i class="fa fa-check"></i></a> <a href="#" class="merchant-removeNewFact btn btn-danger"><i class="fa fa-times"></i></a></tr>');
		
	}
});

//Delete Fact
$(document).on('click', '.merchant-removeNewFact', function(e) {
	
	e.preventDefault();
	
	$('#fact-row-new').remove();
});

//New Fact
$(document).on('click', '.merchant-newFact', function(e) {
	
	e.preventDefault();
	
	var btn = $(this);
	var text = $('input.newFact').val();
	
	$('i', btn).removeClass('fa-check').addClass('fa-spinner fa-spin');
	
	$.ajax({
	    url: siteUrl+'merchant/newFact',
	    type: 'POST',
	    data: {
		    _token:     CSRF_TOKEN,
		    fact: text,
		},
	    success: function (data) {
	        $('i', btn).removeClass('fa-spinner fa-spin').addClass('fa-check');
	    }
	});
});


//New Fact
$(document).on('click', '.admin-newFact', function(e) {
	
	e.preventDefault();
	
	var btn = $(this);
	var text = $('input.newFact').val();
	var id = $('#factTable').attr('data-vendor-id');
	
	$('i', btn).removeClass('fa-check').addClass('fa-spinner fa-spin');
	
	$.ajax({
	    url: siteUrl+'admin/newFact',
	    type: 'POST',
	    data: {
		    _token:     CSRF_TOKEN,
		    fact: text,
		    id: id
		},
	    success: function (data) {
	        $('i', btn).removeClass('fa-spinner fa-spin').addClass('fa-check');
	    }
	});
});

//Add more photos
$(document).ready(function() {
	var token  = $('meta[name="csrf-token"]').attr('content');
	var flag = 0;
	var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'merchantPickPhotos', // you can pass an id...
	container: document.getElementById('container'), // ... or DOM Element itself
	url : siteUrl+'/upload-photo',
	flash_swf_url : '../js/Moxie.swf',
	silverlight_xap_url : '../js/Moxie.xap',
	
	multipart_params : {
        _token : token,
    },
	
	filters : {
		max_file_size : '10mb',
		mime_types: [
			{title : "Image files", extensions : "jpg,gif,png"}
		]
	},

	init: {
		PostInit: function() {
			document.getElementById('merchantPhotoList').innerHTML = '';

			document.getElementById('merchantUploadPhotos').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('merchantPhotoList').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},
		
		Uploadfile: function() {
			
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},
		
		FileUploaded: function(up, file, response) {
			var file = response.response;
			
			$.ajax({
			    url: siteUrl+'merchant/newPhoto',
			    type: 'POST',
			    data: {
				    _token:     CSRF_TOKEN,
				    photo: file,
				},
			    success: function (data) {
			        $('ul.merchant-photos').html(data);
			    }
			});
			
			
		},
		
		UploadComplete: function(up, file) {
			
			$('#addPhotoModal').modal('hide');
			document.getElementById('merchantPhotoList').innerHTML = '';
			
		},

		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
		}
	}
});

uploader.init();
});

//Delete Photo
$(document).on('click', '.merchant-deletePhoto', function(e) {
	
	e.preventDefault();
	
	var btn = $(this);
	var id = $(btn).attr('data-id');
	
	$('i', btn).removeClass('fa-check').addClass('fa-spinner fa-spin');
	
	$.ajax({
	    url: siteUrl+'merchant/deletePhoto',
	    type: 'POST',
	    data: {
		    _token:     CSRF_TOKEN,
		    id: id,
		},
	    success: function (data) {
	        $('ul.merchant-photos').html(data);
	    }
	});
});

//Profile Details Logo Upload
$(document).ready(function() {
	var token  = $('meta[name="csrf-token"]').attr('content');
	var flag = 0;
	var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'profpickLogo', // you can pass an id...
	container: document.getElementById('logoContainer'), // ... or DOM Element itself
	url : siteUrl+'/upload-photo',
	flash_swf_url : '../js/Moxie.swf',
	silverlight_xap_url : '../js/Moxie.xap',
	
	multipart_params : {
        _token : token,
    },
	
	filters : {
		max_file_size : '10mb',
		mime_types: [
			{title : "Image files", extensions : "jpg,gif,png"}
		]
	},

	init: {
		PostInit: function() {
			document.getElementById('proflogolist').innerHTML = '';

			document.getElementById('profuploadLogo').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('proflogolist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},
		
		Uploadfile: function() {
			$('#merchantSaveDetails').addClass('disabled');
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},
		
		FileUploaded: function(up, file, response) {
			var file = response.response;
			
			$.ajax({
			    url: siteUrl+'merchant/changeLogo',
			    type: 'POST',
			    data: {
				    _token:     CSRF_TOKEN,
				    logo: file,
				},
			    success: function (data) {
				    $('img.currentLogo').attr('src', siteUrl+'uploads/'+file);
			    }
			});
			
			
		},
		
		UploadComplete: function(up, file) {
			$('#merchantSaveDetails').removeClass('disabled');
			document.getElementById('proflogolist').innerHTML = '';
			
		},

		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
		}
	}
});

uploader.init();
});

//Validate merchant profile details...
$("#merchant-profile-details-form").validate({
    errorClass:'error',
    validClass:'success',
    errorElement:'span',
  onkeyup: false,
  rules: {
    companyName: { required: true },
    phone: { required: true },
    address: { required: true },
    city: { required: true },
    state: { required: true },
    zipcode: { required: true },
    category: { required: true },
    url: { url: true }
    
  },
  messages: {
  },
  submitHandler: function(form) {
	  
	  $('#merchantSaveDetails').addClass('disabled');
	  
	  $.ajax({
	    url: siteUrl+'merchant/updateProfile',
	    type: 'POST',
	    data: $(form).serialize(),
	    success: function (data) {
		    $('div.mh-sidebar').html(data);
		    $('#merchantSaveDetails').removeClass('disabled');
		    $('#profileDetailsModal').modal('hide');
	    }
	});
  },
});

//Profile Details Logo Upload
$(document).ready(function() {
	var token  = $('meta[name="csrf-token"]').attr('content');
	var flag = 0;
	var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'pickProfileImage', // you can pass an id...
	container: document.getElementById('logoContainer'), // ... or DOM Element itself
	url : siteUrl+'/upload-photo',
	flash_swf_url : '../js/Moxie.swf',
	silverlight_xap_url : '../js/Moxie.xap',
	
	multipart_params : {
        _token : token,
    },
	
	filters : {
		max_file_size : '10mb',
		mime_types: [
			{title : "Image files", extensions : "jpg,gif,png"}
		]
	},

	init: {
		PostInit: function() {
			document.getElementById('profileImageList').innerHTML = '';

			document.getElementById('uploadProfileImage').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('profileImageList').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},
		
		Uploadfile: function() {
			
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},
		
		FileUploaded: function(up, file, response) {
			var file = response.response;
			
			$.ajax({
			    url: siteUrl+'merchant/changeProfileImage',
			    type: 'POST',
			    data: {
				    _token:     CSRF_TOKEN,
				    profileImage: file,
				},
			    success: function (data) {
				    $('.merchant-hero').attr('style', 'background: url( '+siteUrl+'uploads/'+file+' ) no-repeat center top;background-size:cover');
			    }
			});
			
			
		},
		
		UploadComplete: function(up, file) {
			$('#profileImageModal').modal('hide');
			document.getElementById('profileImageList').innerHTML = '';
			
		},

		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
		}
	}
});

uploader.init();
});

$(document).ready(function() {
	$('.datepicker').datepicker({
	    minDate: 0, // your min date
	    maxDate: '+10d' // one week will always be 5 business day - not sure if you are including current day
	});
});

function dealImages() {
		var token  = $('meta[name="csrf-token"]').attr('content');
		var flag = 0;
		var uploader4 = new plupload.Uploader({
		runtimes : 'html5,flash,silverlight,html4',
		browse_button : 'pickLargePhoto', // you can pass an id...
		container: document.getElementById('deal-large-container'), // ... or DOM Element itself
		url : siteUrl+'/upload-photo',
		flash_swf_url : '../js/Moxie.swf',
		silverlight_xap_url : '../js/Moxie.xap',
		
		multipart_params : {
	        _token : token,
	    },
	    
	    multi_selection:false,
		
		filters : {
			max_file_size : '10mb',
			mime_types: [
				{title : "Image files", extensions : "jpg,gif,png"}
			]
		},
	
		init: {
			PostInit: function() {
				document.getElementById('dealLargeList').innerHTML = '';
	
				document.getElementById('uploadLargePhoto').onclick = function() {
					uploader4.start();
					return false;
				};
			},
	
			FilesAdded: function(up, files) {
				plupload.each(files, function(file) {
					document.getElementById('dealLargeList').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
				});
			},
			
			Uploadfile: function() {
				$('#newDealSubmit').addClass('disabled');
			},
	
			UploadProgress: function(up, file) {
				document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			},
			
			FileUploaded: function(up, file, response) {
				var file = response.response;	
				$('#largeImage').val(file);
			},
			
			UploadComplete: function(up, file) {
				$('#newDealSubmit').removeClass('disabled');
				document.getElementById('dealLargeList').innerHTML = '';
				
			},
	
			Error: function(up, err) {
				document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
			}
		}
	});
	
	uploader4.init();
	
	
		var token  = $('meta[name="csrf-token"]').attr('content');
		var flag = 0;
		var uploader5 = new plupload.Uploader({
		runtimes : 'html5,flash,silverlight,html4',
		browse_button : 'pickSquarePhoto', // you can pass an id...
		container: document.getElementById('deal-large-container'), // ... or DOM Element itself
		url : siteUrl+'/upload-photo',
		flash_swf_url : '../js/Moxie.swf',
		silverlight_xap_url : '../js/Moxie.xap',
		
		multipart_params : {
	        _token : token,
	    },
	    
	    multi_selection:false,
		
		filters : {
			max_file_size : '10mb',
			mime_types: [
				{title : "Image files", extensions : "jpg,gif,png"}
			]
		},
	
		init: {
			PostInit: function() {
				document.getElementById('dealSquareList').innerHTML = '';
	
				document.getElementById('uploadSquarePhoto').onclick = function() {
					uploader5.start();
					return false;
				};
			},
	
			FilesAdded: function(up, files) {
				plupload.each(files, function(file) {
					document.getElementById('dealSquareList').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
				});
			},
			
			Uploadfile: function() {
				$('#newDealSubmit').addClass('disabled');
			},
	
			UploadProgress: function(up, file) {
				document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			},
			
			FileUploaded: function(up, file, response) {
				var file = response.response;	
				$('#squareImage').val(file);
			},
			
			UploadComplete: function(up, file) {
				$('#newDealSubmit').removeClass('disabled');
				document.getElementById('dealSquareList').innerHTML = '';
				
			},
	
			Error: function(up, err) {
				document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
			}
		}
	});
	
	uploader5.init();
}


function editDealImages() {
		var token  = $('meta[name="csrf-token"]').attr('content');
		var flag = 0;
		var uploader1 = new plupload.Uploader({
		runtimes : 'html5,flash,silverlight,html4',
		browse_button : 'pickLargePhotoEdit', // you can pass an id...
		container: document.getElementById('deal-large-container-edit'), // ... or DOM Element itself
		url : siteUrl+'/upload-photo',
		flash_swf_url : '../js/Moxie.swf',
		silverlight_xap_url : '../js/Moxie.xap',
		
		multipart_params : {
	        _token : token,
	    },
	    
	    multi_selection:false,
		
		filters : {
			max_file_size : '10mb',
			mime_types: [
				{title : "Image files", extensions : "jpg,gif,png"}
			]
		},
	
		init: {
			PostInit: function() {
				document.getElementById('dealLargeListEdit').innerHTML = '';
	
				document.getElementById('uploadLargePhotoEdit').onclick = function() {
					uploader1.start();
					return false;
				};
			},
	
			FilesAdded: function(up, files) {
				plupload.each(files, function(file) {
					document.getElementById('dealLargeListEdit').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
				});
			},
			
			Uploadfile: function() {
				$('#editDealSubmit').addClass('disabled');
			},
	
			UploadProgress: function(up, file) {
				document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			},
			
			FileUploaded: function(up, file, response) {
				var file = response.response;	
				$('#largeImageEdit').val(file);
			},
			
			UploadComplete: function(up, file) {
				$('#editDealSubmit').removeClass('disabled');
				document.getElementById('dealLargeListEdit').innerHTML = '';
				
			},
	
			Error: function(up, err) {
				document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
			}
		}
	});
	
	uploader1.init();
	
	
		var token  = $('meta[name="csrf-token"]').attr('content');
		var flag = 0;
		var uploader2 = new plupload.Uploader({
		runtimes : 'html5,flash,silverlight,html4',
		browse_button : 'pickSquarePhotoEdit', // you can pass an id...
		container: document.getElementById('deal-square-container-edit'), // ... or DOM Element itself
		url : siteUrl+'/upload-photo',
		flash_swf_url : '../js/Moxie.swf',
		silverlight_xap_url : '../js/Moxie.xap',
		
		multipart_params : {
	        _token : token,
	    },
	    
	    multi_selection:false,
		
		filters : {
			max_file_size : '10mb',
			mime_types: [
				{title : "Image files", extensions : "jpg,gif,png"}
			]
		},
	
		init: {
			PostInit: function() {
				document.getElementById('dealSquareListEdit').innerHTML = '';
	
				document.getElementById('uploadSquarePhotoEdit').onclick = function() {
					uploader2.start();
					return false;
				};
			},
	
			FilesAdded: function(up, files) {
				plupload.each(files, function(file) {
					document.getElementById('dealSquareListEdit').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
				});
			},
			
			Uploadfile: function() {
				$('#editDealSubmit').addClass('disabled');
			},
	
			UploadProgress: function(up, file) {
				document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			},
			
			FileUploaded: function(up, file, response) {
				var file = response.response;	
				$('#squareImageEdit').val(file);
			},
			
			UploadComplete: function(up, file) {
				$('#editDealSubmit').removeClass('disabled');
				document.getElementById('dealSquareListEdit').innerHTML = '';
				
			},
	
			Error: function(up, err) {
				document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
			}
		}
	});
	
	uploader2.init();
}

$(document).ready(function() {
	dealImages();
});

//Vendor Add Deal Form...
$("#vendor-add-deal-form").validate({
    errorClass:'error',
    validClass:'success',
    errorElement:'span',
  onkeyup: false,
  rules: {
    title: { required: true },
    tagline: { required: true },
    description: { required: true },
    redemptionInstructions: { required: true }
    
  },
  messages: {
  },
  submitHandler: function(form) {
	  
	  $('#newDealSubmit').addClass('disabled');
	  
	  var lgImage = $('#largeImage').val();
	  var sqImage = $('#squareImage').val();
	  
	  if(!lgImage || !sqImage) {
		  
		  alert('You must upload both a square image and a large image for this deal!');
		  
	  }else {
	  
		  $.ajax({
		    url: siteUrl+'merchant/addNewDeal',
		    type: 'POST',
		    data: $(form).serialize(),
		    success: function (data) {
			    $('#deal-loader').html(data);
			    $('#newDealModal').modal('hide');
			    $(form).reset();
		    }
		  });
	}
  },
});

//Delete Deal
$(document).on('click', '.deleteDeal', function(e) {
	e.preventDefault();
	var btn = $(this);
	var id = $(btn).attr('data-deal-id');
	
	$('i', btn).removeClass('fa-times').addClass('fa-spinner fa-spin');
	$(btn).addClass('disabled');
	
	$.ajax({
		url: siteUrl+'merchant/deleteDeal',
		type: 'POST',
		data: {
			_token:     CSRF_TOKEN,
			id: id
		},
		success: function (data) {
		    $('#deal-loader').html(data);
		}
	});
});

$(document).on('click', '.editDeal', function(e) {
	e.preventDefault();
	var btn = $(this);
	var id = $(btn).attr('data-deal-id');
	
	$.ajax({
		url: siteUrl+'merchant/editDeal',
		type: 'POST',
		data: {
			_token:     CSRF_TOKEN,
			id: id
		},
		success: function (data) {
		    $('#edit-deal-loader').html(data);
		    $('#editDealModal').modal('show');
		    $('.datepicker').datepicker({
			    minDate: 0, // your min date
			    maxDate: '+10d' // one week will always be 5 business day - not sure if you are including current day
			});
			editDealImages();
		    
		    //Vendor Add Deal Form...
			$("#vendor-edit-deal-form").validate({
			    errorClass:'error',
			    validClass:'success',
			    errorElement:'span',
			  onkeyup: false,
			  rules: {
			    title: { required: true },
			    tagline: { required: true },
			    description: { required: true },
			    redemptionInstructions: { required: true }
			    
			  },
			  messages: {
			  },
			  submitHandler: function(form) {
				  
				  $('#editDealSubmit').addClass('disabled');
				  
				  $.ajax({
				    url: siteUrl+'merchant/saveDealChanges',
				    type: 'POST',
				    data: $(form).serialize(),
				    success: function (data) {
					    $('#deal-loader').html(data);
					    $('#editDealModal').modal('hide');
					    $(form).reset();
				    }
				  });
			  },
			});
		    
		}
	});
});


