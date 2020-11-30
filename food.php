<?php
session_start();

if(isset($_SESSION['customerName']))
{
    echo "<p>" . "Hello, " . $_SESSION['customerName'] . "</p>";
}
?>
<?php
require_once('filefunctions.php');
$fileName = "fooditems.tsv";
$foodItems = readLines($fileName);
?>

<!DOCTYPE html>
<html>
<head>
    <title> Tailored Restaurant - Food </title>
</head>
    <body> 
    <h1> Your Focused Food Menu: </h1>

    <ul>
    <?php
        if($_SESSION['xFood'] != null)
        {
            foreach($foodItems as $key => $value)
            {
                if(!in_array($value[0], $_SESSION['xFood']))
                {
                    echo "<li> $value[1] - $value[2] </li>";
                }
            }
        }
        else
        {
            foreach($foodItems as $key => $value)
            {
                echo "<li>  $value[1] - $value[2] </li>";
            }
        }
    ?>
    </ul>

    <!-- Continue to Drinks Menu -->
    <p> Page 2/4 </p>
    <p><a href='drink.php'> Next </a></p>
    </body>
</html>