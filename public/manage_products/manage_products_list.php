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
                    <h1 class="text-3xl text-gray-800 font-semibol w-full">Products</h1>
                    <div class="flex flex-row justify-end items-center">
                        <a href="<?php echo $baseUrl; ?>public/manage_products/manage_products_create.php" class="bg-green-500 hover-bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            <span>Create</span>
                        </a>
                    </div>
                </div>
                <!-- End Header Content -->
                <!-- Content -->
                <div class="flex flex-col w-full">
                    <!-- Include Search Bar -->
                    <?php include('../components/search_manage.php'); ?>
                    <!-- Product List -->
                    <div class="grid grid-cols-1 gap-4">
                        <?php
                        // Fetch product data from the database
                        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $query = "SELECT p.*, c.CategoryName, b.BrandName FROM Products p
                                  INNER JOIN Categories c ON p.CategoryID = c.CategoryID
                                  INNER JOIN Brands b ON p.BrandID = b.BrandID
                                  WHERE p.ProductName LIKE '%$searchTerm%'
                                     OR p.ProductImage LIKE '%$searchTerm%'
                                     OR p.Description LIKE '%$searchTerm%'
                                     OR p.Price LIKE '%$searchTerm%'
                                     OR c.CategoryName LIKE '%$searchTerm%'
                                     OR b.BrandName LIKE '%$searchTerm%'
                                  LIMIT 10 OFFSET " . ($page - 1) * 10;
                        $result = $conn->query($query);

                        // Count total rows in the table
                        $queryCount = "SELECT COUNT(*) AS count FROM Products p
                                       INNER JOIN Categories c ON p.CategoryID = c.CategoryID
                                       INNER JOIN Brands b ON p.BrandID = b.BrandID
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
                        ?>
                            <div class="bg-white p-4 shadow-md rounded-md mb-4">
                                <div class="flex flex-row justify-between items-center">
                                    <div class="flex items-start">
                                        <img src="../static/image/products/<?php echo $row['ProductImage']; ?>" alt="<?php echo $row['ProductName']; ?>" class="h-32 w-32 object-cover rounded-full mr-4">
                                        <div>
                                            <h2 class="text-lg font-semibold text-gray-800"><?php echo $row['ProductName']; ?></h2>
                                            <p class="text-gray-600"><?php echo $row['Description']; ?></p>
                                            <p class="text-gray-600">Price: $<?php echo $row['Price']; ?></p>
                                            <p class="text-gray-600">
                                                <i class="fas fa-folder"></i>
                                                <?php echo $row['CategoryName']; ?>
                                            </p>
                                            <p class="text-gray-600">
                                                <i class="fas fa-industry"></i>
                                                <?php echo $row['BrandName']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class='flex justify-end space-x-2 items-end'>
                                        <a href="<?php echo $baseUrl; ?>public/manage_products/manage_products_detail.php?id=<?php echo $row['ProductID'] ?>" class='bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center text-sm'>
                                            <i class='fas fa-eye mr-2'></i>
                                            <span>Detail</span>
                                        </a>
                                        <a href="<?php echo $baseUrl; ?>public/manage_products/manage_products_update.php?id=<?php echo $row['ProductID'] ?>" class='bg-blue-500 hover-bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center text-sm'>
                                            <i class='fas fa-edit mr-2'></i>
                                            <span>Edit</span>
                                        </a>
                                        <button onclick="confirmDelete(<?php echo $row['ProductID']; ?>)" class='bg-red-500 hover-bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center text-sm'>
                                            <i class='fas fa-trash mr-2'></i>
                                            <span>Delete</span>
                                        </button>
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
                    <!-- End Product List -->
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
<script>
    // Function to show a confirmation dialog
    function confirmDelete(productID) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, redirect to the delete page
                window.location.href = `manage_products_delete.php?id=${productID}`;
            }
        });
    }
</script>
</body>

</html>
