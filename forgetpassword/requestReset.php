<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'config.php';

if (isset($_POST['username'])) {

    $username = $_POST['username']; // Use 'username' instead of 'email'

    // Retrieve the email associated with the username from your database
    $query = mysqli_query($con, "SELECT email FROM clients WHERE username = '$username'");
    $row = mysqli_fetch_assoc($query);

    if ($row) {
        $emailTo = $row['email'];
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        $code = uniqid(true); // true for more uniqueness 

        // Insert the reset code and username into the resetPasswords table
        $query = mysqli_query($con,"INSERT INTO resetpasswords(code, username) VALUES('$code','$username')"); // Update the column name to 'username'
        if (!$query) {
          echo 'Error: '. mysqli_error($con);
        }
        
        try {
            //Server settings
            $mail->SMTPDebug = 0;     // Enable verbose debug output, 1 for production , 2,3 for debugging in development 
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'rewardplast@gmail.com';                 // SMTP username
            $mail->Password = 'yxhv lzyt iqqv aird';                           // SMTP password
            // $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            // $mail->Port = 587;   // for TLS                                 // TCP port to connect to
            $mail->Port = 465;

            //Recipients
            $mail->setFrom('email@gmail.com', 'REWARDPLAST'); // from who? 
            $mail->addAddress($emailTo,$username);     // Update the recipient's address using the retrieved email

            $mail->addReplyTo('no-replay@example.com', 'No Replay');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Content
            // this gives you the exact link of your site on the right page 
            // if you are on an actual web server, instead of http://" . $_SERVER['HTTP_HOST'] write your link 
            $url = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/resetPassword.php?code=$code"; 
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Your password reset link';
            $mail->Body    = "<h1> You requested a password reset </h1>
                              <h3> $username </h3>
                             Click <a href='$url'>this link</a> to do so";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            // To solve a problem 
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );

            $mail->send();
            echo '<script>alert("Reset link sent successfully."); window.location.href = "../reward.html";</script>';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error:' . $mail->ErrorInfo;
        }
    } else {
        echo '<script>alert("Username not found.");</script>';
    }

    exit(); // to prevent the user from submitting more than once 
}
?>
 <button class="goback-button"onclick="goBack()"><ion-icon name="arrow-back-outline"></ion-icon></button>
    <section>
        <h2><ion-icon name="earth"></ion-icon>REWARDPLAST</h2>
        <p class="pa">TURNING THE TRASH INTO TREASURE</p>
    </section>
    <div class="line-container">
        <hr class="line">
    </div>
    <h1>Enter your Username</h1>
<form method="post">
    <input type="text" name="username" placeholder="Username" autocomplete="off">
    <br>
    <input type="submit" name="submit" value="Reset Link">
</form>
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
            background-color:#ccea7b;
            padding: 20px;
            margin-bottom: 20px;
        }
         form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        /* Style for the input fields */
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
            background-color: #fff;
        }

        /* Style for the submit button */
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            border-radius: 3px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Style for the submit button on hover */
        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Style for the reset link */
        .reset-link {
            margin-top: 10px;
            text-align: center;
        }

        /* Add more styles as needed */

        /* Style for the body */
        body {
            font-family: Arial, sans-serif;
            background-color:#ccea7b ;
        }
    /* Style for the form container */
    .goback-button {
            position: fixed; /* Fixed positioning */
            top: 20px; /* Adjust the top position as needed */
            left: 20px; /* Adjust the left position as needed */
            z-index: 9999; /* Ensure it's above other elements */
        cursor: pointer;
        background: linear-gradient(90deg,#1e0b04,#71412a);
        border-radius: 1px;
        left:40px;
        top:25px;
        font-size: 35px;
        color:white;
        padding: 6px 12px;
        transition: all .5s ease;
        }
</style>
<script>
    function goBack() {
        window.location.href = '../reward.html'; // Redirect back to page1.php
    }
    </script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>