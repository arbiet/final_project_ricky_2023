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

?>

<div class="container mx-auto p-4">
    <!-- Top Navbar -->
    <!-- End Top Navbar -->
    <div class="flex flex-col sm:flex-row mt-4">
        <!-- Sidebar for User Information -->
        <div class="w-full sm:w-1/4 bg-white border rounded shadow-lg p-6 mb-4 sm:mr-4 h-min">
            <!-- User Information -->
            <div class="flex items-center space-x-4 mb-6 ">
                <img src="../static/image/profile/<?php echo $managerInfo['ProfilePictureURL']; ?>" alt="Profile Picture" class="w-16 h-16 rounded-full">
                <div>
                    <p class="text-lg font-semibold"><?php echo $managerInfo['FullName']; ?></p>
                    <p class="text-gray-500"><?php echo $managerInfo['Email']; ?></p>
                    <p class="text-gray-500"><?php echo $managerInfo['PhoneNumber']; ?></p>
                </div>
            </div>
            <?php include_once('../components/sidebar_manager.php'); ?>
        </div>
        <!-- End Sidebar -->

        <!-- Main Content -->
        <main class="w-full sm:w-3/4 bg-white p-4 overflow-y-auto max-h-screen pb-40">
            <!-- Main Header -->
            <div class="flex justify-between items-center mb-4 border-b">
                <div class="flex items-center space-x-2">
                    <h1 class="text-3xl text-gray-800 font-semibold border-gray-200 mb-4">Restock</h1>
                </div>
            </div>
            <!-- End Main Header -->

            <!-- Display MonthlyProductStockTests Table -->
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Monthly Product Stock Tests</h2>
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Product</th>
                            <th class="py-2 px-4 border-b">Color</th>
                            <th class="py-2 px-4 border-b">Brand</th>
                            <th class="py-2 px-4 border-b">Size</th>
                            <th class="py-2 px-4 border-b">Total Stock In</th>
                            <th class="py-2 px-4 border-b">Total Stock Out</th>
                            <th class="py-2 px-4 border-b">Remaining Stock</th>
                            <th class="py-2 px-4 border-b">Restock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch data from MonthlyProductStockTests table with relationships
                        $query = "SELECT m.*, p.ProductName, c.ColorName, b.BrandName, size.SizeName
                                FROM MonthlyProductStockTests m
                                JOIN Products p ON m.ProductID = p.ProductID
                                JOIN Stocks s ON m.StockID = s.StockID
                                JOIN Colors c ON m.ColorID = c.ColorID
                                JOIN Brands b ON m.BrandID = b.BrandID
                                JOIN Sizes size ON m.SizeID = size.SizeID";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $truncatedProductName = substr($row['ProductName'], 0, 15);
                            echo "<tr>";
                            // echo "<td class='py-2 px-4 border-b'>{$truncatedProductName}</td>";
                            echo "<td class='py-2 px-4 border-b'>{$row['ProductName']}</td>";
                            echo "<td class='py-2 px-4 border-b'>{$row['ColorName']}</td>";
                            echo "<td class='py-2 px-4 border-b'>{$row['BrandName']}</td>";
                            echo "<td class='py-2 px-4 border-b'>{$row['SizeName']}</td>";
                            echo "<td class='py-2 px-4 border-b'>{$row['TotalStockIn']}</td>";
                            echo "<td class='py-2 px-4 border-b'>{$row['TotalStockOut']}</td>";
                            echo "<td class='py-2 px-4 border-b'>{$row['RemainingStock']}</td>";
                            
                            // Display 'Restock' if NaiveBayesPrediction is 1, 'No Restock' otherwise
                            $restockStatus = ($row['NaiveBayesPrediction'] == 1) ? 'Restock' : 'No Restock';
                            echo "<td class='py-2 px-4 border-b'>$restockStatus</td>";

                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- End MonthlyProductStockTests Table -->
        </main>
        <!-- End Main Content -->
    </div>
    <!-- Footer -->
    <!-- End Footer -->
</div>

</body>

</html>