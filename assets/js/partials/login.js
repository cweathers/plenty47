$(document).on('click', '.loginModal', function(e) {
	e.preventDefault();
	$('#login-overlay').fadeIn();
	$('.login-box').addClass('show');

});

$(document).on('click', '#login-overlay', function() {
		$('.login-box').removeClass('show');
		$('#login-overlay').fadeOut();
});

//Validate vendor/merchant signup form...
$("#login-form").validate({
    errorClass:'error',
    validClass:'success',
    errorElement:'span',
  onkeyup: false,
  rules: {
    email: {required: true, email: true},
    password: { required: true }
  },
  submitHandler: function(form) {
	  form.submit();
  },
});