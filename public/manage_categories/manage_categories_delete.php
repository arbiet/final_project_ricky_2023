<?php
session_start();
require_once('../../database/connection.php');
include_once('../components/header.php');

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

// Check if the category ID is provided in the query parameters
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect to an error page or an appropriate location
    header('Location: error.php');
    exit();
}

$categoryID = $_GET['id'];

// Initialize success and error messages
$success_message = '';
$error_message = '';

// Perform deletion of related records from the "logactivity" table
$query = "DELETE FROM LogActivities WHERE ActivityDescription LIKE ?";
$stmt = $conn->prepare($query);
$categoryDescription = "%CategoryID: $categoryID%";
$stmt->bind_param('s', $categoryDescription);

if ($stmt->execute()) {
    // Deletion of related records successful
    $stmt->close();

    // Now, proceed with deleting the category
    $query = "DELETE FROM Categories WHERE CategoryID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $categoryID);

    if ($stmt->execute()) {
        // Activity description
        $activityDescription = "Category with CategoryID: $categoryID has been deleted.";

        $currentUserID = $_SESSION['UserID'];
        // Assuming you have a function insertLogActivity, call it here
        insertLogActivity($conn, $currentUserID, $activityDescription);

        // Category deletion successful
        $stmt->close();
        $success_message = "Category berhasil dihapus!";
    } else {
        // Category deletion failed
        $stmt->close();
        $error_message = "Gagal menghapus category.";
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
        window.location.href = 'manage_categories_list.php'; // Redirect to the category list page
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
        window.location.href = 'manage_categories_list.php'; // Redirect to the category list page
    });
    </script>";
}
?>

<div class="h-screen flex flex-col">
</div>
