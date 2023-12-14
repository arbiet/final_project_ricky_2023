<?php
// Initialize the session
session_start();

// Include the connection file
require_once('../../database/connection.php');

    // Fetch data from MonthlyProductStocks
    $sqlMonthlyProductStocks = "SELECT * FROM MonthlyProductStocks";
    $resultMonthlyProductStocks = $conn->query($sqlMonthlyProductStocks);

    $sqlMonthlyProductStocks = "
        SELECT 
            mps.*, 
            b.BrandName, 
            s.SizeName, 
            c.ColorName
        FROM MonthlyProductStocks mps
        LEFT JOIN Brands b ON mps.BrandID = b.BrandID
        LEFT JOIN Sizes s ON mps.SizeID = s.SizeID
        LEFT JOIN Colors c ON mps.ColorID = c.ColorID
    ";

    $resultMonthlyProductStocks = $conn->query($sqlMonthlyProductStocks);


    // Initialize arrays to store MonthlyProductStocks data
    $monthlyProductStocksData = array();

    // Initialize arrays to store Restock counts for each BrandID, SizeID, ColorID, ProductID, RemainingStockCategory
    $restockCountsByBrandID = array();
    $restockCountsBySizeID = array();
    $restockCountsByColorID = array();
    $restockCountsByProductID = array();
    $restockCountsByRemainingStockCategory = array();

    // Count the number of data points and instances of Restock being True (1) or False (0)
    $n = 0; // Total data points
    $restockTrueCount = 0; // Count of Restock True
    $restockFalseCount = 0; // Count of Restock False

    while ($row = $resultMonthlyProductStocks->fetch_assoc()) {
        $n++;

        // Count occurrences of features given Restock and Not Restock
        $brandID = $row['BrandID'];
        $sizeID = $row['SizeID'];
        $productID = $row['ProductID'];
        $colorID = $row['ColorID'];
        $remainStock = $row['RemainingStock'];
        $restock = $row['Restock'];
        $brandName = $row['BrandName'];
        $sizeName = $row['SizeName'];
        $colorName = $row['ColorName'];

        // Count Restock occurrences by BrandID
        if (!isset($restockCountsByBrandID[$brandID])) {
            $restockCountsByBrandID[$brandID] = array('Restock' => 0, 'NoRestock' => 0);
        }

        if ($restock == 1) {
            $restockCountsByBrandID[$brandID]['Restock']++;
        } else {
            $restockCountsByBrandID[$brandID]['NoRestock']++;
        }

        // Count Restock occurrences by SizeID
        if (!isset($restockCountsBySizeID[$sizeID])) {
            $restockCountsBySizeID[$sizeID] = array('Restock' => 0, 'NoRestock' => 0);
        }

        if ($restock == 1) {
            $restockCountsBySizeID[$sizeID]['Restock']++;
        } else {
            $restockCountsBySizeID[$sizeID]['NoRestock']++;
        }

        // Count Restock occurrences by ColorID
        if (!isset($restockCountsByColorID[$colorID])) {
            $restockCountsByColorID[$colorID] = array('Restock' => 0, 'NoRestock' => 0);
        }

        if ($restock == 1) {
            $restockCountsByColorID[$colorID]['Restock']++;
        } else {
            $restockCountsByColorID[$colorID]['NoRestock']++;
        }

        // Count Restock occurrences by ProductID
        if (!isset($restockCountsByProductID[$productID])) {
            $restockCountsByProductID[$productID] = array('Restock' => 0, 'NoRestock' => 0);
        }

        if ($restock == 1) {
            $restockCountsByProductID[$productID]['Restock']++;
        } else {
            $restockCountsByProductID[$productID]['NoRestock']++;
        }

        // Count Restock occurrences by RemainingStockCategory
        $remainingStockCategory = ($remainStock <= 6) ? "<=6" : ">6";
        if (!isset($restockCountsByRemainingStockCategory[$remainingStockCategory])) {
            $restockCountsByRemainingStockCategory[$remainingStockCategory] = array('Restock' => 0, 'NoRestock' => 0);
        }

        if ($restock == 1) {
            $restockCountsByRemainingStockCategory[$remainingStockCategory]['Restock']++;
        } else {
            $restockCountsByRemainingStockCategory[$remainingStockCategory]['NoRestock']++;
        }

        if ($row['Restock'] == 1) {
            $restockTrueCount++;
        } else {
            $restockFalseCount++;
        }

        // Determine RemainingStockCategory
        $remainingStockCategory = ($remainStock <= 6) ? "<=6" : ">6";

        // Store MonthlyProductStocks data in an array with RemainingStockCategory
        $monthlyProductStocksData[] = array(
            'BrandID' => $brandID,
            'SizeID' => $sizeID,
            'ProductID' => $productID,
            'ColorID' => $colorID,
            'RemainingStock' => $remainStock,
            'Restock' => $row['Restock'],
            'RemainingStockCategory' => $remainingStockCategory
        );
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
                    <h1 class="text-3xl text-gray-800 font-semibol">Restock Analytics</h1>
                    <div class="flex flex-row justify-end items-center">
                        <a href="<?php echo $baseUrl; ?>public/manage_restocks/manage_restocks_lsit.php" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center space-x-2">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
                <!-- End Header Content -->
                <!-- Content -->
                <div class="flex flex-col w-full">
                    <?php

                    // Display the counts
                    echo "<h2 class='text-2xl font-semibold mb-2'>MonthlyProductStocks Counts</h2>";
                    echo "<p class='mb-2'>Total data points (n): $n</p>";
                    echo "<p class='mb-2'>Restock True count: $restockTrueCount</p>";
                    echo "<p class='mb-2'>Restock False count: $restockFalseCount</p>";

                    // Calculate probabilities
                    $probRestockTrue = $restockTrueCount / $n;
                    $probRestockFalse = $restockFalseCount / $n;

                    // Display probabilities
                    echo "<h2 class='text-2xl font-semibold mb-2'>Probabilities P(Ci)</h2>";
                    echo "<p class='mb-2'>P(Restock = True): $probRestockTrue</p>";
                    echo "<p class='mb-2'>P(Restock = False): $probRestockFalse</p>";

                    // Display counts
                    echo "<h2 class='text-2xl font-semibold mb-2'>MonthlyProductStocks Counts</h2>";

                    // Function to generate a table from an associative array
                    function generateTable($data, $title, $titleCategory)
                    {
                        echo "<h3 class='text-xl font-semibold mb-2'>$title</h3>";
                        echo "<table class='border-collapse border border-gray-400 w-full'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th class='border border-gray-400 px-4 py-2'>$titleCategory</th>";
                        echo "<th class='border border-gray-400 px-4 py-2'>Restock</th>";
                        echo "<th class='border border-gray-400 px-4 py-2'>NoRestock</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        foreach ($data as $category => $counts) {
                            echo "<tr>";
                            echo "<td class='border border-gray-400 px-4 py-2'>$category</td>";
                            echo "<td class='border border-gray-400 px-4 py-2'>" . $counts['Restock'] . "</td>";
                            echo "<td class='border border-gray-400 px-4 py-2'>" . $counts['NoRestock'] . "</td>";
                            echo "</tr>";
                        }

                        echo "</tbody>";
                        echo "</table>";
                    }

                    // Display counts for Restock by BrandID
                    generateTable($restockCountsByBrandID, 'Restock Counts by BrandID', 'BrandID');

                    // Display counts for Restock by SizeID
                    generateTable($restockCountsBySizeID, 'Restock Counts by SizeID', 'SizeID');

                    // Display counts for Restock by ColorID
                    generateTable($restockCountsByColorID, 'Restock Counts by ColorID', 'ColorID');

                    // Display counts for Restock by ProductID
                    generateTable($restockCountsByProductID, 'Restock Counts by ProductID','ProductID');

                    // Display counts for Restock by RemainingStockCategory
                    generateTable($restockCountsByRemainingStockCategory, 'Restock Counts by RemainingStockCategory','RemainingStockCategory');

                    // Calculate and display probabilities Condition-Based Hypotheses P(X|Ci)
                    echo "<h2 class='text-2xl font-semibold mb-2'>Probabilities Condition-Based Hypotheses P(X|Ci)</h2>";

                    // Function to calculate conditional probability
                    function calculateConditionalProbability($featureCounts, $restockCount, $condition)
                    {
                        $featureProbabilities = array();

                        foreach ($featureCounts as $feature => $counts) {
                            $restockGivenFeature = $counts[$condition];
                            $probability = $restockGivenFeature / $restockCount;
                            $featureProbabilities[$feature][$condition] = $probability;
                        }

                        return $featureProbabilities;
                    }

                    // Function to safely access array keys
                    function safeArrayAccess($array, $key, $defaultValue = null)
                    {
                        return isset($array[$key]) ? $array[$key] : $defaultValue;
                    }

                    // Calculate and display conditional probabilities for Restock by BrandID
                    $brandIDRestockProbabilities = calculateConditionalProbability($restockCountsByBrandID, $restockTrueCount, 'Restock');
                    // Calculate and display conditional probabilities for Restock by BrandID
                    $brandIDNoRestockProbabilities = calculateConditionalProbability($restockCountsByBrandID, $restockTrueCount, 'NoRestock');
                    // Calculate and display conditional probabilities for Restock by SizeID
                    $sizeIDRestockProbabilities = calculateConditionalProbability($restockCountsBySizeID, $restockTrueCount, 'Restock');
                    // Calculate and display conditional probabilities for Restock by SizeID
                    $sizeIDNoRestockProbabilities = calculateConditionalProbability($restockCountsBySizeID, $restockTrueCount, 'NoRestock');
                    // Calculate and display conditional probabilities for Restock by ColorID
                    $colorIDRestockProbabilities = calculateConditionalProbability($restockCountsByColorID, $restockTrueCount, 'Restock');
                    // Calculate and display conditional probabilities for Restock by ColorID
                    $colorIDNoRestockProbabilities = calculateConditionalProbability($restockCountsByColorID, $restockTrueCount, 'NoRestock');
                    // Calculate and display conditional probabilities for Restock by ProductID
                    $productIDRestockProbabilities = calculateConditionalProbability($restockCountsByProductID, $restockTrueCount, 'Restock');
                    // Calculate and display conditional probabilities for Restock by ProductID
                    $productIDNoRestockProbabilities = calculateConditionalProbability($restockCountsByProductID, $restockTrueCount, 'NoRestock');
                    // Calculate and display conditional probabilities for Restock by RemainingStockCategory
                    $remainingStockCategoryRestockProbabilities = calculateConditionalProbability($restockCountsByRemainingStockCategory, $restockTrueCount, 'Restock');
                    // Calculate and display conditional probabilities for Restock by RemainingStockCategory
                    $remainingStockCategoryNoRestockProbabilities = calculateConditionalProbability($restockCountsByRemainingStockCategory, $restockTrueCount, 'NoRestock');

                    // Function to generate a table from a nested associative array
                    function generateNestedTable($data, $title, $titleCategory)
                    {
                        echo "<h3 class='text-xl font-semibold mb-2'>$title</h3>";
                        echo "<table class='border-collapse border border-gray-400 w-full'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th class='border border-gray-400 px-4 py-2'>$titleCategory</th>";
                        echo "<th class='border border-gray-400 px-4 py-2'>$title</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        foreach ($data as $category => $counts) {
                            echo "<tr>";
                            echo "<td class='border border-gray-400 px-4 py-2'>$category</td>";
                            echo "<td class='border border-gray-400 px-4 py-2'>" . $counts[$title] . "</td>";
                            echo "</tr>";
                        }

                        echo "</tbody>";
                        echo "</table>";
                    }

                    // Display counts for Restock dan NoRestock by BrandID
                    generateNestedTable($brandIDRestockProbabilities, 'Restock', 'BrandID');
                    generateNestedTable($brandIDNoRestockProbabilities, 'NoRestock', 'BrandID');

                    // Display counts for Restock dan NoRestock by sizeID
                    generateNestedTable($sizeIDRestockProbabilities, 'Restock', 'sizeID');
                    generateNestedTable($sizeIDNoRestockProbabilities, 'NoRestock', 'sizeID');

                    // Display counts for Restock dan NoRestock by colorID
                    generateNestedTable($colorIDRestockProbabilities, 'Restock', 'colorID');
                    generateNestedTable($colorIDNoRestockProbabilities, 'NoRestock', 'colorID');

                    // Display counts for Restock dan NoRestock by productID
                    generateNestedTable($productIDRestockProbabilities, 'Restock', 'productID');
                    generateNestedTable($productIDNoRestockProbabilities, 'NoRestock','productID');

                    // Display counts for Restock dan NoRestock by remainingStockCategory
                    generateNestedTable($remainingStockCategoryRestockProbabilities, 'Restock', 'remainingStockCategory');
                    generateNestedTable($remainingStockCategoryNoRestockProbabilities, 'NoRestock', 'remainingStockCategory');

                    // Fetch data from MonthlyProductStockTests
                    $sqlMonthlyProductStockTests = "SELECT * FROM MonthlyProductStockTests";
                    $resultMonthlyProductStockTests = $conn->query($sqlMonthlyProductStockTests);

                    // Display data in a styled table with Naive Bayes Prediction
                    echo "<h2 class='text-2xl font-semibold mb-2'>MonthlyProductStockTests</h2>";
                    echo "<div class='overflow-x-auto'>";
                    echo "<table class='min-w-full bg-white border border-gray-300'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th class='border border-gray-300 px-4 py-2'>MonthlyStockTestID</th>";
                    echo "<th class='border border-gray-300 px-4 py-2'>ProductID</th>";
                    echo "<th class='border border-gray-300 px-4 py-2'>StockID</th>";
                    echo "<th class='border border-gray-300 px-4 py-2'>ColorID</th>";
                    echo "<th class='border border-gray-300 px-4 py-2'>BrandID</th>";
                    echo "<th class='border border-gray-300 px-4 py-2'>SizeID</th>";
                    echo "<th class='border border-gray-300 px-4 py-2'>Month</th>";
                    echo "<th class='border border-gray-300 px-4 py-2'>TotalStockIn</th>";
                    echo "<th class='border border-gray-300 px-4 py-2'>TotalStockOut</th>";
                    echo "<th class='border border-gray-300 px-4 py-2'>RemainingStock</th>";
                    echo "<th class='border border-gray-300 px-4 py-2'>Naive Bayes Prediction</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    while ($row = $resultMonthlyProductStockTests->fetch_assoc()) {
                        // Calculate Naive Bayes Prediction
                        $brandID = $row['BrandID'];
                        $sizeID = $row['SizeID'];
                        $colorID = $row['ColorID'];
                        $productID = $row['ProductID'];
                        $remainingStock = $row['RemainingStock'];

                        // Calculate P(X|Ci) for each feature and Restock/NoRestock with safe array access
                        $brandIDRestockProbability = safeArrayAccess($brandIDRestockProbabilities, $brandID, ['Restock' => 0])['Restock'];
                        $brandIDNoRestockProbability = safeArrayAccess($brandIDNoRestockProbabilities, $brandID, ['NoRestock' => 0])['NoRestock'];

                        $sizeIDRestockProbability = safeArrayAccess($sizeIDRestockProbabilities, $sizeID, ['Restock' => 0])['Restock'];
                        $sizeIDNoRestockProbability = safeArrayAccess($sizeIDNoRestockProbabilities, $sizeID, ['NoRestock' => 0])['NoRestock'];

                        $colorIDRestockProbability = safeArrayAccess($colorIDRestockProbabilities, $colorID, ['Restock' => 0])['Restock'];
                        $colorIDNoRestockProbability = safeArrayAccess($colorIDNoRestockProbabilities, $colorID, ['NoRestock' => 0])['NoRestock'];

                        $productIDRestockProbability = safeArrayAccess($productIDRestockProbabilities, $productID, ['Restock' => 0])['Restock'];
                        $productIDNoRestockProbability = safeArrayAccess($productIDNoRestockProbabilities, $productID, ['NoRestock' => 0])['NoRestock'];

                        $remainingStockCategory = ($remainingStock <= 6) ? "<=6" : ">6";
                        $remainingStockCategoryRestockProbability = safeArrayAccess($remainingStockCategoryRestockProbabilities, $remainingStockCategory, ['Restock' => 0])['Restock'];
                        $remainingStockCategoryNoRestockProbability = safeArrayAccess($remainingStockCategoryNoRestockProbabilities, $remainingStockCategory, ['NoRestock' => 0])['NoRestock'];

                        // Calculate Naive Bayes scores for Restock and NoRestock
                        $restockScore = $brandIDRestockProbability * $sizeIDRestockProbability * $colorIDRestockProbability * $productIDRestockProbability * $remainingStockCategoryRestockProbability * $probRestockTrue;
                        $noRestockScore = $brandIDNoRestockProbability * $sizeIDNoRestockProbability * $colorIDNoRestockProbability * $productIDNoRestockProbability * $remainingStockCategoryNoRestockProbability * $probRestockFalse;

                        // Assign the prediction based on the higher score
                        $naiveBayesPrediction = ($restockScore > $noRestockScore) ? 1 : 0;

                        // Output the row with Naive Bayes Prediction
                        echo "<tr>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$row['MonthlyStockTestID']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$row['ProductID']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$row['StockID']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$row['ColorID']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$row['BrandID']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$row['SizeID']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$row['Month']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$row['TotalStockIn']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$row['TotalStockOut']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$row['RemainingStock']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>$naiveBayesPrediction</td>";
                        echo "</tr>";

                        // Update NaiveBayesPrediction in the database for the current row
                        $updateQuery = "UPDATE MonthlyProductStockTests 
                                        SET NaiveBayesPrediction = $naiveBayesPrediction 
                                        WHERE MonthlyStockTestID = {$row['MonthlyStockTestID']}";

                        // Execute the update query
                        $conn->query($updateQuery);
                    }

                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";

                    // Close the connection
                    $conn->close();
                ?>
                <div>  
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
