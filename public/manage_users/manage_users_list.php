<?php
// Initialize the session
session_start();
// Include the connection file
require_once('../../database/connection.php');

// Initialize variables
$username = $password = '';
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
                    <h1 class="text-3xl text-gray-800 font-semibol w-full">Users</h1>
                    <div class="flex flex-row justify-end items-center">
                        <a href="<?php echo $baseUrl; ?>public/manage_users/manage_users_create.php" class="bg-green-500 hover-bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
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
                                <th class="text-left py-1">Username</th>
                                <th class="text-left py-1">Email</th>
                                <th class="text-left py-1">Role</th>
                                <th class="text-left py-1">Last Login</th>
                                <th class="text-left py-1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch user data from the database and join with the Role table
                            $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $query = "SELECT u.UserID, u.Username, u.Email, r.RoleName, u.LastLogin FROM Users u
                                      LEFT JOIN Roles r ON u.RoleID = r.RoleID
                                      WHERE u.Username LIKE '%$searchTerm%' OR u.Email LIKE '%$searchTerm%'
                                      LIMIT 15 OFFSET " . ($page - 1) * 15;
                            $result = $conn->query($query);

                            // Count total rows in the table
                            $queryCount = "SELECT COUNT(*) AS count FROM Users WHERE Username LIKE '%$searchTerm%' OR Email LIKE '%$searchTerm%'";
                            $resultCount = $conn->query($queryCount);
                            $rowCount = $resultCount->fetch_assoc()['count'];
                            $totalPage = ceil($rowCount / 15);
                            $no = 1;

                            // Loop through the results and display data in rows
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td class="py-1"><?php echo $no++; ?></td>
                                    <td class="py-1"><?php echo $row['Username']; ?></td>
                                    <td class="py-1"><?php echo $row['Email']; ?></td>
                                    <td class="py-1"><?php echo $row['RoleName']; ?></td>
                                    <td class="py-1"><?php echo $row['LastLogin']; ?></td>
                                    <td class='py-1'>
                                        <a href="<?php echo $baseUrl; ?>public/manage_users/manage_users_detail.php?id=<?php echo $row['UserID'] ?>" class='bg-green-500 hover-bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mr-2 text-sm'>
                                            <i class='fas fa-eye mr-2'></i>
                                            <span>Detail</span>
                                        </a>
                                        <a href="<?php echo $baseUrl; ?>public/manage_users/manage_users_update.php?id=<?php echo $row['UserID'] ?>" class='bg-blue-500 hover-bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mr-2 text-sm'>
                                            <i class='fas fa-edit mr-2'></i>
                                            <span>Edit</span>
                                        </a>
                                        <button onclick="changeRole(<?php echo $row['UserID']; ?>)" class='bg-yellow-500 hover-bg-yellow-700 text-white font-bold py-2 px-4 rounded inline-flex items-center text-sm'>
                                            <i class='fas fa-exchange-alt mr-2'></i>
                                            <span>Change Role</span>
                                        </button>
                                        <a href="#" onclick="confirmDelete(<?php echo $row['UserID']; ?>)" class='bg-red-500 hover-bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center text-sm'>
                                            <i class='fas fa-trash mr-2'></i>
                                            <span>Delete</span>
                                        </a>
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
    function confirmDelete(userID) {
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
                window.location.href = `manage_users_delete.php?id=${userID}`;
            }
        });
    }
</script>
<script>
    // Function to show a confirmation dialog for changing role
    function changeRole(userID) {
        Swal.fire({
            title: 'Change User Role',
            input: 'select',
            inputOptions: {
                'Administrator': 'Administrator',
                'Pengelola Stok': 'Pengelola Stok',
            },
            inputPlaceholder: 'Select a role',
            showCancelButton: true,
            confirmButtonText: 'Change',
            cancelButtonText: 'Cancel',
            preConfirm: (role) => {
                // Handle the role change here, e.g., redirect to manage_users_change_role.php
                window.location.href = `manage_users_change_role.php?id=${userID}&role=${role}`;
            },
        });
    }
</script>
</body>

</html>