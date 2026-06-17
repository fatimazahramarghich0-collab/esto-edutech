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
    <link rel="stylesheet" href="{{ asset('Teacher_style/departmentChef/department_style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!--Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('Teacher_JavaScript/DepartmentChef/chefDepartment_javascript.js') }}"></script>

</head>
<body class="g-sidenav-show  bg-gray-100 mb-8">

{{-- Side Bare --}}
<x-teacher.sidebar/>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    {{-- Top Bare --}}
    <x-navbar-teacher pageName="Chéf de département"/>


    <div class="main_table">
        <!-- Title container and tree buttons in the corner -->
        <div class="container_header">
            <div class="container_title">
                <div class="div_image">
                    <img class="image_teach" src="{{ asset('Teacher_style/images/profesor.png') }}"
                         alt="Image enseignant">
                </div>
                <div class="title">
                    Enseignants
                </div>

            </div>

        </div>

        <!-- The small phrase -->
        <div class="phrase_teach">
            Ce sont tous les enseignant
        </div>
        @if(session('success'))
            <div class="alert-message color-green">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    $('html, body').animate({
                        scrollTop: $(document).height()
                    }, 2000);
                });
            </script>
        @endif


        {{-- The main table --}}

        @if(isset($teachers) && count($teachers) > 0)
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
                            Chéf de Filiére
                        </th>
                        <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder ">
                            Telephone
                        </th>
                        <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder ">
                            Créer a
                        </th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                    </thead>
                    <tbody id="students-table-body">
                    @foreach($teachers as $teacher)
                        <tr id="teacher_{{ $teacher->id }}">
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $teacher->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0 d-flex justify-content-left ms-5">
                                    @if($teacher->StatusDep == 'true')
                                        Oui
                                    @else
                                        Non
                                    @endif
                                </p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0 d-flex justify-content-center">
                                    @if($teacher->StatusFil == 'true')
                                        Oui
                                    @else
                                        Non
                                    @endif
                                </p>
                            </td>
                            <td class=" align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0">{{ $teacher->sellphone }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0">{{ $teacher->created_at->format('Y-m-d') }}</p>
                            </td>

                            <td class=" d-flex justify-content-end">
                                <div>
                                    <a class="link-btn"
                                       href="{{ route('teacherDep.edit', ['id' => $teacher->id ]) }}"><img
                                            width="20" height="20" class="button_tab"
                                            src="{{ asset('admin_style/images/editar.png') }}" alt="modifier"></a>
                                    <a class="link-btn" onclick="GetSupprimerTeacher( {{ $teacher->id }} , event)"><img
                                            width="20" height="20" class="button_tab "
                                            src="{{ asset('admin_style/images/eliminar.png') }}"
                                            alt="supprimer"></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- Paginación -->
                <div class="dev_links">
                    {{ $teachers->links() }}
                </div>
            </div>

        @else
            <h5 class="no_table">Aucun Enseignant</h5>
        @endif


    </div>
    <div class="form">
        <div class="main_table ">
            <div class="card-body p-3">
                <h1 class="text-center text-primary text-bold  py-3">Ajouter Enseignant</h1>

                <ul class="list-group">
                    <form action="{{ route('teacherDep.store') }}" method="POST" class="needs-validation"
                          novalidate enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nom:</label>
                            <input type="text" id="name" name="name"
                                   class="form-control" value="{{ old('name') }}" required>
                            <x-form-error class="alert-message color-red" name="name"></x-form-error>
                        </div>

                        <div class="form-group">
                            <label for="name">Email:</label>
                            <input type="email" id="name" name="email"
                                   class="form-control" value="{{ old('email') }}" required>
                            <x-form-error class="alert-message color-red" name="email"></x-form-error>
                        </div>

                        <div class="form-group">
                            <label for="password">Mots de passe:</label>
                            <input type="password" id="password" name="password"
                                   class="form-control" required>
                            <x-form-error class="alert-message color-red" name="password"></x-form-error>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirmation de passe:</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="birthdate">Date de Naissance:</label>
                            <input type="date" id="birthdate" name="dateNaissance"
                                   class="form-control" value="{{ old('dateNaissance') }}">
                            <x-form-error class="alert-message color-red" name="dateNaissance"></x-form-error>
                        </div>

                        <div class="form-group">
                            <label for="chefDep">Chef Département:</label>
                            <select class="form-control" name="chefDep">
                                <option value="true">Oui</option>
                                <option value="false" selected>Non</option>
                            </select>
                            <x-form-error class="alert-message color-red" name="chefDep"></x-form-error>
                        </div>

                        <div class="form-group">
                            <label for="chefFil">Chef Filières:</label>
                            <select class="form-control" name="chefFil">
                                <option value="true">Oui</option>
                                <option value="false" selected>Non</option>
                            </select>
                            <x-form-error class="alert-message color-red" name="chefFil"></x-form-error>
                        </div>

                        <div class="form-group">
                            <label for="sellphone">Téléphone:</label>
                            <input type="text" id="sellphone" name="sellphone"
                                   class="form-control" value="{{ old('sellphone') }}">
                            <x-form-error class="alert-message color-red" name="sellphone"></x-form-error>
                        </div>

                        <div class="form-group">
                            <label for="photo">Photo:</label>
                            <input type="file" id="photo" name="photo"
                                   class="form-control">
                            <x-form-error class="alert-message color-red" name="photo"></x-form-error>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </ul>
            </div>

        </div>
    </div>

</main>


</body>
</html>
