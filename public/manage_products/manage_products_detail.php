<?php
// Initialize the session
session_start();
// Include the connection file
require_once('../../database/connection.php');

// Initialize variables
$productID = '';
$errors = array();
$productData = array();

// Retrieve product data
if (isset($_GET['id'])) {
    $productID = $_GET['id'];
    $query = "SELECT p.ProductID, p.ProductName, p.ProductImage, p.Description, p.Price, p.CategoryID, p.BrandID, 
                      b.BrandName, b.BrandImage as BrandImage, c.CategoryName
              FROM Products p
              LEFT JOIN Brands b ON p.BrandID = b.BrandID
              LEFT JOIN Categories c ON p.CategoryID = c.CategoryID
              WHERE p.ProductID = $productID";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $productData = $result->fetch_assoc();
    } else {
        $errors[] = "Product not found.";
    }
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
        <main class="bg-gray-50 flex flex-col flex-1 overflow-y-scroll h-screen flex-shrink-0 sc-hide pb-40">
            <div class="flex items-start justify-start p-6 shadow-md m-4 flex-1 flex-col">
                <!-- Header Content -->
                <div class="flex flex-row justify-between items-center w-full border-b-2 border-gray-600 mb-2 pb-2">
                    <h1 class="text-3xl text-gray-800 font-semibold w-full">Product Details</h1>
                    <div class="flex flex-row justify-end items-center">
                        <a href="../manage_products/manage_products_list.php" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center space-x-2">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
                <!-- End Header Content -->
                <!-- Content -->
                <div class="flex flex-col w-full">
                    <!-- Product Details -->
                    <?php if (!empty($productData)) : ?>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white shadow-md p-4 rounded-md">
                                <h3 class="text-lg font-semibold text-gray-800">Product Information</h3>
                                <p><strong>Product Name:</strong> <?php echo $productData['ProductName']; ?></p>
                                <p><strong>Description:</strong> <?php echo $productData['Description']; ?></p>
                                <p><strong>Price:</strong> <?php echo $productData['Price']; ?></p>
                                <p><strong>Category:</strong> <?php echo $productData['CategoryName']; ?></p>
                            </div>
                            <div class="bg-white shadow-md p-4 rounded-md">
                                <h3 class="text-lg font-semibold text-gray-800">Brand Information</h3>
                                <p><strong>Brand Name:</strong> <?php echo $productData['BrandName']; ?></p>
                                <!-- Display Brand Image -->
                                <img src="../static/image/brands/<?php echo $productData['BrandImage']; ?>" alt="Brand Image" class="w-32 h-32 object-cover mt-2">
                            </div>
                        </div>
                        <!-- Display Product Image -->
                        <div class="mt-4">
                            <img src="../static/image/products/<?php echo $productData['ProductImage']; ?>" alt="Product Image" class="w-64 h-64 object-cover">
                        </div>
                    <?php else : ?>
                        <div class="bg-white shadow-md p-4 rounded-md">
                            <p>No product data available.</p>
                        </div>
                    <?php endif; ?>
                    <!-- End Product Details -->
                </div>
                <!-- End Content -->
            </div>
        </main>
    </div>

    <!-- End Main Content -->
    <!-- Footer -->
    <?php include('../components/footer.php'); ?>
    <!-- End Footer -->
</div>

</body>

</html>
