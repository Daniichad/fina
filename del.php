<?php
session_start();
include("conne.php");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle deletion from track table
if (isset($_GET["note"]) && isset($_GET["date"])) {
    $note = mysqli_real_escape_string($db, $_GET["note"]);
    $date = mysqli_real_escape_string($db, $_GET["date"]);
    
    $sql_delete = "DELETE FROM track WHERE note = ? AND user_id = ?";
    $stmt = mysqli_prepare($db, $sql_delete);
    mysqli_stmt_bind_param($stmt, "si", $note, $user_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
            alert('Deleted Successfully');
            window.location.href = 'tracker.php';
            </script>";
    } else {
        echo "<script>
            alert('Error deleting record');
            window.location.href = 'tracker.php';
            </script>";
    }
    mysqli_stmt_close($stmt);
}

// Handle deletion from business table
if (isset($_GET["product_name"]) && isset($_GET["date"])) {
    $product_name = mysqli_real_escape_string($db, $_GET["product_name"]);
    $date = mysqli_real_escape_string($db, $_GET["date"]);
    
    $sql_delete = "DELETE FROM business WHERE product_name = ? AND user_id = ?";
    $stmt = mysqli_prepare($db, $sql_delete);
    mysqli_stmt_bind_param($stmt, "si", $product_name, $user_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
            alert('Deleted Successfully');
            window.location.href = 'tracker_business.php';
            </script>";
    } else {
        echo "<script>
            alert('Error deleting record');
            window.location.href = 'tracker_business.php';
            </script>";
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($db);
?>