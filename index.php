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

// var_dump($visitedArr);

/*
    foreach($visitedArr as $visitedItem)
    {
        foreach($companies as $key => $value)
        {
            $valueVisited = trim($value[1]);
            if($valueVisited == $visitedItem[1])
            {
                echo "<li><a href='details.php?company=" . urlencode($key) . "'>" . $value[0] . "- visited" . "</a></li>";
            }
            else
            {
                echo "<li><a href='details.php?company=" . urlencode($key) . "'>" . $value[0] . "</a></li>";
            }
        } 
    }
*/

foreach($visitedArr as $item)
{
    foreach($companies as $key => $value)
    {
        $valueVisited = trim($value[1]);
        if(in_array($valueVisited, $item))
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