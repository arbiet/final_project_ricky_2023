<?php
// get file connection.php
require_once('../../database/connection.php');

// Include auth.php
require_once('auth.php');
// Initialize the session
// session_start();

// Jika pengguna sudah login, redirect ke dashboard
if (isset($_SESSION['UserID'])) {
    header('Location: systems/dashboard.php');
    exit();
}
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

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="max-w-md mx-auto bg-white p-8 border rounded shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Error</h2>

        <p class="text-gray-600 mb-4">
            Oops! Something went wrong. Please go back and try again.
        </p>

        <a href="javascript:history.back()" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">
            Go Back
        </a>
    </div>
</body>

</html>
