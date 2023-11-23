<?php
session_start();

// Include the database connection
require_once('../../database/connection.php');
include_once('../components/header.php');

// Initialize variables
$colorID = $colorName = '';
$errors = array();

// Retrieve the color data to be updated (you might need to pass the color ID to this page)
if (isset($_GET['id'])) {
    $colorID = mysqli_real_escape_string($conn, $_GET['id']);

    // Query to fetch the existing color data
    $query = "SELECT * FROM Colors WHERE ColorID = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $colorID);
    $stmt->execute();
    $result = $stmt->get_result();
    $color = $result->fetch_assoc();

    // Check if the color exists
    if (!$color) {
        // Color not found, handle accordingly
        echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Color not found.",
        }).then(function() {
            window.location.href = "manage_colors_list.php"; // Redirect to the color list page or an error page
        });
        </script>';
        exit();
    } else {
        // Populate variables with existing color data
        $colorName = $color['ColorName'];
        // You can also retrieve other fields as needed
    }
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input data
    $colorName = mysqli_real_escape_string($conn, $_POST['color_name']);

    // Update color data in the database
    $query = "UPDATE Colors 
              SET ColorName = ? 
              WHERE ColorID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $colorName, $colorID);

    if ($stmt->execute()) {
        // Color update successful
        $activityDescription = "Color with ColorName: $colorName has been updated.";

        $currentUserID = $_SESSION['UserID'];
        // Assuming you have a function insertLogActivity, call it here
        // insertLogActivity($conn, $currentUserID, $activityDescription);

        // Display success notification and redirect
        echo '<script>
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "Color update successful.",
        }).then(function() {
            window.location.href = "manage_colors_list.php";
        });
    </script>';
        exit();
    } else {
        // Color update failed
        $errors['db_error'] = "Color update failed.";

        // Display error notification
        echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Color update failed.",
        });
    </script>';
    }
}

// Close the database connection
?>

<!-- Main Content Height Menyesuaikan Hasil Kurang dari Header dan Footer -->
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
                    <h1 class="text-3xl text-gray-800 font-semibold w-full">Update Color</h1>
                    <div class="flex flex-row justify-end items-center">
                        <a href="manage_colors_list.php" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center space-x-2">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
                <!-- End Header Content -->
                <!-- Content -->
                <div class="flex flex-col w-full">
                    <!-- Navigation -->
                    <div class="flex flex-row justify-between items-center w-full pb-2">
                        <div>
                            <h2 class="text-lg text-gray-800 font-semibold">Welcome back, <?php echo $_SESSION['FullName']; ?>!</h2>
                            <p class="text-gray-600 text-sm">Update color information form.</p>
                        </div>
                    </div>
                    <!-- End Navigation -->
                    <!-- Color Update Form -->
                    <form action="" method="POST" class="flex flex-col w-full space-x-2">
                        <!-- Color Name -->
                        <label for="color_name" class="block font-semibold text-gray-800 mt-2 mb-2">Color Name <span class="text-red-500">*</span></label>
                        <input type="text" id="color_name" name="color_name" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600" placeholder="Color Name" value="<?php echo $colorName; ?>">
                        <?php if (isset($errors['color_name'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['color_name']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Submit Button -->
                        <button type="submit" class="bg-green-500 hover-bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-4 text-center">
                            <i class="fas fa-check mr-2"></i>
                            <span>Update Color</span>
                        </button>
                    </form>
                    <!-- End Color Update Form -->
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
</body>

</html>