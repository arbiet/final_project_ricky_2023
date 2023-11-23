<!-- pagination.php -->
<div class="flex flex-row justify-between items-center w-full mt-4">
    <div class="flex flex-row justify-start items-center">
        <span class="text-gray-600">Total <?php echo $rowCount; ?> rows</span>
    </div>
    <div class="flex flex-row justify-end items-center space-x-2">
        <a href="?page=1&search=<?php echo $searchTerm; ?>" class="bg-gray-200 hover-bg-gray-300 text-gray-600 font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-angle-double-left"></i>
        </a>
        <a href="?page=<?php if ($page == 1) {
                            echo $page;
                        } else {
                            echo $page - 1;
                        } ?>&search=<?php echo $searchTerm; ?>" class="bg-gray-200 hover-bg-gray-300 text-gray-600 font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-angle-left"></i>
        </a>
        <!-- Page number -->
        <?php
        $startPage = $page - 2;
        $endPage = $page + 2;
        if ($startPage < 1) {
            $endPage += abs($startPage) + 1;
            $startPage = 1;
        }
        if ($endPage > $totalPage) {
            $startPage -= $endPage - $totalPage;
            $endPage = $totalPage;
        }
        if ($startPage < 1) {
            $startPage = 1;
        }
        for ($i = $startPage; $i <= $endPage; $i++) {
            if ($i == $page) {
                echo "<a href='?page=$i&search=$searchTerm' class='bg-blue-500 hover-bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center'>$i</a>";
            } else {
                echo "<a href='?page=$i&search=$searchTerm' class='bg-gray-200 hover-bg-gray-300 text-gray-600 font-bold py-2 px-4 rounded inline-flex items-center'>$i</a>";
            }
        }
        ?>
        <a href="?page=<?php if ($page == $totalPage) {
                            echo $page;
                        } else {
                            echo $page + 1;
                        } ?>&search=<?php echo $searchTerm; ?>" class="bg-gray-200 hover-bg-gray-300 text-gray-600 font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-angle-right"></i>
        </a>
        <a href="?page=<?php echo $totalPage; ?>&search=<?php echo $searchTerm; ?>" class="bg-gray-200 hover-bg-gray-300 text-gray-600 font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-angle-double-right"></i>
        </a>
    </div>
    <div class="flex flex-row justify-end items-center ml-2">
        <span class="text-gray-600">Page <?php echo $page; ?> of <?php echo $totalPage; ?></span>
    </div>
</div>