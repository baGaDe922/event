<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("Location: login.php");
}

require_once 'connection.php';
if (isset($_POST['submit'])) {
  // Retrieve form data
  $full_name = $_POST['full_name'];
  $department_name = $_POST['department_name'];
  $event_name = $_POST['event_name'];
  $event_date = $_POST['event_date'];

  // File handling
  $target_dir = "uploads/"; // Directory to store uploaded files
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $file_name = $_FILES["file"]["name"];

  // Move uploaded file to the desired directory
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

    // Prepare and execute the SQL query
    $sql = "INSERT INTO dashboard (full_name, department_name, event_name, event_date, file)
            VALUES ('$full_name', '$department_name', '$event_name', '$event_date', '$file_name')";

    if ($conn->query($sql) === TRUE) {
      echo "Data inserted successfully";

      // Print the array of the given data
      $data = [
        'Full Name' => $full_name,
        'Department' => $department_name,
        'Event Name' => $event_name,
        'Event Date' => $event_date,
        'File Name' => $file_name
      ];

      echo "<h3>Uploaded Record:</h3>";
      echo "<ul>";
      foreach ($data as $key => $value) {
        echo "<li>$key: $value</li>";
      }
      echo "</ul>";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  } else {
    echo "Error uploading the file";
  }

  // Get the entered date from the form
  $date = $_POST["event_date"];
  // Validate the entered date
  if (strtotime($date) === false) {
    echo "Invalid date format. Please enter a valid date.";
    exit;
  }
  // Get the current date
  $currentDate = date('Y-m-d');


  // Compare the entered date with the current date
  if ($date > $currentDate) {
    echo "Please enter a past date.";
    exit;
  }
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Close the connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>uploadform</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="uploadform.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>







<body>
  <header>
    <div class="heading1">

      <h1>Event report upload</h1>
    </div>
    <nav class="navbar navbar-expand-lg bg-info">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"> <i>&#9776;</i> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#"><i class="fa fa-home" style="font-size:30px"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact"><i class="fa fa-phone" style="font-size:30px"></i></a>
            </li>
          </ul>
          <form class="d-flex">

            <a href="logout.php" class="btn btn-danger" role="button">logout</a>

          </form>
        </div>
      </div>
    </nav>
  </header>







  <div class="container">

    <div class="headings">

      <h2>Upload Form</h2>
    </div>


    <div class="container1">
      <div class="container2">
        <form method="POST" action="uploadform.php" enctype="multipart/form-data">
          <div class="inputclass">
            <label for="name" class="label"> Full Name </label>
            <input type="text" name="full_name" id="name" placeholder="Full Name" class="inputfield" />
          </div>
          <div class="inputclass">
            <label class="label" for="department_name">Department</label>
            <select id="department_name" name="department_name">
              <option value="">--Please choose an option--</option>
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
            <input type="name" name="event_name" id="eventname" placeholder="Name of Event" class="inputfield" />
          </div>

          <div class="inputclass">
            <label for="date" class="label">Date</label>
            <input type="date" name="event_date" id="date" class="inputfield" max="<?php echo date('Y-m-d'); ?>" required>
          </div>


          <div class="file_upload">


            <label for="submit_file" class="drop-container">
              <span class="drop-title">Drop files here</span>
              or
              <input type="file" id="submit_file" name="file">
            </label>
          </div>
          <div>
            <input type="submit" class="submit" name="submit" id="submit" value="Submit">
        </form>
        <div id="input-preview"></div>

      </div>

    </div>
  </div>
  </div>






  <script>
    // Retrieve the form inputs
    var fullNameInput = document.getElementById('name');
    var departmentNameInput = document.getElementById('department_name');
    var eventNameInput = document.getElementById('eventname');
    var eventDateInput = document.getElementById('date');
    var fileInput = document.getElementById('submit_file');

    // Get the input preview container
    var inputPreviewContainer = document.getElementById('input-preview');

    // Function to display the input values
    function displayInputValues() {
      // Get the selected department name
      var departmentName = departmentNameInput.options[departmentNameInput.selectedIndex].text;

      // Create an object with the input values
      var inputValues = {
        'Full Name': fullNameInput.value,
        'Department': departmentName,
        'Event Name': eventNameInput.value,
        'Event Date': eventDateInput.value,
        'File': fileInput.value,
      };

      // Clear the container before displaying the values
      inputPreviewContainer.innerHTML = '';

      // Loop through the input values object and display them
      for (var key in inputValues) {
        var label = document.createElement('label');
        label.textContent = key + ': ';

        var value = document.createElement('span');
        value.textContent = inputValues[key];

        var lineBreak = document.createElement('br');

        inputPreviewContainer.appendChild(label);
        inputPreviewContainer.appendChild(value);
        inputPreviewContainer.appendChild(lineBreak);
      }
    }

    // Call the displayInputValues function when the form inputs change
    fullNameInput.addEventListener('input', displayInputValues);
    departmentNameInput.addEventListener('change', displayInputValues);
    eventNameInput.addEventListener('input', displayInputValues);
    eventDateInput.addEventListener('input', displayInputValues);
    fileInput.addEventListener('change', displayInputValues);
  </script>









  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

  <!-- Footer -->
  <footer class="text-center text-lg-start bg-light text-muted">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">

      <span id="contact">Get connected with us:</span>
      </div>
    </section>

    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
              <i class="fas fa-gem me-3"></i>EVENT RECORD UPLOAD
            </h6>
            <p>
              developed by,
              students of MCA,(a mini Project)
              p.r. pote college of engineering and mannagement,amravati.
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              <h6 class="text-uppercase fw-bold mb-4">Prasenjit Bagade</h6>
              <p><i class="fas fa-home me-3"></i> Project Developer</p>
              <p>
                <i class="fas fa-envelope me-3"></i>
                bagadeprasenjit@gmail.com
              </p>
              <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
              <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">

              <h6 class="text-uppercase fw-bold mb-4">Project Head</h6>
              <p><i class="fas fa-home me-3"></i> tarique shaikh</p>
              <p>
                <i class="fas fa-envelope me-3"></i>
                tariqueshaikh@gmail.com.com
              </p>
              <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
              <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">Analyst</h6>
            <p><i class="fas fa-home me-3"></i> Naqeeb Khan</p>
            <p>
              <i class="fas fa-envelope me-3"></i>
              naqeebkhan@gmail.com.com
            </p>
            <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
            <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2021 Copyright:
      <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
  <script src="https://kit.fontawesome.com/5cf579fb5b.js" crossorigin="anonymous"></script>
</body>

</html>