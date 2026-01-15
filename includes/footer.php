<?php
// includes/footer.php
?>
<footer class="footer bg-dark text-white text-center py-3 mt-5">
    <div class="container-fluid">
        <p class="mb-0">&copy; Copyright by Nazwa Khoerunnisa (23552011093) - TIF RP 23 CNS C</p>
    </div>
</footer>

    <!-- Bootstrap 5 JS Bundle (sudah include Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto dismiss alerts after 4 seconds
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 4000);
        
        // Confirm delete
        document.querySelectorAll('a[href*="delete"]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                if (!confirm('Yakin ingin menghapus data ini?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>