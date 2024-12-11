<?php
$host = "srv1364.hstgr.io"; // Database host
$user = "u627256117_fincompass"; // Database username
$pass = "thisWASNTmytrue#3"; // Database password (empty if not set)
$db_name = "u627256117_fincompass"; // Database name

// Create a connection
$db = mysqli_connect($host, $user, $pass, $db_name);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
