<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $message = isset($_POST['message']) ? $_POST['message'] : "";
    $gdpr = isset($_POST['gdpr']) ? "Hyväksytty" : "Ei hyväksytty";

    // Display the form data
    echo "<h2>Yhteydenottolomakkeen tiedot:</h2>";
    echo "Nimi: " . $name . "<br>";
    echo "Sähköposti: " . $email . "<br>";
    echo "Viesti: " . $message . "<br>";
    echo "GDPR-suostumus: " . $gdpr . "<br>";

    // the message user is sending
    $msg = "Nimi: " . $name . "\n";
    $msg .= "Viesti: " . $message . "\n";

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg, 70);

    // send email. inserting the email where the message is sent and writing the topic of the message
    mail("e2203076@edu.vamk.fi", "Yhteydenottolomake: " . $name, $msg);

    // Redirect to a thank_u.php
    header('Location: thank_u.php');
    exit();
}
?>