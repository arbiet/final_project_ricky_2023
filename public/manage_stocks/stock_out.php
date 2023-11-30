<?php
// Include the connection file
require_once('../../database/connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stockOutSize'], $_POST['stockOutColor'], $_POST['stockOutQuantity'], $_POST['productId'])) {
    // Retrieve form data
    $productId = $_POST['productId'];
    $sizeId = $_POST['stockOutSize'];
    $colorId = $_POST['stockOutColor'];
    $quantity = $_POST['stockOutQuantity'];

    // Check if there is enough stock
    $checkStockQuery = "SELECT * FROM Stocks WHERE ProductID = $productId AND SizeID = $sizeId AND ColorID = $colorId AND Quantity >= $quantity";
    $checkStockResult = $conn->query($checkStockQuery);

    if ($checkStockResult->num_rows > 0) {
        // Update existing stock
        $updateStockQuery = "UPDATE Stocks SET Quantity = Quantity - $quantity WHERE ProductID = $productId AND SizeID = $sizeId AND ColorID = $colorId";
        $conn->query($updateStockQuery);
    } else {
        // Handle insufficient stock (you can customize this part as needed)
        echo "Insufficient stock!";
    }

    // Close the database connection
    $conn->close();
}
?>
