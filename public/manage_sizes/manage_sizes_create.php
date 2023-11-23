<?php
session_start();

// Include the database connection
require_once('../../database/connection.php');
include_once('../components/header.php');

// Initialize variables
$size_name = $size_code = $wear_type = $gender = '';
$errors = array();

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input data
    $size_name = mysqli_real_escape_string($conn, $_POST['size_name']);
    $size_code = mysqli_real_escape_string($conn, $_POST['size_code']);
    $wear_type = mysqli_real_escape_string($conn, $_POST['wear_type']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    // Check for errors
    if (empty($size_name)) {
        $errors['size_name'] = "Size Name is required.";
    }
    if (empty($size_code)) {
        $errors['size_code'] = "Size Code is required.";
    }
    if (empty($wear_type)) {
        $errors['wear_type'] = "Wear Type is required.";
    }
    if (empty($gender)) {
        $errors['gender'] = "Gender is required.";
    }

    // If there are no errors, insert the data into the database
    if (empty($errors)) {
        $query = "INSERT INTO Sizes (SizeName, SizeCode, WearType, Gender) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $size_name, $size_code, $wear_type, $gender);

        if ($stmt->execute()) {
            // Size creation successful
            $activityDescription = "Size with Name: $size_name, Code: $size_code, Wear Type: $wear_type, Gender: $gender has been created.";

            $currentUserID = $_SESSION['UserID'];
            insertLogActivity($conn, $currentUserID, $activityDescription);

            // Display success message
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Size created successfully.",
                }).then(function() {
                    window.location.href = "manage_sizes_list.php";
                });
            </script>';
            exit();
        } else {
            // Size creation failed
            $errors['db_error'] = "Size creation failed.";

            // Display error message
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Size creation failed.",
                });
            </script>';
        }
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
                    <h1 class="text-3xl text-gray-800 font-semibold w-full">Create Size</h1>
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
                            <p class="text-gray-600 text-sm">Size creation form.</p>
                        </div>
                    </div>
                    <!-- End Navigation -->
                    <!-- Size Creation Form -->
                    <form action="" method="POST" class="flex flex-col w-full space-x-2">
                        <!-- Size Name -->
                        <label for="size_name" class="block font-semibold text-gray-800 mt-2 mb-2">Size Name <span class="text-red-500">*</span></label>
                        <input type="text" id="size_name" name="size_name" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600" placeholder="Size Name" value="<?php echo $size_name; ?>">
                        <?php if (isset($errors['size_name'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['size_name']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Size Code -->
                        <label for="size_code" class="block font-semibold text-gray-800 mt-2 mb-2">Size Code <span class="text-red-500">*</span></label>
                        <input type="text" id="size_code" name="size_code" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600" placeholder="Size Code" value="<?php echo $size_code; ?>">
                        <?php if (isset($errors['size_code'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['size_code']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Wear Type -->
                        <label for="wear_type" class="block font-semibold text-gray-800 mt-2 mb-2">Wear Type <span class="text-red-500">*</span></label>
                        <input type="text" id="wear_type" name="wear_type" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600" placeholder="Wear Type" value="<?php echo $wear_type; ?>">
                        <?php if (isset($errors['wear_type'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['wear_type']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Gender -->
                        <label for="gender" class="block font-semibold text-gray-800 mt-2 mb-2">Gender <span class="text-red-500">*</span></label>
                        <select id="gender" name="gender" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600">
                            <option value="Male" <?php if ($gender === 'Male') echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if ($gender === 'Female') echo 'selected'; ?>>Female</option>
                            <option value="Unisex" <?php if ($gender === 'Unisex') echo 'selected'; ?>>Unisex</option>
                        </select>
                        <?php if (isset($errors['gender'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['gender']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Submit Button -->
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-4 text-center">
                            <i class="fas fa-check mr-2"></i>
                            <span>Create Size</span>
                        </button>
                    </form>
                    <!-- End Size Creation Form -->
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