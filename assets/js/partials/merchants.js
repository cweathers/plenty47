var siteUrl = $('#siteUrl').val();

//Mask all inputs with type of "phone"
$(document).ready(function() {
	$("#phone").mask("(999) 999-9999");
});

//Validate vendor/merchant signup form...
$("#merchant-signup").validate({
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
    companyName: { required: true },
    phone: { required: true },
    address: { required: true },
    city: { required: true },
    state: { required: true },
    zipcode: { required: true },
    url: { url: true }
    
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

function slugify(text) {
  
  return text.toString().toLowerCase()
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '');            // Trim - from end of text
}

$(document).on('blur', '#slug', function() {
	var text = $(this).val();
	var slug = slugify(text);
	$(this).val(slug);
});

//Validate vendor/merchant signup form...
$("#merchant-enhance-profile").validate({
    errorClass:'error',
    validClass:'success',
    errorElement:'span',
  onkeyup: false,
  rules: {
    slug: {
      required: true,
      remote: {
        url: siteUrl+"merchant/check-slug",
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
	browse_button : 'pickfiles', // you can pass an id...
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
			document.getElementById('filelist').innerHTML = '';

			document.getElementById('uploadfiles').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},
		
		Uploadfile: function() {
			$('#merchant-enhance-profile button').addClass('disabled');
			if(flag === 0) {
				$('#uploadfiles').html('<i class="fa fa-circle-o-notch fa-spin"></i> Uploading...').addClass('disabled');
				flag = 1;
			}
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},
		
		FileUploaded: function(up, file, response) {
			var file = response.response;
			$('#merchant-enhance-profile').append('<input type="hidden" name="photos[]" value="'+file+'">');
		},
		
		UploadComplete: function(up, file) {
			$('#merchant-enhance-profile button').removeClass('disabled');
			$('#uploadfiles').html('Upload Photos').removeClass('disabled');
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
	browse_button : 'pickLogo', // you can pass an id...
	container: document.getElementById('logoContainer'), // ... or DOM Element itself
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
			document.getElementById('logolist').innerHTML = '';

			document.getElementById('uploadLogo').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('logolist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},
		
		Uploadfile: function() {
			$('#merchant-enhance-profile button').addClass('disabled');
			if(flag === 0) {
				$('#uploadLogo').html('<i class="fa fa-circle-o-notch fa-spin"></i> Uploading...').addClass('disabled');
				flag = 1;
			}
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},
		
		FileUploaded: function(up, file, response) {
			var file = response.response;
			$('#merchant-enhance-profile').append('<input type="hidden" name="logo" value="'+file+'">');
		},
		
		UploadComplete: function(up, file) {
			$('#merchant-enhance-profile button').removeClass('disabled');
			$('#uploadLogo').html('Upload Logo').removeClass('disabled');
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
	browse_button : 'pickCover', // you can pass an id...
	container: document.getElementById('coverContainer'), // ... or DOM Element itself
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
			document.getElementById('coverlist').innerHTML = '';

			document.getElementById('uploadCover').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('coverlist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},
		
		Uploadfile: function() {
			$('#merchant-enhance-profile button').addClass('disabled');
			if(flag === 0) {
				$('#uploadCover').html('<i class="fa fa-circle-o-notch fa-spin"></i> Uploading...').addClass('disabled');
				flag = 1;
			}
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},
		
		FileUploaded: function(up, file, response) {
			var file = response.response;
			$('#merchant-enhance-profile').append('<input type="hidden" name="profileImage" value="'+file+'">');
		},
		
		UploadComplete: function(up, file) {
			$('#merchant-enhance-profile button').removeClass('disabled');
			$('#uploadCover').html('Upload Logo').removeClass('disabled');
			flag = 0;
		},

		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
		}
	}
});

uploader.init();
});



//Hours
$(document).on('click', '.remove-hours', function(e) {
	e.preventDefault();
	$(this).parents('tr').remove();
});

$(document).on('click', '.add-hours', function(e) {
	e.preventDefault();
	$('table#hoursTable').append('<tr><td><input type="text" name="label[]" class="form-control" placeholder="mon-fri, sat, etc..."></td><td><input type="text" name="hours[]" class="form-control" placeholder="8am-5pm, till 7pm, etc..."></td><td class="text-center"><a href="#" class="btn btn-danger remove-hours"><i class="fa fa-times"></i></a></td></tr>');
});
