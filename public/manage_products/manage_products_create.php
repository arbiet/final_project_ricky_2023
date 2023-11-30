<?php
session_start();

// Include the database connection
require_once('../../database/connection.php');
include_once('../components/header.php');

// Initialize variables
$productName = $description = $price = $category = $brand = '';
$errors = array();

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input data
    $productName = mysqli_real_escape_string($conn, $_POST['product_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);

    // Check for errors
    if (empty($productName)) {
        $errors['product_name'] = "Product Name is required.";
    }
    if (empty($description)) {
        $errors['description'] = "Description is required.";
    }
    if (empty($price)) {
        $errors['price'] = "Price is required.";
    }
    if (empty($category)) {
        $errors['category'] = "Category is required.";
    }
    if (empty($brand)) {
        $errors['brand'] = "Brand is required.";
    }

    // If there are no errors, insert the data into the database
    if (empty($errors)) {
        // Upload product image
        $targetDir = "../static/image/products/";
        $uniqueFilename = uniqid() . '_' . basename($_FILES['product_image']['name']);
        $targetFile = $uploadDir . $uniqueFilename;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["product_image"]["tmp_name"]);
        if ($check === false) {
            $errors['product_image'] = "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["product_image"]["size"] > 500000) {
            $errors['product_image'] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedFormats)) {
            $errors['product_image'] = "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $errors['product_image'] = "Sorry, your file was not uploaded.";
        } else {
            // if everything is ok, try to upload file
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
                // Insert data into the 'Products' table
                $query = "INSERT INTO Products (ProductName, ProductImage, Description, Price, CategoryID, BrandID)
                          VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ssssss", $productName, $uniqueFilename, $description, $price, $category, $brand);

                if ($stmt->execute()) {
                    // Product creation successful
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Product created successfully.",
                        }).then(function() {
                            window.location.href = "manage_products_list.php";
                        });
                    </script>';
                    exit();
                } else {
                    // Product creation failed
                    $errors['db_error'] = "Product creation failed.";
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Product creation failed.",
                        });
                    </script>';
                }
            } else {
                $errors['product_image'] = "Sorry, there was an error uploading your file.";
            }
        }
    }
}
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
                    <h1 class="text-3xl text-gray-800 font-semibold w-full">Create Product</h1>
                    <div class="flex flex-row justify-end items-center">
                        <a href="manage_products_list.php" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center space-x-2">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
                <!-- End Header Content -->
                <!-- Content -->
                <div class="flex flex-col w-full">
                    <!-- Product Creation Form -->
                    <form action="" method="POST" enctype="multipart/form-data" class="flex flex-col w-full space-x-2">
                        <!-- Product Name -->
                        <label for="product_name" class="block font-semibold text-gray-800 mt-2 mb-2">Product Name <span class="text-red-500">*</span></label>
                        <input type="text" id="product_name" name="product_name" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600" placeholder="Product Name" value="<?php echo $productName; ?>">
                        <?php if (isset($errors['product_name'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['product_name']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Description -->
                        <label for="description" class="block font-semibold text-gray-800 mt-2 mb-2">Description <span class="text-red-500">*</span></label>
                        <textarea id="description" name="description" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600" placeholder="Description"><?php echo $description; ?></textarea>
                        <?php if (isset($errors['description'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['description']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Price -->
                        <label for="price" class="block font-semibold text-gray-800 mt-2 mb-2">Price <span class="text-red-500">*</span></label>
                        <input type="text" id="price" name="price" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600" placeholder="Price" value="<?php echo $price; ?>">
                        <?php if (isset($errors['price'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['price']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Product Image -->
                        <label for="product_image" class="block font-semibold text-gray-800 mt-2 mb-2">Product Image <span class="text-red-500">*</span></label>
                        <input type="file" id="product_image" name="product_image" class="w-full border-gray-300 px-2 py-2 border text-gray-600">
                        <?php if (isset($errors['product_image'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['product_image']; ?>
                            </p>
                        <?php endif; ?>

                        <?php
                        function getCategories($conn)
                        {
                            $categories = array();
                            $query = "SELECT CategoryID, CategoryName FROM Categories";
                            $result = $conn->query($query);

                            if (
                                $result->num_rows > 0
                            ) {
                                while ($row = $result->fetch_assoc()) {
                                    $categories[$row['CategoryID']] = $row['CategoryName'];
                                }
                            }

                            return $categories;
                        }

                        function getBrands($conn)
                        {
                            $brands = array();
                            $query = "SELECT BrandID, BrandName FROM Brands";
                            $result = $conn->query($query);

                            if (
                                $result->num_rows > 0
                            ) {
                                while ($row = $result->fetch_assoc()) {
                                    $brands[$row['BrandID']] = $row['BrandName'];
                                }
                            }

                            return $brands;
                        }
                        $categories = getCategories($conn);
                        $brands = getBrands($conn);
                        ?>

                        <!-- Category -->
                        <label for="category" class="block font-semibold text-gray-800 mt-2 mb-2">Category <span class="text-red-500">*</span></label>
                        <select id="category" name="category" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600">
                            <?php
                            foreach ($categories as $categoryId => $categoryName) {
                                echo "<option value=\"$categoryId\">$categoryName</option>";
                            }
                            ?>
                        </select>
                        <?php if (isset($errors['category'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['category']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Brand -->
                        <label for="brand" class="block font-semibold text-gray-800 mt-2 mb-2">Brand <span class="text-red-500">*</span></label>
                        <select id="brand" name="brand" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600">
                            <?php
                            foreach ($brands as $brandId => $brandName) {
                                echo "<option value=\"$brandId\">$brandName</option>";
                            }
                            ?>
                        </select>
                        <?php if (isset($errors['brand'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['brand']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Submit Button -->
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-4 text-center">
                            <i class="fas fa-check mr-2"></i>
                            <span>Create Product</span>
                        </button>
                    </form>
                    <!-- End Product Creation Form -->
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
