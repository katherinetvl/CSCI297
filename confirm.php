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
    // Obtain email and decode 
    $urlLink = ($_SERVER['REQUEST_URI']);
    $urlLink = urldecode($urlLink); 
    echo $urlLink . "<br>";
    // echo "This is the confirm.php <br>";

    // Delete line with email/random code 

    // Add 

?>
</body>
</html>