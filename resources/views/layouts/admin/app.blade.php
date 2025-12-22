<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistem Inventaris & Aset')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    @include('layouts.admin.css')

    
</head>

<body>
    @include('layouts.admin.sidebar')

    {{-- Pastikan main-content tidak memiliki 'z-index' yang lebih tinggi dari tombol WA --}}
    <div class="main-content fade-in">
        @yield('content')
    </div>

    @include('layouts.admin.footer')

    <div class="wa-floating-container">
        <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20butuh%20bantuan%20terkait%20aset." 
           class="wa-btn" 
           target="_blank" 
           rel="noopener noreferrer">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>

    @include('layouts.admin.scripts')

</body>
</html>