

$("#foto_autor").change(function () {
    // Código a ejecutar cuando se detecta un cambio de archivO
    previsualizar_imagen(this, '#img-preview');
  });


$('#form-autor').validate({
    rules: {
        nombre: {
            required: true
        },
        apellido_paterno: {
            required: true
        },
        sexo:{
            required: true
        },
        nation: {
            required: true
        },
        firma: {
            required: true,
        },
        date: {
            required: false,
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
        rol: {
            required: "El rol es requerido."
        },
        nation:{
            required: "La nacionalidad es rquerido."
        },
        firma: {
            required: "La firma es requerido.",
        },
        date: {
            required: "La Fecha de Nacimiento es requerido.",
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