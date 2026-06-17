<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{asset('assets/images/logoest.png')}}">
    <title>
        Enseignant | ESTO EDU-TECH
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet"/>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet"/>
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

    <!-- Abderrahim Things -->

    <!--CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin_style/profile/profile_style.css') }}">
    <link rel="stylesheet" href="{{ asset('Teacher_style/departmentChef/department_style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!--Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body class="g-sidenav-show  bg-gray-100">

{{-- Side Bare --}}
<x-teacher.sidebar />

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    {{-- Top Bare --}}
    <x-navbar-teacher pageName="Matière" />

    <div class="container mt-4">
        <div class="row">
            <!-- Table Container -->
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h6>Les cours existants :</h6>
                        <div class="form-group mt-3">
                            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Retour</button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Apogée</th>
                                        <th>Type</th>
                                        <th>Coefficient</th>
                                        <th>Date d'examen</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($exams as $exam)
                                        @forelse($students as $student)
                                            <tr>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->codeApogee }}</td>
                                                <td>{{ $exam->type }}</td>
                                                <td>{{ $exam->coefficient }}</td>
                                                <td>{{ $exam->dateExam }}</td>
                                                <td class="action-buttons">
                                                    <form action="{{ route('exams.destroyExam', $exam->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet examen ?')">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">Aucun étudiant trouvé pour ce secteur.</td>
                                            </tr>
                                        @endforelse
                                    @empty
                                        <tr>
                                            <td colspan="6">Aucun examen trouvé pour ce sujet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Form Container -->
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h6>Ajouter des examens :</h6>
                    </div>
                    <div class="card-body">

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </div>
                                    @endif
                    <form action="{{ route('exams.storeExams', $subject->id) }}" method="POST">
                        @csrf
                        <table class="table table-sm align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Apogée</th>
                                    <th>Type</th>
                                    <th>Coefficient</th>
                                    <th>Date d'examen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->codeApogee }}</td>
                                        <td>
                                            <select name="exams[{{ $student->id }}][type]" required>
                                                <option value="Written">Écrite</option>
                                                <option value="Oral">Oral</option>
                                                <option value="Practical">Pratique</option>
                                            </select>
                                        </td>
                                        <td><input type="number" name="exams[{{ $student->id }}][coefficient]" step="0.01" required></td>
                                        <td><input type="date" name="exams[{{ $student->id }}][dateExam]" required></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary mt-3">Ajouter Examens</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
</body>
</html>
