<!-- home page -->
<?php 
session_start();

$inputName = "Valued Customer";
$foodToAvoid = array(); 
$foodToAvoid[] = "None";
$allowAlcohol = "No";

$_SESSION['customerName'] = $inputName;
$_SESSION['xDrink'] = $allowAlcohol;
$_SESSION['xFood'] = $foodToAvoid;
?>
<?php
    require_once('filefunctions.php');
    $fileName = "fooditems.tsv";
    $foodItems = readLines($fileName);
    $foodType = array();

    foreach($foodItems as $key => $foodListing)
    {
        array_push($foodType, $foodListing[0]);
    }

    $foodType = array_unique($foodType);
?>
<!DOCTYPE html> 
<html>
<head>
    <title> Tailored Restaurant </title>
</head> 
<body>
    <h1> Welcome to the Customer Order Form </h1> 
    <p> To begin, please fill out a little information about yourself: </p>
    <p> Then, click 'Next' to continue to view menu </p> 
    <?php 
       if($_SERVER['REQUEST_METHOD'] == 'GET')
       {
        ?>
        <form method = "POST" action = "customindex.php">
            <label> Name: <input type = "text" name = "inputName"> </input></label></br>
            <label> Age: <input type = "number" name = "inputAge" min = "16" max = "110"> </input></label></br>
            <p> Please select food types you do not eat, for any reason (allergy, religion, personal preference): </p>
            <label> Food Types: 
                <select name = "foodTypes[]" multiple>
                <?php

                    foreach($foodType as $foodCategory)
                    {
                        echo "<option value='{$foodCategory}'> {$foodCategory} </option>";
                    }
                ?>
                </select>
            </label>
            <br>
            <button type = "submit"> Submit </button></br>
        </form>
        <?php 
       }
    else if(isset($_POST['inputName']) && isset($_POST['inputAge']))
    {
        if($_POST['inputName'] != '')
        {
            $_SESSION['customerName'] = $_POST['inputName'];
        }

        if(is_numeric($_POST['inputAge']))
        {
            $userAge = $_POST['inputAge'];
            if($userAge >= 18)
            {
                $doAllowAlcohol = "Yes";
                $_SESSION['xDrink'] = $doAllowAlcohol;
            }
        }

        if(isset($_POST['foodTypes']))
        {
            $foodChosenToAvoid = array();
            foreach ($_POST['foodTypes'] as $foodType)
            {
                $foodChosenToAvoid[] = $foodType;
            }
        }
        $foodToAvoid = array_replace($foodToAvoid, $foodChosenToAvoid);
        // print_r($foodToAvoid);

        $_SESSION['xFood'] = $foodToAvoid;
        echo "Here are my session variables <br>";
        print_r($_SESSION['customerName']);
        echo "<br>";
        print_r($_SESSION['xDrink']);
        echo "<br>";
        print_r($_SESSION['xFood']);

        // Continue to Food Menu
        echo "<br> This is page 1/4 </br>";
        echo "<a href='food.php'>" . "Next" . "</a>";
    }
    else
    {
        echo "Please fill out form to continue.";
    }
    ?>
</body>
</html>