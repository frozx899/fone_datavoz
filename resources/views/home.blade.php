<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ Auth::user()->username }}">

    <title>Datavoz Callfone</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/app.css">
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.js" integrity="sha512-NMtENEqUQ8zHZWjwLg6/1FmcTWwRS2T5f487CCbQB3pQwouZfbrQfylryimT3XvQnpE7ctEKoZgQOAkWkCW/vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-dark navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"></a>
                </li>
            </ul>
        </nav>
        <!-- Fin navbar -->

         <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a  class="brand-link">

            <span class="brand-text font-weight-light" style="font-size:35px; color:#c3bb10!important; margin-left:15px">Datavoz</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <a>
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="font-size:20px; color:#c3bb10!important;">
                        <div class="image">
                            <i class="nav-icon fas fa-user mt-2 text-yellow"></i>
                        </div>
                        <div class="info">

                            
                            <span class="d-block text-yellow " >
                                {{ Auth::user()->name }}
                                <br>
                                {{ Ucfirst(Auth::user()->type) }}
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Sidebar Menu -->
                @include('layouts.sidebar-menu')
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Fin main Sidebar Container -->

        <!-- Contenido vue -->
        <div class="content-wrapper">

            <router-view></router-view>

        </div> 
        <!-- Fin Contenido vue -->

        <!-- Inicio Footer -->
        <footer class="main-footer">

            <div class="float-right d-none d-sm-block">
                <b></b>
            </div>

        </footer>
        <!-- Fin Footer -->
        
    </div>

    @auth
    <script>
        window.user = @json(auth()->user())
    </script>
    @endauth
</body>
</html>
