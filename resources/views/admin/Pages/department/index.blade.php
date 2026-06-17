  <!-- Avant le modification --><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoest.png') }}">
    <title>
        Départements
    </title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:250,400,600,700" rel="stylesheet"/>
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet"/>
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet"/>

    <!-- Department styles -->
    <link rel="stylesheet" href="{{ asset('admin_style/profile/profile_style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('admin_style/department/department_style.css') }}">

    <!-- Department Javascript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('admin_java/departement_javaS/departement_javaScript.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body class="g-sidenav-show bg-gray-100">
<x-sidebar-admin/>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <x-navbarAdmin :pageName="'Département'" :$user/>
    <!-- End Navbar -->


    <!-- Abderrahim's code start here -->

    <div class="main_table">
        <!-- Title container and tree buttons in the corner -->
        <div class="container_header">
            <div class="container_title">
                <div class="div_image">
                    <img class="image_dep" src="{{ asset('admin_style/images/departamento.png') }}"
                         alt="Image département">
                </div>
                <div class="title">
                    Départements
                </div>

                <div class="message-success">
                    Tous les départements ont été supprimés avec succès.
                </div>

            </div>

            <!-- The tree buttons -->
            <div class="three_bt">
                <div class="dropdown float-lg-end ">
                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v text-secondary"></i>
                    </a>
                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                        <li class="background_red padding rounded transform_width "><a
                                class=" border-radius-md text-white" onclick="deleteAll(event)">Delete All</a></li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- The small phrase -->
        <div class="phrase_dep">
            Ce sont tous les départements existants
        </div>
        <!-- The main table -->
        @if(isset($departments) && count($departments) > 0)
        {{-- New table --}}
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                    <tr>
                        <th class="text-uppercase text-primary text-xxs font-weight-bolder ">
                            Nom
                        </th>
                        <th class="text-uppercase text-primary text-xxs font-weight-bolder ps-2">
                            Chéf de département
                        </th>
                        <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder ">
                            Crée A
                        </th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                    </thead>
                    <tbody id="students-table-body">
                    @foreach($departments as $dep)
                        <tr id="department_{{ $dep->id }}">
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $dep->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $dep->chefDep }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0">{{ $dep->created_at->format('Y-m-d') }}</p>
                            </td>

                            <td class=" d-flex justify-content-end">
                                <div >
                                    <a class="link-btn" onclick="GetModifierDepartement( {{ $dep->id }} , event)"><img
                                            width="20" height="20" class="button_tab"
                                            src="{{ asset('admin_style/images/editar.png') }}" alt="modifier"></a>
                                    <a class="link-btn" onclick="GetSupprimerDepartement( {{ $dep->id }} , event)"><img
                                            width="20" height="20" class="button_tab "
                                            src="{{ asset('admin_style/images/eliminar.png') }}"
                                            alt="supprimer"></a>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        @else
            <h5 class="no_table">Aucun Département</h5>
        @endif


    </div>
    <!-- And ends here -->

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
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
</body>

</html>
