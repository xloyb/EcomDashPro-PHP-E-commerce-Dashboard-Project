<?php
require("../../db/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = $_POST["category_id"];
    $category_name = $_POST["category_name"];

    try {
        $updateCategoryQuery = "UPDATE Categories SET CategoryName = :category_name WHERE CategoryID = :id";
        $updateCategoryStatement = $dbh->prepare($updateCategoryQuery);
        $updateCategoryStatement->bindParam(':id', $category_id);
        $updateCategoryStatement->bindParam(':category_name', $category_name);
        $updateCategoryStatement->execute();

        echo "<p class='success-message'>Category updated successfully!</p>";
    } catch (Exception $e) {
        echo "<p class='error-message'>Error: " . $e->getMessage() . "</p>";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $category_id = $_GET['id'];

    $getCategoryQuery = "SELECT * FROM Categories WHERE CategoryID = :id";
    $getCategoryStatement = $dbh->prepare($getCategoryQuery);
    $getCategoryStatement->bindParam(':id', $category_id);
    $getCategoryStatement->execute();
    $category = $getCategoryStatement->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Edit Category</h2>
        <form method="post" action="edit_category.php" class="bg-white p-4 mb-4">
            <input type="hidden" name="category_id" value="<?= $category['CategoryID'] ?>">
            <div class="mb-3">
                <label for="category_name" class="form-label">Category Name:</label>
                <input type="text" name="category_name" class="form-control" value="<?= $category['CategoryName'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
    </div>
</body>
</html>

<?php
} 
?>
