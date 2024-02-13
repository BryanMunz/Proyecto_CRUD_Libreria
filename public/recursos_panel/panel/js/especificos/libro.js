$('#table-libro').DataTable({
    // "responsive": true, "lengthChange": false, "autoWidth": false,
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    'processing': true,
    "responsive": true,
    // "scrollX": true,
    "language": {
        "lengthMenu": "Mostrar _MENU_ datos",
        "info": "Página _PAGE_ de _PAGES_",
        "infoEmpty": "Datos no disponibles por el momento",
        "processing":     "Procesando ...",
        "search":         "Buscar:",
        "zeroRecords":    "Datos no disponibles por el momento",
        "paginate": {
        "first":      "Primera",
        "last":       "Última",
        "next":       "Siguiente",
        "previous":   "Anterior"
        },
    }//End language
});

//===========ACTUALIZAR ESTATUS DESDE JS===============
$(document).on('click', '.estatus', function() {
    //https://localhost:8080/estatus_libro/primaryKey/estatus 
    let elemento = $(this).attr('id');
	let id = elemento.split('_')[0];
    let estatus = elemento.split('_')[1];
    /**
     * let array = [
     *              0 => id
     *              1 => estatus
     *              2 => ' a este libro : parte de la pregunta'
     *              3 => 'Está acción : mensaje o texto'
     *             ];
     */
	let array = [   id,
                    estatus,
                    ' a este libro',
                    'Está acción no será reversible.'];
	let url = path +'/estatus_libro/'+ id + '/' + estatus;
    cambiar_estatus(url, array, 'question');
});//end onclick estatus


//===========ELIMINAR COMPONENTE(LIBRO) DESDE JS===============
$(document).on('click', '.eliminar', function() {
    //path : https://localhost:8080/eliminar_libro/primaryKey 
    let id = $(this).attr('id');
    /**
     * let array = [
     *              0 => ' a este libro : parte de la pregunta'
     *              1 => 'Está acción : mensaje o texto'
     *             ];
     */
	let array = [' al libro ', 'Este acción será permanente.'];
	let url = path +'/eliminar_libro/'+ id;
    eliminar(url, array, 'question');
});//end onclick eliminar