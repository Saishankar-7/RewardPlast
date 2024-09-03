<?php
 $host = 'localhost';
 $username = 'root';
 $password = '';
 $database = 'project';

 // Create a database connection
 $conn = new mysqli($host, $username, $password, $database);

 // Check the connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

if (isset($_POST['username'])) {
    $username = $_POST['username'];
   
    $sql = "DELETE FROM clients WHERE username = '$username'";

    if ($conn->query($sql) === TRUE) {
        echo "User removed successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
