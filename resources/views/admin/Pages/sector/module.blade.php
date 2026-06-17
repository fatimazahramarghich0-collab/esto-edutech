<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="asset assets/images/apple-icon.png">
    <link rel="icon" type="image/png" href="asset assets/images/logoest.png">
    <title>
        Modules
    </title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{asset ('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset ('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{asset ('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{asset ('assets/css/soft-ui-dashboard.css?v=1.0.7')}}" rel="stylesheet" />

    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

</head>

<body class="g-sidenav-show  bg-gray-100">
<x-sidebar-admin />
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <x-navbarAdmin :pageName="'Modules de la filière'" :$user />

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="card-header">Modules de la filière {{ $sector->name }}</h6>
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                            {{ __('Retour') }}
                        </button>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Semestre</th>
                                    <th></th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Modules</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($semesters as $semester)
                                    <tr>
                                        <td>
                                            <strong>{{ $semester->semesterName }}</strong>
                                            <!-- Utilisation de la classe "ms-2" pour ajouter une marge à gauche -->
                                        </td>
                                        <td>
                                            <a href="{{ route('semester.addModule', $semester->id) }}" class="btn ms-5"> + Ajouter module</a>
                                        </td>
                                        <td>
                                            @foreach($semester->modules as $module)
                                                <div class="d-flex align-items-center mb-2">
                                                    <!-- Afficher la photo du module -->

                                                        <img src="{{ $module->photo }}" alt="{{ $module->name }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">

                                                    {{ $module->name }}
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($semester->modules as $module)
                                                <div class="d-flex mb-2">
                                                    <!-- Lien de modification -->
                                                    <a href="{{ route('module.edit', $module->id) }}" class="btn btn-sm btn-primary me-2">Modifier</a>
                                                    <!-- Formulaire de suppression -->
                                                    <form action="{{ route('delete_module', $module->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger delete-module-button" data-module-name="{{ $module->name }}">Supprimer</button>
                                                    </form>
                                                </div>
                                            @endforeach
                                        </td>
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
<script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>

<!-- Script pour suppression -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteButtons = document.querySelectorAll('.delete-module-button');

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                var form = button.closest('form');
                var moduleName = button.getAttribute('data-module-name');
                if (confirm('Voulez-vous vraiment supprimer le module "' + moduleName + '" ?')) {
                    form.submit();
                }
            });
        });
    });
</script>

</body>
</html>
