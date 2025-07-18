</main>
    <footer class="container text-center mt-4 py-3 bg-light">
        <p>
            &copy; <?= date('Y'); ?> COSC 4806 - Utkarsh Patel (239556350)
        </p>
        <nav class="nav justify-content-center">
            <a class="nav-link" href="/home">Home</a> |
            <a class="nav-link" href="/reminders">Reminders</a> |
            <a class="nav-link" href="/about">About Us</a> |
            <a class="nav-link" href="/login">Login</a> |
            <a class="nav-link" href="/create">Create Account</a>
        </nav>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check for a session message (success, error, etc.)
            <?php if (isset($_SESSION['toast_message'])): ?>
                const toastMessage = "<?= htmlspecialchars($_SESSION['toast_message']); ?>";
                const toastType = "<?= htmlspecialchars($_SESSION['toast_type'] ?? 'info'); ?>"; // success, danger, warning, info
                let iconSymbol;
                let toastBgClass;

                switch(toastType) {
                    case 'success':
                        iconSymbol = '#check-circle-fill';
                        toastBgClass = 'text-white bg-success';
                        break;
                    case 'danger':
                        iconSymbol = '#exclamation-triangle-fill';
                        toastBgClass = 'text-white bg-danger';
                        break;
                    case 'warning':
                        iconSymbol = '#exclamation-triangle-fill';
                        toastBgClass = 'text-white bg-warning';
                        break;
                    case 'info':
                    default:
                        iconSymbol = '#info-fill';
                        toastBgClass = 'text-white bg-primary';
                        break;
                }

                const toastHtml = `
                    <div class="toast align-items-center ${toastBgClass} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body d-flex align-items-center">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="${toastType}:"><use xlink:href="${iconSymbol}"/></svg>
                                <div>${toastMessage}</div>
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                `;

                const toastContainer = document.querySelector('.toast-container');
                if (toastContainer) {
                    toastContainer.insertAdjacentHTML('beforeend', toastHtml);
                    const newToastEl = toastContainer.lastElementChild;
                    const toast = new bootstrap.Toast(newToastEl);
                    toast.show();
                }
                <?php
                // Clear the session toast message after displaying
                unset($_SESSION['toast_message']);
                unset($_SESSION['toast_type']);
                ?>
            <?php endif; ?>
        });
    </script>
</body>
</html>