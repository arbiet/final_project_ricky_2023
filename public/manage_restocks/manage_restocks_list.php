<?php
// Initialize the session
session_start();

// Include the connection file
require_once('../../database/connection.php');

// Initialize variables
$productName = '';
$errors = array();

$allProductStock=[];

// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Query to get the last transaction date for each product before the current month
$query = "SELECT p.*, MAX(dt.TransactionDate) AS LastTransactionDate
          FROM Products p
          LEFT JOIN Stocks s ON p.ProductID = s.ProductID
          LEFT JOIN DailyTransactions dt ON s.StockID = dt.StockID
        --   WHERE dt.TransactionDate < LAST_DAY(NOW() + INTERVAL 1 DAY) - INTERVAL 1 MONTH
          GROUP BY p.ProductID
          ORDER BY LastTransactionDate DESC";

$result = $conn->query($query);

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
                    <h1 class="text-3xl text-gray-800 font-semibol">Restock List</h1>
                    <div class="flex flex-row justify-end items-center">
                        <a href="<?php echo $baseUrl; ?>public/manage_restocks/manage_restocks_analytics.php" class="bg-green-500 hover-bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                            <i class="fas fa-magnifying-glass-chart mr-2"></i>
                            <span>Restock Analytics</span>
                        </a>
                    </div>
                </div>
                <!-- End Header Content -->
                <!-- Content -->
                <div class="flex flex-col w-full">
                    <!-- Product List -->
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $productId = $row['ProductID'];
                            $brandId = $row['BrandID'];

                            // Get all stocks for the current product
                            $allStocksQuery = "SELECT s.SizeID, sz.SizeName, s.ColorID, c.ColorName, s.Quantity, s.StockID, s.ProductID, p.Price
                                                FROM Stocks s
                                                INNER JOIN Sizes sz ON s.SizeID = sz.SizeID
                                                INNER JOIN Colors c ON s.ColorID = c.ColorID
                                                INNER JOIN Products p ON s.ProductID = p.ProductID
                                                WHERE s.ProductID = $productId
                                                ORDER BY sz.SizeName, c.ColorName";

                            $allStocksResult = $conn->query($allStocksQuery);

                            // Display product details
                            ?>
                            <div class="flex items-center justify-between py-2 border-b">
                                <div class="flex items-center">
                                    <img src="../static/image/products/<?php echo $row['ProductImage']; ?>" alt="<?php echo $row['ProductName']; ?>" class="w-12 h-12 object-cover rounded-full">
                                    <div class="ml-4">
                                        <h2 class="text-lg font-semibold"><?php echo $row['ProductName']; ?></h2>
                                        <p class="text-gray-600">Last Transaction Date: <?php echo $row['LastTransactionDate']; ?></p>
                                        <?php

                                        // Array to store stock data
                                        $stockDataArray = [];

                                        // Fetch data for each stock
                                        if ($allStocksResult->num_rows > 0) {
                                            while ($stockData = $allStocksResult->fetch_assoc()) {
                                                $stockDataRow = [
                                                    'ProductID' => $stockData['ProductID'],
                                                    'Price' => $stockData['Price'],
                                                    'StockID' => $stockData['StockID'],
                                                    'SizeName' => $stockData['SizeName'],
                                                    'ColorID' => $stockData['ColorID'],
                                                    'SizeID' => $stockData['SizeID'],
                                                    'BrandID' => $brandId,
                                                    'ColorName' => $stockData['ColorName'],
                                                    'Quantity' => $stockData['Quantity'],
                                                    'transactions' => []
                                                ];

                                                // Fetch total stock in and stock out transactions per month
                                                $currentDate = date('Y-m-d');
                                                $twelveMonthsAgo = date('Y-m-d', strtotime('-12 months', strtotime($currentDate)));

                                                $query = "SELECT 
                                                            MONTH(`TransactionDate`) AS Month,
                                                            SUM(CASE WHEN `TransactionType` = 'In' THEN `Quantity` ELSE 0 END) AS TotalStockIn,
                                                            SUM(CASE WHEN `TransactionType` = 'Out' THEN `Quantity` ELSE 0 END) AS TotalStockOut
                                                        FROM `DailyTransactions` 
                                                        WHERE `StockID` = {$stockData['StockID']} 
                                                            AND `TransactionDate` BETWEEN '{$twelveMonthsAgo}' AND '{$currentDate}'
                                                        GROUP BY MONTH(`TransactionDate`)
                                                        ORDER BY MONTH(`TransactionDate`)";

                                                $transactionsResult = $conn->query($query);

                                                if ($transactionsResult->num_rows > 0) {
                                                    while ($transaction = $transactionsResult->fetch_assoc()) {
                                                        $stockDataRow['transactions'][] = [
                                                            'Month' => date('F', mktime(0, 0, 0, $transaction['Month'], 1)),
                                                            'TotalStockIn' => $transaction['TotalStockIn'],
                                                            'TotalStockOut' => $transaction['TotalStockOut'],
                                                            'Price' => $stockData['Price'],
                                                            'TotalOut' => $stockData['Price'] * $transaction['TotalStockOut'],
                                                        ];
                                                    }
                                                }

                                                $stockDataArray[] = $stockDataRow;
                                            }
                                        }
                                        if (!empty($stockDataArray)) {
                                            $index = NULL;
                                            foreach ($stockDataArray as $stockDataRow) {
                                                
                                                ?>
                                                <p class="text-gray-600">Last Stock Quantity:
                                                    ProductID: <?php echo $stockDataRow['ProductID']; ?>,
                                                    Size: <?php echo $stockDataRow['SizeName']; ?>,
                                                    Color: <?php echo $stockDataRow['ColorName']; ?>,
                                                    Quantity: <?php echo $stockDataRow['Quantity']; ?>
                                                </p>

                                                <!-- Display stock in stock out for the last twelve months -->
                                                <div class="overflow-x-auto">
                                                    <table class="min-w-full border border-gray-300 divide-y divide-gray-300">
                                                        <thead class="bg-gray-200">
                                                            <tr>
                                                                <th class="px-4 py-2">Month</th>
                                                                <th class="px-4 py-2">Stock In</th>
                                                                <th class="px-4 py-2">Stock Out</th>
                                                                <th class="px-4 py-2">Remaining Stock</th>
                                                                <th class="px-4 py-2">Restock</th> 
                                                                <th class="px-4 py-2">Total Penjualan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $transactionsCount = count($stockDataRow['transactions']);
                                                            $totalPenjualan = 0;
                                                            for ($i = 0; $i < $transactionsCount; $i++) {
                                                                $transaction = $stockDataRow['transactions'][$i];
                                                                $remainingStock = $transaction['TotalStockIn'] - $transaction['TotalStockOut'];
                                                                $restock = $remainingStock < 6 ? 'True' : 'False'; // Determine Restock valu
                                                                $totalPenjualan += $transaction['TotalOut'];
                                                                ?>
                                                                <tr>
                                                                    <td class="px-4 py-2"><?php echo $transaction['Month']; ?></td>
                                                                    <td class="px-4 py-2"><?php echo $transaction['TotalStockIn']; ?></td>
                                                                    <td class="px-4 py-2"><?php echo $transaction['TotalStockOut']; ?></td>
                                                                    <td class="px-4 py-2"><?php echo $remainingStock; ?></td>
                                                                    <td class="px-4 py-2"><?php echo $restock; ?></td>
                                                                    <td class="px-4 py-2"><?php echo "Rp." . " ". number_format($transaction['TotalOut'], 2, ',', '.'); ?></td> <!-- Display Restock value -->
                                                                </tr>
                                                                <?php
                                                                // Check if there is a next iteration and Remaining Stock is greater than 0
                                                                if ($i + 1 < $transactionsCount && $remainingStock > 0) {
                                                                    // Update TotalStockIn for the next iteration
                                                                    $stockDataRow['transactions'][$i + 1]['TotalStockIn'] += $remainingStock;
                                                                }
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td colspan="5" class="px-4 py-2 text-right font-bold">Total : </td> <!-- Display Restock value -->
                                                                <td  class="px-4 py-2 text-"><?php echo "Rp." . " ". number_format($totalPenjualan, 2, ',', '.'); ?></td> <!-- Display Restock value -->
                                                            </tr>
                                                            <?php
                                                            // Loop through each transaction for the current stock
                                                            foreach ($stockDataRow['transactions'] as $transaction) {
                                                                $currentProductStock = [];  // Initialize an array for the current transaction

                                                                // Add required keys and data to the array
                                                                $currentProductStock['ProductID'] = $stockDataRow['ProductID'];
                                                                $currentProductStock['StockID'] = $stockDataRow['StockID'];
                                                                $currentProductStock['ColorID'] = $stockDataRow['ColorID'];
                                                                $currentProductStock['BrandID'] = $stockDataRow['BrandID'];
                                                                $currentProductStock['SizeID'] = $stockDataRow['SizeID'];
                                                                $currentProductStock['Month'] = $transaction['Month'];
                                                                $currentProductStock['TotalStockIn'] = $transaction['TotalStockIn'];
                                                                $currentProductStock['TotalStockOut'] = $transaction['TotalStockOut'];

                                                                $remainingStock = $transaction['TotalStockIn'] - $transaction['TotalStockOut'];
                                                                $currentProductStock['remainingStock'] = $remainingStock;

                                                                $restock = $remainingStock < 6 ? 'True' : 'False';
                                                                $currentProductStock['Restock'] = $restock;

                                                                // Add the current transaction data to the main array
                                                                $allProductStock[] = $currentProductStock;
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- End Display stock in stock out for the last twelve months -->

                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <p class="text-gray-600">No stock data found.</p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- Add more details or actions as needed -->
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <p class="text-center text-gray-600">No data found.</p>
                    <?php
                    }
                    ?>
                    <!-- End Product List -->
                    <!-- Display $allProductStock data in a table -->
                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full border border-gray-300 divide-y divide-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Product ID</th>
                                <th class="px-4 py-2">Stock ID</th>
                                <th class="px-4 py-2">Color ID</th>
                                <th class="px-4 py-2">Brand ID</th>
                                <th class="px-4 py-2">Size ID</th>
                                <th class="px-4 py-2">Month</th>
                                <th class="px-4 py-2">Total Stock In</th>
                                <th class="px-4 py-2">Total Stock Out</th>
                                <th class="px-4 py-2">Remaining Stock</th>
                                <th class="px-4 py-2">Restock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Assuming $allProductStock is an array of products with ProductID, ColorID, BrandID, and SizeID
                            $productIds = array_column($allProductStock, 'ProductID');
                            $colorIds = array_column($allProductStock, 'ColorID');
                            $brandIds = array_column($allProductStock, 'BrandID');
                            $sizeIds = array_column($allProductStock, 'SizeID');

                            $productIdsString = implode(',', $productIds);
                            $colorIdsString = implode(',', $colorIds);
                            $brandIdsString = implode(',', $brandIds);
                            $sizeIdsString = implode(',', $sizeIds);


                            // Fetch all necessary product data in one query
                            $sql = "SELECT `ProductID`, `ProductName` FROM `Products` WHERE `ProductID` IN ($productIdsString)";
                            $colorSql = "SELECT `ColorID`, `ColorName` FROM `Colors` WHERE `ColorID` IN ($colorIdsString)";
                            $brandSql = "SELECT `BrandID`, `BrandName` FROM `Brands` WHERE `BrandID` IN ($brandIdsString)";
                            $sizeSql = "SELECT `SizeID`, `SizeName` FROM `Sizes` WHERE `SizeID` IN ($sizeIdsString)";
                            
                            $productResult = mysqli_query($conn, $sql);
                            $colorResult = mysqli_query($conn, $colorSql);
                            $brandResult = mysqli_query($conn, $brandSql);
                            $sizeResult = mysqli_query($conn, $sizeSql);

                            // Create an associative array to map ProductID to ProductName
                            $productNameMap = array();
                            while ($row = mysqli_fetch_assoc($productResult)) {
                                $productNameMap[$row['ProductID']] = $row['ProductName'];
                            }
                            $colorNameMap = array();
                            while ($colorRow = mysqli_fetch_assoc($colorResult)) {
                                $colorNameMap[$colorRow['ColorID']] = $colorRow['ColorName'];
                            }

                            $brandNameMap = array();
                            while ($brandRow = mysqli_fetch_assoc($brandResult)) {
                                $brandNameMap[$brandRow['BrandID']] = $brandRow['BrandName'];
                            }

                            $sizeNameMap = array();
                            while ($sizeRow = mysqli_fetch_assoc($sizeResult)) {
                                $sizeNameMap[$sizeRow['SizeID']] = $sizeRow['SizeName'];
                            }

                            
                            $n = 0;
                            foreach ($allProductStock as $productStock) {
                            $n++;
                            $productId = $productStock['ProductID'];
                            $colorId = $productStock['ColorID'];
                            $brandId = $productStock['BrandID'];
                            $sizeId = $productStock['SizeID'];
                            
                            $productName = isset($productNameMap[$productId]) ? $productNameMap[$productId] : 'N/A';
                            $colorName = isset($colorNameMap[$colorId]) ? $colorNameMap[$colorId] : 'N/A';
                            $brandName = isset($brandNameMap[$brandId]) ? $brandNameMap[$brandId] : 'N/A';
                            $sizeName = isset($sizeNameMap[$sizeId]) ? $sizeNameMap[$sizeId] : 'N/A'; 
                                ?>
                                <tr>
                                    <td class="px-4 py-2"><?php echo $n; ?></td>
                                    <td class="px-4 py-2"><?php echo $productName ?></td>
                                    <td class="px-4 py-2"><?php echo $productStock['StockID']; ?></td>
                                    <td class="px-4 py-2"><?php echo $colorName ?></td>
                                    <td class="px-4 py-2"><?php echo $brandName ?></td>
                                    <td class="px-4 py-2"><?php echo $sizeName ?></td>
                                    <td class="px-4 py-2"><?php echo $productStock['Month']; ?></td>
                                    <td class="px-4 py-2"><?php echo $productStock['TotalStockIn']; ?></td>
                                    <td class="px-4 py-2"><?php echo $productStock['TotalStockOut']; ?></td>
                                    <td class="px-4 py-2"><?php echo $productStock['remainingStock']; ?></td>
                                    <td class="px-4 py-2"><?php echo $productStock['Restock']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- End Display $allProductStock data in a table -->
                <?php
                $allProductStockLast = [];

                    // Iterate through $allProductStock to find the last month for each unique combination
                    foreach ($allProductStock as $productStock) {
                        $key = $productStock['ProductID'] . '-' . $productStock['StockID'] . '-' . $productStock['ColorID'] . '-' . $productStock['BrandID'] . '-' . $productStock['SizeID'];

                        // Check if the key already exists in $allProductStockLast
                        if (!isset($allProductStockLast[$key]) || compareMonths($productStock['Month'], $allProductStockLast[$key]['Month']) > 0) {
                            // If not, or if the current month is greater, update the entry
                            $allProductStockLast[$key] = $productStock;
                        }
                    }

                    $allProductStockWithoutLast = [];

                    // Iterate through $allProductStock to exclude the entries corresponding to the last month for each unique combination
                    foreach ($allProductStock as $productStock) {
                        $key = $productStock['ProductID'] . '-' . $productStock['StockID'] . '-' . $productStock['ColorID'] . '-' . $productStock['BrandID'] . '-' . $productStock['SizeID'];

                        // Check if the key exists in $allProductStockLast and if the months are different
                        if (!isset($allProductStockLast[$key]) || $productStock['Month'] !== $allProductStockLast[$key]['Month']) {
                            // If not, include the entry in $allProductStockWithoutLast
                            $allProductStockWithoutLast[] = $productStock;
                        }
                    }

                    // Now $allProductStockLast contains the last month's data for each unique combination

                    // Function to compare two month names and return the difference
                    function compareMonths($month1, $month2) {
                        $months = [
                            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4, 'May' => 5, 'June' => 6,
                            'July' => 7, 'August' => 8, 'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
                        ];

                        return $months[$month1] - $months[$month2];
                    }
                    ?>
                </div>
                <!-- Display $allProductStockLast data in a table -->
                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full border border-gray-300 divide-y divide-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Product ID</th>
                                <th class="px-4 py-2">Stock ID</th>
                                <th class="px-4 py-2">Color ID</th>
                                <th class="px-4 py-2">Brand ID</th>
                                <th class="px-4 py-2">Size ID</th>
                                <th class="px-4 py-2">Month</th>
                                <th class="px-4 py-2">Total Stock In</th>
                                <th class="px-4 py-2">Total Stock Out</th>
                                <th class="px-4 py-2">Remaining Stock</th>
                                <!-- <th class="px-4 py-2">Restock</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 0;
                            foreach ($allProductStockLast as $productStock) {
                            $productId = $productStock['ProductID'];
                            $colorId = $productStock['ColorID'];
                            $brandId = $productStock['BrandID'];
                            $sizeId = $productStock['SizeID'];
                            
                            $productName = isset($productNameMap[$productId]) ? $productNameMap[$productId] : 'N/A';
                            $colorName = isset($colorNameMap[$colorId]) ? $colorNameMap[$colorId] : 'N/A';
                            $brandName = isset($brandNameMap[$brandId]) ? $brandNameMap[$brandId] : 'N/A';
                            $sizeName = isset($sizeNameMap[$sizeId]) ? $sizeNameMap[$sizeId] : 'N/A'; 
                            $n++ ?>
                                <tr>
                                    <td class="px-4 py-2"><?php echo $n; ?></td>
                                    <td class="px-4 py-2"><?php echo $productName ?></td>
                                    <td class="px-4 py-2"><?php echo $productStock['StockID']; ?></td>
                                    <td class="px-4 py-2"><?php echo $colorName ?></td>
                                    <td class="px-4 py-2"><?php echo $brandName ?></td>
                                    <td class="px-4 py-2"><?php echo $sizeName ?></td>
                                    <td class="px-4 py-2"><?php echo $productStock['Month']; ?></td>
                                    <td class="px-4 py-2"><?php echo $productStock['TotalStockIn']; ?></td>
                                    <td class="px-4 py-2"><?php echo $productStock['TotalStockOut']; ?></td>
                                    <td class="px-4 py-2"><?php echo $productStock['remainingStock']; ?></td>
                                    <!-- <td class="px-4 py-2"><?php //echo $productStock['Restock']; ?></td> -->
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- End Display $allProductStockLast data in a table -->
                <?php
                // Iterate through $allProductStockWithoutLast and insert or update records in MonthlyProductStocks
                foreach ($allProductStockWithoutLast as $productStock) {
                    $productId = $productStock['ProductID'];
                    $stockId = $productStock['StockID'];
                    $colorId = $productStock['ColorID'];
                    $brandId = $productStock['BrandID'];
                    $sizeId = $productStock['SizeID'];
                    $month = $productStock['Month'];
                    $totalStockIn = $productStock['TotalStockIn'];
                    $totalStockOut = $productStock['TotalStockOut'];
                    $remainingStock = $productStock['remainingStock'];
                    $restock = $productStock['Restock'];

                    // Check if the record already exists in MonthlyProductStocks
                    $sqlCheck = "SELECT * FROM `MonthlyProductStocks` 
                                WHERE `ProductID` = $productId 
                                AND `StockID` = $stockId 
                                AND `ColorID` = $colorId 
                                AND `BrandID` = $brandId 
                                AND `SizeID` = $sizeId 
                                AND `Month` = '$month'";

                    $resultCheck = mysqli_query($conn, $sqlCheck);

                    if (mysqli_num_rows($resultCheck) > 0) {
                        // If the record exists, update it
                        $sqlUpdate = "UPDATE `MonthlyProductStocks` 
                                    SET `TotalStockIn` = $totalStockIn, 
                                        `TotalStockOut` = $totalStockOut, 
                                        `RemainingStock` = $remainingStock, 
                                        `Restock` = $restock 
                                    WHERE `ProductID` = $productId 
                                    AND `StockID` = $stockId 
                                    AND `ColorID` = $colorId 
                                    AND `BrandID` = $brandId 
                                    AND `SizeID` = $sizeId 
                                    AND `Month` = '$month'";

                        mysqli_query($conn, $sqlUpdate);
                    } else {
                        // If the record doesn't exist, insert it
                        $sqlInsert = "INSERT INTO `MonthlyProductStocks` 
                                    (`ProductID`, `StockID`, `ColorID`, `BrandID`, `SizeID`, `Month`, `TotalStockIn`, `TotalStockOut`, `RemainingStock`, `Restock`) 
                                    VALUES ($productId, $stockId, $colorId, $brandId, $sizeId, '$month', $totalStockIn, $totalStockOut, $remainingStock, $restock)";

                        mysqli_query($conn, $sqlInsert);
                    }
                }

                // Iterate through $allProductStockLast and insert or update records in MonthlyProductStockTests
                foreach ($allProductStockLast as $productStock) {
                    $productId = $productStock['ProductID'];
                    $stockId = $productStock['StockID'];
                    $colorId = $productStock['ColorID'];
                    $brandId = $productStock['BrandID'];
                    $sizeId = $productStock['SizeID'];
                    $month = $productStock['Month'];
                    $totalStockIn = $productStock['TotalStockIn'];
                    $totalStockOut = $productStock['TotalStockOut'];
                    $remainingStock = $productStock['remainingStock'];
                    $restock = $productStock['Restock'];

                    // Check if the record already exists in MonthlyProductStockTests
                    $sqlCheck = "SELECT * FROM `MonthlyProductStockTests` 
                                WHERE `ProductID` = $productId 
                                AND `StockID` = $stockId 
                                AND `ColorID` = $colorId 
                                AND `BrandID` = $brandId 
                                AND `SizeID` = $sizeId 
                                AND `Month` = '$month'";

                    $resultCheck = mysqli_query($conn, $sqlCheck);

                    if (mysqli_num_rows($resultCheck) > 0) {
                        // If the record exists, update it
                        $sqlUpdate = "UPDATE `MonthlyProductStockTests` 
                                    SET `TotalStockIn` = $totalStockIn, 
                                        `TotalStockOut` = $totalStockOut, 
                                        `RemainingStock` = $remainingStock, 
                                        `Restock` = $restock 
                                    WHERE `ProductID` = $productId 
                                    AND `StockID` = $stockId 
                                    AND `ColorID` = $colorId 
                                    AND `BrandID` = $brandId 
                                    AND `SizeID` = $sizeId 
                                    AND `Month` = '$month'";

                        mysqli_query($conn, $sqlUpdate);
                    } else {
                        // If the record doesn't exist, insert it
                        $sqlInsert = "INSERT INTO `MonthlyProductStockTests` 
                                    (`ProductID`, `StockID`, `ColorID`, `BrandID`, `SizeID`, `Month`, `TotalStockIn`, `TotalStockOut`, `RemainingStock`, `Restock`) 
                                    VALUES ($productId, $stockId, $colorId, $brandId, $sizeId, '$month', $totalStockIn, $totalStockOut, $remainingStock, $restock)";

                        mysqli_query($conn, $sqlInsert);
                    }
                }

                // Close the database connection
                mysqli_close($conn);
                
                ?>
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
