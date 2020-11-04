<!-- Confirm page -->
<!-- Called page for subscribe.php -->

<!DOCTYPE html> 
<html>
<head>
    <title> Confirmation </title>
</head> 
<body>
<h1> Confirm Subscription </h1>
<?php 

require_once('manipfiles.php');
$fileOfUsers = "subscriberlist.csv";

    // Obtain email and decode 
    $urlLink = ($_SERVER['REQUEST_URI']);
    $urlLink = urldecode($urlLink); 

    $urlArray = explode("=", $urlLink);

    // Obtain email address 
    $emailAddress = $urlArray["1"];
    $pattern = "&confirmation";
    $replacement = "";
    $emailAddress = str_replace($pattern, $replacement, $emailAddress);
    // echo $emailAddress . "<br>";

    // Obtain confirmation code 
    $confirmationCode = $urlArray["2"];
    // echo $confirmationCode . "<br>"; 

    // Read Lines from file 
    $listUsers = readLines($fileOfUsers);
    $success = false;

    $lineNum = -1; 
    foreach($listUsers as $singleInfo)
    {
        $lineNum++;
        // echo "<li> $singleInfo[0] $singleInfo[1] $singleInfo[2] </li>";
        if($emailAddress == $singleInfo[0] && $confirmationCode == $singleInfo[1])
        {
            // Delete line with email/random code 
            deleteLine($fileOfUsers, $lineNum);

            $success = true;
            break;
        }
    } 

    if($success)
    {
        // Append new line 
        $isSet = "true";

        $fileWrite[0] = "Email";
        $fileWrite[1] = "Code";
        $fileWrite[2] = "False";

        $fileWrite = array();
        $fileWrite[] = $emailAddress;
        $fileWrite[] = $confirmationCode;
        $fileWrite[] = $isSet;

        appendLine($fileOfUsers, implode(",", $fileWrite));

        echo "Thank you for subscribing! <br>";
    }
    else
    {
        echo "Sorry, your email could not be confirmed. Please enter it into the subscribing from again. <br>";
    }
?>
</body>
</html>