<?php
session_start();

require("../../db/connection.php");

require("../../inc/auth.php");

checkAuthentication();
checkadminAuthentication();

$article = null;


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $category_id = $_GET["category_id"];
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
                    $articleQuery = "SELECT * FROM Articles where CategoryID = $category_id";
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
        
    </div>
</body>
</html>
