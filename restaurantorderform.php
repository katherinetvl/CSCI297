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
$foodName = array();

foreach($foodItems as $key => $foodListing)
{
    array_push($foodName, $foodListing[1]);
}

$fileName2 = "drinkitems.tsv";
$drinkItems = readLines($fileName2);
$drinkNameNonA = array();
$drinkNameA = array(); 

foreach($drinkItems as $key => $drinkListing)
{
    if($drinkListing[0] == "alcoholic" && $_SESSION['customerAge'] <= 21)
    {
        array_push($drinkNameA, $drinkListing[1]);
    }
    else 
    {
        array_push($drinkNameNonA, $drinkListing[1]);
    }
}

?>

<!DOCTYPE html> 
<html>
<head>
    <title> Tailored Restaurant - Order Form </title>
</head> 
<body>
    <?php
    echo "<h1> Welcome to the Customer Order Form </h1>";
    echo "<p> Please select your option(s) and click Submit at the bottom of page </p>";

       if($_SERVER['REQUEST_METHOD'] == 'GET')
       {
        ?>
        <form method = "POST" action = "restaurantorderform.php">
            <label> Food Menu: 
            <br>
                <select name = "menu[]" size = 5 multiple>
                    <?php
                        foreach($foodName as $foodOnMenu)
                        {
                            echo "<option value='{$foodOnMenu}'> {$foodOnMenu} </option>";
                        }
                    ?>
                </select>
            </label>
            <br>
            <label> Drinks Menu: 
            <br>
                <select name = "menu2[]" size = 3 multiple>
                    <?php
                        foreach($drinkNameNonA as $regularDrink)
                        {
                            echo "<option value='{$regularDrink}'> {$regularDrink} </option>";
                        }

                        if($_SESSION['customerAge'] >= 21)
                        {
                            foreach($drinkNameA as $alcoholOnMenu)
                            {
                                echo "<option value='{$alcoholOnMenu}'> {$alcoholOnMenu} </option>";
                            }
                        }
                    ?>
                </select>
            </label>
            <button type = "submit"> Submit </button></br>
        </form>

        <!-- Return to Home Page -->
        <p> Page 4/4 </p>
        <p><a href='customindex.php'> Or Start Over? </a></p>

        <?php 
       }
    else if(isset($_POST['menu']))
    {
        if($_POST['menu'])
        {
            $customerFoodOrder = array();
            foreach($_POST['menu'] as $orderItem)
            {
                $customerFoodOrder[] = $orderItem;
            }
        }

        if($_POST['menu2'])
        {
            $customerDrinkOrder = array();
            foreach($_POST['menu2'] as $orderItem)
            {
                $customerDrinkOrder[] = $orderItem;
            }
        }
        ?>

        <ul>
        <?php 
            echo "<br> Thank you very much! Your order is complete. </br>";
            echo "<h2> Receipt </h2>";
            // Display choices and prices 
            $sumFood = 0;
            $sumDrink = 0; 
            $subtotalAmt = 0;
            if(isset($_POST['menu']))
            {
                foreach($foodItems as $key => $foodListing)
                {
                    foreach($customerFoodOrder as $ordered)
                    {
                        if(in_array($ordered, $foodListing))
                        {
                            echo "<li> $foodListing[1] $foodListing[2] </li>";
                            $sumFood = $sumFood + $foodListing[2];
                        }
                    }
                }
            }

            if(isset($_POST['menu2']))
            {
                foreach($drinkItems as $key => $drinkListing)
                {
                    foreach($customerDrinkOrder as $ordered2)
                    {
                        if(in_array($ordered2, $drinkListing))
                        {
                            echo "<li> $drinkListing[1] $drinkListing[2] </li>";
                            $sumDrink = $sumDrink + $drinkListing[2];
                        }
                    }
                }
            }
            ?>
            </ul>

            <?php 
            $subtotalAmt = $sumFood + $sumDrink;
            echo "Subtotal: ";
            echo number_format($subtotalAmt, 2);
            echo "<br>";

            $costTax = 0.07 * $subtotalAmt;
            echo "Tax: ";
            echo number_format($costTax, 2);
            echo "<br>";

            $totalAmt = $subtotalAmt + $costTax;
            echo "Total: ";
            echo number_format($totalAmt, 2);
            echo "<br>";

        // Return to page 1
        echo "<a href='customindex.php'>" . "Create another order?" . "</a>";
    }
    else
    {
        echo "Please fill out form to continue.";
    }
    ?>
    </body>
</html>