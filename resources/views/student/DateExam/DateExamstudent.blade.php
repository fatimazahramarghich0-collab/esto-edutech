<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoest.png') }}">
    <title>
        Étudiant | ESTO EDU-TECH
    </title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
    <style>
        .sector-name {
            color: #c90c9e;
        }
        .tel-name{
            color: #089026;
        }
        .td-name{
            color: #474e64;
        }
        .tp-name{
            color: #21639a;
        }
        .m-name{
            color: #216299;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
<!-- Nav Bar -->
<x-student.sidebar></x-student.sidebar>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <div class="container-fluid py-4">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card-header pb-0">
                    <h6>Liste des modules, matières et examens pour <strong class="sector-name">{{ $user->sector->name }}</strong></h6>
                </div><br>
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Module</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Matière</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type d'examen</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date de l'examen</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($modulesData as $moduleData)
                                    @php
                                        $totalSubjects = $moduleData['subjects']->count();
                                        $subjectRowSpan = 0;
                                        foreach ($moduleData['subjects'] as $subject) {
                                            $subjectRowSpan += $subject['exams']->count() ?: 1;
                                        }
                                    @endphp
                                    <tr>
                                        <td rowspan="{{ $subjectRowSpan }}">
                                            <strong class="m-name">{{ $moduleData['module']->name }}</strong>
                                        </td>
                                    @foreach ($moduleData['subjects'] as $subjectIndex => $subjectData)
                                        @php
                                            $totalExams = $subjectData['exams']->count() ?: 1;
                                        @endphp
                                        @if ($subjectIndex > 0)
                                            <tr>
                                                @endif
                                                <td rowspan="{{ $totalExams }}">
                                                    <strong class="td-name">{{ $subjectData['subject']->name }}</strong>
                                                </td>
                                            @if ($subjectData['exams']->count() > 0)
                                                @foreach ($subjectData['exams'] as $examIndex => $exam)
                                                    @if ($examIndex > 0)
                                                        <tr>
                                                            @endif
                                                            <td>{{ $exam->type }}</td>
                                                            <td>{{ $exam->dateExam }}</td>
                                                            @endforeach
                                                            @else
                                                                <td colspan="2">Pas d'examens</td>
                                                            @endif
                                                            @endforeach
                                                        </tr>
                                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footerAdmin />
</main>
<!-- Core JS Files -->
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard -->
<script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
