<div class="sidebar" id="sidebar">
    <div>
        <div class="sidebar-header">
            <i class="bi bi-box-seam"></i>
            <span>Inventaris</span>
        </div>

        <div class="px-3 py-3 mb-2 border-bottom shadow-sm" style="background: rgba(255,255,255,0.05); border-radius: 0 0 15px 15px;">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-person-fill text-primary" style="font-size: 1.2rem;"></i>
                    </div>
                </div>
                <div class="flex-grow-1 ms-3 overflow-hidden">
                    <h6 class="mb-0 text-white text-truncate fw-bold" style="font-size: 0.9rem;">
                        {{ auth()->user()->name }}
                    </h6>
                    <small class="text-white-50 d-block" style="font-size: 0.75rem;">
                        <i class="bi bi-shield-lock me-1"></i> {{ ucfirst(auth()->user()->role) }}
                    </small>
                </div>
            </div>
        </div>

        <nav class="nav flex-column">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            @if(auth()->user()->role == 'admin')
            <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Manajemen User
            </a>
            @endif

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
            <button type="submit" class="logout-btn w-100">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </form>
    </div>
</div>