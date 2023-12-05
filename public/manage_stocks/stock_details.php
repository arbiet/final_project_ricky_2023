<?php
// Include the connection file
require_once('../../database/connection.php');

// Check if productId is provided in the URL
if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];

    // Fetch stock details for the specified product excluding rows with 0 quantity
    $stockDetailsQuery = "SELECT sz.SizeName, clr.ColorName, st.Quantity
        FROM Stocks st
        LEFT JOIN Sizes sz ON st.SizeID = sz.SizeID
        LEFT JOIN Colors clr ON st.ColorID = clr.ColorID
        WHERE st.ProductID = $productId AND st.Quantity > 0";

    $stockDetailsResult = $conn->query($stockDetailsQuery);

    if ($stockDetailsResult) {
        $stockDetails = array();

        while ($row = $stockDetailsResult->fetch_assoc()) {
            $stockDetails[] = array(
                'SizeName' => $row['SizeName'],
                'ColorName' => $row['ColorName'],
                'Quantity' => $row['Quantity']
            );
        }

        // Return stock details as JSON
        echo json_encode($stockDetails);
    } else {
        // Handle database error
        echo json_encode(array('error' => 'Database error'));
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle missing productId in the URL
    echo json_encode(array('error' => 'Product ID not provided'));
}
