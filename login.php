<?php
session_start();
require("db/connection.php");
require("inc/auth.php");

isLogged();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        $checkQuery = "SELECT * FROM Users WHERE Username = :username AND Password = :password";
        $checkStatement = $dbh->prepare($checkQuery);
        $checkStatement->bindParam(':username', $username);
        $checkStatement->bindParam(':password', $password);
        $checkStatement->execute();

        $user = $checkStatement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Login successful
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['admin_level'] = $user['AdminLevel'];
            $_SESSION['Username'] =  $username;
            $_SESSION['Email'] =  $user['Email'];

            echo "<p class='success-message'>Login successful!</p>";

            echo "Session Variables:<br>";
            echo "User ID: " . $_SESSION['user_id'] . "<br>";
            echo "Admin Level: " . $_SESSION['admin_level'] . "<br>";
            echo "Username: " . $user['Username'] . "<br>";
            echo "Email: " . $user['Email'] . "<br>";

            switch ($_SESSION['admin_level']) {
                case 1:
                    header("Location: ../dashboard/mod_dashboard.php");
                    break;
                case 3:
                    header("Refresh: 5;URL=admin/Dashboard/dashboard.php");
                    break;
                default:
                    header("Refresh: 5;URL=dashboard/user_dashboard.php");
                    break;
            }
            exit();
        } else {
            echo "<p class='error-message'>Invalid username or password.</p>";
        }
    } catch (Exception $e) {
        echo "<p class='error-message'>Error: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
