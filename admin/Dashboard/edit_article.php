<?php
session_start();
require("../../db/connection.php");
require("../../inc/auth.php");

checkAuthentication();
checkadminAuthentication();
$message = "";
$article = null;



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $article_id = $_POST["article_id"];
    $article_title = $_POST["article_title"];
    $article_description = $_POST["article_description"];
    $article_price = $_POST["article_price"];
    $stock_quantity = $_POST["stock_quantity"];
    $category_id = $_POST["category_id"];

    try {
        $updateArticleQuery = "UPDATE Articles SET Title = :title, Description = :description, Price = :price, StockQuantity = :stock_quantity, CategoryID = :category_id WHERE ArticleID = :id";
        $updateArticleStatement = $dbh->prepare($updateArticleQuery);
        $updateArticleStatement->bindParam(':id', $article_id);
        $updateArticleStatement->bindParam(':title', $article_title);
        $updateArticleStatement->bindParam(':description', $article_description);
        $updateArticleStatement->bindParam(':price', $article_price);
        $updateArticleStatement->bindParam(':stock_quantity', $stock_quantity);
        $updateArticleStatement->bindParam(':category_id', $category_id);
        $updateArticleStatement->execute();

        $message = "Article updated successfully!";
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $article_id = $_GET['id'];

    $getArticleQuery = "SELECT * FROM Articles WHERE ArticleID = :id";
    $getArticleStatement = $dbh->prepare($getArticleQuery);
    $getArticleStatement->bindParam(':id', $article_id);
    $getArticleStatement->execute();
    $article = $getArticleStatement->fetch(PDO::FETCH_ASSOC);

    if (!$article) {
        $message = "Article not found.";
    }

    $categoryQuery = "SELECT * FROM Categories";
    $categoryResult = $dbh->query($categoryQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Edit Product</h2>

        <?php if (!empty($message)): ?>
            <p class="message"><?= $message ?></p>
        <?php endif; ?>

        <?php if (isset($article)): ?>
            <form method="post" action="edit_article.php" class="bg-white p-4 mb-4">
                <input type="hidden" name="article_id" value="<?= $article['ArticleID'] ?>">
                <div class="mb-3">
                    <label for="article_title" class="form-label">Title:</label>
                    <input type="text" name="article_title" class="form-control" value="<?= $article['Title'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="article_description" class="form-label">Description:</label>
                    <input type="text" name="article_description" class="form-control" value="<?= $article['Description'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="article_price" class="form-label">Price:</label>
                    <input type="text" name="article_price" class="form-control" value="<?= $article['Price'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="stock_quantity" class="form-label">Stock Quantity:</label>
                    <input type="text" name="stock_quantity" class="form-control" value="<?= $article['StockQuantity'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category:</label>
                    <select name="category_id" class="form-control" required>
                        <?php
                        while ($category = $categoryResult->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($category['CategoryID'] == $article['CategoryID']) ? "selected" : "";
                            echo "<option value='{$category['CategoryID']}' $selected>{$category['CategoryName']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Product</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
