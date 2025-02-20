<?php

$HostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "event_report_upload";

$conn = mysqli_connect($HostName,$dbUser,$dbPassword,$dbName);
if(!$conn){
  die("something went wrong");
}


?>