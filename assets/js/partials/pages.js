//Validate contact form...
$("#contact-form").validate({
    errorClass:'error',
    validClass:'success',
    errorElement:'span',
  onkeyup: false,
  rules: {
    name: { required: true },
    email: { email: true, required: true },
    phone: { required: true },
    message: { required: true }
    
  },
  messages: {
  },
  submitHandler: function(form) {
	  form.submit();
  },
});