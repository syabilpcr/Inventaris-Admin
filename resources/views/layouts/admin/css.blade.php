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
 </style>