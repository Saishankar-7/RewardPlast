<?php
$response = array();

if (
    isset($_POST['name']) &&
    isset($_POST['username']) &&
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['confirmpassword'])
) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "project");
    if ($conn->connect_error) {
        $response['message'] = 'Could not connect to the database.';
    } else {
        try {
            // Check if the username already exists
            $stmt = $conn->prepare("SELECT * FROM clients WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $response['message'] = "Username '$username' is already taken. Please choose a different username.";
            } else {
                // Username is unique, proceed with registration
                $stmt->close();
                $stmt = $conn->prepare("INSERT INTO clients (name, username, email, password, confirmpassword) VALUES (?, ?, ?, ?, ?)");
                if (!$stmt) {
                    $response['message'] = 'Error in the prepared statement: ' . $conn->error;
                } else {
                    $stmt->bind_param("sssss", $name, $username, $email, $password, $confirmpassword);
                    if ($stmt->execute()) {
                        $response['message'] = 'Registration Successful';
                    } else {
                        $response['message'] = 'Error in registration: ' . $stmt->error;
                    }
                }
            }

            if ($stmt !== false) {
                $stmt->close();
            }
        } catch (Exception $e) {
            $response['message'] = 'An error occurred: ' . $e->getMessage();
        }

        $conn->close();
    }
} else {
    $response['message'] = 'Please fill in all the required fields.';
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
