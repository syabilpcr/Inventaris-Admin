@extends('layouts.admin.app')

@section('title', 'Dashboard Inventaris')

@section('content')
<div class="container-fluid py-4 px-lg-5 px-md-4 px-3" style="background: #f9f3ef; min-height: 100vh;">

    {{-- Header --}}
    <div class="header-section mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold text-white mb-1">
                    <i class="bi bi-box-seam"></i> Dashboard Inventaris

                </h2>
                <p class="text-white-50 mb-0">Pantau aset dan kondisi inventaris secara real-time</p>
            </div>

        </div>
    </div>

    {{-- Statistik Utama --}}
    <div class="row g-4 justify-content-center mb-4">
        @php
        $stats = [
        ['icon' => 'bi-box-seam', 'color' => 'primary', 'value' => '105', 'label' => 'Total Aset'],
        ['icon' => 'bi-check-circle', 'color' => 'success', 'value' => '87%', 'label' => 'Aset Kondisi Baik'],
        ['icon' => 'bi-wrench-adjustable-circle', 'color' => 'warning', 'value' => '9%', 'label' => 'Perlu Pemeliharaan'],
        ['icon' => 'bi-exclamation-triangle', 'color' => 'danger', 'value' => '4%', 'label' => 'Rusak'],
        ];
        @endphp

        @foreach ($stats as $stat)
        <div class="col-xl-3 col-md-6 col-sm-6">
            <div class="card shadow-sm border-0 p-3 hover-shadow h-100" style="background: #ffffff;">
                <div class="d-flex align-items-center">
                    <div class="icon-circle bg-{{ $stat['color'] }} bg-opacity-10 text-{{ $stat['color'] }} me-3">
                        <i class="bi {{ $stat['icon'] }} fs-4"></i>

                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">{{ $stat['value'] }}</h5>
                        <small class="text-muted">{{ $stat['label'] }}</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Statistik Detail --}}
    <div class="row g-4 mb-4 justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100" style="background: #ffffff;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0" style="color: #1b3c53;">
                        <i class="bi bi-tags me-2"></i>Kategori Aset
                    </h5>
                    <a href="#" class="text-decoration-none small" style="color: #1b3c53;">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-start" style="color: #1b3c53;">Kategori</th>
                                <th class="text-center" style="color: #1b3c53;">Jumlah</th>
                                <th class="text-center" style="color: #1b3c53;">Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start">
                                    <i class="bi bi-laptop me-2" style="color: #1b3c53;"></i>Elektronik
                                </td>
                                <td class="text-center fw-bold" style="color: #1b3c53;">35</td>
                                <td class="text-center">
                                    <span class="badge" style="background: rgba(27, 60, 83, 0.1); color: #1b3c53;">35%</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-start">
                                    <i class="bi bi-house-door me-2" style="color: #456882;"></i>Furnitur
                                </td>
                                <td class="text-center fw-bold" style="color: #1b3c53;">25</td>
                                <td class="text-center">
                                    <span class="badge" style="background: rgba(69, 104, 130, 0.1); color: #456882;">25%</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-start">
                                    <i class="bi bi-truck me-2" style="color: #d2c1b6;"></i>Kendaraan
                                </td>
                                <td class="text-center fw-bold" style="color: #1b3c53;">15</td>
                                <td class="text-center">
                                    <span class="badge" style="background: rgba(210, 193, 182, 0.2); color: #d2c1b6;">15%</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-start">
                                    <i class="bi bi-printer me-2" style="color: #1b3c53;"></i>Peralatan Kantor
                                </td>
                                <td class="text-center fw-bold" style="color: #1b3c53;">20</td>
                                <td class="text-center">
                                    <span class="badge" style="background: rgba(27, 60, 83, 0.1); color: #1b3c53;">20%</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-start">
                                    <i class="bi bi-three-dots me-2" style="color: #456882;"></i>Lainnya
                                </td>
                                <td class="text-center fw-bold" style="color: #1b3c53;">10</td>
                                <td class="text-center">
                                    <span class="badge" style="background: rgba(69, 104, 130, 0.1); color: #456882;">10%</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100" style="background: #ffffff;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0" style="color: #1b3c53;">
                        <i class="bi bi-activity me-2"></i>Kondisi Aset
                    </h5>
                    <a href="#" class="text-decoration-none small" style="color: #1b3c53;">
                        Detail <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-start" style="color: #1b3c53;">Kondisi</th>
                                <th class="text-center" style="color: #1b3c53;">Jumlah</th>
                                <th class="text-center" style="color: #1b3c53;">Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start">
                                    <i class="bi bi-check-circle-fill me-2" style="color: #456882;"></i>Baik
                                </td>
                                <td class="text-center fw-bold" style="color: #1b3c53;">84</td>
                                <td class="text-center">
                                    <span class="badge" style="background: rgba(69, 104, 130, 0.1); color: #456882;">70%</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-start">
                                    <i class="bi bi-tools me-2" style="color: #d2c1b6;"></i>Perlu Servis
                                </td>
                                <td class="text-center fw-bold" style="color: #1b3c53;">24</td>
                                <td class="text-center">
                                    <span class="badge" style="background: rgba(210, 193, 182, 0.2); color: #d2c1b6;">20%</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-start">
                                    <i class="bi bi-exclamation-triangle-fill me-2" style="color: #1b3c53;"></i>Rusak
                                </td>
                                <td class="text-center fw-bold" style="color: #1b3c53;">12</td>
                                <td class="text-center">
                                    <span class="badge" style="background: rgba(27, 60, 83, 0.1); color: #1b3c53;">10%</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart & Quick Insight --}}
    <div class="row g-4 justify-content-center">
        <div class="col-xl-8 col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100" style="background: #ffffff;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0" style="color: #1b3c53;">
                        <i class="bi bi-graph-up-arrow me-2"></i>Tren Pertumbuhan Aset (6 Bulan)
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" style="background: #456882; color: white; border: none;">
                            <i class="bi bi-filter me-1"></i> Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">6 Bulan</a></li>
                            <li><a class="dropdown-item" href="#">1 Tahun</a></li>
                            <li><a class="dropdown-item" href="#">2 Tahun</a></li>
                        </ul>
                    </div>
                </div>
                <div class="chart-container" style="height: 250px;">
                    <canvas id="chartAset"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100" style="background: #ffffff;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0" style="color: #1b3c53;">
                        <i class="bi bi-lightbulb me-2"></i>Quick Insights
                    </h5>
                    <i class="bi bi-info-circle" style="color: #456882;"></i>
                </div>

                <div class="insight-item d-flex align-items-center mb-3 p-3 rounded-3" style="background: rgba(69, 104, 130, 0.1);">
                    <div class="insight-icon me-3">
                        <i class="bi bi-check-circle-fill fs-5" style="color: #456882;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold" style="color: #1b3c53;">Aset dalam kondisi baik</div>
                        <small class="text-muted">Tingkat kondisi optimal</small>
                    </div>
                    <div class="fw-bold fs-5" style="color: #456882;">87%</div>
                </div>

                <div class="insight-item d-flex align-items-center mb-3 p-3 rounded-3" style="background: rgba(210, 193, 182, 0.2);">
                    <div class="insight-icon me-3">
                        <i class="bi bi-tools fs-5" style="color: #d2c1b6;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold" style="color: #1b3c53;">Perlu pemeliharaan</div>
                        <small class="text-muted">Perlu pengecekan rutin</small>
                    </div>
                    <div class="fw-bold fs-5" style="color: #d2c1b6;">9%</div>
                </div>

                <div class="insight-item d-flex align-items-center p-3 rounded-3" style="background: rgba(27, 60, 83, 0.1);">
                    <div class="insight-icon me-3">
                        <i class="bi bi-exclamation-triangle-fill fs-5" style="color: #1b3c53;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold" style="color: #1b3c53;">Rusak</div>
                        <small class="text-muted">Perlu perbaikan segera</small>
                    </div>
                    <div class="fw-bold fs-5" style="color: #1b3c53;">4%</div>
                </div>

                <div class="progress mt-4" style="height: 12px; border-radius: 10px; background: #f9f3ef;">
                    <div class="progress-bar" style="width: 87%; background: #456882;" title="87% Baik"></div>
                    <div class="progress-bar" style="width: 9%; background: #d2c1b6;" title="9% Perlu Servis"></div>
                    <div class="progress-bar" style="width: 4%; background: #1b3c53;" title="4% Rusak"></div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <small style="color: #456882;">Baik</small>
                    <small style="color: #d2c1b6;">Perlu Servis</small>
                    <small style="color: #1b3c53;">Rusak</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Popup WhatsApp --}}
    <div class="wa-popup shadow-lg" id="waPopup">
        <div class="wa-header">
            <img src="https://cdn-icons-png.flaticon.com/512/124/124034.png" alt="Admin" class="wa-avatar me-2">
            <div>
                <strong style="color: #1b3c53;">Admin Inventaris</strong>
                <div class="small" style="color: #456882;">Online - Siap membantu</div>
            </div>
            <i class="bi bi-x-lg ms-auto" style="cursor:pointer; color: #456882;" onclick="toggleWA()"></i>
        </div>
        <div class="wa-body mt-3">
            <p class="small mb-2" style="color: #1b3c53;">Hubungi kami melalui:</p>
            <button class="btn w-100 mb-2" style="background: #456882; color: white;" onclick="openWhatsApp('mobile')">
                <i class="bi bi-whatsapp me-2"></i>WhatsApp Mobile
            </button>
            <button class="btn btn-outline w-100" style="border-color: #456882; color: #456882;" onclick="openWhatsApp('web')">
                <i class="bi bi-laptop me-2"></i>WhatsApp Web
            </button>
        </div>
    </div>

    <div class="wa-btn shadow" onclick="toggleWA()">
        <i class="bi bi-whatsapp fs-4"></i>
    </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('chartAset').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt'],
                datasets: [{
                    label: 'Total Aset',
                    data: [90, 92, 95, 98, 101, 105],
                    borderColor: '#456882',
                    backgroundColor: 'rgba(69, 104, 130, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#456882',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(27, 60, 83, 0.9)',
                        titleFont: {
                            size: 14
                        },
                        bodyFont: {
                            size: 13
                        },
                        padding: 10,
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            color: 'rgba(210, 193, 182, 0.3)'
                        },
                        ticks: {
                            stepSize: 5,
                            color: '#1b3c53'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#1b3c53'
                        }
                    }
                }
            }
        });
    });

    // WhatsApp Functions
    function toggleWA() {
        document.getElementById('waPopup').classList.toggle('show');
    }

    function openWhatsApp(type) {
        const phoneNumber = '6281234567890'; // Ganti dengan nomor WhatsApp admin yang sebenarnya
        const message = 'Halo, saya ingin bertanya tentang sistem inventaris.';
        const encodedMessage = encodeURIComponent(message);

        let url = '';

        if (type === 'mobile') {
            // Untuk membuka WhatsApp Mobile
            url = `https://api.whatsapp.com/send?phone=${phoneNumber}&text=${encodedMessage}`;
        } else {
            // Untuk membuka WhatsApp Web
            url = `https://web.whatsapp.com/send?phone=${phoneNumber}&text=${encodedMessage}`;
        }

        // Tutup popup setelah memilih opsi
        toggleWA();

        // Buka WhatsApp di tab baru
        window.open(url, '_blank');
    }

    // Tutup popup ketika klik di luar area popup
    document.addEventListener('click', function(event) {
        const waPopup = document.getElementById('waPopup');
        const waBtn = document.querySelector('.wa-btn');

        if (!waPopup.contains(event.target) && !waBtn.contains(event.target)) {
            waPopup.classList.remove('show');
        }
    });
</script>

{{-- Style Tambahan --}}
<style>
    :root {
        --primary-dark: #1b3c53;
        --primary-medium: #456882;
        --primary-light: #d2c1b6;
        --background: #f9f3ef;
    }

    .icon-circle {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 1.4rem;
    }

    .hover-shadow {
        transition: all 0.3s ease;
    }

    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(27, 60, 83, 0.1);
    }

    /* Header Section */
    .header-section {
        background: linear-gradient(135deg, #1b3c53 0%, #456882 100%);
        border-radius: 12px;
        padding: 1.5rem 2rem;
        box-shadow: 0 4px 15px rgba(27, 60, 83, 0.3);
    }

    /* Chart Container */
    .chart-container {
        position: relative;
    }

    /* Insight Items */
    .insight-item {
        transition: all 0.3s ease;
    }

    .insight-item:hover {
        transform: translateX(5px);
        box-shadow: 0 2px 8px rgba(27, 60, 83, 0.1);
    }

    /* Popup WA */
    .wa-btn {
        position: fixed;
        bottom: 25px;
        right: 25px;
        background-color: #456882;
        color: white;
        border-radius: 50%;
        width: 55px;
        height: 55px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        z-index: 9998;
        transition: all 0.3s ease;
    }

    .wa-btn:hover {
        background-color: #1b3c53;
        transform: scale(1.08);
    }

    .wa-popup {
        position: fixed;
        bottom: 90px;
        right: 25px;
        width: 320px;
        background: #ffffff;
        border-radius: 12px;
        padding: 18px;
        box-shadow: 0 10px 25px rgba(27, 60, 83, 0.15);
        display: none;
        animation: popIn 0.3s ease;
        z-index: 9999;
        border: 1px solid #d2c1b6;
    }

    .wa-popup.show {
        display: block;
    }

    @keyframes popIn {
        from {
            transform: translateY(20px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .wa-header {
        display: flex;
        align-items: center;
        border-bottom: 1px solid #d2c1b6;
        padding-bottom: 10px;
    }

    .wa-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: 2px solid #456882;
        object-fit: cover;
    }

    /* Table Improvements */
    .table th {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-light {
        background: rgba(210, 193, 182, 0.2) !important;
    }

    /* Button Styles */
    .btn-light {
        background: #ffffff;
        color: #1b3c53;
        border: 1px solid #d2c1b6;
    }

    .btn-light:hover {
        background: #f9f3ef;
        color: #1b3c53;
        border: 1px solid #456882;
    }

    /* Text Colors */
    .text-muted {
        color: #456882 !important;
    }

    /* Card border subtle */
    .card {
        border: 1px solid rgba(210, 193, 182, 0.3);
    }

    /* WhatsApp Button Hover Effects */
    .wa-popup .btn {
        transition: all 0.3s ease;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 500;
    }

    .wa-popup .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(69, 104, 130, 0.3);
    }

    .wa-popup .btn-outline:hover {
        background: #456882;
        color: white;
    }
</style>
@endsection