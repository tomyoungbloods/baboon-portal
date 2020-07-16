
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
  <link rel="apple-touch-icon" href="https://cdn.glitch.com/49d34dc6-8fbd-46bb-8221-b99ffd36f1af%2Ftouchicon-180.png?v=1566411949736">
 <link rel="stylesheet" href="/css/app.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light d-none d-sm-block">
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
  <div class="d-flex d-sm-none flex-row fixed-top header-logo">
    <img src="./img/Logo Wit.png">
  </div>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 baboon-dark-bg d-none d-sm-block">
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
      <nav class="mt-2 d-none d-sm-block">
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
                  Overzicht Tasks
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
        @can('isAuthor')
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
              <router-link to="/mijnverzoeken" class="nav-link">
                <i class="nav-icon fas fas fa-tasks"></i>
                <p>
                  Mijn verzoeken
                </p>
              </router-link>
            </li>
            {{-- <li class="nav-item">
              <router-link to="/alleverzoeken" class="nav-link">
                <i class="nav-icon fas fas fa-tasks"></i>
                <p>
                  Overzicht Taks
                </p>
              </router-link>
            </li> --}}
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

  <div class="d-flex d-sm-none flex-row bottom-menu fixed-bottom">
    <div class="col-4">
      <router-link to="/dashboard">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </router-link>
    </div>
    <div class="col-4">
      <router-link to="/mijnverzoeken">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
          Mijn verzoeken
        </p>
      </router-link>
    </div>
    <div class="col-4">
      <router-link to="/alleverzoeken">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
          Overzicht Tasks
        </p>
      </router-link>
    </div>
       
  </div>

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
<script>
if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js');
            });
        }
</script>

<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
