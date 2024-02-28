<?php
require("db/connection.php");
require("inc/settings.php");
require("inc/auth.php");
function showProducts()
{
    global $dbh;
    global $settings;

    // Query to fetch articles
    $getProductsQuery = "SELECT * FROM Articles";
    $getcategoryQuery = "SELECT * FROM Categories";
    $stmt = $dbh->query($getProductsQuery);
    $categories = $dbh->query($getcategoryQuery);
    $categories = $categories->fetchAll(PDO::FETCH_ASSOC);



    // Check if the query was successful
    if ($stmt === false) {
        die("Error executing the query: " . $dbh->errorInfo()[2]);
    }
    ?>



    <div class="bg-white">
    <div>
  <div class="sm:hidden">
    <label for="tabs" class="sr-only">Select a tab</label>
    <select id="tabs" name="tabs" class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
      <?php foreach ($categories as $category): ?>
        <option><?php echo $category['CategoryName']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="hidden sm:block">
    <nav class="isolate flex divide-x divide-gray-200 rounded-lg shadow" aria-label="Tabs">
      <?php foreach ($categories as $index => $category): ?>
        <?php 
          $isActive = $index === 0 ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700';
          $isFirst = $index === 0 ? 'rounded-l-lg' : '';
          $isLast = $index === count($categories) - 1 ? 'rounded-r-lg' : '';
        ?>

        <a data-category-id="<?php echo $category['CategoryID']; ?>" onclick="handleTabClick()" href="" class="<?php echo "{$isActive} {$isFirst} louaycateg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10"; ?>">
            <span><?php echo $category['CategoryName']; ?></span>
            <span aria-hidden="true" class="bg-transparent absolute inset-x-0 bottom-0 h-0.5"></span>
        </a>
      <?php endforeach; ?>
    </nav>
  </div>
</div>


        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
            <div class="sm:flex sm:items-baseline sm:justify-between">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Our Favorites</h2>
                <a href="#" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block">
                    Browse all favorites
                    <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-10 sm:grid-cols-3 sm:gap-x-6 sm:gap-y-0 lg:gap-x-8">
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <div data-category-id="<?php echo htmlspecialchars($row['CategoryID']); ?>" class="louayprod product group relative" data-category-id="<?php echo htmlspecialchars($row['CategoryID']); ?>">

                        <div class="h-96 w-full overflow-hidden rounded-lg sm:aspect-h-3 sm:aspect-w-2 group-hover:opacity-75 sm:h-auto">
                        <img src="<?php echo "{$settings['products_img_path']}{$row['ImageURL']}"; ?>" alt="<?php echo htmlspecialchars($row['Title']); ?>" class="h-full w-full object-cover object-center">

                    </div>
                        <h3 class="mt-4 text-base font-semibold text-gray-900">
                            <a href="#">
                                <span class="absolute inset-0"></span>
                                <?php echo htmlspecialchars($row['Title']); ?>
                            </a>
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">$<?php echo htmlspecialchars($row['Price']); ?></p>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="mt-6 sm:hidden">
                <a href="#" class="block text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                    Browse all favorites
                    <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>
        </div>
    </div>

<?php
}


?>
