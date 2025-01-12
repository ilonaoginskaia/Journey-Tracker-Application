<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <title>Support</title>
    <style>
        /*scc styles*/
        input[type=text], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

              #message {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=checkbox] {
            width: auto;
        }

        input[type=submit] {
            width: 100%;
            background-color: #8E3A59;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #C08081;
        }

        div {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
        h3 {
            padding-top: 60px; 
            font-family: 'Libre Baskerville', serif; /* Set font to Libre Baskerville */
            color: #8E3A59;
            text-align: center;
           
        }
    </style>
</head>
<body>

    <h3>Contact Form</h3>

    <div>
         <!-- Form for sending a message -->
        <form action="send_message.php" method="post">
             <!-- Name input field -->
            <label for="fname">Name:</label>
            <input type="text" id="fname" name="name" placeholder="e.g. Matti Suorauha" >
            <!-- Email input field -->
            <label for="sposti">E-mail:</label>
            <input type="text" id="sposti" name="email" placeholder="posti@gmail.com">
            <!-- Message input field -->
            <label for="message">Message:</label>
            <input id="message" name="message" placeholder="Write your message here ...">

            <!-- GDPR-agreement -->
            <label for="gdpr">GDPR Consent:</label>
            <input type="checkbox" id="gdpr" name="gdpr" required>
            I accept that my information is stored and processed for the purpose of this form.
            <!-- Submit button -->
            <input type="submit" value="Submit">
        </form>
    </div>

</body>
</html>