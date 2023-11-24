<?php
// Include the connection file
require_once('../../database/connection.php');

// Include the session handling logic
session_start();

// Redirect to login if the user is not logged in or is not a manager
if (!isset($_SESSION['UserID']) || !isset($_SESSION['RoleID']) || $_SESSION['RoleID'] != 2) {
    header("Location: login.php");
    exit();
}

// Include the header
include('../components/header.php');

// Fetch manager-specific information from the database
$managerID = $_SESSION['UserID'];

// Query to fetch manager-related information
$query = "SELECT * FROM Users WHERE UserID = $managerID";
$result = mysqli_query($conn, $query);
$managerInfo = mysqli_fetch_assoc($result);

// Fetch stock data from the database
$stockQuery = "SELECT Products.ProductName, Stocks.Quantity FROM Products
                JOIN Stocks ON Products.ProductID = Stocks.ProductID";
$stockResult = mysqli_query($conn, $stockQuery);

// Initialize arrays to store data for charts
$stockLabels = [];
$stockQuantityData = [];

// Populate arrays with data
while ($row = mysqli_fetch_assoc($stockResult)) {
    $stockLabels[] = $row['ProductName'];
    $stockQuantityData[] = $row['Quantity'];
}
// Fetch brand contribution data from the database
$brandContributionQuery = "SELECT Brands.BrandName, SUM(Stocks.Quantity) as TotalQuantity
                            FROM Brands
                            JOIN Products ON Brands.BrandID = Products.BrandID
                            JOIN Stocks ON Products.ProductID = Stocks.ProductID
                            GROUP BY Brands.BrandID";
$brandContributionResult = mysqli_query($conn, $brandContributionQuery);

// Initialize arrays to store data for Brand Contribution Chart
$brandLabels = [];
$brandQuantityData = [];

// Populate arrays with data
while ($row = mysqli_fetch_assoc($brandContributionResult)) {
    $brandLabels[] = $row['BrandName'];
    $brandQuantityData[] = $row['TotalQuantity'];
}
// Fetch category performance data from the database
$categoryPerformanceQuery = "SELECT Categories.CategoryName, SUM(Stocks.Quantity) as TotalQuantity
                              FROM Categories
                              JOIN Products ON Categories.CategoryID = Products.CategoryID
                              JOIN Stocks ON Products.ProductID = Stocks.ProductID
                              GROUP BY Categories.CategoryID";
$categoryPerformanceResult = mysqli_query($conn, $categoryPerformanceQuery);

// Initialize arrays to store data for Category Performance Chart
$categoryLabels = [];
$categoryQuantityData = [];

// Populate arrays with data
while ($row = mysqli_fetch_assoc($categoryPerformanceResult)) {
    $categoryLabels[] = $row['CategoryName'];
    $categoryQuantityData[] = $row['TotalQuantity'];
}
?>

<div class="container mx-auto p-4">
    <!-- Top Navbar -->
    <!-- End Top Navbar -->

    <div class="flex flex-row mt-4">
        <!-- Sidebar for User Information -->
        <div class="w-1/4 bg-white border rounded shadow-lg p-6">
            <!-- User Information -->
            <div class="flex items-center space-x-4 mb-6">
                <img src="../static/image/profile/<?php echo $managerInfo['ProfilePictureURL']; ?>" alt="Profile Picture" class="w-16 h-16 rounded-full">
                <div>
                    <p class="text-lg font-semibold"><?php echo $managerInfo['FullName']; ?></p>
                    <p class="text-gray-500"><?php echo $managerInfo['Email']; ?></p>
                    <p class="text-gray-500"><?php echo $managerInfo['PhoneNumber']; ?></p>
                </div>
            </div>

            <!-- Sidebar Menu with Icons (Font Awesome) -->
            <div class="space-y-4">
                <a href="#" class="flex items-center space-x-4 text-gray-800 hover:bg-gray-200 rounded-lg p-2">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-4 text-gray-800 hover:bg-gray-200 rounded-lg p-2">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Kelola Produk</span>
                </a>
                <a href="#" class="flex items-center space-x-4 text-gray-800 hover:bg-gray-200 rounded-lg p-2">
                    <i class="fas fa-box"></i>
                    <span>Kelola Stok</span>
                </a>
            </div>
            <!-- End Sidebar Menu -->

        </div>
        <!-- End Sidebar -->

        <!-- Main Content -->
        <main class="w-3/4 bg-white p-4">
            <!-- Content for Manager Dashboard -->
            <h1 class="text-3xl text-gray-800 font-semibold border-b border-gray-200 mb-4">Manager Dashboard</h1>

            <!-- Stock Levels Chart -->
            <div class="mb-4">
                <h2 class="text-xl text-gray-700 font-semibold mb-2">Stock Levels</h2>
                <canvas id="stockChart" width="400" height="100"></canvas>
            </div>

            <!-- Brand Contribution Chart -->
            <div class="mb-4">
                <h2 class="text-xl text-gray-700 font-semibold mb-2">Brand Contribution</h2>
                <canvas id="brandChart" width="400" height="200"></canvas>
            </div>

            <!-- Category Performance Chart -->
            <div class="mb-4">
                <h2 class="text-xl text-gray-700 font-semibold mb-2">Category Performance</h2>
                <canvas id="categoryChart" width="400" height="200"></canvas>
            </div>

            <!-- Transaction History Chart -->
            <div>
                <h2 class="text-xl text-gray-700 font-semibold mb-2">Transaction History</h2>
                <canvas id="transactionChart" width="400" height="200"></canvas>
            </div>
        </main>
        <!-- End Main Content -->
    </div>

    <!-- Footer -->

    <!-- End Footer -->
</div>

</body>
<script>
    // Stock Levels Chart
    var stockChartCanvas = document.getElementById('stockChart').getContext('2d');
    var stockChart = new Chart(stockChartCanvas, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($stockLabels); ?>,
            datasets: [{
                label: 'Stock Levels',
                data: <?php echo json_encode($stockQuantityData); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Brand Contribution Chart
    var brandChartCanvas = document.getElementById('brandChart').getContext('2d');
    var brandChart = new Chart(brandChartCanvas, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($brandLabels); ?>,
            datasets: [{
                label: 'Brand Contribution',
                data: <?php echo json_encode($brandQuantityData); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Category Performance Chart
    var categoryChartCanvas = document.getElementById('categoryChart').getContext('2d');
    var categoryChart = new Chart(categoryChartCanvas, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($categoryLabels); ?>,
            datasets: [{
                label: 'Category Performance',
                data: <?php echo json_encode($categoryQuantityData); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Transaction History Chart
    // ...
</script>

</html>