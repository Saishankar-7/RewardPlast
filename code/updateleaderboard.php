<?php
// Replace these with your actual database credentials
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

// Get data from the form
$username = $_POST['username'];
$plasticAmount = $_POST['plasticAmount'];

// SQL query to check if the username exists in the clients table
$checkUserQuery = "SELECT * FROM clients WHERE username = ?";
if ($stmtCheckUser = $conn->prepare($checkUserQuery)) {
    $stmtCheckUser->bind_param("s", $username);
    $stmtCheckUser->execute();
    $result = $stmtCheckUser->get_result();

    if ($result->num_rows === 0) {
        echo "Username not found in the database.";
        $stmtCheckUser->close();
        $conn->close();
        exit;
    }

    // Fetch user_type from the result
    $row = $result->fetch_assoc();
    $userType = $row['user_type'];
    $stmtCheckUser->close();
} else {
    echo "Error preparing statement: " . $conn->error;
    $conn->close();
    exit;
}

// Check if the user_type is 'admin'
if ($userType === 'admin') {
    echo "Modification cannot be done because the user is an admin.";
    $conn->close();
    exit;
}

// SQL query to update the plastic amount for the specific username
$updateQuery = "UPDATE clients SET plasticAmount = plasticAmount + ? WHERE username = ?";

// Prepare and execute the statement to update plastic amount
if ($stmtUpdate = $conn->prepare($updateQuery)) {
    $stmtUpdate->bind_param("ds", $plasticAmount, $username);
    if ($stmtUpdate->execute()) {
        echo "Plastic amount updated successfully.";
    } else {
        echo "Error updating plastic amount: " . $stmtUpdate->error;
    }
    $stmtUpdate->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}


$insertQuery2 = "INSERT INTO payments (username, plasticAmount,payment_time) VALUES (?, ?,NOW())";
    if ($stmtInsert2 = $conn->prepare($insertQuery2)) {
        $stmtInsert2->bind_param("si", $username, $plasticAmount);
        if ($stmtInsert2->execute()) {
        } else {
        }
        $stmtInsert2->close();
    } else {
    }


// Close the database connection
$conn->close();
?>
