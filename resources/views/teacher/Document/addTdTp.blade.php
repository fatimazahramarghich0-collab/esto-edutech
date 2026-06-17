<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoest.png') }}">
    <title>Ajouter TD/TP</title>
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
</head>

<body class="g-sidenav-show bg-gray-100">
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="card-header pb-0 row text-center">
            <h6 ><strong>Ajouter TD/TP </strong></h6>
        </div><br>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Ajouter TD') }}</div>
                <div class="card-body">
                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Retour</button>
                    </div>
                    <form action="{{ route('documents.uploadTd') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                        <div class="mb-3">
                            <label for="td_name" class="form-label">Nom du TD :</label>
                            <input type="text" id="td_name" name="td_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="td_file" class="form-label">Fichier du TD :</label>
                            <input type="file" id="td_file" name="file" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter le TD</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Ajouter TP') }}</div>
                <div class="card-body">
                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Retour</button>
                    </div>
                    <form action="{{ route('documents.uploadTp') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                        <div class="mb-3">
                            <label for="tp_name" class="form-label">Nom du TP :</label>
                            <input type="text" id="tp_name" name="tp_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="tp_file" class="form-label">Fichier du TP :</label>
                            <input type="file" id="tp_file" name="file" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter le TP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
