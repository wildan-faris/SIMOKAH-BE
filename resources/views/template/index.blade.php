<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bootstrap/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('bootstrap/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('bootstrap/dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand  navbar-light" style=" background-color:#52A67E;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>
            <div class="ml-5"></div>
            <div class="ml-5"></div>
            <div class="ml-5"></div>
            <div class="col-6 ml-5">
                <marquee direction="left" scrollamount="4" class="text-white" align="center">Selamat Datang di PHAS.</marquee>
            </div>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    @if (session()->get('role') === "admin")
                    <a href="/admin/logout" class="text-white">
                        <div class=""><i class="fas fa-sign-out-alt"></i> Logout</div>
                    </a>
                    @elseif (session()->get('role') === "kepala sekolah")
                    <a href="/kepala_sekolah/logout" class="text-white">
                        <div class=""><i class="fas fa-sign-out-alt"></i> Logout</div>
                    </a>
                    @endif


                </li>

                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->

            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-white-success elevation-2 bg-white ">
            <!-- Brand Logo -->
            <a href="../index3.html" class="brand-link ">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text text-dark text-bold">PHAS</span>
            </a>
            <hr>
            <div class="sidebar">

                <div class="user-panel  pb-2  d-flex ">
                    <div class="image">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <h4 href="#" class="d-block text-dark text-bold">{{session()->get('role')}}</h4>
                    </div>
                </div>
                <hr>

                <!-- Sidebar Menu -->
                <nav class="mt-1">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                        <li class="nav-item {{(request()->is('/')?'bg-secondary':'')}}">
                            <a href=" /" class="nav-link ">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    BERANDA

                                </p>
                            </a>
                        </li>
                        @if (session()->get("role") == "admin")
                        <li class="nav-item {{(request()->is('kepala_sekolah/index')?'bg-secondary':'')}}
                         {{(request()->is('kepala_sekolah/create/index')?'bg-secondary':'')}}">
                            <a href="/kepala_sekolah/index" class="nav-link ">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    KEPALA SEKOLAH

                                </p>
                            </a>
                        </li>


                        <li class="nav-item {{(request()->is('guru/index')?'bg-secondary':'')}} 
                        {{(request()->is('guru/create/index')?'bg-secondary':'')}}">
                            <a href="/guru/index" class="nav-link ">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    GURU

                                </p>
                            </a>
                        </li>
                        @endif






                        <li class="nav-item 
                        {{(request()->is('kelas/*')?'bg-secondary':'')}}
                         ">
                            <a href="/kelas/index" class="nav-link ">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>
                                    KELAS

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
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">


                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">

            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="{{asset('bootstrap/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('bootstrap/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{asset('bootstrap/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('bootstrap/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('bootstrap/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('bootstrap/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('bootstrap/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('bootstrap/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('bootstrap/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('bootstrap/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('bootstrap/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('bootstrap/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('bootstrap/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('bootstrap/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <!-- AdminLTE App -->
    <script src="{{asset('bootstrap/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('bootstrap/plugins/flot/plugins/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('bootstrap/plugins/flot/jquery.flot.js')}}"></script>
    <!-- Page specific script -->
    @yield('scripts')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

        });
    </script>
</body>

</html>