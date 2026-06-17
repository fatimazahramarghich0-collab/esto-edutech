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


    <div class="main_table">
        <!-- Title container and tree buttons in the corner -->
        <div class="container_header">

            <div class="container_title card-header pb-0 ">
                <h6 ><strong>Les Matières </strong></h6>
            </div>

            <!-- The tree buttons -->

        </div>

        <!-- The small phrase -->

        {{-- The main table --}}


        {{-- New table --}}
            <div class="table-responsive p-0">
            <table class="table   table-sm align-items-center mb-0">
                     <thead>
                     <tr>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                     </tr>
                     </thead>
                      <tbody>
                         @foreach($subjects as $subject)
                             <tr>
                                 <td>{{ $subject->name }}</td>
                                 <td>
                                     <button class="btn btn-sm btn-primary" onclick="window.location='{{ route('Documents', ['id' => $subject->id]) }}'">Cours</button>
                                 </td>
                                 <td>
                                     <button class="btn btn-sm btn-primary" onclick="window.location='{{ route('td_tp', ['id' => $subject->id]) }}'">TD/TP</button>
                                 </td>
                                 <td>
                                     <button class="btn btn-sm btn-primary" onclick="window.location='{{ route('exams.ExamsStudent', ['id' => $subject->id]) }}'">Examens</button>
                                 </td>
                             </tr>
                         @endforeach
                      </tbody>
                      </table>

                 <!-- Paginación -->




            </div>



    </div>
</main>


</body>
</html>
