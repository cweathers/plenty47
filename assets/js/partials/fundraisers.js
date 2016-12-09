function tcp() {
	$('.tc-lg').removeAttr('style');
	if($(window).width() >= 768) {
		$('.tc-lg').equalHeights();
	}
}

$(document).ready(function() {
	tcp();
});

$(window).resize(function() {
	tcp();
});

//Validate vendor/merchant signup form...
$("#fundraiser-signup").validate({
    errorClass:'error',
    validClass:'success',
    errorElement:'span',
  onkeyup: false,
  rules: {
    email: {
      required: true,
      email: true,
      remote: {
        url: siteUrl+"merchant/check-email",
        type: "post",
        data: {
	      _token: function() { return $('meta[name="csrf-token"]').attr('content'); },
          email: function() { return $("#email").val(); },
        }
      }
    },
    firstName: { required: true },
    lastName: { required: true },
    password: { required: true },
    passwordConf: { 
	    required: true,
	    equalTo: '#password'
    },
    groupName: { required: true },
    category: { required: true },
    phone: { required: true },
    address: { required: true },
    city: { required: true },
    state: { required: true },
    zipcode: { required: true }
    
  },
  messages: {
    email: {
      remote: "This email address already exists!"
    }
  },
  submitHandler: function(form) {
	  form.submit();
  },
});

//Validate vendor/merchant signup form...
$("#fundraiser-enhance-profile").validate({
    errorClass:'error',
    validClass:'success',
    errorElement:'span',
  onkeyup: false,
  rules: {
    slug: {
      required: true,
      remote: {
        url: siteUrl+"fundraiser/check-slug",
        type: "post",
        data: {
	      _token: function() { return $('meta[name="csrf-token"]').attr('content'); },
          slug: function() { return $("#slug").val(); },
        }
      }
    }
    
  },
  messages: {
    slug: {
      remote: "This url already exists. Your url slug must be unique!"
    }
  },
  submitHandler: function(form) {
	  form.submit();
  },
});


$(document).ready(function() {
	var token  = $('meta[name="csrf-token"]').attr('content');
	var flag = 0;
	var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'fr-pickfiles', // you can pass an id...
	container: document.getElementById('fr-container'), // ... or DOM Element itself
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
			document.getElementById('fr-filelist').innerHTML = '';

			document.getElementById('fr-uploadfiles').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('fr-filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},
		
		Uploadfile: function() {
			$('#fundraiser-enhance-profile button').addClass('disabled');
			if(flag === 0) {
				$('#fr-uploadfiles').html('<i class="fa fa-circle-o-notch fa-spin"></i> Uploading...').addClass('disabled');
				flag = 1;
			}
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},
		
		FileUploaded: function(up, file, response) {
			var file = response.response;
			$('#fundraiser-enhance-profile').append('<input type="hidden" name="photos[]" value="'+file+'">');
		},
		
		UploadComplete: function(up, file) {
			$('#fundraiser-enhance-profile button').removeClass('disabled');
			$('#fr-uploadfiles').html('Upload Photos').removeClass('disabled');
			flag = 0;
		},

		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
		}
	}
});

uploader.init();
});

$(document).ready(function() {
	var token  = $('meta[name="csrf-token"]').attr('content');
	var flag = 0;
	var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'fr-pickLogo', // you can pass an id...
	container: document.getElementById('fr-logoContainer'), // ... or DOM Element itself
	url : siteUrl+'/upload-photo',
	flash_swf_url : '../js/Moxie.swf',
	silverlight_xap_url : '../js/Moxie.xap',
	multi_selection: false,
	
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
			document.getElementById('fr-logolist').innerHTML = '';

			document.getElementById('fr-uploadLogo').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('fr-logolist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},
		
		Uploadfile: function() {
			$('#fundraiser-enhance-profile button').addClass('disabled');
			if(flag === 0) {
				$('#fr-uploadLogo').html('<i class="fa fa-circle-o-notch fa-spin"></i> Uploading...').addClass('disabled');
				flag = 1;
			}
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},
		
		FileUploaded: function(up, file, response) {
			var file = response.response;
			$('#fundraiser-enhance-profile').append('<input type="hidden" name="logo" value="'+file+'">');
		},
		
		UploadComplete: function(up, file) {
			$('#fundraiser-enhance-profile button').removeClass('disabled');
			$('#fr-uploadLogo').html('Upload Logo').removeClass('disabled');
			flag = 0;
		},

		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
		}
	}
});

uploader.init();
});

$(document).ready(function() {
	var token  = $('meta[name="csrf-token"]').attr('content');
	var flag = 0;
	var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'fr-pickCover', // you can pass an id...
	container: document.getElementById('fr-coverContainer'), // ... or DOM Element itself
	url : siteUrl+'/upload-photo',
	flash_swf_url : '../js/Moxie.swf',
	silverlight_xap_url : '../js/Moxie.xap',
	multi_selection: false,
	
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
			document.getElementById('fr-coverlist').innerHTML = '';

			document.getElementById('fr-uploadCover').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('fr-coverlist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},
		
		Uploadfile: function() {
			$('#fundraiser-enhance-profile button').addClass('disabled');
			if(flag === 0) {
				$('#fr-uploadCover').html('<i class="fa fa-circle-o-notch fa-spin"></i> Uploading...').addClass('disabled');
				flag = 1;
			}
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},
		
		FileUploaded: function(up, file, response) {
			var file = response.response;
			$('#fundraiser-enhance-profile').append('<input type="hidden" name="profileImage" value="'+file+'">');
		},
		
		UploadComplete: function(up, file) {
			$('#fundraiser-enhance-profile button').removeClass('disabled');
			$('#fr-uploadCover').html('Upload Logo').removeClass('disabled');
			flag = 0;
		},

		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
		}
	}
});

uploader.init();
});

//Add more photos
$(document).ready(function() {
	var token  = $('meta[name="csrf-token"]').attr('content');
	var flag = 0;
	var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'frg-pickphoto', // you can pass an id...
	container: document.getElementById('frg-container'), // ... or DOM Element itself
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
			document.getElementById('frg-photolist').innerHTML = '';

			document.getElementById('frg-uploadphoto').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('frg-photolist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
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
			    url: siteUrl+'fundraiser/newPhoto',
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
			document.getElementById('frg-photolist').innerHTML = '';
			
		},

		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
		}
	}
});

uploader.init();
});

//Save fact
$(document).on('click', '.fundraiser-saveFact', function(e) {
	
	e.preventDefault();
	
	var btn = $(this);
	var id = $(btn).attr('data-id');
	var fact = $('#fact-text-'+id).val();
	
	$('i', btn).removeClass('fa-check').addClass('fa-spinner fa-spin');
	
	$.ajax({
	    url: siteUrl+'fundraiser/saveFact',
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
$(document).on('click', '.fundraiser-removeFact', function(e) {
	
	e.preventDefault();
	
	var btn = $(this);
	var id = $(btn).attr('data-id');
	
	$('i', btn).removeClass('fa-check').addClass('fa-spinner fa-spin');
	
	$.ajax({
	    url: siteUrl+'fundraiser/deleteFact',
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
$(document).on('click', '.fundraiser-addFact', function(e) {
	
	e.preventDefault();
	
	if($('#fact-row-new').length > 0) {
		alert('please finish the fact you already added!');
	}else {
	
		$('table#factTable').append('<tr id="fact-row-new"><td><input type="text" class="newFact form-control" value=""></td><td class="text-center"><a href="#" class="fundraiser-newFact btn btn-success"><i class="fa fa-check"></i></a> <a href="#" class="fundraiser-removeNewFact btn btn-danger"><i class="fa fa-times"></i></a></tr>');
		
	}
});

//Delete Fact
$(document).on('click', '.fundraiser-removeNewFact', function(e) {
	
	e.preventDefault();
	
	$('#fact-row-new').remove();
});

//New Fact
$(document).on('click', '.fundraiser-newFact', function(e) {
	
	e.preventDefault();
	
	var btn = $(this);
	var text = $('input.newFact').val();
	
	$('i', btn).removeClass('fa-check').addClass('fa-spinner fa-spin');
	
	$.ajax({
	    url: siteUrl+'fundraiser/newFact',
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

//Add more photos
$(document).ready(function() {
	var token  = $('meta[name="csrf-token"]').attr('content');
	var flag = 0;
	var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'fundraiserPickPhotos', // you can pass an id...
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
			{title : "Image files", extensions : "jpg,gif,png,jpeg,JPG,GIF,PNG"}
		]
	},

	init: {
		PostInit: function() {
			document.getElementById('fundraiserPhotoList').innerHTML = '';

			document.getElementById('fundraiserUploadPhotos').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('fundraiserPhotoList').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
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
			    url: siteUrl+'fundraiser/newPhoto',
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
			document.getElementById('fundraiserPhotoList').innerHTML = '';
			
		},

		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
		}
	}
});

uploader.init();
});

//Delete Photo
$(document).on('click', '.fundraiser-deletePhoto', function(e) {
	
	e.preventDefault();
	
	var btn = $(this);
	var id = $(btn).attr('data-id');
	
	$('i', btn).removeClass('fa-check').addClass('fa-spinner fa-spin');
	
	$.ajax({
	    url: siteUrl+'fundraiser/deletePhoto',
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
	browse_button : 'fr-profpickLogo', // you can pass an id...
	container: document.getElementById('fr-logoContainer'), // ... or DOM Element itself
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
			document.getElementById('fr-proflogolist').innerHTML = '';

			document.getElementById('fr-profuploadLogo').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('fr-proflogolist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},
		
		Uploadfile: function() {
			$('#fundraiserSaveDetails').addClass('disabled');
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},
		
		FileUploaded: function(up, file, response) {
			var file = response.response;
			
			$.ajax({
			    url: siteUrl+'fundraiser/changeLogo',
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
			$('#fundraiserSaveDetails').removeClass('disabled');
			document.getElementById('fr-proflogolist').innerHTML = '';
			
		},

		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
		}
	}
});

uploader.init();
});

//Profile Details Profile Image Upload
$(document).ready(function() {
	var token  = $('meta[name="csrf-token"]').attr('content');
	var flag = 0;
	var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'frProfilePickLogo', // you can pass an id...
	container: document.getElementById('frProfileContainer'), // ... or DOM Element itself
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
			document.getElementById('frProfileList').innerHTML = '';

			document.getElementById('frProfileUploadLogo').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('frProfileList').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},
		
		Uploadfile: function() {
			$('#fundraiserSaveDetails').addClass('disabled');
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},
		
		FileUploaded: function(up, file, response) {
			var file = response.response;
			
			$.ajax({
			    url: siteUrl+'fundraiser/changeProfileImage',
			    type: 'POST',
			    data: {
				    _token:     CSRF_TOKEN,
				    profileImage: file,
				},
			    success: function (data) {
				    $('img.currentProfileImage').attr('src', siteUrl+'uploads/'+file);
			    }
			});
			
			
		},
		
		UploadComplete: function(up, file) {
			$('#fundraiserSaveDetails').removeClass('disabled');
			document.getElementById('frProfileList').innerHTML = '';
			
		},

		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
		}
	}
});

uploader.init();
});

//Validate merchant profile details...
$("#fundraiser-profile-details-form").validate({
    errorClass:'error',
    validClass:'success',
    errorElement:'span',
  onkeyup: false,
  rules: {
    groupName: { required: true },
    phone: { required: true },
    address: { required: true },
    city: { required: true },
    state: { required: true },
    zipcode: { required: true },
    category: { required: true },
    
  },
  messages: {
  },
  submitHandler: function(form) {
	  
	  $('#fundraiserSaveDetails').addClass('disabled');
	  
	  $.ajax({
	    url: siteUrl+'fundraiser/updateProfile',
	    type: 'POST',
	    data: $(form).serialize(),
	    success: function (data) {
		    $('#fr-dets').html(data);
		    $('#fundraiserSaveDetails').removeClass('disabled');
		    $('#profileDetailsModal').modal('hide');
	    }
	});
  },
});

//About Us Text
$(document).on('click', '.fr-saveAboutUs', function(e) {
	e.preventDefault();
	
	var aboutUs = $('#aboutUsText').val();
	var btn = $(this);
	
	$('i', btn).removeClass('fa-check').addClass('fa-spinner fa-spin');
	
	$.ajax({
	    url: siteUrl+'fundraiser/updateAboutUs',
	    type: 'POST',
	    data: {
		    _token: CSRF_TOKEN,
		    aboutUs: aboutUs
	    },
	    success: function (data) {
		    $('i', btn).removeClass('fa-spinner fa-spin').addClass('fa-check');
	    }
	});
});

//Our Cause Text
$(document).on('click', '.fr-saveOurCause', function(e) {
	e.preventDefault();
	
	var ourCause = $('#ourCauseText').val();
	var btn = $(this);
	
	$('i', btn).removeClass('fa-check').addClass('fa-spinner fa-spin');
	
	$.ajax({
	    url: siteUrl+'fundraiser/updateOurCause',
	    type: 'POST',
	    data: {
		    _token: CSRF_TOKEN,
		    ourCause: ourCause
	    },
	    success: function (data) {
		    $('i', btn).removeClass('fa-spinner fa-spin').addClass('fa-check');
	    }
	});
});

//Our Cause Text
$(document).on('click', '#fr-saveVideoLink', function(e) {
	e.preventDefault();
	
	var videoLink = $('#videoLink').val();
	var btn = $(this);
	
	$('i', btn).removeClass('fa-check').addClass('fa-spinner fa-spin');
	
	$.ajax({
	    url: siteUrl+'fundraiser/updateVideoLink',
	    type: 'POST',
	    data: {
		    _token: CSRF_TOKEN,
		    videoLink: videoLink
	    },
	    success: function (data) {
		    $('i', btn).removeClass('fa-spinner fa-spin').addClass('fa-check');
		    $('#currentVideo').html(data);
	    }
	});
});

//Add Salesperson Form...
$("#add-salesperson-form").validate({
    errorClass:'error',
    validClass:'success',
    errorElement:'span',
  onkeyup: false,
  rules: {
    firstName: { required: true },
    lastName: { required: true },
    
  },
  submitHandler: function(form) {
	  form.submit();
  },
});

//Generate link...
$(document).on('change', '#salespeople', function() {
	var select = $(this);
	var fundraiser_id = $('#salespersonFRID').val();
	var salesperson_id = $(select).val();
	var url = siteUrl+'vip-signup?fundraiser='+fundraiser_id+'&salesperson='+salesperson_id;
	window.prompt ("Copy to clipboard: Ctrl+C, Enter", url);
});