//$(document).ready(function(){
    //alert('Hola');
//});

$(function () {
    $('#form-login').validate({
        //To define wich are the rules
      rules: {
        email_usuario: {
          required: true,
          email: true,
        },
        password_usuario: {
          required: true,
          minlength: 5
        }
      },//end rules
      messages: {
        email_usuario: {
          required: "Please enter a email address",
          email: "Please enter a valid email address"
        },
        password_usuario: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });

  