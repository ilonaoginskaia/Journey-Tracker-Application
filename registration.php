<?php
session_start();

$servername = "mariadb.vamk.fi";
$username = "e2203076";
$password = "uGeEFE2YmuF";
$database = "e2203076_health";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the request method is POST, indicating form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['registration_email'];
    $password = $_POST['registration_password'];
    $username = $_POST['registration_username'];

    // Check if email already exists in DB
    $check_sql = "SELECT id FROM Users WHERE email='$email'";
    $check_result = $conn->query($check_sql);

    if ($check_result && $check_result->num_rows > 0) {
        echo '<div class="message-container">';
        echo "Email already exists. Please choose a different one.";
        echo '</div>';
    } else {
        // Hash the password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user into database
        $insert_sql = "INSERT INTO Users (email, password_hash, username) VALUES ('$email', '$password_hash', '$username')";
        if ($conn->query($insert_sql) === TRUE) {
            echo "New user registered successfully. Please log in.";
            header("Location: index.php"); // Redirect to login page after successful registration
            exit();
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }
}
// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head><link rel="icon" href="favicon.ico" type="image/x-icon" />
    <title>User Registration</title>
    <style>
       /*CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .background {
            position: relative;
            width: 100%;
            height: 100vh;
            background-image: url('sport2.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.1); 
        }

        .registration-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            width: 300px; 
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7); 
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center; 
        }
        .message-container {
            background-color: rgba(255, 0, 0, 0.1); 
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
            text-align: center;
        }

        h1 {
            font-family: 'Libre Baskerville', serif; 
            color: #8E3A59;
        }

        input [type="text"] {
        display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"]
         {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;

            background-color: #8E3A59;
            color: #fff;
            cursor: pointer;
            width: 120px; 
            margin: 0 auto; 
        }

        input[type="submit"]:hover {
            background-color: #C08081;
        }

        p {
            margin-bottom: 10px;
            font-style: italic; 
            font-size: 12px;
        }

        .back-link {
            color: #8E3A59;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="background">
    <div class="overlay"></div> 
    <div class="registration-container">
        <h1>User Registration</h1>
        <!-- Registration form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="registration_username">Username:</label>
            <input type="text" id="registration_username" name="registration_username" placeholder="Enter your username" required>
            <label for="registration_email">Email:</label>
            <input type="email" id="registration_email" name="registration_email" placeholder="example@address.com" required>
            <label for="registration_password">Password:</label>
            <input type="password" id="registration_password" name="registration_password" placeholder="Password" required>
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
