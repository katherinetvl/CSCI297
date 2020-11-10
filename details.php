<?php 
    $cookie_name = "visited";
    $cookie_value = "Cookie";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/');
    // cookie lasts 3 months
    
    if(isset($_COOKIE[$cookie_name]))
    {
        $cookieVisited = $_COOKIE['visited'];
        $cookie_value .= $cookieVisited;
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

    if(isset($_GET["company"]))
    {
        if(isset($companies[$_GET["company"]]))
        {
            // Get query string  
            $queryString = [$_SERVER['QUERY_STRING']][0];
            $queryString = str_replace("company=", "", $queryString);
            
            // Encode comma with value for adding to cookie
            $queryToken = base64_encode(",");
            $concealComma = $queryToken . $queryString;

            // Add string to cookie string
            $cookie_value .= $concealComma; 

            // Remove the initialized value of cookie 
            $cookie_value = str_replace("Cookie", "", $cookie_value);

            // Stop repeat query values 
            $cookie_value = implode($queryToken, array_unique(explode($queryToken, $cookie_value)));

            // Save value to cookie 
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/');
            echo "cookie_value now: ";
            echo $cookie_value . "<br>";

            // Render the company info
            echo "<h2>" . $companies[$_GET["company"]][0] . "</h2>";
            echo "<p>Company Phone: " . $companies[$_GET["company"]][1] . "</p>";
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