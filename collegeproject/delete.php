<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <link rel="stylesheet" href="delete.css">
</head>
<body>
    <div class="container1">

        <h1>Delete Record</h1>
        <form action="delete.php" method="post">
            <label for="id"  >ID:</label>
            <input type="text" placeholder="enter an ID" name="id" id="id" required>
            <br>
            <input type="submit" id="submit" value="Delete">
        </form>
    </div>
</body>
</html>


<?php
require_once 'connection.php';


// Check if the form was submitted and the ID is set
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare and execute the SQL query to delete the record
    $stmt = $conn->prepare("DELETE FROM dashboard WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        $massage= "Record deleted successfully.";
        echo '<div class="massage">' . $massage . '</div>';
        
    } else {
        
        $warning= "No record found with the provided ID." ;
        echo '<div class="warning">' . $warning . '</div>' ;
    }

    $stmt->close();
}

$conn->close();
?>
