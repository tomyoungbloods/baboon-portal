
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="theme-color" content="#35555d" />
  <title>Baboon Portal</title>
  <link rel="manifest" href="./manifest.json" />
  <link href=./splashscreens/iphone5_splash.png media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel=apple-touch-startup-image><link href=./splashscreens/iphone6_splash.png media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel=apple-touch-startup-image><link href=./splashscreens/iphoneplus_splash.png media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)" rel=apple-touch-startup-image><link href=./splashscreens/iphonex_splash.png media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel=apple-touch-startup-image><link href=./splashscreens/iphonexr_splash.png media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel=apple-touch-startup-image><link href=./splashscreens/iphonexsmax_splash.png media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel=apple-touch-startup-image><link href=./splashscreens/ipad_splash.png media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel=apple-touch-startup-image><link href=./splashscreens/ipadpro1_splash.png media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel=apple-touch-startup-image><link href=./splashscreens/ipadpro3_splash.png media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel=apple-touch-startup-image><link href=./splashscreens/ipadpro2_splash.png media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel=apple-touch-startup-image>
 <link rel="stylesheet" href="/css/app.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="#" class="nav-link" data-widget="pushmenu"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" @keyup="searchit" v-model="search" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit" @click="search">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>


  
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 baboon-dark-bg">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="./img/Logo Wit.png" alt="Baboon Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Baboon Portal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./img/profile/{{ Auth::user()->photo }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            {{ Auth::user()->name }}
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        @can('isAdmin')
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
              <li class="nav-item">
              <router-link to="/dashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </router-link>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Management
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/users" class="nav-link">
                    <i class="fas fa-users nav-icon"></i>
                    <p>Users</p>
                  </router-link>
                </li>
              </ul> 
            </li>
            <li class="nav-item">
              <router-link to="/profile" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Profile
                </p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/mijnverzoeken" class="nav-link">
                <i class="nav-icon fas fas fa-tasks"></i>
                <p>
                  Mijn verzoeken
                </p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/alleverzoeken" class="nav-link">
                <i class="nav-icon fas fas fa-tasks"></i>
                <p>
                  Overzicht Taks
                </p>
              </router-link>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off baboon-light"></i> 
                <p class="baboon-light">
                  {{ __('Logout') }}
                </p>             
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </li>
          </ul>
        @endcan
        @can('isUser')
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
              <li class="nav-item">
              <router-link to="/dashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/profile" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Profile
                </p>
              </router-link>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off baboon-light"></i> 
                <p class="baboon-light">
                  {{ __('Logout') }}
                </p>             
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </li>
          </ul>
        @endcan
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <router-view></router-view>
        
        <vue-progress-bar></vue-progress-bar>
      </div>
    </div>
 
         
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 <a href="https://baboonbranding.nl">Baboon Branding</a>.</strong> All rights reserved.
  </footer>
</div>

@auth
<script>

window.user = @json(auth()->user()); 

</script>
@endauth
{{-- <script>
if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js');
            });
        }

</script> --}}

<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
