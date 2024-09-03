<?php
require 'config.php';

if (!isset($_GET['code'])) {
    exit("Can't find the page");
}

$code = $_GET['code'];
$getCodequery = mysqli_query($con, "SELECT * FROM resetpasswords WHERE code = '$code'");
if (mysqli_num_rows($getCodequery) == 0) {
    exit("the link is expired");
}

// Function to validate the password based on the specified criteria
function validatePassword($password)
{
    // Minimum 8 characters, 1 uppercase, 1 lowercase, 1 number, and 1 special character
    return preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
}

// Handling the form
if (isset($_POST['password']) && isset($_POST['confirmpassword'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];

    if ($password === $confirmPassword && validatePassword($password)) {
        $row = mysqli_fetch_assoc($getCodequery);
        $username = $row['username'];

        // Update the user's password and confirm password in the 'clients' table based on the username
        $updatePasswordQuery = mysqli_query($con, "UPDATE clients SET password = '$password', confirmpassword = '$confirmPassword' WHERE username = '$username'");

        if ($updatePasswordQuery) {
            // Delete the used reset code from 'resetPasswords' table
            $deleteCodeQuery = mysqli_query($con, "DELETE FROM resetPasswords WHERE code = '$code'");

            if ($deleteCodeQuery) {
                // Password updated successfully, show an alert and redirect to 'reward.html'
                echo '<script>alert("Password updated successfully."); window.location.href = "../reward.html";</script>';
                exit;
            } else {
                exit('Failed to delete reset code');
            }
        } else {
            exit('Failed to update password');
        }
    } else {
        echo '<script>alert("Password does not meet the criteria or does not match the confirm password.");</script>';
    }
}
?>
    <section>
        <h2><ion-icon name="earth"></ion-icon>REWARDPLAST</h2>
        <p class="pa">TURNING THE TRASH INTO TREASURE</p>
        </section>
    <div class="home">
    <div class="line-container">
        <hr class="line">
    </div>
    <h1>Reset Password</h1>
<form method="post">
    <input type="password" name="password" id="password" placeholder="New password (at least 8 characters, 1 uppercase, 1 lowercase, 1 number, and 1 special character)" required>
    <!-- Add a button to toggle password visibility -->
    <button type="button" id="togglePassword">Show Password</button>
    <br>
    <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm password" required>
    <br>
    <input type="submit" name="submit" value="Update password">
</form>
</div>
<script>
// JavaScript to toggle password visibility
const passwordInput = document.getElementById("password");
const confirmPasswordInput = document.getElementById("confirmpassword");
const togglePasswordButton = document.getElementById("togglePassword");

togglePasswordButton.addEventListener("click", function () {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        confirmPasswordInput.type = "text";
        togglePasswordButton.textContent = "Hide Password";
    } else {
        passwordInput.type = "password";
        confirmPasswordInput.type = "password";
        togglePasswordButton.textContent = "Show Password";
    }
});
</script>
<style>
    * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', 'sans-serif';
        }

        section {
            background: linear-gradient(90deg, #1e0b04, #71412a);
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        section h2 {
            text-align: center;
            font-size: 3em;
        }

        section p {
            text-align: center;
            font-size: 1.5em;
        }
        h1 {
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
        }
        .home
        {
            position: absolute;
            width: 100%;
            height: 100vh; 
            background:url('project.jpg') no-repeat;
            background-size: cover;
            background-position: center;
        }
    /* Style for the form container */
form {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f2f2f2; /* Set your desired background color here */
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

/* Style for the input fields */
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 16px;
}

/* Style for the toggle password button */
#togglePassword {
    background-color: #007BFF; /* Set your desired button background color here */
    border: none;
    border-radius: 3px;
    color: #fff;
    font-size: 16px;
    padding: 10px;
    cursor: pointer;
}

/* Style for the submit button */
input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #007BFF; /* Set your desired button background color here */
    border: none;
    border-radius: 3px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
}

/* Style for the submit button on hover */
input[type="submit"]:hover {
    background-color: #0056b3; /* Change the button background color on hover */
}
</style>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
