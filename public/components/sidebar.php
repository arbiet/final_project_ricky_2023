<aside class="bg-sky-800 text-white w-64 overflow-y-scroll h-screen flex-shrink-0 sc-hide">
    <ul class="text-white">
        <li class="px-6 py-4 hover:bg-sky-700 cursor-pointer space-x-2 flex items-center">
            <i class="fas fa-tachometer-alt mr-3"></i>
            <a href="../systems/dashboard.php">Dashboard</a>
        </li>
        <li class="px-6 py-4 hover-bg-sky-700 cursor-pointer space-x-2 flex items-center">
            <i class="fas fa-user mr-3"></i>
            <a href="../profiles/profile.php">Profile</a>
        </li>
        <?php
        if ($_SESSION['RoleID'] === 1 || $_SESSION['RoleID'] === 2) {
            // Menu "Users" hanya ditampilkan jika peran pengguna adalah "Admin"
            echo '
            <li class="px-6 py-4 hover-bg-sky-700 cursor-pointer space-x-2 flex items-center">
                <i class="fa-brands fa-shirtsinbulk mr-3"></i>
                <a href="../manage_products/manage_products_list.php">Products</a>
            </li>
            ';
            echo '
            <li class="px-6 py-4 hover-bg-sky-700 cursor-pointer space-x-2 flex items-center">
                <i class="fa-solid fa-cubes-stacked mr-3"></i>
                <a href="../manage_stocks/manage_stocks_list.php">Stocks</a>
            </li>
            ';
            echo '
            <li class="px-6 py-4 hover-bg-sky-700 cursor-pointer space-x-2 flex items-center">
                <i class="fa-solid fa-cubes-stacked mr-3"></i>
                <a href="../manage_restocks/manage_restocks_list.php">Restocks Analysis</a>
            </li>
            ';
        }
        ?>
        <?php
        if ($_SESSION['RoleID'] === 1) {
            // Menu "Users" hanya ditampilkan jika peran pengguna adalah "Admin"
            echo '
            <li class="px-6 py-4 hover-bg-sky-700 cursor-pointer space-x-2 flex items-center">
                <i class="fas fa-user-cog mr-3"></i>
                <a href="../manage_users/manage_users_list.php">Users</a>
            </li>
            ';
            echo '
            <li class="px-6 py-4 hover-bg-sky-700 cursor-pointer space-x-2 flex items-center">
                <i class="fa-solid fa-shirt mr-3"></i>
                <a href="../manage_sizes/manage_sizes_list.php">Sizes</a>
            </li>
            ';
            echo '
            <li class="px-6 py-4 hover-bg-sky-700 cursor-pointer space-x-2 flex items-center">
                <i class="fa-solid fa-droplet mr-3"></i>
                <a href="../manage_colors/manage_colors_list.php">Colors</a>
            </li>
            ';
            echo '
            <li class="px-6 py-4 hover-bg-sky-700 cursor-pointer space-x-2 flex items-center">
                <i class="fa-solid fa-copyright mr-3"></i>
                <a href="../manage_brands/manage_brands_list.php">Brands</a>
            </li>
            ';
            echo '
            <li class="px-6 py-4 hover-bg-sky-700 cursor-pointer space-x-2 flex items-center">
                <i class="fa-solid fa-filter-circle-dollar mr-3"></i>
                <a href="../manage_categories/manage_categories_list.php">Categories</a>
            </li>
            ';
        }
        ?>

    </ul>
    <hr class="mt-60 border-transparent">
</aside>
<script>
    // Mendapatkan halaman saat ini
    var currentPage = window.location.href;

    // Mengambil semua tautan dalam daftar
    var links = document.querySelectorAll("aside ul li a");

    // Loop melalui tautan dan periksa jika URL cocok
    links.forEach(function(link) {
        var currentPathParts = currentPage.split("/");
        var linkPathParts = link.href.split("/");
        if (linkPathParts[linkPathParts.length - 2] === currentPathParts[currentPathParts.length - 2]) {
            if (currentPathParts[currentPathParts.length - 2] != "systems") {
                link.parentElement.classList.add("bg-sky-700");
            } else if (currentPathParts[currentPathParts.length - 2] == "systems" && link.href === currentPage) {
                link.parentElement.classList.add("bg-sky-700");
            }
        }
    });
</script>