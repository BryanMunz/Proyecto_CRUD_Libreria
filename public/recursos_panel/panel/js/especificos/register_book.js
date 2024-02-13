//$(document).ready(function(){
    //alert('Hola');
//});
$("#foto_libro").change(function () {
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
    $('#form-libro').validate({
        //To define wich are the rules
      rules: {
        nombre: {
          required: true,
        },
        calificacion: {
          required: true,
        },
        NoPaginas: {
          required: true,
        },
        fecha: {
          required: true,
        },
        descripcion: {
          required: true,
        },
        autor: {
          required: true,
        },
        editorial: {
          required: true,
        }
      },//end rules
      messages: {
        nombre: {
          required: "Nombre del Libro es requerido",
        },
        calificacion: {
          required: "Calificación del Libro es requerido",
        },
        NoPaginas: {
          required: "No. de Paginas del Libro es requerido",
        },
        fecha: {
          required: "Fecha de publicación del Libro es requerido",
        },
        descripcion: {
          required: "Descripción del Libro es requerido",
        },
        autor: {
          required: "Autor del Libro es requerido",
        },
        editorial: {
          required: "Editorial del Libro es requerido",
        }
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

  