<?php

$HostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "event_report_upload";

$conn = mysqli_connect($HostName,$dbUser,$dbPassword,$dbName);
if(!$conn){
  $errormassage = "connection failed  ";
  echo '<div class="errormassage">' . $errormassage . '</div>';

  die("something went wrong" .  $con->connect_error);
}
else{
  $sucessmassage = "connection sucessfull  ";
  echo '<div class="sucessmassage">' . $sucessmassage . '</div>';
}
?>