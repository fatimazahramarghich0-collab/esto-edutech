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

    <link rel="stylesheet" href="{{ asset('admin_style/profile/profile_style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('student_styles/absence/absence_style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!--Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body class="g-sidenav-show  bg-gray-100 mb-8">

{{-- Side Bare --}}
<x-student.sidebar/>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    {{-- Top Bare  --}}
        <x-navbar-student pageName="Absence"/>
    <div class="main_table" style="margin-top: 3.5rem">
        <!-- Title container and tree buttons in the corner -->
        <div class="container_header">
            <div class="container_title">
                <div class="div_image">
                    <img class="image_teach" src="{{ asset('student_styles/images/ausencia.png') }}"
                         alt="Image enseignant">
                </div>
                <div class="title">
                    Absences
                </div>

            </div>
        </div>

        {{-- The main table --}}

        @if(isset($subjects ))
            {{-- New table --}}
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                    <tr>
                        <th class="text-uppercase text-primary text-xxs font-weight-bolder ">
                            Matières
                        </th>
                        <th class="text-uppercase text-primary text-xxs font-weight-bolder ps-2">
                            Enseignant
                        </th>
                        <th class="text-uppercase text-primary text-xxs font-weight-bolder ps-2">
                            Date
                        </th>
                    </tr>
                    </thead>
                    <tbody id="students-table-body">
                    @foreach($subjects as $subject)
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm" style="font-weight: normal;">{{ $subject->name }}</h6>

                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm" style="font-weight: normal;">{{ $subject->teacher->name }}</h6>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        @foreach($subject->absence as $absence)
                                            <h6 class="mb-0 text-sm"
                                                style="text-decoration: underline">{{ $absence->dateAbsence }}</h6>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        @else
            <h5 class="no_table">Aucun Absence. Bravo!</h5>
        @endif


    </div>
</main>


</body>
</html>
