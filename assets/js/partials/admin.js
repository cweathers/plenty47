//Fade out alerts
$(document).ready(function() {
	setTimeout(function() {
		$('.admin-content-padder div.alert').slideUp();
	}, 3500);
});

//Sidebar Toggle
$(document).on('click', 'a.toggleAdminSb', function(e) {
	e.preventDefault();
	$('.admin-sb, .admin-content').toggleClass('sb-open');
});

//Datatables
function dataTableSet() {
	var table = $('.datatable').DataTable({
	    responsive: true
    });
}
$(document).ready(function(){
   dataTableSet();
});

//Add Administrator...
$("#add-admin-form").validate({
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
    password: { required: true },
    passwordConfirm: { 
	    required: true,
	    equalTo: '#password'
    },
    
  },
  messages: {
    email: {
      remote: "This email address already exists!"
    }
  },
  submitHandler: function(form) {
	  
	    var tables = $.fn.dataTable.fnTables(true);

		$(tables).each(function () {
		    $(this).dataTable().fnDestroy();
		});
		
		$('button.submitForm').addClass('disabled');
		
		$.ajax({
		    url: siteUrl+'admin/addAdmin',
		    type: 'POST',
		    data: $(form).serialize(),
		    success: function (data) {
		        $('button.submitForm').removeClass('disabled');
		        $('#add-admin-form')[0].reset();
		        $('#addAdminModal').modal('hide');
		        $('#admin-table').html(data);
		        dataTableSet();
		    }
		});
  },
});

function editAdminValidation() {
	//Edit Administrator...
	$("#edit-admin-form").validate({
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
	    
	  },
	  messages: {
	    email: {
	      remote: "This email address already exists!"
	    }
	  },
	  submitHandler: function(form) {
		  
		    var tables = $.fn.dataTable.fnTables(true);
	
			$(tables).each(function () {
			    $(this).dataTable().fnDestroy();
			});
			
			$('button.submitForm').addClass('disabled');
			
			$.ajax({
			    url: siteUrl+'admin/editAdmin',
			    type: 'POST',
			    data: $(form).serialize(),
			    success: function (data) {
			        $('button.submitForm').removeClass('disabled');
			        $('#edit-admin-form')[0].reset();
			        $('#editAdminModal').modal('hide');
			        $('#admin-table').html(data);
			        dataTableSet();
			    }
			});
	  },
	});
}

//grab edit admin form...
$(document).on('click', '.editAdmin', function(e) {
	e.preventDefault();
	var btn = $(this);
	var id = $(btn).attr('data-id');
	
	$.ajax({
		    url: siteUrl+'admin/getAdminDetails',
		    type: 'POST',
		    data: {
				_token: CSRF_TOKEN,
				id: id
		    },
		    success: function (data) {
		        $('#edit-admin-form').html(data);
		        $('#editAdminModal').modal('show');
		        editAdminValidation();
		    }
		});
	
});

//delete an administrator...
$(document).on('click', '.deleteAdmin', function(e) {
	e.preventDefault();
	var btn = $(this);
	var id = $(btn).attr('data-id');
	
	var tables = $.fn.dataTable.fnTables(true);
	
	$(tables).each(function () {
	    $(this).dataTable().fnDestroy();
	});
	
	$.ajax({
		    url: siteUrl+'admin/deleteAdmin',
		    type: 'POST',
		    data: {
				_token: CSRF_TOKEN,
				id: id
		    },
		    success: function (data) {
		        $('#admin-table').html(data);
			    dataTableSet();
		    }
		});
	
});

function editVendorValidation() {
	//Validate merchant profile details...
	$("#edit-vendor-form").validate({
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
	    
	  },
	  messages: {
	  },
	  submitHandler: function(form) {
		  
		  $('#saveVendorEdits').addClass('disabled');
		  
		  $.ajax({
		    url: siteUrl+'admin/updateVendor',
		    type: 'POST',
		    data: $(form).serialize(),
		    success: function (data) {
			    $('#vendor-table').html(data);
			    $('#saveVendorEdits').removeClass('disabled');
			    $('#editVendorModal').modal('hide');
		    }
		});
	  },
	});
}

function adminLogoUpdate() {
	//Profile Details Logo Upload
	var token  = $('meta[name="csrf-token"]').attr('content');
	var id = $('#vendor_id').val();
	var flag = 0;
	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash,silverlight,html4',
		browse_button : 'profpickLogo', // you can pass an id...
		container: document.getElementById('logoContainer'), // ... or DOM Element itself
		url : siteUrl+'/upload-photo',
		flash_swf_url : '../js/Moxie.swf',
		silverlight_xap_url : '../js/Moxie.xap',
		
		multipart_params : {
	        _token : token
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
				$('#saveVendorEdits').addClass('disabled');
			},
	
			UploadProgress: function(up, file) {
				document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			},
			
			FileUploaded: function(up, file, response) {
				var file = response.response;
				
				$.ajax({
				    url: siteUrl+'admin/changeLogo',
				    type: 'POST',
				    data: {
					    _token:     CSRF_TOKEN,
					    logo: file,
					    id: id
					},
				    success: function (data) {
					    $('img.currentLogo').attr('src', siteUrl+'uploads/'+file);
				    }
				});
				
				
			},
			
			UploadComplete: function(up, file) {
				$('#saveVendorEdits').removeClass('disabled');
				document.getElementById('proflogolist').innerHTML = '';
				
			},
	
			Error: function(up, err) {
				document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
			}
		}
	});
	
	uploader.init();
}

//grab edit vendor form...
$(document).on('click', '.editVendor', function(e) {
	e.preventDefault();
	var btn = $(this);
	var id = $(btn).attr('data-id');
	
	$.ajax({
		    url: siteUrl+'admin/getVendorDetails',
		    type: 'POST',
		    data: {
				_token: CSRF_TOKEN,
				id: id
		    },
		    success: function (data) {
		        $('#edit-vendor-form').html(data);
		        $('#editVendorModal').modal('show');
		        editVendorValidation();
		        adminLogoUpdate();
		    }
		});
	
});

//delete a vendor...
$(document).on('click', '.deleteVendor', function(e) {
	e.preventDefault();
	var btn = $(this);
	var id = $(btn).attr('data-id');
	
	var tables = $.fn.dataTable.fnTables(true);
	
	$(tables).each(function () {
	    $(this).dataTable().fnDestroy();
	});
	
	$.ajax({
		    url: siteUrl+'admin/deleteVendor',
		    type: 'POST',
		    data: {
				_token: CSRF_TOKEN,
				id: id
		    },
		    success: function (data) {
		        $('#vendor-table').html(data);
			    dataTableSet();
		    }
		});
	
});

//set vendor status...
$(document).on('click', '.setVendorStatus', function(e) {
	e.preventDefault();
	var btn = $(this);
	var id = $(btn).attr('data-id');
	var status = parseInt($(btn).attr('data-status'));
	
	$.ajax({
		    url: siteUrl+'admin/setVendorStatus',
		    type: 'POST',
		    data: {
				_token: CSRF_TOKEN,
				id: id,
				status: status
		    },
		    success: function (data) {
			    var color;
			    if(status === 0) {
				    color = 'red';
				    status = 1;
			    }else {
				    status = 0;
				    color = 'green';
			    }
			    $(btn).attr('data-status', status);
		        $('i', btn).removeClass('green red').addClass(color);
		    }
		});
	
});

//Edit Deal Validation
function editDealValidation() {
	//Vendor Add Deal Form...
	$("#edit-deal-form").validate({
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
		  
		  form.submit();
	  },
	});
}

function editDealUploader() {
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

//delete a vendor...
$(document).on('click', '.admin-deleteDeal', function(e) {
	e.preventDefault();
	var btn = $(this);
	var id = $(btn).attr('data-id');
	
	var tables = $.fn.dataTable.fnTables(true);
	
	$(tables).each(function () {
	    $(this).dataTable().fnDestroy();
	});
	
	$.ajax({
		    url: siteUrl+'admin/deleteDeal',
		    type: 'POST',
		    data: {
				_token: CSRF_TOKEN,
				id: id
		    },
		    success: function (data) {
		        $('#deals-table').html(data);
			    dataTableSet();
		    }
		});
	
});

//grab edit deal form...
$(document).on('click', '.admin-editDeal', function(e) {
	e.preventDefault();
	var btn = $(this);
	var id = $(btn).attr('data-id');
	
	$.ajax({
		    url: siteUrl+'admin/getDealDetails',
		    type: 'POST',
		    data: {
				_token: CSRF_TOKEN,
				id: id
		    },
		    success: function (data) {
		        $('#edit-deal-form').html(data);
		        $('#editDealModal').modal('show');
		        editDealValidation();
		        editDealUploader();
		        $('.datepicker').datepicker({
				    minDate: 0, // your min date
				});

		    }
		});
	
});

function editFundraiserValidation() {
	//Validate merchant profile details...
	$("#edit-fundraiser-form").validate({
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
		  
		  form.submit();
	  },
	});
}

function editFundraiserUploader() {
	//Profile Details Logo Upload
	var token  = $('meta[name="csrf-token"]').attr('content');
	var id = $('#fundraiser_id').val();
	var flag = 0;
	var uploader5 = new plupload.Uploader({
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
					uploader5.start();
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
				    url: siteUrl+'admin/fundraiser/changeLogo',
				    type: 'POST',
				    data: {
					    _token:     CSRF_TOKEN,
					    logo: file,
					    id: id
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
	
	uploader5.init();
	
	//Profile Details Profile Image Upload
		var token  = $('meta[name="csrf-token"]').attr('content');
		var id = $('#fundraiser_id').val();
		var flag = 0;
		var uploader6 = new plupload.Uploader({
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
					uploader6.start();
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
				    url: siteUrl+'admin/fundraiser/changeProfileImage',
				    type: 'POST',
				    data: {
					    _token:     CSRF_TOKEN,
					    profileImage: file,
					    id: id
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
	
	uploader6.init();
}

//grab edit fundraiser form...
$(document).on('click', '.admin-editFundraiser', function(e) {
	e.preventDefault();
	var btn = $(this);
	var id = $(btn).attr('data-id');
	
	$.ajax({
		    url: siteUrl+'admin/getFundraiserDetails',
		    type: 'POST',
		    data: {
				_token: CSRF_TOKEN,
				id: id
		    },
		    success: function (data) {
		        $('#edit-fundraiser-form').html(data);
		        $('#editFundraiserModal').modal('show');
		        editFundraiserValidation();
		        editFundraiserUploader();

		    }
		});
	
});

//delete a fundraiser...
$(document).on('click', '.admin-deleteFundraiser', function(e) {
	e.preventDefault();
	var btn = $(this);
	var id = $(btn).attr('data-id');
	
	var tables = $.fn.dataTable.fnTables(true);
	
	$(tables).each(function () {
	    $(this).dataTable().fnDestroy();
	});
	
	$.ajax({
		    url: siteUrl+'admin/deleteFundraiser',
		    type: 'POST',
		    data: {
				_token: CSRF_TOKEN,
				id: id
		    },
		    success: function (data) {
		        $('#fundraiser-table').html(data);
			    dataTableSet();
		    }
		});
	
});

//Create Cards Form Validation
$("#create-cards-form").validate({
    errorClass:'error',
    validClass:'success',
    errorElement:'span',
  onkeyup: false,
  rules: {
    qty: { 
	    required: true,
	    number: true
    },
    
  },
  submitHandler: function(form) {
	  
	    form.submit();
  },
});

//typeahead
$(document).ready(function() {
	$( "#fundraiser_search" ).autocomplete({
      source: siteUrl+"admin/searchFundraisers",
      minLength: 2,
      select: function( event, ui ) {
	      
	    var id = ui.item.id;
	    
	    $('#fundraiser_id').val(id);  
	    
      }
    });
});

//delete a vip...
$(document).on('click', '.deleteVip', function(e) {
	e.preventDefault();
	var btn = $(this);
	var id = $(btn).attr('data-id');
	
	var tables = $.fn.dataTable.fnTables(true);
	
	$(tables).each(function () {
	    $(this).dataTable().fnDestroy();
	});
	
	$.ajax({
		    url: siteUrl+'admin/deleteVip',
		    type: 'POST',
		    data: {
				_token: CSRF_TOKEN,
				id: id
		    },
		    success: function (data) {
		        $('#vip-table').html(data);
			    dataTableSet();
		    }
		});
	
});

function editVipValidation() {
	
}

//grab edit vip form...
$(document).on('click', '.editVip', function(e) {
	e.preventDefault();
	var btn = $(this);
	var id = $(btn).attr('data-id');
	
	$.ajax({
		    url: siteUrl+'admin/getVipDetails',
		    type: 'POST',
		    data: {
				_token: CSRF_TOKEN,
				id: id
		    },
		    success: function (data) {
		        $('#edit-vip-form').html(data);
		        $('#editVipModal').modal('show');
		        editVipValidation();
		    }
		});
	
});

function uniqid() {
    var ts=String(new Date().getTime()), i = 0, out = '';
    for(i=0;i<ts.length;i+=2) {        
       out+=Number(ts.substr(i, 2)).toString(36);    
    }
    return ('d'+out);
}

//Add a social setting
$(document).on('click', '.addSocialSetting', function(e) {
	e.preventDefault();
	var un = uniqid();
	$('#settings-table').append('<tr id="row-'+un+'" data-type="new"><td><input type="text" id="icon-'+un+'" placeholder="fa-icon" class="form-control" ></td><td><input type="text" id="link-'+un+'" placeholder="http://facebook.com/me" class="form-control"></td><td><a href="#" class="saveSocialSetting btn btn-success btn-sm" data-un="'+un+'"><i class="fa fa-check"></i></a> <a href="#" class="deleteSocialSetting btn btn-sm btn-danger" data-un="'+un+'"><i class="fa fa-times"></i></a></td></tr>');
});

//Delete a social setting
$(document).on('click', '.deleteSocialSetting', function(e) {
	e.preventDefault();
	var un = $(this).attr('data-un');
	var tr = $('#row-'+un);
	var type = $(tr).attr('data-type');
	if(type === 'new') {
		$(tr).remove();
	}else {
		var id = $(tr).attr('data-setting-id');
		$.ajax({
		    url: siteUrl+'content/delete-setting',
		    type: 'POST',
		    data: {
				_token: CSRF_TOKEN,
				id: id
		    },
		    success: function (data) {
		        $(tr).remove();
		    }
		});
	}
});

//Delete a social setting
$(document).on('click', '.saveSocialSetting', function(e) {
	e.preventDefault();
	var un = $(this).attr('data-un');
	var tr = $('#row-'+un);
	var type = $(tr).attr('data-type');
	var id = 0;
	var icon = $('#icon-'+un).val();
	var link = $('#link-'+un).val();
	
	if(type === 'existing') {
		id = $(tr).attr('data-setting-id');
	}
	
	$.ajax({
	    url: siteUrl+'content/save-setting',
	    type: 'POST',
	    data: {
			_token: CSRF_TOKEN,
			id: id,
			icon: icon,
			link: link,
			type: type
	    },
	    success: function (data) {
	        //do nothing...
	    }
	});
	
});

$(document).ready(function() {
	tinymce.init({
	    selector: '.tinymce',
	    height: 500,
	    toolbar: 'undo redo bold italic alignleft aligncenter alignright bullist numlist outdent indent code',
	    plugins: 'code',
	    menubar: false
	});
});

//Create Cards Form Validation
$("#simple-page-form").validate({
    errorClass:'error',
    validClass:'success',
    errorElement:'span',
  onkeyup: false,
  rules: {
    heading: { required: true },
    content: { required: true }
    
  },
  submitHandler: function(form) {
	  
	  	form.submit();
  },
});

//Add a list item
$(document).on('click', '.addListItem', function(e) {
	e.preventDefault();
	var un = uniqid();
	var advanced_page_id = $(this).attr('data-advanced-page-id')
	$('#list-table').append('<tr id="row-'+un+'" data-type="new"><td><input type="checkbox" value="1" name="show_number" id="show-number-'+un+'" data-un="'+un+'"></td><td><textarea name="content" id="content-'+un+'" class="form-control" data-un="'+un+'"></textarea></td><td><a href="#" class="removeListItem btn btn-danger btn-sm" data-un="'+un+'"><i class="fa fa-times"></i></a> <a href="#" class="saveListItem btn btn-success btn-sm" data-un="'+un+'" data-advanced-page-id="'+advanced_page_id+'"><i class="fa fa-check"></i></a></td></tr>');
});

//Delete a list item
$(document).on('click', '.removeListItem', function(e) {
	e.preventDefault();
	var un = $(this).attr('data-un');
	var tr = $('#row-'+un);
	var type = $(tr).attr('data-type');
	if(type === 'new') {
		$(tr).remove();
	}else {
		var id = $(tr).attr('data-id');
		$.ajax({
		    url: siteUrl+'content/delete-list-item',
		    type: 'POST',
		    data: {
				_token: CSRF_TOKEN,
				id: id
		    },
		    success: function (data) {
		        $(tr).remove();
		    }
		});
	}
});

$(document).on('click', '.saveListItem', function(e) {
	e.preventDefault();
	var un = $(this).attr('data-un');
	var tr = $('#row-'+un);
	var type = $(tr).attr('data-type');
	var id = 0;
	var show_number = $('#show-number-'+un).val();
	var content = $('#content-'+un).val();
	var advanced_page_id = $(this).attr('data-advanced-page-id');
	
	if(type === 'existing') {
		id = $(tr).attr('data-id');
	}
	
	$.ajax({
	    url: siteUrl+'content/save-list-item',
	    type: 'POST',
	    data: {
			_token: CSRF_TOKEN,
			id: id,
			type: type,
			show_number: show_number,
			content: content,
			advanced_page_id: advanced_page_id
	    },
	    success: function (data) {
	        //do nothing...
	    }
	});
});




