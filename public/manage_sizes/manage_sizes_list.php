<?php
// Initialize the session
session_start();
// Include the connection file
require_once('../../database/connection.php');

// Initialize variables
$sizeName = $sizeCode = $wearType = $gender = '';
$errors = array();

?>
<?php include_once('../components/header.php'); ?>

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
        <main class=" bg-gray-50 flex flex-col flex-1 overflow-y-scroll h-screen flex-shrink-0 sc-hide pb-40">
            <div class="flex items-start justify-start p-6 shadow-md m-4 flex-1 flex-col">
                <!-- Header Content -->
                <div class="flex flex-row justify-between items-center w-full border-b-2 border-gray-600 mb-2 pb-2">
                    <h1 class="text-3xl text-gray-800 font-semibol w-full">Sizes</h1>
                    <div class="flex flex-row justify-end items-center">
                        <a href="<?php echo $baseUrl; ?>public/manage_sizes/manage_sizes_create.php" class="bg-green-500 hover-bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            <span>Create</span>
                        </a>
                    </div>
                </div>
                <!-- End Header Content -->
                <!-- Content -->
                <div class="flex flex-col w-full">
                    <!-- Include Search Bar -->
                    <?php include('../components/search_manage.php'); ?>
                    <!-- Table -->
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="text-left py-1">No</th>
                                <th class="text-left py-1">Size Name</th>
                                <th class="text-left py-1">Size Code</th>
                                <th class="text-left py-1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch size data from the database
                            $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $query = "SELECT * FROM Sizes
                                      WHERE SizeName LIKE '%$searchTerm%' OR SizeCode LIKE '%$searchTerm%'
                                      LIMIT 10 OFFSET " . ($page - 1) * 10;
                            $result = $conn->query($query);

                            // Count total rows in the table
                            $queryCount = "SELECT COUNT(*) AS count FROM Sizes WHERE SizeName LIKE '%$searchTerm%' OR SizeCode LIKE '%$searchTerm%'";
                            $resultCount = $conn->query($queryCount);
                            $rowCount = $resultCount->fetch_assoc()['count'];
                            $totalPage = ceil($rowCount / 10);
                            $no = 1;

                            // Loop through the results and display data in rows
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td class="py-1"><?php echo $no++; ?></td>
                                    <td class="py-1"><?php echo $row['SizeName']; ?></td>
                                    <td class="py-1"><?php echo $row['SizeCode']; ?></td>
                                    <td class='py-1'>
                                        <a href="<?php echo $baseUrl; ?>public/manage_sizes/manage_sizes_detail.php?id=<?php echo $row['SizeID'] ?>" class='bg-green-500 hover-bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mr-2 text-sm'>
                                            <i class='fas fa-eye mr-2'></i>
                                            <span>Detail</span>
                                        </a>
                                        <a href="<?php echo $baseUrl; ?>public/manage_sizes/manage_sizes_update.php?id=<?php echo $row['SizeID'] ?>" class='bg-blue-500 hover-bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mr-2 text-sm'>
                                            <i class='fas fa-edit mr-2'></i>
                                            <span>Edit</span>
                                        </a>
                                        <button onclick="confirmDelete(<?php echo $row['SizeID']; ?>)" class='bg-red-500 hover-bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center text-sm'>
                                            <i class='fas fa-trash mr-2'></i>
                                            <span>Delete</span>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            }
                            if ($result->num_rows === 0) {
                            ?>
                                <tr>
                                    <td colspan="6" class="py-1 text-center">No data found.</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- End Table -->
                </div>
                <!-- End Content -->
                <!-- Include pagination -->
                <?php include('../components/pagination.php'); ?>
        </main>
        <!-- End Main Content -->
    </div>
    <!-- End Main Content -->
    <!-- Footer -->
    <?php include('../components/footer.php'); ?>
    <!-- End Footer -->
</div>
<!-- End Main Content -->
<script>
    // Function to show a confirmation dialog
    function confirmDelete(sizeID) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, redirect to the delete page
                window.location.href = `manage_sizes_delete.php?id=${sizeID}`;
            }
        });
    }
</script>
</body>

</html>