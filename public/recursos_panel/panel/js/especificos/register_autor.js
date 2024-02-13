//$(document).ready(function(){
    //alert('Hola');
//});
$("#foto_autor").change(function () {
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
    $('#form-autor').validate({
        //To define wich are the rules
      rules: {
        nombre: {
          required: true,
        },
        apellido_paterno: {
            required: true,
          },
          apellido_materno: {
            required: true,
          },
          nation: {
            required: true,
          },
          firma: {
          required: true,
        },
        date: {
            required: true,
          },
          biografia: {
            required: true,
          },
      },//end rules
      messages: {
        nombre: {
          required: "Nombre es requerido",
        },
        apellido_paterno: {
            required: "Apellido Paterno es requerido",
          },
          apellido_materno: {
            required: "Apellido Materno es requerido",
          },
          nation: {
            required: "Nacionalidad del Autor es requerido",
          },
          firma: {
          required: "Firma del Autor es requerida",
        },
        date: {
            required: "Fecha de Nacimiento es requerida",
          },
          biografia: {
            required: "Biografia es requerida",
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

  