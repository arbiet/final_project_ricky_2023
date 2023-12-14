<?php
// Include the connection file
require_once('../../database/connection.php');

// Check if product_id is set in the query parameters
if (isset($_GET['product_id'])) {
    $productId = mysqli_real_escape_string($conn, $_GET['product_id']);

    // Query to fetch product information including the image file name
    $selectQuery = "SELECT ProductImage FROM Products WHERE ProductID = $productId";
    $selectResult = mysqli_query($conn, $selectQuery);

    if ($selectResult) {
        $productData = mysqli_fetch_assoc($selectResult);
        $productImage = $productData['ProductImage'];

        // Query to delete the product
        $deleteQuery = "DELETE FROM Products WHERE ProductID = $productId";

        // Perform the deletion
        if (mysqli_query($conn, $deleteQuery)) {
            // Deletion successful, delete the product image file
            $imagePath = '../static/image/products/' . $productImage;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Redirect to the product list page
            header("Location: products_list.php");
            exit();
        } else {
            // Deletion failed, handle the error (you might want to show an error message)
            echo "Error deleting product: " . mysqli_error($conn);
            exit();
        }
    } else {
        // Error fetching product information, handle the error
        echo "Error fetching product information: " . mysqli_error($conn);
        exit();
    }
} else {
    // Redirect to the product list page if product_id is not set
    header("Location: products_list.php");
    exit();
}
?>
