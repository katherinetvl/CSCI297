<?php
if(isset($_COOKIE['visited']))
{
    $cookieVisited = $_COOKIE['visited'];

    $useComma = base64_encode(",");
    $visitedArr[] = explode($useComma, $cookieVisited);
    array_shift($visitedArr[0]);
}
else
{
    $visitedArr = array();
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
<h1>Company Listing</h1>
<ul>
<?php

if(!empty($visitedArr))
{
    foreach($visitedArr as $itemsVisited)
    {
        foreach($companies as $key => $value)
        {
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
}
else
{
    foreach($companies as $key => $value)
    {
        echo "<li><a href='details.php?company=" . urlencode($key) . "'>" . $value[0] . "</a></li>";
    } 
}

?>
</ul>
    </body>
</html>