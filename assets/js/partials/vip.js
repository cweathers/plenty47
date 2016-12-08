$(document).ready(function() {
	$("#card_number").mask("9999-9999-9999-9999");
	$("#phone").mask("(999) 999-9999");
	$("#zipcode").mask("99999");
});

//Validate vendor/merchant signup form...
$("#check-card-form").validate({
    errorClass:'error',
    validClass:'success',
    errorElement:'span',
  onkeyup: false,
  rules: {
    card_number: {
      required: true,
      remote: {
        url: siteUrl+"vip-signup/validate-card",
        type: "post",
        data: {
	      _token: function() { return $('meta[name="csrf-token"]').attr('content'); },
          card_number: function() { return $("#card_number").val(); },
        }
      }
    }
  },
  messages: {
    card_number: {
      remote: "This card number is not a VIP card number!"
    }
  },
  submitHandler: function(form) {
	  form.submit();
  },
});

//Validate vendor/merchant signup form...
$("#vip-account-signup").validate({
    errorClass:'error',
    validClass:'success',
    errorElement:'span',
  onkeyup: false,
  rules: {
    email: {
      required: true,
      remote: {
        url: siteUrl+"vip-signup/check-email",
        type: "post",
        data: {
	      _token: function() { return $('meta[name="csrf-token"]').attr('content'); },
          email: function() { return $("#email").val(); },
        }
      }
    },
    firstName: { required: true },
    lastName: { required: true },
    address: { required: true },
    city: { required: true },
    state: { required: true },
    zipcode: { required: true },
    phone: { required: true },
    password: { required: true },
    passwordConf: { 
	    required: true,
	    equalTo: '#password'
    },
  },
  messages: {
    email: {
      remote: "This email is already taken!"
    }
  },
  submitHandler: function(form) {
	  form.submit();
  },
});

//Validate vendor/merchant signup form...
$("#vip-account-signup-update").validate({
    errorClass:'error',
    validClass:'success',
    errorElement:'span',
  onkeyup: false,
  rules: {
    email: {
      required: true,
      remote: {
        url: siteUrl+"vip-signup/check-email-update",
        type: "post",
        data: {
	      _token: function() { return $('meta[name="csrf-token"]').attr('content'); },
          email: function() { return $("#email").val(); },
        }
      }
    },
    firstName: { required: true },
    lastName: { required: true },
    address: { required: true },
    city: { required: true },
    state: { required: true },
    zipcode: { required: true },
    phone: { required: true },
    password: { required: true },
    passwordConf: { 
	    required: true,
	    equalTo: '#password'
    },
  },
  messages: {
    email: {
      remote: "This email is already taken!"
    }
  },
  submitHandler: function(form) {
	  form.submit();
  },
});

//Select Fundraiser
$(document).on('click', '.select-fundraiser', function(e) {
	e.preventDefault();
	var btn = $(this);
	var id = $(btn).attr('data-id');
	
	//Remove active states on all btns
	$('a.select-fundraiser').removeClass('active');
	$('a.select-fundraiser > i').removeClass('fa-check-square').addClass('fa-square');
	
	$('#fundraiser_id').val(id);
	$('i', btn).removeClass('fa-square').addClass('fa-check-square');
	$(btn).addClass('active');
});

$('#vip-fundraiser-form').submit(function(e) {
	e.preventDefault();
	var form = $(this);
	var fundraiser = $('#fundraiser_id').val();
	if(!fundraiser) {
		$('#fundraiser-error').fadeIn();
	}else {
		$('#fundraiser-error').fadeOut();
		$('#vip-fundraiser-form').get(0).submit();
	}
});

$(document).on('click', '#billingSame', function() {
	if($(this).is(':checked')) {
		$('.shipping-address').slideUp();
	}else {
		$('.shipping-address').slideDown();
	}
});

//Recommend Profile
$(document).on('click', '.recMerchant', function(e) {
	e.preventDefault();
	var btn = $(this);
	var vendorId = $(btn).attr('data-vendor-id');
	var userId = $(btn).attr('data-user-id');
	var state = $(btn).attr('data-state');
	
	if(state == 0) {
	
		$('.recImg').remove();
		$(btn).append('<i class="fa fa-spinner fa-spin"></i>');
		
		$.ajax({
		    url: siteUrl+'vip/saveRecommendation',
		    type: 'POST',
		    data: {
			    _token:     CSRF_TOKEN,
			    vendorId: vendorId,
			    userId: userId,
			    state: state
			},
		    success: function (data) {
		        $('i', btn).removeClass('fa-spin fa-spinner').addClass('fa-check');
		        $(btn).addClass('active').attr('data-state', 1);
		    }
		});
		
	}else {
		
		$('i', btn).removeClass('fa-check').addClass('fa-spinner fa-spin');
		
		$.ajax({
		    url: siteUrl+'vip/saveRecommendation',
		    type: 'POST',
		    data: {
			    _token:     CSRF_TOKEN,
			    vendorId: vendorId,
			    userId: userId,
			    state: state
			},
		    success: function (data) {
		        $('i', btn).remove();
		        $(btn).attr('data-state', 0).removeClass('active').append('<img class="recImg" src="'+siteUrl+'assets/img/icons/recommend-white.png" width="15" height="15">');
		    }
		});
		
	}
	
});

//Recommend Profile
$(document).on('click', '.recMerchant-frontend', function(e) {
	e.preventDefault();
	var btn = $(this);
	var vendorId = $(btn).attr('data-vendor-id');
	var userId = $(btn).attr('data-user-id');
	var state = $(btn).attr('data-state');
	
	if(state == 0) {
	
		$('img', btn).fadeOut();
		
		$.ajax({
		    url: siteUrl+'vip/saveRecommendation',
		    type: 'POST',
		    data: {
			    _token:     CSRF_TOKEN,
			    vendorId: vendorId,
			    userId: userId,
			    state: state
			},
		    success: function (data) {
		        $(btn).append('<i class="fa fa-check green-check"></i>');
		        $(btn).attr('data-state', 1);
		    }
		});
		
	}else {
		
		$('i', btn).remove().append('<i class="fa fa-spinner fa-spin"></i>');
		
		$.ajax({
		    url: siteUrl+'vip/saveRecommendation',
		    type: 'POST',
		    data: {
			    _token:     CSRF_TOKEN,
			    vendorId: vendorId,
			    userId: userId,
			    state: state
			},
		    success: function (data) {
		        $('i', btn).remove();
		        $(btn).attr('data-state', 0);
		        $('img', btn).fadeIn();
		    }
		});
		
	}
	
});

//Recommend Profile From Listings
$(document).on('click', '.bookmarkMerchant', function(e) {
	e.preventDefault();
	var btn = $(this);
	var vendorId = $(btn).attr('data-vendor-id');
	var userId = $(btn).attr('data-user-id');
	var state = $(btn).attr('data-state');
	
	if(state == 0) {
	
		$('.bkImg').remove();
		$(btn).append('<i class="fa fa-spinner fa-spin"></i>');
		
		$.ajax({
		    url: siteUrl+'vip/saveBookmark',
		    type: 'POST',
		    data: {
			    _token:     CSRF_TOKEN,
			    vendorId: vendorId,
			    userId: userId,
			    state: state
			},
		    success: function (data) {
		        $('i', btn).removeClass('fa-spin fa-spinner').addClass('fa-check');
		        $(btn).addClass('active').attr('data-state', 1);
		    }
		});
		
	}else {
		
		$('i', btn).removeClass('fa-check').addClass('fa-spinner fa-spin');
		
		$.ajax({
		    url: siteUrl+'vip/saveBookmark',
		    type: 'POST',
		    data: {
			    _token:     CSRF_TOKEN,
			    vendorId: vendorId,
			    userId: userId,
			    state: state
			},
		    success: function (data) {
		        $('i', btn).remove();
		        $(btn).attr('data-state', 0).removeClass('active').append('<img class="bkImg" src="'+siteUrl+'assets/img/icons/bookmark-white.png" width="15" height="15">');
		    }
		});
		
	}
	
});

//Recommend Profile From Listings
$(document).on('click', '.bookmarkMerchant-frontend', function(e) {
	e.preventDefault();
	var btn = $(this);
	var vendorId = $(btn).attr('data-vendor-id');
	var userId = $(btn).attr('data-user-id');
	var state = $(btn).attr('data-state');
	
	if(state == 0) {
	
		$('img', btn).fadeOut();
		
		$.ajax({
		    url: siteUrl+'vip/saveBookmark',
		    type: 'POST',
		    data: {
			    _token:     CSRF_TOKEN,
			    vendorId: vendorId,
			    userId: userId,
			    state: state
			},
		    success: function (data) {
		        $(btn).append('<i class="fa fa-check green-check"></i>');
		        $(btn).attr('data-state', 1);
		    }
		});
		
	}else {
		
		
		$.ajax({
		    url: siteUrl+'vip/saveBookmark',
		    type: 'POST',
		    data: {
			    _token:     CSRF_TOKEN,
			    vendorId: vendorId,
			    userId: userId,
			    state: state
			},
		    success: function (data) {
		        $('i', btn).remove();
		        $(btn).attr('data-state', 0);
		        $('img', btn).fadeIn();
		    }
		});
		
	}
	
});

//Profile Details Logo Upload
$(document).ready(function() {
	var token  = $('meta[name="csrf-token"]').attr('content');
	var flag = 0;
	var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'vip-pickLogo', // you can pass an id...
	container: document.getElementById('vip-logoContainer'), // ... or DOM Element itself
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
			document.getElementById('vip-logolist').innerHTML = '';

			document.getElementById('vip-uploadLogo').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('vip-logolist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},
		
		Uploadfile: function() {
			$('#saveVipSettings').addClass('disabled');
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},
		
		FileUploaded: function(up, file, response) {
			var file = response.response;
			
			$.ajax({
			    url: siteUrl+'my-account/changeAvatar',
			    type: 'POST',
			    data: {
				    _token:     CSRF_TOKEN,
				    avatar: file,
				},
			    success: function (data) {
				    $('img#vipAvatar').attr('src', siteUrl+'uploads/'+file);
			    }
			});
			
			
		},
		
		UploadComplete: function(up, file) {
			$('#saveVipSettings').removeClass('disabled');
			document.getElementById('vip-logolist').innerHTML = '';
			
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
	browse_button : 'vip-pickCover', // you can pass an id...
	container: document.getElementById('vip-coverContainer'), // ... or DOM Element itself
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
			document.getElementById('vip-coverlist').innerHTML = '';

			document.getElementById('vip-uploadCover').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('vip-coverlist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},
		
		Uploadfile: function() {
			$('#saveVipSettings').addClass('disabled');
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},
		
		FileUploaded: function(up, file, response) {
			var file = response.response;
			
			$.ajax({
			    url: siteUrl+'my-account/changeProfileImage',
			    type: 'POST',
			    data: {
				    _token:     CSRF_TOKEN,
				    profileImage: file,
				},
			    success: function (data) {
				    $('#vipCover').attr('style', 'background: url( '+siteUrl+'/uploads/'+file+' ) no-repeat center top;background-size:cover;');
			    }
			});
			
			
		},
		
		UploadComplete: function(up, file) {
			$('#saveVipSettings').removeClass('disabled');
			document.getElementById('vip-coverlist').innerHTML = '';
			
		},

		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
		}
	}
});

uploader.init();
});

//Vip Settings Form
//Validate vendor/merchant signup form...
$("#vip-settings-form").validate({
    errorClass:'error',
    validClass:'success',
    errorElement:'span',
  onkeyup: false,
  rules: {
    address: { required: true },
    city: { required: true },
	state: { required: true },
	zipcode: { required: true }
  },
  submitHandler: function(form) {
	  form.submit();
  },
});

