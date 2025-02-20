<?php
$upload_dir = "uploads/";

if (isset($_POST['submit'])) {
    // Define allowed file types
    $allowed_ext = array('pdf');

    // Check if file has been uploaded
    if (!empty($_FILES['upload']['name'])) {
        // Get file information
        $file_name = $_FILES['upload']['name'];
        $file_size = $_FILES['upload']['size'];
        $file_tmp_name = $_FILES['upload']['tmp_name'];
        $file_type = $_FILES['upload']['type'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

        // Check if file type is allowed
        if (in_array($file_ext, $allowed_ext)) {
            // Check if file size is within limit
            if ($file_size <= 4000000) {
                // Generate unique file name to prevent overwriting
                $new_file_name = uniqid('file_', true) . '.' . $file_ext;
                $target_dir = $upload_dir . $new_file_name;

                // Move file to upload directory
                if (move_uploaded_file($file_tmp_name, $target_dir)) {
                    $message = '<p style="color: green;">File uploaded successfully!</p>';
                } else {
                    $message = '<p style="color: red;">File upload failed. Please try again.</p>';
                }
            } else {
                $message = '<p style="color: red;">File is too large. Please choose a smaller file.</p>';
            }
        } else {
            $message = '<p style="color: red;">Invalid file type. Please choose a PDF file.</p>';
        }
    } else {
        $message = '<p style="color: red;">Please choose a file to upload.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Form</title>
    <link rel="stylesheet" href="uploadform11.css">
</head>

<body>
    <header>
        <div class="heading">
            <h1>P.R. POTE COLLEGE OF ENGINEERING AND MANAGEMENT</h1>
        </div>
        <ul>
            <li><a href="default.asp">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="contact.asp">Contact</a></li>
            <li><a href="about.asp">About</a></li>
        </ul>
    </header>
    <main>
        <fieldset>
            <legend>
                <h2>Upload Form</h2>
            </legend>
            <div class="container">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                    <div class="one">
                        <label for="department">Select Department</label>
                        <select name="department" id="department">
                            <option value="select">Select</option>
                            <option value="MCA">MCA</option>
                            <option value="MBA">MBA</option>
                            <option value="CSE">CSE</option>
                            <option value="MECHANICAL">MECHANICAL</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="two">
                        <label for="eventtype">Select event type:</label><br>
                        <select name="eventtype" id="eventtype">
                            <option value="select">Select</option>
                            <option value="religious">Religious</option>
                            <option value="educational">Educational</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="three">
                        <input type="text" id="eventname" placeholder="event name" /><br />

                    </div>
                    <div class="four">
                        <textarea name="description" id="discription" cols="30" rows="10" placeholder="event description in shoret"></textarea>
                    </div>
                    <div class="five">
                        <label for="eventdate">Event Date <br></label>
                        <input type="date" id="eventdate" name="eventdate">
                    </div>
                    <!-- <div class="six">

                        <button type="submit" onclick="send_data()">submit</button>
                    </div> -->

                    <div class="file_upload">
                        <?php
                        echo $message ?? null;
                        ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                            <br>
                            <h3>
                                Select Report PDF To Upload:
                            </h3>
                            <br>
                            <input type="file" name="upload" id="uploadfile">
                            <br>

                            <button type="submit" name="submit" id="submit_file"></button>


                        </form>

                    </div>
                </form>
        </fieldset>
    </main>
</body>

</html>