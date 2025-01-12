<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Check if logout button is clicked
if (isset($_POST['logout'])) {
    // Clear all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to login page
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
    <title>Data input</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif; 
            text-align: center;
            margin: 0; 
            padding: 0; 
        }

        .background {
            position: relative;
            width: 100%;
            height: 100vh;
            background-image: url('bg3.jpg'); 
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
       

        form {
            margin: 20px auto; 
            width: 300px; 
        }
        h1 {
            font-family: 'Libre Baskerville', serif; 
            color: #8E3A59;
        }

        label {
            display: block;
            margin-bottom: 10px;
            text-align: left; 
        }

        input[type="text"], input[type="number"], input[type="submit"], input[type="button"] {
           
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"], input[type="button"] {
            background-color: #8E3A59;
            color: #fff;
            cursor: pointer;
            width: 120px; 
            margin: 0 auto; 
        }

        input[type="submit"]:hover, input[type="button"]:hover {
            background-color: #C08081; 
        }

        ::placeholder {
            color: #777; 
        }

        p {
            margin-bottom: 10px;
            font-style: italic; 
            font-family: Arial, sans-serif; 
            color: #333; 
        }

    </style>
</head>
<body class="background">
    <div class="overlay"></div> 
    <div class="container">
        <h1>Insert your data here:</h1>
        <!-- Form for inserting data -->
        <form action="add_block.php" method="post">
            <label for="start_point">You started your journey from:</label>
            <input type="text" id="start_point" name="start_point" placeholder="name of a city"  required>
            <label for="end_point">You finished your journey at:</label>
            <input type="text" id="end_point" name="end_point" placeholder="name of a city"  required>
            <label for="km">The whole distance:</label>
            <input type="number" id="km" name="km" placeholder="km" required>
            <input type="submit" value="Add data">
        </form>
         <!-- Logout form -->
        <form action="" method="post">
            <p>You are logged in as: <?php echo $_SESSION['username']; ?></p>
            <input type="hidden" name="logout" value="1">
            <input type="button" value="Logout" onclick="this.form.submit()">
             <!-- Tech support link -->
            <p>For technical support, <a href="support.php">click here</a>.</p>
        </form>
    </div>
</body>
</html>
