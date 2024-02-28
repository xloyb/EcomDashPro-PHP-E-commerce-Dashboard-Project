<?php 
require("inc/auth.php");
session_start();
isLogged();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>User Registration</h2>
    <form action="process_registration.php" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" name="username" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password:</label>
            <input type="password" class="form-control" name="confirm_password" required>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>

    <!-- Bootstrap JS (optional, but some components may require it) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
