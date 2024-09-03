<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'connection.php';

if (isset($_POST['solve_id'])) {
    $solve_id = $_POST['solve_id'];
    // Perform database delete operation using SQL
    $sql = "DELETE FROM addresses WHERE id = $solve_id";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    exit;
}
?>
