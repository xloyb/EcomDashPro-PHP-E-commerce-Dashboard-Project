<?php
require("../db/connection.php");


function getArticles($dbh) {
    $getArticlesQuery = "SELECT * FROM Articles";
    $getArticlesStatement = $dbh->prepare($getArticlesQuery);
    $getArticlesStatement->execute();
    $articles = $getArticlesStatement->fetchAll(PDO::FETCH_ASSOC);

    return $articles;
}

function updateQuantityInBuyingList($user_id, $article_id, $quantity, $dbh) {
    try {
        $updateQuantityQuery = "UPDATE ArticleUsers SET Quantity = :quantity WHERE UserID = :user_id AND ArticleID = :article_id";
        $updateQuantityStatement = $dbh->prepare($updateQuantityQuery);
        $updateQuantityStatement->bindParam(':user_id', $user_id);
        $updateQuantityStatement->bindParam(':article_id', $article_id);
        $updateQuantityStatement->bindParam(':quantity', $quantity);
        $updateQuantityStatement->execute();

        return true; 
    } catch (Exception $e) {
        return false;
    }
}

function removeFromBuyingList($user_id, $article_id, $dbh) {
    try {
        $removeProductQuery = "DELETE FROM ArticleUsers WHERE UserID = :user_id AND ArticleID = :article_id";
        $removeProductStatement = $dbh->prepare($removeProductQuery);
        $removeProductStatement->bindParam(':user_id', $user_id);
        $removeProductStatement->bindParam(':article_id', $article_id);
        $removeProductStatement->execute();

        return true; 
    } catch (Exception $e) {
        return false;
    }
}

function getUserDetails($user_id, $dbh) {
    $getUserDetailsQuery = "SELECT * FROM users WHERE UserID = :user_id";
    $getUserDetailsStatement = $dbh->prepare($getUserDetailsQuery);
    $getUserDetailsStatement->bindParam(':user_id', $user_id);
    $getUserDetailsStatement->execute();
    $user_details = $getUserDetailsStatement->fetch(PDO::FETCH_ASSOC);

    return $user_details;
}


function addToBuyingList($user_id, $article_id, $quantity, $dbh) {
    try {
        $checkArticleQuery = "SELECT * FROM ArticleUsers WHERE UserID = :user_id AND ArticleID = :article_id";
        $checkArticleStatement = $dbh->prepare($checkArticleQuery);
        $checkArticleStatement->bindParam(':user_id', $user_id);
        $checkArticleStatement->bindParam(':article_id', $article_id);
        $checkArticleStatement->execute();
        $existingArticle = $checkArticleStatement->fetch(PDO::FETCH_ASSOC);

        if (!$existingArticle) {
            $insertArticleQuery = "INSERT INTO ArticleUsers (UserID, ArticleID, Quantity) VALUES (:user_id, :article_id, :quantity)";
            $insertArticleStatement = $dbh->prepare($insertArticleQuery);
            $insertArticleStatement->bindParam(':user_id', $user_id);
            $insertArticleStatement->bindParam(':article_id', $article_id);
            $insertArticleStatement->bindParam(':quantity', $quantity);
            $insertArticleStatement->execute();

            return true; // Success
        } else {
            return false; // Article is already in the buying list
        }
    } catch (Exception $e) {
        return false;
    }
}

function getBuyingList($user_id, $dbh) {
    try {
        $getBuyingListQuery = "SELECT A.*, AU.Quantity FROM Articles A INNER JOIN ArticleUsers AU ON A.ArticleID = AU.ArticleID WHERE AU.UserID = :user_id";
        $getBuyingListStatement = $dbh->prepare($getBuyingListQuery);
        $getBuyingListStatement->bindParam(':user_id', $user_id);
        $getBuyingListStatement->execute();
        $buying_list = $getBuyingListStatement->fetchAll(PDO::FETCH_ASSOC);

        return $buying_list;
    } catch (Exception $e) {
        
        return [];
    }
}





?>
