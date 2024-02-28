<?php
require("inc/settings.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Include your database connection file
    include_once 'db/connection.php';

    try {
        // Retrieve user input
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validate password match
        if ($password != $confirm_password) {
            die("Error: Passwords do not match.");
        }

        // Insert user data into the database without hashing the password
        $query = "INSERT INTO users (Username, Password, Email) VALUES (?, ?, ?)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password); // Store the password as plain text
        $stmt->bindParam(3, $email);

        if ($stmt->execute()) {
            // Retrieve user data after registration
            $query = "SELECT UserID, AdminLevel FROM users WHERE Username = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set session variables
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['admin_level'] = $user['AdminLevel'];
            $_SESSION['Username'] = $username;
            $_SESSION['Email'] = $email;

            $url = $settings['user_dash'];
            header("Location: $url");
            exit;
        } else {
            throw new Exception("Error: " . $stmt->errorInfo()[2]);
        }
    } catch (Exception $e) {
        // Handle exceptions (display user-friendly message or log)
        echo "Registration failed: " . $e->getMessage();
    } finally {
        // Close the statement
        if ($stmt) {
            $stmt = null;
        }
    }
}
?>
