$(document).ready(function() {
    $('#search-input').on('input', function() {
        var query = $(this).val();
        $.ajax({
            url: '/teacher/HourlyLoadsManagement/hourly-loads/search',
            method: 'GET',
            data: {
                query: query
            },
            success: function(response) {
                $('#search-results').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Error occurred while searching:', status, error);
            }
        });
    });
});

function createLoad(event) {
    event.preventDefault();

    const url = '/teacher/HourlyLoadsManagement/hourly-loads';

    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            $('.create_container').html(response);
            $('#createLoadModal').modal('show');
        },
        error: function (xhr, status, error) {
            console.error('Error loading the page:', status, error);
        }
    });
}

