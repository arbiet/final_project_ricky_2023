<?php
session_start();

// Include the database connection
require_once('../../database/connection.php');
include_once('../components/header.php');

// Initialize variables
$brandID = $brandName = $brandCountry = $brandWebsite = '';
$errors = array();

// Retrieve the brand data to be updated (you might need to pass the brand ID to this page)
if (isset($_GET['id'])) {
    $brandID = mysqli_real_escape_string($conn, $_GET['id']);

    // Query to fetch the existing brand data
    $query = "SELECT * FROM Brands WHERE BrandID = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $brandID);
    $stmt->execute();
    $result = $stmt->get_result();
    $brand = $result->fetch_assoc();

    // Check if the brand exists
    if (!$brand) {
        // Brand not found, handle accordingly
        echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Brand not found.",
        }).then(function() {
            window.location.href = "manage_brands_list.php"; // Redirect to the brand list page or an error page
        });
        </script>';
        exit();
    } else {
        // Populate variables with existing brand data
        $brandName = $brand['BrandName'];
        $brandCountry = $brand['BrandCountry'];
        $brandWebsite = $brand['BrandWebsite'];
        // You can also retrieve other fields as needed
    }
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input data
    $brandName = mysqli_real_escape_string($conn, $_POST['brand_name']);
    $brandCountry = mysqli_real_escape_string($conn, $_POST['brand_country']);
    $brandWebsite = mysqli_real_escape_string($conn, $_POST['brand_website']);

    // Update brand data in the database
    $query = "UPDATE Brands 
              SET BrandName = ?, BrandCountry = ?, BrandWebsite = ?
              WHERE BrandID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $brandName, $brandCountry, $brandWebsite, $brandID);

    if ($stmt->execute()) {
        // Brand update successful
        $activityDescription = "Brand with BrandName: $brandName has been updated.";

        $currentUserID = $_SESSION['UserID'];
        // Assuming you have a function insertLogActivity, call it here
        insertLogActivity($conn, $currentUserID, $activityDescription);

        // Display success notification and redirect
        echo '<script>
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "Brand update successful.",
        }).then(function() {
            window.location.href = "manage_brands_list.php";
        });
    </script>';
        exit();
    } else {
        // Brand update failed
        $errors['db_error'] = "Brand update failed.";

        // Display error notification
        echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Brand update failed.",
        });
    </script>';
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
                    <h1 class="text-3xl text-gray-800 font-semibold w-full">Update Brand</h1>
                    <div class="flex flex-row justify-end items-center">
                        <a href="manage_brands_list.php" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center space-x-2">
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
                            <p class="text-gray-600 text-sm">Update brand information form.</p>
                        </div>
                    </div>
                    <!-- End Navigation -->
                    <!-- Brand Update Form -->
                    <form action="" method="POST" class="flex flex-col w-full space-x-2" enctype="multipart/form-data">
                        <!-- Brand Name -->
                        <label for="brand_name" class="block font-semibold text-gray-800 mt-2 mb-2">Brand Name <span class="text-red-500">*</span></label>
                        <input type="text" id="brand_name" name="brand_name" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600" placeholder="Brand Name" value="<?php echo $brandName; ?>">
                        <?php if (isset($errors['brand_name'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['brand_name']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Brand Country -->
                        <label for="brand_country" class="block font-semibold text-gray-800 mt-2 mb-2">Brand Country <span class="text-red-500">*</span></label>
                        <input type="text" id="brand_country" name="brand_country" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600" placeholder="Brand Country" value="<?php echo $brandCountry; ?>">
                        <?php if (isset($errors['brand_country'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['brand_country']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Brand Website -->
                        <label for="brand_website" class="block font-semibold text-gray-800 mt-2 mb-2">Brand Website <span class="text-red-500">*</span></label>
                        <input type="text" id="brand_website" name="brand_website" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600" placeholder="Brand Website" value="<?php echo $brandWebsite; ?>">
                        <?php if (isset($errors['brand_website'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['brand_website']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Brand Image Preview -->
                        <label for="brand_image" class="block font-semibold text-gray-800 mt-2 mb-2">Brand Image <span class="text-red-500">*</span></label>
                        <?php if ($brand['BrandImage']) : ?>
                            <img src="../static/image/brands/<?php echo $brand['BrandImage']; ?>" alt="Brand Image" class="mb-2 rounded border border-gray-300 w-40">
                        <?php endif; ?>
                        <input type="file" id="brand_image" name="brand_image" class="w-full border-gray-300 border p-2 mb-2">
                        <?php if (isset($errors['brand_image'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['brand_image']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Submit Button -->
                        <button type="submit" class="bg-green-500 hover-bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-4 text-center">
                            <i class="fas fa-check mr-2"></i>
                            <span>Update Brand</span>
                        </button>
                    </form>
                    <!-- End Brand Update Form -->
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
