<?php
session_start();

// Include the database connection
require_once('../../database/connection.php');
include_once('../components/header.php');

// Initialize variables
$sizeID = $sizeName = $sizeCode = $wearType = $gender = '';
$errors = array();

// Retrieve the size data to be updated (you might need to pass the size ID to this page)
if (isset($_GET['id'])) {
    $sizeID = mysqli_real_escape_string($conn, $_GET['id']);

    // Query to fetch the existing size data
    $query = "SELECT * FROM Sizes WHERE SizeID = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $sizeID);
    $stmt->execute();
    $result = $stmt->get_result();
    $size = $result->fetch_assoc();

    // Check if the size exists
    if (!$size) {
        // Size not found, handle accordingly
        echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Size not found.",
        }).then(function() {
            window.location.href = "manage_sizes_list.php"; // Redirect to the size list page or an error page
        });
        </script>';
        exit();
    } else {
        // Populate variables with existing size data
        $sizeName = $size['SizeName'];
        $sizeCode = $size['SizeCode'];
        $wearType = $size['WearType'];
        $gender = $size['Gender'];
        // You can also retrieve other fields as needed
    }
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input data
    $sizeName = mysqli_real_escape_string($conn, $_POST['size_name']);
    $sizeCode = mysqli_real_escape_string($conn, $_POST['size_code']);
    $wearType = mysqli_real_escape_string($conn, $_POST['wear_type']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    // Update size data in the database
    $query = "UPDATE Sizes 
              SET SizeName = ?, SizeCode = ?, WearType = ?, Gender = ? 
              WHERE SizeID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $sizeName, $sizeCode, $wearType, $gender, $sizeID);

    if ($stmt->execute()) {
        // Size update successful
        $activityDescription = "Size with SizeName: $sizeName has been updated.";

        $currentUserID = $_SESSION['UserID'];
        insertLogActivity($conn, $currentUserID, $activityDescription);

        // Display success notification and redirect
        echo '<script>
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "Size update successful.",
        }).then(function() {
            window.location.href = "manage_sizes_list.php";
        });
    </script>';
        exit();
    } else {
        // Size update failed
        $errors['db_error'] = "Size update failed.";

        // Display error notification
        echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Size update failed.",
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
                    <h1 class="text-3xl text-gray-800 font-semibold w-full">Update Size</h1>
                    <div class="flex flex-row justify-end items-center">
                        <a href="manage_sizes_list.php" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center space-x-2">
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
                            <p class="text-gray-600 text-sm">Update size information form.</p>
                        </div>
                    </div>
                    <!-- End Navigation -->
                    <!-- Size Update Form -->
                    <form action="" method="POST" class="flex flex-col w-full space-x-2">
                        <!-- Size Name -->
                        <label for="size_name" class="block font-semibold text-gray-800 mt-2 mb-2">Size Name <span class="text-red-500">*</span></label>
                        <input type="text" id="size_name" name="size_name" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600" placeholder="Size Name" value="<?php echo $sizeName; ?>">
                        <?php if (isset($errors['size_name'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['size_name']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Size Code -->
                        <label for="size_code" class="block font-semibold text-gray-800 mt-2 mb-2">Size Code <span class="text-red-500">*</span></label>
                        <input type="text" id="size_code" name="size_code" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600" placeholder="Size Code" value="<?php echo $sizeCode; ?>">
                        <?php if (isset($errors['size_code'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['size_code']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Wear Type -->
                        <label for="wear_type" class="block font-semibold text-gray-800 mt-2 mb-2">Wear Type</label>
                        <input type="text" id="wear_type" name="wear_type" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600" placeholder="Wear Type" value="<?php echo $wearType; ?>">

                        <!-- Gender -->
                        <label for="gender" class="block font-semibold text-gray-800 mt-2 mb-2">Gender</label>
                        <select id="gender" name="gender" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600">
                            <option value="Male" <?php if ($gender === 'Male') echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if ($gender === 'Female') echo 'selected'; ?>>Female</option>
                        </select>

                        <!-- Submit Button -->
                        <button type="submit" class="bg-green-500 hover-bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-4 text-center">
                            <i class="fas fa-check mr-2"></i>
                            <span>Update Size</span>
                        </button>
                    </form>
                    <!-- End Size Update Form -->
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