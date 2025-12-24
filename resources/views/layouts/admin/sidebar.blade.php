<div class="sidebar shadow-sm" id="sidebar">
    <div class="d-flex flex-column h-100">
        <div class="sidebar-header-custom">
           <img src="{{asset('images/Logo_Besmindo.jpg')}}" width="50px" alt=""> 
            <span>Inventaris</span>
        </div>

        <div class="user-profile-section">
            <div class="profile-box">
                <div class="avatar-area">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=fff&color=335c67&bold=true" alt="User">
                </div>
                <div class="user-meta">
                    <h6 class="text-truncate">{{ auth()->user()->name }}</h6>
                    <small><i class="bi bi-geo-alt-fill"></i> {{ ucfirst(auth()->user()->role) }}</small>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            @if(auth()->user()->role == 'admin')
            <a href="{{ route('user.index') }}" class="nav-item {{ request()->is('user*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Manajemen User
            </a>
            @endif

            <a href="{{ route('kategori-aset.index') }}" class="nav-item {{ request()->is('kategori-aset*') ? 'active' : '' }}">
                <i class="bi bi-tag"></i> Kategori Aset
            </a>

            <a href="{{ route('aset.index') }}" class="nav-item {{ request()->is('aset*') ? 'active' : '' }}">
                <i class="bi bi-box"></i> Data Aset
            </a>

            <a href="{{ route('lokasi-aset.index') }}" class="nav-item {{ request()->is('lokasi-aset*') ? 'active' : '' }}">
                <i class="bi bi-geo-alt"></i> Lokasi Aset
            </a>

            <a href="{{ route('pemeliharaan.index') }}" class="nav-item {{ request()->is('pemeliharaan*') ? 'active' : '' }}">
                <i class="bi bi-wrench"></i> Pemeliharaan
            </a>

            <a href="{{ route('mutasi.index') }}" class="nav-item {{ request()->is('mutasi*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right"></i> Mutasi Aset
            </a>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout-custom">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>