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
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-header">

                        <h6 class=" pb-0 "><strong>Cours</strong></h6>
                        <div class="form-group mt-3">
                            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Retour</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if ($subject->courses->count() > 0)

                            <table class="table table-sm align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nom du cours</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subject->courses as $course)
                                        <tr>
                                            <td>{{ $course->name }}</td>
                                            <td>
                                                <form action="{{ route('documents.edit', ['id' => $course->id]) }}" method="GET" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">Modifier</button>
                                                </form>
                                                <form action="{{ route('documents.destroy', ['id' => $course->id]) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                      <p>Aucun cours disponible.</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Ajouter un cours</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('documents.upload') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="subject_id" value="{{ $subject->id }}">

                            <div class="mb-3">
                                <label for="course_name" class="form-label" >Nom du cours:</label>
                                <input type="text" id="course_name" name="course_name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="file" class="form-label">Fichier du cours:</label>
                                <input type="file" id="file" name="file" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Ajouter le cours</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

</body>
</html>
