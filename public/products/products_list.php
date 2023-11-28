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

// Fetch product data from the database
$productsPerPage = 10; // Number of products to display per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $productsPerPage;

$productQuery = "SELECT * FROM Products LIMIT $offset, $productsPerPage";
$productResult = mysqli_query($conn, $productQuery);

// Fetch total number of products for pagination
$totalProductsQuery = "SELECT COUNT(*) as total FROM Products";
$totalProductsResult = mysqli_query($conn, $totalProductsQuery);
$totalProducts = mysqli_fetch_assoc($totalProductsResult)['total'];

// Calculate total pages for pagination
$totalPages = ceil($totalProducts / $productsPerPage);
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
            <h1 class="text-3xl text-gray-800 font-semibold border-b border-gray-200 mb-4">Product List</h1>
            <!-- Content for Product List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php while ($product = mysqli_fetch_assoc($productResult)) : ?>
                    <div class="relative bg-white border rounded shadow-md p-4">
                        <img src="../static/image/products/<?php echo $product['ProductImage']; ?>" alt="<?php echo $product['ProductName']; ?>" class="w-full h-40 object-cover mb-4">
                        <h2 class="text-lg font-semibold mb-2"><?php echo $product['ProductName']; ?></h2>
                        <p class="text-gray-600 mb-2"><?php echo $product['Description']; ?></p>
                        <p class="text-gray-800 font-bold mb-2">$<?php echo $product['Price']; ?></p>

                        <!-- Ellipsis menu -->
                        <div class="absolute top-0 right-0 p-2 cursor-pointer" onmouseover="showDropdownMenu('dropdown-<?php echo $product['ProductID']; ?>')" onmouseout="hideDropdownMenu('dropdown-<?php echo $product['ProductID']; ?>')">
                            <i class="fa-solid fa-ellipsis text-lg"></i>
                            <!-- Dropdown menu for edit and delete options -->
                            <div id="dropdown-<?php echo $product['ProductID']; ?>" class="hidden bg-white border rounded shadow-md absolute right-0 mt-2" onmouseover="showDropdownMenu('dropdown-<?php echo $product['ProductID']; ?>')" onmouseout="hideDropdownMenu('dropdown-<?php echo $product['ProductID']; ?>')">
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-300">Edit</a>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-300">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <!-- Pagination -->
            <div class="mt-4 flex justify-center items-center space-x-2">
                <?php if ($page > 1) : ?>
                    <a href="?page=1" class="px-4 py-2 border rounded shadow-md hover:bg-gray-300 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-500">First</a>
                    <a href="?page=<?php echo $page - 1; ?>" class="px-4 py-2 border rounded shadow-md hover:bg-gray-300 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-500">Prev</a>
                <?php endif; ?>

                <?php for ($i = max(1, $page - 2); $i <= min($page + 2, $totalPages); $i++) : ?>
                    <a href="?page=<?php echo $i; ?>" class="px-4 py-2 border rounded shadow-md <?php echo ($page == $i) ? 'bg-blue-400 text-white' : 'hover:bg-gray-300 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-500'; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $totalPages) : ?>
                    <a href="?page=<?php echo $page + 1; ?>" class="px-4 py-2 border rounded shadow-md hover:bg-gray-300 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-500">Next</a>
                    <a href="?page=<?php echo $totalPages; ?>" class="px-4 py-2 border rounded shadow-md hover:bg-gray-300 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-500">Last</a>
                <?php endif; ?>
            </div>
            <!-- End Pagination -->
        </main>
        <!-- End Main Content -->
    </div>

    <!-- Footer -->
    <!-- End Footer -->
</div>

</body>
<script>
    function showDropdownMenu(menuId) {
        const dropdownMenu = document.getElementById(menuId);
        dropdownMenu.classList.remove("hidden");
    }

    function hideDropdownMenu(menuId) {
        const dropdownMenu = document.getElementById(menuId);
        dropdownMenu.classList.add("hidden");
    }
</script>

</html>