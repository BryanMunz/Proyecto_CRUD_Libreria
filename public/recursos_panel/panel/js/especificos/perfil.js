$("#foto_perfil").change(function () {
    // Código a ejecutar cuando se detecta un cambio de archivO
    previsualizar_imagen(this, '#img-preview');
  });

  $("#foto_perfil").change(function () {
    // Código a ejecutar cuando se detecta un cambio de archivO
    previsualizar_imagen(this, '#imag-preview');
  });

$('#form-mi-perfil').validate({
    rules: {
        nombre: {
            required: true
        },
        apellido_paterno: {
            required: true
        },
        apellido_materno: {
            required: false
        },
        sexo:{
            required: true
        },
        email: {
            required: true,
            email: true,
        },
        archivo: {
            required: false
        },
    },
    messages: {
        nombre: {
            required: "El nombre es requerido."
        },
        apellido_paterno: {
            required: "El apellido paterno es requerido."
        },
        sexo:{
            required: "El sexo es rquerido."
        },
        email: {
            required: "El email es requerido.",
            email: "Ingresa un correo valido ejemplo@dominio.com"
        },
        archivo: {
            required: false
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

$('#form-password').validate({
    rules: {
        password: {
            required: true,
            minlength: 5
        },
        repassword: {
            required: true,
            minlength: 5,
            equalTo: "#password"
        },
    },
    messages: {
        password: {
            required: "La contraseña es requerida.",
            minlength: "La contraseña debe tener al menos 5 caracteres"
        },
        repassword: {
            required: "La contraseña a repetir es requerida.",
            minlength: "La contraseña debe tener al menos 5 caracteres.",
            equalTo: "La contraseña a repetir no coincide con la contraseña. "
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