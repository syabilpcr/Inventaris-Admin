 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <!-- Font Awesome -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
 <!-- DataTables -->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
 <!-- Custom CSS -->
 <style>
     .sidebar-menu>li>a.active {
         background-color: #007bff;
         color: white !important;
     }

     .table-actions {
         white-space: nowrap;
     }

     .table-actions .btn {
         margin: 0 2px;
     }

     .img-thumbnail {
         object-fit: cover;
     }

     .main-sidebar {
         background-color: #343a40;
     }

     .brand-link {
         border-bottom: 1px solid #4b545c;
     }
 </style>


 <link type="text/css" href="{{ asset('assets-admin/css/volt.css') }}" rel="stylesheet">
 <style>
     body {
         font-family: 'Poppins', sans-serif;
         background-color: #f8f9fa;
         margin: 0;
         display: flex;
         flex-direction: column;
         min-height: 100vh;
     }

     .sidebar {
         width: 240px;
         background: linear-gradient(180deg, #1b3c53, #456882);
         color: white;
         height: 100vh;
         position: fixed;
         top: 0;
         left: 0;
         padding-top: 20px;
         display: flex;
         flex-direction: column;
         justify-content: space-between;
         transition: all 0.3s ease;
         z-index: 1000;
     }

     .sidebar-header {
         font-size: 1.3rem;
         font-weight: 600;
         text-align: center;
         margin-bottom: 20px;
     }

     .nav-link {
         color: #cfd8dc;
         padding: 12px 20px;
         transition: all 0.3s ease;
     }

     .nav-link:hover,
     .nav-link.active {
         background-color: rgba(255, 255, 255, 0.15);
         color: #fff;
         padding-left: 25px;
     }

     .nav-link i {
         margin-right: 8px;
     }

     .logout-section {
         text-align: center;
         padding: 15px;
         border-top: 1px solid rgba(255, 255, 255, 0.1);
     }

     .logout-btn {
         background-color: #dc3545;
         border: none;
         color: #fff;
         font-weight: 500;
         border-radius: 8px;
         padding: 8px 15px;
         transition: background 0.3s ease;
     }

     .logout-btn:hover {
         background-color: #bb2d3b;
     }

     .main-content {
         margin-left: 240px;
         flex: 1;
         padding: 25px;
         transition: all 0.3s ease;
     }

     .fade-in {
         animation: fadeIn 0.5s ease-in-out;
     }

     @keyframes fadeIn {
         from {
             opacity: 0;
             transform: translateY(10px);
         }

         to {
             opacity: 1;
             transform: translateY(0);
         }
     }

     footer {
         background: #ffffff;
         border-top: 1px solid #e9ecef;
         text-align: center;
         padding: 12px 0;
         color: #6c757d;
         font-size: 14px;
         box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.03);
     }

     @media (max-width: 992px) {
         .sidebar {
             transform: translateX(-100%);
         }

         .sidebar.show {
             transform: translateX(0);
         }

         .main-content {
             margin-left: 0;
         }
     }


     body {
         font-family: 'Poppins', sans-serif;
         background-color: #f8f9fa;
         margin: 0;
         padding: 0;
         display: flex;
         min-height: 100vh;
         overflow-x: hidden;
     }

     /* Sidebar agar fix di kiri */
     .sidebar {
         width: 250px;
         background-color: #343a40;
         color: #fff;
         min-height: 100vh;
         position: fixed;
         top: 0;
         left: 0;
         padding-top: 20px;
         transition: all 0.3s ease;
     }

     .main-content {
         margin-left: 250px;
         width: calc(100% - 250px);
         padding: 20px;
         transition: all 0.3s ease;
     }

     /* Animasi fade-in */
     .fade-in {
         animation: fadeIn 0.4s ease-in;
     }

     @keyframes fadeIn {
         from {
             opacity: 0;
             transform: translateY(5px);
         }

         to {
             opacity: 1;
             transform: translateY(0);
         }
     }

     /* Responsif */
     @media (max-width: 992px) {
         .sidebar {
             width: 100%;
             position: relative;
         }

         .main-content {
             margin-left: 0;
             width: 100%;
         }
     }

     .main-panel {
         display: flex;
         flex-direction: column;
         min-height: 100vh;
         /* Mengisi seluruh layar */
         margin-left: 250px;
         /* Sesuaikan dengan lebar sidebar Anda */
     }

     .content-wrapper {
         flex: 1;
         /* Ini akan mengambil sisa ruang yang ada */
         padding: 25px;
         /* Kurangi padding-bottom agar footer bisa lebih naik */
         padding-bottom: 20px;
     }


.wa-floating-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            /* Z-index harus sangat tinggi (di atas modal bootstrap yang biasanya 1050) */
            z-index: 999999 !important; 
            display: block;
        }

        .wa-btn {
            width: 60px;
            height: 60px;
            background-color: #25d366;
            color: white !important;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
        }

        .wa-btn:hover {
            transform: scale(1.1);
            background-color: #128c7e;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.4);
        }

        /* Animasi berdenyut agar terlihat jelas */
        @keyframes wa-pulse {
            0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
        }
        .wa-btn {
            animation: wa-pulse 2s infinite;
        }

        /* Penyesuaian untuk Mobile / APK */
        @media screen and (max-width: 768px) {
            .wa-floating-container {
                bottom: 20px;
                right: 20px;
            }
            .wa-btn {
                width: 50px;
                height: 50px;
                font-size: 28px;
            }
        }

     


        :root {
        --sidebar-bg: #335c67;      /* Biru Gelap sesuai foto */
        --sidebar-hover: #3d6a76;   /* Sedikit lebih terang untuk hover */
        --nav-text: rgba(255, 255, 255, 0.8);
        --active-color: #456882;    /* Warna highlight saat menu aktif */
        --logout-red: #ef4444;      /* Merah Logout */
    }

    #sidebar {
        width: 260px;
        height: 100vh;
        background-color: var(--sidebar-bg);
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1000;
        color: white;
        transition: all 0.3s;
    }

    /* Header Logo */
    .sidebar-header-custom {
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 1.2rem;
        font-weight: 700;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    /* User Profile Card */
    .user-profile-section {
        padding: 20px;
    }

    .profile-box {
        background: rgba(255, 255, 255, 0.1);
        padding: 12px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .avatar-area img {
        width: 40px;
        height: 40px;
        border-radius: 50%; /* Bulat sesuai foto */
        border: 2px solid rgba(255,255,255,0.2);
    }

    .user-meta h6 {
        margin: 0;
        font-size: 0.85rem;
        font-weight: 600;
        color: white;
    }

    .user-meta small {
        font-size: 0.7rem;
        color: rgba(255,255,255,0.6);
        display: block;
    }

    /* Navigation Items */
    .sidebar-nav {
        flex-grow: 1;
        padding: 10px 15px;
    }

    .nav-item {
        display: flex;
        align-items: center;
        padding: 12px 18px;
        color: var(--nav-text);
        text-decoration: none;
        border-radius: 12px;
        margin-bottom: 5px;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .nav-item i {
        font-size: 1.1rem;
        margin-right: 12px;
    }

    .nav-item:hover {
        background: var(--sidebar-hover);
        color: white;
        transform: translateX(5px);
    }

    .nav-item.active {
        background: var(--active-color);
        color: white;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    /* Logout Section */
    .sidebar-footer {
        padding: 20px;
        border-top: 1px solid rgba(255,255,255,0.05);
    }

    .btn-logout-custom {
        width: 100%;
        background-color: var(--logout-red);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: 0.3s;
    }

    .btn-logout-custom:hover {
        background-color: #dc2626;
        box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4);
    }

    /* Penyesuaian Main Content agar tidak tertutup sidebar */
    .main-content {
        margin-left: 260px;
        background-color: #fbf8f3; /* Warna Broken White/Cream sesuai foto */
        padding: 30px;
        min-height: 100vh;
    }
 </style>