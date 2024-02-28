<?php
session_start();
require("../../db/connection.php");
require("../../inc/settings.php");
require("../../inc/auth.php");



checkAuthentication();
checkadminAuthentication();





function showMessage($message, $isError = false)
{
    $class = $isError ? 'alert-danger' : 'alert-success';
    echo "<div class='alert $class'>$message</div>";
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['remove_article'])) {
    $article_id = $_GET['remove_article'];

    try {
        $deleteArticleQuery = "DELETE FROM Articles WHERE ArticleID = :id";
        $deleteArticleStatement = $dbh->prepare($deleteArticleQuery);
        $deleteArticleStatement->bindParam(':id', $article_id);
        $deleteArticleStatement->execute();

        showMessage("Article removed successfully!");
    } catch (Exception $e) {
        showMessage("Error: " . $e->getMessage(), true);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['remove_category'])) {
    $category_id = $_GET['remove_category'];

    try {
        $deleteCategoryQuery = "DELETE FROM Categories WHERE CategoryID = :id";
        $deleteCategoryStatement = $dbh->prepare($deleteCategoryQuery);
        $deleteCategoryStatement->bindParam(':id', $category_id);
        $deleteCategoryStatement->execute();

        showMessage("Category removed successfully!");
    } catch (Exception $e) {
        showMessage("Error: " . $e->getMessage(), true);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Dashboard</h2>

        <div class="row">
            <div class="col-md-6">
                <form method="post" action="add_article.php" class="bg-white p-4 mb-4" enctype="multipart/form-data">
                <h3>Add Article</h3>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category:</label>
                        <select name="category_id" class="form-control" required>
                            <?php
                            $categoryQuery = "SELECT * FROM Categories";
                            $categoryResult = $dbh->query($categoryQuery);

                            while ($category = $categoryResult->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$category['CategoryID']}'>{$category['CategoryName']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="article_title" class="form-label">Title:</label>
                        <input type="text" name="article_title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="article_description" class="form-label">Description:</label>
                        <input type="text" name="article_description" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="article_price" class="form-label">Price:</label>
                        <input type="text" name="article_price" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock_quantity" class="form-label">Stock Quantity:</label>
                        <input type="text" name="stock_quantity" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="image_file">Select Image:</label>
                        <input type="file" name="image_file" id="image_file" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-success">Add Article</button>
                </form>
            </div>

            <div class="col-md-6">
                <form method="post" action="add_category.php" class="bg-white p-4 mb-4">
                    <h3>Add Category</h3>
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name:</label>
                        <input type="text" name="category_name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Add Category</button>
                </form>
            </div>
        </div>

        <div class="bg-white p-4 mb-4">
            <h3>Remove Article</h3>
            <form method="get">
                <div class="mb-3">
                    <label for="remove_article_id" class="form-label">Article ID:</label>
                    <input type="text" name="remove_article" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-danger">Remove Article</button>
            </form>
        </div>

        <!-- Remove Category Form -->
        <div class="bg-white p-4 mb-4">
            <h3>Remove Category</h3>
            <form method="get">
                <div class="mb-3">
                    <label for="remove_category_id" class="form-label">Category ID:</label>
                    <input type="text" name="remove_category" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-danger">Remove Category</button>
            </form>
        </div>

        <!-- List of Articles -->
        <div class="bg-white p-4 mb-4">
            <h3>List of Articles</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock Quantity</th>
                        <th>ImageURL</th>
                        <th>CategoryID</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $articleQuery = "SELECT * FROM Articles";
                    $articleResult = $dbh->query($articleQuery);

                    while ($article = $articleResult->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>{$article['ArticleID']}</td>";
                        echo "<td>{$article['Title']}</td>";
                        echo "<td>{$article['Description']}</td>";
                        echo "<td>{$article['Price']}</td>";
                        echo "<td>{$article['StockQuantity']}</td>";
                        echo "<td>{$article['ImageURL']}</td>";
                        echo "<td>{$article['CategoryID']}</td>";
                        echo "<td><a href='edit_article.php?id={$article['ArticleID']}' class='btn btn-warning btn-sm'>Edit</a> | <a href='dashboard.php?remove_article={$article['ArticleID']}' class='btn btn-danger btn-sm'>Delete</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- List of Categories -->
        <div class="bg-white p-4 mb-4">
            <h3>List of Categories</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $categoryQuery = "SELECT * FROM Categories";
                    $categoryResult = $dbh->query($categoryQuery);

                    while ($category = $categoryResult->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>{$category['CategoryID']}</td>";
                        echo "<td>{$category['CategoryName']}</td>";
                        echo "<td>
                                  <a href='edit_category.php?id={$category['CategoryID']}' class='btn btn-warning btn-sm'>Edit</a> | 
                                  <a href='dashboard.php?remove_category={$category['CategoryID']}' class='btn btn-danger btn-sm'>Delete</a> | 
                                  <a href='display_sort.php?category_id={$category['CategoryID']}'' class='btn btn-danger btn-sm'>Sort</a>
                                </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
