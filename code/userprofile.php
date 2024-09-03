
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Address Book</title>
    <style>
      /* Body styles */
      body {
        font-family: Arial, sans-serif;
        background-color:#ccea7b;
        margin: 0;
        padding: 0;
        text-align: center;
      }
        section {
            background: linear-gradient(90deg, #1e0b04, #71412a);
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }
        section h2{
            text-align: center;
            font-size: 3em;
            text-align: center;
            background: linear-gradient(90deg, #1e0b04, #71412a);
            color: #fff;
            padding: 20px 0;
            margin: 0;
            width: 100%;
        }
        section p{
            text-align: center;
            font-size: 1.5em;
        }
        /*header styles */
      h1 {
        padding: 20px;
        margin: 0;
      }

      /* Form styles */
      form {
        background-color:#A4BE5C;;
        border-radius: 10px;
        padding: 20px;
        max-width: 400px;
        margin: 20px auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      /* Label styles */
      label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        color: #333;
      }

      /* File input styles */
      input[type="file"] {
        display: block;
        margin: 0 auto;
        padding: 10px;
        border: 2px solid black;
        border-radius: 5px;
        width: 80%; /* Reduce the width of the file input */
        font-size: 16px;
      }

      /* Submit button styles */
      button[type="submit"] {
        display: block;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
      }

      /* Submit button hover effect */
      button[type="submit"]:hover {
        background-color: #0056b3;
      }
      a{
        display: block;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 20px;
      }
      a:hover{
        background-color: #0056b3;
      }
      
      /* Circular image styles */
      .circular-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin: 10px auto; /* Add some margin for spacing */
        border: 4px solid #007bff; /* Add a border with a color */
      }
    </style>
     <button class="goback-button"onclick="goBack()"><ion-icon name="arrow-back-outline"></ion-icon></button>
</head>
  <body>
  <section>
            <h2><ion-icon name="earth"></ion-icon>REWARDPLAST</h2>
            <p class="pa">TURNING THE TRASH INTO TREASURE</p>
        </section>
    <div class="line-container">
        <hr class="line">
    </div>
    <h1>MY PROFILE</h1>
    
    <?php
session_start();
require 'connection.php';

// Function to get the user's name from the database
function getUserName() {
    // Replace these lines with your database connection code
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_SESSION['username']; // Assuming you store the logged-in user's username in a session variable

    // Modify the SQL query to select the name based on the username
    $sql = "SELECT name FROM clients WHERE username = '$username'";

    $result = $conn->query($sql);

    if ($result === false) {
        die("Error in SQL query: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["name"];
    } else {
        return "Guest"; // Default name if user not found
    }
}

// Check if the user is logged in and their username is in the session
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the user is not logged in
    // Replace 'login.php' with your actual login page
    exit();
}

$username = $_SESSION['username'];

// Handle form submission for adding addresses
if (isset($_POST["submit"])) {
    if ($_FILES["image"]["error"] == 4) {
        echo "<script>alert('Image Does Not Exist');</script>";
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
    
            move_uploaded_file($tmpName, 'profiles/' . $newImageName);
            $username = mysqli_real_escape_string($conn, $_SESSION['username']);
           
            
            // Check if the user already exists
            $checkQuery = "SELECT * FROM user_profiles WHERE username = '$username'";
            $result = mysqli_query($conn, $checkQuery);
            
            if (mysqli_num_rows($result) > 0) {
                // User exists, perform an update
                $updateQuery = "UPDATE user_profiles SET image = '$newImageName' WHERE username = '$username'";
                
                if (mysqli_query($conn, $updateQuery)) {
                    echo "<script>alert('Successfully Updated');</script>";
                } else {
                    echo "<script>alert('Failed to Update');</script>";
                }
            } else {
                // User doesn't exist, perform an insert
                $insertQuery = "INSERT INTO user_profiles (username, image) VALUES ('$username', '$newImageName')";
                
                if (mysqli_query($conn, $insertQuery)) {
                    echo "<script>alert('Successfully Inserted');</script>";
                } else {
                    echo "<script>alert('Failed to Insert');</script>";
                }
              }
    }
}
}
// Fetch and display existing data
$query = "SELECT * FROM user_profiles WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Assuming you want to display all matching rows (if there are multiple rows for the same username)
    while ($row = mysqli_fetch_assoc($result)) {
        $image = $row['image'];
        // Display the image using an HTML <img> tag
        echo "<img src='profiles/$image' alt='User Image' class='circular-image'><br>";

    }
    mysqli_free_result($result);
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection when you're done
mysqli_close($conn);
?>
 <h2><?php echo getUserName(); ?></h2>
    <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
      <label for="image">Profile Picture : </label>
      <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value=""><br><br>
      <button type="submit" name="submit">Upload</button>
    </form>
    <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
      <h2> GENERATE REQUEST</h2>
      <a href="Requestgenarate.php"class="link">Generate</a>
</form>
<script>
    function goBack() {
        window.location.href = 'page1.php'; // Redirect back to page1.php
    }
</script>
<style>
    /* Style for the "Go Back" button */
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
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </body>
</html>