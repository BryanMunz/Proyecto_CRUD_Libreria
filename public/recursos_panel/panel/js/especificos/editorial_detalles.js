$("#foto_editorial").change(function () {
    // Código a ejecutar cuando se detecta un cambio de archivO
    previsualizar_imagen(this, '#img-preview');
  });


$('#form-editorial').validate({
    rules: {
        nombre: {
            required: true
        },
        direccion: {
            required: true
        },
        archivo: {
            required: false
        },
    },
    messages: {
        nombre: {
            required: "El nombre es requerido."
        },
        direccion: {
            required: "La dirección es requerida."
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