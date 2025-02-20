<?php
session_start();
if(isset($_SESSION["user"])){
header("Location: login.php")
}

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
  <title>uploadform</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="uploadform.css">
</head>

<body>
  <header>
    <div class="heading1">

      <h1>Event report upload</h1>
    </div>
    <nav class="navbar bg-primary-subtle ">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <h3>Navigation</h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><ion-icon name="navigate-outline"></ion-icon></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            </ul>
            <form class="d-flex mt-3" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
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
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
          <div class="inputclass">
            <label for="name" class="label"> Full Name </label>
            <input type="text" name="name" id="name" placeholder="Full Name" class="inputfield" />
          </div>
          <div class="inputclass">
            <label class="label" for="department">Department</label>
            <select id="department">
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
            <label for="email" class="label"> Event Name </label>
            <input type="email" name="email" id="eventname" placeholder="Name of Event" class="inputfield" />
          </div>

          <div class="inputclass">
            <div class="inputclass w-full">
              <label for="date" class="label"> Date </label>
              <input type="date" name="date" id="date" class="inputfield" />
            </div>
          </div>


          <div class="file_upload">
            <?php
                echo $message ?? null;
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">

              <label for="submit_file" class="drop-container">
                <span class="drop-title">Drop files here</span>
                or
                <input type="file" id="submit_file" name="submit">
              </label>
            </div>
            <div>
              <button class="submit" name="submit" id="submit">Submit</button>
            </form>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

  <!-- Footer -->
  <footer class="text-center text-lg-start bg-light text-muted">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">

      <span>Get connected with us:</span>
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
</body>

</html>