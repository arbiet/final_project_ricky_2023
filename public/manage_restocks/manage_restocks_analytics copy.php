<?php
    // Include the connection file
    require_once('../../database/connection.php');

    // Fetch data from MonthlyProductStocks
    $sqlMonthlyProductStocks = "SELECT * FROM MonthlyProductStocks";
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

    // Display the counts
    echo "<h2>MonthlyProductStocks Counts</h2>";
    echo "<p>Total data points (n): $n</p>";
    echo "<p>Restock True count: $restockTrueCount</p>";
    echo "<p>Restock False count: $restockFalseCount</p>";

    // Calculate probabilities
    $probRestockTrue = $restockTrueCount / $n;
    $probRestockFalse = $restockFalseCount / $n;

    // Display probabilities
    echo "<h2>Probabilities P(Ci)</h2>";
    echo "<p>P(Restock = True): $probRestockTrue</p>";
    echo "<p>P(Restock = False): $probRestockFalse</p>";

    // Display the counts
    echo "<h2>MonthlyProductStocks Counts</h2>";

    // Display counts for Restock by BrandID
    echo "<h3>Restock Counts by BrandID</h3>";
    print_r($restockCountsByBrandID);

    // Display counts for Restock by SizeID
    echo "<h3>Restock Counts by SizeID</h3>";
    print_r($restockCountsBySizeID);

    // Display counts for Restock by ColorID
    echo "<h3>Restock Counts by ColorID</h3>";
    print_r($restockCountsByColorID);

    // Display counts for Restock by ProductID
    echo "<h3>Restock Counts by ProductID</h3>";
    print_r($restockCountsByProductID);

    // Display counts for Restock by RemainingStockCategory
    echo "<h3>Restock Counts by RemainingStockCategory</h3>";
    print_r($restockCountsByRemainingStockCategory);

    // Calculate and display probabilities Condition-Based Hypotheses P(X|Ci)
    echo "<h2>Probabilities Condition-Based Hypotheses P(X|Ci)</h2>";

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
    echo "<h3>Conditional Probabilities for Restock Given BrandID</h3>";
    print_r($brandIDRestockProbabilities);
    // Calculate and display conditional probabilities for Restock by BrandID
    $brandIDNoRestockProbabilities = calculateConditionalProbability($restockCountsByBrandID, $restockTrueCount, 'NoRestock');
    echo "<h3>Conditional Probabilities for NoRestock Given BrandID</h3>";
    print_r($brandIDNoRestockProbabilities);

    // Calculate and display conditional probabilities for Restock by SizeID
    $sizeIDRestockProbabilities = calculateConditionalProbability($restockCountsBySizeID, $restockTrueCount, 'Restock');
    echo "<h3>Conditional Probabilities for Restock Given SizeID</h3>";
    print_r($sizeIDRestockProbabilities);
    // Calculate and display conditional probabilities for Restock by SizeID
    $sizeIDNoRestockProbabilities = calculateConditionalProbability($restockCountsBySizeID, $restockTrueCount, 'NoRestock');
    echo "<h3>Conditional Probabilities for NoRestock Given SizeID</h3>";
    print_r($sizeIDNoRestockProbabilities);

    // Calculate and display conditional probabilities for Restock by ColorID
    $colorIDRestockProbabilities = calculateConditionalProbability($restockCountsByColorID, $restockTrueCount, 'Restock');
    echo "<h3>Conditional Probabilities for Restock Given ColorID</h3>";
    print_r($colorIDRestockProbabilities);
    // Calculate and display conditional probabilities for Restock by ColorID
    $colorIDNoRestockProbabilities = calculateConditionalProbability($restockCountsByColorID, $restockTrueCount, 'NoRestock');
    echo "<h3>Conditional Probabilities for NoRestock Given ColorID</h3>";
    print_r($colorIDNoRestockProbabilities);

    // Calculate and display conditional probabilities for Restock by ProductID
    $productIDRestockProbabilities = calculateConditionalProbability($restockCountsByProductID, $restockTrueCount, 'Restock');
    echo "<h3>Conditional Probabilities for Restock Given ProductID</h3>";
    print_r($productIDRestockProbabilities);
    // Calculate and display conditional probabilities for Restock by ProductID
    $productIDNoRestockProbabilities = calculateConditionalProbability($restockCountsByProductID, $restockTrueCount, 'NoRestock');
    echo "<h3>Conditional Probabilities for NoRestock Given ProductID</h3>";
    print_r($productIDNoRestockProbabilities);

    // Calculate and display conditional probabilities for Restock by RemainingStockCategory
    $remainingStockCategoryRestockProbabilities = calculateConditionalProbability($restockCountsByRemainingStockCategory, $restockTrueCount, 'Restock');
    echo "<h3>Conditional Probabilities for Restock Given RemainingStockCategory</h3>";
    print_r($remainingStockCategoryRestockProbabilities);
    // Calculate and display conditional probabilities for Restock by RemainingStockCategory
    $remainingStockCategoryNoRestockProbabilities = calculateConditionalProbability($restockCountsByRemainingStockCategory, $restockTrueCount, 'NoRestock');
    echo "<h3>Conditional Probabilities for NoRestock Given RemainingStockCategory</h3>";
    print_r($remainingStockCategoryNoRestockProbabilities);


    // Fetch data from MonthlyProductStockTests
    $sqlMonthlyProductStockTests = "SELECT * FROM MonthlyProductStockTests";
    $resultMonthlyProductStockTests = $conn->query($sqlMonthlyProductStockTests);

    // Display data in a table with Naive Bayes Prediction
    echo "<h2>MonthlyProductStockTests</h2>";
    echo "<table border='1'>
        <tr>
            <th>MonthlyStockTestID</th>
            <th>ProductID</th>
            <th>StockID</th>
            <th>ColorID</th>
            <th>BrandID</th>
            <th>SizeID</th>
            <th>Month</th>
            <th>TotalStockIn</th>
            <th>TotalStockOut</th>
            <th>RemainingStock</th>
            <th>Naive Bayes Prediction</th>
        </tr>";

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
        echo "<tr>
            <td>{$row['MonthlyStockTestID']}</td>
            <td>{$row['ProductID']}</td>
            <td>{$row['StockID']}</td>
            <td>{$row['ColorID']}</td>
            <td>{$row['BrandID']}</td>
            <td>{$row['SizeID']}</td>
            <td>{$row['Month']}</td>
            <td>{$row['TotalStockIn']}</td>
            <td>{$row['TotalStockOut']}</td>
            <td>{$row['RemainingStock']}</td>
            <td>$naiveBayesPrediction</td>
        </tr>";
    }

    echo "</table>";

    // Close the connection
    $conn->close();
?>
