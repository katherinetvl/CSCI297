<?php
session_start();
?>
<?php
require_once('filefunctions.php');
$fileName = "fooditems.tsv";
$foodItems = readLines($fileName);
?>

<!DOCTYPE html>
<html>
<head>
    <title> The K Restaurant - Food Menu </title>
</head>
    <body> 
    <h1>Food Menu</h1>
    <?php 
    if(isset($_SESSION['customerName']))
    {
        echo "<h2>" . $_SESSION['customerName'] . "</h2>";
    }
    ?>
    <ul>
    <?php
    foreach($foodItems as $key => $value)
    {
        if(!$value[0] == $_SESSION["xFood"])
        {
            echo "<li> . $value[0] . </li>";
        }
    } 
    ?>
    </ul>

    <!-- Continue to Drinks Menu -->
    <p> Page 2/4 <a href='drink.php'> Next </a></p>
    </body>
</html>