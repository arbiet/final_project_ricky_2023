<?php
session_start();
require_once('../../database/connection.php');
include_once('../components/header.php');

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

// Check if the product ID is provided in the query parameters
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect to an error page or a suitable location
    header('Location: error.php');
    exit();
}

$product_id = $_GET['id'];

// Initialize success and error messages
$success_message = '';
$error_message = '';

// Delete the associated image file
$query = "SELECT ProductImage FROM Products WHERE ProductID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $product_id);
$stmt->execute();
$stmt->store_result();

// Check if the product exists
if ($stmt->num_rows > 0) {
    $stmt->bind_result($product_image);
    $stmt->fetch();

    // Check if the product image exists and delete it
    if (!empty($product_image) && file_exists('../static/image/products/' . $product_image)) {
        unlink('../static/image/products/' . $product_image);
    }
}

$stmt->close();

// Delete related stock records
$query = "DELETE FROM Stocks WHERE ProductID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $product_id);

if ($stmt->execute()) {
    // Successfully deleted related stock records, now proceed to delete the product
    $stmt->close();

    $query = "DELETE FROM Products WHERE ProductID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $product_id);

    if ($stmt->execute()) {
        // Successfully deleted the product
        $stmt->close();

        // Log activity description
        $activityDescription = "Product with ProductID: $product_id has been deleted.";

        $currentUserID = $_SESSION['UserID'];
        insertLogActivity($conn, $currentUserID, $activityDescription);

        $success_message = "Product deleted successfully!";
    } else {
        // Failed to delete the product
        $stmt->close();
        $error_message = "Failed to delete the product.";
    }
} else {
    // Failed to delete related stock records
    $stmt->close();
    $error_message = "Failed to delete related stock records.";
}

// Display success or error message using SweetAlert2
if (!empty($success_message)) {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '$success_message',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location.href = 'manage_products_list.php'; // Redirect to the product list page
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
            window.location.href = 'manage_products_list.php'; // Redirect to the product list page
        });
    </script>";
}
?>
<div class="h-screen flex flex-col">
    <!-- Content, if any, can be added here -->
</div>
