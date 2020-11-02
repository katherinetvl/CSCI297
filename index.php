<?php
    $cookieVisited = $_COOKIE['visited'];
    //echo "Cookie named " . $cookieVisited . " is set! <br>";
    // var_dump($cookieVisited); 
    $decodeCookieString = base64_decode($cookieVisited);
    $visitedArr[] = explode(",", $decodeCookieString);
    // var_dump($visitedArr);
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

$trackingOnIndex[] = null;

    foreach($visitedArr as $item)
    {
        $compareNum = $item[1];
        // echo "Trying to find number in my array: " . $compareNum . "<br>";
        array_push($trackingOnIndex, $compareNum);
    }

    /*
    foreach($trackingOnIndex as $itemTracked)
    {
        $visitedHistory = $itemTracked;
        echo "Item Tracked should be number: " . $visitedHistory . "<br>";
    } */

    foreach($companies as $key => $value)
    {
        $valueVisited = trim($value[1]);
        // if($valueVisited == $compareNum)
        if(in_array($valueVisited, $trackingOnIndex))
        {
            echo "<li><a href='details.php?company=" . urlencode($key) . "'>" . $value[0] . "- visited" . "</a></li>";
        }
        else
        {
            echo "<li><a href='details.php?company=" . urlencode($key) . "'>" . $value[0] . "</a></li>";
        }
    } 

    /* foreach($companies as $key => $value)
    {
        echo "<li><a href='details.php?company=" . urlencode($key) . "'>" . $value[0] . "</a></li>";
        // echo "Key: " . $key . "<br>";
        // echo "Value at 0: " . $value[0] . "<br>";
        // echo "Value at 1: " . $value[1] . "<br>";
    } 
    */
?>
</ul>
    </body>
</html>