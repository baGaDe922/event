<?php
session_start();
if(isset($_SESSION["user"])){
header("Location: uploadform/uploadform.php");
}
?>


<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="container">

        <h1>Welcome</h1>
        <form action="login.php" method="POST">

        <?php
            if (isset($_POST["login"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];
                require_once "connection.php";
                $sql = " SELECT * FROM users WHERE username = '$username'";
                $result = mysqli_query($conn,$sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        session_start();
                        $_SESSION["user"] = "yes";
                        header("Location: uploadform.php");
                        die();
                    }
                    else {
                        echo "password does not match";
                    }
                }
                else{
                    echo "username does not exist";
                }
            }


        ?>

        <label>username</label>
            <input type="text" class="" name="username">
            <label>Password</label>
            <input type="password" class="" name="password">
            <a href="admin_login.php">login as ADMIN</a>
            <button class="" name="login">Login</button>
            <div class="link">Not a member? <a href="signup.php">Sigup here</a></div>

        </form>
    </div>
</body>

</html>