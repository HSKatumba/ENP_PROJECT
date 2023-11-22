<?php
// connection with the database 
$server = "localhost";
$username = "root";
$password = "";
$db = "jobsportal";

// establish connection 
$conn = mysqli_connect($server, $username, $password, $db);

if (!$conn) {
    
    die("connection frailed" . mysqli_connect_errno($conn));
}