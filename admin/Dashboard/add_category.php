<?php
require("../../db/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST["category_name"];

    try {
        $insertCategoryQuery = "INSERT INTO Categories (CategoryName) VALUES (:category_name)";
        $insertCategoryStatement = $dbh->prepare($insertCategoryQuery);
        $insertCategoryStatement->bindParam(':category_name', $category_name);
        $insertCategoryStatement->execute();


        echo "<script>
        alert('Category added successfully!');
        window.location.href = 'dashboard.php';
    </script>";
    } catch (Exception $e) {
        echo "<script>
                  alert('Error: " . $e->getMessage() . "');
                  window.location.href = 'dashboard.php';
              </script>";
    }
}
?>
