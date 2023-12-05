<?php
// Initialize the session
session_start();

// Include the connection file
require_once('../../database/connection.php');

// Check if a product ID is provided in the query parameters
if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];

    // Fetch product information
    $productQuery = "SELECT p.ProductID, p.ProductName, p.ProductImage, p.Description, p.Price, c.CategoryName, b.BrandName
                    FROM Products p
                    LEFT JOIN Categories c ON p.CategoryID = c.CategoryID
                    LEFT JOIN Brands b ON p.BrandID = b.BrandID
                    WHERE p.ProductID = $productId";
    $productResult = $conn->query($productQuery);
    $product = $productResult->fetch_assoc();

    $transactionQuery = "SELECT t.TransactionID, t.StockID, t.Quantity, t.TransactionType, t.TransactionDate,
                            sz.SizeName, c.ColorName
                     FROM DailyTransactions t
                     JOIN Stocks s ON t.StockID = s.StockID
                     JOIN Sizes sz ON s.SizeID = sz.SizeID
                     JOIN Colors c ON s.ColorID = c.ColorID
                     WHERE s.ProductID = $productId
                     ORDER BY t.TransactionDate DESC";
    $transactionResult = $conn->query($transactionQuery);
}

?>
<?php include_once('../components/header.php'); ?>

<div class="h-screen flex flex-col">
    <!-- Top Navbar -->
    <?php include('../components/navbar.php'); ?>
    <!-- End Top Navbar -->
    <!-- Main Content -->
    <div class="flex-grow bg-gray-50 flex flex-row shadow-md">
        <!-- Sidebar -->
        <?php include('../components/sidebar.php'); ?>
        <!-- End Sidebar -->

        <!-- Main Content -->
        <main class="bg-gray-50 flex flex-col flex-1 overflow-y-scroll h-screen flex-shrink-0 sc-hide pb-40">
            <div class="flex items-start justify-start p-6 shadow-md m-4 flex-1 flex-col">
                <!-- Header Content -->
                <div class="flex flex-row justify-between items-center w-full border-b-2 border-gray-600 mb-2 pb-2">
                    <h1 class="text-3xl text-gray-800 font-semibold">Stock Transactions for <?php echo $product['ProductName']; ?></h1>
                    <div class="flex flex-row justify-end items-center">
                        <a href="manage_stocks_list.php" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center space-x-2">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
                <!-- End Header Content -->
                <!-- Content -->
                <div class="flex flex-col w-full">
                    <!-- Display Product Information -->
                    <div class="bg-white p-4 shadow-md rounded-md mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Product Information</h2>
                        <p class="text-gray-600">Product ID: <?php echo $product['ProductID']; ?></p>
                        <p class="text-gray-600">Product Name: <?php echo $product['ProductName']; ?></p>
                        <p class="text-gray-600">Description: <?php echo $product['Description']; ?></p>
                        <p class="text-gray-600">Price: $<?php echo $product['Price']; ?></p>
                        <p class="text-gray-600">Category: <?php echo $product['CategoryName']; ?></p>
                        <p class="text-gray-600">Brand: <?php echo $product['BrandName']; ?></p>
                    </div>
                    <!-- Display Transactions in a Table -->
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="py-2 px-4 border-b">Transaction ID</th>
                                <th class="py-2 px-4 border-b">Quantity</th>
                                <th class="py-2 px-4 border-b">Size</th>
                                <th class="py-2 px-4 border-b">Color</th>
                                <th class="py-2 px-4 border-b">Transaction Type</th>
                                <th class="py-2 px-4 border-b">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($transaction = $transactionResult->fetch_assoc()) {
                                $iconClass = ($transaction['TransactionType'] == 'In') ? 'fas fa-arrow-up text-green-500' : 'fas fa-arrow-down text-red-500';
                            ?>
                                <tr class="bg-white">
                                    <td class="py-2 px-4 border-b"><?php echo $transaction['TransactionID']; ?></td>
                                    <td class="py-2 px-4 border-b"><?php echo $transaction['Quantity']; ?></td>
                                    <td class="py-2 px-4 border-b"><?php echo $transaction['SizeName']; ?></td>
                                    <td class="py-2 px-4 border-b"><?php echo $transaction['ColorName']; ?></td>
                                    <td class="py-2 px-4 border-b">
                                        <i class="<?php echo $iconClass; ?> text-xl"></i>
                                        <?php echo ($transaction['TransactionType'] == 'In') ? 'Stock In' : 'Stock Out'; ?>
                                    </td>
                                    <td class="py-2 px-4 border-b"><?php echo $transaction['TransactionDate']; ?></td>
                                </tr>
                            <?php
                            }
                            if ($transactionResult->num_rows === 0) {
                            ?>
                                <tr class="bg-white">
                                    <td class="py-2 px-4 border-b" colspan="6">No transactions found for this product.</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- End Display Transactions in a Table -->
                </div>
                <!-- End Content -->
            </div>
        </main>
        <!-- End Main Content -->
    </div>
    <!-- End Main Content -->
    <!-- Footer -->
    <?php include('../components/footer.php'); ?>
    <!-- End Footer -->
</div>
<!-- End Main Content -->
</body>

</html>