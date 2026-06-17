$(document).ready(function () {
    $('#search-input').on('keyup', function () {
        let query = $(this).val();

        $.ajax({
            url: '/admin/students/search',
            type: 'GET',
            data: { query: query },
            success: function (response) {
                $('#students-table-body').html(response);
            }
        });
    });
});
function GetUpdateStudent(studentId, event) {
    event.preventDefault();

    const url = '/admin/students/' + studentId + '/edit';

    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            // Inject the response HTML into the container
            $('.container_table').html(response);

            // Initialize and show the modal after injecting the content
            $('#modifyStudentModal').modal('show');
        },
        error: function (xhr, status, error) {
            console.error('Error loading the page:', status, error);
        }
    });
}

function createStudent(event) {
    event.preventDefault();

    const url = '/admin/students/create';

    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            $('.create_container').html(response);

            $('#createStudentModal').modal('show');
        },
        error: function (xhr, status, error) {
            console.error('Error loading the page:', status, error);
        }
    });
}
function importStudent(event) {
    event.preventDefault();

    const url = '/admin/students/importCSV';

    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            $('.import_container').html(response);

            $('#importStudentModal').modal('show');
        },
        error: function (xhr) {
            var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'Une erreur est survenue. Prière de réessayer ultérieurement';
            $('#importStudentModal').modal('hide');
            $('#errorMessageContent').text(errorMessage);
            $('#errorMessageModal').modal('show');
        }
    });
}

function openModifySectorModal(studentId, event) {
    event.preventDefault();

    const url = '/admin/students/' + studentId + '/editSector';

    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            // Inject the response HTML into the container
            $('.sector_container').html(response);

            // Initialize and show the modal after injecting the content
            $('#modifySectorModal').modal('show');
        },
        error: function (xhr, status, error) {
            console.error('Error loading the page:', status, error);
        }
    });
}
function showAbsences(studentId) {
    $.ajax({
        url: '/admin/students/' + studentId + '/absences',
        type: 'GET',
        success: function (response) {
            // Inject the fetched HTML into the modal container
            $('#absencesModalContainer').html(response);
            // Show the modal
            $('#absencesModal').modal('show');
        },
        error: function (xhr) {
            console.log('An error occurred while fetching absences.');
        }
    });
}
function showSemesterGrades(studentId) {
    $.ajax({
        url: '/admin/students/' + studentId + '/semesterGrades',
        type: 'GET',
        success: function (response) {
            $('#semesterGradesModalContainer').html(response);
            $('#semesterGradesModal').modal('show');
        },
        error: function (xhr) {
            console.log('An error occurred while fetching semester grades.');
        }
    });
}
