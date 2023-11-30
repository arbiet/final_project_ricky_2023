<?php
session_start();

// Fungsi untuk mengecek apakah pengguna sudah login
function isUserLoggedIn() {
    return isset($_SESSION['UserID']);
}

// Fungsi untuk mengecek apakah pengguna memiliki peran tertentu
function checkUserRole($requiredRole) {
    if (!isUserLoggedIn() || $_SESSION['RoleID'] !== $requiredRole) {
        header("Location: error.php"); // Ganti error.php dengan halaman error yang sesuai
        exit();
    }
}

// Fungsi untuk mengecek apakah data pengguna seperti email, username, dll., tersedia dalam session
function checkUserData() {
    if (!isUserLoggedIn() || empty($_SESSION['Email']) || empty($_SESSION['Username']) || empty($_SESSION['FullName']) || empty($_SESSION['ProfilePictureURL'])) {
        header("Location: error.php"); // Ganti error.php dengan halaman error yang sesuai
        exit();
    }
}

// Fungsi untuk validasi input registrasi
function validateRegistrationInputs($username, $password, $confirm_password, $email, $fullname, &$errors, $conn) {
    // Validate inputs
    if (empty($username) || empty($password) || empty($email) || empty($fullname)) {
        array_push($errors, 'Username, email, password, and fullname are required');
    }

    if (strlen($username) > 20) {
        array_push($errors, 'Username cannot be longer than 20 characters');
    }

    if (strlen($password) < 8) {
        array_push($errors, 'Password must be at least 8 characters long');
    }

    if ($password !== $confirm_password) {
        array_push($errors, 'Password confirmation does not match');
    }

    // Check if the username already exists
    $query = "SELECT * FROM Users WHERE username=? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        array_push($errors, 'Username already exists');
    }

    // Check if the email already exists
    $query = "SELECT * FROM Users WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        array_push($errors, 'Email already exists');
    }
}

// Fungsi untuk mengecek apakah User ID sudah ada dalam database
function isUserIDExists($conn, $user_id) {
    $query = "SELECT * FROM Users WHERE UserID = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    return $user ? true : false;
}
?>
