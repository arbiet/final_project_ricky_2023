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
$query = "SELECT * FROM Users WHERE UserID = $managerID";
$result = mysqli_query($conn, $query);
$managerInfo = mysqli_fetch_assoc($result);

// Fetch categories and brands for dropdowns
$categoriesQuery = "SELECT * FROM Categories";
$categoriesResult = mysqli_query($conn, $categoriesQuery);

$brandsQuery = "SELECT * FROM Brands";
$brandsResult = mysqli_query($conn, $brandsQuery);

// Fetch product information for the update form
if (isset($_GET['product_id'])) {
    $productId = mysqli_real_escape_string($conn, $_GET['product_id']);
    $productQuery = "SELECT * FROM Products WHERE ProductID = $productId";
    $productResult = mysqli_query($conn, $productQuery);
    $productData = mysqli_fetch_assoc($productResult);
} else {
    // Redirect if product ID is not provided
    header("Location: products_list.php");
    exit();
}
?>

<div class="container mx-auto p-4">
    <!-- Top Navbar -->
    <!-- End Top Navbar -->
    <div class="flex flex-col sm:flex-row mt-4">
        <!-- Sidebar for User Information -->
        <div class="w-full sm:w-1/4 bg-white border rounded shadow-lg p-6 mb-4 sm:mr-4 h-min">
            <!-- User Information -->
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
                    <h1 class="text-3xl text-gray-800 font-semibold border-gray-200 mb-4">Update Product</h1>
                </div>
                <div class="flex flex-row justify-end items-center">
                    <a href="<?php echo $baseUrl; ?>public/products/products_list.php" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center space-x-2">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back</span>
                    </a>
                </div>
            </div>
            <!-- End Main Header -->
            <!-- Content for Product Update Form -->
            <div class="max-w-lg mx-auto mt-4">
                <form action="process_update_product.php" method="POST" enctype="multipart/form-data">
                    <!-- Include a hidden input field for the product ID -->
                    <input type="hidden" name="product_id" value="<?php echo $productData['ProductID']; ?>">

                    <div class="mb-4">
                        <label for="productName" class="block text-gray-800 font-bold">Product Name:</label>
                        <input type="text" id="productName" name="productName" class="border p-2 w-full" value="<?php echo $productData['ProductName']; ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="productImage" class="block text-gray-800 font-bold">Product Image:</label>
                        <input type="file" id="productImage" name="productImage" accept="image/*" class="border p-2 w-full">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-800 font-bold">Description:</label>
                        <textarea id="description" name="description" class="border p-2 w-full" rows="3"><?php echo $productData['Description']; ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block text-gray-800 font-bold">Price:</label>
                        <input type="text" id="price" name="price" class="border p-2 w-full" value="<?php echo $productData['Price']; ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="category" class="block text-gray-800 font-bold">Category:</label>
                        <select id="category" name="category" class="border p-2 w-full" required>
                            <?php while ($category = mysqli_fetch_assoc($categoriesResult)) : ?>
                                <option value="<?php echo $category['CategoryID']; ?>" <?php echo ($productData['CategoryID'] == $category['CategoryID']) ? 'selected' : ''; ?>><?php echo $category['CategoryName']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="brand" class="block text-gray-800 font-bold">Brand:</label>
                        <select id="brand" name="brand" class="border p-2 w-full" required>
                            <?php while ($brand = mysqli_fetch_assoc($brandsResult)) : ?>
                                <option value="<?php echo $brand['BrandID']; ?>" <?php echo ($productData['BrandID'] == $brand['BrandID']) ? 'selected' : ''; ?>><?php echo $brand['BrandName']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                            <span>Update Product</span>
                        </button>
                    </div>
                </form>
            </div>
        </main>
        <!-- End Main Content -->
    </div>

    <!-- Footer -->
    <!-- End Footer -->
</div>

</body>
</html>
