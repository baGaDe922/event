<?php
session_start();

// Include the database connection file
require_once 'connection.php';

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["admin_username"];
    $password = $_POST["admin_password"];

    // Retrieve user from the database
    $query = "SELECT * FROM admin_login WHERE admin_username = '$username' AND admin_password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        // Store the username in a session variable
        $_SESSION["admin_username"] = $username;

        // Redirect to another page
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid credentials
        echo "Invalid username or password";
    }
}
?>

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="container">
        <h1>Welcome</h1>
        <form action="admin_login.php" method="POST">
            <label for="username">Username</label>
            <input id="username" type="text" name="admin_username" required>
            <label for="password">Password</label>
            <input id="password" type="password" name="admin_password" required>
            <a href="login.php">Login as user</a>
            <button id="login" type="submit" name="admin_login">Login as Admin</button>
        </form>
    </div>
</body>

</html>