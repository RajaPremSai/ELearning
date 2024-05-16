<?php
$db_host = "127.0.0.1:3307";
$db_user = "root";
$db_password = "";
$db_name = "lms_db1";

// Create Connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check Connection
if($conn->connect_error) {
 die("connection failed");
} 
// else {
//  echo"connected";
// }
?>