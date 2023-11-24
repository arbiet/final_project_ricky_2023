<?php
session_start();
require_once('../../database/connection.php');
include_once('../components/header.php');

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

// Check if the brand ID is provided in the query parameters
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect to an error page or an appropriate location
    header('Location: error.php');
    exit();
}

$brandID = $_GET['id'];

// Initialize success and error messages
$success_message = '';
$error_message = '';

// Perform deletion of related records from the "logactivity" table
$query = "DELETE FROM LogActivities WHERE ActivityDescription LIKE ?";
$stmt = $conn->prepare($query);
$brandDescription = "%BrandID: $brandID%";
$stmt->bind_param('s', $brandDescription);

if ($stmt->execute()) {
    // Deletion of related records successful
    $stmt->close();

    // Now, proceed with deleting the brand
    $query = "DELETE FROM Brands WHERE BrandID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $brandID);

    if ($stmt->execute()) {
        // Activity description
        $activityDescription = "Brand with BrandID: $brandID has been deleted.";

        $currentUserID = $_SESSION['UserID'];
        // Assuming you have a function insertLogActivity, call it here
        insertLogActivity($conn, $currentUserID, $activityDescription);

        // Brand deletion successful
        $stmt->close();
        $success_message = "Brand berhasil dihapus!";
    } else {
        // Brand deletion failed
        $stmt->close();
        $error_message = "Gagal menghapus brand.";
    }
} else {
    // Deletion of related records failed
    $stmt->close();
    $error_message = "Gagal menghapus catatan terkait dari logactivity.";
}

// Display success or error message using SweetAlert2
if (!empty($success_message)) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '$success_message',
        showConfirmButton: false,
        timer: 1500
    }).then(function() {
        window.location.href = 'manage_brands_list.php'; // Redirect to the brand list page
    });
    </script>";
} elseif (!empty($error_message)) {
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '$error_message',
        showConfirmButton: false,
        timer: 1500
    }).then(function() {
        window.location.href = 'manage_brands_list.php'; // Redirect to the brand list page
    });
    </script>";
}
?>

<div class="h-screen flex flex-col">
</div>
