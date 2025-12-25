<footer class="footer mt-auto" style="background: #ffffff; border-top: 1px solid #e3e6f0; padding: 30px 0; position: relative; z-index: 10;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center" style="padding-left: 80px;"> 
                
                {{-- Logo & Brand --}}
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <img src="{{ asset('images/Logo_Besmindo.jpg') }}" alt="Logo" style="height: 28px; opacity: 0.9; margin-right: 12px;">
                    <div style="font-size: 1rem; color: #1a374d; letter-spacing: 0.5px;">
                        &copy; {{ date('Y') }} <span style="font-weight: 800;">PT. BESMINDO</span>
                    </div>
                </div>
                
                {{-- Tagline --}}
                <div class="mb-3" style="font-size: 0.85rem; color: #6e707e; font-style: italic; opacity: 0.8;">
                    Sistem Manajemen Inventaris & Aset
                </div>

                {{-- Developer Info --}}
                <div class="mb-3 py-2" style="border-top: 1px solid #f8f9fc; border-bottom: 1px solid #f8f9fc; display: inline-block; padding: 0 20px;">
                    <span class="text-uppercase fw-bold" style="letter-spacing: 1.5px; color: #b7b9cc; font-size: 0.65rem; display: block; margin-bottom: 5px;">Developed by:</span>
                    <div style="font-size: 0.85rem;">
                        <span style="color: #1a374d; font-weight: 700;">Muhammad Syabil Al Jabbar</span> 
                        <span class="mx-2 text-muted">|</span> 
                        <span style="color: #4e73df; font-weight: 600;">2457301098</span> 
                        <span class="mx-2 text-muted">|</span> 
                        <span style="color: #6e707e;">Sistem Informasi</span>
                    </div>
                </div>

                {{-- Social Links --}}
                <div class="d-flex justify-content-center gap-4 mb-3">
                    <a href="https://linkedin.com/in/username" class="footer-link" target="_blank">
                        <i class="bi bi-linkedin"></i> LinkedIn
                    </a>
                    <a href="https://github.com/Inventaris-Admin" class="footer-link" target="_blank">
                        <i class="bi bi-github"></i> GitHub
                    </a>
                    <a href="https://instagram.com/syabil.ajbr" class="footer-link" target="_blank">
                        <i class="bi bi-instagram"></i> Instagram
                    </a>
                </div>

                {{-- Version --}}
                <div style="font-size: 0.7rem; color: #d1d3e2; font-weight: 600; text-uppercase; letter-spacing: 1px;">
                    v1.0.0 — All Rights Reserved.
                </div>

            </div>
        </div>
    </div>
</footer>

<style>
    .footer-link {
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #858796;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .footer-link i { font-size: 1rem; }
    .footer-link:hover { color: #1a374d; transform: translateY(-2px); }
    
    /* Responsive adjustment */
    @media (max-width: 768px) {
        .col-md-10 { padding-left: 0 !important; }
    }
</style>