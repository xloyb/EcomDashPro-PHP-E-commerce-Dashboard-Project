<?php
session_start();
require("../../db/connection.php");
require("../../inc/auth.php");

checkAuthentication();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $article_title = $_POST["article_title"];
    $article_description = $_POST["article_description"];
    $article_price = $_POST["article_price"];
    $stock_quantity = $_POST["stock_quantity"];
    $category_id = $_POST["category_id"];

    if (isset($_FILES["image_file"]) && $_FILES["image_file"]["error"] == 0) {
         $target_dir = "../../images/articles/";
        
        $unique= uniqid();
        $target_file =$target_dir . $unique . '_' . basename($_FILES["image_file"]["name"]);
        $imagepathdb = $unique . '_' . basename($_FILES["image_file"]["name"]);
        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
            try {
                $insertArticleQuery = "INSERT INTO Articles (Title, Description, Price, StockQuantity, ImageURL, CategoryID) 
                                       VALUES (:title, :description, :price, :stock_quantity, :image_url, :category_id)";
                $insertArticleStatement = $dbh->prepare($insertArticleQuery);
                $insertArticleStatement->bindParam(':title', $article_title);
                $insertArticleStatement->bindParam(':description', $article_description);
                $insertArticleStatement->bindParam(':price', $article_price);
                $insertArticleStatement->bindParam(':stock_quantity', $stock_quantity);
                $insertArticleStatement->bindParam(':image_url',  $imagepathdb);  // Store the file path in the database
                $insertArticleStatement->bindParam(':category_id', $category_id);
                $insertArticleStatement->execute();

                echo "<script>
                          alert('Article added successfully!');
                          window.location.href = 'dashboard.php';
                      </script>";
            } catch (Exception $e) {
                
                echo "<script>
                          alert('Error: " . $e->getMessage() . "');
                          window.location.href = 'dashboard.php';
                      </script>";
            }
        } else {
           
            echo "<script>
                      alert('Error uploading image.');
                      window.location.href = 'dashboard.php';
                  </script>";
        }
    } else {
       
        echo "<script>
                  alert('No image file uploaded.');
                  window.location.href = 'dashboard.php';
              </script>";
    }
}
?>
