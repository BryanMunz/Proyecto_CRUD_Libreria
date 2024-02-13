//$(document).ready(function(){
    //alert('Hola');
//});
$("#foto_perfil").change(function () {
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


    $('#form-usuario').validate({
        //To define wich are the rules
      rules: {
        nombre: {
          required: true,
        },
        apellido_paterno: {
            required: true,
        },
        apellido_materno: {
          required: false,
        },
        sexo: {
          required: true,
        },
        rol: {
          required: true,
        },
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
          minlength: 5
        },
        repassword: {
          required: true,
          equalTo: "#password"
        },
        archivo: {
          required: false,
        },
      },//end rules
      messages: {
        nombre: {
          required: "Nombre es requerido",
        },
        apellido_paterno: {
          required: "Apellido Paterno es requerido",
        },
        rol: {
          required: "El Rol es requerido",
        },
        sexo: {
          required: "El Sexo es requerido",
        },
        email: {
          required: "Correo Electrónico es requerido",
          email: "Ingresa un Correo valido"
        },
        password: {
          required: "Contraseña es requerida",
          minlength: "Tu contraseña debe tener al menos 5 caracteres"
        },
        repassword: {
          required: "Contraseña es requerida",
          equalTo: "La Contraseña no coincide"
        },
        archivo: {
          required: false,
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

  