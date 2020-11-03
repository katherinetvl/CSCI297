<!-- main file for subscribe form -->
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
                appendLine("subscriberlist.csv", implode(",", $fileOutput));

                // Next: Send user an email 

            }
            else
            {
                echo "Error. Please fill out the form to access this submission page.";
            }
            ?>

    <!-- Return to form -->
    <a href=".\"> Go back </a>
</body>
</html>