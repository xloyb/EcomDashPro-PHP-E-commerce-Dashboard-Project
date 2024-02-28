<?php
require("../../db/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $category_id = $_GET['id'];

    try {
        $deleteCategoryQuery = "DELETE FROM Categories WHERE id = :id";
        $deleteCategoryStatement = $dbh->prepare($deleteCategoryQuery);
        $deleteCategoryStatement->bindParam(':id', $category_id);
        $deleteCategoryStatement->execute();

        echo "<p class='success-message'>Category removed successfully!</p>";
    } catch (Exception $e) {
        echo "<p class='error-message'>Error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p class='error-message'>Invalid request.</p>";
}
?>
