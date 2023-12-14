<?php
// Include the connection file
require_once('../../database/connection.php');
// Initialize response array
$response = array();
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stockInSize'], $_POST['stockInColor'], $_POST['stockInQuantity'], $_POST['productId'], $_POST['stockInDate'])) {
    // Retrieve form data
    $productId = $_POST['productId'];
    $sizeId = $_POST['stockInSize'];
    $colorId = $_POST['stockInColor'];
    $quantity = $_POST['stockInQuantity'];
    $transactionDate = $_POST['stockInDate'];

    // Check if the stock already exists
    $checkStockQuery = "SELECT * FROM Stocks WHERE ProductID = ? AND SizeID = ? AND ColorID = ?";
    $checkStockStmt = $conn->prepare($checkStockQuery);
    $checkStockStmt->bind_param("iii", $productId, $sizeId, $colorId);
    $checkStockStmt->execute();
    $checkStockResult = $checkStockStmt->get_result();

    if ($checkStockResult->num_rows > 0) {
        // Update existing stock
        $updateStockQuery = "UPDATE Stocks SET Quantity = Quantity + ? WHERE ProductID = ? AND SizeID = ? AND ColorID = ?";
        $updateStockStmt = $conn->prepare($updateStockQuery);
        $updateStockStmt->bind_param("iiii", $quantity, $productId, $sizeId, $colorId);

        if ($updateStockStmt->execute()) {
            // Get the ID of the existing stock
            $existingStockID = $checkStockResult->fetch_assoc()['StockID'];

            // Insert data into DailyTransactions for Stock In
            $insertTransactionQuery = "INSERT INTO DailyTransactions (StockID, Quantity, TransactionType, TransactionDate) VALUES (?, ?, 'In', ?)";
            $insertTransactionStmt = $conn->prepare($insertTransactionQuery);
            $insertTransactionStmt->bind_param("iis", $existingStockID, $quantity, $transactionDate);

            if ($insertTransactionStmt->execute()) {
                // Success
                $response['success'] = true;
                $response['message'] = 'Stock successfully updated for Stock In.';
                $response['stockID'] = $existingStockID; // Include stockID in the response
            } else {
                // Database error for inserting transaction
                $response['success'] = false;
                $response['message'] = 'Database error. Unable to insert transaction for Stock In.';
            }
        } else {
            // Handle update stock failure
        }
    } else {
        // Insert new stock
        $insertStockQuery = "INSERT INTO Stocks (ProductID, SizeID, ColorID, Quantity) VALUES (?, ?, ?, ?)";
        $insertStockStmt = $conn->prepare($insertStockQuery);
        $insertStockStmt->bind_param("iiii", $productId, $sizeId, $colorId, $quantity);

        if ($insertStockStmt->execute()) {
            // Get the ID of the newly inserted stock
            $stockID = $insertStockStmt->insert_id;

            // Insert data into DailyTransactions for Stock In
            $insertTransactionQuery = "INSERT INTO DailyTransactions (StockID, Quantity, TransactionType, TransactionDate) VALUES (?, ?, 'In', ?)";
            $insertTransactionStmt = $conn->prepare($insertTransactionQuery);
            $insertTransactionStmt->bind_param("iis", $stockID, $quantity, $transactionDate);

            if ($insertTransactionStmt->execute()) {
                // Success
                $response['success'] = true;
                $response['message'] = 'Stock created successfully for Stock In.';
            } else {
                // Database error for inserting transaction
                $response['success'] = false;
                $response['message'] = 'Database error. Unable to insert transaction for Stock In.';
            }
        } else {
            // Handle insert new stock failure
        }
    }

    // Close the prepared statements
    $checkStockStmt->close();
    $updateStockStmt->close();
    $insertStockStmt->close();
    $insertTransactionStmt->close();
}

// Return the JSON response
?>
