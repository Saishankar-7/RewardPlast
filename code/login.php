<?php
// Update these credentials with your actual database information
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$hostname = "localhost";
$username_db = "root";
$password_db = "";
$database = "project";

// Establish database connection
$con = new mysqli($hostname, $username_db, $password_db, $database);

if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query
    $stmt = $con->prepare("SELECT * FROM clients WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        if ( $data['password']===$password) {
            // Successful login
            $_SESSION['username'] = $username;
            $userType = $data['user_type'];
            if ($userType === 'admin') {
                $response = array(
                    'status' => 'success',
                    'redirect' => 'page2.php'
                    
                );
            } elseif ($userType === 'user') {
                $response = array(
                    'status' => 'success',
                    'redirect' => 'page1.php'
                   
                );
            } else {
                // Default redirect if user type is not recognized
                $response = array(
                    'status' => 'error',
                    'redirect' => 'home1.html'
                );
            }
        } else {
            // Invalid password
            $response = array(
                'status' => 'error',
                'message' => 'Invalid password for the existing username ' . $username
            );
        }
    } else {
        // Username not found in the database
        $response = array(
            'status' => 'error',
            'message' => 'Username ' . $username . ' not found in the database'
        );
    }
} else {
    // Missing username or password in the POST request
    $response = array(
        'status' => 'error',
        'message' => 'Username and password are required'
    );
}

// Set appropriate headers for JSON response
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Adjust this based on your requirements

// Send the JSON response
echo json_encode($response);
?>
