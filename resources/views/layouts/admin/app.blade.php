<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistem Inventaris & Aset')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    @include('layouts.admin.css')


</head>

<body>
    <!-- SIDEBAR -->
    @include('layouts.admin.sidebar')

    <!-- MAIN CONTENT -->
    <div class="main-content fade-in">
        @yield('content')
    </div>

    <!-- FOOTER -->
    @include('layouts.admin.footer')

    <!-- JS -->

    @include('layouts.admin.scripts')

</body>

</html>