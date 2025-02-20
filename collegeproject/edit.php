<?php
require_once 'connection.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="uploadform.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <h2>update record</h2>



    <?php
    echo "update record for id:  ";
    $id = $_GET['id'];
    $query = "SELECT * FROM dashboard WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            echo $row['id'];
    ?>
            <div class="container1">
                <div class="container2">
                    <form method="POST" action="edit.php" enctype="multipart/form-data">
                        <div class="inputclass">
                            <label for="name" class="label"> Full Name </label>
                            <input type="text" value="<?php echo $row['full_name'];  ?>" name="full_name" id="name" placeholder="Full Name" class="inputfield" />
                        </div>
                        <div class="inputclass">
                            <label class="label" for="department_name">Department</label>
                            <select id="department_name" name="department_name">
                                <option value="<?php echo $row['department_name'];  ?>"><?php echo $row['department_name'];  ?></option>
                                <option value="MCA">MCA</option>
                                <option value="MBA">MBA</option>
                                <option value="CSC">CSC</option>
                                <option value="MACHANICAL">MACHANICAL</option>
                                <option value="AIDS">AIDS</option>
                                <option value="CIVIL">CIVIL</option>
                            </select>
                        </div>
                        <div class="inputclass">
                            <label for="name" class="label"> Event Name </label>
                            <input type="name" name="event_name" value="<?php echo $row['event_name'];  ?>" id="eventname" placeholder="Name of Event" class="inputfield" />
                        </div>

                        <div class="inputclass">
                            <label for="date" class="label">Date</label>
                            <input type="date" name="event_date" id="date" value="<?php echo $row['event_date'];  ?>" class="inputfield" max="<?php echo date('Y-m-d'); ?>" required>
                        </div>


                        <div class="file_upload">


                            <label for="submit_file" class="drop-container">

                                <input type="file" id="submit_file" name="file">
                                <input type="hidden" name="file_old" value="<?php echo $row['file'];  ?>">
                            </label>
                        </div>
                        <div>
                            <input type="submit" class="submit" name="submit" id="submit" value="UPDATE">
                    </form>
                    <div id="input-preview"></div>

                </div>

            </div>
            </div>
            </div>

    <?php
        }
    } else {
        echo "no record available";
    }

    ?>


    <script src="https://kit.fontawesome.com/5cf579fb5b.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>