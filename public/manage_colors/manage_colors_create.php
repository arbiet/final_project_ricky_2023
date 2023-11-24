<?php
session_start();

// Include the database connection
require_once('../../database/connection.php');
include_once('../components/header.php');

// Initialize variables
$color_name = '';
$errors = array();

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input data
    $color_name = mysqli_real_escape_string($conn, $_POST['color_name']);

    // Check for errors
    if (empty($color_name)) {
        $errors['color_name'] = "Color Name is required.";
    }

    // If there are no errors, insert the data into the database
    if (empty($errors)) {
        $query = "INSERT INTO Colors (ColorName) VALUES (?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $color_name);

        if ($stmt->execute()) {
            // Color creation successful
            $activityDescription = "Color with Name: $color_name has been created.";

            $currentUserID = $_SESSION['UserID'];
            insertLogActivity($conn, $currentUserID, $activityDescription);

            // Display success message
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Color created successfully.",
                }).then(function() {
                    window.location.href = "manage_colors_list.php";
                });
            </script>';
            exit();
        } else {
            // Color creation failed
            $errors['db_error'] = "Color creation failed.";

            // Display error message
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Color creation failed.",
                });
            </script>';
        }
    }
}

// Close the database connection
?>


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
                    <h1 class="text-3xl text-gray-800 font-semibold w-full">Create Color</h1>
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
                            <p class="text-gray-600 text-sm">Color creation form.</p>
                        </div>
                    </div>
                    <!-- End Navigation -->
                    <!-- Color Creation Form -->
                    <form action="" method="POST" class="flex flex-col w-full space-x-2">
                        <!-- Color Name -->
                        <label for="color_name" class="block font-semibold text-gray-800 mt-2 mb-2">Color Name <span class="text-red-500">*</span></label>
                        <input type="text" id="color_name" name="color_name" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600" placeholder="Color Name" value="<?php echo $color_name; ?>">
                        <?php if (isset($errors['color_name'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['color_name']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Submit Button -->
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-4 text-center">
                            <i class="fas fa-check mr-2"></i>
                            <span>Create Color</span>
                        </button>
                    </form>
                    <!-- End Color Creation Form -->
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