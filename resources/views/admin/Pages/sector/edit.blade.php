<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="asset assets/images/apple-icon.png">
    <link rel="icon" type="image/png" href="asset assets/images/logoest.png">
    <title>
        Modifier une filière
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
</head>

<body class="g-sidenav-show  bg-gray-100">
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modifier une filière') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('sector.update', $sector->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name" class="col-form-label">{{ __('Nom de la filière') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $sector->name }}" required autocomplete="name" autofocus>
                        </div>

                        <div class="form-group">
                            <label for="ChefFil" class="col-form-label">{{ __('Chef de filière') }}</label>
                            <select id="ChefFil" class="form-control" name="ChefFil" required>
                                @foreach($chefs as $chef)
                                    <option value="{{ $chef }}" {{ $chef == $sector->ChefFil ? 'selected' : '' }}>{{ $chef }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">{{ __('Description') }}</label>
                            <textarea id="description" class="form-control" name="description" required>{{ $sector->description }}</textarea>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Enregistrer les modifications') }}
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                                {{ __('Retour') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</body>

</html>
