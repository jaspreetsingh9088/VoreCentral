<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Admin</title>

    <link rel="stylesheet" href="/public/admin/css/adminlte.min.css">
    <link rel="stylesheet" href="/public//admin/css/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/public/admin/css/style.css">
    <link rel="stylesheet" href="/public/admin/js/Chart.min.css">
    <link rel="stylesheet" href="/public/admin/js/Chart.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" >
    <link rel="stylesheet" href="/public/admin/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="/public/admin/plugins/sweetalert2/sweetalert2.css">


    @livewireStyles
    @stack('links')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')
        @yield('content')
        @include('admin.layouts.footer')
    </div>
    <script src="/public/admin/js/jquery-3.6.0.min.js"></script>
    <script src="/public/admin/js/popper.min.js"></script>
    <script src="/public/admin/js/bootstrap.min.js"></script>
    <script src="/public/admin/js/adminlte.min.js"></script>
    <script src="/public/admin/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="/public//admin/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
    @livewireScripts
    <script src="{{ asset('admin/js/common.js') }}"></script>
    @stack('script')
</body>

</html>
