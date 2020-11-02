<?php 
    $cookie_name = "visited";
    $cookie_value = "Initital";    
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/');
    // cookie lasts 3 months
    
    // header('Location: index.php');
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

<?php
if(!isset($_COOKIE[$cookie_name]))
    {
        echo "Whoops. The cookie '" . $cookie_name . "' is not set.";
    }
else
{
    echo "Cookie named " . $cookie_name . " is set! <br>";
    echo "Value is: " . $_COOKIE[$cookie_name] . "<br>";
    var_dump($_COOKIE);
}
?>
<h1>Company Details</h1>
<?php

$visitString = "";
$visitArr = array();
array_push($visitArr,$cookie_value);

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
            // Add string to visited array
            if (!in_array($visitString,$visitArr))
            {
                array_push($visitArr, $visitString);
            }

            // Show array visitArr 
            var_dump($visitArr); 
            
            // Save value to cookie 
            $cookie_value = implode($visitArr);
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