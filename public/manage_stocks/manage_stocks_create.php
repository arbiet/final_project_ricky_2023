<?php
session_start();

// Include the database connection
require_once('../../database/connection.php');
include_once('../components/header.php');

// Initialize variables
$productID = $sizeIDs = $colorIDs = $quantities = '';
$errors = array();
$successMessage = '';

// Fetch product data for dropdown
$productQuery = "SELECT ProductID, ProductName FROM Products";
$productResult = $conn->query($productQuery);

// Fetch size options from the database
$sizeQuery = "SELECT SizeID, SizeName FROM Sizes";
$sizeResult = $conn->query($sizeQuery);
$sizeOptions = '';

while ($sizeRow = $sizeResult->fetch_assoc()) {
    $sizeOptions .= "<option value='{$sizeRow['SizeID']}'>{$sizeRow['SizeName']}</option>";
}

// Fetch color options from the database
$colorQuery = "SELECT ColorID, ColorName FROM Colors";
$colorResult = $conn->query($colorQuery);
$colorOptions = '';

while ($colorRow = $colorResult->fetch_assoc()) {
    $colorOptions .= "<option value='{$colorRow['ColorID']}'>{$colorRow['ColorName']}</option>";
}

// Reset the internal pointer of $productResult
$productResult->data_seek(0);

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input data
    $productID = mysqli_real_escape_string($conn, $_POST['product_id']);
    $sizeIDs = $_POST['size_id'];
    $colorIDs = $_POST['color_id'];
    $quantities = $_POST['quantity'];

    // Check for errors
    if (empty($productID)) {
        $errors['product_id'] = "Product is required.";
    }
    if (empty($sizeIDs) || empty($colorIDs) || empty($quantities)) {
        $errors['stock_details'] = "Size, Color, and Quantity are required for each stock.";
    }

    // If there are no errors, insert or update the data into the database
    if (empty($errors)) {
        // Loop through the arrays to process each stock
        foreach ($sizeIDs as $key => $sizeID) {
            $colorID = $colorIDs[$key];
            $quantity = $quantities[$key];

            // Check if the stock already exists for the product with the given size and color
            $checkStockQuery = "SELECT StockID FROM Stocks WHERE ProductID = ? AND SizeID = ? AND ColorID = ?";
            $checkStockStmt = $conn->prepare($checkStockQuery);
            $checkStockStmt->bind_param("iii", $productID, $sizeID, $colorID);
            $checkStockStmt->execute();
            $checkStockResult = $checkStockStmt->get_result();

            if ($checkStockResult->num_rows > 0) {
                // Stock exists, update the quantity
                $updateStockQuery = "UPDATE Stocks SET Quantity = Quantity + ? WHERE ProductID = ? AND SizeID = ? AND ColorID = ?";
                $updateStockStmt = $conn->prepare($updateStockQuery);
                $updateStockStmt->bind_param("iiii", $quantity, $productID, $sizeID, $colorID);

                if ($updateStockStmt->execute()) {
                    // Stock update successful
                    $successMessage .= "Stock updated successfully for ProductID: $productID, SizeID: $sizeID, ColorID: $colorID<br>";
                } else {
                    // Stock update failed
                    $errors['db_error'] = "Stock update failed.";
                }
            } else {
                // Stock does not exist, insert new stock
                $insertStockQuery = "INSERT INTO Stocks (ProductID, SizeID, ColorID, Quantity) VALUES (?, ?, ?, ?)";
                $insertStockStmt = $conn->prepare($insertStockQuery);
                $insertStockStmt->bind_param("iiii", $productID, $sizeID, $colorID, $quantity);

                if ($insertStockStmt->execute()) {
                    // Stock insertion successful
                    $successMessage .= "Stock created successfully for ProductID: $productID, SizeID: $sizeID, ColorID: $colorID<br>";
                } else {
                    // Stock insertion failed
                    $errors['db_error'] = "Stock creation failed.";
                }
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
                    <h1 class="text-3xl text-gray-800 font-semibold w-full">Create Stock</h1>
                    <div class="flex flex-row justify-end items-center">
                        <a href="manage_stocks_list.php" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center space-x-2">
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
                            <p class="text-gray-600 text-sm">Stock creation form.</p>
                        </div>
                    </div>
                    <!-- End Navigation -->
                    <!-- Stock Creation Form -->
                    <form action="" method="POST" class="flex flex-col w-full space-x-2" id="stockForm">
                        <!-- Product Dropdown -->
                        <label for="product_id" class="block font-semibold text-gray-800 mt-2 mb-2">Product <span class="text-red-500">*</span></label>
                        <select id="product_id" name="product_id" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600">
                            <option value="">Select Product</option>
                            <?php
                            while ($productRow = $productResult->fetch_assoc()) {
                                echo "<option value='{$productRow['ProductID']}'>{$productRow['ProductName']}</option>";
                            }
                            ?>
                        </select>
                        <?php if (isset($errors['product_id'])) : ?>
                            <p class="text-red-500 text-sm">
                                <?php echo $errors['product_id']; ?>
                            </p>
                        <?php endif; ?>

                        <!-- Stock Details Section -->
                        <div id="stockDetails">
                            <!-- JavaScript will dynamically add stock fields here -->
                        </div>

                        <!-- Add Stock Button -->
                        <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-4 text-center" onclick="addStockField()">
                            <i class="fas fa-plus mr-2"></i>
                            <span>Add Stock</span>
                        </button>

                        <!-- Submit Button -->
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-4 text-center">
                            <i class="fas fa-check mr-2"></i>
                            <span>Create Stock</span>
                        </button>
                    </form>
                    <!-- End Stock Creation Form -->
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

<!-- Updated JavaScript for dynamically adding stock fields with numbered labels -->
<script>
    var stockIndex = 0;

    function addStockField() {
        // Increment the stock index
        stockIndex++;

        // Create new stock fields with numbered labels
        var stockFields = `
            <div class="mt-4" id="stockSize${stockIndex}">
                <!-- Size Dropdown -->
                <label for="size_id_${stockIndex}" class="block font-semibold text-gray-800 mt-2 mb-2">Size ${stockIndex} <span class="text-red-500">*</span></label>
                <select id="size_id_${stockIndex}" name="size_id[${stockIndex}]" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600">
                    <option value="">Select Size</option>
                    <?php echo $sizeOptions; ?>
                </select>

                <!-- Color Dropdown -->
                <label for="color_id_${stockIndex}" class="block font-semibold text-gray-800 mt-2 mb-2">Color ${stockIndex} <span class="text-red-500">*</span></label>
                <select id="color_id_${stockIndex}" name="color_id[${stockIndex}]" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600">
                    <option value="">Select Color</option>
                    <?php echo $colorOptions; ?>
                </select>

                <!-- Quantity Input -->
                <label for="quantity_${stockIndex}" class="block font-semibold text-gray-800 mt-2 mb-2">Quantity ${stockIndex} <span class="text-red-500">*</span></label>
                <input type="number" id="quantity_${stockIndex}" name="quantity[${stockIndex}]" class="w-full rounded-md border-gray-300 px-2 py-2 border text-gray-600" placeholder="Quantity" min="1">
                
                <!-- Remove Stock Button -->
                <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-2" onclick="removeStockField(${stockIndex})">
                    <i class="fas fa-minus mr-2"></i>
                    <span>Remove Stock</span>
                </button>
            </div>
        `;

        // Append new stock fields to the stock details section
        document.getElementById('stockDetails').insertAdjacentHTML('beforeend', stockFields);
    }

    function removeStockField(index) {
        // Remove the stock fields with the specified index
        var stockField = document.getElementById(`stockSize${index}`);
        stockField.parentNode.removeChild(stockField);
    }
</script>
<script>
    // Display Sweet Alert on successful stock update or creation
    <?php if (!empty($successMessage)) : ?>
        Swal.fire({
            icon: "success",
            title: "Success",
            html: "<?php echo $successMessage; ?>",
        }).then(function () {
            window.location.href = "manage_stocks_list.php";
        });
    <?php endif; ?>
</script>
</body>

</html>
