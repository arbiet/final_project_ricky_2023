<?php
session_start();
require_once('../../database/connection.php');
include_once('../components/header.php');

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

// Check if the color ID is provided in the query parameters
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect to an error page or an appropriate location
    header('Location: error.php');
    exit();
}

$colorID = $_GET['id'];

// Initialize success and error messages
$success_message = '';
$error_message = '';

// Perform deletion of related records from the "logactivity" table
$query = "DELETE FROM LogActivities WHERE ColorID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $colorID);

if ($stmt->execute()) {
    // Deletion of related records successful
    $stmt->close();

    // Now, proceed with deleting the color
    $query = "DELETE FROM Colors WHERE ColorID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $colorID);

    if ($stmt->execute()) {
        // Activity description
        $activityDescription = "Color with ColorID: $colorID has been deleted.";

        $currentUserID = $_SESSION['UserID'];
        // Assuming you have a function insertLogActivity, call it here
        // insertLogActivity($conn, $currentUserID, $activityDescription);

        // Color deletion successful
        $stmt->close();
        $success_message = "Color berhasil dihapus!";
    } else {
        // Color deletion failed
        $stmt->close();
        $error_message = "Gagal menghapus color.";
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
        window.location.href = 'manage_colors_list.php'; // Redirect to the color list page
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
        window.location.href = 'manage_colors_list.php'; // Redirect to the color list page
    });
    </script>";
}
?>

<div class="h-screen flex flex-col">
</div>