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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is an easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <style>
        .sector-name {
            color: #c90c9e;
            /* Default button color */
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
                    <h6>Liste des matières et cours pour <strong class="sector-name">{{ $user->sector->name }}</strong></h6>
                </div><br>
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Matière</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cours</th>
                                    <th></th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tds</th>
                                    <th></th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tps</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subjectsData as $subjectData)
                                    @php
                                        $totalCourses = $subjectData['courses']->sum(function($course) {
                                            return max(1, $course->tds->count(), $course->tps->count());
                                        });
                                    @endphp
                                    <tr>
                                        <td rowspan="{{ $totalCourses }}"><strong class="td-name ">{{ $subjectData['subject']->name }}</strong></td>
                                    @foreach ($subjectData['courses'] as $courseIndex => $course)
                                        @if ($courseIndex > 0)
                                            <tr>
                                                @endif
                                                <td rowspan="{{ max(1, $course->tds->count(), $course->tps->count()) }}"><strong class="m-name ">{{ $course->name }}</strong> </td>
                                                <td rowspan="{{ max(1, $course->tds->count(), $course->tps->count()) }}">
                                                    <a href="{{ asset($course->fichier) }}" download class="tel-name">
                                                        <i class="fa-solid fa-download" style="color: #0cbb6f;"></i>                                                    </a>
                                                </td>
                                            @php
                                                $maxCount = max($course->tds->count(), $course->tps->count());
                                            @endphp
                                            @for ($i = 0; $i < $maxCount; $i++)
                                                @if ($i > 0)
                                                    <tr>
                                                        @endif
                                                        <td><strong class="tp-name ">{{ $course->tds[$i]->name ?? '' }}</strong> </td>
                                                        <td>
                                                            @if (isset($course->tds[$i]))
                                                                <a href="{{ asset($course->fichier) }}" download class="tel-name">
                                                                    <i class="fa-solid fa-download" style="color: #0cbb6f;"></i>                                                                </a>

                                                            @endif
                                                        </td>
                                                        <td><strong class="tp-name ">{{ $course->tps[$i]->name ?? '' }}</strong></td>
                                                        <td>
                                                            @if (isset($course->tps[$i]))
                                                                <a href="{{ asset($course->fichier) }}" download class="tel-name">
{{----}}
                                                                    <i class="fa-solid fa-download" style="color: #0cbb6f;"></i>
                                                                </a>

                                                            @endif
                                                        </td>
                                                        @if ($i > 0)
                                                    </tr>
                                                    @endif
                                                    @endfor
                                                    @if ($courseIndex < $subjectData['courses']->count() - 1)
                                                        </tr>
                                                    @endif
                                                    @endforeach
                                                    @endforeach
                                                    </tr>
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
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</body>

</html>
