<?php
// Initialize the session
session_start();
// Include the connection file
require_once('../../database/connection.php');

// Initialize variables
$colorID = ''; // Initialize with the specific color's ID you want to display
$errors = array();
$colorData = array();

// Retrieve color data
if (isset($_GET['id'])) {
    $colorID = $_GET['id'];
    $query = "SELECT * FROM Colors WHERE ColorID = $colorID";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $colorData = $result->fetch_assoc();
    } else {
        $errors[] = "Color not found.";
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
                    <h1 class="text-3xl text-gray-800 font-semibold w-full">Color Details</h1>
                    <div class="flex flex-row justify-end items-center">
                        <a href="../manage_colors/manage_colors_list.php" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center space-x-2">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
                <!-- End Header Content -->
                <!-- Content -->
                <div class="flex flex-col w-full">
                    <!-- Navigation -->
                    <div class="flex flex-row justify-between items-center w-full mb-2 pb-2">
                        <div>
                            <h2 class="text-lg text-gray-800 font-semibold">Welcome back, <?php echo $_SESSION['FullName']; ?>!</h2>
                            <p class="text-gray-600 text-sm">Color information.</p>
                        </div>
                    </div>
                    <!-- End Navigation -->
                    <!-- Color Details -->
                    <?php if (!empty($colorData)) : ?>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white shadow-md p-4 rounded-md">
                                <h3 class="text-lg font-semibold text-gray-800">Color Information</h3>
                                <p><strong>Color Name:</strong> <?php echo $colorData['ColorName']; ?></p>
                            </div>
                        </div>
                        <!-- Add Edit and Delete Buttons -->
                        <div class="mt-4">
                            <a href="manage_colors_update.php?id=<?php echo $colorID; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mr-2">
                                <i class="fas fa-edit mr-2"></i>
                                <span>Edit</span>
                            </a>
                            <a href="#" onclick="confirmDelete(<?php echo $colorID; ?>)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                <i class="fas fa-trash mr-2"></i>
                                <span>Delete</span>
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="bg-white shadow-md p-4 rounded-md">
                            <p>No color data available.</p>
                        </div>
                    <?php endif; ?>
                    <!-- End Color Details -->
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

<script>
    // Function to show a confirmation dialog
    function confirmDelete(colorID) {
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
                window.location.href = `manage_colors_delete.php?id=${colorID}`;
            }
        });
    }
</script>
</body>

</html>