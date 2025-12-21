<div class="sidebar" id="sidebar">
    <div>
        <div class="sidebar-header">
            <i class="bi bi-box-seam"></i>
            <span>Inventaris</span>
        </div>

        <nav class="nav flex-column">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('kategori-aset.index') }}" class="nav-link {{ request()->is('kategori-aset*') ? 'active' : '' }}">
                <i class="bi bi-tag"></i> Kategori Aset
            </a>
            <a href="{{ route ('aset.index') }}" class="nav-link {{ request()->is('aset*') ? 'active' : '' }}">
                <i class="bi bi-box"></i> Data Aset
            </a>
            <a href="{{route('lokasi-aset.index')}}" class="nav-link {{ request()->is('lokasi-aset*') ? 'active' : '' }}">
                <i class="bi bi-geo-alt"></i> Lokasi Aset
            </a>
            <a href="{{route('pemeliharaan.index')}}" class="nav-link {{ request()->is('pemeliharaan*') ? 'active' : '' }}">
                <i class="bi bi-wrench"></i> Pemeliharaan
            </a>
            <a href="{{route('mutasi.index')}}" class="nav-link {{ request()->is('mutasi*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right"></i> Mutasi Aset
            </a>
        </nav>
    </div>

    <div class="logout-section">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </form>
    </div>
</div>