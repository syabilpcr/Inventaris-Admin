<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle Sidebar untuk Mobile
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
    }
</script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTables
        $('#asetTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
            },
            "responsive": true
        });

        // Confirm delete
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus data aset ini?')) {
                $(this).closest('form').submit();
            }
        });

        // Auto close alert
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    });
</script>

@stack('scripts')