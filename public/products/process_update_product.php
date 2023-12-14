<?php
// Include the connection file
require_once('../../database/connection.php');

// Include the session handling logic
session_start();

// Redirect to login if the user is not logged in or is not a manager
if (!isset($_SESSION['UserID']) || !isset($_SESSION['RoleID']) || $_SESSION['RoleID'] != 2) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch data from the form
    $productId = mysqli_real_escape_string($conn, $_POST['product_id']);
    $productName = mysqli_real_escape_string($conn, $_POST['productName']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $categoryID = mysqli_real_escape_string($conn, $_POST['category']);
    $brandID = mysqli_real_escape_string($conn, $_POST['brand']);

    // File upload handling
    if (!empty($_FILES["productImage"]["name"])) {
        $targetDir = "../static/image/product/";
        $timestamp = time();
        $targetFile = $targetDir . $timestamp . '_' . basename($_FILES["productImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["productImage"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["productImage"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload file
            if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
                // Update product data with the new image URL
                $updateQuery = "UPDATE Products SET
                                ProductName = '$productName',
                                Description = '$description',
                                Price = '$price',
                                CategoryID = '$categoryID',
                                BrandID = '$brandID',
                                ImageURL = '$targetFile'
                                WHERE ProductID = '$productId'";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // Update product data without changing the image URL
        $updateQuery = "UPDATE Products SET
                        ProductName = '$productName',
                        Description = '$description',
                        Price = '$price',
                        CategoryID = '$categoryID',
                        BrandID = '$brandID'
                        WHERE ProductID = '$productId'";
    }

    // Execute the update query
    if (mysqli_query($conn, $updateQuery)) {
        echo "Product updated successfully.";
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }
} else {
    // Redirect if accessed directly without a POST request
    header("Location: products_list.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
