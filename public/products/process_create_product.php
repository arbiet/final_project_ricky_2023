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
    $productName = mysqli_real_escape_string($conn, $_POST['productName']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $categoryID = mysqli_real_escape_string($conn, $_POST['category']);
    $brandID = mysqli_real_escape_string($conn, $_POST['brand']);

    // File upload handling
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

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, a file with the same name already exists.";
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
            // Insert product data into the database
            $query = "INSERT INTO Products (ProductName, Description, Price, CategoryID, BrandID, ImageURL)
                      VALUES ('$productName', '$description', '$price', '$categoryID', '$brandID', '$targetFile')";

            if (mysqli_query($conn, $query)) {
                echo "Product created successfully.";
                header("Location: products_list.php");
            } else {
                echo "Error creating product: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    // Redirect if accessed directly without a POST request
    header("Location: products_create.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
