<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | @yield('title', 'Default Value')</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">



    {{-- <link rel="stylesheet" href="/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="<?= asset('css/bootstrap.min.css') ?>">

    <script src="/js/bootstrap.min.js"></script>
    <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <style>
        td,th{
            text-align:center;
        }
    </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home.index') }}" class="nav-link"><i class="nav-icon fas fa-home"></i> Web Site</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.contacts.edit', 1) }}" class="nav-link">Contact</a>
          </li>
        </ul>

        <!-- SEARCH FORM -->
        @yield('filtring')
        {{-- <form class="form-inline ml-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="date" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form> --}}

        <!-- Right navbar links -->

        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                {{-- <i class="far fa-comments"></i> --}}
                <span class="badge badge-danger">{{ Auth::user()->name }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="/admin/profile" class="dropdown-item">
                  <!-- Message Start -->
                  <div class="media">
                    <div class="media-body">
                      <h3 class="dropdown-item-title">
                        Profile
                      </h3>
                    </div>
                  </div>
                  <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" onclick="document.getElementById('logout').submit()">
                  <!-- Message Start -->
                  <div class="media">

                    <div class="media-body">
                      <h5 class="dropdown-item-title">
                        Sign Out
                      </h5>
                    </div>
                  </div>
                  <!-- Message End -->
                </a>
                <form action="{{ route('logout') }}" method="post" class="d-none" id="logout">
                    @csrf
                    <button type="submit"></button>
                </form>

                {{-- <div class="dropdown-divider"></div> --}}

              </div>
            </li>
            <!-- Notifications Dropdown Menu -->

            {{-- <li class="nav-item">
              <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
              </a>
            </li> --}}
          </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('admin.dachoard') }}" class="brand-link" style="text-decoration: none;">
          <img src="{{ $contacts->logo_url }}" alt="Logo">
          {{-- <h1 class="brand-text font-weight-light">{{ config('app.name') }}</h1> --}}
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
          </div> --}}

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.dachoard') }}" @if(\Request::route()->getName() == 'admin.dachoard')
                      class="nav-link active" @else class="nav-link" @endif>
                        <i class="nav-icon fas fa-tachometer-alt"></i>

                        <p>
                        Dachoard
                        {{-- <span class="badge badge-info right">6</span> --}}
                      </p>
                    </a>
                </li>

              <li @if(\Request::route()->getName() == 'admin.doctors.index' || \Request::route()->getName() == 'admin.doctors.create')
                class="nav-item has-treeview menu-open" @else class="nav-item has-treeview" @endif>
                <a href="#" @if(\Request::route()->getName() == 'admin.doctors.index' || \Request::route()->getName() == 'admin.doctors.create')
                    class="nav-link active" @else class="nav-link" @endif >
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                    Doctors
                    <i class="fas fa-angle-left right"></i>
                    {{-- <span class="badge badge-info right">6</span> --}}
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.doctors.index') }}" @if(\Request::route()->getName() == 'admin.doctors.index')
                        class="nav-link active" @else class="nav-link" @endif>
                      <i class="far fa-circle nav-icon"></i>
                      <p>View All Doctors</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.doctors.create') }}" @if(\Request::route()->getName() == 'admin.doctors.create')
                        class="nav-link active" @else class="nav-link" @endif>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add new Doctor</p>
                    </a>
                  </li>

                </ul>
              </li>

              <li @if(\Request::route()->getName() == 'admin.clients.index' || \Request::route()->getName() == 'admin.clients.create')
                class="nav-item has-treeview menu-open" @else class="nav-item has-treeview" @endif>
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                    Clients
                    <i class="fas fa-angle-left right"></i>
                    {{-- <span class="badge badge-info right">6</span> --}}
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.clients.index') }}" @if(\Request::route()->getName() == 'admin.clients.index')
                        class="nav-link active" @else class="nav-link" @endif>
                      <i class="far fa-circle nav-icon"></i>
                      <p>View All Clients</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.clients.create') }}" @if(\Request::route()->getName() == 'admin.clients.create')
                        class="nav-link active" @else class="nav-link" @endif>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add new Clients</p>
                    </a>
                  </li>

                </ul>
              </li>

              <li @if(\Request::route()->getName() == 'admin.services.index' || \Request::route()->getName() == 'admin.services.create')
                class="nav-item has-treeview menu-open" @else class="nav-item has-treeview" @endif>
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Services
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.services.index') }}" @if(\Request::route()->getName() == 'admin.services.index')
                        class="nav-link active" @else class="nav-link" @endif>
                      <i class="far fa-circle nav-icon"></i>
                      <p>View All Services</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.services.create') }}" @if(\Request::route()->getName() == 'admin.services.create')
                        class="nav-link active" @else class="nav-link" @endif>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add new Service</p>
                    </a>
                  </li>

                </ul>
              </li>

              <li @if(\Request::route()->getName() == 'admin.sliders.index' || \Request::route()->getName() == 'admin.sliders.create')
                class="nav-item has-treeview menu-open" @else class="nav-item has-treeview" @endif>
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-images"></i>
                  <p>
                    Sliders
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a href="{{ route('admin.sliders.index') }}" @if(\Request::route()->getName() == 'admin.sliders.index')
                        class="nav-link active" @else class="nav-link" @endif>
                      <i class="far fa-circle nav-icon"></i>
                      <p>View All Sliders</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.sliders.create') }}" @if(\Request::route()->getName() == 'admin.sliders.create')
                        class="nav-link active" @else class="nav-link" @endif>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add new Slider</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li @if(\Request::route()->getName() == 'admin.gallaries.index' || \Request::route()->getName() == 'admin.gallaries.create')
                class="nav-item has-treeview menu-open" @else class="nav-item has-treeview" @endif>
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-image"></i>
                  <p>
                    Gallaries
                    <i class="fas fa-angle-left right"></i>
                    {{-- <span class="badge badge-info right">6</span> --}}
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.gallaries.index') }}" @if(\Request::route()->getName() == 'admin.gallaries.index')
                        class="nav-link active" @else class="nav-link" @endif>
                      <i class="far fa-circle nav-icon"></i>
                      <p>View All Gallaries</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.gallaries.create') }}" @if(\Request::route()->getName() == 'admin.gallaries.create')
                        class="nav-link active" @else class="nav-link" @endif>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add new Gallary</p>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item has-treeview">
                <a href="{{ route('admin.messages.index') }}" @if(\Request::route()->getName() == 'admin.messages.index')
                    class="nav-link active" @else class="nav-link" @endif>
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Messages
                    {{-- <i class="fas fa-angle-left right"></i> --}}
                    {{-- <span class="badge badge-info right">6</span> --}}
                  </p>
                </a>
                {{-- <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.messages.index') }}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>View All Messages</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.messages.create') }}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add new Message</p>
                    </a>
                  </li>

                </ul> --}}
              </li>

              <li class="nav-item has-treeview">
                <a href="{{ route('admin.appointments.index') }}" @if(\Request::route()->getName() == 'admin.appointments.index')
                    class="nav-link active" @else class="nav-link" @endif>
                  <i class="nav-icon fas fa-edit"></i>
                  <p>
                    Appointments
                    {{-- <i class="fas fa-angle-left right"></i> --}}
                    {{-- <span class="badge badge-info right">6</span> --}}
                  </p>
                </a>
                {{-- <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.appointments.index') }}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>View All Appointments</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.appointments.create') }}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add new Appointment</p>
                    </a>
                  </li>

                </ul> --}}
              </li>

              <li class="nav-item has-treeview">
                <a href="{{ route('admin.contacts.edit', 1) }}" @if(\Request::route()->getName() == 'admin.contacts.edit')
                    class="nav-link active" @else class="nav-link" @endif>
                  <i class="nav-icon fas fa-info"></i>
                  <p>
                    Systems Info
                  </p>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-8">

                    <div class="border-bottom py-4 d-flex justify-content-between">
                        <h1 >@yield('title','TITLE')</h1>
                    </div>
                    {{-- {{ $slot }} --}}
                     @yield('content')

                </div>
            </div>
        </div>

        <section class="content">

        </section>

    </div>





    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/dist/js/demo.js"></script>

    <script src="/js/bootstrap.min.js"></script>

    @livewireScripts

    <script>
          // Add active class to the current button (highlight it)
          var header = document.getElementById("myDIV");
          var btns = header.getElementsByClassName("btn");
          for (var i = 0; i < btns.length; i++) {
          btns[i].addEventListener("click", function() {
          var current = document.getElementsByClassName("active");
          current[0].className = current[0].className.replace(" active", "");
          this.className += " active";
          });
          }
    </script>


    </body>
</html>
