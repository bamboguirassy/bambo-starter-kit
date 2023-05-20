<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @hasSection('title')
            @yield('title')
        @else
            {{ config('app.name', 'Laravel') }}
        @endif
    </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style-green.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css"
        integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    @laravelPWA
</head>

<body>

    <!-- ======= Header ======= -->
    <header class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('app.home') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                <span class="d-none d-lg-block text-{{ $primary_color }}">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->
        <div id="header">
            @listable('employe')
                <search-bar></search-bar>
                <!-- End Search Bar -->
            @endlistable
        </div>

        <nav class="header-nav ms-auto navbar navbar-expand-xxl">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">

                    @livewire('app.notification.app-menu-notification-card')

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have 3 new messages
                            <a href="#"><span class="badge rounded-pill bg-{{ $primary_color }} p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Maria Hudson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all messages</a>
                        </li>

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        @if (auth()->user()->employe && auth()->user()->employe->photo)
                            <img src="{{ asset(auth()->user()->employe->photo) }}" alt="Profile"
                                class="rounded-circle">
                        @else
                            <img src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_1280.png" alt="Profile" class="rounded-circle">
                        @endif
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                            <span>{{ Auth::user()->role }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('app.user.profil') }}">
                                <i class="bi bi-person"></i>
                                <span>Mon profil</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a onclick="document.getElementById('logoutForm').submit()"
                                class="dropdown-item d-flex align-items-center" href="javascript::void(0)">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Se déconnecter</span>
                            </a>
                            <form class="d-none" id="logoutForm" action="{{ route('logout') }}" method="post">
                                @method('post')
                                @csrf
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            @foreach ($menus as $menu)
                @if ($menu['visible'])
                    <li class="nav-item">
                        <a class="nav-link @if ($menu['active']) active @else collapsed @endif"
                            @if ($menu['active']) aria-expanded="true" @endif
                            @if (count($menu['children'])) data-bs-target="#{{ $menu['id'] }}-nav" data-bs-toggle="collapse" @endif
                            href="{{ $menu['route'] }}">
                            @if (count($menu['children']))
                                <i class="bi bi-menu-button-wide"></i>
                            @else
                                <i class="{{ $menu['icon'] }}"></i>
                            @endif
                            <span>{{ $menu['label'] }}</span>
                            @if (count($menu['children']))
                                <i class="bi bi-chevron-down ms-auto"></i>
                            @endif
                        </a>
                        @if (count($menu['children']))
                            <ul id="{{ $menu['id'] }}-nav"
                                class="nav-content collapse @if ($menu['active']) show @endif"
                                data-bs-parent="#sidebar-nav">
                                @foreach ($menu['children'] as $childMenu)
                                    @if ($childMenu['visible'])
                                        <li class="@if ($childMenu['active']) nav-link active @endif">
                                            <a href="{{ $childMenu['route'] }}">
                                                <i
                                                    class="{{ $childMenu['icon'] }}"></i><span>{{ $childMenu['label'] }}</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endif
            @endforeach

            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('app.home') }}">
                    <i class="bi bi-grid"></i>
                    <span>Tableau de bord</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed">
                    <i class="bi bi-menu-button-wide"></i><span>Admin</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="gestion-admin-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @listable('user')
                        <li>
                            <a href="{{ route('app.employe.index') }}">
                                <i class="bi bi-people"></i><span>Utilisateurs</span>
                            </a>
                        </li>
                    @endlistable
                    @listable('groupe')
                        <li>
                            <a href="{{ route('app.groupe.index') }}">
                                <i class="bi bi-circle"></i><span>Groupes</span>
                            </a>
                        </li>
                    @endlistable
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#gestion-employe-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Gestion des employés</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="gestion-employe-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('app.employe.index') }}">
                            <i class="bi bi-circle"></i><span>Employés</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('app.conge.index') }}">
                            <i class="bi bi-circle"></i><span>Planning des congés</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('app.contrat.index') }}">
                            <i class="bi bi-circle"></i><span>Historiques des contrats</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#gestion-materiel-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Gestion des materiels</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="gestion-materiel-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('app.materiel.index') }}">
                            <i class="bi bi-circle"></i><span>Liste des materiels</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('app.materielemploye.index') }}">
                            <i class="bi bi-circle"></i><span>Mises à disposition</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#gestion-projet-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-journal-text"></i><span>Gestion des projets</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="gestion-projet-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('app.client.index') }}">
                            <i class="bi bi-circle"></i><span>Clients</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('app.projet.index') }}">
                            <i class="bi bi-circle"></i><span>Projets</span>
                        </a>
                    </li>
                    <li>
                        <a href="tables-data.html">
                            <i class="bi bi-circle"></i><span>Disponibilité des agents</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#ressource-technique-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Ressources techniques</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="ressource-technique-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('app.competenceemploye.index') }}">
                            <i class="bi bi-circle"></i><span>Compétences</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('app.certificationemploye.index') }}">
                            <i class="bi bi-circle"></i><span>Certifications</span>
                        </a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        <x-breadcrumb :title="$pageTitle" :items="$breadcrumbItems" />
        <a-config-provider :locale="locale">
            @yield('content')
        </a-config-provider>
        @yield('gantt')
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>{{ config('app.name') }}</span></strong>. Tous droits reservés
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://revolisgroup.com/">Revolis Group</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    {{-- vuejs day --}}
    <script src="https://unpkg.com/dayjs/dayjs.min.js"></script>
    <script src="https://unpkg.com/dayjs/plugin/customParseFormat.js"></script>
    <script src="https://unpkg.com/dayjs/plugin/weekday.js"></script>
    <script src="https://unpkg.com/dayjs/plugin/localeData.js"></script>
    <script src="https://unpkg.com/dayjs/plugin/weekOfYear.js"></script>
    <script src="https://unpkg.com/dayjs/plugin/weekYear.js"></script>
    <script src="https://unpkg.com/dayjs/plugin/advancedFormat.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @livewireScripts
    <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js"
        integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous">
    </script>
    @hasSection('gantt')
        <script type="text/javascript">
            gantt.init("gantt_here");
        </script>
    @endif
    @stack('scripts')
</body>

</html>
