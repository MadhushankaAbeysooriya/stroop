<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/Sri_Lanka_Army_Logo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/Sri_Lanka_Army_Logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/Sri_Lanka_Army_Logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm">
<div class="wrapper">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand bg-dark navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset('images/Sri_Lanka_Army_Logo.png') }}"
                         class="user-image img-circle elevation-2" alt="User Image" style="margin-inline: auto;">
                </a>
                <span class="d-none d-md-inline text-yellow">{{ Auth::user()->name }}</span>

                <ul class="dropdown-menu  dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-dark">

                        <img src="{{ asset('images/Sri_Lanka_Army_Logo.png') }}" class="img-circle elevation-2 "
                             alt="{{  Auth::user()->name  }}" style="margin-inline: auto;">

                        <p class="align-items-center justify-content-center">
                            {{ Auth::user()->name }}
                            <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>

    </nav>

    <!-- Left side column. contains the logo and sidebar -->
    @include('layouts.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version </b> 0.0.1
        </div>
        <strong>Copyright &copy; <?= date('Y') ?> Software Solution by Directorate of Information Technology.</strong> -
        SRI LANKA ARMY

    </footer>
</div>

<script src="{{ mix('js/app.js') }}" defer></script>
<script src="{{ asset('js/toastr/toastr.min.js') }}" defer></script>

@yield('third_party_scripts')

@stack('page_scripts')


@if(session()->has('info'))
    <script>
        $(document).ready(function () {
            toastr.info({{ session()->get('info') }})
        });
    </script>
@endif

@if(session()->has('danger'))
    <script>
        $(document).ready(function () {
            toastr.danger('{{ session()->get('danger') }}')
        });
    </script>
@endif

@if(session()->has('message'))
    <script>
        $(document).ready(function () {
            toastr.success('{{ session()->get('message') }}')
        });
    </script>
@endif

</body>
</html>
