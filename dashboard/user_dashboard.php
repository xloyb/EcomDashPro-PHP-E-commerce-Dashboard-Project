<?php
session_start();
require("../db/connection.php");
require("../inc/user_functions.php");
require("../inc/dash_products.php");
require("../inc/settings.php");
require("../inc/dynamicpages.php");

require("../inc/auth.php");

$css = $settings['css_path'];

checkAuthentication();

$user_id = $_SESSION['user_id'];
$user_details = getUserDetails($user_id, $dbh);
$articles = getArticles($dbh);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_buying_list'])) {
    $selected_article_id = $_POST['article_id'];
    $quantity = $_POST['quantity'];

    addToBuyingList($user_id, $selected_article_id, $quantity, $dbh);

    header("Location: user_dashboard.php");
    exit();
}

$articleimgspath = $settings['products_img_path'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo"$css"?>" rel="stylesheet">

</head>
<body class="bg-light">

<?php userMyNav()?>

    <div class="container mt-5">
        <?php if (isset($_POST['add_to_buying_list'])): ?>
            <div class="alert alert-success" role="alert">
                Item successfully added to your buying list!
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">Welcome, <?php echo $user_details['Username']; ?>!</h2>
                <div class="card-text">
                    <p>Email: <?php echo $user_details['Email']; ?></p>
                </div>
            </div>
        </div>

        
        <?php dash_showproducts() ?>

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

</script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>
