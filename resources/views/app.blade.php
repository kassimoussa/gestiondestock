@php
use App\Models\User;
$user = User::where('id', session('id'))->first();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <title>{{ $page }} </title>

    {{-- @livewireStyles --}}
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">


    <!-- Scripts -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>

    <style>
        body {
            background: #f1f2f5;
        }

        .nav_link:hover {
            color: blue !important;
            font-weight: bold;
            font-size: 18px;

        }

        .nav_link {
            color: white !important;
            font-size: 18px;
        }

        .activee {
            color: blue !important;
            font-weight: bold;
            font-size: 18px;
            background: #212529 !important;
        }

        .dropdown-item .activee {}

        .main-c {
            padding-left: 50px;
            padding-right: 50px;
            padding-top: 6rem
        }

        .dropdown-toggle::after {
            display: none;
        }
    </style>
</head>

<body {{-- oncontextmenu='return false' --}} class='snippet-body'>

    <!-- Page Heading -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark main-navigation">
        <div class="container-fluid">
            {{-- <a class="navbar-brand" href="#"><img src="{{ asset('images/logo.png') }}" height="40px" width="70px"
                    alt=""></a> --}}
            <a class="navbar-brand  mr-auto mr-lg-3 ml-3 ml-lg-0 @if ($pageSlug == 'accueil') {{ 'activee' }} @endif"
                href="/index"> Accueil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav_link
                          @if ($pageSlug == 'rentrees') {{ 'activee' }} @endif "
                            href="/allrentree ">
                            Rentrées
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav_link
                          @if ($pageSlug == 'sorties') {{ 'activee' }} @endif "
                            href="/allsortie">
                            Sorties
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link nav_link
                           @if ($sup == 'admin') {{ 'activee' }} @endif "
                            href="/admin">
                            Users
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link nav_link   @if ($sup == 'incidents') {{ 'activee' }} @endif " href="/incidents" >Rapports</a>
                    </li> --}}
                    {{-- <div class="nav-item dropdown ">

                        <a class="nav-link nav_link  dropdown-toggle @if ($sup == 'incidents') {{ 'activee' }} @endif "
                            id="rapport" role="button" data-bs-toggle="dropdown" aria-expanded="false">Rapports</a>

                        <ul class="dropdown-menu dropdown-menu-dark bg-dark" aria-labelledby="rapport">
                            <li><a class="dropdown-item @if ($pageSlug == 'listincident') {{ 'activee' }} @endif"
                                    href="/incidents">Liste</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item @if ($pageSlug == 'stats') {{ 'activee' }} @endif"
                                    href="/incidents/stats">Stats</a></li>
                        </ul>
                    </div> --}}

                    {{-- <div class="nav-item dropdown ">

                        <a class="nav-link nav_link  dropdown-toggle 
                            @if ($sup == 'projet') {{ 'activee' }} @endif "
                            id="rapport" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Access Project
                        </a>

                        <ul class="dropdown-menu dropdown-menu-dark bg-dark" aria-labelledby="rapport">
                            <li>
                                <a class="dropdown-item 
                                @if ($pageSlug == 'listprojet') {{ 'activee' }} @endif"
                                    href="/projets">
                                    Liste
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item 
                                @if ($pageSlug == 'statsprojet') {{ 'activee' }} @endif"
                                    href="/projets/stats">
                                    Stats
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item 
                                @if ($pageSlug == 'fiabilisation') {{ 'activee' }} @endif"
                                    href="/projets/fiabilisation">
                                    Fiabilisation
                                </a>
                            </li>
                        </ul>
                    </div> --}}

                </ul>
                <div class="d-flex">
                    <div class="nav-item dropdown dropstart">

                        <h5 class="nav-link nav_link fw-bold   dropdown-toggle @if ($pageSlug == 'profile') {{ 'activee' }} @endif "
                            id="user" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $user->name }}
                        </h5>

                        <ul class="dropdown-menu dropdown-menu-dark bg-dark" aria-labelledby="user">
                            <li>
                                <a class="dropdown-item
                                   @if ($pageSlug == 'profile') {{ 'activee' }} @endif"
                                    href="/profile">
                                    Profile
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="/logout">
                                    Déconnexion
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <!-- Page Content -->
    <!--Container Main start-->

    <div class="main-c  mt-10">
        @yield('content')

    </div>


    @stack('modals')

    @stack('scripts')

    {{-- @livewireScripts --}}
    @yield('script')

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    <script>
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        })
    </script>

    <script>
        $(document).ready(function() {
            $('table.display').DataTable({
                "paging": false,
                "info": false,
                "searching": false,
                /* "scrollY":        "600px",
                "scrollCollapse": true, */
                "filter": true
            });
        });

        $(document).ready(function() {
            $('table.janvier').DataTable({
                "paging": false,
                "info": false,
                "searching": false,
                /* "scrollY":        "600px",
                "scrollCollapse": true, */
                "filter": true
            });
        });

        $(document).ready(function() {
            $('table.fevrier').DataTable({
                "paging": false,
                "info": false,
                "searching": false,
                /* "scrollY":        "600px",
                "scrollCollapse": true, */
                "filter": true
            });
        });

        $(document).ready(function() {
            $('table.mars').DataTable({
                "paging": false,
                "info": false,
                "searching": false,
                /* "scrollY":        "600px",
                "scrollCollapse": true, */
                "filter": true
            });
        });

        $(document).ready(function() {
            $('table.avril').DataTable({
                "paging": false,
                "info": false,
                "searching": false,
                /* "scrollY":        "600px",
                "scrollCollapse": true, */
                "filter": true
            });
        });

        $(document).ready(function() {
            $('table.mai').DataTable({
                "paging": false,
                "info": false,
                "searching": false,
                /* "scrollY":        "600px",
                "scrollCollapse": true, */
                "filter": true
            });
        });

        $(document).ready(function() {
            $('table.juin').DataTable({
                "paging": false,
                "info": false,
                "searching": false,
                /* "scrollY":        "600px",
                "scrollCollapse": true, */
                "filter": true
            });
        });

        $(document).ready(function() {
            $('table.juillet').DataTable({
                "paging": false,
                "info": false,
                "searching": false,
                /* "scrollY":        "600px",
                "scrollCollapse": true, */
                "filter": true
            });
        });

        $(document).ready(function() {
            $('table.aout').DataTable({
                "paging": false,
                "info": false,
                "searching": false,
                /* "scrollY":        "600px",
                "scrollCollapse": true, */
                "filter": true
            });
        });

        $(document).ready(function() {
            $('table.septembre').DataTable({
                "paging": false,
                "info": false,
                "searching": false,
                /* "scrollY":        "600px",
                "scrollCollapse": true, */
                "filter": true
            });
        });

        $(document).ready(function() {
            $('table.octobre').DataTable({
                "paging": false,
                "info": false,
                "searching": false,
                /* "scrollY":        "600px",
                "scrollCollapse": true, */
                "filter": true
            });
        });

        $(document).ready(function() {
            $('table.novembre').DataTable({
                "paging": false,
                "info": false,
                "searching": false,
                /* "scrollY":        "600px",
                "scrollCollapse": true, */
                "filter": true
            });
        });

        $(document).ready(function() {
            $('table.decembre').DataTable({
                "paging": false,
                "info": false,
                "searching": false,
                /* "scrollY":        "600px",
                "scrollCollapse": true, */
                "filter": true
            });
        });
    </script>

</body>

</html>
