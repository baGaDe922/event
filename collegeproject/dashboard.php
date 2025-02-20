<?php
// session_start();
// if (!isset($_SESSION["admin_login"])) {
//   header(" Location: admin_login.php ");
// }

require_once 'connection.php';

?>
<?php
require_once 'connection.php';

$query = "SELECT * FROM dashboard";
$query_run = mysqli_query($conn, $query);

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

  <div class="container mt-5 ">
    <form class="d-flex">

      <a href="logout.php" class="btn btn-danger" role="button">logout</a>

    </form>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-primary">
            <h4 class="text-white">event report upload records (online data/record upload on cloud) </h4>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>full name</th>
                  <th>department</th>
                  <th>event name</th>
                  <th>date</th>
                  <th>file</th>
                  <th>edit</th>
                  <th>delete</th>

                </tr>
              </thead>
              <tbody>
                <?php
                if (mysqli_num_rows($query_run) > 0)  // check if record is present or not
                {
                  foreach ($query_run as $row) {
                ?>
                    <tr>
                      <td> <?php echo $row['id']; ?> </td>
                      <td> <?php echo $row['full_name']; ?> </td>
                      <td> <?php echo $row['department_name']; ?> </td>
                      <td> <?php echo $row['event_name']; ?> </td>
                      <td> <?php echo $row['event_date']; ?> </td>
                      <td> <img src="<?php echo "uploads/" . $row['file']; ?> " width="100px" alt="file"></td>
                      <td> <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-info">edit</a> </td>
                      <td> <a href="delete.php" class="btn btn-danger">delete</a> </td>

                    </tr>

                  <?php

                  }
                } else {
                  ?>
                  <tr>
                    <td>no records available </td>
                  </tr>

                <?php

                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>