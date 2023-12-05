        <footer class="bg-sky-800 text-white py-4 shadow-md mt-auto sticky bottom-0 border-t border-sky-700">
            <div class="container mx-auto text-center text-sm">
                <p>&copy; 2023 <?php echo $baseTitle; ?>. All rights reserved.</p>
            </div>
        </footer>

        <script>
            function confirmLogout() {
                Swal.fire({
                    title: 'Apakah Anda yakin ingin logout?',
                    text: 'Anda akan keluar dari sesi ini.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Logout!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to the logout page or trigger your logout logic here
                        window.location.href = '../systems/logout.php';
                    }
                });
            }
        </script>