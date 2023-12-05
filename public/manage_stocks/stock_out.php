<?php
// Include the connection file
require_once('../../database/connection.php');

// Initialize response array
$response = array();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stockOutSizeColor'], $_POST['stockOutQuantity'], $_POST['productId'])) {
    // Retrieve form data
    $productId = $_POST['productId'];
    $sizeColor = $_POST['stockOutSizeColor'];
    list($size, $color) = explode("-", $sizeColor);
    $quantity = $_POST['stockOutQuantity'];

    // Check if there is enough stock
    $checkStockQuery = "SELECT * FROM Stocks WHERE ProductID = $productId AND SizeID = (SELECT SizeID FROM Sizes WHERE SizeName = '$size') AND ColorID = (SELECT ColorID FROM Colors WHERE ColorName = '$color') AND Quantity >= $quantity";
    $checkStockResult = $conn->query($checkStockQuery);

    if ($checkStockResult->num_rows > 0) {
        // Update existing stock
        $updateStockQuery = "UPDATE Stocks SET Quantity = Quantity - $quantity WHERE ProductID = $productId AND SizeID = (SELECT SizeID FROM Sizes WHERE SizeName = '$size') AND ColorID = (SELECT ColorID FROM Colors WHERE ColorName = '$color')";

        if ($conn->query($updateStockQuery)) {
            // Insert data into DailyTransactions for Stock Out
            $insertTransactionQuery = "INSERT INTO DailyTransactions (StockID, Quantity, TransactionType, TransactionDate) VALUES ((SELECT StockID FROM Stocks WHERE ProductID = $productId AND SizeID = (SELECT SizeID FROM Sizes WHERE SizeName = '$size') AND ColorID = (SELECT ColorID FROM Colors WHERE ColorName = '$color')), $quantity, 'Out', NOW())";

            if ($conn->query($insertTransactionQuery)) {
                // Success
                $response['success'] = true;
                $response['message'] = 'Stock successfully updated.';
            } else {
                // Database error for inserting transaction
                $response['success'] = false;
                $response['message'] = 'Database error. Unable to insert transaction.';
            }
        } else {
            // Database error for updating stock
            $response['success'] = false;
            $response['message'] = 'Database error. Unable to update stock.';
        }
    } else {
        // Insufficient stock
        $response['success'] = false;
        $response['message'] = 'Insufficient stock!';
    }

    // Close the database connection
    $conn->close();
} else {
    // Invalid request
    $response['success'] = false;
    $response['message'] = 'Invalid request.';
}

// Return the JSON response
echo json_encode($response);
