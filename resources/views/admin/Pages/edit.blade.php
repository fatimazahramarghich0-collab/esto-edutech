<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoest.png') }}">
    <title>Edit Teacher</title>
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
</head>

<body class="g-sidenav-show bg-gray-100">
<div class="container py-4">
    <div class="form-group mt-3">
        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Retour</button>
    </div>
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Teacher') }}</div>
                <div class="card-body">
                    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name" class="col-form-label">{{ __('Name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $teacher->name }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-form-label">{{ __('Email') }}</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ $teacher->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="dateNaissance" class="col-form-label">{{ __('Date of Birth') }}</label>
                            <input type="date" class="form-control" id="dateNaissance" name="dateNaissance"
                                   value="{{ $teacher->dateNaissance }}">
                        </div>

                        <div class="form-group">
                            <label for="StatusDep" class="col-form-label">{{ __('Status Department') }}</label>
                            <select class="form-control" id="StatusDep" name="StatusDep" required>
                                <option
                                    value="oui" {{ $teacher->StatusDep === 'oui' ? 'selected' : '' }}>{{ __('Oui') }}</option>
                                <option
                                    value="non" {{ $teacher->StatusDep === 'non' ? 'selected' : '' }}>{{ __('Non') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="StatusFil" class="col-form-label">{{ __('Status Filiere') }}</label>
                            <select class="form-control" id="StatusFil" name="StatusFil" required>
                                <option
                                    value="oui" {{ $teacher->StatusFil === 'oui' ? 'selected' : '' }}>{{ __('Oui') }}</option>
                                <option
                                    value="non" {{ $teacher->StatusFil === 'non' ? 'selected' : '' }}>{{ __('Non') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sellphone" class="col-form-label">{{ __('Phone Number') }}</label>
                            <input type="text" class="form-control" id="sellphone" name="sellphone"
                                   value="{{ $teacher->sellphone }}">
                        </div>

                        <div class="form-group">
                            <label for="photo" class="col-form-label">{{ __('Photo') }}</label>
                            <input id="photo" type="file" class="form-control" name="photo">
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
