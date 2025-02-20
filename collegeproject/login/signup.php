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
        <?php
        if (isset($_POST["signup"])) {
            $username = $_POST["username"];
            $password = $_POST["password"]; 
            $repeatpassword = $_POST["repeatpassword"]; 

            $passwordhash =password_hash($password, PASSWORD_DEFAULT); 

            $errors = array();

            if(empty($username) OR empty($password) OR empty($repeatpassword ))    {
                array_push($errors, "all fields are required");
            }  
            
            if(strlen($password)<8){
                array_push($errors,"password must be 8 characters long");
            }
            if($password!=$repeatpassword){
                array_push($errors,"passwords does not match");
            }

            require_once "connection.php";
            $sql = "SELECT * FROM users WHERE username ='$username' ";
            $result = mysqli_query ($conn,$sql);
            $rowCount = mysqli_num_rows($result);
            if($rowCount>0){
                array_push($errors,"username already exist!");
            }


            if(count($errors)>0){
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }

            }
            else{
                    
                    $sql = "INSERT INTO users (username, password) VALUES ( ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $preparestmt=mysqli_stmt_prepare($stmt,$sql);
                    if($preparestmt){
                        mysqli_stmt_bind_param($stmt,"ss",$username,$passwordhash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-sucess' >you are registerd sucessfully</div>";
                    }else{
                        die("something went wrong");
                    }
            }
        }   
            ?>
 
        <h1>Welcome</h1>
        <form action="signup.php" method="POST">

            <label>username</label>
            <input type="text" class="" name="username">
            <label>Password</label>
            <input type="password" class="" name="password">
            <label>repeat Password</label>
            <input type="password" class="" name="repeatpassword">

            <label for="checkbox">Stay logged in</label>
            <input type="checkbox" name="stayLoggedIn" id="chechkbox" value="1"> <br><br>

            <button class="" value="register" name="signup">Submit</button>
            <div class="link">already a member? <a href="login.php">login here</a></div>

        </form>
    </div>
</body>

</html>