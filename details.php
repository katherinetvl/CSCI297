<?php 
    $cookie_name = "visited";
    $cookie_value = "Initial";
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
            $cookie_value = str_replace('Initial', '', $cookie_value);
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
            var_dump($queryString);

            $queryComma = "," . $queryString;
            echo "Query with comma: " . $queryComma . "<br>";

            $visitString = base64_encode($queryComma);
            echo "My visitString: " . $visitString . "<br>";

            // Add string to cookie string if not already present
            $stringSearch = strpos($cookie_value, $visitString);

            if($stringSearch === false)
            { 
                $cookie_value .= $visitString;
            }
            // Save value to cookie 
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/');

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