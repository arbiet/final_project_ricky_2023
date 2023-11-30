<?php
// Include the connection file
require_once('../../database/connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stockInSize'], $_POST['stockInColor'], $_POST['stockInQuantity'], $_POST['productId'])) {
    // Retrieve form data
    $productId = $_POST['productId'];
    $sizeId = $_POST['stockInSize'];
    $colorId = $_POST['stockInColor'];
    $quantity = $_POST['stockInQuantity'];

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
            // Insert data into DailyTransactions for Stock In
            $insertTransactionQuery = "INSERT INTO DailyTransactions (StockID, Quantity, TransactionType, TransactionDate) VALUES (?, ?, 'In', NOW())";
            $insertTransactionStmt = $conn->prepare($insertTransactionQuery);
            $insertTransactionStmt->bind_param("ii", $stockID, $quantity);
            $insertTransactionStmt->execute();
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
            $insertTransactionQuery = "INSERT INTO DailyTransactions (StockID, Quantity, TransactionType, TransactionDate) VALUES (?, ?, 'In', NOW())";
            $insertTransactionStmt = $conn->prepare($insertTransactionQuery);
            $insertTransactionStmt->bind_param("ii", $stockID, $quantity);
            $insertTransactionStmt->execute();
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

// Close the database connection
$conn->close();
?>
