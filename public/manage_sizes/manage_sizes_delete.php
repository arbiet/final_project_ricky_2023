<?php
session_start();
require_once('../../database/connection.php');
include_once('../components/header.php');

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

// Check if the size ID is provided in the query parameters
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect to an error page or an appropriate location
    header('Location: error.php');
    exit();
}

$sizeID = $_GET['id'];

// Initialize success and error messages
$success_message = '';
$error_message = '';

// Perform deletion of related records from the "logactivity" table
$query = "DELETE FROM LogActivities WHERE SizeID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $sizeID);

if ($stmt->execute()) {
    // Deletion of related records successful
    $stmt->close();

    // Now, proceed with deleting the size
    $query = "DELETE FROM Sizes WHERE SizeID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $sizeID);

    if ($stmt->execute()) {
        // Activity description
        $activityDescription = "Size with SizeID: $sizeID has been deleted.";

        $currentUserID = $_SESSION['UserID'];
        insertLogActivity($conn, $currentUserID, $activityDescription);

        // Size deletion successful
        $stmt->close();
        $success_message = "Size berhasil dihapus!";
    } else {
        // Size deletion failed
        $stmt->close();
        $error_message = "Gagal menghapus size.";
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
        window.location.href = 'manage_sizes_list.php'; // Redirect to the size list page
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
        window.location.href = 'manage_sizes_list.php'; // Redirect to the size list page
    });
    </script>";
}
?>

<div class="h-screen flex flex-col">
</div>