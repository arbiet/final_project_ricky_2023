<?php
session_start();

// Include the database connection
require_once('../../database/connection.php');
include_once('../components/header.php');

// Initialize variables
$brandName = $brandCountry = $brandWebsite = '';
$errors = array();

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input data
    $brandName = mysqli_real_escape_string($conn, $_POST['brand_name']);
    $brandCountry = mysqli_real_escape_string($conn, $_POST['brand_country']);
    $brandWebsite = mysqli_real_escape_string($conn, $_POST['brand_website']);

    // Check for errors
    if (empty($brandName)) {
        $errors['brand_name'] = "Brand Name is required.";
    }
    if (empty($brandCountry)) {
        $errors['brand_country'] = "Brand Country is required.";
    }
    if (empty($brandWebsite)) {
        $errors['brand_website'] = "Brand Website is required.";
    }

    // If there are no errors, insert the data into the database
    if (empty($errors)) {
        // Process file upload
        $targetDir = "../static/image/brands/";
        $targetFile = $targetDir . basename($_FILES["brand_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the image file is a actual image or fake image
        $check = getimagesize($_FILES["brand_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $errors['brand_image'] = "File is not an image.";
            $uploadOk = 0;
        }

        // Check if the file already exists
        if (file_exists($targetFile)) {
            $errors['brand_image'] = "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["brand_image"]["size"] > 500000) {
            $errors['brand_image'] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $errors['brand_image'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $errors['brand_image'] = "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["brand_image"]["tmp_name"], $targetFile)) {
                // Insert data into the 'Brands' table
                $query = "INSERT INTO Brands (BrandName, BrandImage, BrandCountry, BrandWebsite)
                          VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ssss", $brandName, $_FILES["brand_image"]["name"], $brandCountry, $brandWebsite);

                if ($stmt->execute()) {
                    // Brand creation successful
                    echo '<script>
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: "Brand created successfully.",
                            }).then(function() {
                                window.location.href = "manage_brands_list.php";
                            });
                          </script>';
                    exit();
                } else {
                    // Brand creation failed
                    $errors['db_error'] = "Brand creation failed.";

                    // Display error message
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Brands creation failed.",
                        });
                    </script>';
                }
            } else {
                $errors['brand_image'] = "Sorry, there was an error uploading your file.";
            }
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
                    <h1 class="text-3xl text-gray-800 font-semibold w-full">Create Category</h1>
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
                            <p class="text-gray-600 text-sm">Brands creation form.</p>
                        </div>
                    </div>
                    <!-- End Navigation -->
                    <!-- Brand Creation Form -->
                    <form action="" method="POST" enctype="multipart/form-data" class="flex flex-col w-full space-x-2">
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

                        <!-- Brand Image -->
                        <label for="brand_image" class="block font-semibold text-gray-800 mt-2 mb-2">Brand Image <span class="text-red-500">*</span></label>
                        <input type="file" id="brand_image" name="brand_image" accept="image/*">
                        <?php if (isset($errors['brand_image'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['brand_image']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Submit Button -->
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-4 text-center">
                            <i class="fas fa-check mr-2"></i>
                            <span>Create Brand</span>
                        </button>
                    </form>
                    <!-- End Brand Creation Form -->
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
