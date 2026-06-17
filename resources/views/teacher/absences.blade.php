<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoest.png') }}">
    <title>Gestion Absences</title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="g-sidenav-show bg-gray-100">
    <x-teacher.sidebar :user="$user" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbar-teacher :pageName="'Absences'" :user="$user" />
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row mb-3">
                <div class="col-6">
                    <div class="card-body pt-sm-3 pt-0">
                        <div class="d-flex align-items-center">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" id="search-input" class="form-control" placeholder="Rechercher l'étudiant...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card-body pt-sm-3 pt-0">
                        <div class="d-flex align-items-center">
                            <select id="subject-select" class="form-select">
                                <option value="">Selectionner votre classe...</option>
                                @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <form action="{{ route('absences.mark') }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="subject-id" name="subject_id" value="">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Etudiant
                                                </th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    apogee
                                                </th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    date de naissance
                                                </th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Absence
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody id="students-tbody">
                                            <!-- Students will be fetched and displayed here -->
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end m-2">
                                        <button type="submit" class="btn btn-primary">Marquer l'absence</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal for Cancel Absence -->
            <div class="modal fade" id="cancelAbsenceModal" tabindex="-1" aria-labelledby="cancelAbsenceModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cancelAbsenceModalLabel">Annuler absence</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p id="studentInfo"></p>
                            <form id="cancelAbsenceForm">
                                @csrf
                                <input type="hidden" name="student_id" id="studentId">
                                <button type="submit" class="btn btn-primary">Confirmer l'annulation </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Error Message -->
            <div class="modal fade" id="errorMessageModal" tabindex="-1" aria-labelledby="errorMessageModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="errorMessageModalLabel">Erreur</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Error message will be displayed here -->
                            <p id="errorMessageContent"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal for Success Message -->
            <div class="modal fade" id="successMessageModal" tabindex="-1" aria-labelledby="successMessageModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="successMessageModalLabel">Succès</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="successMessageContent">
                            <!-- Success message will be injected here -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>


            <x-footerAdmin />
        </div>
    </main>

    <!-- Core JS Files -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const subjectSelect = document.getElementById('subject-select');
            const studentsTbody = document.getElementById('students-tbody');
            const subjectIdInput = document.getElementById('subject-id');

            subjectSelect.addEventListener('change', function() {
                fetchStudents();
                subjectIdInput.value = subjectSelect.value;
            });

            searchInput.addEventListener('input', function() {
                fetchStudents();
            });

            function fetchStudents() {
                const query = searchInput.value;
                const subjectId = subjectSelect.value;

                if (!subjectId) {
                    studentsTbody.innerHTML = '<tr><td colspan="4" class="text-center">Prière de choisir la classe</td></tr>';
                    return;
                }

                fetch(`{{ route('absences.search') }}?query=${query}&subject_id=${subjectId}`)
                    .then(response => response.json())
                    .then(data => {
                        studentsTbody.innerHTML = data;
                    });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.student-link', function(e) {
                e.preventDefault();
                var studentId = $(this).data('id');
                var studentName = $(this).data('name');

                $('#studentInfo').text('Etes-vous sûr de vouloir annuler l\'absence pour ' + studentName + '?');
                $('#studentId').val(studentId);

                $('#cancelAbsenceModal').modal('show');
            });

            $('#cancelAbsenceForm').on('submit', function(e) {
                e.preventDefault();
                var studentId = $('#studentId').val();

                $.ajax({
                    url: '{{ route("cancel.absence") }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#cancelAbsenceModal').modal('hide');

                        if (response.success) {
                            $('#successMessageContent').text(response.message);
                            $('#successMessageModal').modal('show');
                        } else {
                            $('#errorMessageContent').text(response.message);
                            $('#errorMessageModal').modal('show');
                        }
                    },
                    error: function(xhr) {
                        var errorMessage = xhr.responseJSON ? xhr.responseJSON.error : 'Une erreur est survenue. Prière de réessayer ultérieurement';
                        $('#cancelAbsenceModal').modal('hide');
                        $('#errorMessageContent').text(errorMessage);
                        $('#errorMessageModal').modal('show');
                    }
                });
            });
        });
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>

</body>

</html>