function GetSupprimerTeacher(depId, event) {

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
                url: 'chefDep/' + depId + '/delete',
                method: 'GET',
                success: function (response) {
                    if (response === "success") {

                        $('#teacher_' + depId).remove();

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
