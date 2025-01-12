<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" type="image/x-icon" /></head> <body>
    <title>Health Data </title>
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
            background-image: url('sport.jpeg'); 
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

        .container {
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
        h1 {
            font-family: 'Libre Baskerville', serif; 
            color: #8E3A59;
        }

        h2, h3 {
            color: #333;
        }

        input[type="text"],
        input[type="password"],
        button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #8E3A59;
            color: #fff;
            cursor: pointer;
            width: 120px; 
            margin: 0 auto; 
        }

        button:hover {
            background-color: #C08081;
        }

        p {
            margin-bottom: 10px;
            font-style: italic; 
        }
    </style>
</head>
<body>
    <div class="background">
        <div class="overlay"></div>
        <div class="container">
            <h1>Welcome to the Journey Tracker!</h1>
            <!-- Display error message if the username or password are incorrect or don't exist -->
            <?php
            if(isset($_GET['error']) && $_GET['error'] === 'invalid') {
                echo '<p class="error-message">Invalid username or password.</p>';
            }
            ?>
            <!-- Login form -->
            <form action="login.php" method="POST">
                <input type="text" name="login_email" placeholder="Email" required>
                <input type="password" name="login_password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <p><i>Are you new here?</i></p>
            <!-- Link to registration page -->
            <button onclick="window.location.href='registration.php'">Register</button>
            <!-- Link for technical support -->
            <p>For technical support, <a href="support.php">click here</a>.</p>
        </div>
    </div>
</body>
</html>