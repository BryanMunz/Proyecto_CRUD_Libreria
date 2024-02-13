//$(document).ready(function(){
    //alert('Hola');
//});
$("#foto_editorial").change(function () {
    // Código a ejecutar cuando se detecta un cambio de archivO
    previsualizar_imagen(this, '#img-preview');
  });
  
  function previsualizar_imagen (input, id ="") {
    //Verificamos si hay un cambio
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {    
            // Renderizamos la imagen
            $(id).attr('src', e.target.result); 
        }//end render
        reader.readAsDataURL(input.files[0]);
    }//end if
  }//end 
  
  $(function () {
      $('#form-editorial').validate({
          //To define wich are the rules
        rules: {
          nombre: {
            required: true,
          },
        direccion: {
            required: true,
          },

        },//end rules
        messages: {
          nombre: {
            required: "Nombre es requerido",
          },
        direccion: {
            required: "La dirección es requerida",
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
  