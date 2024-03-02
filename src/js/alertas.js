function servicioCreado(e) {
    e.preventDefault(); // Previne el envío del formulario inmediatamente
    Swal.fire({
        icon: 'question',
        title: '¿Desea guardar el servicio?',
        showCancelButton: true,
        confirmButtonText: 'Sí, guardar',
        cancelButtonText: 'No, cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, envía el formulario.
            e.target.form.submit();
        }
    });
}

function servicioActualizado(e) {
    e.preventDefault(); // Previne el envío del formulario inmediatamente
    Swal.fire({
        icon: 'question',
        title: '¿Desea actualizar el servicio?',
        showCancelButton: true,
        confirmButtonText: 'Sí, actualizar',
        cancelButtonText: 'No, cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, envía el formulario.
            e.target.form.submit();
        }
    });
}

function confirmDelete(event, id) {
    event.preventDefault(); // Previne el envío del formulario inmediatamente
    // console.log(id);
    // console.log(document.getElementById(id));
    Swal.fire({
        title: 'Confirmación',
        text: '¿Estás seguro de que deseas eliminar este registro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(id).submit();
        }
    });
}