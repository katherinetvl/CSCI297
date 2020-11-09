<?php
    $cookieVisited = $_COOKIE['visited'];
    $cookieVisited = str_replace("Initial", "", $cookieVisited);
    var_dump($cookieVisited); 
    echo "<br> Above is cookieVisited <br>";
    echo "<br>";

    $decodedCookieString = base64_decode($cookieVisited);
    var_dump($decodedCookieString);
    echo "<br> Above is decodedCookieString <br>";
    echo "<br>";
    
    $visitedArr[] = explode(",", $decodedCookieString);
    var_dump($visitedArr);
    echo "<br> Above is visited array: <br>";
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
<h1>Company Listing</h1>
<ul>
<?php

foreach($visitedArr as $itemsVisited)
{
    foreach($companies as $key => $value)
    {
        echo "key: " . $key; 
        if(in_array($key, $itemsVisited))
        {
            echo "<li><a href='details.php?company=" . urlencode($key) . "'>" . $value[0] . "- visited" . "</a></li>";
        }
        else
        {
            echo "<li><a href='details.php?company=" . urlencode($key) . "'>" . $value[0] . "</a></li>";
        }
    } 
}




?>
</ul>
    </body>
</html>