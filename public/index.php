<?php
// get file connection.php
require_once('../database/connection.php');

// Include auth.php
require_once('systems/auth.php');
// Initialize the session
// session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $baseTitle; ?></title>
    <!-- Tailwind CSS -->
    <link rel="icon" href="<?php echo $baseUrl; ?>/static/logo.ico" type="image/png">
    <link rel="shortcut icon" href="<?php echo $baseUrl; ?>/static/logo.ico" type="image/png">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>dist/output.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>node_modules/@fortawesome/fontawesome-free/css/all.min.css" />
    <!-- SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>

</head>

<body class="overflow-hidden">
    
    <div class="h-screen flex flex-col">
        <!-- Top Navbar -->
        <nav class="flex items-center justify-between flex-wrap bg-sky-800 p-6">
            <div class="flex items-center flex-shrink-0 text-white mr-6 ">
                <a href="<?php echo $baseUrl; ?>public/index.php" class="flex items-center space-x-2">
                    <img src="<?php echo $baseLogoUrl; ?>" alt="Logo" class="w-12" /> <!-- Tambahkan kelas w-40 di sini -->
                    <span class="font-semibold text-xl tracking-tight"><?php echo $baseTitle; ?></span>
                </a>
            </div>
            <div class="block lg:hidden">
                <i class="fas fa-bars text-white"></i>
            </div>
            <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
                <div class="text-sm lg:flex-grow">
                </div>
                <div>
                    <?php
                    if (isset($_SESSION['UserID'])) {
                        // Jika pengguna sudah login, tampilkan tombol Logout
                        echo '<a href="javascript:void(0);" onclick="confirmLogout()" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-sky-500 hover:bg-white mt-4 lg:mt-0">Logout</a>';
                    } else {
                        // Jika pengguna belum login, tampilkan tombol Login
                        echo '<a href="' . $baseUrl . 'public/systems/login.php" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-sky-500 hover:bg-white mt-4 lg:mt-0">Login</a>';
                    }
                    ?>
                </div>
            </div>
        </nav>
        <!-- End Top Navbar -->
        <!-- Main Content -->
        <main class="flex-grow bg-sky-50">
            <div class=" flex justify-center items-center h-full">
                <div class="text-center px-40">
                    <a href="<?php echo $baseUrl; ?>public/index.php" class="flex justify-center items-center space-x-2">
                        <img src="<?php echo $baseLogoUrl; ?>" alt="Logo" class="w-40" />
                    </a>
                    <p class="text-gray-500 mb-10 text-xl"><?php echo $baseDescription; ?></p>
                    <a href="<?php echo $baseUrl; ?>public/systems/login.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full">
                        Get Started
                    </a>
                </div>
            </div>
        </main>
        <!-- Footer -->
        <footer class="bg-sky-800 text-sky-400 py-4">
            <div class="container mx-auto text-center text-sm">
                <p>&copy; 2023 <?php echo $baseTitle; ?>. All rights reserved.</p>
            </div>
        </footer>
        <!-- End Footer -->
    </div>
    <!-- End Main Content -->
</body>
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
                        window.location.href = 'systems/logout.php';
                    }
                });
            }
        </script>
</html>