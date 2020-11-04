<!-- Subscribe page -->
<!DOCTYPE html> 
<html>
<head>
    <title> Subscribe Form </title>
</head>     
<body>
        <h1> Welcome to Katherine's Website </h1> 
        
        <?php 
        require_once('manipfiles.php');

            if($_SERVER['REQUEST_METHOD'] == 'GET')
            {
                ?>
                <p> Please enter your email to subscribe! </p> 
                <!-- direct output within conditional -->
                <form method = "POST" action = "subscribe.php">
                    <label> Email: <input type = "text" name = "subscriberEmail"> </input></label>
                    <input type = "submit" value = "Submit" name = "submit"></input>
                </form>

                <?php 
            }
            else if(isset($_POST['subscriberEmail']))
            {
                $userEmail = "example@email.com";
        
                // Set email
                if($_POST['subscriberEmail'] != '')
                {
                    $tempEmail = $_POST['subscriberEmail'];
                    $userEmail = filter_var($tempEmail, FILTER_SANITIZE_EMAIL);
                }
                
                echo "Thank you for submitting your email. Please check your inbox for confirmation link. <br>";

                $generatedCode = bin2hex(random_bytes(10));
                $setOrNot = "false";

                $fileOutput[0] = "Email";
                $fileOutput[1] = "Code";
                $fileOutput[2] = "False";

                $fileOutput = array();
                $fileOutput[] = $userEmail;
                $fileOutput[] = $generatedCode;
                $fileOutput[] = $setOrNot;

                // Append to file
                $fileListUsers = "subscriberlist.csv";
                appendLine($fileListUsers, implode(",", $fileOutput));

                // Send user an email 
                $to = $userEmail;
                $subject = "Pending subscription";
                $message = 'Please click the following link to confirm your subscription' . "\r\n" .
                'https://3570555cb47d.ngrok.io/confirm.php?email=' . urlencode($userEmail) . '&confirmation='. $generatedCode . "\r\n";
                
                $message = wordwrap($message, 70);
                $headers =  "From: unwelcometeam@gmail.com" . "\r\n" . 
                            "Reply-To: unwelcometeam@gmail.com" . "\r\n" . 
                            "X-Mailer: PHP/" . phpversion(); 

                mail($to, $subject, $message, $headers);

                $returnToForm = "Go Back";
                // Return to form 
                echo "<a href='subscribe.php'>" . $returnToForm .  "</a>";
            }
            else
            {
                echo "Error. Please fill out the form to access this submission page.";
            }
            ?>
</body>
</html>