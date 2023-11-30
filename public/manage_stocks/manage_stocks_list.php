<?php
// Initialize the session
session_start();
// Include the connection file
require_once('../../database/connection.php');

// Initialize variables
$productName = '';
$errors = array();

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
                    <h1 class="text-3xl text-gray-800 font-semibol w-full">Stocks</h1>
                </div>
                <!-- End Header Content -->
                <!-- Content -->
                <div class="flex flex-col w-full">
                    <!-- Include Search Bar -->
                    <?php include('../components/search_manage.php'); ?>
                    <!-- Stock List -->
                    <div class="grid grid-cols-1 gap-4">
                        <?php
                        // Fetch product data from the database
                        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $query = "SELECT p.ProductID, p.ProductName, p.ProductImage, p.Description, p.Price, c.CategoryName, b.BrandName,
                            SUM(s.Quantity) AS TotalQuantity
                            FROM Products p
                            LEFT JOIN Stocks s ON p.ProductID = s.ProductID
                            LEFT JOIN Categories c ON p.CategoryID = c.CategoryID
                            LEFT JOIN Brands b ON p.BrandID = b.BrandID
                            WHERE p.ProductName LIKE '%$searchTerm%'
                            OR p.ProductImage LIKE '%$searchTerm%'
                            OR p.Description LIKE '%$searchTerm%'
                            OR p.Price LIKE '%$searchTerm%'
                            OR c.CategoryName LIKE '%$searchTerm%'
                            OR b.BrandName LIKE '%$searchTerm%'
                            GROUP BY p.ProductID
                            LIMIT 10 OFFSET " . ($page - 1) * 10;
                        $result = $conn->query($query);

                        // Count total rows in the table
                        $queryCount = "SELECT COUNT(DISTINCT p.ProductID) AS count FROM Products p
                            LEFT JOIN Stocks s ON p.ProductID = s.ProductID
                            LEFT JOIN Categories c ON p.CategoryID = c.CategoryID
                            LEFT JOIN Brands b ON p.BrandID = b.BrandID
                            WHERE p.ProductName LIKE '%$searchTerm%'
                            OR p.ProductImage LIKE '%$searchTerm%'
                            OR p.Description LIKE '%$searchTerm%'
                            OR p.Price LIKE '%$searchTerm%'
                            OR c.CategoryName LIKE '%$searchTerm%'
                            OR b.BrandName LIKE '%$searchTerm%'";
                        $resultCount = $conn->query($queryCount);
                        $rowCount = $resultCount->fetch_assoc()['count'];
                        $totalPage = ceil($rowCount / 10);
                        $no = 1;

                        // Loop through the results and display data in rows
                        while ($row = $result->fetch_assoc()) {
                            $totalQuantity = $row['TotalQuantity'];
                            if ($totalQuantity <= 10) {
                                $textColor = 'text-red-500';  // Warna merah untuk TotalQuantity <= 10
                            } elseif ($totalQuantity <= 50) {
                                $textColor = 'text-yellow-500';  // Warna kuning untuk TotalQuantity <= 50
                            } else {
                                $textColor = 'text-green-500';  // Warna hijau untuk TotalQuantity > 50
                            }
                        ?>
                            <div class="bg-white p-4 shadow-md rounded-md mb-4">
                                <div class="flex flex-row justify-between items-center">
                                    <div class="flex items-start">
                                        <img src="../static/image/products/<?php echo $row['ProductImage']; ?>" alt="<?php echo $row['ProductName']; ?>" class="h-32 w-32 object-cover rounded-full mr-4">
                                        <div>
                                            <h2 class="text-lg font-semibold text-gray-800"><?php echo $row['ProductName']; ?></h2>
                                            <p class="text-gray-600"><?php echo $row['Description']; ?></p>
                                            <p class="text-gray-600">Price: $<?php echo $row['Price']; ?></p>
                                            <div class="flex flex-row space-x-2">
                                                <div class="flex-col">
                                                    <p class="text-gray-600">
                                                        <i class="fas fa-folder"></i>
                                                        <?php echo $row['CategoryName']; ?>
                                                    </p>
                                                    <p class="text-gray-600">
                                                        <i class="fas fa-industry"></i>
                                                        <?php echo $row['BrandName']; ?>
                                                    </p>
                                                </div>
                                                <div class="mt-4">
                                                    <h3 class="text-lg font-semibold text-gray-800">Stock Details:</h3>
                                                    <?php
                                                    // Fetch stock details for the current product
                                                    $stockQuery = "SELECT sz.SizeName, clr.ColorName, st.Quantity
                                                        FROM Stocks st
                                                        LEFT JOIN Sizes sz ON st.SizeID = sz.SizeID
                                                        LEFT JOIN Colors clr ON st.ColorID = clr.ColorID
                                                        WHERE st.ProductID = {$row['ProductID']}";
                                                    $stockResult = $conn->query($stockQuery);

                                                    // Loop through stock details and display
                                                    while ($stockRow = $stockResult->fetch_assoc()) {
                                                        echo "<p class='text-gray-600'>Size: {$stockRow['SizeName']}, Color: {$stockRow['ColorName']}, Quantity: {$stockRow['Quantity']}</p>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='flex justify-end space-x-2 items-end flex-col space-y-2'>
                                        <div class="flex mt-2 justify-end space-x-2 items-end">
                                            <p class="text-7xl font-semibold <?php echo $textColor; ?>"><?php echo $row['TotalQuantity']; ?></p>
                                            <p class="text-xl font-semibold <?php echo $textColor; ?>">Qty</p>
                                        </div>
                                        <div>
                                            <a href="<?php echo $baseUrl; ?>public/manage_stocks/manage_stocks_in.php?id=<?php echo $row['ProductID'] ?>" class='bg-blue-500 hover-bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center text-sm'>
                                                <i class='fas fa-arrow-up mr-2'></i>
                                                <span>Stock In</span>
                                            </a>
                                            <a href="<?php echo $baseUrl; ?>public/manage_stocks/manage_stocks_out.php?id=<?php echo $row['ProductID'] ?>" class='bg-red-500 hover-bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center text-sm'>
                                                <i class='fas fa-arrow-down mr-2'></i>
                                                <span>Stock Out</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        if ($result->num_rows === 0) {
                        ?>
                            <p class="text-center text-gray-600">No data found.</p>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- End Stock List -->
                </div>
                <!-- End Content -->
                <!-- Include pagination -->
                <?php include('../components/pagination.php'); ?>
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