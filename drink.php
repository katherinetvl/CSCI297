<?php
session_start();

if(isset($_SESSION['customerName']))
{
    echo "<p>" . "Hello, " . $_SESSION['customerName'] . "</p>";
}
?>
<?php
require_once('filefunctions.php');
$fileName = "drinkitems.tsv";
$drinkItems = readLines($fileName);
?>

<!DOCTYPE html>
<html>
<head>
    <title> Tailored Restaurant - Drinks </title>
</head>
    <body> 
    <h1>Drinks Menu</h1>
    <ul>
    <?php
        foreach($drinkItems as $key => $value)
        {
            if($value[0] == "non alcoholic")
            {
                echo "<li> $value[1] - $value[2] </li>";
            }
            if($_SESSION['xDrink'] == "Yes")
            {
                if($value[0] == "alcoholic")
                echo "<li> $value[1] - $value[2] </li>";
            }
        }
    ?>
    </ul>

    <!-- Continue to Order Form -->
    <p> Page 3/4 </p>
    <p> <a href='restaurantorderform.php'> Next </a></p>
    </body>
</html>