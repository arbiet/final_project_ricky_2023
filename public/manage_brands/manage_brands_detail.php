<?php
// Initialize the session
session_start();
// Include the connection file
require_once('../../database/connection.php');

// Initialize variables
$brandID = '';
$errors = array();

// Retrieve brand data
if (isset($_GET['id'])) {
    $brandID = $_GET['id'];
    $query = "SELECT * FROM Brands WHERE BrandID = $brandID";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $brandData = $result->fetch_assoc();
    } else {
        $errors[] = "Brand not found.";
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
        <!-- Main Content -->
        <main class="bg-gray-50 flex flex-col flex-1 overflow-y-scroll h-screen flex-shrink-0 sc-hide pb-40">
            <div class="flex items-start justify-start p-6 shadow-md m-4 flex-1 flex-col">
                <!-- Header Content -->
                <div class="flex flex-row justify-between items-center w-full border-b-2 border-gray-600 mb-2 pb-2">
                    <h1 class="text-3xl text-gray-800 font-semibol w-full">Brand Details</h1>
                    <div class="flex flex-row justify-end items-center">
                        <a href="<?php echo $baseUrl; ?>public/manage_brands/manage_brands_list.php" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center space-x-2">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
                <!-- End Header Content -->
                <!-- Content -->
                <div class="flex flex-col w-full">
                    <?php if (!empty($brandData)) : ?>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white p-4 shadow-md rounded-md">
                                <h3 class="text-lg font-semibold text-gray-800">Brand Information</h3>
                                <p><strong>Brand Name:</strong> <?php echo $brandData['BrandName']; ?></p>
                                <p><strong>Country:</strong> <?php echo $brandData['BrandCountry']; ?></p>
                                <p><strong>Website:</strong> <a href="<?php echo $brandData['BrandWebsite']; ?>" target="_blank" class="text-blue-500 hover:underline"><?php echo $brandData['BrandWebsite']; ?></a></p>
                                <div class="mt-4">
                                    <a href="manage_brands_update.php?id=<?php echo $brandID; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mr-2">
                                        <i class="fas fa-edit mr-2"></i>
                                        <span>Edit</span>
                                    </a>
                                    <a href="#" onclick="confirmDelete(<?php echo $brandID; ?>)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                        <i class="fas fa-trash mr-2"></i>
                                        <span>Delete</span>
                                    </a>
                                </div>
                            </div>
                            <div class="bg-white p-4 shadow-md rounded-md">
                                <h3 class="text-lg font-semibold text-gray-800">Brand Image</h3>
                                <img src="../static/image/brands/<?php echo $brandData['BrandImage']; ?>" alt="<?php echo $brandData['BrandName']; ?>" class="w-40">
                            </div>
                        </div>
                        
                    <?php else : ?>
                        <div class="bg-white p-4 shadow-md rounded-md">
                            <p>No brand data available.</p>
                        </div>
                    <?php endif; ?>
                </div>
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
<?php include_once('../components/scripts.php'); ?>
</body>
<script>
    // Function to show a confirmation dialog
    function confirmDelete(brandID) {
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
                window.location.href = `manage_brands_delete.php?id=${brandID}`;
            }
        });
    }
</script>
</html>
