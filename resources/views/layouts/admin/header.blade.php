<header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container-fluid px-4">
        <button class="btn btn-outline-secondary d-lg-none me-3" id="toggleSidebarBtn">
            <i class="bi bi-list"></i>
        </button>

        <h5 class="mb-0 fw-semibold text-primary">
            <i class="bi bi-box-seam me-2"></i> Sistem Inventaris & Aset
        </h5>

        <div class="ms-auto d-flex align-items-center">
            <div class="dropdown">
                <button class="btn btn-light border rounded-pill px-3 dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-2"></i> Admin
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Profil</a></li>
                    <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>