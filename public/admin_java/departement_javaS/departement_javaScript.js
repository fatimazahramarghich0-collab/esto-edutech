function GetModifierDepartement(depId, event) {
    const url = 'department/' + depId + '/edit';
    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            $('.table-responsive').html(response);
        },
        error: function (xhr, status, error) {
            console.error('Error al cargar la página:', status, error);
        }
    });
}

function GetSupprimerDepartement(depId, event) {

    Swal.fire({
        title: 'Êtes-vous sûr de vouloir supprimer ce département ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler',
        reverseButtons: true
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: 'department/' + depId + '/delete',
                method: 'GET',
                success: function (response) {
                    if (response === "success") {

                        $('#department_' + depId).remove();

                    } else {

                        console.error(response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
}

function deleteAll(event) {
    event.preventDefault();

    Swal.fire({
        title: 'Êtes-vous sûr de vouloir supprimer tous les départements ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler',
        reverseButtons: true
    }).then((result) => {

        if (result.isConfirmed) {
            $.ajax({
                url: 'department/deleteAll',
                method: 'GET',
                success: function (response) {

                    if (response === "success") {

                        $('.message-success').css('display', 'inline-block');


                        $.ajax({
                            url: 'department/GetDelete',
                            method: 'GET',
                            success: function (response) {

                                $('.table-responsive').html(response);
                            },
                            error: function (xhr, status, error) {
                                console.error('Error getting deleted departments:', status, error);
                            }
                        });
                    } else {
                        console.error('Error deleting departments:', response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error deleting departments:', status, error);
                }
            });
        }
    });
}


//Ajouter departement

function create(event) {
    event.preventDefault();

    const url = 'department/create';
    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            $('.table-responsive').html(response);
        },
        error: function (xhr, status, error) {
            console.error('Error al cargar la página:', status, error);
        }
    });
}
