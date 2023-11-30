<?php
// Include the connection file
require_once('../../database/connection.php');
include_once('../components/header.php');
require_once('auth.php'); // Include auth.php for authentication functions

// Initialize variables
$username = $password = $confirm_password = $email = $fullname = '';
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user inputs
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];

    // Validate inputs using auth.php functions
    validateRegistrationInputs($username, $password, $confirm_password, $email, $fullname, $errors, $conn);

    // If there are no errors, proceed with registration
    if (count($errors) === 0) {
        // Generate User ID using auth.php function
        $user_id = generateRandomUserID($conn);

        // Check if User ID already exists in the database
        while (isUserIDExists($conn, $user_id)) {
            $user_id = generateRandomUserID($conn);
        }

        // Hash the password for storage
        $hashed_password = hash('sha256', $password);

        // Set default role to 'pengelolastok' => 2
        $default_role = '2';

        // Set default profile picture URL to 'default.png'
        $default_profile_picture = 'default.png';

        // If there are no errors, proceed with registration
        if (count($errors) === 0) {
            // Prepare and execute a query to insert a new user record
            $query = "INSERT INTO Users (UserID, username, email, password, RoleID, fullname, ProfilePictureURL) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssssss', $user_id, $username, $email, $hashed_password, $default_role, $fullname, $default_profile_picture);

            if ($stmt->execute()) {
                // Registration successful, trigger SweetAlert
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "Registration Successful!",
                            text: "You can now login.",
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function(){
                            window.location.href = "../systems/login.php";
                        });
                      </script>';
            } else {
                $errors['registration_failed'] = 'Failed to register user.';
                // Registration failed, trigger SweetAlert for error
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Registration Failed!",
                        text: "Failed to register user. Please try again later.",
                        showConfirmButton: false,
                        timer: 2000
                    });
                  </script>';
            }

            // Close the statement
            $stmt->close();
        }
    }
}
?>


<div class="h-screen flex flex-col">
    <!-- Top Navbar -->
    <?php include('../components/navbar.php'); ?>
    <!-- End Top Navbar -->
    <!-- Main Content -->
    <main class="flex-grow bg-gray-50 flex flex-col">
        <!-- Registration Form -->
        <div class="flex-grow bg-gray-50">
            <div class="flex justify-center items-center h-full">
                <div class="text-center px-40">
                    <h1 class="text-6xl font-bold text-gray-700 mb-10">Register</h1>
                    <?php if (isset($errors['registration_failed'])) : ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <strong class="font-bold">Registration failed!</strong>
                            <span class="block sm:inline"><?php echo $errors['registration_failed']; ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (count($errors) > 0) {
                        foreach ($errors as $error) : ?>
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                                <strong class="font-bold">Error!</strong>
                                <span class="block sm:inline"><?php echo $error; ?></span>
                            </div>
                    <?php endforeach;
                    }
                    ?>
                    <form action="register.php" method="POST" class="mb-6">
                        <label for="username" class="block text-left text-gray-600 mb-2">Username</label>
                        <input type="text" id="username" name="username" class="border border-gray-300 rounded-full px-4 py-2 w-full mb-2" required value="<?php echo htmlspecialchars($username); ?>">

                        <label for="fullname" class="block text-left text-gray-600 mb-2">Fullname</label>
                        <input type="text" id="fullname" name="fullname" class="border border-gray-300 rounded-full px-4 py-2 w-full mb-2" required value="<?php echo htmlspecialchars($fullname); ?>">

                        <label for="email" class="block text-left text-gray-600 mb-2">Email</label>
                        <input type="email" id="email" name="email" class="border border-gray-300 rounded-full px-4 py-2 w-full mb-2" required value="<?php echo htmlspecialchars($email); ?>">

                        <label for="password" class="block text-left text-gray-600 mb-2">Password</label>
                        <input type="password" id="password" name="password" class="border border-gray-300 rounded-full px-4 py-2 w-full mb-2" required>

                        <label for="confirm_password" class="block text-left text-gray-600 mb-2">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="border border-gray-300 rounded-full px-4 py-2 w-full mb-6" required>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-full">
                            Register
                        </button>
                    </form>
                    <p class="text-gray-500 text-sm">Already have an account? <a href="<?php echo $baseUrl; ?>public/systems/login.php" class="text-blue-500">Click here to login</a></p>
                </div>
            </div>
        </div>
        <!-- End Registration Form -->
    </main>
    <!-- End Main Content -->
    <!-- Footer -->
    <?php include('../components/footer.php'); ?>
    <!-- End Footer -->
</div>
<!-- End Main Content -->
</body>

</html>