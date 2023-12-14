<!-- Sidebar Menu with Icons (Font Awesome) -->
<div class="sidebar-manager-container space-y-4">
    <a href="../systems/dashboard_manager.php" class="flex items-center space-x-4 text-gray-800 hover:bg-gray-200 rounded-lg p-2">
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
    <a href="../products/products_list.php" class="flex items-center space-x-4 text-gray-800 hover:bg-gray-200 rounded-lg p-2">
        <i class="fas fa-shopping-cart"></i>
        <span>Products</span>
    </a>
    <a href="../stocks/stocks_list.php" class="flex items-center space-x-4 text-gray-800 hover:bg-gray-200 rounded-lg p-2">
        <i class="fas fa-box"></i>
        <span>Stocks</span>
    </a>
    <a href="../stocks/stocks_analysis.php" class="flex items-center space-x-4 text-gray-800 hover:bg-gray-200 rounded-lg p-2">
        <i class="fa-solid fa-chart-area"></i>
        <span>Restock</span>
    </a>
    <a href="#" onclick="confirmLogout()" class="flex items-center space-x-4 text-gray-800 hover:bg-gray-200 rounded-lg p-2">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span>Logout</span>
    </a>
</div>
<!-- End Sidebar Menu -->

<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Apakah Anda yakin ingin logout?',
            text: 'Anda akan keluar dari sesi ini.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the logout page or trigger your logout logic here
                window.location.href = '../systems/logout.php';
            }
        });
    }

    // Get the current page
    var currentPage = window.location.href;

    // Get all links in the sidebar
    var links = document.querySelectorAll(".sidebar-manager-container a");

    // Loop through the links and check if the URL matches
    links.forEach(function(link) {
        if (link.href === currentPage) {
            link.classList.add("bg-gray-200");
        }
    });
</script>