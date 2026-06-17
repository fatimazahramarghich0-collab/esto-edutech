<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="asset assets/images/apple-icon.png">
    <link rel="icon" type="image/png" href="asset assets/images/logoest.png">
    <title>
        Notes
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JS Files -->
</head>

<body class="g-sidenav-show  bg-gray-100">
    <x-student.sidebar />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbar-student :pageName="'Notes'" />

        <!-- End Navbar -->
        <div class="container-fluid py-4">

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4" style="width: auto;">
                        <div class="card-header pb-0">
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Matière
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                module
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                note
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                statut
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subjectsGrades as $grade)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 ">{{ $grade->subject->name }}</p>
                                            </td>
                                            <td class=" text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ $grade->subject->module->name }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $grade->note }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                @php
                                                $status = '';
                                                $statusClass = '';

                                                if ($grade->note >= 12) {
                                                $status = 'VALIDÉE';
                                                $statusClass = 'text-success';
                                                } elseif ($grade->note >= 6 && $grade->note < 12) { $status='RATTRAPAGE' ; $statusClass='text-warning' ; } else { $status='NON VALIDÉE' ; $statusClass='text-danger' ; } @endphp <span class="text-xs font-weight-bold {{ $statusClass }}">{{ $status }}</span>
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

            <x-footerAdmin />

        </div>
    </main>



    <!--   Core JS Files   -->
    <script src="{{asset ('assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset ('assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset ('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset ('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>

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
    <script src="{{asset ('assets/js/soft-ui-dashboard.min.js?v=1.0.7')}}"></script>


</body>

</html>