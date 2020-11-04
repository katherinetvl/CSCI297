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

    // Obtain email and decode 
    $urlLink = ($_SERVER['REQUEST_URI']);
    $urlLink = urldecode($urlLink); 

    $urlArray = explode("=", $urlLink);
    // var_dump($urlArray);

    // Obtain email address 
    $emailAddress = $urlArray["1"];
    $pattern = "&confirmation";
    $replacement = "";
    $emailAddress = str_replace($pattern, $replacement, $emailAddress);
    echo $emailAddress . "<br>";

    // Obtain confirmation code 
    $confirmationCode = $urlArray["2"];
    echo $confirmationCode . "<br>"; 

    // Read Lines from file 
    $listUsers = readLines("subscriberlist.csv");
    // var_dump($listUsers);

    foreach($listUsers as $singleInfo)
    {
        // $individualUser[] = explode(",", $singleLine);
        echo "<li> $singleInfo[0] $singleInfo[1] $singleInfo[2] </li>";
    }

    /*
    if(// in_array )
    {
        // Delete line with email/random code 


        // Append new line 
        $isSet = "true";

        $fileWrite[0] = "Email";
        $fileWrite[1] = "Code";
        $fileWrite[2] = "False";

        $fileWrite = array();
        $fileWrite[] = $emailAddress;
        $fileWrite[] = $confirmationCode;
        $fileWrite[] = $isSet;

        appendLine("subscriberlist.csv", implode(",", $fileOutput));

        echo "Thank you for subscribing! <br>";
    }
    else
    {
        echo "Sorry, your email could not be subscribed. Please enter it into the subscribing from again. <br>";
    }
    */
?>
</body>
</html>