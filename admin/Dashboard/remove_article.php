<?php
require("../../db/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $article_id = $_GET['id'];

    try {
        $deleteArticleQuery = "DELETE FROM Articles WHERE id = :id";
        $deleteArticleStatement = $dbh->prepare($deleteArticleQuery);
        $deleteArticleStatement->bindParam(':id', $article_id);
        $deleteArticleStatement->execute();

        echo "<p class='success-message'>Article removed successfully!</p>";
    } catch (Exception $e) {
        echo "<p class='error-message'>Error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p class='error-message'>Invalid request.</p>";
}
?>
