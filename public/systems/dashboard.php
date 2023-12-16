<?php
// Include the connection file
require_once('../../database/connection.php');

// Initialize variables
$username = $password = '';
$errors = array();
// Include auth.php
require_once('auth.php');

// Initialize variables

// Redirect if user is not logged in or doesn't have the required role
checkUserRole(1);
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

<?php include('../components/header.php'); ?>

<div class="h-screen flex flex-col">
    <!-- Top Navbar -->
    <?php include('../components/navbar.php'); ?>
    <!-- End Top Navbar -->
    <!-- Main Content -->
    <div class="bg-gray-50 flex flex-row shadow-md">
        <!-- Sidebar -->
        <?php include('../components/sidebar.php'); ?>
        <!-- End Sidebar -->
        <!-- Main Content -->
        <main class=" bg-gray-50 flex flex-col flex-1">
            <div class="flex items-start justify-start p-6 shadow-md m-4 flex-1 flex-col">
                <h1 class="text-3xl text-gray-800 font-semibold border-b border-gray-200 w-full">Dashboard</h1>
                <h2 class="text-xl text-gray-800 font-semibold">
                    Welcome back, <?php echo $_SESSION['FullName']; ?>!
                    <?php
                    if ($_SESSION['RoleID'] === 'admin') {
                        echo " (Admin)";
                    } elseif ($_SESSION['RoleID'] === 'student') {
                        echo " (Student)";
                    }
                    ?>
                </h2>
                <p class="text-gray-600">Here's what's happening with your projects today.</p>
                <!-- Grafik -->
                <main class="w-full bg-white p-4 overflow-y-auto max-h-screen">
                    <!-- Stock Levels Chart -->
                    <div class="mb-4">
                        <h2 class="text-xl text-gray-700 font-semibold mb-2">Stock Levels</h2>
                        <canvas id="stockChart" width="400" height="100"></canvas>
                    </div>

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