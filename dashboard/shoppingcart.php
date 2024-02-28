<?php
session_start();
require("../inc/settings.php");
require("../db/connection.php");
require("../inc/user_functions.php");
require("../inc/auth.php");

checkAuthentication();


$user_id = $_SESSION['user_id'];
$user_details = getUserDetails($user_id, $dbh);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_quantity'])) {
    $selected_article_id = $_POST['article_id'];
    $new_quantity = $_POST['quantity'];
    
    updateQuantityInBuyingList($user_id, $selected_article_id, $new_quantity, $dbh);

    header("Location: shoppingcart.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_from_cart'])) {
    $selected_article_id = $_POST['article_id'];
    
    removeFromBuyingList($user_id, $selected_article_id, $dbh);

    header("Location: shoppingcart.php");
    exit();
}

$buying_list = getBuyingList($user_id, $dbh);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Shopping Cart</h2>
        <?php if (empty($buying_list)): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Article</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($buying_list as $item): ?>
                        <tr>
                            <td><?php echo $item['Title']; ?></td>
                            <td>
                                <!-- Form to update the quantity -->
                                <form method="post" action="shoppingcart.php" class="d-flex">
                                    <input type="hidden" name="article_id" value="<?php echo $item['ArticleID']; ?>">
                                    <label for="quantity" class="me-2">Quantity:</label>
                                    <input type="number" name="quantity" value="<?php echo $item['Quantity']; ?>" min="1" class="form-control me-2" style="width: 80px;">
                                    <button type="submit" name="update_quantity" class="btn btn-primary btn-sm">Update</button>
                                </form>
                            </td>
                            <td>
                                <form method="post" action="shoppingcart.php" class="d-flex">
                                    <input type="hidden" name="article_id" value="<?php echo $item['ArticleID']; ?>">
                                    <button type="submit" name="remove_from_cart" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>
