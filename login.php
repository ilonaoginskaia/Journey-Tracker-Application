<?php
session_start();

$servername = "mariadb.vamk.fi";
$username = "e2203076";
$password = "uGeEFE2YmuF";
$database = "e2203076_health";
// Establishing connection to the database
$conn = new mysqli($servername, $username, $password, $database);
// Check connection status
if ($conn->connect_error) {
// If connection fails, stop script and display error message
    die("Connection failed: " . $conn->connect_error);
}
// Check if the form has been submitted (POST request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Get email and password from the submitted form data
    $email = $_POST['login_email']; 
    $password = $_POST['login_password'];
    
// Prepare SQL statement to select user data based on email
    $sql = "SELECT id, username, password_hash FROM Users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
// Check if user with the provided email exists
    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row["password_hash"])) {
        // If password is correct, set session variables for user ID and username
            $_SESSION['user_id'] = $row["id"];
            $_SESSION['username'] = $row["username"];
            header("Location: transaction_form.php"); // Redirect to transaction_form in case of successful login
            exit();
        } else {
            // If password is incorrect, Set error parameter. invalid data
            header("Location: index.php?error=invalid");
            exit();
        }
    } else {
        // If no user with the provided email exists, Set error parameter . invalid data
        header("Location: index.php?error=invalid");
        exit();
    }
}
// Close database connection
$conn->close();
?>
