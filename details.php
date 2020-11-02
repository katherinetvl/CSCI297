<?php 
    $cookie_name = "visited";
    $cookie_value = "Initital";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/');
    // cookie lasts 3 months
    
    if(isset($_COOKIE[$cookie_name]))
    {
        $cookieVisited = $_COOKIE['visited'];

        $cookieSearch = strpos($cookie_value, $cookieVisited);

        if($cookieSearch === false)
        {
            // Save value to cookie 
            $cookie_value .= $cookieVisited;
        }
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/');
    }
?>
<?php
$callListResouce = fopen("callList.csv", "r");
$companies = array();

if(!is_resource($callListResouce))
{
    echo "Could not open the file";
    exit();
}

while($line = fgets($callListResouce))
{
    $companies[] = explode(",", $line);
}

fclose($callListResouce);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Companies</title>
</head>
<body> 

<h1>Company Details</h1>
<?php

// $visitString = ""; // this kept re-initializing my string to empty

    if(isset($_GET["company"]))
    {
        if(isset($companies[$_GET["company"]]))
        {
            // Render the company info
            echo "<h2>" . $companies[$_GET["company"]][0] . "</h2>";
            echo "<p>Company Phone: " . $companies[$_GET["company"]][1] . "</p>";

            // Get phone number 
            $pNumber = trim($companies[$_GET["company"]][1]);
            
            // Combine key and comma 
            $pNumberAndComma = "," . $pNumber;
            // echo "My number with comma: " . $pNumberAndComma . "<br>";

            $visitString = base64_encode($pNumberAndComma);
            // echo "My visitString: " . $visitString . "<br>";
            // Add string to cookie string if not already present
            $stringSearch = strpos($cookie_value, $visitString);

            if($stringSearch === false)
            {
                // Save value to cookie 
                $cookie_value .= $visitString;
                // echo "Tried concatenation: " . $cookie_value . "<br>";
            }
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/');
        }
        else
        {
            // Default text
            echo "The company was not found.";
        }
    }
    else
    {
        // Default text
        echo "The company was not found.";
    }

?>

<a href="/">Back to list</a>

    </body>
</html>