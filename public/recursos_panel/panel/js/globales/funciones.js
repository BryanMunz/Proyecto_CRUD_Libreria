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

function cambiar_estatus(url ="", data = Array(), typeMessage = ""){
    let mensaje = (data[1] === '2') ? " deshabilitar" : " habilitar";
    Swal.fire({
        title: '¿Estás seguro de ' + mensaje + data[2] +' ?',
        text: data[3],
        icon: typeMessage,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, continuar',
        cancelButtonText: 'Cancelar'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location = url;
        }//end if result
    })//end swal
}//end cambiar_estatus

function eliminar(url ="", data = Array(), typeMessage = ""){
    Swal.fire({
        title: '¿Estás seguro de eliminar'+ data[0] +' ?',
        text: data[1],
        icon: typeMessage,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, continuar',
        cancelButtonText: 'Cancelar'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location = url;
        }//end if result
    })//end swal
}//end cambiar_estatus