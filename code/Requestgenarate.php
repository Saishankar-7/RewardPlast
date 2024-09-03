<?php
session_start();
require 'connection.php';

// Check if the user is logged in and their username is in the session
if (!isset($_SESSION['username'])) {
    exit();
}

$username = $_SESSION['username'];

if (isset($_POST["submit"])) {
    $street = $_POST["street"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $postal_code = $_POST["postal_code"];
    
    if ($_FILES["image"]["error"] == 4) {
        echo "<script> alert('Image Does Not Exist'); </script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];
    
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
    
        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Invalid Image Extension');</script>";
        } else if ($fileSize > 1000000) {
            echo "<script>alert('Image Size Is Too Large');</script>";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;
    
            move_uploaded_file($tmpName, 'img/' . $newImageName);
            
            $query = "INSERT INTO addresses (username, street, city, state, postal_code, image) 
                      VALUES ('$username', '$street', '$city', '$state', '$postal_code', '$newImageName')";
            mysqli_query($conn, $query);
            echo "<script>alert('Successfully Added');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Upload Image File</title>
    <link rel="stylesheet" href="request1.css">
  </head>
  <body style="background-color:#ccea7b;">
  <section>
    <h2><ion-icon name="earth"></ion-icon>REWARDPLAST</h2>
    <p class="pa">TURNING THE TRASH INTO TREASURE</p>
</section>
  <div class="margin">
        <h1>REQUEST FORM</h1>
        </div>
        <div class="request-box">
        <form class="" action="" method="post"  id="combined-form" autocomplete="off" enctype="multipart/form-data">
        <div id="address-form" class="form-container">
            <label for="street">Street Address:</label>
            <input type="text" id="street" name="street" placeholder="Street Address" required>
            <label for="city">City:</label>
            <input type="text" id="city" name="city" placeholder="City" required>
            <label for="state">State:</label>
            <input type="text" id="state" name="state" placeholder="State" required>
            <label for="postal">Postal Code:</label>
            <input type="text" id="postal" name="postal_code" placeholder="Postal Code" required>
        </div>
            <div id="file-upload-form" class="form-container">
           <label for="image">Image : </label>
             <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png" value=""> <br> <br>
         </div>
         <div class="button-container">
         <button id="go-back-button"onclick="goBack()">Goback</button>
                        <button type="submit" name="submit">Submit</button>
          </div>
    </form>
            </div>
<script>
      function goBack() {
        window.location.href = 'userprofile.php'; // Redirect back to page1.php
      }

      function submitForm() {
        // Perform form submission logic here if needed
        // For now, you can leave this function empty
      }

      // Prevent form submission on Enter key press
      document.getElementById('combined-form').addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
          e.preventDefault();
        }
      });
    </script>
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </body>
</html>
