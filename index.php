<?php
session_start();
require("inc/settings.php");
require("inc/staticpages.php");
require("inc/dynamicpages.php");
require("inc/system_functions.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <link href="css/output.css" rel="stylesheet">

</head>

<!--nav star-->
<?php userMyNav() ?>
<?php myoffer() ?>
<?php indexheader() ?>
<?php showProducts() ?>

<!--nav end-->

<body class="bg-light">
   

<script>
document.addEventListener('DOMContentLoaded', function () {
  const tabLinks = document.querySelectorAll('.louaycateg'); // Replace with your actual class
  const productDivs = document.querySelectorAll('.louayprod'); // Replace with your actual class

  function handleTabClick(event) {
    event.preventDefault();

    // Get the data-category-id attribute of the clicked element
    const categoryId = event.currentTarget.getAttribute('data-category-id');

    // Show/hide products based on the clicked category
    productDivs.forEach(div => {
      const productCategoryId = div.getAttribute('data-category-id');
      if (productCategoryId === categoryId || categoryId === 'all') {
        div.style.display = 'block';
      } else {
        div.style.display = 'none';
      }
    });
  }

  // Attach the click event listener to each tab link
  tabLinks.forEach(link => {
    link.addEventListener('click', handleTabClick);
  });
});


</script>

<!-- ... (Previous HTML code) ... -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mobile menu button
        const mobileMenuButton = document.getElementById('mobile-menu-button');

        // Mobile menu
        const mobileMenu = document.getElementById('mobile-menu');

        // Toggle mobile menu visibility
        mobileMenuButton.addEventListener('click', function () {
            if (mobileMenu) {
                mobileMenu.classList.toggle('hidden');
            }
        });

        // Profile dropdown button
        const userMenuButton = document.getElementById('user-menu-button');

        // Profile dropdown menu
        const userMenu = document.getElementById('user-menu');

        // Toggle profile dropdown menu visibility
        userMenuButton.addEventListener('click', function () {
            if (userMenu) {
                userMenu.classList.toggle('hidden');
            }
        });

        // Close the mobile menu and profile dropdown when clicking outside
        document.addEventListener('click', function (event) {
            if (mobileMenu && !mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }

            if (userMenu && !userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });
    });
</script>

<!-- ... (Remaining HTML code) ... -->





    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
