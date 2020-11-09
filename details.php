<?php 
    $cookie_name = "visited";
    $cookie_value = "Cookie";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/');
    // cookie lasts 3 months
    
    if(isset($_COOKIE[$cookie_name]))
    {
        $cookieVisited = $_COOKIE['visited'];
        var_dump($cookieVisited);
        echo "<br> Above is what I have been concatenating. <br>";

        $cookieSearch = strpos($cookie_value, $cookieVisited);

        if($cookieSearch === false)
        {
            // Save value to cookie
            // $cookie_value = str_replace("Cookie", "", $cookie_value);
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

    if(isset($_GET["company"]))
    {
        if(isset($companies[$_GET["company"]]))
        {
            // Get query string  
            $queryString = [$_SERVER['QUERY_STRING']][0];
            $queryString = str_replace("company=", "", $queryString);
            echo "queryString: " . $queryString . "<br>";
            echo "<br>";
            
            // Encode comma with value for adding to cookie
            $queryToken = "A" . $queryString;

            // Add string to cookie string if not already present
            $stringSearch = strpos($cookie_value, $queryToken);

            if($stringSearch === false)
            { 
                $cookie_value .= $queryToken; 
            }
            $cookie_value = str_replace("Cookie", "", $cookie_value);

            // Save value to cookie 
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/');
            echo "cookie_value at this point is: <br>";
            var_dump($cookie_value);
            echo "<br>";

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