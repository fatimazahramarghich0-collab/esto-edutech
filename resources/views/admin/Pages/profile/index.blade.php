<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoest.png') }}">
    <title>
        Profil Administrateur
    </title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet"/>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet"/>
d
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <!-- Abderrahim's things -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('admin_style/profile/profile_style.css') }}">
    <script src="{{ asset('admin_java/profile_java/profile_java.js') }}"></script>

</head>

<body class="g-sidenav-show bg-gray-100">
<x-sidebar-admin/>
<div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <!-- Navbar -->
    <x-navbarAdmin :pageName="'Profil'" :$user/>

    <!-- End Navbar -->
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4"
             style="background-image: url('{{ asset('assets/images/curved-images/curved0.jpg') }}'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ $user->photo }}" alt="profile_image"
                             class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ explode(' ', $user->name)[0] }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            Admin
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}">Messages</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4 ">
        <div class="row">
            <div class="container-divs">


                <div class="col-12 col-xl-6">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Profile Information</h6>

                                    @if(session('success'))
                                        <div class="alert-message color-green">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="#" onclick="showFormUpdate(event)">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                           data-bs-placement="top" title="Edit Profile"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full
                                        Name:</strong> {{ $user->name }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">Email:</strong> {{ $user->email }}</li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-xl-6 form_container">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Mis a jour</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <form action="{{ route('profile.update', ['id' => $user->id]) }}"
                                      enctype="multipart/form-data" method="POST"
                                      class="needs-validation" novalidate>
                                    @csrf

                                    <!-- Input for Name -->
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                                               class="form-control" required>
                                        <x-form-error class="alert-message color-red" name="name"></x-form-error>
                                    </div>

                                    <!-- Input for Email -->
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                                               class="form-control" required>
                                        <x-form-error class="alert-message color-red" name="email"></x-form-error>
                                    </div>

                                    <!-- Input for Password -->
                                    <div class="form-group">
                                        <label for="password">Mot de passe:</label>
                                        <input type="password" id="password" name="password" class="form-control"
                                               >
                                        <x-form-error class="alert-message color-red" name="password"></x-form-error>
                                    </div>

                                    <!-- Confirmation for Password -->
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirmer le mot de passe:</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                               class="form-control" >
                                    </div>

                                    <!-- Photo -->
                                    <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <input type="file" id="photo" name="photo"
                                               class="form-control" alt="photo">
                                        <x-form-error class="alert-message color-red" name="photo"></x-form-error>
                                    </div>


                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </form>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end profile info -->


        </div>

        <x-footerAdmin/>

    </div>
</div>

<!-- Core JS Files -->
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script>
    import {Helpers as Scrollbar} from "../../../../../public/studentFile/js/helpers.js";

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
