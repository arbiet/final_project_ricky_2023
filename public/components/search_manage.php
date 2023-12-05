<!-- search_component.php -->
<div class="flex flex-row justify-between items-center w-full mb-2 pb-2">
    <div>

    </div>
    <!-- Search -->
    <form class="flex items-center justify-end space-x-2 w-96">
        <input type="text" name="search" class="bg-gray-200 focus-bg-white focus-outline-none border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" placeholder="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit" class="bg-blue-500 hover-bg-blue-700 text-white font-bold py-2 px-4 rounded space-x-2 inline-flex items-center">
            <i class="fas fa-search"></i>
            <span>Search</span>
        </button>
    </form>
    <!-- End Search -->
</div>